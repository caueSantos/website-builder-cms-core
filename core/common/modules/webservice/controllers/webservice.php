<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class webservice extends lands_core {

      public function __construct() {
            $this->load->library('session');
            parent::__construct();
                        $this->checa_login();
            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
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



            switch ($this->pagina_atual) {

              
                  

                  case 'busca':
                        $this->fazer_busca();
                        break;

              
                  
            }
      }

}

?>