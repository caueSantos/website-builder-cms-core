<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

//require(COMMONPATH . 'third_party/mercadolivre/Meli/meli.php');

class mercadolivre extends lands_core {

//    public $id = 7840993360035091;
//    public $key = 'SI6CdtOrJwcOm2pFYBbRAUinvl9xMcJP';
//    public $code = "TG-5c347fe211f1be0006da95df-83879956";
//    public $redirect_uri = "https://joiasturmalina.com.br/mercadolivre/login_ml";
//    public $access_token="APP_USR-7840993360035091-010806-394d61dc88c7c77aea35de00c34356c8-83879956";
//    public $site = "MLB";


    public function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf + 1);

        $this->carrega_app();
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

    function carrega_app() {

        $this->load->library("mercadolivrelib");
        $this->mercadolivrelib->inicializa($this->app);
    }

    function switch_pagina() {

        if ($this->pagina_atual != 'login_ml') {
            $this->mercadolivrelib->carrega_chaves();
        }
        switch ($this->pagina_atual) {

            case 'me':
                $dados = $this->mercadolivrelib->get_user();
                ver($dados);

                break;

            case 'anuncios':

                $id_anuncio = str_replace("-", "", $this->uri->segment(3));
                $anuncio = $this->mercadolivrelib->get_anuncio($id_anuncio);


                ver($anuncio);

                break;

            case 'oauth':
                $link = "https://auth.mercadolivre.com.br/authorization?response_type=code&client_id={$this->id}";
//                ver($link);
                redirect($link);
                break;

            case 'notificacoes':


                ver('chegou');

                break;
            case 'login_ml':

                $this->mercadolivrelib->login();

                break;


                break;
            case 'lista':

                $produtos = $this->mbc->buscar_completo("produtos", "where Id_mercadolivre_txf!=''");
                $this->smarty->assign("produtos", $produtos);

                break;

            case 'sincro':

                if ($this->uri->segment(3)) {
                    $id_produto = $this->uri->segment(3);
                } else {
                    $id_produto = null;
                }
                $this->sincroniza($id_produto);

                die();

                break;

            default:



                break;
        }
    }

    function sincroniza($id_produto = null) {

        $where = " where Id_mercadolivre_txf!=''";
        if ($id_produto) {
            $where.= " and Id_int={$id_produto}";
        }
        $produtos = $this->mbc->buscar_completo("produtos", "$where");
        if ($produtos[0]) {
            foreach ($produtos as $produto) {

                echo "Atualizando {$produto->Id_int} - {$produto->Nome_txf} <br>";
                $produto_ml = $this->mercadolivrelib->get_anuncio($produto->Id_mercadolivre_txf);
//                    ver($this->dados_conexao);
//ver($produto_ml);
                if ($produto_ml) {
                    $produto_atualizar['Nome_txf'] = $produto_ml->title;
                    $produto_atualizar['Preco_txf'] = $produto_ml->price;
                    $produto_atualizar['Descricao_txa'] = $produto_ml->descricao->plain_text;
                    $produto_atualizar['Estoque_txf'] = $produto_ml->available_quantity;
                    $produto_atualizar['Link_txf'] = $produto_ml->permalink;


                    foreach ($produto_ml->attributes as $atributo) {
                        if ($atributo->id == 'MATERIAL') {
                            $produto_atualizar['Materia_prima_txf'] = $atributo->value_name;
                        }
                        if ($atributo->id == 'BRAND') {
                            $produto_atualizar['Marca_txf'] = $atributo->value_name;
                        }
                        if ($atributo->id == 'MODEL') {
                            $produto_atualizar['Modelo_txf'] = $atributo->value_name;
                        }
                        if ($atributo->id == 'ITEM_CONDITION') {
                            $produto_atualizar['Tipo_sel'] = $atributo->value_name;
                        }
                        if ($atributo->id == 'SIZE') {
                            $produto_atualizar['Tamanho_txf'] = $atributo->value_name;
                        }
                    }


//                    ver($produto_atualizar);

                    $this->mbc->updateTable("produtos", $produto_atualizar, 'Id_int', $produto->Id_int, TRUE);


                    if (count($produto->Imagens) != count($produto_ml->pictures)) {
                        $this->deleta_imagens($produto->Id_int);
                        $this->insere_imagens($produto->Id_int, $produto_ml);
                    }
                }
            }
        } else {
            die("nenhum produto encontrado");
        }
    }

    function deleta_imagens($id_produto) {

        $imagens = $this->mbc->executa_sql("select * from imagens where Tabela_con='produtos' and Id_imagem_con={$id_produto}");
        echo "excluindo imagens do produto {$id_produto}";
        if ($imagens[0]) {
            foreach ($imagens as $imagem) {
                $this->mbc->db_delete("imagens", "Id_int", $imagem->Id_int);

                $link_arquivo = FCPATH . "painel/{$imagem->Caminho_txf}";
//            ver("vai deletar $link_arquivo");
                if (file_exists($link_arquivo)) {
                    unlink($link_arquivo);
                }
            }
        }
    }

    function insere_imagens($id_produto, $produto_ml) {
        echo "inserindo imagens produto {$id_produto} <br>";


        foreach ($produto_ml->pictures as $imagem) {
            $nome = $this->busca_imagem($imagem->url);
//            ver($nome);
            if ($nome) {
                $img = array();
                $img['Tabela_con'] = 'produtos';
                $img['Id_imagem_con'] = $id_produto;
                $img['Campo_sel'] = 'Imagens_ico';
                $img['Caminho_txf'] = "img/{$this->dados_conexao['database']}/{$nome}";
                $this->mbc->db_insert('imagens', $img);
            }
        }
    }

    function busca_imagem($url_img) {






// URL completa da imagem no sistema AutoGestor.
//        $url_img = 'http://autogestor.net/imagens/auto-gestor.png';
//        
// Coleta apenas o nome e extensão da imagem.
        $img_nome = substr($url_img, strrpos($url_img, '/') + 1);
// Diretório onde será salva a imagem.
        $dir = "painel/img/{$this->dados_conexao['database']}/";


//file_get_contents("http://example.com/", 0, $ctx); 
// Le o conteúdo do arquivo no sistema AutoGestor.
        $get_img = file_get_contents($url_img);
// Caso a leitura obtenha sucesso...
        if ($get_img) {
            // Salva a imagem no servidor onde está o site do Cliente.

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

}

?>