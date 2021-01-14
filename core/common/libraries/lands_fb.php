<?php

require_once('Facebook.php');

class lands_fb {

      public $appId;
      public $secret;
      public $returnurl;
      public $permissions = 'email';
      //    public $permissions = 'manage_pages,read_friendlists,read_stream,create_event,manage_notifications, publish_stream';
      public $is_logged = 'nao';
      public $fbuser;
      public $fb;
      public $retorno = '';
      public $logout_url;
      public $app;
      private $CI;

      function lands_fb($app = null) {
            $this->CI = & get_instance();


            $this->inicializa($app);
      }

      function inicializa($app) {
            $this->app = $app;
            $this->return_url = $this->app->Url_cliente;

            $this->fb = new Facebook(array('appId' => $this->app->fb_app_ID, 'secret' => $this->app->fb_secret, 'cookie' => true));
            $this->fbuser = $this->fb->getUser();
            $this->retorno = '';
      }

      function get($object_id = 'me', $item = '', $tipo = 'GET') {
            $this->fbuser = $this->fb->getUser();
            
            switch ($object_id) {
                  case 'me' :
                        if ($this->fbuser != 0) {


                              return $this->fb->api('/' . $this->fbuser . '/' . $item, 'GET');
                        } else {


                              $this->login();
                        }
                        break;
                  default :
                        return $this->fb->api('/' . $object_id . '/' . $item, 'GET');
                        break;
            }
      }

      public function login() {


            if ($this->fbuser) {
                  try {
                        $data['user_profile'] = $this->fb->api('/me');
                  } catch (FacebookApiException $e) {
                        $this->fbuser = null;
                  }
            } else {
                  $this->fb->destroySession();
            }

            if ($this->fbuser) {

                  $this->logout_url = $this->fb->getLogoutUrl();
            } else {

                  $this->login_url = $this->fb->getLoginUrl(array('canvas' => 1, 'fbconnect' => 1, 'scope' => $this->permissions, 'redirect_uri' => $this->app->Url_cliente));
//               
            }
            echo "<script> top.location='$this->login_url'; </script>";
            die();
      }

      public function logout() {

            $this->CI->load->library('facebook', array('appId' => $this->app->fb_app_ID, 'secret' => $this->app->fb_secret));

            // Logs off session from website
            $this->facebook->destroySession();
            $this->facebook->setSession(null);
            // Make sure you destory website session as well.

            $data['logout_url'] = $this->CI->facebook->getLogoutUrl();
            redirect($data['logout_url']);
      }

}
