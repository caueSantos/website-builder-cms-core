<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');
require COMMONPATH . 'third_party/moip/vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

class Model_landspay extends Model_banco_cliente {

    public $db;
    public $app;
    public $moip;

    function __construct() {
        parent::__construct();
    }


    

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function gera_botao_cef($dados) {
        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }




        $boleto_cef = $this->executa_sql("select * from boleto_cef_sigcb where id_sistema='{$id_sistema}' limit 1");
        if (!$boleto_cef[0]) {
            $boleto_cef = $this->executa_sql("select * from boleto_cef_sigcb where id_sistema='1' limit 1");
        }
        if (!isset($dados->taxa)) {
            $dados->taxa = '0,00';
        }
        if (!isset($dados->prazo)) {
            $dados->prazo = 1;
        }
        $taxa = $dados->taxa;
        $valor = soma_valores($dados->valor, $dados->taxa);
        $botao['dias_de_prazo_para_pagamento'] = $dados->prazo;
        $botao['taxa_boleto'] = $taxa;
        $botao['nosso_numero1'] = $boleto_cef[0]->Nosso_numero1_txf;
        $botao['nosso_numero_const1'] = $boleto_cef[0]->Nosso_numero_const1_txf;
        $botao['nosso_numero2'] = $boleto_cef[0]->Nosso_numero2_txf;
        $botao['nosso_numero_const2'] = $boleto_cef[0]->Nosso_numero_const2_txf;
        $botao['nosso_numero3'] = formata_zeros_esquerda($dados->referencia);
        $botao['numero_documento'] = formata_zeros_esquerda($dados->referencia);
        $botao['data_vencimento'] = arruma_data(incrementa_data($dados->prazo));
        $botao['data_documento'] = date("d/m/Y");
        $botao['data_processamento'] = date("d/m/Y");
        $botao['valor_boleto'] = $valor;
        $botao['sacado'] = $dados->nome;
        $botao['endereco1'] = $dados->email . ' ' . $dados->telefone;
        $botao['endereco2'] = $dados->cpf;
        $botao['demonstrativo1'] = '';
        $botao['demonstrativo2'] = '';
        $botao['demonstrativo3'] = "Valor R$ $valor + Taxa Boleto R$ $taxa";
        $botao['instrucoes1'] = $boleto_cef[0]->Instrucoes1_txf;
        $botao['instrucoes2'] = $boleto_cef[0]->Instrucoes2_txf;
        $botao['instrucoes3'] = $boleto_cef[0]->Instrucoes3_txf;
        $botao['instrucoes4'] = $boleto_cef[0]->Instrucoes4_txf;
        $botao['quantidade'] = '';
        $botao['valor_unitario'] = '';
        $botao['aceite'] = $boleto_cef[0]->Aceite_txf;
        $botao['especie'] = $boleto_cef[0]->Especie_txf;
        $botao['especie_doc'] = $boleto_cef[0]->Especie_doc_txf;
        $botao['agencia'] = $boleto_cef[0]->Agencia_txf;
        $botao['conta'] = $boleto_cef[0]->Conta_txf;
        $botao['conta_dv'] = $boleto_cef[0]->Conta_dv_txf;
        $botao['conta_cedente'] = $boleto_cef[0]->Conta_cedente_txf;
        $botao['carteira'] = $boleto_cef[0]->Carteira_txf;
        $botao['identificacao'] = $boleto_cef[0]->Identificacao_txf;
        $botao['cpf_cnpj'] = $boleto_cef[0]->Cpf_cnpj_txf;
        $botao['endereco'] = $boleto_cef[0]->Endereco_txf;
        $botao['cidade_uf'] = $boleto_cef[0]->Cidade_uf_txf;
        $botao['cedente'] = $boleto_cef[0]->Cedente_txf;
        $dadosboleto = array_to_object($botao);
        $this->smarty->assign('dadosboleto_cef_sigcb', $dadosboleto);
        $this->model_smarty->carrega_bloco('botao_boleto_cef_sigcb', 'botao_boleto_cef_sigcb', $this->app->Template_txf);
    }

    function gera_botao_bb($dados) {
        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }

        $boleto_bb = $this->executa_sql("select * from boleto_bb where id_sistema='{$id_sistema}' limit 1");
        if (!$boleto_bb[0]) {
            $boleto_bb = $this->executa_sql("select * from boleto_bb where id_sistema='1' limit 1");
        }
        if (!isset($dados->taxa)) {
            $dados->taxa = '0,00';
        }
        if (!isset($dados->prazo)) {
            $dados->prazo = 1;
        }
        $taxa = $dados->taxa;
        $valor = soma_valores($dados->valor, $dados->taxa);
        $botao['dias_de_prazo_para_pagamento'] = $dados->prazo;
        $botao['taxa_boleto'] = $taxa;
        $botao['nosso_numero'] = formata_zeros_esquerda($dados->referencia);
        $botao['numero_documento'] = formata_zeros_esquerda($dados->referencia);
        $botao['data_vencimento'] = arruma_data(incrementa_data($dados->prazo));
        $botao['data_documento'] = date("d/m/Y");
        $botao['data_processamento'] = date("d/m/Y");
        $botao['valor_boleto'] = $valor;
        $botao['sacado'] = $dados->nome;
        $botao['endereco1'] = $dados->email . ' ' . $dados->telefone;
        $botao['endereco2'] = $dados->cpf;
        $botao['demonstrativo1'] = "";
        $botao['demonstrativo2'] = " ";
        $botao['demonstrativo3'] = "Valor R$ $valor + Taxa Boleto R$ $taxa";
        $botao['instrucoes1'] = $boleto_bb[0]->Instrucoes1_txf;
        $botao['instrucoes2'] = $boleto_bb[0]->Instrucoes2_txf;
        $botao['instrucoes3'] = $boleto_bb[0]->Instrucoes3_txf;
        $botao['instrucoes4'] = $boleto_bb[0]->Instrucoes4_txf;
        $botao['quantidade'] = "";
        $botao['valor_unitario'] = "";
        $botao['aceite'] = $boleto_bb[0]->Aceite_txf;
        $botao['especie'] = $boleto_bb[0]->Especie_txf;
        $botao['especie_doc'] = $boleto_bb[0]->Especie_doc_txf;
        $botao['agencia'] = $boleto_bb[0]->Agencia_txf;
        $botao['conta'] = $boleto_bb[0]->Conta_txf;
        $botao['convenio'] = $boleto_bb[0]->Convenio_txf;
        $botao['contrato'] = $boleto_bb[0]->Contrato_txf;
        $botao['carteira'] = $boleto_bb[0]->Carteira_txf;
        $botao['variacao_carteira'] = $boleto_bb[0]->Variacao_carteira_txf;
        $botao['formatacao_convenio'] = $boleto_bb[0]->Formatacao_convenio_txf;
        $botao['formatacao_nosso_numero'] = $boleto_bb[0]->Formatacao_nosso_numero;
        $botao['identificacao'] = $boleto_bb[0]->Identificacao_txf;
        $botao['cpf_cnpj'] = $boleto_bb[0]->Cpf_cnpj_txf;
        $botao['endereco'] = $boleto_bb[0]->Endereco_txf;
        $botao['cidade_uf'] = $boleto_bb[0]->Cidade_uf_txf;
        $botao['cedente'] = $boleto_bb[0]->Cedente_txf;

        $dadosboleto = array_to_object($botao);
        $this->smarty->assign('dadosboleto_bb', $dadosboleto);
        $this->model_smarty->carrega_bloco('botao_boleto_bb', 'botao_boleto_bb', $this->app->Template_txf);
    }

    function gera_botao_cielo($dados) {

        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }

        $cielo = $this->executa_sql("select * from cielo where id_sistema='{$id_sistema}'  limit 1");
        if (!$cielo[0]) {
            $cielo = $this->executa_sql("select * from cielo where id_sistema='1'  limit 1");
        }

        foreach ($dados as $key => $value) {
            $botao[$key] = $value;
        }

        $botao['merchantid'] = $cielo[0]->merchantid;
        $botao['merchantkey'] = $cielo[0]->merchantkey;



        $dadoscielo = array_to_object($botao);


        $this->smarty->assign('dadoscielo', $dadoscielo);
        $this->model_smarty->carrega_bloco('botao_cielo', 'botao_cielo', $this->app->Template_txf);
    }

    function gera_botao_pagseguro($dados) {
        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }
        
        
        $pagseguro = $this->executa_sql("select * from pagseguro where id_sistema='{$id_sistema}'  limit 1");
        if (!$pagseguro[0]) {
            die("configuracao de pagseguro nao encontrada para o app {$id_sistema}");
        }
        $botao['referencia'] = $dados->referencia;
        $botao['clientenome'] = $dados->nome;
        $botao['clienteemail'] = $dados->email;
        $botao['produto'] = $dados->produto;
        $botao['valor'] = $dados->valor;
        $botao['quantidade'] = $dados->quantidade;

        $botao['email'] = $pagseguro[0]->Email_txf;
        $botao['token'] = $pagseguro[0]->Token_txf;

        $dadospagseguro = array_to_object($botao);
        $this->smarty->assign('dadospagseguro', $dadospagseguro);
        $this->model_smarty->carrega_bloco('botao_pagseguro', 'botao_pagseguro', $this->app->Template_txf);
    }

    function gera_botao_moip($dados) {
        
        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }

        $this->config_moip = $this->executa_sql("select * from moip where id_sistema='{$id_sistema}' and Ativo_sel='SIM' limit 1");
        if (!$this->config_moip[0]) {
            die("configuracao de moip nao encontrada para o app {$id_sistema}");
        }

        $botao['referencia'] = $dados->referencia;
        $botao['clientenome'] = $dados->nome;
        $botao['clienteemail'] = $dados->email;
        $botao['produto'] = $dados->produto;
        $botao['valororiginal'] = $dados->valor;
        $botao['conta_moip'] = $dados->conta_moip;
        $valor = intval(number_format($dados->valor, 2, "", ""));

        $qtd = intval(number_format($dados->quantidade, 0, "", ""));

        $botao['valor'] = $valor;

        $valortotal = $valor * $qtd;
        $botao['valortotal'] = intval(number_format($valortotal, 0, "", ""));

        $botao['quantidade'] = $qtd;
        $botao['nome'] = utf8_decode($dados->produto);
        $botao['id_sistema'] = $id_sistema;
        $botao['cpf'] = $dados->cpf;
        $botao['clientecpf'] = $dados->cpf;
        $botao['meio_escolhido'] = 'moip';
        $botao['telefone'] = $dados->telefone;
        $botao['nascimento'] = $dados->nascimento;

//        $botao['chave'] = $this->moip[0]->Chave_txf;
//        $botao['token'] = $this->moip[0]->Token_txf;

        $dadosmoip = array_to_object($botao);
        $this->smarty->assign('dadosmoip', $dadosmoip);
        $this->model_smarty->carrega_bloco('botao_moip', 'botao_moip', $this->app->Template_txf);
    }

   
    
    

    function procura_pagamento($referencia) {

        $pagamento = $this->mbc->executa_sql("select * from pagamentos where referencia='{$referencia}'");
        if ($pagamento[0]->Id_int) {


        }

        $pagamento_retorno = $this->mbc->executa_sql("select * from pagamentos_retornos where referencia='{$referencia}'");



        if ($pagamento_retorno[0]->Id_int) {

            $retorno = json_decode($pagamento_retorno[0]->retorno_jso);

            return $retorno->payment;
        }

        return FALSE;
    }

    function atualiza_pedidos_moip() {
        
    }

    
    public function processa_pagseguro() {
        $quantidade = $_POST['quantidade'];
        $referencia = $_POST['referencia'];
        $clientenome = $_POST['clientenome'];
        $clienteemail = $_POST['clienteemail'];
        $valor = str_replace(",", ".", $_POST['valor']);
        $produto = $_POST['produto'];
        $email = $_POST['email'];
        $token = $_POST['token'];

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

        try {
            // seller authentication
            $credentials = new PagSeguroAccountCredentials($email, $token);
            // Register this payment request in PagSeguro to obtain the checkout code
            $onlyCheckoutCode = true;
            $code = $paymentRequest->register($credentials, $onlyCheckoutCode);
            $_POST['codigo'] = $code;
            $this->mbc->db_insert('requisicoes_pagseguro', $_POST);
            $this->smarty->assign('codigo_pagseguro', $code);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    function processa_cielo($dados) {
        $MerchantId = $dados->merchantid;
        $MerchantKey = $dados->merchantkey;

        $RequestId = '';

        $dados->CardNumber = str_replace(' ', '', $dados->CardNumber);

        $dados->valor = str_replace('.', '', $dados->valor);

// The data to send to the API
        switch ($dados->Type) {
            case 'CreditCard':
                $postData = array(
                    "MerchantOrderId" => "{$dados->referencia}",
                    "Customer" => array("Name" => "{$dados->nome}"),
                    "Payment" => array(
                        "Type" => "CreditCard",
                        "Amount" => $dados->valor,
                        "Installments" => $dados->parcelas,
                        "ServiceTaxAmount" => 0,
                        "Capture" => TRUE,
//                        "Provider" => "Bradesco",
                        "Currency" => "BRL",
                        "Country" => "BRA",
                        "ReturnUrl" => "http://landsdigital.com.br/",
                        "CreditCard" => array("CardNumber" => "{$dados->CardNumber}",
                            "Holder" => "{$dados->Holder}",
                            "ExpirationDate" => "{$dados->ExpirationDate}",
                            "SecurityCode" => "{$dados->SecurityCode}",
                            "Brand" => "{$dados->Brand}"
                        )
                    )
                );

                $ch = curl_init('https://api.cieloeCommerce.cielo.com.br/1/sales/');
                break;
            case 'DebitCard':
                $postData = array(
                    "MerchantOrderId" => "{$dados->referencia}",
                    "Customer" => array("Name" => "{$dados->nome}"),
                    "Payment" => array(
                        "Type" => "DebitCard",
                        "Amount" => $dados->valor,
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
                $ch = curl_init('https://apisandbox.cieloeCommerce.cielo.com.br/1/sales/');
                /* PRODUCAO */
//             $ch = curl_init('https://api.cieloeCommerce.cielo.com.br/1/sales/');
                break;
            default: die('Tipo de operação nao permitida');
                break;
        }

//        print_r(json_encode($postData)); 

        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "MerchantId: {$MerchantId}",
                "MerchantKey: {$MerchantKey}",
                "RequestId: {$RequestId}",
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $this->armazena_requisicao($dados, $postData, 'cielo');



// Send the request
        $response = curl_exec($ch);

// Check for errors
        if ($response === FALSE) {
            die(curl_error($ch));
        }

// Decode the response

        $responseData = json_decode($response, TRUE);




        $this->armazena_retorno($dados, $responseData, 'cielo');
        if ($responseData['Payment']) {

            switch ($responseData['Payment']['Status']) {
                case '2':
                    $status = 'pago';

                    break;

                default: $status = 'aguardando';
                    break;
            }
            $this->atualiza_status($dados, 'cielo', $status);
            $this->trata_retorno('cielo', $responseData['Payment']['ReturnCode'], $responseData['Payment']['ReturnMessage']);
            $this->smarty->assign('dados', $dados);
            $this->model_smarty->render_ajax('retornos', $this->app->Template_txf);
            die();
        } else {
            $this->trata_retorno('cielo', $responseData[0]['Code'], $responseData[0]['Message']);
            $this->smarty->assign('dados', $dados);
            $this->model_smarty->render_ajax('retornos', $this->app->Template_txf);
            die();
        }
// Print the date from the response
    }

    function atualiza_status($dados, $meio, $status, $ambiente = null) {

//        $status_tratado = $this->trata_status_moip($status);

        $array['Atualizacao_dat'] = date('Y-m-d H:i:s');
        $array['meio_escolhido'] = $meio;
        $array['status'] = $status;
        if ($ambiente) {


            $array['ambiente'] = $ambiente;
        }
        echo "<div class='text-center'>$status</div>";
        if ($dados->id_pagamento) {
//            if (is_lands()) {
//                echo "atualizando status do pagamento  $dados->id_pagamento para '$status'<br>";
//            }

            $this->mbc->updateTable("pagamentos", $array, 'Id_int', $dados->id_pagamento);
        } else {
//            echo "atualizando status do pagamento $dados->Id_int para '$status'<br>";

            $this->mbc->updateTable("pagamentos", $array, 'Id_int', $dados->Id_int);
        }
    }

    function trata_status_moip($status) {


        switch ($status) {

            case 'AUTHORIZED':
                $status = 'pago';
                break;
            case 'IN_ANALYSIS':
                $status = 'em análise';
                break;
            case 'CANCELLED':
                $status = 'cancelado';
                break;
            case 'em análise':
                $status = 'em análise';
                break;

            default :
                $status = 'aguardando';
                break;
        }

        return $status;
    }

    function trata_retorno($meio, $codigo, $mensagem_ingles) {

        $tipo = 'error';


        switch ($meio) {
            case 'cielo':
                switch ($codigo) {
//                    case '2';
//                        $mensagem = 'Não Autorizado!';
//                        break;
//                    case '4';
//                        $mensagem = 'Operação Realizada com sucesso!';
//                        $tipo = 'success';
//                        break;
//                    case '6';
//                        $mensagem = 'Operação Realizada com sucesso!';
//                        $tipo = 'success';
//                        break;
//                    case '57';
//                        $mensagem = 'Cartão Expirado!';
//                        break;
//                    case '70';
//                        $mensagem = 'Problemas com o Cartão de Crédito!';
//                        break;
//                    case '77';
//                        $mensagem = 'Cartão Cancelado!';
//                        break;
//                    case '78';
//                        $mensagem = 'Cartão Bloqueado!';
//                        break;
//                    case '99';
//                        $mensagem = 'Tempo de processamento esgotado!';
//                        break;
                    case '00';
                        $mensagem = $mensagem_ingles;
                        $tipo = 'success';
                        break;
                }
                break;


            default: return 'success';
                break;
        }

        $this->smarty->assign('mensagem', $mensagem);
        $this->smarty->assign('codigo', $codigo);
        $this->smarty->assign('tipo', $tipo);
    }

    function armazena_retorno($dados, $resposta, $meio) {

        $id_pagamento = $dados->Id_int;
        $id_sistema = $dados->id_sistema;
        $referencia = $dados->referencia;


        $array = array();
        $array['id_pagamento'] = $id_pagamento;
        $array['id_sistema'] = $id_sistema;
        $array['referencia'] = $referencia;
        $array['meio'] = $meio;
        $array['retorno_jso'] = json_encode($resposta);
        $array['Atualizacao_dat'] = date('Y-m-d H:i:s');

        if ($meio == 'moip') {

            $array['ambiente'] = $this->model_moip->ambiente;
        }

        $retorno = $this->mbc->executa_sql("select * from pagamentos_retornos where id_pagamento='{$id_pagamento}'");
        if ($retorno) {
            $this->mbc->updateTable("pagamentos_retornos", $array, 'Id_int', $retorno[0]->Id_int);
        } else {
            $array['Data_dat'] = date('Y-m-d H:i:s');
            $this->mbc->db_insert("pagamentos_retornos", $array);
        }
    }

    function armazena_requisicao($dados, $postData, $meio) {

        $id_pagamento = $dados->Id_int;
        $id_sistema = $dados->id_sistema;
        $referencia = $dados->referencia;

        $array = array();
        $array['id_pagamento'] = $id_pagamento;
        $array['id_sistema'] = $id_sistema;
        $array['referencia'] = $referencia;
        $array['meio'] = $meio;
        $array['requisicao'] = json_encode($postData);
        $array['Atualizacao_dat'] = date('Y-m-d H:i:s');
        $array['Data_dat'] = date('Y-m-d H:i:s');
        $this->mbc->db_insert("log_requisicoes", $array);

//        $retorno = $this->mbc->executa_sql("select * from pagamentos_retornos where id_pagamento='{$id_pagamento}'");
//        if ($retorno) {
//
//            $this->mbc->updateTable("pagamentos_retornos", $array, 'Id_int', $retorno[0]->Id_int);
//        } else {
//            $array['Data_dat'] = date('Y-m-d H:i:s');
//            $this->mbc->db_insert("pagamentos_retornos", $array);
//        }
    }

}

