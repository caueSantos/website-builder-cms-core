<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class confidg extends lands_core {

      public $default_view;
      public $output;
      public $tabela;
      public $appid = 'core';
      public $conteudo2;
      public $modulo = 'config';
      public $app = array();
      public $tabelas;

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
            $this->cria_itens_obrigatorios();
            $this->checa_login();
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

      function checa_login() {

            if (!isset($this->session->userdata['usuario'])) {
                  //modules::run('login');

                  redirect('login');
            } else {
                  $this->abrir_config();
            }
      }

      function logout() {
            redirect('login/logout');
      }

      function preguica() {
            $this->tabela = 'apps';

            //   $this->grocery_crud->set_table($this->tabela);
            $dados->app = $this->app;
            $dados->appid = $this->app->Lands_id;

            $dados->lista_aplicativos = $this->lista_aplicativos;
            //  $dados->tabela = $this->tabela;
            $dados->tabelas = $this->tabelas;
            $view = $this->app->Tipo_app_sel . '/layout';
            $conteudo = $this->load->view($this->app->Tipo_app_sel . '/preguica_frame', $dados, true);

            $dados->conteudo = $conteudo;
            $this->load->view("$view", $dados);
      }

      function cria_itens_obrigatorios() {

            $lista_aplicativos = $this->model_banco->executa_sql("select a.*,a.Id_int as Id_app, c.* from apps a left outer join conexoes c on c.Id_int=a.Conexoes_for where a.Ativo_sel='SIM' order by a.Lands_id");


            $this->lista_aplicativos = $lista_aplicativos;
            $app = $this->model_banco->executa_sql("select * from apps where Lands_id='" . LANDS_ID . "' and Lands_pass='" . LANDS_PASS . "'");

            if (isset($app[0])) {
                  $this->app = $app[0];
            }
            $this->tabelas = $this->model_banco->executa_sql('show tables');




            //   ver($this->app);
      }

      function abrir_config() {
            $this->tabela = 'apps';

            //   $this->grocery_crud->set_table($this->tabela);
            $dados->app = $this->app;
            $dados->appid = $this->app->Lands_id;

            $dados->lista_aplicativos = $this->lista_aplicativos;
            //  $dados->tabela = $this->tabela;
            $dados->tabelas = $this->tabelas;
            $view = $this->app->Tipo_app_sel . '/layout';
            $conteudo = $this->load->view($this->app->Tipo_app_sel . '/lista_aplicativos', $dados, true);

            $dados->conteudo = $conteudo;
            $this->load->view("$view", $dados);
      }

      function abre($view = 'layout', $dados = null) {



            if (isset($_REQUEST['lands_id']))
                  if ($_REQUEST['lands_id'] != 'config')
                        $this->appid = $_REQUEST['lands_id'];


            //$this->grocery_crud->set_theme('twitter-bootstrap');
//            if (isset($this->appid))
//                  if ($this->appid != 'core')
//                        if($this->tabela!='clientes')
//                        $this->grocery_crud->where("$this->tabela.Lands_id", $this->appid);

            $this->output = $this->grocery_crud->render();
            $this->output->var = $this->tabela;
            if (!isset($dados)) {
                  $dados = $this->output;
            }
            if (isset($this->conteudo2)) {
                  $dados->conteudo2 = $this->conteudo2;
            }

            $dados->app = $this->app;
            $dados->appid = $this->appid;
            $dados->lista_aplicativos = $this->lista_aplicativos;
            $dados->tabela = $this->tabela;
            $dados->tabelas = $this->tabelas;
            $view = $this->app->Tipo_app_sel . '/' . $view;
            $conteudo = $this->load->view($this->app->Tipo_app_sel . '/conteudo', $dados, true);
            $dados->conteudo = $conteudo;
            $this->load->view("$view", $dados);
      }

      function abre_view($view = 'layout', $data = null) {
            $data['app'] = $this->app;
            if (isset($_REQUEST['lands_id'])) {
                  $this->appid = $_REQUEST['lands_id'];
            }

            $view = $this->app->Tipo_app_sel . '/' . $view;
            $car = $this->load->view($view, $data, true);
            return $car;
      }
 function apps_config($app = null) {
            $this->tabela = 'apps_config';
            $this->grocery_crud->set_table($this->tabela);
         
            $this->abre();
      }
       function queries_fb($app = null) {
            $this->tabela = 'queries_fb';
            $this->grocery_crud->set_table($this->tabela);
         
            $this->abre();
      }
      function conexoes($app = null) {
            $this->tabela = 'conexoes';
            $this->grocery_crud->set_table($this->tabela);
            $this->grocery_crud->set_relation('Clientes_for', 'clientes', 'Fantasia_txf');
            $this->abre();
      }

      function clientes($app = null) {
            $this->tabela = 'clientes';
            $this->grocery_crud->set_table($this->tabela);
            $this->abre();
      }

      function seleciona_app() {
            $idnovo = $_REQUEST['lands_id'];
            $resposta = $this->model_banco->executa_sql("select * from apps where Lands_id='$idnovo'");
            if (isset($resposta[0])) {
                  $destino = 'http://core.landshosting.com.br/config?&lands_id=' . $_REQUEST['lands_id'];
                  echo "<script>location.href='$destino'</script>";
            }
      }

      function retorna_appid() {
            return $this->appid;
      }

      function blocos($app = null) {
            $this->tabela = 'blocos';
            if ($this->appid !== 'core') {
                  $this->grocery_crud->where('Lands_id', $this->appid);
            }
            $this->grocery_crud->set_table($this->tabela);
            $this->abre();
      }

      function apps($app = null) {
            $this->tabela = 'apps';
            $this->grocery_crud->set_table('apps');
//            $this->grocery_crud->callback_edit_field('Template_txf', array($this, 'buscar_templates'));
//            $this->grocery_crud->callback_add_field('Template_txf', array($this, 'buscar_templates'));
//            $this->grocery_crud->callback_edit_field('Skin_txf', array($this, 'buscar_skins'));
//            $this->grocery_crud->callback_add_field('Skin_txf', array($this, 'buscar_skins'));
            $this->grocery_crud->set_relation('Conexoes_for', 'conexoes', 'Nome_conexao_txf');
            $this->grocery_crud->set_relation('Clientes_for', 'clientes', 'Fantasia_txf');

            $this->abre();
      }

      function templates($app = null) {
            $this->tabela = 'templates';
            $this->grocery_crud->set_table($this->tabela);
//            if ($this->appid !== 'core') {
//                  $this->grocery_crud->where('Lands_id', $this->appid);
//            }
            $this->abre();
      }

      function usuarios($app = null) {
            $this->tabela = 'usuarios';
            $this->grocery_crud->set_table($this->tabela);
//            if ($this->appid !== 'core') {
//                  $this->grocery_crud->where('Lands_id', $this->appid);
//            }
            $this->abre();
      }

      function queries($app = null) {
            $this->tabela = 'queries';
            $this->grocery_crud->set_table($this->tabela);
            $this->grocery_crud->set_relation('Conexoes_for', 'conexoes', 'Nome_conexao_txf'); //$related_title_field, $where_clause = null, $order_by = null)
            $this->grocery_crud->required_fields('Pagina_txf', "Tabela_txf", "Variavel_txf", "Consulta_sql_txf", "Metodo_txf", "Paginacao_sel", "Qtde_registro_pagina_txf");
            $this->grocery_crud->set_relation('Apps_for', 'apps', 'Nome_app_txf');
            $this->abre();
      }
      
}

