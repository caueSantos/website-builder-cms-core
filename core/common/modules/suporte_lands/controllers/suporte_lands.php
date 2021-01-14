<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class suporte_lands extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
//        ver($_SERVER['REMOTE_ADDR']);
        $this->smarty->assign("ip_usuario", $_SERVER['REMOTE_ADDR']);
    }

    function index() {

        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            try {
                $this->carrega_pagina($this->pagina_atual);
            } catch (Exception $exc) {
                ver($exc->getTraceAsString());
            }
        } else {
            $funcao_atual = $this->pagina_atual;
            //executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
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
            case 'desbloqueio':
                $_POST['Ip_txf'] = $_POST['ip'];

                $retorno = curlContents("http://mail.landsmail.srv.br:7780/desbloqueio.php", 'POST', $_POST, FALSE, TRUE);
//                $retorno = curlContents("http://mail.landsmail.srv.br:7780/desbloqueio2.php", 'POST', $_POST, FALSE, TRUE);
//                $retorno = curlContents("http://goodasdasgle.com.br", 'POST', $_POST, FALSE, TRUE);
//                ver($retorno);
                $retorno_objeto = json_decode($retorno['contents']);

                $array_inserir = $_POST;
                $array_inserir['Tipo_txf'] = $retorno_objeto->type;
                $array_inserir['Retorno_txf'] = $retorno_objeto->message;
                $array_inserir['Data_dat'] = date('Y-m-d H:i:s');

                if ($this->mbc->db_insert('desbloqueios', $array_inserir)) {
                    $this->smarty->assign('mensagem', 'inseriu_ok');
                    $this->smarty->assign('retorno', $retorno_objeto);
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                } else {
                    $this->smarty->assign('mensagem', 'inseriu_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    die();
                }
                break;
        }
    }

    function switch_pagina() {

        switch ($this->pagina_atual) {
            case 'busca':
                $this->fazer_busca();
                break;

            case 'favoritos':


                $registros = $this->mbc->executa_sql("select * from favoritos");
                $this->smarty->assign('favoritos', $registros);


                break;

            case 'desbloqueio-log':
                $this->checa_login('desbloqueio-log');
                $registros = $this->mbc->executa_sql('select * from desbloqueios order by Data_dat desc');
                $this->smarty->assign('registros', $registros);
                break;
        }
    }

    function ajax() {

        $this->conecta_mbc($this->app->Conexoes_for);

        $segmento = (int) $this->app->Segmento_padrao_txf;
        $segmento = $segmento + 1;

        $pagina = $this->uri->segment($segmento);

        switch ($pagina) {


            case 'editar_favorito':

                $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";
                $registro = $this->mbc->executa_sql($sql);
                $this->smarty->assign("registro", $registro[0]);
                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;



            case 'editar_jogo':


                if ($_POST['Id_int']) {
                    $sql = "select * from {$_POST['Tabela_txf']} where Id_int='{$_POST['Id_int']}'";
                    $registro = $this->mbc->executa_sql($sql);
                    $this->smarty->assign("registro", $registro[0]);
                }

                $times = $this->mbc->buscar_completo("times", "order by Nome_txf");

                $this->smarty->assign("times", $times);

                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;
            case 'excluir':

                echo $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'forms', $pagina);
                die();
                break;

            case 'salvar_favorito':
                $this->altera_insere_registro();
                break;

            case 'salvar_excluir':
                $this->exclui_registro();

                break;

            default:
                break;
        }
    }

    function altera_insere_registro() {

        $dados = $_POST;
        if (!$dados['Tabela_txf']) {

            die('Campo Tabela_txf nao encontrado');
        }



        if (!$dados['Id_int']) {
            if ($this->mbc->db_insert($dados['Tabela_txf'], $_POST)) {
                $this->smarty->assign('mensagem', 'inseriu_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'inseriu_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
        } else {
            if ($this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int'])) {
                $this->smarty->assign('mensagem', 'atualizacao_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'atualizacao_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
        }
    }

    

    function exclui_registro() {

        $dados = $_POST;
        if (!$dados['Tabela_txf']) {
            die('Campo Tabela_txf nao encontrado');
        }
        if (!$dados['Id_int']) {
            die('Id_in nao passado');
        }
        $tabela = $_POST['Tabela_txf'];
        $id = $_POST['Id_int'];


        $sql = "select * from $tabela where Id_int=$id";
        $registro = $this->mbc->executa_sql($sql);

        if ($registro[0]) {
            if ($this->mbc->db_delete($tabela, 'Id_int', $id)) {
                $this->smarty->assign('mensagem', 'excluiu_ok');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'excluiu_erro');
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
            }
        } else {
            $this->smarty->assign('mensagem', 'registro_inexistente');
            $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
        }
    }

}

?>