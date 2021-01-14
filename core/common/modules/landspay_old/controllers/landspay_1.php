<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');
require_once(COMMONPATH . "third_party/pagseguro/PagSeguroLibrary/PagSeguroLibrary.php");

class landspay extends lands_core {

    public $aplicativo;
    public $compra;

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

    function switch_pagina() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_model('model_landspay');
        $this->model_landspay->inicializa($this->app);

        switch ($this->pagina_atual) {
            case 'inicio':

                break;
            case 'pagar':
                $this->valida_pagamento();
                
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

                $pagseguro = $this->executa_sql("select * from pagseguro limit 1");

                if (count($_POST) > 0) {

                    $email = $pagseguro[0]->Email_txf;
                    $token = $pagseguro[0]->Token_txf;
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

                    $_REQUEST['response'] = $response;
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
                $this->model_landspay->gera_lightbox();
                break;
            case 'cielo':
                $dados = array_to_object($_POST);
                $this->model_landspay->pagar_cielo($dados);
                break;
            default:
                die('pagina nao existente');
                break;
        }
    }

    function valida_pagamento() {

        if ($_POST) {

            $id_sistema = $_POST['id_sistema'];
            $referencia = $_POST['referencia'];



            $pagamento = $this->busca_pagamento($id_sistema, $referencia);
            if ($pagamento) {

                $this->mbc->updateTable("pagamentos", $_POST, 'Id_int', $pagamento[0]->Id_int);
                ver('update', 1);
            } else {

                $this->mbc->db_insert("pagamentos", $_POST);
                ver('insert', 1);
            }

            $pagamento_atualizado = $this->busca_pagamento($id_sistema, $referencia);
            if (!$pagamento_atualizado) {
                die('Falha ao registrar o pagamento no banco');
            }
        } else {

            if ($this->uri->segment(2)) {
                $id_app = $this->uri->segment(2);
                $aplicativo = $this->mbc->buscar_completo("aplicativos", "where Id_int='{$id_app}'");
                if ($aplicativo[0]) {
                    $this->aplicativo = $aplicativo[0];
                    $this->smarty->assign("aplicativo", $this->aplicativo);
                } else {
                    die('Aplicativo Invalido');
                }
            } else {
                die('Id do aplicativo faltando');
            }

            if ($this->uri->segment(3)) {
                $id_referencia = $this->uri->segment(3);
                $pagamento = $this->mbc->buscar_completo("pagamentos", "where id_sistema={$this->aplicativo->Id_int} and referencia='{$id_referencia}'");
                if ($pagamento[0]) {
                    $this->pagamento = $pagamento[0];
                    $this->smarty->assign("pagamento", $this->pagamento);
                } else {
                    die('Identificacao de pagamento Invalido');
                }
            } else {
                die('Id do pagamento faltando');
            }
        }
    }

    function busca_pagamento($id_sistema, $referencia) {

        $pagamentos = $this->mbc->buscar_completo("pagamentos", "where id_sistema='{$id_sistema}' and referencia='{$referencia}'");

        if ($pagamentos[0]) {
            $pagamentos[0]->Aplicativo=array();
            $pagamentos[0]->Aplicativo=$this->mbc->buscar_completo("aplicativos", "where Id_int='{$pagamentos[0]->id_sistema}'");
            if(!$pagamentos[0]->Aplicativo[0]){
                die('Aplicativo inválido');
            }
            $this->pagamento = $pagamentos[0];
            $this->smarty->assign("pagamento", $this->pagamento);
        } else {

            $this->pagamento = null;
        }

        return $pagamentos;
    }

    function gera_botoes() {

        $meios = explode(',', $_POST['meios']);
        $dados = array_to_object($_POST);

        foreach ($meios as $meio) {
            switch ($meio) {
                case 'boleto_cef':
                    $this->model_landspay->gera_botao_cef($dados);
                    break;
                case 'boleto_bb':

                    $this->model_landspay->gera_botao_bb($dados);
                    break;
                case 'pagseguro':

                    $this->model_landspay->gera_botao_pagseguro($dados);
                    break;
                case 'cielo':
                    $this->model_landspay->gera_botao_cielo($dados);
                    break;

                default: echo "meio $meio não cadastrado<br>";
                    break;
            }
        }
    }

}

?>