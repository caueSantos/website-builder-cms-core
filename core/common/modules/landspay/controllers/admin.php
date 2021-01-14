<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'modules/landspayv2/controllers/landspayv2.php');

class admin extends landspayv2 {

    public $modulo = 'admin';
    public $sistema;
    public $compra;
    public $id_sistema = 3;

    public function __construct() {
        parent::__construct();

//        $this->load->helper('landspay');

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'admin');
        echo "redirecionando para v2...";
        redireciona("https://landspay.landshosting.com.br/v2/admin/");


        $this->checa_login('admin/recebimentos');
        $this->inicializa();

//       
    }

    function inicializa() {
        $this->usuario = $this->session->userdata['usuario'];
        $this->carrega_model('model_recebimento');
        $this->model_recebimento->inicializa($this->app, $this->cliente);
        $this->sistema = $this->model_recebimento->busca_sistema_nome($this->usuario->Nome_txf);

        $this->smarty->assign("sistema", $this->sistema);
        $this->id_sistema = $this->sistema->Id_int;
        $this->smarty->assign('modulo', $this->modulo);
        $this->conecta_mbc(0);
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

    function enviar() {
        $this->carrega_model('model_landspay');

//        $this->model_moip->inicia_moip(3);


        $pagina = $this->uri->segment(3);

        switch ($pagina) {
            case 'atualiza_registro':

                $dados = $_POST;
                if (!isset($dados['Tabela_txf']))
                    die('Campo Tabela_txf nao encontrado');
                if (!isset($dados['Id_int']))
                    die('Campo Id_int nao encontrado');
//            $dados['Ultima_atualizacao_dat'] = retorna_date_time();
                if ($this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int'])) {
                    $mensagem = "atualizou_ok";
                } else {
                    $mensagem = "atualizou_erro";
                }
                $this->smarty->assign('mensagem', $mensagem);
                $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

                die();

//                if($_SERVER['HTTP_REFERER']){
//                    redirect($_SERVER['HTTP_REFERER']);
//                } else {
//                    redirect($_POST['pagina_anterior']);
//                }


                break;
            case 'requisicoes':


                $dados = array_to_object($_POST);
                $requisicoes = $this->model_recebimento->busca_requisicoes('log_requisicoes', $dados->Id_int);

                $this->smarty->assign('requisicoes', $requisicoes);
                $dados = array_to_object($_POST);
                $retornos = $this->model_recebimento->busca_requisicoes('log_retornos', $dados->Id_int);
                $this->smarty->assign('retornos', $retornos);



                $this->model_smarty->render_ajax('requisicoes', $this->app->Template_txf);

                break;
        }
    }

    function switch_pagina() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_model('model_landspay');


        $where = "";
        if ($this->usuario) {
            if ($this->usuario->Nivel_sel != 5) {

                $where = "where id_sistema=$this->id_sistema";
            }
        }

//ver($this->usuario);
//        $this->model_moip->inicia_moip(3);

        switch ($this->pagina_atual) {
            case 'inicio':

                break;
            case 'admin':
                $recebimentos = $this->model_recebimento->busca_recebimentos_sistema($this->id_sistema);
                $this->smarty->assign('recebimentos', $recebimentos);
                break;

            case 'retornos':
                $retornos = $this->mbc->executa_sql('select * from retornos order by Id_int DESC ');
                foreach ($retornos as $retorno) {
                    $retorno->Request_txf = json_decode($retorno->Request_txf);
                }
                $this->smarty->assign('retornos', $retornos);
                break;

            case 'recebimentos_retornos':
                die('aguarde, em desenvolvimento');
                $retornos = $this->mbc->executa_sql("select * from recebimentos_retornos $where order by Id_int DESC ");
                foreach ($retornos as $retorno) {

                    $retorno->Retorno = json_decode($retorno->retorno_jso);
                    if ($retorno->meio == 'moip') {
                        $retorno->usuario = $retorno->Retorno->customer->fullname;
                        $retorno->status = $retorno->Retorno->payment->status;
                    }
                }
                $this->smarty->assign('retornos', $retornos);
                break;

            case 'recebimentos':
                $recebimentos = $this->model_recebimento->busca_recebimentos_sistema($this->id_sistema);
                $this->smarty->assign('recebimentos', $recebimentos);
                break;
        }
    }

}

?>