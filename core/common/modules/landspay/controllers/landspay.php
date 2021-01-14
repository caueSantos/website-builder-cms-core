<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');
require_once(COMMONPATH . "third_party/pagseguro/PagSeguroLibrary/PagSeguroLibrary.php");

class landspay extends lands_core {

    public $modulo = 'landspay';
    public $aplicativo;
    public $compra;
    public $id_sistema = 3;

    public function __construct() {
        parent::__construct();
        $this->load->helper('landspay');
//        echo "redirecionando...";
//        redireciona("https://landspay.landshosting.com.br/v2/");
        $this->inicializa();
    }

    function index() {
        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
            $funcao_atual = $this->pagina_atual;
            $this->$funcao_atual();
        }
    }

    function inicializa() {
        $this->carrega_model('model_recebimento');
        $this->model_recebimento->inicializa($this->app, $this->cliente);
        $this->conecta_mbc(0);
        $this->smarty->assign('modulo', $this->modulo);
    }

    function switch_pagina() {
        $this->conecta_mbc($this->app->Conexoes_for);

        switch ($this->pagina_atual) {
            case 'pagar':

                if ($_POST) {

                    $dados = array_to_object($_POST);
                    if (!$dados->id_sistema || !$dados->referencia) {
                        die('necessarios id sistema e referencia no post');
                    }
                } else {

                    if (!$this->uri->segment(2) || !$this->uri->segment(3)) {
                        die('necessarios id sistema e referencia nos segmentos 2 e 3');
                    }

                    $dados->id_sistema = $this->uri->segment(2);
                    $dados->referencia = $this->uri->segment(3);
                }

                $recebimento = $this->model_recebimento->insere_atualiza($dados);



                $meios = explode(',', $recebimento->meios);
                foreach ($meios as $meio) {
                    if ($meio == 'moip') {
                        $recebimento->aceita_moip = 'SIM';
                    }
                    if ($meio == 'pagseguro') {
                        $recebimento->aceita_pagseguro = 'SIM';
                    }
                }


                $this->smarty->assign('recebimento', $recebimento);
                if (!$recebimento) {
                    die('recebimento nao encontrado');
                }

                $usuario = $this->model_recebimento->insere_atualiza_usuario($recebimento);
                $this->smarty->assign('usuario_temp', $usuario);
                if (!$this->model_recebimento->valida_campos_usuario($usuario)) {
                    $dados_temp = new stdClass();
                    $dados_temp->id_recebimento = $recebimento->Id_int;
                    $dados_temp->id_usuario = $usuario->Id_int;


                    $this->session->set_userdata('dados_temp', $dados_temp);
                    redireciona($this->app->Url_cliente . "cadastro");
                }

                $sistema = $this->model_recebimento->busca_sistema_id($recebimento->id_sistema);
                $this->smarty->assign('sistema', $sistema);

                $conta_moip = $this->model_recebimento->busca_conta_moip_id($sistema->Contas_moip_for);
                $this->smarty->assign('conta_moip', $conta_moip);


                break;
            case 'cadastro':
                $dados_temp = $this->session->userdata['dados_temp'];
                $recebimento = $this->model_recebimento->busca_recebimento_id($dados_temp->id_recebimento);
                $this->smarty->assign('recebimento', $recebimento);
                $usuario = $this->model_recebimento->busca_usuario_id($dados_temp->id_usuario);
                $this->smarty->assign('usuario_temp', $usuario);

                break;

            case 'dados-conta':
                if ($this->uri->segment(2)) {
                    $code = $this->uri->segment(2);
                } else {
                   $code="2aea2d010b1bd5c40077a02affb1160421a694fa";
                }
                
                $headers = array(
                    'Authorization: Basic R0tUSkRIT1FFSVpJQklLU09ZWkJQMkwwQkRaWjE2NE06R0tBUERFV0k0TExRS0RDMkNVUkxaQlZRQURUU1E0NUVFV0Q4S1dNRA=='
                ); //coloque o seu basic
                //$acessToken = "1ef3f073852342ee94e264285a2e99e4_v2";
                $client_id = "APP-KCM1YBBDN23W";
                $grant_type = "authorization_code";
                //$code = "b27e639c0a0c1cd244a23091da9a532d4909afd9"; //que você pegou gerando a primeira url, code do cliente https://dev.moip.com.br/v2.0/reference#intro
                $redirect_uri = "https://landspay.landshosting.com.br/conta-moip";
                $client_secret = "6a5c3867d9704a47837a84d375e0df92"; //secret dos dados do seu app

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
                echo "<pre>";
                print_r($resultado);
                echo "</pre>";
                die();

                break;
        }
    }

    function enviar() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $pagina = $this->uri->segment(2);
        switch ($pagina) {
            case 'atualiza_registro':
                $dados = $_POST;
                break;

            case 'cadastro':
                $dados = array_to_object($_POST);
//                $dados->nascimento = data_bd($dados->nascimento);
//                ver($dados, 1);
                $usuario = $this->model_recebimento->insere_atualiza_usuario($dados);

//                ver($usuario);
                if (!$this->model_recebimento->valida_campos_usuario($usuario)) {
                    $dados_temp = new stdClass();
                    $dados_temp->id_recebimento = $dados->Id_int;
                    $dados_temp->id_usuario = $usuario->Id_int;
                    $this->session->set_userdata('dados_temp', $dados_temp);
                    redireciona($this->app->Url_cliente . "cadastro");
                }
                $recebimento = $this->model_recebimento->busca_recebimento_id($dados->id_recebimento);
                $id_sistema = $recebimento->id_sistema;
                $referencia = $recebimento->referencia;

                if (isset($this->session->userdata['dados_temp'])) {
                    $this->session->unset_userdata('dados_temp');
                }
                redireciona($this->app->Url_cliente . "pagar/{$id_sistema}/{$referencia}");
                break;

            case 'processa_moip':
                $dados = array_to_object($_POST);

                $sistema = $this->model_recebimento->busca_sistema_id($dados->id_sistema);
                $conta_moip = $this->model_recebimento->busca_conta_moip_id($sistema->Contas_moip_for);

                $recebimento = $this->model_recebimento->busca_recebimento_id($dados->id_recebimento);

                $this->smarty->assign('recebimento', $recebimento);
                $usuario = $this->model_recebimento->busca_usuario_id($dados->id_usuario);
                $this->carrega_model('model_moipv2');
                $this->model_moipv2->inicializa($this->app, $this->cliente, $sistema, $conta_moip);
                $resposta = $this->model_moipv2->processa_pagamento($dados, $recebimento, $usuario, $sistema);

                if ($resposta->pagamento_duplo) {
                    $status = 'pagamento_duplo';
                    $this->smarty->assign("status", $status);
                    $this->model_smarty->render_ajax('resposta_moip', $this->app->Template_txf);
                    die();
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
                        $erro->Codigo_txf = $erro->getCode();
                        $erro->Descricao_txf = $erro->getDescription();
                    }
                    $status_ingles = "ERROR";
                } else {
//                    $moipera = $this->model_moipv2->cria_objeto($this->model_moipv2->moip);
//                    $this->smarty->assign("moip", $moipera);
                    $pagamento = $this->model_moipv2->busca_pagamento($id_pagto);
                    $this->smarty->assign("pagamento", $pagamento);
                    $status_ingles = $pagamento->status;
                    $status = $this->model_moipv2->trata_status_moip($status_ingles);
                    $this->model_recebimento->atualiza_status($recebimento->Id_int, 'moip', $status, $conta_moip->Tipo_sel);
                    $id_pagamento = $resposta->payment->getId();
                    $this->model_recebimento->atualiza_id_pagto($recebimento->Id_int, $id_pagamento);
                }

                $this->smarty->assign("status", $status);
                $this->smarty->assign("erros", $erros);
                $this->smarty->assign("total", $total_erros);
                $this->smarty->assign("resposta", $resposta);
                $this->model_smarty->render_ajax('resposta_moip', $this->app->Template_txf);

                die();
                break;
        }
    }

}

?>