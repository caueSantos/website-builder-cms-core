<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');

class Model_pagseguro extends Model_banco_cliente {

    public $db;
    public $app;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function verifica_dados($modelo) {
        $retorno = true;

        if (!$_POST && !$_GET) {
            $mensagem = 'Faltando POST ou GET';
            $retorno = false;
        }

        switch ($modelo) {
            case 'lightbox':

                break;
            default:

                break;
        }

        if ($retorno == false) {
            $this->erro($mensagem);
        }
    }

    public function gera_lightbox() {
        $quantidade = $_POST['quantidade'];
        $referencia = $_POST['referencia'];
        $clientenome = $_POST['clientenome'];
        $clienteemail = $_POST['clienteemail'];
        $valor = str_replace(",", ".", $_POST['valor']);
        $produto = $_POST['produto'];

        // Instantiate a new payment request
        $paymentRequest = new PagSeguroPaymentRequest();
        // Set the currency
        $paymentRequest->setCurrency("BRL");
        // Add an item for this payment request
        $paymentRequest->addItem('0001', $produto, $quantidade, $valor);

        // Set a reference code for this payment request, it is useful to identify this payment in future notifications.
        $paymentRequest->setReference($referencia);

        $paymentRequest->setSender(
                $clientenome, $clienteemail
        );

        // Set the url used by PagSeguro to redirect user after checkout process ends
        $paymentRequest->setRedirectUrl("https://landshosting.com.br/subdominios/landspay/retorno_pagseguro");

        // Add checkout metadata information
//        $paymentRequest->addMetadata('PASSENGER_CPF', '15600944276', 1);
//        $paymentRequest->addMetadata('GAME_NAME', 'DOTA');
//        $paymentRequest->addMetadata('PASSENGER_PASSPORT', '23456', 1);
        // Another way to set checkout parameters
//        $paymentRequest->addParameter('notificationURL', 'http://aluguebrinquedo.com.br/');
//        $paymentRequest->addParameter('senderBornDate', '07/05/1981');
//        $paymentRequest->addIndexedParameter('itemId', '0003', 3);
//        $paymentRequest->addIndexedParameter('itemDescription', 'Notebook Preto', 3);
//        $paymentRequest->addIndexedParameter('itemQuantity', '1', 3);
//        $paymentRequest->addIndexedParameter('itemAmount', '200.00', 3);

        try {

            /*
             * #### Credentials #####
             * Replace the parameters below with your credentials
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */

            // seller authentication
            $credentials = new PagSeguroAccountCredentials("eventos@landshosting.com.br",
                            "14BB1BC761D2479F8D13D3F12841388C");
//            $credentials = new PagSeguroAccountCredentials("guvedana@gmail.com",
//                            "6EC5DA012B8146589A87C29C038FF0A5");
            // Register this payment request in PagSeguro to obtain the checkout code
            $onlyCheckoutCode = true;
            $code = $paymentRequest->register($credentials, $onlyCheckoutCode);


            $_POST['codigo'] = $code;
            $this->mbc->db_insert('requisicoes_pagseguro', $_POST);
            $this->smarty->assign('codigo_pagseguro', $code);

//            self::printPaymentUrl($code);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    function erro($mensagem = 'Erro desconhecido') {

        echo ($mensagem);
        die();
    }

}

