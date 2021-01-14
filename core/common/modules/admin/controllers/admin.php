<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Description of adminer
 *
 * @author guvedana
 */
class admin extends lands_core {

      public function __construct() {
            parent::__construct();
      }

      function index() {
            $redirect_link = 'http://painel.landsdigital.com.br';
           
                  $this->abre_painel($redirect_link);
        
      }

      function abre_painel($redirect_link) {
            redireciona($redirect_link);
      }

}

?>
 