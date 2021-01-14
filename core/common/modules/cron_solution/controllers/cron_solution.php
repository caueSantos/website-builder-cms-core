<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

// Inclui o arquivo que contem a Class AutoGestorWs


class cron_solution extends lands_core {

    public $tabela_produtos = 'produtos';
    public $endpoint = null;
    public $token = null;

    public function __construct() {

        parent::__construct();


// Autorisa o "fopen" em conexões externas.
        ini_set("allow_url_fopen", 1);
//        ini_set('max_execution_time', 7200);

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'cron_solution');

        $this->carrega_configs();
    }

    function index() {
        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
            $funcao_atual = $this->pagina_atual;
            //executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function carrega_configs() {
        if (!$this->app->token) {
            die('token nao configurado');
        }

        if (!$this->app->endpoint) {
            die('endpoint nao configurado');
        }

        $headers['token'] = $this->app->token;
        foreach ($headers as $key => $value) {
            $string[] = "{$key}: $value";
        }

        $this->headers = $string;
        $this->token = $this->app->token;
        $this->endpoint = $this->app->endpoint;
    }

    function switch_pagina() {
        switch ($this->pagina_atual) {
            case 'cron_solution':




                if ($_REQUEST['busca'] && !empty($_REQUEST['busca'])) {
                    $valor = $_REQUEST['busca'];
                    $filtro_sql = " and (Nome_txf LIKE '%{$valor}%' or Referencia_txf LIKE '%{$valor}%' or Codigo_txf LIKE '%{$valor}%') order by Nome_txf";

                    $produtos = $this->mbc->buscar_completo('produtos', $filtro_sql);
                    $this->smarty->assign('produtos', $produtos);
                } else {
                    $base = $this->app->Url_cliente;
                    foreach ($this->uri->segments as $key => $value) {
                        $base.=$value . '/';
                    }
                    
                    $config = new stdClass();

                    $config->per_page = 15;
                    $config->base_url = $base;
                    $config->page_query_string = TRUE;
                    $filtro_sql = null;
                    $registros = $this->mbc->super_paginacao('produtos', $filtro_sql, $config, null, null);
                    $this->smarty->assign('produtos', $registros->registros);
                    $this->smarty->assign('paginacao', $registros->paginacao);
                }






                break;
            case 'sincroniza':
                $this->sincronizar();
                die();
                break;
            case 'sincro_imagens':
                $this->agenda_sincro_imagens();
                die();
                break;
            case 'cron_imagens':
                $this->sincroniza_imagens();
                die();
                break;
            case 'produtos_sem_imagens':
                echo "<br>*********************************<br>";
                echo "PRODUTOS SEM IMAGENS";
                echo "<br>*********************************<br>";

                $produtos = $this->mbc->executa_sql("select * from produtos where Id_int not in(select Id_imagem_con from imagens where Tabela_con='produtos')");
                $array_sem_img = array();

                foreach ($produtos as $produto) {
                    if (!$produto->Imagens[0]) {
                        $array_sem_img[] = $produto;

                        echo "{$produto->Codigo_txf} - {$produto->Nome_txf} <br>";
                    }
                }
                echo "<br>*********************************<br>";
                echo "<br>Total: " . count($array_sem_img) . " produtos sem imagens";
                die();
                break;
            default:
                break;
        }
    }

    function sincronizar() {
        $this->sincroniza_categorias();
        $this->sincroniza_produtos();
        die();
    }

    function sincroniza_categorias() {

        $grupos_curl = $this->curlContents($this->endpoint . 'grupos', 'GET', FALSE, $this->headers);


        $grupos = json_decode($grupos_curl['contents']);

        if ($grupos[0]) {
            $this->desativa_categorias();


//             ver($grupos);

            foreach ($grupos as $grupo) {
                $categoria = $this->mbc->executa_sql("select * from produtos_departamentos where Codigo_externo_txf='$grupo->idgrupo'");
                $grupo_array = array();
                $grupo_array['Nome_tit'] = $grupo->nome;
                $grupo_array['Nome_url'] = url_title($grupo->nome);
                $grupo_array['Ativo_sel'] = 'SIM';
                $grupo_array['Codigo_externo_txf'] = $grupo->idgrupo;

                if ($grupo->idgrupo == 126 || $grupo->idgrupo == 128) {
                    $grupo_array['Ativo_sel'] = 'NAO';
                }

                if ($categoria[0]) {
                    $this->mbc->updateTable("produtos_departamentos", $grupo_array, "Codigo_externo_txf", $grupo->idgrupo);
                    echo "Departamento $grupo->nome atualizado<br> ";
                } else {
                    $this->mbc->db_insert("produtos_departamentos", $grupo_array);
                    echo "Departamento $grupo->nome  inserido<br>  ";
                }

                $cont2 = 0;
                foreach ($grupo->subgrupos as $subgrupo) {

                    $subcategoria = $this->mbc->executa_sql("select * from produtos_categorias where Codigo_externo_txf='$subgrupo->idsubgrupo'");
                    $subgrupo_array = array();
                    $subgrupo_array['Nome_tit'] = $subgrupo->nome;
                    $subgrupo_array['Nome_url'] = url_title($subgrupo->nome);
                    $subgrupo_array['Ativo_sel'] = 'SIM';
                    $subgrupo_array['Departamento_sel'] = url_title($grupo->nome);
                    $subgrupo_array['Codigo_externo_txf'] = $subgrupo->idsubgrupo;

                    if ($subcategoria[0]) {
                        $this->mbc->updateTable("produtos_categorias", $subgrupo_array, "Codigo_externo_txf", $subgrupo->idsubgrupo);
                        echo "Categoria $subgrupo->nome  atualizada<br>  ";
                    } else {
                        $this->mbc->db_insert("produtos_categorias", $subgrupo_array);
                        echo "Categoria $subgrupo->nome  inserida<br>  ";
                    }
                    $cont2 = $cont2 + 1;
                }
            }
        } else {
            echo "Webservice não retornou grupos <br>";
        }
    }

    function sincroniza_produtos() {

        $produtos_curl = $this->curlContents($this->endpoint . 'produtos', 'GET', FALSE, $this->headers);
//ver($produtos_curl);
//        $prod = file_get_contents_headers($this->endpoint,"token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6Imd1c3Rhdm8udmVkYW5hQGxhbmRzYWdlbmNpYXdlYi5jb20uYnIiLCJub21lIjoiRXJja21hbm4iLCJhcHAiOiJTaXRlIEVWTSBFbGV0cmVjaWRhZGUiLCJpcCI6IjAuMC4wLjAifQ.85rPgZAg3DfucsdxU8pRRBh-5rWViYWaZRKd8d2VW-8");
//        ver($prod);
//ver($this->headers);
        $produtos = json_decode($produtos_curl['contents']);


        if ($produtos[0]) {
            //   $this->desativa_produtos();
            $cont = 0;
            foreach ($produtos as $produto) {
                $cont = $cont + 1;
                $produto_array = array();
                $produto_array['Nome_txf'] = $produto->nome;
                $produto_array['Referencia_txf'] = $produto->referencia;
                $produto_array['Codigo_txf'] = $produto->idproduto;
                $produto_array['Preco_txf'] = $produto->preco_venda;
                $produto_array['Preco_promocional_txf'] = $produto->preco_oferta;
                if ($produto->validade_oferta) {


                    $produto_array['Validade_oferta_txf'] = date('Y-m-d H:i:s', strtotime($produto->validade_oferta));
//                    ver($produto_array);
                    
                }

                $produto_array['Estoque_txf'] = $produto->estoque_atual;
                $produto_array['Departamento_sel'] = url_title($produto->grupo);
                $produto_array['Categoria_sel'] = url_title($produto->subgrupo);
                $produto_array['Unidade_txf'] = $produto->unidade;
                $produto_array['Ativo_sel'] = 'NAO';
                if ($produto->valor_site == 'S') {
                    $produto_array['Mostra_preco_sel'] = 'SIM';
                } else {
                    $produto_array['Mostra_preco_sel'] = 'NAO';
                }
                if ($produto->foto_site == 'S') {
                    $produto_array['Foto_site_sel'] = 'SIM';
                } else {
                    $produto_array['Foto_site_sel'] = 'NAO';
                }




                $produto_banco = $this->mbc->executa_sql("select * from produtos where Codigo_txf='$produto->idproduto'");

                if ($produto_banco[0]) {
                    $this->mbc->updateTable("produtos", $produto_array, "Id_int", $produto_banco[0]->Id_int);
                    echo "Produto $produto->nome atualizado<br> ";
                } else {
                    $produto_array['Ativo_sel'] = 'NAO';
                    $this->mbc->db_insert("produtos", $produto_array);
                    echo "Produto $produto->nome  inserido<br>  ";
                }
                $array_ids[] = $produto->idproduto;
            }


            $query_ativa = "UPDATE produtos AS p INNER JOIN imagens AS i ON p.Id_int = i.Id_imagem_con SET p.Ativo_sel = 'SIM' where p.Estoque_txf!='0'";
            $this->mbc->myquery($query_ativa);

            $produtos_cadastrados = $this->mbc->executa_sql("select * from produtos where Ativo_sel='SIM'");
            $cont2 = 0;
            foreach ($produtos_cadastrados as $prodcad) {
                if (!in_array($prodcad->Codigo_txf, $array_ids)) {
                    $prod_array['Ativo_sel'] = 'NAO';
                    $this->mbc->updateTable("produtos", $prod_array, "Id_int", $prodcad->Id_int);
                    echo "Produto $prodcad->Codigo_txf $prodcad->Nome_txf desativado<br> ";
                    $cont2 = $cont2 + 1;
                }
            }
            echo "<br><br> ----------------------<br>$cont2 produtos desativados... <br>--------------------<br>";

            // $produto_banco = $this->mbc->executa_sql("select * from produtos where Codigo_txf='$produto->idproduto'");
            // $this->mbc->myquery("update produtos set Ativo_sel='NAO' where Id_int not in(select Id_imagem_con from imagens where Tabela_con='produtos')  ");

            echo "<br>*********************************<br>";
            $msg = "{$cont} produtos sincronizados...";
            echo $msg;
            $this->log_sincro($msg);
            echo "<br>*********************************<br>";
        } else {
            echo "Websercie não retornou produtos<br>";
        }
    }

    function desativa_categorias() {

        $this->mbc->myquery("update produtos_departamentos set Ativo_sel='NAO'");
        $this->mbc->myquery("update produtos_categorias set Ativo_sel='NAO'");
    }

    function desativa_produtos() {

        $this->mbc->myquery("update produtos set Ativo_sel='NAO'");
    }

    function busca_imagem($url_img) {

// Coleta apenas o nome e extensão da imagem.
        $img_nome = substr($url_img, strrpos($url_img, '/') + 1) . ".png";
// Diretório onde será salva a imagem.
        $dir = "painel/img/{$this->dados_conexao['database']}/";


//file_get_contents("http://example.com/", 0, $ctx); 
// Le o conteúdo do arquivo no sistema AutoGestor.
        $get_img = file_get_contents($url_img);
//        ver($url_img,1);
//        ver($img_nome,1);
        //ver($get_img);
// Caso a leitura obtenha sucesso...
        if ($get_img) {
            // Salva a imagem no servidor onde está o site do Cliente.
//ver($dir . $img_nome);
            $sav_img = file_put_contents($dir . $img_nome, $get_img);
            // Caso tenha salvado com sucesso...
            if ($sav_img) {
                // Exibe a mensagem de sucesso.
                //  print 'Imagem copiada com sucesso<br>';
                return $img_nome;
                return true;
            } else {
                // Exibe a mensagem de Erro.
                print 'Erro ao salvar a imagem<br>';
                return false;
            }
        } else {

            //    ver($url_img);
            // Exibe a mensagem de Erro.
            print "Erro ao obter a imagem <a href='$url_img'>$url_img</a><br>";
            return false;
        }
    }

    function agenda_sincro_imagens() {
//        $produtos = $this->mbc->executa_sql("select * from produtos where Id_int not in(select Id_imagem_con from imagens where Tabela_con='produtos') and Id_int not in (select Id_produto from sincro_imagens )");

        $produtos = $this->mbc->executa_sql("select * from produtos where Id_int not in (select Id_produto from sincro_imagens )");
//        ver(count($produtos));
        $cont = 0;

        if ($produtos[0]) {
            foreach ($produtos as $produto) {
                $prod = array();
                $prod['Id_produto'] = $produto->Id_int;
                $prod['Nome_txf'] = $produto->Nome_txf;
                $prod['Codigo_txf'] = $produto->Codigo_txf;
                $prod['Data_dat'] = date('Y-m-d H:i:s');
                $this->mbc->db_insert('sincro_imagens', $prod);
                $cont = $cont + 1;
            }
        }

        $msg = "$cont produtos sem imagens inseridos no log";
        echo $msg;
        $this->log_sincro($msg);
    }

    function deleta_duplicadas() {
        $produtos = $this->mbc->buscar_completo("produtos");

        foreach ($produtos as $produto) {
            if ($produto->Imagens[1]) {
                $i = 0;
                foreach ($produto->Imagens as $imagem) {

                    if ($i != 0) {
                        $this->mbc->db_delete('imagens', 'Id_int', $imagem->Id_int);
                        echo "deletou imagem {$imagem->Id_int} <br>";
                    }
                    $i = $i + 1;
                }
            }
        }
    }

    function sincroniza_imagens($id_produto = null) {
        if ($this->uri->segment(3)) {
            $id_produto = $this->uri->segment(3);
            $produtos = $this->mbc->executa_sql("select  p.*, Id_int as Id_produto  from produtos p where p.Id_int = " . intval($id_produto));
        } else {
            $produtos = $this->mbc->executa_sql("select * from sincro_imagens limit 30");
        }

        $msg = "Iniciando cron para " . count($produtos) . " produtos sem imagem..";
        $this->log_sincro($msg);

        if ($produtos[0]) {
            foreach ($produtos as $prod) {
                if ($prod->Codigo_txf) {
                    $imagem = $this->endpoint . 'produto/imagem/P' . $prod->Codigo_txf;
                    $nome = $this->busca_imagem($imagem);

                    if ($nome) {
                        $img = array();
                        $img['Tabela_con'] = "produtos";
                        $img['Id_imagem_con'] = $prod->Id_produto;
                        $img['Campo_sel'] = 'Imagens_ico';
                        $img['Caminho_txf'] = "img/{$this->dados_conexao['database']}/{$nome}";

                        $antigas = $this->mbc->executa_sql("select * from imagens where Tabela_con='produtos' and Id_imagem_con='$prod->Id_produto' ");

                        if (!$antigas) {
                            $this->mbc->db_insert('imagens', $img);
                            echo "Imagem inserida para o produto {$prod->Codigo_txf} id {$prod->Id_produto}<br>";
                            $msg = "Imagem inserida para o produto {$prod->Codigo_txf}.. id {$prod->Id_produto}";
                        } else {
                            echo "Imagem atualizada para o produto {$prod->Codigo_txf} id {$prod->Id_produto}<br>";
                            $msg = "Imagem atualizada para o produto {$prod->Codigo_txf}.. id {$prod->Id_produto}";
                        }
                        $this->log_sincro($msg);
                    } else {
                        echo "Imagem não encontrada<br>";
                    }

                    $this->mbc->db_delete("sincro_imagens", "Id_produto", $prod->Id_produto);
                }
            }
        }
    }

    function curlContents($url, $method = 'GET', $data = false, $headers = false, $returnInfo = true) {
        $ch = curl_init();


        $url = str_replace(' ', '%20', $url);


        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data !== false) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        } else {
            if ($data !== false) {
                if (is_array($data)) {
                    $dataTokens = array();
                    foreach ($data as $key => $value) {
                        array_push($dataTokens, urlencode($key) . '=' . urlencode($value));
                    }
                    $data = implode('&', $dataTokens);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $data);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
//        ver($headers);
        if ($headers !== false) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        $contents = curl_exec($ch);

        if ($returnInfo) {
            $info = curl_getinfo($ch);
        }

        curl_close($ch);

        if ($returnInfo) {
            return array('contents' => $contents, 'info' => $info);
        } else {
            return $contents;
        }
    }

    function log_sincro($msg) {
        $array['Data_dat'] = date('Y-m-d H:i:s');
        $array['Mensagem_txf'] = $msg;
        $this->mbc->db_insert("log_sincro", $array);
    }

}

?>