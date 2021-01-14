<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');

//require COMMONPATH . 'third_party/moip/vendor/autoload.php';

use Cielo\API30\Merchant;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;
use Cielo\API30\Ecommerce\Request\CieloRequestException;

//
//use Moip\Moip;
//use Moip\MoipBasicAuth;

class Model_cielo extends Model_banco_cliente {

    public $db;
    public $app;
    public $merchantId = 'f13a58fc-ab16-46fe-96a3-bceacd4fce08';
    public $merchantKey = "XcfCScIDXHySGmpNNIGOiACHnPgDZuLfpPJtPGAw";
    public $ambiente = 'PRODUCAO';
    public $sistema;
    public $endpoint;
    public $conta_cielo;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null, $sistema = null, $conta_cielo = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }

        $this->sistema = $sistema;

        $this->conta_cielo = $conta_cielo;
        $this->load->helper('landspay');

        $this->merchantId = $this->conta_cielo->merchantid;
        $this->merchantKey = $this->conta_cielo->merchantkey;
        $this->ambiente = $this->conta_cielo->ambiente;

        switch ($this->ambiente) {
            case 'PRODUCAO':
                $this->endpoint = "https://api.cieloeCommerce.cielo.com.br/1/sales/";
                $this->endpointquery = 'https://apiquery.cieloecommerce.cielo.com.br/1/sales/';
                break;

            default:

                $this->endpoint = "https://apisandbox.cieloeCommerce.cielo.com.br/1/sales/";
                $this->endpointquery = 'https://apiquerysandbox.cieloecommerce.cielo.com.br/1/sales/';

                break;
        }
//        $this->app_id = "APP-KCM1YBBDN23W";
    }

//    public function verifica_pagamento_duplo($recebimento) {
//        if (!$recebimento->id_meio) {
//            return false;
//        }
//
//        $id_pagto = $recebimento->id_meio;
//
//        $pagamento = $this->busca_pagamento($id_pagto);
//
//        $status_ingles = $pagamento->status;
//
//        $status = $this->trata_status_moip($status_ingles);
////        ver($status);
//        $recebimento_atualizado = $this->model_recebimento->atualiza_status($recebimento->Id_int, 'moip', $status, $this->conta_moip->Tipo_sel);
//
//
//
//        return $recebimento_atualizado;
//    }
    public function busca_pagamento($id_pagamento) {

//$environment = $environment = Environment::sandbox();
//ver('chegou');
//
//// Configure seu merchant
//$merchant = new Merchant($this->merchantId, $this->merchantKey);

        /* SANDBOX */
        $ch = curl_init($this->endpointquery . $id_pagamento);
//        ver($id_pagamento, 1);
//        ver($this->merchantId, 1);
//        ver($this->merchantKey, 1);
//         ver($this->endpoint.$id_pagamento);
        curl_setopt_array($ch, array(
            CURLOPT_POST => FALSE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "MerchantId: {$this->merchantId}",
                "MerchantKey: {$this->merchantKey}",
                "RequestId: {$RequestId}",
            ),
        ));

//$this->armazena_requisicao($dados, $postData, 'cielo');
// Send the request
        $response = curl_exec($ch);
//        ver($response);
// Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }

// Decode the response
//        ver($response,1);
//        ver($postData);

        $resposta = json_decode($response, TRUE);

        return $resposta;
    }

    function trata_status_cielo($status_id) {

        switch ($status_id) {


            case 1:
            case 2:
                $status = 'pago';
                break;
            case 0:
            case 12:
                $status = 'aguardando';
                break;
            case 3:
            case 10:
            case 11:
            case 2:
            case 13:
                $status = 'cancelado';
                break;
            default :
                $status = 'cancelado';
                break;
        }
        return $status;
    }

    public function processa_pagamento_transparente($dados, $recebimento, $usuario, $sistema) {

        $referencia = $recebimento->referencia;


        $recebimento_existente = $this->model_recebimento->busca_recebimento($sistema->Id_int, $recebimento->referencia);



        if ($recebimento_existente) {


            switch ($recebimento_existente->status) {
                case 'pago':
                    $resposta->pagamento_duplo = true;

                    return $resposta;
                    break;

                default:
                    break;
            }
        }



//
//        $MerchantId = $dados->merchantid;
//        $MerchantKey = $dados->merchantkey;

        $RequestId = '';
//ver($dados);
        $dados->CardNumber = str_replace(' ', '', $dados->payment->credit_card->number);
        $dados->ExpirationDate = $dados->payment->credit_card->expiration_month . '/' . $dados->payment->credit_card->expiration_year;
        $dados->brand = getCardBrand($dados->CardNumber);

//ver($dados->ExpirationDate);
//       $recebimento->valor = str_replace('.', '', $recebimento->valor);
//        ver($recebimento->valor);
// The data to send to the API
        switch ($dados->payment->method) {
            case 'CREDIT_CARD':
                $postData = array(
                    "MerchantOrderId" => "{$recebimento->referencia}",
                    "Customer" => array("Name" => "{$recebimento->nome}"),
                    "Payment" => array(
                        "Type" => "CreditCard",
                        "Amount" => $recebimento->valor * 100,
                        "Installments" => $dados->parcelas,
                        "ServiceTaxAmount" => 0,
                        "Capture" => TRUE,
//                        "Provider" => "Bradesco",
//                        "Currency" => "BRL",
//                        "Country" => "BRA",
//                        "ReturnUrl" => "http://landsdigital.com.br/",
                        "CreditCard" => array("CardNumber" => "{$dados->CardNumber}",
                            "Holder" => "{$dados->payment->credit_card->holder}",
                            "ExpirationDate" => "{$dados->ExpirationDate}",
                            "SecurityCode" => "{$dados->payment->credit_card->cvc}",
                            "Brand" => "{$dados->brand}"
                        )
                    )
                );
                $ch = curl_init($this->endpoint);
//                $ch = curl_init('https://api.cieloeCommerce.cielo.com.br/1/sales/');
                break;
            case 'DebitCard':
                die('debit not exists');
                $postData = array(
                    "MerchantOrderId" => "{$recebimento->referencia}",
                    "Customer" => array("Name" => "{$recebimento->nome}"),
                    "Payment" => array(
                        "Type" => "DebitCard",
                        "Amount" => $recebimento->valor,
                        "Provider" => "Cielo",
                        "Authenticate" => true,
//                        "ReturnUrl" => "",
//                        "ReturnUrl" => "$dados->url_retorno",
                        "DebitCard" => array("CardNumber" => "{$dados->CardNumber}",
                            "Holder" => "{$dados->Holder}",
                            "ExpirationDate" => "{$dados->ExpirationDate}",
                            "SecurityCode" => "{$dados->SecurityCode}",
                            "Brand" => "{$dados->Brand}"
                        )
                    )
                );
                /* SANDBOX */
                $ch = curl_init($this->endpoint);
//                $ch = curl_init('https://apisandbox.cieloeCommerce.cielo.com.br/1/sales/');
                /* PRODUCAO */
//             $ch = curl_init('https://api.cieloeCommerce.cielo.com.br/1/sales/');
                break;
            default: die('Tipo de operação nao permitida');
                break;
        }

//        print_r(json_encode($postData)); 
//ver($this->endpoint);
//        ver($postData, 1);
//        die();
//ver($postData);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "MerchantId: {$this->merchantId}",
                "MerchantKey: {$this->merchantKey}",
                "RequestId: {$RequestId}",
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

//$this->armazena_requisicao($dados, $postData, 'cielo');
// Send the request
        $response = curl_exec($ch);

// Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }

// Decode the response
//        ver($response,1);
//        ver($postData);

        $resposta = json_decode($response, TRUE);




        $this->model_recebimento->armazena_log('log_retornos', 'cielo', $resposta, $dados, $recebimento->Id_int, null, $sistema->Id_int);
        return $resposta;
    }

    public function processa_pagamento($dados, $recebimento, $usuario, $sistema) {

        $referencia = $recebimento->referencia;


        $recebimento_existente = $this->model_recebimento->busca_recebimento($sistema->Id_int, $recebimento->referencia);



        if ($recebimento_existente) {


            switch ($recebimento_existente->status) {
                case 'pago':
                    $resposta->pagamento_duplo = true;

                    return $resposta;
                    break;

                default:
                    break;
            }
        }


//
//
//        $MerchantId = $dados->merchantid;
//        $MerchantKey = $dados->merchantkey;

        $RequestId = '';
//ver($dados);
        $dados->CardNumber = str_replace(' ', '', $dados->CardNumber);
        $dados->ExpirationDate = $dados->val1 . '/' . $dados->val2;


        $recebimento->valor = str_replace('.', '', $recebimento->valor);

// The data to send to the API
        switch ($dados->Type) {
            case 'CreditCard':
                $postData = array(
                    "MerchantOrderId" => "{$recebimento->referencia}",
                    "Customer" => array("Name" => "{$recebimento->nome}"),
                    "Payment" => array(
                        "Type" => "CreditCard",
                        "Amount" => $recebimento->valor * 100,
                        "Installments" => $dados->parcelas,
                        "ServiceTaxAmount" => 0,
                        "Capture" => TRUE,
//                        "Provider" => "Bradesco",
//                        "Currency" => "BRL",
//                        "Country" => "BRA",
                        "ReturnUrl" => "http://landsdigital.com.br/",
                        "CreditCard" => array("CardNumber" => "{$dados->CardNumber}",
                            "Holder" => "{$dados->Holder}",
                            "ExpirationDate" => "{$dados->ExpirationDate}",
                            "SecurityCode" => "{$dados->SecurityCode}",
                            "Brand" => "{$dados->Brand}"
                        )
                    )
                );
                $ch = curl_init($this->endpoint);
//                $ch = curl_init('https://api.cieloeCommerce.cielo.com.br/1/sales/');
                break;
            case 'DebitCard':
                $postData = array(
                    "MerchantOrderId" => "{$recebimento->referencia}",
                    "Customer" => array("Name" => "{$recebimento->nome}"),
                    "Payment" => array(
                        "Type" => "DebitCard",
                        "Amount" => $recebimento->valor,
                        "Provider" => "Cielo",
                        "Authenticate" => true,
                        "ReturnUrl" => "{$this->app->Url_cliente}retorno_cielo",
//                        "ReturnUrl" => "$dados->url_retorno",
                        "DebitCard" => array("CardNumber" => "{$dados->CardNumber}",
                            "Holder" => "{$dados->Holder}",
                            "ExpirationDate" => "{$dados->ExpirationDate}",
                            "SecurityCode" => "{$dados->SecurityCode}",
                            "Brand" => "{$dados->Brand}"
                        )
                    )
                );
                /* SANDBOX */
                $ch = curl_init($this->endpoint);
//                $ch = curl_init('https://apisandbox.cieloeCommerce.cielo.com.br/1/sales/');
                /* PRODUCAO */
//             $ch = curl_init('https://api.cieloeCommerce.cielo.com.br/1/sales/');
                break;
            default: die('Tipo de operação nao permitida');
                break;
        }

//        print_r(json_encode($postData)); 
//ver($this->endpoint);
//        ver($postData, 1);
//ver($postData);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "MerchantId: {$this->merchantId}",
                "MerchantKey: {$this->merchantKey}",
                "RequestId: {$RequestId}",
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

//$this->armazena_requisicao($dados, $postData, 'cielo');
// Send the request
        $response = curl_exec($ch);

// Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }

// Decode the response
//        ver($response,1);
//        ver($postData);

        $resposta = json_decode($response, TRUE);




        $this->model_recebimento->armazena_log('log_retornos', 'cielo', $resposta, $dados, $recebimento->Id_int, null, $sistema->Id_int);
        return $resposta;
    }

    function trata_retorno($codigo, $mensagem = null) {

        $tipo = 'error';

        switch ($codigo) {
            case '2';
                $mensagem = 'Não Autorizado!';
                break;
            case '4';
                $mensagem = 'Operação Realizada com sucesso!';
                $tipo = 'success';
                break;
            case '6';
                $mensagem = 'Operação Realizada com sucesso!';
                $tipo = 'success';
                break;
            case '05';
                $mensagem = 'Não Autorizado!';
                break;
            case '57';
                $mensagem = 'Cartão Expirado!';
                break;
            case '70';
                $mensagem = 'Problemas com o Cartão de Crédito!';
                break;
            case '77';
                $mensagem = 'Cartão Cancelado!';
                break;
            case '78';
                $mensagem = 'Cartão Bloqueado!';
                break;
            case '99';
                $mensagem = 'Tempo de processamento esgotado!';
                break;
        }

        $mensagem->tipo = $tipo;

        $mensagem->mensagem = $mensagem;

        return $mensagem;
    }

}

