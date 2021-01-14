
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class landing extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->load->helper('landing');

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
                if (!is_lands()) {
                    die('Acesso negado!');
                }
                $where = " where Ativo_sel='SIM' ";

                $landings = $this->mbc->buscar_completo('landing_pages', $where);

           

                foreach ($landings as $landing) {
                    $landing->Layout = $this->mbc->executa_sql("select * from layouts where Nome_txf='{$landing->Layout_sel}'");
                }
                $this->landings = $landings;
                $this->smarty->assign('landings', $landings);
                
                

                break;

            case 'agradecimento':
                
                if ($this->mbc->tabelaexiste('agradecimento')) {

                    $pagina_agradecimento = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                    $where = " where Id_int is not null ";
                    $where.=" and Url_amigavel_txf='{$pagina_agradecimento}'";
                    $where.=" order by Id_int desc";
                    $agradecimento = $this->mbc->buscar_completo('agradecimento', $where);
                    $this->smarty->assign('agradecimento', $agradecimento[0]);

                    $url_relacionada = $_REQUEST['relacionada'];
                    if ($url_relacionada) {
                        $where2 = " where Id_int is not null ";
                        $where2.=" and Url_amigavel_txf='{$url_relacionada}'";
                        $where2.=" order by Id_int desc";
                        $relacionada = $this->mbc->buscar_completo('landing_pages', $where2, 'Imagem_ico');
                    }else if(isset($_REQUEST['landing'])){
                        $where2 = " where Id_int is not null ";
                        $where2.=" and Url_amigavel_txf!='{$_REQUEST['landing']}'";
                        $where2.=" order by Id_int desc";
                        $relacionada = $this->mbc->buscar_completo('landing_pages', $where2, 'Imagem_ico');
                    }
                    $this->smarty->assign('relacionadas', $relacionada);                    
                    
                } else {
                    die('Modulo de agradecimento não configurado');
                }
//
//                ver($relacionada, 1);
//                ver($agradecimento, 1);
                $landings[0]->Layout_sel = "padrao";
                $this->smarty->assign('landings', $landings);


//                $this->pagina_atual = 'agradecimento';
//                $this->model_smarty->render_tpl('agradecimento/' . 'agradecimento', $this->app->Template_txf);
//
//                die();
//                if (!file_exists(COMMONPATH . "../templates/{$this->app->Template_txf}{$this->pagina_atual}.tpl")) {
////                    ver(COMMONPATH."../templates/{$this->app->Template_txf}{$this->pagina_atual}.tpl");
//                    $this->pagina_atual = 'padrao';
//                } else {
////                    ver('existe');
//                }

                break;
            default:

                $where = " where Id_int is not null ";
                $where.=" and Url_amigavel_txf='{$this->pagina_atual}'";
                $where.=" order by Id_int desc";

                $landings = $this->mbc->buscar_completo('landing_pages', $where, 'Imagem_ico');
                foreach ($landings as $landing) {
                    $landing->Layout = $this->mbc->executa_sql("select * from layouts where Nome_txf='{$landing->Layout_sel}'");
                    $sql = "select c.*, f.Required_sel from fields f left outer join campos c on c.Label_txf=f.Campo_sel where Id_objeto_con={$landing->Id_int} and Tabela_con='landing_pages' order by Ordenacao_txf ";

                    $landing->Campos = $this->mbc->executa_sql($sql);
                    $seo = new stdClass();
                    $seo->Descricao_sma = corta_texto($landing->Texto_txa, 140);
                    $seo->Imagem_sma = $this->app->Url_cliente . $this->app->Pasta_painel . $landing->Imagens[0]->Caminho_txf;
                    $seo->Titulo_sma = $landing->Titulo_txf;
//                    $this->smarty->assign('seo',$seo);
                    $landing->Seo = $seo;

                    
                }

                $landing_background = $this->mbc->buscar_completo('landing_pages', $where, 'Background_ico');

                $this->landings = $landings;

                if ($landings[0]->Limite_inscricao_int) {
                    $total = $this->mbc->executa_sql("select count(*) as total from leads where Id_objeto_con = '{$landings[0]->Id_int}' and Tabela_con = 'landing_pages'");
                    $total = $total[0]->total;
                    $sem_vagas = $total >= $landings[0]->Limite_inscricao_int;
                    $this->smarty->assign('total_inscritos', $total);
                    $this->smarty->assign('sem_vagas', $sem_vagas);
                }

                if ($landings[0]->Agradecimento_sel) {                    
                    $redirect_link = $this->app->Url_cliente . "agradecimento/" . $landings[0]->Agradecimento_sel . "?landing=" . $landings[0]->Nome_url . "&relacionada=" . $landings[0]->Relacionada_sel;
                    $this->smarty->assign('redirect_link', $redirect_link);
                }

                $this->smarty->assign('landings', $landings);

                $this->smarty->assign('landing_background', $landing_background);
                if (!file_exists(COMMONPATH . "../templates/{$this->app->Template_txf}{$this->pagina_atual}.tpl")) {
//                    ver(COMMONPATH."../templates/{$this->app->Template_txf}{$this->pagina_atual}.tpl");
                    $this->pagina_atual = 'padrao';
                } else {
//                    ver('existe');
                }

                break;
        }
    }

    function executa_seo() {
//        $pagina_atual=$this->pagina_atual
        $pagina = $this->uri->segment($this->app->Segmento_padrao_txf);
        $pagina = ($pagina != "" ? $pagina : $this->app->Pagina_inicial_txf);
//        ver($this->pagina_atual); 
        $this->conecta_mbc($this->app->Conexoes_for);
        if ($this->mbc->tabelaexiste('seo')) {
            $dados_seo = $this->mbc->buscar_tudo("seo", "where Pagina_txf='{$pagina}' and Ativo_sel='SIM'");
            if (!$dados_seo[0]) {
                $dados_seo = $this->mbc->buscar_tudo("seo", "where Pagina_txf='default' and Ativo_sel='SIM'");
            }
            
            if ($dados_seo[0]) {
                foreach ($dados_seo as $seo) {

                    foreach ($seo as $key => $value) {
                        $seo->$key = $this->smarty->fetch("string:{$value}");
                    }
                }

                $dados_seo[0]->Titulo_sma = trim(strip_tags($seo->Titulo_sma, '<(.*?)>'));
                $dados_seo[0]->Descricao_sma = trim(strip_tags($seo->Descricao_sma, '<(.*?)>'));
                $dados_seo[0]->Imagem_sma = trim(strip_tags($seo->Imagem_sma, '<(.*?)>'));
            } else {
                $dados_seo[0]->Titulo_sma = $this->app->Titulo_txf;
                $dados_seo[0]->Descricao_sma = $this->app->Descricao_txf;
            }


            $dados_seo_final = $this->mbc->complementa_registros($dados_seo, 'seo');



            /* CRIA AS VARIAVEIS FINAL DO SEO */
            $descricao = trim(strip_tags($dados_seo_final[0]->Descricao_sma, '<(.*?)>'));
            $this->smarty->assign('descricao', $descricao);

            $social_titulo = trim(strip_tags($dados_seo_final[0]->Titulo_sma, '<(.*?)>'));
            $this->smarty->assign('social_titulo', $social_titulo);



            if ($dados_seo_final[0]->Imagens[0]->Caminho_txf) {

                $social_imagem = $this->app->Url_cliente . $this->app->Pasta_painel . $dados_seo_final[0]->Imagens[0]->Caminho_txf;
            } else {
                $social_imagem = "{$dados_seo_final[0]->Imagem_sma}";
            }
            $this->smarty->assign('social_imagem', $social_imagem);



            $this->smarty->assign('seo', $dados_seo_final[0]);
         
        }
    }

}

?>