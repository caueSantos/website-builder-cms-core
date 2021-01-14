<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class boleto extends lands_core {

      public function __construct() {
            parent::__construct();

            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf+1);
            $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
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
            $this->load->model('model_boleto');
            $this->model_boleto->inicializa($this->app);


            switch ($this->pagina_atual) {
                  case 'nada':
                        
                        break;
                  default:
                        $this->model_boleto->gera_boleto($this->pagina_atual);
                        break;
            }
      }

}

?>