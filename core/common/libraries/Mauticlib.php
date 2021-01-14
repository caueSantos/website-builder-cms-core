<?php
ini_set('max_execution_time', 3);
set_time_limit(3);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require (COMMONPATH . 'third_party/mautic-api/vendor/autoload.php');

use Mautic\Auth\ApiAuth;
use Mautic\MauticApi;

/**
 * Mensagem class
 * Classe de envio de mensagens ao usuário
 *
 * @author    Gustavo Vedana Erckmann
 * 
 */
class Mauticlib {

    private $ci;
    public $app;
    public $usuario;
    public $cliente;

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
    }

    function autoriza() {

        $token = null;
        $token_expires = null;
        $state = "";
        $code = "";

        $acc = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='MAUTIC_ACCESS_TOKEN'");

        if ($acc[0]) {
            $token = $acc[0]->Valor_txa;
        }

        $acc = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='MAUTIC_EXPIRES_TOKEN'");
        if ($acc[0]) {
            $token_expires = $acc[0]->Valor_txa;
        }

        if (isset($_GET["state"])) {
            $state = $_GET["state"];
            $_SESSION['oauth']['state'] = $state;
        }

        if (isset($_GET["code"])) {
            $code = $_GET["code"];
            $_SESSION['oauth']['code'] = $code;
        }

        $settings = array(
            'baseUrl' => $this->app->MAUTIC_URL,
            'version' => 'OAuth2',
            'clientKey' => $this->app->MAUTIC_ID,
            'clientSecret' => $this->app->MAUTIC_PASS,
            'callback' => $this->app->MAUTIC_CALLBACK,
            'code' => $code,
            'state' => $state
        );

        if ($token && $token_expires) {
            $settings['accessToken'] = $token;
            $settings['accessTokenExpires'] = $token_expires;
        }

        $initAuth = new ApiAuth();
        $auth = $initAuth->newAuth($settings);

        if ($auth->validateAccessToken()) {


            $this->auth = $auth;
            $this->apiUrl = "{$this->app->MAUTIC_URL}/api";
            $this->api = new MauticApi();
            if (isset($_POST["POST"])) {                
                $this->form_id = json_decode($_POST["POST"])->Form_id;                
            }


            if ($auth->accessTokenUpdated()) {

                $accessTokenData = $auth->getAccessTokenData();
                $_SESSION["oauth"]["state"] = $_GET["state"];
                $_SESSION["oauth"]["token"] = $accessTokenData;

                $token_bd = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='MAUTIC_ACCESS_TOKEN'");
                $array['Campo_txf'] = 'MAUTIC_ACCESS_TOKEN';
                $array['Valor_txa'] = $accessTokenData['access_token'];
                $array['Lands_id'] = $this->app->Lands_id;

                if ($token_bd[0]) {
                    $this->ci->model_banco->updateTable('apps_config', $array, 'Id_int', $token_bd[0]->Id_int);
                } else {
                    $this->ci->model_banco->db_insert('apps_config', $array);
                }

                $token_refresh_bd = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='MAUTIC_REFRESH_TOKEN'");
                $array['Campo_txf'] = 'MAUTIC_REFRESH_TOKEN';
                $array['Valor_txa'] = $accessTokenData['refresh_token'];
                $array['Lands_id'] = $this->app->Lands_id;

                if ($token_refresh_bd[0]) {
                    $this->ci->model_banco->updateTable('apps_config', $array, 'Id_int', $token_refresh_bd[0]->Id_int);
                } else {
                    $this->ci->model_banco->db_insert('apps_config', $array);
                }

                $token_expires_bd = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='MAUTIC_EXPIRES_TOKEN'");
                $array['Campo_txf'] = 'MAUTIC_EXPIRES_TOKEN';
                $array['Valor_txa'] = $accessTokenData['expires'];
                $array['Lands_id'] = $this->app->Lands_id;


                if ($token_expires_bd[0]) {
                    $this->ci->model_banco->updateTable('apps_config', $array, 'Id_int', $token_expires_bd[0]->Id_int);
                } else {
                    $this->ci->model_banco->db_insert('apps_config', $array);
                }
            } else {
                echo "AUTORIZADO!";
                return true;
            }
        } else {
            return false;
            print_r("token inválido");
        }
    }

    function integra_form() {

        $procura_form = $this->searchForm();

        if (!isset($procura_form["id"])) {
            $procura_form = $this->createForm();
            if (!isset($procura_form["id"])) {
                while (true) {
                    $procura_form = $this->searchForm();
                    if (isset($procura_form["id"])) {
                        break;
                    }
                }
            }
        }

        //CONTATO
        $contato = $this->mapearEnvio(json_decode($_POST["POST"], 1));
        $contato['ipAddress'] = json_decode($_POST["SERVER"])->REMOTE_ADDR;
        $contato['api_flag'] = "SIM";
        $contato["lastActive"] = date("Y-m-d H:m:i");

        $this->create("contacts", $contato);

        //CRIA O LEAD
        $this->createLead($contato, $procura_form["id"], $contato['ipAddress']);
    }

    function integra_mautic_job($dados) {        
        $url = "https://lands.net.br/subdominios/mautic/action";
        $data['POST'] = json_encode($dados->POST);
        $data['APP'] = json_encode($dados->APP);
        $data['SERVER'] = json_encode($dados->SERVER);        
        $output = curlContents($url, 'POST', $data, false, true);
        $out = $output['contents'];
        return $out;
    }

    function integra_mautic() {
        $url = "https://lands.net.br/subdominios/mautic/action";
        $data['POST'] = json_encode($_POST);
        $data['APP'] = json_encode($this->app);
        $data['SERVER'] = json_encode($_SERVER);
        $output = curlContents($url, 'POST', $data, false, true);
        $out = $output['contents'];
        echo $out;
        die();
    }

    public function useApi($tipo) {
        return $this->api->newApi($tipo, $this->auth, $this->apiUrl);
    }

    public function create($tipo, $dados = []) {
        $api = $this->api->newApi($tipo, $this->auth, $this->apiUrl);
        $cria = $api->create($dados);
        if (!isset($cria["errors"])) {
            return $cria;
        }
        return false;
    }

    public function get($tipo, $id) {
        $api = $this->api->newApi($tipo, $this->auth, $this->apiUrl);
        $pega = $api->get($id);
        return $pega;
    }

    public function getAll($tipo, $options = []) {

        $opt = "";
        foreach ($options as $value) {
            $opt .= "'{$value}'" . ",";
        }
        $opt = substr($opt, 0, -1);

        $api = $this->api->newApi($tipo, $this->auth, $this->apiUrl);
        $pega = $api->getList();
        return $pega;
    }

    public function checarCampo($field_name) {
        $field_name = strtolower($field_name);
        $campos = $this->getAll("contactFields");
        foreach ($campos["fields"] as $campo) {
            if ($campo["alias"] == $field_name) {
                return $campo;
            }
        }
        return false;
    }

    public function mapearCampos($campos) {

        $mapa = $this->mapaLands();
        $excluir = $this->mapaExclusao();
        $data = [];

        foreach ($campos as $chave => $campo) {
            if (array_search($chave, $excluir) === false) {
                if (!isset($mapa[$chave])) {

                    $c = [
                        "alias" => strtolower($chave),
                        "label" => $chave,
                        "type" => "text"
                    ];
                    $x = $this->checarCampo($chave);
                    if ($x == false) {
                        $cc = $this->create("contactFields", $c);
                        $c["leadField"] = $cc["field"]["alias"];
                        $data[] = $c;
                    } else {
                        $c["leadField"] = $x["alias"];
                        $data[] = $c;
                    }
                } else {
                    $data[] = $mapa[$chave];
                }
            }
        }

        return $data;
    }

    public function mapearEnvio($campos) {

        $mapa = $this->mapaLands();
        $data = [];
        foreach ($campos as $chave => $campo) {
            if (array_search($chave, $this->mapaExclusao()) === false) {
                if (isset($mapa[$chave])) {
                    $data[$mapa[$chave]["alias"]] = $campo;
                } else {
                    $data[strtolower($chave)] = $campo;
                }
            }
        }
        return $data;
    }

    public function createForm() {

        $actions = [];
        $poste = json_decode($_POST["POST"], 1);
        if (isset($poste["Mautic_pontos"])) {
            $actions = array(
                array(
                    'name' => 'pontos no form',
                    'description' => 'pontuação ao usar esse form',
                    'type' => 'lead.pointschange',
                    'properties' => array(
                        'operator' => 'plus',
                        'points' => $poste["Mautic_pontos"]
                    )
                )
            );
            unset($poste["Mautic_pontos"]);
        }

        $campos_create = $this->mapearCampos($poste);

        if ($this->searchForm() == false) {

            $data = array(
                'name' => $this->app->Nome_app_txf . " - " . $this->form_id,
                'description' => $this->form_id,
                'formType' => 'campaign',
                'fields' => $campos_create,
                "actions" => $actions
            );

            $form = $this->create("forms", $data);

            return $form;
        }
        return false;
    }

    public function searchForm() {

        $forms = $this->getAll("forms");

        foreach ($forms["forms"] as $valor) {
            if ($valor["description"] == $this->form_id) {                
                return $valor;
            }
        }
        return false;
    }

    /**
     * Push data to a Mautic form
     *
     * @param  array   $data   The data submitted by your form
     * @param  integer $formId Mautic Form ID
     * @param  string  $ip     IP address of the lead
     * @return boolean
     */
    function createLead($data, $formId, $ip = null) {
        // Get IP from $_SERVER
        if (!$ip) {
            $ipHolders = array(
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_X_CLUSTER_CLIENT_IP',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR'
            );
            foreach ($ipHolders as $key) {
                if (!empty($_SERVER[$key])) {
                    $ip = $_SERVER[$key];
                    if (strpos($ip, ',') !== false) {
                        // Multiple IPs are present so use the last IP which should be the most reliable IP that last connected to the proxy
                        $ips = explode(',', $ip);
                        array_walk($ips, create_function('&$val', '$val = trim($val);'));
                        $ip = end($ips);
                    }
                    $ip = trim($ip);
                    break;
                }
            }
        }

        $data['formId'] = $formId;
        // return has to be part of the form data array
        if (!isset($data['return'])) {
            $data['return'] = $this->app->MAUTIC_CALLBACK;
        }

        $data = array('mauticform' => $data);

        // Change [path-to-mautic] to URL where your Mautic is
        $formUrl = $this->app->MAUTIC_URL . '/form/submit?formId=' . $formId;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $formUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Forwarded-For: $ip"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return true;
    }

    private function mapaExclusao() {
        return ["Lands_id", "Destinatario_txf", "Form_id", "Tabela_txf",
            "Captcha_key", "Destinatario_sel", "g-recaptcha-response", "enviar",
            "Formulario_sel", "Assunto_txf", "Sql_id_txf"];
    }

    private function mapaLands() {
        return [
            "Nome_txf" => [
                "alias" => "firstname",
                "label" => "Nome",
                "type" => "text",
                "leadField" => "firstname"
            ],
            "Sobrenome_txf" => [
                "alias" => "lastname",
                "label" => "Sobrenome",
                "type" => "text",
                "leadField" => "lastname"
            ],
            "Email_txf" => [
                "alias" => "email",
                "label" => "Email",
                "type" => "text",
                "leadField" => "email"
            ],
            "Telefone_txf" => [
                "alias" => "phone",
                "label" => "Telefone",
                "type" => "text",
                "leadField" => "phone"
            ],
            "Cidade_txf" => [
                "alias" => "city",
                "label" => "Cidade",
                "type" => "text",
                "leadField" => "city"
            ],
            "Celular_txf" => [
                "alias" => "mobile",
                "label" => "Celular",
                "type" => "text",
                "leadField" => "mobile"
            ],
            "Produto_txf" => [
                "alias" => "product",
                "label" => "Produto",
                "type" => "text",
                "leadField" => "product"
            ],
            "Cep_txf" => [
                "alias" => "zipcode",
                "label" => "Cep",
                "type" => "text",
                "leadField" => "zipcode"
            ],
            "Pais_txf" => [
                "alias" => "country",
                "label" => "País",
                "type" => "text",
                "leadField" => "country"
            ],
            "Empresa_txf" => [
                "alias" => "companyname",
                "label" => "Empresa",
                "type" => "text",
                "leadField" => "companyname"
            ],
            "Estado_txf" => [
                "alias" => "state",
                "label" => "Estado",
                "type" => "text",
                "leadField" => "state"
            ],
            "Estado_sel" => [
                "alias" => "state",
                "label" => "Estado",
                "type" => "text",
                "leadField" => "state"
            ],
            "Mensagem_txa" => [
                "alias" => "description",
                "label" => "Descrição",
                "type" => "textarea",
                "leadField" => "description"
            ],
            "Endereco_txa" => [
                "alias" => "address1",
                "label" => "Endereço",
                "type" => "text",
                "leadField" => "address1"
            ],
        ];
    }

    public function create_segment($segmento) {

        return $this->create('segments', $segmento);
    }

    public function multiple_segment_contacts($segmentId, $contactIds) {
        $segmentApi = $this->api->newApi("segments", $this->auth, $this->apiUrl);                
        
        foreach($contactIds as $id){
            $response = $segmentApi->addContact($segmentId, $id);   
        }        
                
    }

}
