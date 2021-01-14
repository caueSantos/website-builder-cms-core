<?php

ini_set('max_execution_time', 3);
set_time_limit(3);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

//require (COMMONPATH . 'third_party/mautic-api/vendor/autoload.php');
//
//use Mautic\Auth\ApiAuth;
//use Mautic\MauticApi;

class mautic extends lands_core {

    public function __construct() {
        parent::__construct();

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        $this->app->Template_txf = 'producao/mautic/site/';
    }

    function index() {

        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            try {
                $this->carrega_pagina($this->pagina_atual);
            } catch (Exception $exc) {
                ver($exc->getTraceAsString());
            }
        } else {
            $funcao_atual = $this->pagina_atual;
            //executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function primeira_chave($arr) {
        $keys = array_keys($arr);
        return $keys[0];
    }

    function monta_objeto_mautic($dados = null) {
        $lead = new stdClass();

        foreach ($dados['lead']['fields']['core'] as $key => $value) {
            $lead->{$value['alias']} = $value['value'];
        }

        foreach ($dados['lead']['fields']['social'] as $key => $value) {
            $lead->{$value['alias']} = $value['value'];
        }

        if (is_array($dados['points'])) {
            $lead->points = $dados['points']['new_points'];
        }

        return $lead;
    }

    function switch_pagina() {

        switch ($this->pagina_atual) {

            case 'inicio':
                $this->load->library('mauticlib');
                if (!isset($_REQUEST['Lands_id']) && !isset($_REQUEST['Lands_pass'])) {
                    die('acesso inválido');
                }

                $this->app_cliente = $this->model_seguranca->verifica_ativacao($_REQUEST['Lands_id'], $_REQUEST['Lands_pass']);
                $this->mauticlib->inicializa($this->app_cliente);
                $this->mauticlib->autoriza();
//               if($autorizou){
//                   
//                   $this->smarty->assign('autoriza_mautic','tdasdas');
//               }

                break;

            case 'cron_exec':
                
                $jobs_mautic = $this->model_banco->executa_sql("select * from mautic_job where Processado_sel!='SIM'");

                if ($jobs_mautic[0]) {
                    $this->load->library('mauticlib');
                    foreach ($jobs_mautic as $job) {
                        
                        $dados = json_decode($job->Dados_jso);

                        $this->mauticlib->inicializa($dados->APP);
                        $out = $this->mauticlib->integra_mautic_job($dados);

                        $array['Processado_sel'] = 'SIM';
                        $array['Data_processamento_dat'] = date('Y-m-d H:i:s');
                        $atualizou = $this->model_banco->updateTable("mautic_job", $array, 'Id_int', $job->Id_int, TRUE);

                        echo "Job {$dados->APP->Nome_app_txf} - {$dados->POST->Form_id} executado <br>";
                    }
                } else {                                        
                    echo "Todos os jobs executados<br>";                    
                }
                die();
                break;
            case 'autoriza_mautic':

                $this->load->library('mauticlib');
                $this->mauticlib->inicializa($this->app);
                $this->mauticlib->autoriza();

                break;

            case 'autoriza_bitrix':

                $this->load->library("bitrixlib");
                $this->bitrixlib->inicializa($this->app);
                if ($this->bitrixlib->autoriza()) {
                    die('autorizou');
                } else {
                    die('nao autorizou');
                }

                break;

            case 'atualiza_bitrix':
                $input = file_get_contents("php://input");
                $inputJson = json_decode($input, true);

                if ($array = array_get($inputJson, 'mautic.lead_post_save_new;0', null, ';')) {
                    $data = $array;
                } elseif ($array = array_get($inputJson, 'mautic.lead_post_save_update;0', null, ';')) {
                    $data = $array;
                } elseif ($array = array_get($inputJson, 'mautic.lead_points_change;0', null, ';')) {
                    $data = $array;
                }

                $dados_tratados = json_encode($this->monta_objeto_mautic($data));

                $array['Dados_txa'] = $dados_tratados;
                $array['Data_dat'] = date('Y-m-d H:i:s');
                $atualizou = $this->model_banco->db_insert("mautic_bitrix", $array, TRUE);

                die();
                break;

            case 'processa_segmentos_bitrix':
                ini_set('max_execution_time', 0);
                set_time_limit(0);

                $this->load->library('bitrixlib');
                $this->bitrixlib->inicializa($this->app);
                $this->bitrixlib->set_authorization();

                $this->load->library('mauticlib');
                $this->app_cliente = $this->model_seguranca->verifica_ativacao('lands_site_novo', 'lands_site_novo');
                $this->mauticlib->inicializa($this->app_cliente);
                $this->mauticlib->autoriza();

                //LISTAS DO BITRIX
                $listas_bitrix = $this->bitrixlib->get_status();

                $compara_mautic = [];
                $compara_bitrix = [];

                $listas_no_mautic = [];

                $lista_completa_contatos_mautic = [];
                $lista_completa_contatos_bitrix = [];

                $contatos_bitrix = [];
                $contatos_mautic = [];

                $this->conecta_mbc(282);

                $listas_mautic = $this->mbc->executa_sql("SELECT * FROM lead_lists");

                foreach ($listas_bitrix['result'] as $item_lista) {
                    $alias_no_mautic = url_title(strtolower($item_lista['NAME'])) . "----" . url_title(strtolower($item_lista['STATUS_ID']));

                    $aliases = array_map(function($e) {
                                return is_object($e) ? $e->alias : $e['alias'];
                            }, $listas_mautic);

                    $key = array_search($alias_no_mautic, $aliases);

                    if ($key === false) {
                        $this->mbc->executa_sql("INSERT INTO `lead_lists` (`is_published`, `date_added`, `created_by`, 
                            `created_by_user`, `name`, `alias`) VALUES (1, NOW(), 1, 'Lands Agência Web', 
                            'BITRIX - {$item_lista['NAME']}', '{$alias_no_mautic}')");
                    }
                }

                $listas_mautic = $this->mbc->executa_sql("SELECT * FROM lead_lists");

                foreach ($listas_mautic as $item_lista) {
                    $pode_processar = strstr($item_lista->alias, '----');

                    if ($pode_processar) {
                        $ja_foi = [];

                        $this->mbc->executa_sql("DELETE FROM `lead_lists_leads` 
                            WHERE `leadlist_id` = '{$item_lista->id}'");

                        $alias = strstr($item_lista->alias, '---');
                        $status_id = strtoupper(str_replace('----', '', $alias));

                        $selected = ['NAME', 'LAST_NAME', 'COMPANY_TITLE', 'BIRTHDATE', 'EMAIL', 'STATUS_ID', 'COMPANY_ID'];

                        $response = $this->bitrixlib->get_detailed_leads(null, $status_id, $selected);
                        $users = $response["result"];


                        while (isset($response["next"])) {
                            try {
                                $response = $this->bitrixlib->get_detailed_leads(null, $status_id, $selected, $response["next"]);
                                $users = array_merge($users, $response["result"]);
                            } catch (Exception $e) {
                                
                            }
                        }

                        foreach ($users as $user) {
                            if (isset($user["EMAIL"]) && isset($user["EMAIL"][0])) {
                                $get_user = $this->mbc->executa_sql("SELECT id FROM leads 
                                    WHERE email = '{$user["EMAIL"][0]["VALUE"]}'");

                                if ($get_user === false) {
                                    $get_user = $this->mbc->executa_sql("INSERT INTO `leads` (`is_published`, `date_added`, `created_by`, 
                                        `created_by_user`, `points`, `internal`, 
                                        `social_cache`, `date_identified`, `firstname`,
                                        `lastname`, `email`, `leadstatus`) VALUES
                                        (1, NOW(), 1, 'Lands Agência Web', 0, 'a:0:{}', 'a:0:{}', NOW(), 
                                        '{$user['NAME']}', '{$user['LAST_NAME']}', 
                                        '{$user["EMAIL"][0]["VALUE"]}', 'aberto')");

                                    echo "<br>CRIOU O USUÁRIO {$user["EMAIL"][0]["VALUE"]}<br>";

                                    $last_id = json_decode(json_encode($this->mbc->executa_sql("SELECT LAST_INSERT_ID()")), 1);
                                    $get_user = $last_id[0]["LAST_INSERT_ID()"];
                                } else {
                                    $get_user = $get_user[0]->id;
                                }


                                if (!in_array($get_user, $ja_foi)) {
                                    $this->mbc->executa_sql("INSERT INTO `lead_lists_leads` 
                                        (`leadlist_id`, `lead_id`, `date_added`) VALUES
                                        ({$item_lista->id}, {$get_user}, NOW())");
                                    echo "<br>INSERIU O USUÁRIO {$user["EMAIL"][0]["VALUE"]} NA LISTA {$item_lista->id}<br>";
                                    $ja_foi[] = $get_user;
                                }
                            }
                        }

//                        $contatos_lista_mautic = json_decode(json_encode($this->mbc->executa_sql("SELECT leads.* FROM lead_lists_leads AS lll
//                            INNER JOIN lead_lists AS list ON list.id = lll.leadlist_id
//                            INNER JOIN leads ON leads.id = lll.lead_id
//                            WHERE lll.leadlist_id = {$item_lista->id}")), 1);
//
//                        if (!is_array($contatos_lista_mautic)) {
//                            $contatos_lista_mautic = [];
//                        }
//
//                        $alias = strstr($item_lista->alias, '---');
//                        $status_id = strtoupper(str_replace('----', '', $alias));
//
//                        $selected = ['NAME', 'LAST_NAME', 'COMPANY_TITLE', 'BIRTHDATE', 'EMAIL', 'STATUS_ID', 'COMPANY_ID'];
//                        $contatos_lista_bitrix = $this->bitrixlib->get_detailed_leads(null, $status_id, $selected);
//                        
//                        foreach ($contatos_lista_bitrix["result"] as $user) {
//                            if (isset($user["EMAIL"]) && isset($user["EMAIL"][0])) {
//                                $emails = array_column($contatos_lista_mautic, "email");
//                                $key = array_search($user["EMAIL"][0]["VALUE"], $emails);
//
//                                echo var_dump($key);
//                                echo '<br>';
//                                
//                                if ($key === false) {
//                                    $get_user = $this->mbc->executa_sql("SELECT id FROM leads WHERE email = '{$user["EMAIL"][0]["VALUE"]}'");
//
//                                    if ($get_user === false) {
//                                        $get_user = $this->mbc->executa_sql("INSERT INTO `leads` (`is_published`, `date_added`, `created_by`, 
//                                            `created_by_user`, `points`, `internal`, 
//                                            `social_cache`, `date_identified`, `firstname`,
//                                            `lastname`, `email`, `leadstatus`) VALUES
//                                            (1, NOW(), 1, 'Lands Agência Web', 0, 'a:0:{}', 'a:0:{}', NOW(), 
//                                            '{$user['NAME']}', '{$user['LAST_NAME']}', 
//                                            '{$user["EMAIL"][0]["VALUE"]}', 'aberto')");
//                                        echo "<br>CRIOU O USUÁRIO {$user["EMAIL"][0]["VALUE"]}<br>";
//
//                                        $last_id = json_decode(json_encode($this->mbc->executa_sql("SELECT LAST_INSERT_ID()")), 1);
//                                        $get_user = $last_id[0]["LAST_INSERT_ID()"];
//                                    } else {
//                                        $get_user = $get_user[0]->id;
//                                    }
//
//                                    if ($get_user) {
//                                        try {
//                                            @$this->mbc->executa_sql("INSERT INTO `lead_lists_leads` 
//                                                (`leadlist_id`, `lead_id`, `date_added`) VALUES
//                                                ({$item_lista->id}, {$get_user}, NOW())");
//                                            echo "<br>INSERIU O USUÁRIO {$user["EMAIL"][0]["VALUE"]} NA LISTA {$item_lista->id}<br>";
//                                        } catch (Exception $e) {}
//                                    }
//                                }
//                            }
//                        }
                    }
                }


                $this->conecta_mbc($this->app->Conexoes_for);
                die("<br>----------------------------------- TERMINOU O PROCESSO -----------------------------------<br>");
                break;

            case 'processa_bitrix':
                $this->load->library('bitrixlib');
                $this->bitrixlib->inicializa($this->app);
                $this->bitrixlib->set_authorization();

//                $leads = $this->bitrixlib->get_leads();

                $atualizacoes = $this->model_banco->executa_sql("select * from mautic_bitrix  where Processado_sel='NAO' order by Id_int");

                if (!$atualizacoes) {
                    $atualizacoes = [];
                }

//                $this->mauticlib->inicializa($dados->APP);
                foreach ($atualizacoes as $atualizacao) {
                    $lead = json_decode($atualizacao->Dados_txa);

                    // Mover para Lead Qualificado pelo MKT (MQL) se a pontuação chegar a 50
                    if ($lead->points >= 50) {
                        $this->bitrixlib->send_lead($lead);
                    }

                    $array['Processado_sel'] = 'SIM';
                    $array['Data_processamento_dat'] = date('Y-m-d H:i:s');
                    $this->model_banco->updateTable("mautic_bitrix", $array, 'Id_int', $atualizacao->Id_int, TRUE);
                }

                die('finalizou ');
                break;

            case 'atualizacoes_bitrix':
                $atualizacoes = $this->model_banco->executa_sql("select * from mautic_bitrix order by Id_int ");
                foreach ($atualizacoes as $atualizacao) {
                    $lead = $this->monta_objeto_mautic($atualizacao->Dados_txa);
                    $lista[] = $lead;
                }
                $this->smarty->assign('atualizacoes', $lista);
                break;


            case 'action':
                
                $post_app = json_decode($_POST['APP']);
                $post_server = json_decode($_POST['SERVER']);
                $post_data = json_decode($_POST['POST']);                                
                
                $this->load->library('mauticlib');
                $this->app_cliente = $this->model_seguranca->verifica_ativacao($post_app->Lands_id, $post_app->Lands_pass);
                $this->mauticlib->inicializa($this->app_cliente);
                $this->mauticlib->autoriza();
                $this->mauticlib->integra_form();

                break;
        }
    }

}

?>