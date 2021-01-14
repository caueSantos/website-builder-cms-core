<?php

require_once(COMMONPATH . 'core/lands_core.php');

class lands_apps extends lands_core {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        die('nao tem index');
    }

    function cria_loga_usuario($fbuser) {


        $usuarios = $this->mbc->executa_sql("select * from users where Facebook_id_txf='{$fbuser['id']}'");
        if ($usuarios[0]) {


            $usuarios[0]->Facebook_id_txf = $fbuser['id'];
            $usuarios[0]->Link_txf = $fbuser['link'];
            $usuarios[0]->Foto_txf = $this->busca_foto_usuario($fbuser['id']);
            $usuario_update = object_to_array($usuarios[0]);
            $usuario_update['Ultimo_login_dat'] = retorna_date_time();

            $this->mbc->updateTable('users', $usuario_update, 'Id_int', $usuario_update['Id_int']);
            $this->login_usuario($usuarios[0]);
        } else {
            $usuario_novo = new stdClass();
            $usuario_novo->Nome_txf = $fbuser['name'];
            $usuario_novo->Facebook_id_txf = $fbuser['id'];
            $usuario_novo->Email_txf = $fbuser['email'];
            $usuario_novo->Link_txf = $fbuser['link'];
            $usuario_novo->Foto_txf = $this->busca_foto_usuario($fbuser['id']);
            $usuario_novo->Senha_txf = '';
            $usuario_inserir = object_to_array($usuario_novo);

            $this->mbc->db_insert('users', $usuario_inserir);
            $usuarios = $this->mbc->executa_sql("select * from users where Facebook_id_txf='{$usuario_novo->Facebook_id_txf}'");
            if ($usuarios) {
                $this->login_usuario($usuarios[0]);
            } else {
                redireciona($this->app->Url_cliente . 'login');
            }
        }
    }

    function busca_foto_usuario($id = '831771160232496') {
        $url = "https://graph.facebook.com/$id/picture?redirect=false";
        $retorno = json_decode($this->get_fb_contents($url));
        $foto = $retorno->data->url;
        return $foto;
    }

    function checa_bloqueio($usuario = FALSE) {



        if ($usuario) {

            $usuario_novo = $this->mbc->executa_sql("select * from users where Id_int={$usuario->Id_int}");
            if ($usuario_novo[0]->Id_int) {

                $usuario = $usuario_novo[0];
                $this->usuario = $usuario;
                $this->smarty->assign('usuario_bloqueado', $this->usuario);

                if ($usuario->Bloqueado_sel == 'SIM') {
                    redireciona('bloqueado');
                }
            }
        }
    }

    function login_usuario($usuario) {


        $this->session->set_userdata('usuario', $usuario);
        

      //  $this->checa_bloqueio($usuario);
        
        if (isset($_REQUEST['redirect_link'])) {
            if ($_REQUEST['redirect_link'] == '/admin') {
                $_REQUEST['redirect_link'] = $this->app->Url_cliente . 'admin';
            }
            redireciona($_REQUEST['redirect_link']);
        } else {
            redireciona($this->app->Url_cliente);
        }
    }

    function fazer_login() {
        
        

        $login = $_REQUEST['Email_txf'];
        $senha = $_REQUEST['Senha_txf'];
        $login = addslashes($login);
        $senha = addslashes($senha);
        $redirect = $_REQUEST['redirect_link'];
        $sql = "select * from users where Email_txf='$login'";
        if (!$_REQUEST['auto']) {
            $sql.=" and ( Senha_txf='$senha') limit 1";
        }
        
        $usuarios = $this->mbc->executa_sql($sql);

        if ($usuarios[0]) {
            $this->login_usuario($usuarios[0]);
        } else {
            $this->smarty->assign('mensagem', 'login_erro');
            $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
            die();
        }
    }
    
    

    function recuperar_senha() {
        if (!isset($_POST['Email_txf'])) {
            die('Email do usuario nao foi passado como parametro');
        }
        $valor = $_POST['Email_txf'];
        $this->conecta_mbc($this->app->Conexoes_for);
        $usu = $this->mbc->executa_sql("select * from users where Email_txf='$valor' limit 1");

        if (isset($usu[0]->Email_txf)) {
            $this->smarty->assign('usuario', $usu[0]);
            $this->load->model('model_login');
            $this->model_login->configura($this->app);
            //$email['Email_txf'] = 'webmaster@landshosting.com.br';
            $email['Email_txf'] = $_POST['Email_txf'];
            $email['Destinatario_txf'] = $_POST['Email_txf'];
            $email['Nome_txf'] = $this->app->Nome_app_txf;
            $email['Assunto_txf'] = 'Recuperação de Senha - ' . $this->app->Nome_app_txf;
            if ($this->envia_email($email, 'recuperacao_senha')) {
                $this->smarty->assign('mensagem', 'recuperacao_ok');
                $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
            } else {
                $this->smarty->assign('mensagem', 'recuperacao_erro');
                $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
            }
        } else {

            $this->smarty->assign('mensagem', 'recuperacao_not_email');
            $this->model_smarty->render_ajax('msg_login', $this->app->Template_txf);
        }
    }

    function login_face() {

        if ($this->uri->segment(2)) {
            $this->redirect_link = $this->uri->segment(2);
        }
//        ver($this->redirect_link);
        
        if ($this->session->userdata['redirect_link']) {
            $_REQUEST['redirect_link'] = $this->session->userdata['redirect_link'];
        } else {
            $_REQUEST['redirect_link'] = $this->app->Url_cliente;
        }


        //$_REQUEST['redirect_link']=  str_replace('login_face/', '',  $this->uri->uri_string) ;


        if (isset($_GET['code']) AND !empty($_GET['code'])) {
            $code = $_GET['code'];
            // parsing the result to getting access token.
            parse_str($this->get_fb_contents("https://graph.facebook.com/oauth/access_token?client_id={$this->app->fb_app_ID}&redirect_uri=" . urlencode($this->app->Url_cliente . "login_face") . "&client_secret={$this->app->fb_secret}&code=" . urlencode($code)));

            redirect('login_face?access_token=' . $access_token);
        }
        if (!empty($_GET['access_token'])) {

            // getting all user info using access token.
            $fbuser_info = json_decode($this->get_fb_contents("https://graph.facebook.com/me?access_token=" . $_GET['access_token']), true);





            // you can get all user info from print_r($fbuser_info);
            if (!empty($fbuser_info['id'])) {
                $this->cria_loga_usuario($fbuser_info);
                // do your stuff.
                //save the data in db save session and redirect.
            } else {
                die('Erro ao logar, não conseguiu acessar o email do usuario');
//                $this->session->set_flashdata('message', 'Error while facebook user information.');
                redirect($this->app->Url_cliente . 'login');
            }
        }
        if ($this->form_validation->run() == FALSE) {
            redirect('inicio'); //  $this->load->view('login'); // loading default view.
        }
    }

    function get_fb_contents($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function envia_email($email, $formulario = null, $copia_cliente = TRUE) {
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        $email['Assunto_txf'];

        if (isset($formulario)) {
            $mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");

//$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
            $email['Mensagem_txa'] = $mensagem;
        }


        $this->load->model('model_mail');
        $this->model_mail->inicializa($this->app);
//             $enviou = $this->model_mail->envia_email($email, 'boolean');
        $enviou = $this->model_mail->envia_email_novo($email, $copia_cliente);

        return $enviou;
    }

}