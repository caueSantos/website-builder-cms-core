<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_apps.php');

class apps extends lands_apps {

    public function __construct() {
        parent::__construct();

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

    function breka() {
        ver('chegou');
    }

    function switch_pagina() {
        switch ($this->pagina_atual) {
            case 'mural':
//                $this->checa_login();
                break;
            default:
                break;
        }
        $this->smarty->assign('this', $this);
    }

    function enviar() {


        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;
        if ($this->uri->segment($segmento)) {
            $segmento_post = $this->uri->segment($segmento);
        } else {
            $segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
        }
        switch ($segmento_post) {


            case 'cadastro':



                if (!isset($_POST['Email_txf'])) {
                    die('campo email nao foi enviado');
                }
                $tabela = 'users';

                //verifica se existe algum registro com o e-mail associado
                $email = $_POST['Email_txf'];
                $sql = "select * from $tabela where Email_txf = '$email'";
                $email_bd = $this->mbc->executa_sql($sql);
                //ver($x);
                if (isset($email_bd[0]->Id_int)) {
                    $this->smarty->assign('mensagem', 'email_ja_existe');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                }

//insere registro

                if ($this->mbc->db_insert($tabela, $_POST)) {

                    $link = $this->app->Url_cliente . "fazer_login?Email_txf={$_POST['Email_txf']}&auto=TRUE";


                    $email = $_POST;
                    if (!isset($email['Assunto_txf'])) {
                        $email['Assunto_txf'] = 'Cadastro no Site ' . $this->app->Nome_app_txf;
                    }
                    $this->smarty->assign('cadastro', $_POST);

                    if ($this->envia_email($email, 'cadastro')) {


                        if ($_REQUEST['redirect_link']) {
                            $link.="?redirect_link={$_REQUEST['redirect_link']}";
                        }

                        

                        $this->smarty->assign('mensagem', 'cadastro_inserido');
                        $this->smarty->assign('link_redirect', $link);
                        $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                        
//                        redireciona($link);
                        
                    } else {

                        $this->smarty->assign('mensagem', 'cadastro_erro');
                        $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    }
                    die();
                } else {
                    ver("nao inseriu");
                    $this->smarty->assign('mensagem', 'cadastro_erro');
                    $this->model_smarty->render_ajax('mensagens_cadastro', $this->app->Template_txf);
                    die();
                }

                break;
        }
    }

}

