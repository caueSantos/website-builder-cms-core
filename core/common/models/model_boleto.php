<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');

class Model_boleto extends Model_banco_cliente {

    public $db;
    public $app;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app) {
        $this->app = $app;
    }

    function gera_boleto($modelo) {

        $this->verifica_dados($modelo);



        switch ($modelo) {
            case 'boleto_cef_sigcb':
                include(COMMONPATH . 'libraries/boleto/boleto_cef_sigcb.php');
                break;
            case 'boleto_bb':
                include(COMMONPATH . 'libraries/boleto/boleto_bb.php');
                break;
            default:
                die('boleto não habilitado');
                break;
        }

        die();
    }

    function verifica_dados($modelo) {
        $retorno = true;

        if (!$_POST && !$_GET) {
            $mensagem = 'Faltando POST ou GET';
            $retorno = false;
        }

        switch ($modelo) {
            case 'boleto_cef_sigcb':

                break;
            default:

                break;
        }

        if ($retorno == false) {
            $this->erro($mensagem);
        }
    }

    function erro($mensagem = 'Erro desconhecido') {

        echo ($mensagem);
        die();
    }

}

