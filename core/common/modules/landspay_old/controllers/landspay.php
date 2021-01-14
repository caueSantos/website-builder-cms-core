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

        if ($_POST['conta_moip']) {
            $this->conta_moip = $_POST['conta_moip'];
            $this->session->set_userdata('conta_moip', $this->conta_moip);
        } else {
            $this->conta_moip = $this->session->userdata['conta_moip'];
        }

        if ($_POST['id_sistema']) {
            $this->id_sistema = $_POST['id_sistema'];
            $this->session->set_userdata('id_sistema', $this->id_sistema);
        } else {
            $this->id_sistema = $this->session->userdata['id_sistema'];
        }
        $this->smarty->assign('conta_moip', $this->conta_moip);
        $this->smarty->assign('id_sistema', $this->id_sistema);

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        $this->smarty->assign('modulo', $this->modulo);
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

    function teste_sandbox() {



        $curl = curl_init();

        $post = [
            'client_id' => 'APP-8F5RNFMCB23X',
            'grant_type' => 'authorization_code',
            'code' => 'e0bb05f81f43d06514b2cc746e69b1cdea7eb5e5',
            'redirectUri' => 'https://landspay.landshosting.com.br/conta-moip',
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://connect-sandbox.moip.com.br/oauth/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS => "client_id=APP-LJPHAUELAQO6&grant_type=authorization_code&code=4d9d528edb254067cd768f1f7e9e6568c1a5e62a&redirectUri=https://landspay.landshosting.com.br/conta-moip",
            CURLOPT_HTTPHEADER => array(
                "authorization: Basic MzNLOUtCVVI3V1JCRFgwM0FITFdDNFlOT0hLNlBYWVQ6OFVESFI5UTlFSVJWRUtGSTVER1ZJM1dJSldJMU4yQ0FGTFNLSTBPRQ==",
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: cbd5357d-c217-053d-b024-9e61d2c412a7"
            ),
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {


            echo $response;
        }
    }

    function enviar() {
        $this->carrega_model('model_landspay');
        $this->carrega_model('model_moip');
        $this->model_landspay->inicializa($this->app, $this->cliente);

        $this->model_moip->inicializa($this->app, $this->cliente, $this->id_sistema, $this->conta_moip);
//        $this->model_moip->inicia_moip(3);

        $pagina = $this->uri->segment(2);

        switch ($pagina) {
            case 'atualiza_registro':

                $dados = $_POST;
                if (!isset($dados['Tabela_txf']))
                    die('Campo Tabela_txf nao encontrado');
                if (!isset($dados['Id_int']))
                    die('Campo Id_int nao encontrado');
//            $dados['Ultima_atualizacao_dat'] = retorna_date_time();
                $this->mbc->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int']);
                redirect($_POST['pagina_anterior']);

                break;
            case 'venda':
                $cadastro = $this->cria_atualiza_conta();

                $this->cria_venda($cadastro);




                break;
        }
    }
    
    function grava_log($mensagem,$tabela=null){
     
        $mensagem.=json_encode($this->session->all_userdata());
        $data['Acao_txa']=$mensagem;
        
        $data['Data_dat']=date('Y-m-d');
        $data['Hora_txf']=date('H:i:s');

        $log = $this->mbc->db_insert('logs',$data,TRUE);
        return $log;
    }

    function cria_venda($cadastro = null) {

        $this->grava_log("passou pelo cria_venda");
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $dados = $_POST;

 

        if ($this->session->userdata['usuario']->Id_int) {

            $id_usuario = $this->session->userdata['usuario']->Id_int;
            $dados['id_cadastro'] = $this->session->userdata['usuario']->Id_int;
        } else {

            die('Erro ao criar usuário');
        }

        $dados['Data_dat'] = date('Y-m-d H:i:s');
        if ($cadastro) {
            $dados['nascimento'] = $cadastro->nascimento;
        }


        $vendas = $this->mbc->db_insert("vendas", $dados, TRUE);
//        $vendas = $this->mbc->executa_sql("select v.Id_int as referencia, v.* from vendas v where v.id_cadastro={$id_usuario} order by Id_int desc limit 1");

        if ($vendas) {

            $vendas->referencia = $vendas->Id_int;
            $vendas->conta_moip = $this->conta_moip;

            $this->smarty->assign('venda', $vendas);
            $this->model_smarty->render_ajax('finalizar_venda', $this->app->Template_txf);
            die();
        } else {
            die('Erro ao reg_istrar a venda!');
        }
    }

    function cria_atualiza_conta() {
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];

        $dados = $_POST;



        $sql = "select * from cadastros where cpf='{$cpf}' and email='{$email}'";
        $cadastros = $this->mbc->executa_sql($sql);


        if ($cadastros[0]) {
            $dados['Atualizacao_dat'] = date('Y-m-d H:i:s');
            if ($cadastros[0]->nascimento == '0000-00-00') {

                $data = $dados['nascimento'];
                $DFm = explode("/", $data);
                $dados['nascimento'] = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
                echo "cadastro com data de nascimento inválida <br>";
            } else {
                unset($dados['nascimento']);
            }



            $this->mbc->updateTable("cadastros", $dados, 'Id_int', $cadastros[0]->Id_int);
        } else {

            $data = $dados['nascimento'];
            $DFm = explode("/", $data);
            $dados['nascimento'] = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
            $dados['Tipo_sel'] = 'usuario';
            $dados['Data_dat'] = date('Y-m-d H:i:s');


            $this->mbc->db_insert("cadastros", $dados);
        }



        $cadastros = $this->mbc->executa_sql($sql);

        $this->session->set_userdata('usuario', $cadastros[0]);
        return $cadastros[0];
    }

    function switch_pagina() {
        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_model('model_landspay');
        $this->carrega_model('model_moip');


        $this->model_landspay->inicializa($this->app, $this->cliente);



//        $this->model_moip->inicia_moip(3);

        switch ($this->pagina_atual) {
            case 'inicio':

                break;
            case 'pagar':
//         


                $pgto = $this->valida_pagamento();

                $tmp = $this->session->userdata['pagamento'];


                if (!$this->id_sistema) {
                    $this->id_sistema = $this->uri->segment(2);
                }


                $imagem = $tmp;

//                $this->smarty->assign('imagem',$imagem);
//                
                $sql = "select * from pagamentos where Id_int=$tmp->Id_int";
                $pagamento_temp = $this->mbc->executa_sql($sql);
                $pagamento = $pagamento_temp[0];
//                $sql = "select * from cadastros where cpf='{$pagamento->cpf}' and email='{$pagamento->email}'";

                $pagamento->Aplicativo = array();
                $pagamento->Aplicativo = $this->mbc->buscar_completo("aplicativos", "where Id_int='{$pagamento->id_sistema}'");

//                $this->smarty->assign("usuario",$usuario[0]);


                $this->smarty->assign('pagamento', $pagamento);
                
                if ($this->pagamento->status != 'pago') {
                    $this->gera_botoes();
                }
                break;

            case 'cadastro':


                if ($this->session->userdata['dados_temp']) {
                    $dados_compra = $this->session->userdata['dados_temp'];
                    $dados_compra->nascimento_pt = arruma_data($dados_compra->nascimento, 'd/m/Y');
                    $this->smarty->assign('dados_compra', $dados_compra);

                    $cadastros = $this->mbc->executa_sql("select * from cadastros where cpf='{$dados_compra->cpf}' and email='{$dados_compra->email}'");
                    if ($cadastros[0]) {
                        $cadastros[0]->nascimento_pt = arruma_data($cadastros[0]->nascimento, 'd/m/Y');

                        $this->smarty->assign('cadastro', $cadastros[0]);
                    }
//              
                } else {
                    if ($this->session->userdata['usuario']) {
                        
                    }

                    die('Erro ao criar usuario temporario na sessao!');
                }

                break;
            case 'retornos':
                $retornos = $this->mbc->executa_sql('select * from retornos order by Id_int DESC ');
                foreach ($retornos as $retorno) {
                    $retorno->Request_txf = json_decode($retorno->Request_txf);
                }
                $this->smarty->assign('retornos', $retornos);
                break;

            case 'pagamentos_retornos':
                $this->checa_login('pagamentos_retornos');
                $retornos = $this->mbc->executa_sql('select * from pagamentos_retornos order by Id_int DESC ');
                foreach ($retornos as $retorno) {

                    $retorno->Retorno = json_decode($retorno->retorno_jso);
                    if ($retorno->meio == 'moip') {
                        $retorno->usuario = $retorno->Retorno->customer->fullname;
                        $retorno->status = $retorno->Retorno->payment->status;
                    }
                }
                $this->smarty->assign('retornos', $retornos);
                break;
            case 'conta-moip' :


                $this->model_moip->inicializa($this->app, $this->cliente, $this->id_sistema, $this->conta_moip);
//                $this->model_moip->inicializa($this->app, $this->cliente, 3);
                $this->smarty->assign('app_id', $this->model_moip->app_id);
                $this->smarty->assign('app_secret', $this->model_moip->app_secret);

                if ($_REQUEST['code']) {
                    $code = $_REQUEST['code'];
                    $this->smarty->assign('code', $code);

                    $dados_conta = array_to_object($this->model_moip->busca_dados_conta($code));
                    if (!$dados_conta->accessToken) {

                        $erro = $dados_conta->error;
                        $this->smarty->assign('erro', $erro);
                    } else {
                        $this->smarty->assign('dados_conta', $dados_conta);
//                       
                    }
                }




                break;
            case 'pagamentos':
                $this->checa_login('pagamentos');
                $pagamentos = $this->mbc->executa_sql('select * from pagamentos order by Id_int DESC ');


                $this->smarty->assign('pagamentos', $pagamentos);
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
                $this->model_landspay->processa_pagseguro();
                break;
            case 'moip':
                $dados = array_to_object($_POST);
                $this->model_moip->inicializa($this->app, $this->cliente, $this->id_sistema, $this->conta_moip);

                $sql = "select * from cadastros where cpf='{$dados->clientecpf}' and email='{$dados->clienteemail}'";
                $usuario = $this->mbc->executa_sql($sql);


                $dados->usuario = $usuario[0];


                $resposta = $this->model_moip->processa_pagamento($dados);

//                
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




//                    if ($resposta->payment) {
//
//                        $id = $resposta->payment->getId();
//
//                        $newpayment = $resposta->payment->get($id);
//                        $status_ingles = $newpayment->getStatus();
//
//                     
//                    } else {
//                        $status = "ERROR";
//                    }
                } else {
                    $moipera = $this->model_moip->cria_objeto($this->model_moip->moip);
                    $this->smarty->assign("moip", $moipera);
                    $pagamento = $this->model_moip->busca_pagamento($id_pagto);

                    $this->smarty->assign("pagamento", $pagamento);
//                    $cliente_moip = $this->model_moip->busca_cliente($id_cliente);
//                    $this->smarty->assign("cliente_moip", $cliente_moip);
//                    $compra = $this->model_moip->busca_compra($id_compra);
//                    $this->smarty->assign("compra", $compra);
                    $status_ingles = $pagamento->status;
                }

                $status = $this->model_moip->trata_status_moip($status_ingles);


                $this->smarty->assign("status", $status);



                $this->smarty->assign("erros", $erros);
                $this->smarty->assign("total", $total_erros);

                $this->smarty->assign("resposta", $resposta);

                $this->model_landspay->atualiza_status($dados, 'moip', $status);
                if (isset($this->session->userdata['dados_temp'])) {
                    $this->session->unset_userdata('dados_temp');
                }
                if (isset($this->session->userdata['pagamento'])) {
                    $this->session->unset_userdata('pagamento');
                }

                $this->model_smarty->render_ajax('resposta_moip', $this->app->Template_txf);

                die();
//               
                break;
            case 'cielo':
                $dados = array_to_object($_POST);

                $dados->ExpirationDate = $_POST['val1'] . '/' . $_POST['val2'];
//                
                $this->model_recebimento->processa_cielo($dados);
                break;
            case 'retorno_cielo':
//                


                break;
            default:
                die('pagina nao existente');
                break;
        }
    }

    function cron_moip() {

        $this->carrega_model('model_landspay');
        $this->carrega_model('model_moip');
        $this->model_landspay->inicializa($this->app, $this->cliente);

        $contas_moip = $this->mbc->executa_sql("select * from moip where Tipo_sel='PRODUCAO' and Ativo_sel='SIM'");
//        $sql = "select pr.*,p.status from pagamentos_retornos  pr left outer join pagamentos p on p.Id_int=pr.id_pagamento where pr.meio='moip' and p.status!='pago' and p.status!='cancelado' and pr.ambiente='{$this->ambiente}'";
//        where pr.meio='moip' and p.status!='pago' and p.status!='cancelado' and pr.ambiente='{$this->ambiente}'

        foreach ($contas_moip as $conta) {

            $this->model_moip->inicializa($this->app, $this->cliente, $conta->id_sistema, $conta->Email_secundario_txf);

            $this->model_moip->executa_cron();
        }
//        $this->model_moip->inicializa($this->app, $this->cliente, 3);
//        $this->model_moip->inicia_moip(3);
    }

    function valida_pagamento() {


        if ($_POST) {

            $dados = $_POST;
            $this->valida_conta();

            $id_sistema = $dados['id_sistema'];
            $referencia = $dados['referencia'];
            
//            if ($dados['referencia']) {
//                $referencia = $dados['referencia'];
//            } else {
//                $referencia = date('YmdHis');
//                $dados['referencia'] = $referencia;
//            }
//
            if (!$referencia) {
                die('referencia nao passada');
            }

//ver($_POST);

            $dados['Atualizacao_dat'] = date('Y-m-d H:i:s');

            $pagamento = $this->busca_pagamento($id_sistema, $referencia);
            
            if ($dados['nascimento']) {
                if (strpos($dados['nascimento'], '/') !== false) {
                    $data = $dados['nascimento'];
                    $DFm = explode("/", $data);
                    $dados['nascimento'] = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
                }
            } else {

                if (strpos($this->session->userdata('dados_temp')->nascimento, '/') !== false) {
                    $data = $this->session->userdata('dados_temp')->nascimento;
                    $DFm = explode("/", $data);
                    $dados['nascimento'] = $DFm[2] . '-' . $DFm[1] . '-' . $DFm[0];
                }
            }
            



            if ($pagamento) {

                $this->mbc->updateTable("pagamentos", $dados, 'Id_int', $pagamento[0]->Id_int);
            } else {

                $dados['Data_dat'] = date('Y-m-d H:i:s');
                $pagamento = $this->mbc->db_insert("pagamentos", $dados,TRUE);
            }
            
            $this->session->set_userdata('pagamento',$pagamento);
            $link = $this->app->Url_cliente . "pagar/$id_sistema/$referencia";


            redirect($link);
//            $pagamento_atualizado = $this->busca_pagamento($id_sistema, $referencia);
//            if (!$pagamento_atualizado) {
//                die('Falha ao registrar o pagamento no banco');
//            }
        } else {


            
            if ($this->uri->segment(2)) {
                $id_sistema = $this->uri->segment(2);

                if ($this->uri->segment(3)) {
                    $referencia = $this->uri->segment(3);
                } else {
                    die('Id do pagamento faltando');
                }
            } else {
                if ($this->session->userdata['pagamento']) {
                    $id_sistema = $this->session->userdata['pagamento']->id_sistema;
                    $referencia = $this->session->userdata['pagamento']->referencia;
                } else {
                    die('Id do aplicativo faltando');
                }
            }

         
            $pagamento_atualizado = $this->busca_pagamento($id_sistema, $referencia);

            if (!$pagamento_atualizado) {
                die('Falha ao criar este pedido de pagamento');
            } else {
                return $pagamento_atualizado;
            }
        }
    }

    function valida_conta() {





        if (!$_POST['nome'] || !$_POST['email'] || !$_POST['cpf'] || !$_POST['nascimento']) {


            $this->session->set_userdata('dados_temp', array_to_object($_POST));



            redirect('cadastro');
//            $this->pagina_atual='cadastro';
        } else {

            $sql = "select * from cadastros where cpf='{$_POST['cpf']}' and email='{$_POST['email']}'";

            $usuario = $this->mbc->executa_sql($sql);

            if (!$usuario[0]->Endereco_txf || !$usuario[0]->nascimento) {
                echo "Faltam dados para o cadastro<br>";
                $this->session->set_userdata('dados_temp', array_to_object($_POST));

                redirect('cadastro');
            } else {
                $this->session->set_userdata('usuario', $usuario[0]);
            }
        }
    }

    function consulta_link() {

        if ($this->uri->segment(2)) {
            $id_sistema = $this->uri->segment(2);
        } else {
            die('Id do sistema faltando');
        }
        if ($this->uri->segment(3)) {
            $referencia = $this->uri->segment(3);
        } else {
            die('Id do pagamento faltando');
        }

        $sql = "select pr.*,p.status from pagamentos_retornos  pr left outer join pagamentos p on p.Id_int=pr.id_pagamento where p.id_sistema='{$id_sistema}' and  p.referencia='{$referencia}'";



        $pagamentos = $this->mbc->executa_sql($sql);
        $retorno = $pagamentos[0]->retorno_jso;
        return $this->trata_retorno_consulta($retorno);
    }

    function consulta_pagamento() {



        if ($this->uri->segment(2)) {
            $id_sistema = $this->uri->segment(2);
        } else {
            die('Id do sistema faltando');
        }
        if ($this->uri->segment(3)) {
            $referencia = $this->uri->segment(3);
        } else {
            die('Id do pagamento faltando');
        }

//        https://landspay.landshosting.com.br/consulta_pagamento/4/2067    
//        ver($referencia);



        $sql = "select p.* from pagamentos p left outer join vendas v on v.Id_int=p.referencia where p.id_sistema='{$id_sistema}' and v.referencia='{$referencia}'";


        $pagamentos = $this->mbc->executa_sql($sql);

        $this->trata_retorno_consulta($pagamentos);
    }

    function trata_retorno_consulta($pagamentos) {
        $retorno = 'json';
        if (isset($_REQUEST['retorno'])) {
            $retorno = $_REQUEST['retorno'];
        }
        $this->load->library('Format');

        $dados = object_to_array($pagamentos);

        switch ($retorno) {
            case 'xml':
                echo header("Content-type: text/xml; charset=utf-8");
                $resposta = $this->format->to_xml($dados);
                print_r($resposta);
                die();
                break;
            case 'json':
                echo header("Content-Type: application/json; charset=UTF-8");
                $resposta = json_encode($dados);
                print_r($resposta);
                die();
                break;
        }
    }

    function busca_pagamento($id_sistema, $referencia) {
        $sql = "select * from pagamentos where id_sistema='{$id_sistema}' and referencia='{$referencia}'";

        $pagamentos = $this->mbc->executa_sql($sql);


        //    ver($pagamentos,1,var_name($pagamentos,  get_defined_vars())); 



        if ($pagamentos[0]) {
            $pagamentos[0]->Aplicativo = array();
            $pagamentos[0]->Aplicativo = $this->mbc->buscar_completo("aplicativos", "where Id_int='{$pagamentos[0]->id_sistema}'");
            if (!$pagamentos[0]->Aplicativo[0]) {
                die('Aplicativo inválido');
            }
            if ($pagamentos[0]->nascimento == '0000-00-00') {
                die('pagamento sem data de nascimento');
            }
            $this->pagamento = $pagamentos[0];

            $this->smarty->assign("pagamento", $this->pagamento);
            $this->session->set_userdata('pagamento', $this->pagamento);
        } else {
            echo "pagamento nao existente<br>";
            $this->pagamento = null;
        }

        return $pagamentos;
    }

    function busca_venda($id_sistema, $referencia) {


        $pagamentos = $this->mbc->buscar_completo("vendas", "where id_sistema='{$id_sistema}' and referencia='{$referencia}'");


        //    ver($pagamentos,1,var_name($pagamentos,  get_defined_vars())); 



        if ($pagamentos[0]) {
            $pagamentos[0]->Aplicativo = array();
            $pagamentos[0]->Aplicativo = $this->mbc->buscar_completo("aplicativos", "where Id_int='{$pagamentos[0]->id_sistema}'");
            if (!$pagamentos[0]->Aplicativo[0]) {
                die('Aplicativo inválido');
            }
            if ($pagamentos[0]->nascimento == '0000-00-00') {
                die('pagamento sem data de nascimento');
            }
            $this->pagamento = $pagamentos[0];

            $this->smarty->assign("pagamento", $this->pagamento);
            $this->session->set_userdata('pagamento', $this->pagamento);
        } else {
            echo "pagamento nao existente<br>";
            $this->pagamento = null;
        }

        return $pagamentos;
    }

    function gera_botoes() {

//        if($pgto){
//            $this->pagamento=$pgto;
//        }
        $meios = explode(',', $this->pagamento->meios);
        $dados = $this->pagamento;


        $dados->valor = formata_moeda($dados->valor);



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
                case 'moip':

                    $this->model_moip->inicializa($this->app, $this->cliente, $this->id_sistema, $this->conta_moip);
                    $usuario = $this->session->userdata['usuario'];
                    $this->smarty->assign('usuario', $usuario);

                    $this->model_landspay->gera_botao_moip($dados);
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