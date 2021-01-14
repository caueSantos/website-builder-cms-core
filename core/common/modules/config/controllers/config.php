<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_config.php');

class config extends lands_config {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('lands');
        //$this->load->helper('url');
        $this->load->model('model_banco_basico');
        $this->load->model('model_banco');
        $this->load->library('grocery_crud');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
//            $this->cria_itens_obrigatorios();
//            $this->checa_login();
    }

//      function index() {
//            $this->abrir_config();
//      }



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
//        if (is_lands()) {
            $this->smarty->assign('senha_mor', 'X=myc9hg]EoB    &nbsp;&nbsp;&nbsp;&nbsp; pass123root!@#');
//        }


//        if(is_lands()){
//            $this->smarty->assign('senha_mor', 'Rgnhjyotm%$ngQW@Lf$!hfgt    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    5JX8pdEv!uhN0V74123');
//        }

        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));
        switch ($this->pagina_atual) {
            case 'inicio':
//                        $atualizacoes = $this->model_banco->executa_sql("select * from _atualizacoes order by Id_int desc LIMIT 3");
//                        $this->smarty->assign('atualizacoes', $atualizacoes);
//                if ($this->usuario_logado->Nivel_sel <= 3) {
//                    redirect($this->app->Url_cliente . 'marketing');
//                }
                break;
            case 'tabela':
                $this->switch_tabela();
                break;
            case 'preguica':
                $this->conecta_mbc(44);
                $paineis=$this->mbc->executa_sql("select * from clientes where Painel_status_sel='ATIVO' order by Fantasia_txf");
                $this->smarty->assign('paineis',$paineis);
//                ver('chegou');
                break;
            case 'teste':

//                   //$email="joao@gmail.com.br";
//                   $email="joao@yahoo.com.br";
//                   
//                   $emailsplit=  explode("@yahoo.com.br", $email);
//                   if(isset($emailsplit[1])){
//                       $yahoo=TRUE;
//                   } else {
//                       $yahoo=FALSE;
//                   }
//                   ver($yahoo);
//                   ver($emailsplit);
                break;
            case 'lista_backups':
                $apps = $this->model_banco->executa_sql("select * from apps order by Nome_app_txf"); // order by Nome_app_txf");

                foreach ($apps as $app) {
                    $app->Backups = $this->model_banco->executa_sql("select * from backups where Lands_id='{$app->Lands_id}'");
                    $app->Total = count($app->Backups);
                    if (!$app->Backups[0]->Id_int) {
                        $app->Total = 0;
                    }
                }

                $this->smarty->assign('apps', $apps);
//                        $lista_backups = $this->model_banco->executa_sql("select a.*, b.* from apps a left outer join backups b on b.Lands_id=a.Lands_id order by a.Lands_id");
//                        $this->smarty->assign('lista_backups', $lista_backups);

                break;
        }
    }

    function buscar() {
        $busca = $_POST['busca'];
        if (($busca == ' ' ) || ( $busca == '  ') || ( $busca == '   '))
            $busca = '';
        $sql = "select a.*,a.Id_int as Id_app, c.*, a.Lands_id from apps a left outer join conexoes c on c.Id_int=a.Conexoes_for where a.Ativo_sel='SIM' and ( a.Lands_id like '%{$busca}%' or a.Nome_app_txf like '%{$busca}%') order by a.Lands_id ";
        $lista_aplicativos = $this->model_banco->executa_sql($sql);
        $this->lista_aplicativos = $lista_aplicativos;
        $this->smarty->assign('lista_aplicativos', $lista_aplicativos);
        $this->conecta_mbc(44);
        $clientes_painel = $this->mbc->buscar_tudo('clientes');
        $this->smarty->assign('clientes_painel', $clientes_painel);
//            $this->load->library('asana', $this->asana_key);
//            $this->projetos_asana = json_decode($this->asana->getProjects());
//            $this->smarty->assign('projetos_asana', $this->projetos_asana->data);
        // ver($this->lista_aplicativos);

        $this->model_smarty->render_ajax('busca', $this->app->Template_txf);
    }

}