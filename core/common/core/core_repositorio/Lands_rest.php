<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require COMMONPATH. '/libraries/REST_Controller.php';

class lands_rest extends REST_Controller {

      public $fbuser_id = null;
      public $lista_fanpages;
      public $fanpage;
      public $detalhes_fanpage;
      public $cliente_painel;
      public $client;
      public $id_cliente_painel = 1;
      public $mbc;
      public $where_connection;
      public $stat;
      public $conexoes;
      public $_pagina;
      public $_database = "default";
      public $_template = "padrao";
      public $_skin = "modelo";
      public $_modulo = "padrao";

      function __construct() {
            parent::__construct();
            $config['appId'] = '509610239108521';
            $config['secret'] = '6d8f4135df68b31d5e98cf09532efa94';

            $this->load->library('lands_face', $config);
            $this->load->helper('url');
      }

      function cria_conexao_cliente($id = null) {


            $x = "";
            if ($id != null) {
                  $x = " and c.Id_int=$id";
            }
            //  print_r('cria_conexao_cliente ' . $fanpage_id . '<br>');

            $this->load->database('default', null, true);
            $sql1 = "select  * from clientes c where c.Id_int is not null $x";
            $cliente_painel['painel'] = $this->model_banco->executa_sql($sql1);
            $sql = "select  c.Id_int as Id_cliente_painel, m.* from clientes c left outer join modulos m on m.Id_objeto_con=c.Id_int where c.Id_int is not null $x";
            $cliente_painel['modulos'] = $this->model_banco->executa_sql($sql);
            $data['request_executed'] = ('http://ws.landshosting.com.br/servers/painel/' . $id);
            if (isset($cliente_painel['painel'][0])) {
                  //     print_r('cliente=<br>');
                  //     print_r($cliente_painel);
                  $this->cliente_painel = $cliente_painel['painel'][0];
                  $this->client = array(
                      'hostname' => $this->cliente_painel->Servidor_txf,
                      'username' => $this->cliente_painel->Usuario_bd_txf,
                      'password' => $this->cliente_painel->Senha_bd_txf,
                      'database' => $this->cliente_painel->Nome_bd_txf,
                      'dbdriver' => 'mysql',
                      'dbprefix' => '',
                      'pconnect' => TRUE,
                      'db_debug' => TRUE,
                      'cache_on' => FALSE,
                      'cachedir' => '',
                      'char_set' => 'utf8',
                      'dbcollat' => 'utf8_general_ci',
                      'swap_pre' => '',
                      'autoinit' => TRUE,
                      'stricton' => FALSE
                  );


                  $this->mbc = $this->load->model('model_banco_client', 'mbc', $this->client);
                  $this->mbc->db = $this->load->database($this->client, TRUE);
                  $data['result'] = 'true';
                  $data['mensagem'] = 'Painel conectado!';
                  $data['dados'] = $cliente_painel;
                  return $data;
            } else {
                  $data['result'] = 'false';
                  $data['mensagem'] = 'Cliente inexistente!';
                  $data['debug'][] = $sql1;
                  $data['debug'][] = $sql;
                  return $data;
            }
      }

      public function buscar_pagina() {
           
$nova_pagina=new Lands_frame();
//print_r($nova_pagina); 
return ($nova_pagina);
      }

      public function send_post() {
            var_dump($this->request->body);
      }

      public function send_put() {
            var_dump($this->put('foo'));
      }

}