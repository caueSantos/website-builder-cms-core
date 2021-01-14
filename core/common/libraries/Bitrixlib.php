<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require COMMONPATH . 'third_party/bitrix24-php-sdk/vendor/autoload.php';


        const APPLICATION_ID = 'local.5b62174fc9fdd8.06154315';
        const APPLICATION_SECRET = '7w5EuTJhiE4cRan4G7BHAkHvX0GlHCFT63AderVFrW8k5RNiHG';

        const PROTOCOL = 'https';
        const DOMAIN = 'landsagenciaweb.bitrix24.com.br';
        const REDIRECT_URL = 'https://mautic.landshosting.com.br/autoriza_bitrix/';
        const PATH = 'https';

/**
 * Mensagem class
 * Classe de envio de mensagens ao usuário
 *
 * @author    Gustavo Vedana Erckmann
 * 
 */
class Bitrixlib {

    private $ci;
    public $app;
    public $token;
    public $refresh;
    public $member_id;
    public $obB24App;

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

    function get_lead($id = null) {
        $filter = array();
        if ($id) {
            $filter['ID'] = $id;
        }
        $bitrix = new \Bitrix24\CRM\Lead($this->obB24App);
        $leads = $bitrix->getList(array(), $filter);
        return $leads;
    }

    function get_companies($id = null, $has_email = null, $selected = []) {

        $filter = array();

        if ($id) {
            $filter['ID'] = $id;
        }

        if ($has_email) {
            $filter['HAS_EMAIL'] = 'Y';
        }

        $bitrix = new \Bitrix24\CRM\Company($this->obB24App);

        if ($id) {
            $leads = $bitrix->get($id);
        } else {
            $leads = $bitrix->getList(array(), $filter);
        }
        return $leads;
    }

    function get_status() {
        $filter = array();

        $bitrix = new \Bitrix24\CRM\Status($this->obB24App);
        $status = $bitrix->getList([], ['ENTITY_ID' => 'STATUS'], []);
        return $status;
    }

    function get_detailed_leads($email = null, $status_id = null, $select = [], $start = 0) {
        $filter = [];
        
        if ($email) {
            $filter['EMAIL'] = $email;
        }

        if ($status_id) {
            $filter['STATUS_ID'] = $status_id;
        }

//        $filter['HAS_EMAIL'] = "Y";

        $bitrix = new \Bitrix24\CRM\Lead($this->obB24App);
        $leads = $bitrix->getList(array(), $filter, $select, $start);
        return $leads;
    }

    function get_leads($email = null, $status_id = null) {
        $filter = array();
        if ($email) {
            $filter['EMAIL'] = $email;
        }

        if ($status_id) {
            $filter['STATUS_ID'] = $status_id;
        }

        $bitrix = new \Bitrix24\CRM\Lead($this->obB24App);
        $leads = $bitrix->getList(array(), $filter, array('HAS_EMAIL', 'EMAIL', 'PHONE', 'WEB', 'STATUS_ID'));
        return $leads;
    }

    function send_lead($lead) {
        $this->create_or_update_lead($lead);
    }

    function create_or_update_lead($data) {
        $bitrix = new \Bitrix24\CRM\Lead($this->obB24App);

        $array = array();

        $dataAux = (array) $data;
        if (empty($dataAux)) {
            return false;
        }

        if (!empty($data->firstname) || !empty($data->lastname)) {
            $array["TITLE"] = $data->firstname . " " . $data->lastname;
        }

        if (!empty($data->firstname)) {
            $array['NAME'] = $data->firstname;
        }

        if (!empty($data->lastname)) {
            $array['LAST_NAME'] = $data->lastname;
//            $array['SECOND_NAME'] = $data->lastname;
        }

        if (!empty($data->address1)) {
            $array['ADDRESS'] = $data->address1;
        }

        if (!empty($data->address2)) {
            $array['ADDRESS_2'] = $data->address2;
        }

        if (!empty($data->city)) {
            $array['ADDRESS_CITY'] = $data->city;
        }

        if (!empty($data->country)) {
            $array['ADDRESS_COUNTRY'] = $data->country;
        }

        if (!empty($data->zipcode)) {
            $array['ADDRESS_POSTAL_CODE'] = $data->zipcode;
        }

        if (!empty($data->state)) {
            $array['ADDRESS_PROVINCE'] = $data->state;
        }

        if (!empty($data->description)) {
            $array["COMMENTS"] = $data->description;
        }

        if (!empty($data->company)) {
            $array["COMPANY_TITLE"] = $data->company;
        }

        $leads = $this->get_leads($data->email);
        $leads = $leads['result'];

        // Verificar se o e-mail já está preenchido
        $have_email = false;
        if (!empty($leads)) {
            foreach ($leads as $lead) {
                if (isset($lead['EMAIL'])) {
                    foreach ($lead['EMAIL'] as $email) {
                        if ($email['VALUE'] == $data->email) {
                            $have_email = true;
                            break;
                        }
                    }
                } else {
                    $have_email = false;
                    break;
                }
            }
        }

        // Preencher e-mail
        if (empty($leads) || !$have_email) {
            $array['EMAIL'][0]['TYPE_ID'] = 'EMAIL';
            $array['EMAIL'][0]['VALUE_TYPE'] = 'WORK';
            $array['EMAIL'][0]['VALUE'] = $data->email;
        }

        $tels = [];
        if (!empty($data->mobile)) {
            array_push($tels, $data->mobile);
        }

        if (!empty($data->phone)) {
            array_push($tels, $data->phone);
        }

        if (!empty($data->fax)) {
            array_push($tels, $data->fax);
        }

        foreach ($tels as $tel) {
            // Verificar se o telefone já está preenchido
            $have_phone = false;
            if (!empty($leads)) {
                foreach ($leads as $lead) {
                    if (isset($lead['PHONE'])) {
                        foreach ($lead['PHONE'] as $phone) {
                            if ($phone['VALUE'] == $tel) {
                                $have_phone = true;
                            }
                        }
                    }
                }
            }

            // Preencher telefone
            if (empty($leads) || !$have_phone) {
                $phone = [];
                $phone['TYPE_ID'] = 'PHONE';
                $phone['VALUE_TYPE'] = 'WORK';
                $phone['VALUE'] = $tel;
                $array['PHONE'][] = $phone;
            }
        }

        // Verificar se o site já está preenchido
        $have_site = false;
        if (!empty($leads)) {
            foreach ($leads as $lead) {
                if (isset($lead['WEB'])) {
                    foreach ($lead['WEB'] as $site) {
                        if ($site['VALUE'] == $data->website) {
                            $have_site = true;
                            break;
                        }
                    }
                } else {
                    $have_site = false;
                    break;
                }
            }
        }

        // Preencher site
        if (empty($leads) || !$have_site) {
            $array['WEB'][0]['TYPE_ID'] = 'WEB';
            $array['WEB'][0]['VALUE_TYPE'] = 'WORK';
            $array['WEB'][0]['VALUE'] = $data->website;
        }

        if (empty($leads)) {
            $array['STATUS_ID'] = 7;
        } elseif ($leads[0]['STATUS_ID'] == 'NEW') {
            $array['STATUS_ID'] = 7;
        }
        if (empty($leads)) {
            return $bitrix->add($array);
        } else {
            $id = $leads[0]['ID'];
            return $bitrix->update($id, $array);
        }
    }

    function autoriza() {
        // get code and member_id if there is no
        if (empty($_GET['code']) || empty($_GET['member_id'])) {
            $params = array(
                "response_type" => "code",
                "client_id" => APPLICATION_ID,
                "redirect_uri" => REDIRECT_URL,
            );
            $path = "/oauth/authorize/";

            header("Location: " . PATH . '://' . DOMAIN . $path . "?" . http_build_query($params));
            die();
        }
        return $this->set_authorization();
    }

    function set_authorization() {
        $obB24App = new \Bitrix24\Bitrix24(false);
        //$obB24App = new \Bitrix24\Bitrix24(false, $log);
        $obB24App->setApplicationScope(['crm', 'entity']);
        $obB24App->setApplicationId(APPLICATION_ID);
        $obB24App->setApplicationSecret(APPLICATION_SECRET);

        // set user-specific settings
        $obB24App->setDomain(DOMAIN);
        $obB24App->setRedirectUri(REDIRECT_URL);

        if (isset($_GET['code']) && isset($_GET['member_id'])) {
            $obB24App->setMemberId($_GET['member_id']);
            $this->member_id = $_GET['member_id'];

            $code = $obB24App->getFirstAccessToken($_GET['code']);

            $this->token = $code['access_token'];
            $this->refresh = $code['refresh_token'];

            $this->atualiza_app($this->token, $this->refresh, $this->member_id);
        } else {
            $acc = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='BITRIX_ACCESS_TOKEN'");

            if ($acc[0]) {
                $this->token = $acc[0]->Valor_txa;
            }

            $acc = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='BITRIX_REFRESH_TOKEN'");
            if ($acc[0]) {
                $this->refresh = $acc[0]->Valor_txa;
            }

            $acc = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='BITRIX_MEMBER_ID'");
            if ($acc[0]) {
                $this->member_id = $acc[0]->Valor_txa;
            }

            $obB24App->setMemberId($this->member_id);
        }

        $obB24App->setRefreshToken($this->refresh);
        $obB24App->setAccessToken($this->token);


        $obB24App->setOnExpiredToken(function (\Bitrix24\Bitrix24 $obB24App) {
                    $token = $obB24App->getNewAccessToken();
                    $this->atualiza_app($token['access_token'], $token['refresh_token'], null);
                    $obB24App->setAccessToken($token['access_token']);
                    $obB24App->setRefreshToken($token['refresh_token']);
                    return true;
                });

        $this->obB24App = $obB24App;

        // get information about current user from bitrix24
        $obB24User = new \Bitrix24\User\User($obB24App);
        $arCurrentB24User = $obB24User->current();

        if ($arCurrentB24User) {
            return $arCurrentB24User;
        } else {
            return FALSE;
        }
    }

    function atualiza_app($token, $refresh, $member_id = null) {


        $token_bd = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='BITRIX_ACCESS_TOKEN'");
        $array['Campo_txf'] = 'BITRIX_ACCESS_TOKEN';
        $array['Valor_txa'] = $token;
        $array['Lands_id'] = $this->app->Lands_id;

        if ($token_bd[0]) {
            $this->ci->model_banco->updateTable('apps_config', $array, 'Id_int', $token_bd[0]->Id_int);
        } else {
            $this->ci->model_banco->db_insert('apps_config', $array);
        }

        $refresh_bd = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='BITRIX_REFRESH_TOKEN'");
        $array['Campo_txf'] = 'BITRIX_REFRESH_TOKEN';
        $array['Valor_txa'] = $refresh;
        $array['Lands_id'] = $this->app->Lands_id;

        if ($refresh_bd[0]) {
            $this->ci->model_banco->updateTable('apps_config', $array, 'Id_int', $refresh_bd[0]->Id_int);
        } else {
            $this->ci->model_banco->db_insert('apps_config', $array);
        }
        if ($member_id) {
            $member_id_bd = $this->ci->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}' and Campo_txf='BITRIX_MEMBER_ID'");
            $array['Campo_txf'] = 'BITRIX_MEMBER_ID';
            $array['Valor_txa'] = $member_id;
            $array['Lands_id'] = $this->app->Lands_id;

            if ($member_id_bd[0]) {
                $this->ci->model_banco->updateTable('apps_config', $array, 'Id_int', $member_id_bd[0]->Id_int);
            } else {
                $this->ci->model_banco->db_insert('apps_config', $array);
            }
        }
    }

}

