<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');
require_once(COMMONPATH . "third_party/pagseguro/PagSeguroLibrary/PagSeguroLibrary.php");



class landspay extends lands_core {

    public function __construct() {
        parent::__construct();

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        $this->load->model('model_boleto');


        $this->model_boleto->inicializa($this->app);
        $this->load->model('model_pagseguro');
        $this->model_pagseguro->inicializa($this->app);
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
        $this->conecta_mbc($this->app->Conexoes_for);



        switch ($this->pagina_atual) {
            case 'inicio':
//                ver($_POST, 1);
                $this->gera_botoes();
                break;
            case 'retornos':


                $retornos = $this->mbc->executa_sql('select * from retornos order by Id_int DESC ');
                foreach ($retornos as $retorno) {
                    $retorno->Request_txf = json_decode($retorno->Request_txf);
                }
                $this->smarty->assign('retornos', $retornos);
                break;

            case 'retorno_pagseguro':


                $objeto = new stdClass();





                if (count($_POST) > 0) {

                    $email = "eventos@landshosting.com.br";
                    $token = "14BB1BC761D2479F8D13D3F12841388C";
                    $notificationCode = $_POST['notificationCode'];
                    $url = "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/" . $notificationCode . "?email=" . $email . "&token=" . $token;

                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($curl);
                   
                    $http = curl_getinfo($curl);

                    if ($response == 'Unauthorized') {
                        print_r($response);
                        exit;
                    }
                    curl_close($curl);
                    $response = simplexml_load_string($response);

                    $_REQUEST['response']=$response;
                    if (count($response->error) > 0) {
                        print_r($response);
                        exit;
                    }
                     
//                    $hour = date("H:i:s T");
//                    $_REQUEST['Hora da consulta'] = $hour;
//                    $_REQUEST['http'] = $http['http_code'];
//                    $_REQUEST['codigo_notificacao'] = $notificationCode;
//                    $_REQUEST['codigo_transacao'] = $response->code;
//                    $_REQUEST['status_transacao'] = $response->status;
                }

                $objeto->Request_txf = json_encode($_REQUEST);
                $objeto->Data_dat = date('Y-m-d H:i:s');
                $this->mbc->db_insert('retornos', $objeto);

                die();
                break;
            case 'pagseguro':
//                ver($_POST, 1);
                $this->model_pagseguro->gera_lightbox();
                break;
            default:
                die('pagina nao existente');
                break;
        }
    }

    function gera_botoes() {
        
        
        if ($_POST['boleto_cef_sigcb']['agencia']) {
            $this->model_boleto->verifica_dados('boleto_cef_sigcb');
            $dadosbolet = $_POST['boleto_cef_sigcb'];
            $dadosboleto = array_to_object($dadosbolet);
            $this->smarty->assign('dadosboleto_cef_sigcb', $dadosboleto);
            $this->model_smarty->carrega_bloco('botao_boleto_cef_sigcb', 'botao_boleto_cef_sigcb', $this->app->Template_txf);
        }

        if ($_POST['boleto_bb']['agencia']) {
            $this->model_boleto->verifica_dados('boleto_bb');
            $dadosbolet = $_POST['boleto_bb'];
            $dadosboleto = array_to_object($dadosbolet);
            
            $this->smarty->assign('dadosboleto_bb', $dadosboleto);
            $this->model_smarty->carrega_bloco('botao_boleto_bb', 'botao_boleto_bb', $this->app->Template_txf);
        }

        if ($_POST['pagseguro']['valor']) {
            $this->model_pagseguro->verifica_dados('lightbox');
            $dadospagsegur = $_POST['pagseguro'];
            $dadospagseguro = array_to_object($dadospagsegur);
            $this->smarty->assign('dadospagseguro', $dadospagseguro);
            $this->model_smarty->carrega_bloco('botao_pagseguro', 'botao_pagseguro', $this->app->Template_txf);
        }
    }

}

?>