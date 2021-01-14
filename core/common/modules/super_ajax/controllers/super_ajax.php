<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class super_ajax extends lands_core {

    public function __construct() {
        parent::__construct();

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
    }

    function index() {

        if (!method_exists(__CLASS__, $this->pagina_atual)) {
//die($this->pagina_atual);
            $this->carrega_pagina($this->pagina_atual, 'ajax');
//            die();
        } else {
            $funcao_atual = $this->pagina_atual;
            //executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function switch_pagina() {
        
       
        switch ($this->pagina_atual) {
            case 'inicio' :
                break;
        }
    }

}

?>