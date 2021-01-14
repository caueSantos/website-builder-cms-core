<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');
require COMMONPATH . 'third_party/moip/vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

class Model_moipv2 extends Model_banco_cliente {

    public $db;
    public $app;
    public $moip;
    //LANDS - SANDBOX
//    public $app_id = 'APP-G0INTQE05XDQ';
//    public $app_secret = "df9822f2ca43470ea1f9ccd87293fcdd";
    //LANDS - PRODUCAO
    public $app_id = 'APP-KCM1YBBDN23W';
    public $app_secret = "6a5c3867d9704a47837a84d375e0df92";
    public $sistema;
    public $conta_moip;

    function __construct() {
        parent::__construct();
    }

    function busca_pagamento($id = null, $moip_object = null, $retorna_objeto = null) {

        if ($moip_object) {
            $this->cria_objeto($moip_object);
        }
        if (!$id) {
            echo ('Pagamento não realizado, por falta de ID');
            return FALSE;
        }

        try {
//ver($id);
//            ver($this->moip->payments());
//            $pagamento = $this->moip->payments()->get('PAY-FAO121SGBFVB');            

            $pagamento = $this->moip->payments()->get($id);


            if ($retorna_objeto) {
                $retorno = $pagamento;
            } else {
                $resultado = $pagamento->retorna_dados();
                $retorno = $resultado;
            }
//
            return $retorno;
        } catch (Exception $exc) {
//            echo $exc->getMessage();

            echo $exc->getTraceAsString();
//            echo "<br>";
        }
    }

    function busca_cliente($id = null, $moip_object = null, $retorna_objeto = null) {
        if ($moip_object) {
            $this->cria_objeto($moip_object);
        }
        if (!$id) {
            die('id do pagamento eh obrigatorio');
        }
        $pagamento = $this->moip->customers()->get($id);

        if ($retorna_objeto) {
            $retorno = $pagamento;
        } else {
            $resultado = $pagamento->retorna_dados();
            $retorno = $resultado;
        }

        return $retorno;
    }

    function busca_compra($id = null, $moip_object = null, $retorna_objeto = null) {
        if ($moip_object) {
            $this->cria_objeto($moip_object);
        }
        if (!$id) {
            die('id do pagamento eh obrigatorio');
        }
        $pagamento = $this->moip->orders()->get($id);

        if ($retorna_objeto) {
            $retorno = $pagamento;
        } else {
            $resultado = $pagamento->retorna_dados();
            $retorno = $resultado;
        }

        return $retorno;
    }

    function cria_objeto($ob) {
        $this->moip = $ob;
        return $this->moip;
    }

    function inicializa($app, $cliente = null, $sistema = null, $conta_moip = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }

        $this->sistema = $sistema;
        $this->conta_moip = $conta_moip;

        $token = $this->conta_moip->Token_txf;
        $key = $this->conta_moip->Chave_txf;
        $this->ambiente = $this->conta_moip->Tipo_sel;
//        $this->app_id = "APP-KCM1YBBDN23W";
        $this->id_secundario = FALSE;
        $this->email_secundario = FALSE;
        if ($this->conta_moip->Id_secundario_txf) {
            $this->id_secundario = $this->conta_moip->Id_secundario_txf;
            $this->email_secundario = $this->conta_moip->Email_secundario_txf;

            $this->id_terciario = $this->conta_moip->Id_terciario_txf;
            $this->email_terciario = $this->conta_moip->Email_terciario_txf;
        }

        $this->dados_moip = $this->conta_moip;



//ver( $this->conta_moip->Tipo_sel);
        switch ($this->conta_moip->Tipo_sel) {
            case 'SANDBOX':
//                echo "<div class='text-center'>executando em SANDBOX</div>";

                $this->moip = new Moip(new MoipBasicAuth($token, $key), Moip::ENDPOINT_SANDBOX);
//                ver($this->moip);
                break;
            case 'PRODUCAO':



                $this->moip = new Moip(new MoipBasicAuth($token, $key), Moip::ENDPOINT_PRODUCTION);
                break;

            default:
                die('endpoint invalido');
                break;
        }


        return $this->moip;
    }

    public function cria_conta() {


//        $conta = $this->moip->accounts()->get('MPA-1D9F8665CA41');
//        try {
//            $conta = $this->moip->accounts()
//                    ->setEmail('moip@flexlages.com.br')
//                    ->setName('Antonio')
//                    ->setLastName('Ricardo Soares')
//                    ->setBirthDate('1975-10-23')
//                    ->setTaxDocument('95023720934', 'CPF')
//                    ->setPhone('49', '991628058', '55')
//                    ->setIdentityDocument('2828799', 'SSP', '2005-01-01', 'RG')
//                    ->addAddress('João Ribeiro Branco', '160', 'Sagrado Coração de Jesus', 'Lages', 'SC', '88508-160', null, 'BRA')
//                    ->setType('MERCHANT');
//            
//            
////            ->create();
//            
//
//            $resposta->conta = $conta;
//        } catch (Exception $e) {
//            $resposta->erro_conta = $e;
////           
//        }
    }

    function set_app_id($param) {
        $this->app_id = $param;
    }

    function set_app_secred($param) {
        $this->app_secret = $param;
    }

    function busca_dados_conta($codigo = null) {
        if (!$codigo) {
            $codigo = "8f9688212c765113aef092453efd6a0bffe060ed";
        }

        $headers = array(
            'Authorization: Basic R0tUSkRIT1FFSVpJQklLU09ZWkJQMkwwQkRaWjE2NE06R0tBUERFV0k0TExRS0RDMkNVUkxaQlZRQURUU1E0NUVFV0Q4S1dNRA=='
        ); //coloque o seu basic
        //$acessToken = "1ef3f073852342ee94e264285a2e99e4_v2";
        $client_id = $this->app_id;
        $grant_type = "authorization_code";
        $code = $codigo; //que você pegou gerando a primeira url, code do cliente https://dev.moip.com.br/v2.0/reference#intro
        $redirect_uri = "https://landspay.landshosting.com.br/conta-moip";
        $client_secret = $this->app_secret; //secret dos dados do seu app

        $url = "https://connect.moip.com.br/oauth/token";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, "client_id=" . urlencode($client_id) . "&grant_type=" .
                urlencode($grant_type) . "&code=" . urlencode($code) .
                "&redirect_uri=" . urlencode($redirect_uri) .
                "&client_secret=" . urlencode($client_secret));

        $result = curl_exec($curl);
        $resultado = json_decode($result, true);
        return $resultado;
        echo "<pre>";
//        print_r($resultado);
        echo "</pre>";
//        die();
    }

    public function verifica_pagamento_duplo($recebimento) {
        if (!$recebimento->id_meio) {
            return false;
        }

        $id_pagto = $recebimento->id_meio;

        $pagamento = $this->busca_pagamento($id_pagto);

        $status_ingles = $pagamento->status;

        $status = $this->trata_status_moip($status_ingles);
//        ver($status);
        $recebimento_atualizado = $this->model_recebimento->atualiza_status($recebimento->Id_int, 'moip', $status, $this->conta_moip->Tipo_sel);



        return $recebimento_atualizado;
    }

    public function processa_pagamento_transparente($dados, $recebimento, $sistema) {

        $resposta = new stdClass();
        $duplo = $this->verifica_pagamento_duplo($recebimento);
        if ($duplo) {
            switch ($recebimento->status) {
                case 'pago':
                    $resposta->pagamento_duplo = true;
                    return $resposta;
                    break;

                default:
                    break;
            }
        }


        $this->model_recebimento->armazena_log('log_requisicoes', 'moip', $_POST, $dados, $recebimento->Id_int, null, $sistema->Id_int);

        try {
            $customer = $this->moip->customers()->setOwnId(uniqid())
                    ->setFullname($dados->payment->customer->name)
                    ->setEmail($dados->email)
                    ->setBirthDate($dados->payment->customer->birth_date)
                    ->setTaxDocument($dados->payment->customer->tax_document)
                    ->setPhone($dados->payment->customer->telephone_area, $dados->payment->customer->telephone)
                    ->addAddress('BILLING', $dados->payment->customer->street, intval($dados->payment->customer->streetNumber), $dados->payment->customer->district, $dados->payment->customer->city, $dados->payment->customer->state, $dados->payment->customer->zip_code)
                    ->addAddress('SHIPPING', $dados->payment->customer->street, intval($dados->payment->customer->streetNumber), $dados->payment->customer->district, $dados->payment->customer->city, $dados->payment->customer->state, $dados->payment->customer->zip_code)
                    ->create();
            $resposta->customer = $customer;
        } catch (Exception $e) {
            $resposta->erro_customer = $e;

            $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
            return $resposta;
        }

//ver($dados); 

        $valor = intval(number_format($recebimento->valor, 2, "", ""));

        //calculo da antecipacao
         $valor_novo = intval($this->calcula_antecipacao($valor, $dados->parcelas));


        $qtd = intval(number_format($recebimento->quantidade, 0, "", ""));
        $porc = floatval($this->conta_moip->Porcentagem_txf);

        try {
            $order = $this->moip->orders()->setOwnId($recebimento->Id_int);
                
                $order->addItem($recebimento->produto, $qtd, $recebimento->referencia, $valor_novo);
// antes da antecipacao 
//                $order->addItem($recebimento->produto, $qtd, $recebimento->referencia, $valor);
          

            $order->setCustomer($customer);
            if ($this->id_secundario) {
                $porc = floatval($this->conta_moip->Porcentagem_secundaria_txf);
                $porcentagem = intval(number_format($valor * $qtd * $porc, 0, "", ""));

//                ver($porcentagem);
                $order->addReceiver($this->id_secundario, 'SECONDARY', $porcentagem);
            }
            if ($this->id_terciario) {
                $porc = floatval($this->conta_moip->Porcentagem_terciaria_txf);
                $porcentagem = intval(number_format($valor * $qtd * $porc, 0, "", ""));
//                 ver($porcentagem);
                $order->addReceiver($this->id_terciario, 'SECONDARY', $porcentagem);
            }

            $order->create();
            $resposta->orders = $order;
        } catch (Exception $e) {
            $resposta->erro_orders = $e;

            $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
            return $resposta;
        }

        switch ($dados->tipo_pagto) {
            case 'boleto':
                $date = new DateTime();
                $expiration_date = $date->add(new DateInterval('P3D'));
                $logo_uri = "https://landspay.landshosting.com.br/v2/painel/img/lands_payv2/6_sistemas_4245.png";
//                $instruction_lines = ['INSTRUÇÃO 1', 'INSTRUÇÃO 2', 'INSTRUÇÃO 3'];
                $instruction_lines = [];

                try {
                    $payment = $order->payments()
                            ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
                            ->execute();
                    $resposta->payment = $payment;
                } catch (Exception $e) {
                    $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
                    $resposta->erro_payment = $e;
                    return $resposta;
                }
                break;
            default:
                $expirationMonth = intval($dados->payment->credit_card->expiration_month);
                $expirationYear = intval($dados->payment->credit_card->expiration_year);
                $number = str_replace(" ", "", $dados->payment->credit_card->number);
                $cvc = intval($dados->payment->credit_card->cvc);

                try {
//            $payment = $order->payments()->setCreditCard(12, 21, '4073020000000002', '123', $customer)
                    $payment = $order->payments()->setCreditCard($expirationMonth, $expirationYear, $number, $cvc, $customer)
                            ->setInstallmentCount(intval($dados->parcelas))
                            ->execute();
//ver($payment);
                    $resposta->payment = $payment;
                } catch (Exception $e) {


                    $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
                    $resposta->erro_payment = $e;
                    return $resposta;
                }

                break;
        }
        $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);

//        ver($resposta);
        return $resposta;
    }

    function calcula_antecipacao($value, $installments) {

        $repass_fees = true;

//        $value = 130;
//        $installments = 3;
        //taxas
        $fixed_fee = 0.69;

        $transaction_fee = 5.49;
        $percentage_transaction_fee = $transaction_fee / 100;

        $anticipation_fee = $this->anticipation_table();
        $anticipation_fee = $anticipation_fee[$installments];

        $percentage_anticipation_fee = $anticipation_fee / 100;

        $gross_up = $value;
        $net_value = $value;

        if ($repass_fees === true) {

            $gross_up = $value * ((1 - $percentage_transaction_fee) /
                    (1 - $percentage_anticipation_fee - $percentage_transaction_fee));
        }

        $gateway_absolute_value = ($gross_up * $percentage_transaction_fee) + $fixed_fee;
        $anticipation_absolute_value = $gross_up * $percentage_anticipation_fee;

        $net_value = $gross_up - $gateway_absolute_value - $anticipation_absolute_value;

        return (round($gross_up, 2));

//    dd([
//        'value' => $value,
//        'installments' => $installments,
//        'pass_on_fess' => $repass_fees,
//        'fees' => [
//            'fixed' => $fixed_fee,
//            'transaction' => $transaction_fee,
//            'anticipation' => $anticipation_fee
//        ],
//        'absolute_values' => [
//            'gateway' => round($gateway_absolute_value, 2),
//            'anticipation' => round($anticipation_absolute_value, 2),
//            'total' => round($gateway_absolute_value + $anticipation_absolute_value, 2)
//        ],
//        'anticipation_table' => anticipation_table(),
//        'installments_value' => round_up($gross_up / $installments, 2),
//        'gross_value' => round($gross_up, 2),
//        'net_value' => round($net_value, 2)
//    ]);
    }

    function anticipation_table() {

        return array(
            1 => 0,
            2 => 4.50,
            3 => 5.00,
            4 => 5.50,
            5 => 6.50,
            6 => 7.50,
            7 => 8.50,
            8 => 9.50,
            9 => 10.50,
            10 => 11.50,
            11 => 12.00,
            12 => 12.50,
        );
        
//           return array(
//            1 => 0,
//            2 => 4.999,
//            3 => 5.586,
//            4 => 6.179,
//            5 => 7.386,
//            6 => 8.620,
//            7 => 9.883,
//            8 => 11.175,
//            9 => 12.499,
//            10 => 13.854,
//            11 => 14.544,
//            12 => 15.242,
//        );
    }

//Função para arredondamento mantendo casas decimais
    function round_up($value, $places = 0) {
        if ($places < 0) {
            $places = 0;
        }
        $mult = pow(10, $places);
        return ceil($value * $mult) / $mult;
    }

    public function processa_pagamento($dados, $recebimento, $usuario, $sistema) {

        /*
        $referencia = $recebimento->referencia;

        $recebimento_existente = $this->model_recebimento->busca_recebimento($sistema->Id_int, $recebimento->referencia);
        $duplo = $this->verifica_pagamento_duplo($recebimento_existente);
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

        $clientetelefone = $usuario->telefone;

//        ver($valor,1);
        $produto = $recebimento->produto;
        $clientetelefone = str_replace("(", "", $clientetelefone);
        $clientetelefone = str_replace(")", "", $clientetelefone);
        $clientetelefone = str_replace("-", "", $clientetelefone);


        $nascimento = $usuario->nascimento;
        $ddd = intval(substr($clientetelefone, 0, 2));
        $numero = intval(substr($clientetelefone, 2, 10));


        $resposta = new stdClass();

        $this->model_recebimento->armazena_log('log_requisicoes', 'moip', $_POST, $dados, $recebimento->Id_int, $usuario->Id_int, $sistema->Id_int);

        try {
            $customer = $this->moip->customers()->setOwnId(uniqid())
                    ->setFullname($usuario->nome)
                    ->setEmail($usuario->email)
                    ->setBirthDate($nascimento)
                    ->setTaxDocument($usuario->cpf)
                    ->setPhone($ddd, $numero)
                    ->addAddress('BILLING', $usuario->Endereco_txf, intval($usuario->Numero_txf), $usuario->Bairro_txf, $usuario->Cidade_txf, $usuario->Estado_sel, $usuario->Cep_txf)
                    ->addAddress('SHIPPING', $usuario->Endereco_txf, intval($usuario->Numero_txf), $usuario->Bairro_txf, $usuario->Cidade_txf, $usuario->Estado_sel, $usuario->Cep_txf)
                    ->create();
            $resposta->customer = $customer;
        } catch (Exception $e) {
            $resposta->erro_customer = $e;
            $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, $usuario->Id_int, $sistema->Id_int);
            return $resposta;
        }


//        ver($recebimento->valor, 1);
//        ver($recebimento->quantidade, 1);

        $valor = intval(number_format($recebimento->valor, 2, "", ""));
//        $valor = intval(str_replace(".","",$valor))*10;
//           ver($valor);
        $qtd = intval(number_format($recebimento->quantidade, 0, "", ""));
        $porc = floatval($this->conta_moip->Porcentagem_txf);

//        ver($valor, 1);
//        ver($qtd);

        try {
            $order = $this->moip->orders()->setOwnId(uniqid());
            $order->addItem($recebimento->produto, $qtd, $recebimento->referencia, $valor);
//                        ->addItem("bicicleta 10", 1, "sku10", 19000)
//                        ->setShippingAmount(3000)->setAddition(1000)->setDiscount(5000)

            $order->setCustomer($customer);

            if ($this->id_secundario) {

                $porcentagem = intval(number_format($valor * $qtd * $porc, 0, "", ""));
//                ver($porcentagem);
                $order->addReceiver($this->id_secundario, 'SECONDARY', $porcentagem);
            }

            $order->create();
            $resposta->orders = $order;
        } catch (Exception $e) {
            $resposta->erro_orders = $e;
            $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, $usuario->Id_int, $sistema->Id_int);
            return $resposta;
        }
        switch ($dados->tipo_pagto) {
            case 'boleto':
//$expiration_date=20171122;
                $date = new DateTime();

                $expiration_date = $date->add(new DateInterval('P3D'));


                $logo_uri = "https://landspay.landshosting.com.br/v2/painel/img/lands_payv2/6_sistemas_4245.png";
//                $instruction_lines = ['INSTRUÇÃO 1', 'INSTRUÇÃO 2', 'INSTRUÇÃO 3'];
                $instruction_lines = [];


                try {


                    $payment = $order->payments()
                            ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
                            ->execute();



                    $resposta->payment = $payment;
                } catch (Exception $e) {
                    $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, $usuario->Id_int, $sistema->Id_int);
                    $resposta->erro_payment = $e;
                    return $resposta;
                }
                break;

            default:

                $expirationMonth = intval($dados->val1);
                $expirationYear = intval($dados->val2);
                $number = str_replace(" ", "", $dados->CardNumber);
                $cvc = intval($dados->SecurityCode);

                try {
//            $payment = $order->payments()->setCreditCard(12, 21, '4073020000000002', '123', $customer)

                    $payment = $order->payments()->setCreditCard($expirationMonth, $expirationYear, $number, $cvc, $customer)
                            ->setInstallmentCount($dados->parcelas)
                            ->execute();



                    $resposta->payment = $payment;
                } catch (Exception $e) {
                    $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, $usuario->Id_int, $sistema->Id_int);
                    $resposta->erro_payment = $e;
                    return $resposta;
                }

                break;
        }


        $this->smarty->assign('dados', $dados);


//        $responseData = json_encode($resposta);

        $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, $usuario->Id_int, $sistema->Id_int);


        return $resposta;
         * 
         */
        
          $resposta = new stdClass();
        $duplo = $this->verifica_pagamento_duplo($recebimento);
        if ($duplo) {
            switch ($recebimento->status) {
                case 'pago':
                    $resposta->pagamento_duplo = true;
                    return $resposta;
                    break;

                default:
                    break;
            }
        }


        $this->model_recebimento->armazena_log('log_requisicoes', 'moip', $_POST, $dados, $recebimento->Id_int, null, $sistema->Id_int);

        try {
            $customer = $this->moip->customers()->setOwnId(uniqid())
                    ->setFullname($dados->payment->customer->name)
                    ->setEmail($dados->email)
                    ->setBirthDate($dados->payment->customer->birth_date)
                    ->setTaxDocument($dados->payment->customer->tax_document)
                    ->setPhone($dados->payment->customer->telephone_area, $dados->payment->customer->telephone)
                    ->addAddress('BILLING', $dados->payment->customer->street, intval($dados->payment->customer->streetNumber), $dados->payment->customer->district, $dados->payment->customer->city, $dados->payment->customer->state, $dados->payment->customer->zip_code)
                    ->addAddress('SHIPPING', $dados->payment->customer->street, intval($dados->payment->customer->streetNumber), $dados->payment->customer->district, $dados->payment->customer->city, $dados->payment->customer->state, $dados->payment->customer->zip_code)
                    ->create();
            $resposta->customer = $customer;
        } catch (Exception $e) {
            $resposta->erro_customer = $e;

            $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
            return $resposta;
        }

//ver($dados); 

        $valor = intval(number_format($recebimento->valor, 2, "", ""));

        //calculo da antecipacao
         $valor_novo = intval($this->calcula_antecipacao($valor, $dados->parcelas));


        $qtd = intval(number_format($recebimento->quantidade, 0, "", ""));
        $porc = floatval($this->conta_moip->Porcentagem_txf);

        try {
            $order = $this->moip->orders()->setOwnId($recebimento->Id_int);
                
                $order->addItem($recebimento->produto, $qtd, $recebimento->referencia, $valor_novo);
// antes da antecipacao 
//                $order->addItem($recebimento->produto, $qtd, $recebimento->referencia, $valor);
          

            $order->setCustomer($customer);
            if ($this->id_secundario) {
                $porc = floatval($this->conta_moip->Porcentagem_secundaria_txf);
                $porcentagem = intval(number_format($valor * $qtd * $porc, 0, "", ""));

//                ver($porcentagem);
                $order->addReceiver($this->id_secundario, 'SECONDARY', $porcentagem);
            }
            if ($this->id_terciario) {
                $porc = floatval($this->conta_moip->Porcentagem_terciaria_txf);
                $porcentagem = intval(number_format($valor * $qtd * $porc, 0, "", ""));
//                 ver($porcentagem);
                $order->addReceiver($this->id_terciario, 'SECONDARY', $porcentagem);
            }

            $order->create();
            $resposta->orders = $order;
        } catch (Exception $e) {
            $resposta->erro_orders = $e;

            $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
            return $resposta;
        }

        switch ($dados->tipo_pagto) {
            case 'boleto':
                $date = new DateTime();
                $expiration_date = $date->add(new DateInterval('P3D'));
                $logo_uri = "https://landspay.landshosting.com.br/v2/painel/img/lands_payv2/6_sistemas_4245.png";
//                $instruction_lines = ['INSTRUÇÃO 1', 'INSTRUÇÃO 2', 'INSTRUÇÃO 3'];
                $instruction_lines = [];

                try {
                    $payment = $order->payments()
                            ->setBoleto($expiration_date, $logo_uri, $instruction_lines)
                            ->execute();
                    $resposta->payment = $payment;
                } catch (Exception $e) {
                    $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
                    $resposta->erro_payment = $e;
                    return $resposta;
                }
                break;
            default:
                $expirationMonth = intval($dados->payment->credit_card->expiration_month);
                $expirationYear = intval($dados->payment->credit_card->expiration_year);
                $number = str_replace(" ", "", $dados->payment->credit_card->number);
                $cvc = intval($dados->payment->credit_card->cvc);

                try {
//            $payment = $order->payments()->setCreditCard(12, 21, '4073020000000002', '123', $customer)
                    $payment = $order->payments()->setCreditCard($expirationMonth, $expirationYear, $number, $cvc, $customer)
                            ->setInstallmentCount(intval($dados->parcelas))
                            ->execute();
//ver($payment);
                    $resposta->payment = $payment;
                } catch (Exception $e) {


                    $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);
                    $resposta->erro_payment = $e;
                    return $resposta;
                }

                break;
        }
        $this->model_recebimento->armazena_log('log_retornos', 'moip', $resposta, $dados, $recebimento->Id_int, 9, $sistema->Id_int);

//        ver($resposta);
        return $resposta;
    }

    function executa_cron() {

        $sql = "select pr.*,p.status from pagamentos_retornos  pr left outer join pagamentos p on p.Id_int=pr.id_pagamento 
            where pr.meio='moip' and p.status!='pago' and p.status!='cancelado' and pr.ambiente='{$this->ambiente}' and p.id_sistema='{$this->id_sistema}'";

        $pagamentos = $this->executa_sql($sql);


        if ($pagamentos[0]->Id_int) {
            foreach ($pagamentos as $pagamento) {
                $dados = json_decode($pagamento->retorno_jso);
                $pagamento->id_pagamento_moip = $dados->payment->id;
                $pagamento->status_pagamento_moip = $dados->payment->status;
                $pagamento->dados = $dados;

                $pagto_atualizado = $this->busca_pagamento($pagamento->id_pagamento_moip);

                if (!$pagto_atualizado) {
                    $pagto_atualizado = new StdClass();
                    $pagto_atualizado->status = 'CANCELLED';
                }

                switch ($pagamento->status_pagamento_moip) {
                    case 'IN_ANALYSIS':


                        break;

                    default:
                        break;
                }


                $status_tratado = $this->model_landspay->trata_status_moip($pagto_atualizado->status);


                $this->model_landspay->atualiza_status($pagamento, 'moip', $status_tratado, $this->ambiente);
            }

//           $sql = "select * from pagamentos_retornos where meio='moip'";
//        $pagamentos=$this->executa_sql($sql);


            return $pagamentos;
        } else {
            echo "nenhum pagamento para ser processado para o sistema {$this->id_sistema}<br>";
            return false;
        }
    }

    function trata_status_moip($status) {


        switch ($status) {

            case 'AUTHORIZED':
                $status = 'pago';
                break;
            case 'IN_ANALYSIS':
                $status = 'aguardando';
                break;
            case 'CANCELLED':
                $status = 'cancelado';
                break;
            case 'REFUNDED':
                $status = 'estornado';
                break;
            
            case 'em análise':
                $status = 'aguardando';
                break;

            default :
                $status = 'aguardando';
                break;
        }

        return $status;
    }

}

