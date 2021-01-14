<?php

class Painel_model_api extends Model_banco {

    public $app;
    public $cliente;
    public $whmcsUrl = "https://www.landshosting.com.br/central/includes/api.php";
    public $admin_username = "admin";
    public $admin_password = "230551";

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function chama_api($action, $parametros = null) {
        if (!$action) {
            die('nome da funcao eh obrigatorio');
        }
        $postfields = array();
        if ($parametros) {
            $postfields = $parametros;
        }
        $postfields['username'] = $this->admin_username;
        $postfields['password'] = md5($this->admin_password);
        $postfields['responsetype'] = 'json';
        $postfields['action'] = $action;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->whmcsUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postfields));
        $response = curl_exec($ch);
        if (curl_error($ch)) {
            die('Unable to connect: ' . curl_errno($ch) . ' - ' . curl_error($ch));
        }
        curl_close($ch);
// Decode response
        $jsonData = json_decode($response, true);
// Dump array structure for inspection
        return ($jsonData);
    }

}

?>
