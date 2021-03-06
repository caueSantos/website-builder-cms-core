<?php

require_once(COMMONPATH . 'core/lands_core.php');
require_once(COMMONPATH . 'libraries/Facebook.php');

use Facebook4\FacebookSession;

/**
 * Constructor
 *
 * @access public
 */
class lands_embando extends lands_core {

    public $usuario_logado;
    public $permissions = 'email,public_profile,user_about_me';
    //    public $permissions = 'manage_pages,read_friendlists,read_stream,create_event,manage_notifications, publish_stream';
    public $is_logged = 'nao';
    public $fbuser;
    public $fb_name;
    public $fb;
    public $retorno = '';
    public $logout_url;
    public $user_profile;

    function __construct() {
        parent::__construct();

        $this->load->library('Form_validation');

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);



        $this->verifica_login_facebook();
    }

    function index() {
        die('lands_core nao possui metodo index');
    }

    function carrega_model($model, $id_conexao = null) {
        try {
            if ($id_conexao == null) {
                $id_conexao = $this->app->Conexoes_for;
            }
            $this->load->database('default', null, true);
            $this->conecta_mbc($id_conexao);
            $this->load->model($model, $model, $this->dados_conexao);
            $this->$model->db = $this->load->database($this->dados_conexao, TRUE);
            $this->load->database($this->dados_conexao, null, TRUE);
            return true;
        } catch (Exception $e) {
            echo $e;
            return false;
        }
    }

    function login_facebook() {


        if ($this->fbuser) {
            try {
                $this->user_profile = $this->fb->api('/me');
            } catch (FacebookApiException $e) {
                $this->fbuser = null;
            }
        } else {
            $this->fb->destroySession();
        }

        if ($this->fbuser) {


            $this->logout_url = $this->fb->getLogoutUrl();
        } else {
            $segment1 = '';
            $segment2 = '';
//               
//            $redirect_link = $this->app->Url_facebook_txf;
            $redirect_link = $this->app->Url_cliente;
            if ($this->uri->segment($this->app->Segmento_padrao_txf)) {
                $segment1 = $this->uri->segment($this->app->Segmento_padrao_txf);
                $redirect_link.=$segment1;
            }
            if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                $segment2 = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                $redirect_link.='/' . $segment2;
            }
            $this->login_url = $this->fb->getLoginUrl(array('canvas' => 0, 'fbconnect' => 1, 'scope' => $this->permissions, 'redirect_uri' => $redirect_link));
        }
        echo "<script> top.location='$this->login_url'; </script>";
        die();
    }

    ## OVERRIDE ##

    function carrega_pagina($nome_pagina = null) {
        if (!isset($nome_pagina)) {
            $nome_pagina = $this->pagina_atual;
        }

        $nome_pagina = strtolower($nome_pagina);
        $this->carrega_dados($nome_pagina);
        if (isset($this->app->fb_app_ID) && ($this->app->fb_secret)) {
            $this->carrega_queries_face($nome_pagina);
        }
        $this->switch_pagina();

        $this->model_smarty->render($this->pagina_atual, $this->app->Template_txf);
    }

    ## OVERRIDE LANDS_CORE ##

    function switch_pagina() {
        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));
        $this->conecta_mbc($this->app->Conexoes_for);
        switch ($this->pagina_atual) {
            case 'inicio':
                break;
        }
    }

    ## OVERRIDE ##

    function carrega_queries_face($nome_pagina = null) {
        if (!isset($nome_pagina)) {
            $nome_pagina = $this->pagina_atual;
        }

        //     $meus_dados = $this->lands_fb->buscar('me', 'feed');
        $queries = $this->model_banco->buscar_tudo("queries_fb where $this->clausula_exibicao_paginas");
        if (isset($queries[0]->Id_int)) {


            foreach ($queries as $query) {
                $limite = '';

                switch ($query->Api_sel) {
                    case 'GRAPH_API':
                        if ($query->Limite_txf != '') {
                            $limite = '?limit=' . $query->Limite_txf;
                        }
                        $resposta = $this->get($query->Id_objeto_txf, $query->Item_txf . $limite);
                        break;

                    case 'FQL':
                        $consulta = str_replace('{fbuser}', $this->fbuser, $query->Fql_txa);
                        $resposta = $this->fb->api(array('method' => 'fql.query', 'query' => $consulta));

                        break;
                    case 'CUSTOM':

                        $resposta = $this->fb->api('/' . $query->Custom_get_txf, 'GET');

                        break;
                }
                $resposta = array_to_object($resposta);
                $this->smarty->assign($query->Variavel_txf, $resposta);
            }
        }
    }

    function get($object_id = 'me', $item = '', $tipo = 'GET') {

        switch ($object_id) {
            case 'me' :

                return $this->fb->api('/' . $this->fbuser . '/' . $item, 'GET');

                break;
            default :
                return $this->fb->api('/' . $object_id . '/' . $item, 'GET');
                break;
        }
    }

    function verifica_login_facebook() {
        $this->return_url = $this->app->Url_cliente;
        $this->fb = new Facebook(array('appId' => $this->app->fb_app_ID, 'secret' => $this->app->fb_secret, 'cookie' => false));
//        if($this->pagina_atual==$this->app->Pagina_inicial_txf){
//            $this->fb->clearAllPersistentData();
//        $this->fb->deleteSharedSessionCookie();
//        } 
//            ver($this->fb);
        $this->fbuser = $this->fb->getUser();
// ver($this->fbuser); 
        if (!$this->fbuser) {
            $this->login_facebook();
        } else {
            $this->user_profile = $this->fb->api('me?fields=id,name,email,cover,picture', 'GET');
            $this->fb_name = $this->user_profile['name'];
        }
    }

    function logout() {

        $this->fb->destroySession();
        $this->fb->setAccessToken('');
        $this->fb->clearAllPersistentData();
        $this->fb->deleteSharedSessionCookie();
        $this->session->sess_destroy();
        $params = array('next' => $this->app->Url_cliente);
        $x = $this->fb->getLogoutUrl($params);


        redirect($x);
    }

}