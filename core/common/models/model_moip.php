<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');
require COMMONPATH . 'third_party/moip/vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

class Model_moip extends Model_banco_cliente {

    public $db;
    public $app;
    public $moip;
    public $app_id = 'APP-KCM1YBBDN23W';
    public $app_secret = "6a5c3867d9704a47837a84d375e0df92";

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

            $pagamento = $this->moip->payments()->get($id);


            if ($retorna_objeto) {
                $retorno = $pagamento;
            } else {
                $resultado = $pagamento->retorna_dados();
                $retorno = $resultado;
            }

            return $retorno;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            echo "<br>";
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

    function inicializa($app, $cliente = null, $id_sistema = null, $conta_moip = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
        if (!$id_sistema) {
            die('Erro ao iniciar o modulo moip, Id do sistema é obrigatório');
        } else {
            $this->id_sistema = $id_sistema;
        }





        $this->inicia_moip($id_sistema, $conta_moip);
    }

    function inicia_moip($id_sistema, $email_conta = FALSE) {

        $and = "";
        if ($email_conta) {

            $and = " and Email_secundario_txf='{$email_conta}'";
            $email = " e email $email_conta";
        }

        $sql = "select * from moip where id_sistema='{$id_sistema}' $and  and Ativo_sel='SIM'  limit 1";

        $varmoip = $this->executa_sql($sql);
        if (!$varmoip[0]) {

            echo $email_conta;

            die("configuracao de moip nao encontrada para o appss {$id_sistema} <br>{$sql} {$email}");
        }



        $token = $varmoip[0]->Token_txf;
        $key = $varmoip[0]->Chave_txf;
        $this->ambiente = $varmoip[0]->Tipo_sel;
//        $this->app_id = "APP-KCM1YBBDN23W";
        $this->id_secundario = FALSE;
        $this->email_secundario = FALSE;
        if ($varmoip[0]->Id_secundario_txf) {
            $this->id_secundario = $varmoip[0]->Id_secundario_txf;
            $this->email_secundario = $varmoip[0]->Email_secundario_txf;
        }

        $this->dados_moip = $varmoip[0];




        switch ($varmoip[0]->Tipo_sel) {
            case 'SANDBOX':
                echo "executando em SANDBOX<br>";
                $this->moip = new Moip(new MoipBasicAuth($token, $key), Moip::ENDPOINT_SANDBOX);
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

    function gera_botao_moip($dados) {
        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }
        $sql = "select * from moip where id_sistema='{$id_sistema}' and Ativo_sel='SIM' limit 1";

        $this->moip = $this->executa_sql($sql);
        if (!$this->moip[0]) {
            die("configuracao de moip nao encontrada para o app {$id_sistema}");
        }

        $botao['referencia'] = $dados->referencia;
        $botao['clientenome'] = $dados->nome;
        $botao['clienteemail'] = $dados->email;
        $botao['produto'] = $dados->produto;
        $botao['valororiginal'] = $dados->valor;
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

//        $botao['chave'] = $this->moip[0]->Chave_txf;
//        $botao['token'] = $this->moip[0]->Token_txf;

        $dadosmoip = array_to_object($botao);
        $this->smarty->assign('dadosmoip', $dadosmoip);
        $this->model_smarty->carrega_bloco('botao_moip', 'botao_moip', $this->app->Template_txf);
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

    function atualiza_pedidos_moip() {
        
    }

    function set_app_id($param) {
        $this->app_id = $param;
    }

    function set_app_secred($param) {
        $this->app_secret = $param;
    }

    function busca_dados_conta($codigo = null) {
        if (!$codigo) {
            $codigo = "b27e639c0a0c1cd244a23091da9a532d4909afd9";
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

    public function processa_pagamento($dados) {


        if (!$dados->id_sistema) {

            die('id do sistema nao foi passado');
        } else {
            $id_sistema = $dados->id_sistema;
        }





//        $this->inicia_moip($id_sistema);


        $referencia = $_POST['referencia'];
        $pagamento_existente = $this->model_landspay->procura_pagamento($referencia);
        if (!$dados->forca_pagamento) {
            if ($pagamento_existente) {

                switch ($pagamento_existente->status) {
                    case 'AUTHORIZED':
                        $mensagem = 'Este pedido já está pago!';
                        echo $mensagem;
                        break;
                    case 'IN_ANALYSIS':
                        $mensagem = 'Você já possui um pagamento em análise para este pedido!';
                        echo $mensagem;
                        break;
//                    case 'CANCELLED':
//                        $mensagem = 'O pagamento para este pedido está cancelado!';
//                        break;
                    default:
                        break;
                }
            }
        }



        $quantidade = $_POST['quantidade'];
        $clientenome = $_POST['clientenome'];
        $clienteemail = $_POST['clienteemail'];
        $clientetelefone = $_POST['telefone'];
        $valor = str_replace(",", ".", $_POST['valor']);
        $produto = $_POST['produto'];
        $clientetelefone = str_replace("(", "", $clientetelefone);
        $clientetelefone = str_replace(")", "", $clientetelefone);
        $clientetelefone = str_replace("-", "", $clientetelefone);


        $nascimento = $_POST['nascimento'];

        $ddd = intval(substr($clientetelefone, 0, 2));
        $numero = intval(substr($clientetelefone, 2, 10));


        $resposta = new stdClass();
        $postData = json_encode($_POST);
        $this->model_landspay->armazena_requisicao($dados, $postData, 'moip');
        try {
            $customer = $this->moip->customers()->setOwnId(uniqid())
                    ->setFullname($dados->clientenome)
                    ->setEmail($dados->clienteemail)
                    ->setBirthDate($nascimento)
                    ->setTaxDocument($dados->clientecpf)
                    ->setPhone($ddd, $numero)
                    ->addAddress('BILLING', $dados->usuario->Endereco_txf, intval($dados->usuario->Numero_txf), $dados->usuario->Bairro_txf, $dados->usuario->Cidade_txf, $dados->usuario->Estado_sel, $dados->usuario->Cep_txf)
                    ->addAddress('SHIPPING', $dados->usuario->Endereco_txf, intval($dados->usuario->Numero_txf), $dados->usuario->Bairro_txf, $dados->usuario->Cidade_txf, $dados->usuario->Estado_sel, $dados->usuario->Cep_txf)
                    ->create();
            $resposta->customer = $customer;
        } catch (Exception $e) {
            $resposta->erro_customer = $e;
            return $resposta;
        }




        $valor = intval(number_format($dados->valor, 0, "", ""));
        $qtd = intval(number_format($dados->quantidade, 0, "", ""));

        try {
            $order = $this->moip->orders()->setOwnId(uniqid());
            $order->addItem($dados->produto, $qtd, $dados->referencia, $valor);
//                        ->addItem("bicicleta 10", 1, "sku10", 19000)
//                        ->setShippingAmount(3000)->setAddition(1000)->setDiscount(5000)

            $order->setCustomer($customer);

            if ($this->id_secundario) {
                $porcentagem = intval(number_format($valor * $qtd * 0.9, 0, "", ""));
                $order->addReceiver($this->id_secundario, 'SECONDARY', $porcentagem);
            }
            $order->create();
            $resposta->orders = $order;
        } catch (Exception $e) {
            $resposta->erro_orders = $e;
            return $resposta;
        }


        $expirationMonth = intval($dados->val1);
        $expirationYear = intval($dados->val2);
        $number = str_replace(" ", "", $dados->CardNumber);
        $cvc = intval($dados->SecurityCode);

        try {
//            $payment = $order->payments()->setCreditCard(12, 21, '4073020000000002', '123', $customer)
            $payment = $order->payments()->setCreditCard($expirationMonth, $expirationYear, $number, $cvc, $customer)
                    ->execute();

            $resposta->payment = $payment;
        } catch (Exception $e) {
            $resposta->erro_payment = $e;
            return $resposta;
        }

        $this->smarty->assign('dados', $dados);


//        $responseData = json_encode($resposta);


        $this->model_landspay->armazena_retorno($dados, $resposta, 'moip');

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
                    $pagto_atualizado=new StdClass();
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

}

