<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');
require_once (COMMONPATH . 'third_party/hubspot/class.leads.php');
require_once (COMMONPATH . 'third_party/hubspot/class.settings.php');
//                require_once (COMMONPATH . 'third_party/hubspot/class.events.php');
require_once (COMMONPATH . 'third_party/hubspot/class.leadnurturing.php');
require_once (COMMONPATH . 'third_party/hubspot/class.prospects.php');
require_once (COMMONPATH . 'third_party/hubspot/class.keywords.php');
require_once (COMMONPATH . 'third_party/hubspot/class.blog.php');
require_once (COMMONPATH . 'third_party/hubspot/class.contacts.php');
require_once (COMMONPATH . 'third_party/hubspot/class.workflows.php');
require_once (COMMONPATH . 'third_party/hubspot/class.forms.php');
require_once (COMMONPATH . 'third_party/hubspot/class.lists.php');
require_once (COMMONPATH . 'third_party/hubspot/class.properties.php');
require_once (COMMONPATH . 'third_party/hubspot/class.socialmedia.php');

class hubspot extends lands_core {

    public $apikey = '0e70f3ba-10f3-440a-b828-250d29142dd7';

    public function __construct() {
        $this->load->library('session');
        parent::__construct();

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'hubspot');
        if ($this->pagina_atual != 'cron') {
            $this->checa_login($this->pagina_atual);
        }
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

    function switch_pagina() {

        $this->conecta_mbc($this->app->Conexoes_for);
        $this->carrega_defaults();

        switch ($this->pagina_atual) {
            case 'hubspot':
                $contatos = $this->mbc->executa_sql("select * from hubspot_contatos order by Data_modificacao_dat limit 30");
                $this->smarty->assign('contatos', $contatos);

                break;
            case 'orcamentos':
                $id_contato = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                $contatos = $this->mbc->executa_sql("select * from hubspot_contatos where Id_hubspot=$id_contato");
                $this->smarty->assign('contatos', $contatos);

                $orcamentos = $this->mbc->executa_sql("select * from hubspot_orcamentos where Id_hubspot=$id_contato");
                $this->smarty->assign('orcamentos', $orcamentos);

                break;
            case 'orcamento':
                $id_contato = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                $contatos = $this->mbc->executa_sql("select * from hubspot_contatos where Id_hubspot=$id_contato");
                $this->smarty->assign('contatos', $contatos);

                $id_orcamento = $this->uri->segment($this->app->Segmento_padrao_txf + 3);
                if ($id_orcamento) {
                    $orcamento = $this->busca_orcamento($id_orcamento);
                    $orcamento->Itens=array();
                    $itens=$this->mbc->executa_sql("select * from hubspot_orcamentos_itens where Id_orcamento=$id_orcamento order by Ordenacao_txf");
                    $orcamento->Itens=$itens;
                    $this->smarty->assign('orcamento', $orcamento);
                }



                break;
            case 'cron':

                $this->sincroniza();
                break;
        }
    }

    function busca_orcamento($id_orcamento) {
        $orcamento = $this->mbc->executa_sql("select * from hubspot_orcamentos where Id_int=$id_orcamento");
        return $orcamento[0];
    }

    function sincroniza() {

        ini_set('max_execution_time', 0);
        $this->sincroniza_contatos();
    }

    function enviar() {
        $segmento = (int) $this->app->Segmento_padrao_txf + 1;
        $segmento = $segmento + 1;
        if ($this->uri->segment($segmento)) {
            $segmento_post = $this->uri->segment($segmento);
        } else {
            $segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
        }


        switch ($segmento_post) {
            case 'filtro' :
                $valor = $_POST['Valor_txf'];
                $contatos = $this->mbc->get_busca_obj('hubspot_contatos', $valor, '30');
                $this->smarty->assign("contatos", $contatos);
                $this->model_smarty->render_bloco('contatos', $this->app->Template_txf);
                die();
                break;
        }

        die();
    }

    function sincroniza_contatos() {

        $contacts = new HubSpot_Contacts($this->apikey);
        // $param = "&property=firstname&property=lastname&property=email&property=phone&property=mobilephone&property=jobtitle&property=company";


        $allContactsArray = array();
        $cont = 0;

        $params['property'][] = 'firstname';
        $params['property'][] = 'lastname';
        $params['property'][] = 'email';
        $params['property'][] = 'phone';
        $params['property'][] = 'mobilephone';
        $params['property'][] = 'jobtitle';
        $params['property'][] = 'company';


        do {
            /* 'vidOffset' sets start for next page of contacts. Set the variable $vidOffset at the end of this loop, which means that this block will not execute for the first 'count' contacts, but will execute every time after that. */
            if (isset($vidOffset)) {
                $params['vidOffset'] = $vidOffset;
//                $contatos = $contacts->get_all_contacts(array('vidOffset' => $vidOffset));
                $contatos = $contacts->get_all_contacts($params);
            } else {
                $contatos = $contacts->get_all_contacts($params);
            }



            /* Loop over a page of contacts and get desired properties to modify */

            foreach ($contatos->contacts as $contact) {


                /* Catching undefined index error. If the property is not in the array, set equal to "" */
                $vid = $contact->vid;
                $firstName = (isset($contact->properties->firstname->value)) ? $contact->properties->firstname->value : "";
                $lastName = (isset($contact->properties->lastname->value)) ? $contact->properties->lastname->value : "";
                $email = (isset($contact->properties->email->value)) ? $contact->properties->email->value : "";
                $jobtitle = (isset($contact->properties->jobtitle->value)) ? $contact->properties->jobtitle->value : "";
                $company = (isset($contact->properties->company->value)) ? $contact->properties->company->value : "";
                $phone = (isset($contact->properties->phone->value)) ? $contact->properties->phone->value : "";
                $mobilePhone = (isset($contact->properties->mobilephone->value)) ? $contact->properties->mobilephone->value : "";

                $singleContactArray = array(
                    'Id_hubspot' => $vid,
                    'Nome_txf' => $firstName,
                    'Sobrenome_txf' => $lastName,
                    'Email_txf' => $email,
                    'Funcao_txf' => $jobtitle,
                    'Empresa_txf' => $company,
                    'Telefone_txf' => $phone,
                    'Celular_txf' => $mobilePhone,
                    'Ativo_sel' => 'SIM'
                );


                /* Add the single contact array to $allContactsArray */
                $allContactsArray[] = $singleContactArray;
                $cont++; // Increment contact counter.
            }

            $vidOffset = $contatos->{'vid-offset'}; // Marks where the contact list left off in progress.
        } while ($contatos->{'has-more'} == true);

        $this->atualiza_insere_contatos($allContactsArray);
    }

    function atualiza_insere_contatos($lista_contatos = null) {
//        ver('chegou na funcao', 1);
        $this->conecta_mbc($this->app->Conexoes_for);

//        $array['Ativo_sel'] = 'NAO';
//        $this->updateTable("hubspot_contatos", $array, 'Id_int', 'is not null');
        $cont_atualiza = 0;
        $cont_insere = 0;
        $cont_ignora = 0;
        if ($lista_contatos) {


            foreach ($lista_contatos as $contato) {
//                ver($contato, 1);
                $id_hubspot = $contato['Id_hubspot'];
                $contato_bd = $this->mbc->executa_sql("select * from hubspot_contatos where Id_hubspot={$id_hubspot}");
//                ver($contato_bd,1);
                if ($contato_bd[0]) {
                    $atualiza = FALSE;
                    foreach ($contato_bd[0] as $key => $value) {
                        if ($key != 'Id_int') {
                            if ($contato_bd[0]->$key != $contato[$key]) {
                                $atualiza = TRUE;
                            }
                        }
                    }

                    if ($atualiza) {


                        $contato['Data_modificacao_dat'] = date('Y-m-d H:i:s');

                        $this->mbc->updateTable("hubspot_contatos", $contato, 'Id_hubspot', $id_hubspot);
                        echo "{$contato['Nome_txf']} {$contato['Sobrenome_txf']} atualizou <br>";
                        $cont_atualiza++;
                    } else {

                        $cont_ignora++;
                        //     echo "{$contato['Nome_txf']} {$contato['Sobrenome_txf']} não precisou ser atualizado<br>";
                    }
                } else {
                    $contato['Data_criacao_dat'] = date('Y-m-d H:i:s');
                    $contato['Data_modificacao_dat'] = date('Y-m-d H:i:s');
                    $this->mbc->db_insert("hubspot_contatos", $contato);
                    echo "{$contato['Nome_txf']} {$contato['Sobrenome_txf']} foi inserido <br>";
                    $cont_insere++;
                }
            }
        }
        echo "<br>***********************<br>";
        echo "$cont_insere contatos inseridos<br>";
        echo "$cont_atualiza contatos atualizados<br>";
        echo "$cont_ignora nao precisaram ser atualizados<br>";
        echo "***********************";
        die();
    }

    function carrega_defaults() {
        $whmcs_url = "https://www.landshosting.com.br/central/admin/";
        $this->smarty->assign('whmcs_url', $whmcs_url);
    }

}

?>