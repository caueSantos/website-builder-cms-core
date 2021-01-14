<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'libraries/REST_Controller.php');

//include(COMMONPATH . 'third_party/php-jwt/vendor/autoload.php');
//
//use \Firebase\JWT\JWT;

class webservice extends REST_Controller {

    public $modulo = 'webservice';
    public $cadastro;
    public $configuracoes;
    public $aplicativo;
    public $laboratorio;
    public $clinica;
    public $key = "TJVA95OrM7E2cBab30RMHrHDcEfxjoYZgeFONFh7HgQ";

    function __construct() {

        parent::__construct();

//               die('LandsPay is died'); 
        header("Access-Control-Allow-Origin: *", true);
        header("Access-Control-Allow-Credentials: true", true);
        header("Access-Control-Allow-Headers: access-token, x-api-key, x-lab-id, x-user-id, x-cli-id, cache-control, content-type", true);
        header("Access-Control-Max-Age: 842100", true);
        $this->response->format = 'json';

        $this->merge_inputs();

        $funcao = $this->router->method;
        $funcao.="_";
        $funcao.=$this->request->method;
        $this->funcao = $funcao;

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            die();
        }

        $this->carrega_model('model_recebimento');
        $this->model_recebimento->inicializa($this->app, $this->cliente);

//        $this->libera_app();
//        if ($this->funcao != 'cadastros_post' && $this->funcao != 'clinicas_post') {
//            $this->autentica();
//        }
    }

    function merge_inputs() {

        $headers = getallheaders();
        $this->request->content_type = $headers['Content-Type'];
        if (strpos($this->request->content_type, 'application/json') > -1) {
            try {
                $json = file_get_contents('php://input');
                if ($json) {
                    $input = json_decode($json, true);
                    if ($input) {
                        $_REQUEST = array_merge($_REQUEST, $input);
                    }
                }
            } catch (Exception $exc) {
                $this->response(array('codigo' => 500, 'status' => 'error', 'message' => 'JSON invalido.'), 200);
                //  echo $exc->getTraceAsString();
            }
        }
    }

    function order_payments_get() {
        if ($this->uri->segment(3)) {
            $id_recebimento = $this->uri->segment(3);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Order id não enviado"), 200);
        }

        $recebimento = $this->model_recebimento->busca_recebimento_id($id_recebimento);
        $recebimento->pagamentos = $this->model_recebimento->busca_pagamentos($id_recebimento);

        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $recebimento), 200);
    }

    function external_order_payments_get() {
        if ($this->uri->segment(3)) {
            $id_sistema = $this->uri->segment(3);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Id do sistema não enviado"), 200);
        }
        if ($this->uri->segment(4)) {
            $referencia = $this->uri->segment(4);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Referência da compra não informado"), 200);
        }

        $recebimento = $this->model_recebimento->busca_recebimento($id_sistema, $referencia);

        $recebimento->pagamentos = $this->model_recebimento->busca_pagamentos($recebimento->Id_int);

        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $recebimento), 200);
    }

    function external_order_get() {
        if ($this->uri->segment(3)) {
            $id_sistema = $this->uri->segment(3);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Id do sistema não enviado"), 200);
        }
        if ($this->uri->segment(4)) {
            $referencia = $this->uri->segment(4);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Referência da compra não informado"), 200);
        }

        $recebimento = $this->model_recebimento->busca_recebimento($id_sistema, $referencia);

        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $recebimento), 200);
    }

    function order_get() {
        if ($this->uri->segment(3)) {
            $id_recebimento = $this->uri->segment(3);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Order id não enviado"), 200);
        }

        $recebimento = $this->model_recebimento->busca_recebimento_id($id_recebimento);
        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $recebimento), 200);
    }

    function order_post() {

//       print_r('oii');
//       die();



        /* VALIDAÇÃO    */
        $this->load->library('validacao');
        /* se não passar o requesta para o post a validação não funciona */
        $_POST = $_REQUEST;

        if (!$_POST) {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Nenhum campo enviado"), 200);
        }

        switch ($_POST['meio_escolhido']) {
            case 'cielo':
                if ($_POST['referencia']) {
                    
                    
                    $rules = array(
                        array('field' => 'referencia', 'label' => 'referencia', 'rules' => 'required'),
//                        array('field' => 'tipo_pagto', 'label' => 'tipo_pagto', 'rules' => 'trim|required'),
//                        array('field' => 'meios', 'label' => 'meios', 'rules' => 'trim|required'),
//                        array('field' => 'prazo', 'label' => 'prazo', 'rules' => 'trim|required'),
//                        array('field' => 'maximo_parcelas', 'label' => 'maximo_parcelas', 'rules' => 'trim|required'),
//                    array('field' => 'nome', 'label' => 'nome', 'rules' => 'trim|required'),
//                    array('field' => 'nascimento', 'label' => 'nascimento', 'rules' => 'trim|required'),
//                    array('field' => 'telefone', 'label' => 'telefone', 'rules' => 'trim|required'),
//                        array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required'),
//                        array('field' => 'produto', 'label' => 'produto', 'rules' => 'trim|required'),
                        array('field' => 'valor', 'label' => 'valor', 'rules' => 'trim|required'),
                        array('field' => 'parcelas', 'label' => 'parcelas', 'rules' => 'trim|required'),
//                        array('field' => 'taxa', 'label' => 'taxa', 'rules' => 'trim|required'),
//                        array('field' => 'juro', 'label' => 'juro', 'rules' => 'trim|required'),
//                    array('field' => 'cpf', 'label' => 'cpf', 'rules' => 'trim|required'),
//                        array('field' => 'quantidade', 'label' => 'quantidade', 'rules' => 'trim|required'),
//            array('field' => 'url_retorno', 'label' => 'url_retorno', 'rules' => 'trim|required'),
                        array('field' => 'meio_escolhido', 'label' => 'meio_escolhido', 'rules' => 'trim|required'),
//            array('field' => 'status', 'label' => 'status', 'rules' => 'trim|required')
                    );
                } else {
                    $rules = array(
                        array('field' => 'referencia', 'label' => 'referencia', 'rules' => 'required'),
                        array('field' => 'tipo_pagto', 'label' => 'tipo_pagto', 'rules' => 'trim|required'),
                        array('field' => 'meios', 'label' => 'meios', 'rules' => 'trim|required'),
                        array('field' => 'prazo', 'label' => 'prazo', 'rules' => 'trim|required'),
                        array('field' => 'maximo_parcelas', 'label' => 'maximo_parcelas', 'rules' => 'trim|required'),
//                    array('field' => 'nome', 'label' => 'nome', 'rules' => 'trim|required'),
//                    array('field' => 'nascimento', 'label' => 'nascimento', 'rules' => 'trim|required'),
//                    array('field' => 'telefone', 'label' => 'telefone', 'rules' => 'trim|required'),
                        array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required'),
                        array('field' => 'produto', 'label' => 'produto', 'rules' => 'trim|required'),
                        array('field' => 'valor', 'label' => 'valor', 'rules' => 'trim|required'),
                        array('field' => 'parcelas', 'label' => 'parcelas', 'rules' => 'trim|required'),
                        array('field' => 'taxa', 'label' => 'taxa', 'rules' => 'trim|required'),
                        array('field' => 'juro', 'label' => 'juro', 'rules' => 'trim|required'),
//                    array('field' => 'cpf', 'label' => 'cpf', 'rules' => 'trim|required'),
                        array('field' => 'quantidade', 'label' => 'quantidade', 'rules' => 'trim|required'),
//            array('field' => 'url_retorno', 'label' => 'url_retorno', 'rules' => 'trim|required'),
                        array('field' => 'meio_escolhido', 'label' => 'meio_escolhido', 'rules' => 'trim|required'),
//            array('field' => 'status', 'label' => 'status', 'rules' => 'trim|required')
                    );
                }

                break;

            default:
                $rules = array(
                    array('field' => 'referencia', 'label' => 'referencia', 'rules' => 'required'),
                    array('field' => 'tipo_pagto', 'label' => 'tipo_pagto', 'rules' => 'trim|required'),
                    array('field' => 'meios', 'label' => 'meios', 'rules' => 'trim|required'),
                    array('field' => 'prazo', 'label' => 'prazo', 'rules' => 'trim|required'),
                    array('field' => 'maximo_parcelas', 'label' => 'maximo_parcelas', 'rules' => 'trim|required'),
                    array('field' => 'nome', 'label' => 'nome', 'rules' => 'trim|required'),
                    array('field' => 'nascimento', 'label' => 'nascimento', 'rules' => 'trim|required'),
                    array('field' => 'telefone', 'label' => 'telefone', 'rules' => 'trim|required'),
                    array('field' => 'email', 'label' => 'email', 'rules' => 'trim|required'),
                    array('field' => 'produto', 'label' => 'produto', 'rules' => 'trim|required'),
                    array('field' => 'valor', 'label' => 'valor', 'rules' => 'trim|required'),
                    array('field' => 'parcelas', 'label' => 'parcelas', 'rules' => 'trim|required'),
                    array('field' => 'taxa', 'label' => 'taxa', 'rules' => 'trim|required'),
                    array('field' => 'juro', 'label' => 'juro', 'rules' => 'trim|required'),
                    array('field' => 'cpf', 'label' => 'cpf', 'rules' => 'trim|required'),
                    array('field' => 'quantidade', 'label' => 'quantidade', 'rules' => 'trim|required'),
//            array('field' => 'url_retorno', 'label' => 'url_retorno', 'rules' => 'trim|required'),
                    array('field' => 'meio_escolhido', 'label' => 'meio_escolhido', 'rules' => 'trim|required'),
//            array('field' => 'status', 'label' => 'status', 'rules' => 'trim|required')
                );
                break;
        }


        $this->validacao->set_rules($rules);

        if ($this->validacao->run() != false) {
            switch ($_POST['meio_escolhido']) {
                case 'cielo':
                    $this->processa_cielo_transparente();

                    break;

                default:
                 
                    $this->processa_pagamento_transparente();
                    break;
            }
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => $this->validacao->get_msg_erro()), 200);
        }
    }

    function insere_atualiza_usuario($dados) {

        $usuario = new stdClass();
        $usuario->nome = $dados->nome;
        $usuario->email = $dados->email;
        $usuario->nascimento = $dados->nascimento;
        $usuario->telefone = $dados->telefone;
        $usuario->cpf = $dados->cpf;
        $usuario->Cep_txf = $dados->payment->customer->zip_code;
        $usuario->Endereco_txf = $dados->payment->customer->street;
        $usuario->Numero_txf = $dados->payment->customer->streetNumber;
        $usuario->Bairro_txf = $dados->payment->customer->district;
        $usuario->Cidade_txf = $dados->payment->customer->city;
        $usuario->Estado_sel = $dados->payment->customer->state;

//        ver($usuario);

        return $this->model_recebimento->insere_atualiza_usuario($usuario);
    }

    function processa_cielo_transparente() {


        /* CRIA RECEBIMENTO */
        $dados = array_to_object($_REQUEST);



        $sistema = $this->model_recebimento->busca_sistema_id($dados->id_sistema);

//         ver($sistema);

        $conta_cielo = $this->model_recebimento->busca_conta_cielo_id($sistema->Contas_cielo_for);

//        ver($dados);
        $recebimento = $this->model_recebimento->insere_atualiza($dados);
//        $recebimento = $this->model_recebimento->busca_recebimento_id($dados->id_recebimento);
//        $this->smarty->assign('recebimento', $recebimento);
//        ver($recebimento);
//        $usuario = $this->model_recebimento->busca_usuario_id($dados->id_usuario);

        $this->carrega_model('model_cielo');
        $this->model_cielo->inicializa($this->app, $this->cliente, $sistema, $conta_cielo);


        $resposta = $this->model_cielo->processa_pagamento_transparente($dados, $recebimento, null, $sistema);



        if ($resposta->pagamento_duplo) {
            $status = 'pagamento_duplo';
            $this->smarty->assign("status", $status);
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => 'Pagamento ja realizado!'), 200);
            die();
        }

//                ver($resposta);
        if (!$resposta['Payment']) {
            foreach ($resposta as $erro) {
                $err = new StdClass();
                $err->Codigo_txf = $erro['Code'];
                $err->Descricao_txf = $erro['Message'];
                $erros[] = $err;
            }

            $resposta['retorno_pagto'] = 'erro';
            $resposta['retorno_mensagem'] = $this->model_cielo->trata_retorno($resposta[0]['Code'], $resposta[0]['Message']);
        } else {


            switch ($resposta['Payment']['Status']) {
                case '2':
                    $resposta['retorno_pagto'] = 'pago';
                    break;

                default: $resposta['retorno_pagto'] = 'aguardando';
                    break;
            }

            $resposta['retorno_mensagem'] = $this->model_cielo->trata_retorno($resposta['Payment']['ReturnCode']);
        }



        $status = $resposta['retorno_pagto'];
//                $status = $this->model_moipv2->trata_status_moip($status_ingles);
//                ver($conta_cielo);
        $this->model_recebimento->atualiza_status($recebimento->Id_int, 'cielo', $status, $conta_cielo->ambiente);

        if ($resposta['Payment']['PaymentId']) {
//                    ver('vai atualizar o id do pagto');

            $pagto_atualizado = $this->model_recebimento->atualiza_id_pagto($recebimento->Id_int, $resposta['Payment']['PaymentId']);
        }

        $msg = '';
        foreach ($erros as $erro) {
            $msg.= $erro->Codigo_txf . ' ' . $erro->Descricao_txf . ' <br>';
        }

        switch ($status) {
            case 'erro':
                $msg.= 'Erro, não foi possível efetuar o pagamento';
                $this->response(array('codigo' => 403, 'status' => 'error', 'message' => $msg), 200);

                break;
            case 'cancelado':
                $msg.= 'Cancelado, não foi possível efetuar o pagamento';
                $this->response(array('codigo' => 403, 'status' => 'error', 'message' => $msg), 200);

                break;
            case 'aguardando':
                $msg.= 'Seu Pagamento está em análise!';
                $this->response(array('codigo' => 200, 'status' => 'success', 'message' => $msg), 200);

                break;
            case 'pago':
                $msg.= 'Pagamento efetuado com sucesso!';
                $this->response(array('codigo' => 200, 'status' => 'success', 'message' => $msg), 200);

                break;

            default:
                break;
        }
    }

    function processa_pagamento_transparente() {

        
//        ver('chegou');
        /* CRIA RECEBIMENTO */
        $dados = array_to_object($_REQUEST);

        $usuario_atualizado = $this->insere_atualiza_usuario($dados);
        $recebimento = $this->model_recebimento->insere_atualiza($dados);

        /* CRIA PAGAMENTO */
        $sistema = $this->model_recebimento->busca_sistema_id($dados->id_sistema);
        $conta_moip = $this->model_recebimento->busca_conta_moip_id($sistema->Contas_moip_for);
        
        

//        ver($conta_moip);
        $this->carrega_model('model_moipv2');
        $this->model_moipv2->inicializa($this->app, $this->cliente, $sistema, $conta_moip);



        $resposta = $this->model_moipv2->processa_pagamento_transparente($dados, $recebimento, $sistema);
//        ver('chegou2');
//          $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "oi caue3"), 200);
        if ($resposta->pagamento_duplo) {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => 'Pagamento ja realizado!'), 200);
        }

        $erros = array();
        if ($resposta->erro_customer) {
            $erros = array_merge($erros, $resposta->erro_customer->getErrors());
        } else {
            if ($resposta->customer) {
                $id_cliente = $resposta->customer->getId();
            }
        }
        if ($resposta->erro_orders) {
            $erros = array_merge($erros, $resposta->erro_orders->getErrors());
        } else {
            if ($resposta->orders) {
                $id_compra = $resposta->orders->getId();
            }
        }

        if ($resposta->erro_payment) {
            $erros = array_merge($erros, $resposta->erro_payment->getErrors());
        } else {
            if ($resposta->payment) {
                $id_pagto = $resposta->payment->getId();
            } else {
                
            }
        }


        $total_erros = conta($erros);
        if ($total_erros != 0) {
            foreach ($erros as $erro) {
                $erro->codigo = $erro->getCode();
                $erro->descricao = $erro->getDescription();
            }
            $status_ingles = "ERROR";
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => 'Erro ao efetuar pagamento', 'errors' => $erros), 200);
        } else {
            $pagamento = $this->model_moipv2->busca_pagamento($id_pagto);



            //    $this->response(array('codigo' => 200, 'status' => 'success', 'message' => 'Transa��o ok', 'dados' => $pagamento), 200);
            $status_ingles = $pagamento->status;


            $status = $this->model_moipv2->trata_status_moip($status_ingles);

            $this->model_recebimento->atualiza_status($recebimento->Id_int, 'moip', $status, $conta_moip->Tipo_sel);

            $this->model_recebimento->atualiza_status_original($recebimento->Id_int, $resposta->payment->getStatus());
            $id_pagamento = $resposta->payment->getId();



            $pagto_atualizado = $this->model_recebimento->atualiza_id_pagto($recebimento->Id_int, $id_pagamento);
            switch ($pagamento->fundingInstrument->method) {
                case 'BOLETO':

                    $resposta->link_redirect = $pagamento->_links->payBoleto->redirectHref;
                    $resposta->link_print = $pagamento->_links->payBoleto->printHref;
                    $resposta->metodo = 'boleto';
                    $pagto_atualizado->link_redirect = $resposta->link_redirect;
                    $pagto_atualizado->link_print = $resposta->link_print;
                    break;

                default:
                    $resposta->metodo = 'cartao';
                    break;
            }
//            ver($pagto_atualizado);
//            $this->response(array('codigo' => 200, 'status' => 'success', 'message' => 'Transa��o ok', 'dados' => $pagamento), 200);
            $this->response(array('codigo' => 200, 'status' => 'success', 'message' => 'Transação realizada', 'data' => $pagto_atualizado), 200);
        }
    }

    /*

      function login_post() {
      $dados = $_POST;


      $retorno = $this->model_login->autentica_usuario($dados);
      $this->model_login->set_laboratorio($this->laboratorio);

      if ($retorno->data) {
      if ($retorno->data->Ativo_sel == 0) {
      $this->model_usuario->envia_ativacao($retorno->data);
      $this->response(array('codigo' => 403, 'status' => 'error', 'message' => "Usu�rio Inativo, um email foi enviado para {$retorno->data->Email_txf} com o link para ativar sua conta!"), 200);
      }

      //            ver($retorno->data);
      switch ($dados['origem']) {
      case 'externo':
      $redirect_link = $dados['redirec_link'];
      $dados->Laboratorios_for = $this->laboratorio->Id_int;
      $this->model_usuario->cria_token_login($retorno->data);

      $link_login = $this->model_login->cria_link_login_auto($retorno->data->Id_int, $redirect_link);

      $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $link_login), 200);

      break;

      default:
      $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $retorno->data), 200);
      break;
      }

      //            $usuario->dados = $this->model_usuario->busca_dados_usuario($usuario->Id_int);
      } else {

      $this->response(array('codigo' => $retorno->codigo, 'status' => 'error', 'message' => "{$retorno->message}"), 200);
      }
      }

      function cria_api_key($id_app, $token) {

      $app = $this->mbc->executa_sql("select * from aplicativos where Id_int=$id_app");
      if ($app[0]) {
      $key = $token;
      $token = array(
      "Id_int" => $id_app,
      "Data_dat" => time()
      );
      $jwt = JWT::encode($token, $key);
      } else {
      return false;
      }
      return $jwt;
      }

      function cria_chave_post() {
      $id = $_POST['Id_int'];

      $token = md5(time());
      $retorno = new stdClass();
      $retorno->token = $token;
      $retorno->key = $this->cria_api_key($id, $token);


      if (isset($token)) {
      $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $retorno), 200);
      } else {
      $this->response(array('codigo' => 404, 'status' => 'error', 'message' => 'O registro especificado n�o foi encontrado!'), 200);
      }
      }

      function gera_token($payload, $exp = 7200) {
      $key = $this->config->config['encryption_key'];
      $token = JWT::encode($payload, $key);

      return $token;
      }

      function auth_post() {
      $email = $_REQUEST['Email_txf'];
      $senha = $_REQUEST['Senha_txf'];
      //ver($_REQUEST);
      $usuario = $this->model_usuario->busca_cadastro($email);
      //        ver($usuario);
      if ($usuario) {


      if (md5($senha) == $usuario->Senha_txf) {
      $usuario->Laboratorio = $this->model_usuario->busca_laboratorio_usuario($usuario->Id_int);
      $usuario->Clinica = $this->model_usuario->busca_clinica_usuario($usuario->Id_int);
      $retorno = $this->gera_token($usuario);
      $usuario->Laboratorios_for = $usuario->Laboratorio->Id_int;
      $usuario->Clinicas_for = $usuario->Clinica->Id_int;
      //                $this->response(array('codigo' => 401, 'status' => 'error', 'message' => 'Senha inv�lida.'), 200);
      //                ver($usuario);
      $this->session->set_userdata('usuario', $usuario);



      $this->response(array('codigo' => 200, 'status' => 'success', 'message' => 'Usu�rio autenticado.', 'data' => $retorno), 200);
      } else {
      $this->response(array('codigo' => 401, 'status' => 'error', 'message' => 'Senha inv�lida.'), 200);
      }
      } else {
      $this->response(array('codigo' => 401, 'status' => 'error', 'message' => 'Login inv�lido.'), 200);
      }
      }

      function autoriza_token() {

      //        ver('chegou no autoriza');
      $token = $_SERVER['HTTP_ACCESS_TOKEN'];

      try {

      $usuario = JWT::decode($token, $this->config->config['encryption_key'], array('HS256'));

      if ($usuario->Laboratorio) {
      //                $this->model_laboratorio->set_laboratorio($usuario->Laboratorio->Id_Int);
      $this->laboratorio = $this->model_laboratorio->busca_laboratorio($usuario->Laboratorio->Id_int);
      $_SERVER['HTTP_X_LAB_ID'] = $this->laboratorio->Id_int;
      }


      if ($usuario->Clinica) {

      $this->clinica = $this->model_clinica->busca_clinica($usuario->Clinica->Id_int);
      $this->laboratorio = $this->model_laboratorio->busca_laboratorio($this->clinica->Laboratorios_for);
      $_SERVER['HTTP_X_CLI_ID'] = $this->clinica->Id_int;
      $_SERVER['HTTP_X_LAB_ID'] = $this->laboratorio->Id_int;
      }

      $this->usuario = $this->model_usuario->busca_usuario($usuario->Id_int);
      $_SERVER['HTTP_X_USU_ID'] = $this->usuario->Id_int;
      } catch (Exception $e) {

      $this->response(array('codigo' => 401, 'status' => 'error', 'message' => 'Token inv�lido.'), 200);
      }
      }

      function libera_app() {

      if ($this->funcao != 'auth_post') {


      if (!$_SERVER['HTTP_X_API_KEY']) {

      $this->autoriza_token();
      //            ver('nao tem api key');
      } else {

      $apikey = $_SERVER['HTTP_X_API_KEY'];

      $this->carrega_model('model_labcloud');

      try {
      list($header, $payload, $signature) = explode(".", $apikey);
      $decoded = JWT::jsonDecode(JWT::urlsafeB64Decode($payload));

      //                $decoded = JWT::decode($apikey, $this->key, array('HS256'));
      $aplicativo = $this->model_labcloud->busca_aplicativo($decoded->Id_int);
      if ($aplicativo) {
      // $validou=JWT::verify($apikey, $aplicativo->Api_key_txf);
      try {
      JWT::decode($apikey, $aplicativo->Api_key_txf, array('HS256'));
      } catch (Excepction $e) {
      $aplicativo = $this->model_labcloud->verifica_api_key($apikey);
      }
      }
      } catch (Exception $e) {
      $aplicativo = $this->model_labcloud->verifica_api_key($apikey);
      }
      if (!$aplicativo) {
      $this->response(array('codigo' => 403, 'status' => 'error', 'error' => 'x-api-key � inv�lida.'), 200);
      } else {
      $this->aplicativo = $aplicativo;
      }
      }
      }
      }

     */
}

