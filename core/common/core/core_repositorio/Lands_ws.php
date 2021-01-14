<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');

class Lands_ws extends CI_Controller {

      public $configs;
      public $requisicao;
      public $resultado;

      function __construct() {
            parent::__construct();

            $this->recebe_request();

            $this->aplica_configs();

            $this->executa();

            $this->sai_resultado();


//$this->output->enable_profiler(TRUE);
      }

      public function recebe_request() {
            $this->requisicao = $_REQUEST;
      }

      public function aplica_configs() {


            if (isset($this->requisicao['retorno'])) {
                  $this->configs['tipo_saida'] = 'json';
                  $this->configs['caminho_saida'] = $this->requisicao['retorno'];
            } else {
                  $this->configs['tipo_saida'] = 'view';
            }
      }

      function checa_parametros_e_chama() {
            if (!isset($this->requisicao['metodo'])) {

                  die('Falta parametro metodo');
            }
            $this->load->library('lands_face');
            $this->resultado = $this->call_object_method_array($this->requisicao['metodo'], $this->lands_face);
            return $this->resultado;
      }

      public function executa() {
            print_r('metodo executa');
            print_r($this->configs);

            if ($this->configs['tipo_saida'] == 'json') {
                  $this->resultado = $this->checa_parametros_e_chama();
                  $this->sai_resultado();
            } else {
                  die('Unable to execute');
            }
      }

      public function sai_resultado() {
            $this->restulado = $this->trata_resultado();
            if ($this->request['tipo_saida'] == 'json') {
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $this->requisicao['caminho_saida']);
                  curl_setopt($ch, CURLOPT_POST, true);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $this->restulado);
                  curl_exec($ch);
            } else {
                  die('Saida deve ser json, sem opcao de criar view');
            }
      }

      public function trata_resultado() {
            if (isset($this->configs['tipo_saida'])) {
                  if ($this->configs['tipo_saida'] == 'json')
                        return json_encode(($this->resultado));
            }
            else {
                  return ($this->restulado);
            }
      }

      function trata_request() {
            
      }

      public function busca_posts($fanpage_id) {
// $user_id = $facebook->getUser();$this->fanpage_id=$fanpage_id;
            $posts = $this->facebook->api('/' . $fanpage_id . '/posts', 'GET');
            $fanpage_completa = $this->facebook->api('/' . $fanpage_id, 'GET');

            $result = $this->facebook->api(array(
                'method' => 'fql.query',
                'query' => 'select name from page where page_id = ' . $fanpage_id . ';'
                    ));
            $retorno = $_REQUEST['retorno'];
            $dados['fanpage_completa'] = $fanpage_completa;
            $dados['dados'] = $posts['data'];
            $dados['paginacao'] = $posts['paging'];
            $resposta['dados'] = json_encode($dados);
            $this->retornar($resposta, $retorno);
      }

      function retornar($resposta, $retorno) {
            
      }

      /**
       * @param string $func - method name
       * @param object $obj - object to call method on
       * @param boolean|array $params - array of parameters
       */
      function call_object_method_array($func, $obj, $params = false) {
            if (!method_exists($obj, $func)) {
                  die('metodo nao encontrado ' . $func); // object doesn't have function, return null
                  return (null);
            }
// no params so just return function
            if (!$params) {
                  return ($obj->$func());
            }
// build eval string to execute function with parameters
            $pstr = '';
            $p = 0;

            foreach ($params as $param) {
                  $pstr.=$p > 0 ? ', ' : '';
                  $pstr.='$params[' . $p . ']';
                  $p++;
            }
            $evalstr = '$retval=$obj->' . $func . '(' . $pstr . ');';
            $evalok = eval($evalstr);
// if eval worked ok, return value returned by function
            if ($evalok) {
                  return ($retval);
            } else {
                  return (null);
            }
            return (null);
      }

}