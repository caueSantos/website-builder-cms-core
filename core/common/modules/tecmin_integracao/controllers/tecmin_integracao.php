<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class tecmin_integracao extends lands_core {

    public $sincro_imagens = TRUE;

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
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

    function switch_pagina() {



        switch ($this->pagina_atual) {

            case 'inicio' :
//                $produtos = $this->busca_produtos('warn');
//                ver($produtos);
                break;
            case 'agendados' :
                $agendados = $this->mbc->buscar_completo("sincro_agenda");
//                ver($agendados);
                $this->smarty->assign('agendados', $agendados);
                break;

            default:
                break;
        }
    }

    function sincroniza() {

        echo "Sincronizando TECMIN<br>";
        $this->sincroniza_empresa('tecmin');
        echo "<br><br>Sincronizando WARN<br>";
        $this->sincroniza_empresa('warn');


//        
//         if ($this->uri->segment(2)) {
//            ver($this->uri->segment(2));
//            $empresa = $this->uri->segment(2);
//            $this->agendar_empresa($empresa);
//        } else {
//            $this->agendar_empresa('warn');
//            $this->agendar_empresa('tecmin');
//        }
    }

    function sincroniza_empresa($empresa = null) {
        $this->conecta('integracao');
        $this->conecta_ftp($empresa);
        if ($empresa) {
            $where = " where Empresa_txf='{$empresa}'";
        } else {
            die('empresa necessaria como parametro do sincroniza_empresa');
        }
        $agendados = $this->mbc->executa_sql("select * from sincro_agenda $where");

        $cont = 0;
        if ($agendados[0]) {
            foreach ($agendados as $produto) {

                $this->atualiza_produto($empresa, $produto);
                $cont = $cont + 1;
//                $this->log_sincro("{$produto->Nome_txf} atualizadao");
            }
        } else {
            echo "<br> Nenhum produto agendado";
        }

        echo "<br> $cont produtos atualizados";
    }

    function conecta_ftp($empresa) {

        if ($empresa) {
            $conexao_ftp = $this->mbc->executa_sql("select * from conexoes_ftp where Empresa_txf='$empresa'");

            if ($conexao_ftp[0]) {
                $this->load->library('ftp');
                $config['hostname'] = $conexao_ftp[0]->Servidor_txf;
                $config['username'] = $conexao_ftp[0]->Usuario_txf;
                $config['password'] = $conexao_ftp[0]->Senha_txf;

                $this->configuracoes_ftp = $conexao_ftp[0];

//                ver($config,1);  
                $config['debug'] = FALSE;

                $this->ftp->connect($config);
            } else {
                die("falha ao conectar ftp $empresa");
            }
        } else {
            die("empresa nao passada");
        }
    }

    function atualiza_produto($empresa, $produto) {
        
        $produto_atualizado = new stdClass();
        $revenda = $empresa . "-revenda";
        $this->conecta($revenda);
        $produto_revenda = $this->busca_produtos($revenda, $produto->Cod_referencia_txf);


        if ($produto_revenda[0]) {
            if (count($produto_revenda) > 1) {
                ver("produto {$produto->Cod_referencia_txf} repetido", 1);
                $x = 0;
                foreach ($produto_revenda as $pr) {
                    if ($x > 0) {
                        echo "Excluiu o prod ID - {$pr->Id_int} REF- {$pr->Cod_referencia_txf}";
                        $this->mbc->db_delete("produtos_integrados", 'Id_int', $pr->Id_int);
                    }
                    $x++;
                }
            }


            $produto_atualizado->model = $produto_revenda[0]->Cod_referencia_txf;
            $produto_atualizado->sku = $produto_revenda[0]->Cod_referencia_txf;
            $produto_atualizado->name = $produto_revenda[0]->Nome_produto_txf;
            $produto_atualizado->quantity = $produto_revenda[0]->Estoque_txf;

            $produto_atualizado->weight = $produto_revenda[0]->Peso_txf;
            $produto_atualizado->length = $produto_revenda[0]->Comprimento_txf;
            $produto_atualizado->width = $produto_revenda[0]->Largura_txf;
            $produto_atualizado->height = $produto_revenda[0]->Altura_txf;
            $produto_atualizado->date_modified = $produto_revenda[0]->Data_atualizacao_dat;
            $produto_atualizado->status = $produto_revenda[0]->Ativo_sel;

            if ($produto_revenda[0]->Preco_sugerido_txf) {
                $produto_atualizado->price = $produto_revenda[0]->Preco_sugerido_txf;
            } else {
                $produto_atualizado->price = '99999.99';
                /* log produto sem precovhjk */
            }

//  if($empresa=='warn') {
//      ver('chegou');
//        }
            if ($this->sincro_imagens == TRUE) {
                $produto_atualizado->image = $this->busca_imagem($empresa, $produto, $produto_revenda);
            }

//            ver($produto_atualizado->image);

            $produto_atualizado->weight_class_id = '1';
            $produto_atualizado->stock_status_id = '5';
            $produto_atualizado->language_id = '2';
            $produto_atualizado->minimum = '1';
            $produto_atualizado->subtract = '1';
            $produto_atualizado->shipping = '1';
        } else {
            die("produto {$produto->Cod_referencia_txf} nao encontrado na revenda");
        }

        $this->conecta($empresa);

        switch ($produto->Tipo_txf) {
            
            case 'insert':

                $produto_atualizado->description = $produto_revenda[0]->Nome_produto_txf;
                $produto_atualizado->meta_description = $produto_revenda[0]->Nome_produto_txf;
                $produto_atualizado->meta_keyword = $produto_revenda[0]->Nome_produto_txf;
                $produto_atualizado->tag = $produto_revenda[0]->Nome_produto_txf;
                $produto_atualizado->date_added = $produto_revenda[0]->Data_cadastro_dat;
                $produto_atualizado = object_to_array($produto_atualizado);

                $this->mbc->db_insert('product', $produto_atualizado);
                $product_id = $this->mbc->executa_sql("select * from product order by product_id desc limit 1");

                if ($product_id[0]) {
                    $produto_atualizado['product_id'] = $product_id[0]->product_id;
                    $produto_atualizado['store_id'] = 0;
                    $this->mbc->db_insert('product_description', $produto_atualizado);
                    $this->mbc->db_insert('product_to_store', $produto_atualizado);
                }


                break;

            case 'update':

                $product = $this->busca_produtos($empresa, $produto_atualizado->model);
                if ($product) {
                    if (!$product[0]->description) {
                        $produto_atualizado->description = $produto_revenda[0]->Nome_produto_txf;
                    }
                    if (!$product[0]->meta_description) {
                        $produto_atualizado->meta_description = $produto_revenda[0]->Nome_produto_txf;
                    }
                    if (!$product[0]->meta_keyword) {
                        $produto_atualizado->meta_keyword = $produto_revenda[0]->Nome_produto_txf;
                    }
                    if (!$product[0]->tag) {
                        $produto_atualizado->tag = $produto_revenda[0]->Nome_produto_txf;
                    }

                    $product_id = $product[0]->product_id;
                } else {
                    die("product id nao encontrado do produto $produto_atualizado->name");
                }
                $produto_atualizado = object_to_array($produto_atualizado);

                $this->mbc->updateTable('product', $produto_atualizado, 'product_id', $product_id);
                $this->mbc->updateTable('product_description', $produto_atualizado, 'product_id', $product_id);
                $product_store = $this->mbc->executa_sql("select * from product_to_store where product_id={$product_id}");


                if (!$product_store[0]) {
                    $produto_atualizado['product_id'] = $product_id;
                    $produto_atualizado['store_id'] = 0;
                    $this->mbc->db_insert('product_to_store', $produto_atualizado);
                }

                break;
            default:
                die('tipo de atualizacao nao permitida, funcao atualiza produto');
                break;
        }
        $this->conecta('integracao');
        $this->mbc->deleteRow('sincro_agenda', 'Cod_referencia_txf', "$produto->Cod_referencia_txf");


//        $produto->Data_cadastro_dat = substr($produto->Data_cadastro_dat, 0, -4);
    }

    function busca_imagem($empresa, $produto, $produto_revenda) {

        $produto_ecommerce = $this->busca_produtos($empresa, $produto->Cod_referencia_txf);


        if ($produto_ecommerce[0]) {
            $prod_ecommerce = $produto_ecommerce[0];
        } else {
            $prod_ecommerce = null;
        }

//        ver($produto, 1);
//        ver($produto_ecommerce, 1);

        if ($produto->Imagem_txf) {
//            ver('chegou');
            $imagem = 'data/' . $produto->Imagem_txf;

            $this->transfere_imagem($empresa, $produto, $produto_revenda, $prod_ecommerce);
        } else {
            $imagem = 'data/sem_imagem.jpg';
        }


//        switch ($produto->Tipo_txf) {
//            case 'insert':
//                if ($produto->Imagem_txf) {
//                    $imagem = 'data/' . $produto->Imagem_txf;
//                } else {
//                    $imagem = 'data/sem_imagem.jpg';
//                }
//                break;
//            case 'update':
//                 if ($produto->Imagem_txf) {
//                    $imagem = 'data/' . $produto->Imagem_txf;
//                } else {
//                    $imagem = 'data/sem_imagem.jpg';
//                }
//                break;
//        }

        return $imagem;
    }

    function transfere_imagem($empresa, $produto, $produto_revenda, $produto_ecommerce = null) {

        if (isset($produto_ecommerce)) {
            if ($produto_ecommerce->image == $produto_revenda[0]->Imagens[0]->Caminho_txf) {
                ver('verificar se o arquivo existe');
            } else {
//                $nome_arquivo = str_replace('img/tecminma_revendedores/', '', $produto_revenda[0]->Imagens[0]->Caminho_txf);
//                ver($nome_arquivo,1);
//                ver($produto_revenda[0]->Imagens[0]->Caminho_txf,1);
//                ver('vai na funcao download',1);
//                $this->ftp->download($produto_revenda[0]->Imagens[0]->Caminho_txf, "/home/tecminco/public_html/teste/{$produto_revenda[0]->Imagens[0]->Caminho_txf}", 'ascii');
//                $caminho_servidor='public_html/revendedores/painel/'.$produto_revenda[0]->Imagens[0]->Caminho_txf;
                $origem = 'public_html/revendedores/painel/' . $produto_revenda[0]->Imagens[0]->Caminho_txf;
                switch ($empresa) {
                    case 'tecmin':

                        $destino = "/home/tecminco/public_html/loja/tecmin/image/data/{$produto_revenda[0]->Imagens[0]->Caminho_txf}";
                        break;
                    case 'warn':
                        $destino = "/home/tecminco/public_html/loja/tecmotors/image/data/{$produto_revenda[0]->Imagens[0]->Caminho_txf}";
                        break;
                }
//                ver($caminho_servidor);
//                $this->ftp->hostname = "lands.srv.br";
//                $this->ftp->connect();
                // ver($this->ftp->lista_detalhada("/public_html/"));
//                ver($this->ftp, 1);
//                ver($origem, 1);
//                ver($destino, 1);
//                ver($origem,1);
//                ver($destino,1);
//                 ver($this->ftp);
//                if(file_exists($origem)){
//                    ver('arqivo existe');
//                } else {
//                    ver('arquivo nao existe');
//                }
//               ver('chegou');
//               ver($origem,1);
//               ver($destino,1);

                $this->ftp->download($origem, $destino);
            }
        }
    }

    function agenda($empresa) {
//         $configuracao = $this->mbc->executa_sql("select * from configuracao where Id_int='1000'");
//         ver($configuracao[0]->Ultima_sincronizacao_dat);
        if ($this->uri->segment(2)) {
            $empresa = $this->uri->segment(2);
            $this->agendar_empresa($empresa);
        } else {
            $this->agendar_empresa('warn');
            $this->agendar_empresa('tecmin');
        }
    }

    function agendar_empresa($empresa, $ultima_atualizacao = null) {
        echo "<br>Agendando $empresa<br> ";
        $nome_revenda = $empresa . '-revenda';

        $produtos_revenda = $this->busca_produtos($nome_revenda);
        $produtos_ecommerce = $this->busca_produtos($empresa);
        $cont = 0;
        $cont_ignorados = 0;
        foreach ($produtos_revenda as $prod_revenda) {

            $produto = $this->busca_objeto($produtos_ecommerce, 'model', $prod_revenda->Cod_referencia_txf);
//            if($produto->product_id == 707){
//                ver($produto, 1);
//                ver($prod_revenda);
//            }            
            if ($produto) {

                if ($this->precisa_atualizar($prod_revenda, $produto)) {
                    $cont = $cont + 1;
                    echo "Produto {$prod_revenda->Cod_referencia_txf} ( {$prod_revenda->Nome_produto_txf} ) agendado<br>";
                    $this->agenda_produto($empresa, $prod_revenda, 'update');
                } else {
                    $cont_ignorados = $cont_ignorados + 1;
//                    echo "Atualizacao do produto {$produto->Nome_txf} ignorada<br>";
                }
            } else {
                $cont = $cont + 1;
                $this->agenda_produto($empresa, $prod_revenda, 'insert');
            }
        }
        echo "{$cont_ignorados} produtos ignorados<br>";
        echo "{$cont} produtos agendados<br>";
    }

    function precisa_atualizar($produto_revenda, $produto_ecommerce) {



        if ($this->sincro_imagens == TRUE) {
            $produto_ecommerce->image = str_replace('data/', '', $produto_ecommerce->image);
            if ($produto_revenda->Imagens[0]->Caminho_txf) {

                if ($produto_ecommerce->image != $produto_revenda->Imagens[0]->Caminho_txf) {

                    return true;
                }
            }
        }

        if ($produto_revenda->Preco_sugerido_txf == '0') {
            return false;
        }
        if ($produto_ecommerce->name != $produto_revenda->Nome_produto_txf) {

            return true;
        }
        if ($produto_revenda->Preco_sugerido_txf) {
            if ($produto_ecommerce->price != $produto_revenda->Preco_sugerido_txf) {

                return true;
            }
        } else {
            return false;
        }
        if ($produto_ecommerce->weight != $produto_revenda->Peso_txf) {

            return true;
        }
        if ($produto_ecommerce->width != $produto_revenda->Largura_txf) {

            return true;
        }
        if ($produto_ecommerce->height != $produto_revenda->Altura_txf) {

            return true;
        }
        if ($produto_ecommerce->status != $produto_revenda->Ativo_sel) {

            return true;
        }
        if ($produto_ecommerce->quantity != $produto_revenda->Estoque_txf) {

            return true;
        }
        return false;
    }

    function agenda_produto($empresa, $produto, $tipo = 'update') {

        $this->conecta('integracao');

        $sincro = $this->mbc->executa_sql("select * from sincro_agenda where Empresa_txf='{$empresa}' and Cod_referencia_txf={$produto->Cod_referencia_txf}");
        if ($sincro) {
            //echo "Produto {$produto->Nome_produto_txf} já está na agenda<br>";
        } else {
            $this->agenda_atualizacao($empresa, $produto, $tipo);
        }
    }

    function agenda_atualizacao($empresa, $produto, $tipo) {
        $this->conecta('integracao');
        $array['Tipo_txf'] = $tipo;
        $array['Empresa_txf'] = $empresa;
        $array['Cod_referencia_txf'] = $produto->Cod_referencia_txf;
        $array['Nome_produto_txf'] = $produto->Nome_produto_txf;
        $array['Imagem_txf'] = $produto->Imagens[0]->Caminho_txf;
        if ($this->mbc->db_insert("sincro_agenda", $array)) {
            return true;
        } else {
            return false;
        }
    }

    function busca_objeto($array, $campo, $valor) {
        $chave = null;
        if (is_array($array)) {
            foreach ($array as $chave => $objeto) {
                if ($objeto->$campo == $valor) {
                    return $objeto;
                }
            }
        }
    }

    function log_sincro($msg) {
        $this->conecta('integracao');
        $array['Data_dat'] = date('Y-m-d H:i:s');
        $array['Mensagem_txa'] = $msg;
        $this->mbc->db_insert("log_sincro", $array);
    }

    function busca_produtos($base, $referencia = null) {

        $this->conecta($base);
        if ($base == 'tecmin-revenda' || $base == 'warn-revenda') {
//            $produtos = $this->mbc->executa_sql("select * from produtos_integrados");
            if ($referencia) {
                $produtos = $this->mbc->buscar_completo("produtos_integrados", "where Cod_referencia_txf='{$referencia}'");
            } else {
                $produtos = $this->mbc->buscar_completo("produtos_integrados");
            }
            return $produtos;
        }
        if ($base == 'tecmin' || $base == 'warn') {
            if ($referencia) {
                $produtos = $this->mbc->executa_sql("select * from product p left outer join product_description pd on pd.product_id=p.product_id where p.model='{$referencia}'");
            } else {
                $produtos = $this->mbc->executa_sql("select * from product p left outer join product_description pd on pd.product_id=p.product_id");
            }

            return $produtos;
        }
    }

    function conecta($base) {
        switch ($base) {
            case 'tecmin':
                $this->conecta_mbc(166);
                break;
            case 'warn':
                $this->conecta_mbc(167);
                break;
            case 'tecmin-revenda':
                $this->conecta_mbc(77);
                break;
            case 'warn-revenda':
                $this->conecta_mbc(70);
                break;
            case 'integracao':
                $this->conecta_mbc($this->app->Conexoes_for);
                break;
            default:
                die('base de dados nao identificada');
                break;
        }

        if ($this->mbc->executa_sql('show tables')) {
            return true;
        } else {
            ver("erro ao conectar na base $base");
        }
    }

    /*
      function insere_atualiza($nome,$produto, $produtos_web) {

      $indice = $this->busca_objeto($produtos_web, 'Cod_referencia_txf', $produto->Cod_referencia_txf);

      if ($produto->Data_atualizacao_preco_dat > $produto->Data_atualizacao_dat) {
      $produto->Data_atualizacao_dat = $produto->Data_atualizacao_preco_dat;
      }
      if ($produto->Data_atualizacao_estoque_dat > $produto->Data_atualizacao_dat) {
      $produto->Data_atualizacao_dat = $produto->Data_atualizacao_estoque_dat;
      }
      $produto->Data_cadastro_dat = substr($produto->Data_cadastro_dat, 0, -4);
      $produto->Data_atualizacao_dat = substr($produto->Data_atualizacao_dat, 0, -4);
      $produto->Data_atualizacao_preco_dat = substr($produto->Data_atualizacao_preco_dat, 0, -4);
      $produto->Data_atualizacao_estoque_dat = substr($produto->Data_atualizacao_estoque_dat, 0, -4);


      if ($indice != null) {
      $array = object_to_array($produto);
      if($this->model_banco->updateTable($this->tabela_produtos, $array, 'Cod_referencia_txf', $produto->Cod_referencia_txf)){
      $this->model_banco->deleteRow('sincro_agenda', 'Cod_referencia_txf', "$produto->Cod_referencia_txf");
      }
      $log = "Produto {$produto->Nome_produto_txf} codigo {$produto->Cod_referencia_txf} atualizado; <br>";
      echo $log;
      $this->log_sincro($log);
      return 'atualizado';
      } else {
      $array = object_to_array($produto);
      if($this->model_banco->db_insert($this->tabela_produtos, $array)){
      $this->model_banco->deleteRow('sincro_agenda', 'Cod_referencia_txf', "$produto->Cod_referencia_txf");
      }
      $log = "Produto {$produto->Nome_produto_txf} codigo {$produto->Cod_referencia_txf} inserido; <br>";
      echo $log;
      $this->log_sincro($log);
      return 'inserido';
      }
      }
     */
}

?>