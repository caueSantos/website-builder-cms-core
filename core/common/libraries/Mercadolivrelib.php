<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(COMMONPATH . 'third_party/mercadolivre/Meli/meli.php');


//        const APPLICATION_ID = 'local.5b62174fc9fdd8.06154315';
//        const APPLICATION_SECRET = '7w5EuTJhiE4cRan4G7BHAkHvX0GlHCFT63AderVFrW8k5RNiHG';
//
//        const PROTOCOL = 'https';
//        const DOMAIN = 'landsagenciaweb.bitrix24.com.br';
//        const REDIRECT_URL = 'https://mautic.landshosting.com.br/autoriza_bitrix/';
//        const PATH = 'https';

/**
 * Mensagem class
 * Classe de envio de mensagens ao usuário
 *
 * @author    Gustavo Vedana Erckmann
 * 
 */
class Mercadolivrelib {

    private $ci;
    public $app;
    public $code = "TG-5c347fe211f1be0006da95df-83879956";
    public $access_token = "APP_USR-7840993360035091-010807-5cba7f7371aca7420cd293ed99f75c6e-83879956";
    public $site = "MLB";

    function __construct() {

        $this->ci = & get_instance();
        if ($this->ci->session->userdata('usuario')) {
            $this->usuario = $this->ci->session->userdata('usuario');
        }
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;
        if ($cliente) {
            $this->cliente = $cliente;
        }
        $this->id = 5501373895555822;
        $this->key = 'c9cKjApqCSTl6TrvsPpkl0Bkfgp1rdF6';
        $this->redirect_uri = "https://landsagenciaweb.com.br/mercadolivre/login_ml";
    }

    function login() {

        $meli = new Meli($this->id, $this->key);
        $siteId = 'MLB';

        // If code exist and session is empty
        if (isset($_GET['code'])) {
            // //If the code was in get parameter we authorize
            try {
                $user = $meli->authorize($_GET["code"], $this->redirect_uri);
                // Now we create the sessions with the authenticated user
                $lands_id = $_SESSION['Lands_id'];
                $this->atualiza_chaves($lands_id, $user);
                die('Login efetuado com sucesso');
            } catch (Exception $e) {
                echo "Exception: ", $e->getMessage(), "\n";
            }
        } else {
            $_SESSION['Lands_id'] = $_REQUEST['Lands_id'];
            echo '<a href="' . $meli->getAuthUrl($this->redirect_uri, Meli::$AUTH_URL[$siteId]) . '">Clique para fazer login utilizando oAuth 2.0</a>';
        }
        die();
    }

    function carrega_chaves() {
        $lands_id = $this->app->Lands_id;

        
        $ml_access_token = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$lands_id}' and Campo_txf='ML_ACCESS_TOKEN'");
         
        $this->access_token = $ml_access_token[0]->Valor_txa;

        $ml_expires_in = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$lands_id}' and Campo_txf='ML_EXPIRES_IN'");
        $this->expires_in = $ml_expires_in[0]->Valor_txa;

        $ml_refresh_token = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$lands_id}' and Campo_txf='ML_REFRESH_TOKEN'");
        $this->refresh_token = $ml_refresh_token[0]->Valor_txa;

        // We can check if the access token in invalid checking the time
        if ($this->expires_in < time()) {
            try {
//                ver('chegou no atualiza');
                $meli = new Meli($this->id, $this->key, $this->access_token, $this->refresh_token);

                // Make the refresh proccess
                $refresh = $meli->refreshAccessToken();
                // Now we create the sessions with the new parameters
                $this->atualiza_chaves($lands_id, $refresh);
            
            } catch (Exception $e) {
                echo "Exception: ", $e->getMessage(), "\n";
            }
        }
    }

    function atualiza_chaves($lands_id, $user) {
        $ml_access_token = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$lands_id}' and Campo_txf='ML_ACCESS_TOKEN'");
        $array_update['Lands_id'] = $lands_id;
        $array_update['Campo_txf'] = 'ML_ACCESS_TOKEN';
        $array_update['Valor_txa'] = $user['body']->access_token;
      
        if ($ml_access_token) {
            $this->ci->model_banco->updateTable("apps_config", $array_update, "Id_int", $ml_access_token[0]->Id_int);
        } else {
            $this->ci->model_banco->db_insert("apps_config", $array_update);
            
        }

        $ml_expires_in = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$lands_id}' and Campo_txf='ML_EXPIRES_IN'");
        $array_update['Lands_id'] = $lands_id;
        $array_update['Campo_txf'] = 'ML_EXPIRES_IN';
        $array_update['Valor_txa'] = time() + $user['body']->expires_in;
        if ($ml_expires_in) {
            $this->ci->model_banco->updateTable("apps_config", $array_update, "Id_int", $ml_expires_in[0]->Id_int);
        } else {
            $this->ci->model_banco->db_insert("apps_config", $array_update);
        }

        $ml_refresh_token = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$lands_id}' and Campo_txf='ML_REFRESH_TOKEN'");
        $array_update['Lands_id'] = $lands_id;
        $array_update['Campo_txf'] = 'ML_REFRESH_TOKEN';
        $array_update['Valor_txa'] = $user['body']->refresh_token;
        if ($ml_refresh_token) {
            $this->ci->model_banco->updateTable("apps_config", $array_update, "Id_int", $ml_refresh_token[0]->Id_int);
        } else {
            $this->ci->model_banco->db_insert("apps_config", $array_update);
        }
    }

    function get_anuncio($id) {
        $meli = new Meli($this->id, $this->key);

        $id_anuncio = str_replace("-", "", $id);
        $params = array();
        $url = "/items/{$id_anuncio}?access_token={$this->access_token}";
        $result = $meli->get($url, $params);
        if ($result['httpCode'] == 200) {

            $url = "/items/{$id_anuncio}/description?access_token={$this->access_token}";
            $descricao = $meli->get($url, $params);

            if ($descricao['httpCode'] == 200) {
                $result['body']->descricao = $descricao['body'];
            }
            return $result['body'];
        } else {
            return false;
        }
    }

    function get_user($id = 'me') {


        $meli = new Meli($this->id, $this->key);

        $params = array();
//        $siteId = "painelml";
//                $url = '/sites/' . $siteId;
        $url = "/users/me?access_token={$this->access_token}";
        $result = $meli->get($url, $params);
        if ($result['httpCode'] == 200) {
            return $result['body'];
        } else {
            return false;
        }
    }

//     function login() {
//
//        $meli = new Meli($this->id, $this->key);
//        $siteId = 'MLB';
//
//        if (isset($_GET['code']) || isset($_SESSION['access_token'])) {
//
////            ver('ta aqui');
//            // If code exist and session is empty
//            if (isset($_GET['code']) && !isset($_SESSION['access_token'])) {
//                // //If the code was in get parameter we authorize
//                try {
//                    $user = $meli->authorize($_GET["code"], $this->redirect_uri);
//
//                    // Now we create the sessions with the authenticated user
//                    $lands_id = $_REQUEST['Lands_id'];
//
//                    $this->atualiza_chaves($lands_id, $user);
//                    $_SESSION['access_token'] = $user['body']->access_token;
//                    $_SESSION['expires_in'] = time() + $user['body']->expires_in;
//                    $_SESSION['refresh_token'] = $user['body']->refresh_token;
//                } catch (Exception $e) {
//                    echo "Exception: ", $e->getMessage(), "\n";
//                }
//            } else {
////                ver($_SESSION);
//                // We can check if the access token in invalid checking the time
//                if ($_SESSION['expires_in'] < time()) {
//                    try {
//                        // Make the refresh proccess
//                        $refresh = $meli->refreshAccessToken();
//                        // Now we create the sessions with the new parameters
//                        
//                        $this->atualiza_chaves($lands_id, $user);
//                        $_SESSION['access_token'] = $refresh['body']->access_token;
//                        $_SESSION['expires_in'] = time() + $refresh['body']->expires_in;
//                        $_SESSION['refresh_token'] = $refresh['body']->refresh_token;
//                    } catch (Exception $e) {
//                        echo "Exception: ", $e->getMessage(), "\n";
//                    }
//                }
//            }
//            echo '<pre>';
//            print_r($_SESSION);
//            echo '</pre>';
//        } else {
//            echo '<a href="' . $meli->getAuthUrl($this->redirect_uri, Meli::$AUTH_URL[$siteId]) . '">Login using MercadoLibre oAuth 2.0</a>';
//        }
//    }
}

