<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'libraries/REST_Controller.php');

class webservice extends REST_Controller {

    public $modulo = 'webservice';

    function __construct() {
        parent::__construct();

        $this->load->helper('pitacos');
        $this->carrega_model('model_pitacos');


        header("Access-Control-Allow-Origin: *", true);
        header("Access-Control-Allow-Credentials: true", true);
//        header("Access-Control-Allow-Methods: OPTIONS, GET, POST", true);

        header("Access-Control-Allow-Headers: access-token,cache-control, content-type", true);
        header("Access-Control-Max-Age: 842100", true);

        $this->response->format = 'json';
//ver('chegou');
        $this->merge_inputs();

        $funcao = $this->router->method;
        $funcao.="_";
        $funcao.=$this->request->method;
        $this->funcao = $funcao;

        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            die();
        }
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
                $this->response(array('codigo' => 500, 'status' => 'error', 'message' => 'JSON inválido.'), 200);
                //  echo $exc->getTraceAsString();
            }
        }
    }
 
    function rodadas_get() {
        $rodadas = $this->model_pitacos->busca_rodadas();
        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => array_values($rodadas)), 200);
    }

    function ultimos_pitacos_get() {
        if ($_REQUEST['limit']) {
            $limite = $_REQUEST['limit'];
        } else {
            $limite = 5;
        }
        $pitacos = $this->model_pitacos->busca_ultimos_pitacos($limite);
        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $pitacos), 200);
    }

    function rodada_get() {
        if ($this->uri->segment(3)) {
            $id_rodada = $this->uri->segment(3);
        } else {
                        $id_rodada= $this->model_pitacos->busca_id_rodada_ativa();
//            $this->response(array('codigo' => 404, 'status' => 'error', 'message' => "Parâmetro id da rodada é obrigatório"), 200);
        }
        $rodada = $this->model_pitacos->busca_rodada($id_rodada);
        if ($rodada) {
            $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $rodada), 200);
        } else {
            $this->response(array('codigo' => 404, 'status' => 'error', 'message' => "Rodada não encontrada"), 200);
        }
    }

    function ranking_get() {
        if ($this->uri->segment(3)) {
            $id_rodada = $this->uri->segment(3);
        } else {
            $id_rodada= $this->model_pitacos->busca_id_rodada_encerrada();
        }
        $rodada = $this->model_pitacos->busca_ranking($id_rodada);
        if ($rodada) {
            $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $rodada), 200);
        } else {
            $this->response(array('codigo' => 404, 'status' => 'error', 'message' => "Rodada não encontrada"), 200);
        }
    }

    function jogos_rodada_get() {
        if ($this->uri->segment(3)) {
            $id_rodada = $this->uri->segment(3);
        } else {
             $id_rodada= $this->model_pitacos->busca_id_rodada_ativa();
        }
        $jogos = $this->model_pitacos->busca_jogos_rodada($id_rodada);
        $this->response(array('codigo' => 200, 'status' => 'success', 'data' => $jogos), 200);
    }

    function exemplo_post() {
//        $this->response(array('codigo' => 400, 'status' => 'error', 'message' => 'Nenhum campo enviado!'), 200);
        $dados = array_to_object($_POST);
        $this->load->library('validacao');


        if (!$_POST) {
            $this->response(array('codigo' => 400, 'status' => 'error', 'message' => 'Nenhum campo enviado!'), 200);
        }
//regras de validacao de acesso de busca à clínica
        $rules1 = array(
            array('field' => 'Resultados_for', 'label' => 'Resultados_for', 'rules' => 'trim|required'),
            array('field' => 'Login_txf', 'label' => 'Login_txf', 'rules' => 'trim|required'),
            array('field' => 'Senha_txf', 'label' => 'Senha_txf', 'rules' => 'trim|required'),
            array('field' => 'Referencia_txf', 'label' => 'Referencia_txf', 'rules' => 'trim|required'),
        );
        $this->validacao->set_rules($rules1);

        if ($this->validacao->run() != false) {
            $resultado = $this->model_resultado_login->insere_atualiza($dados);
            $this->response(array('codigo' => 200, 'status' => 'success', 'message' => 'Login inserido com sucesso', "data" => $resultado), 200);
        } else {
            $this->response(array('codigo' => 403, 'status' => 'error', 'message' => $this->validacao->get_msg_erro()), 200);
        }
    }

}

