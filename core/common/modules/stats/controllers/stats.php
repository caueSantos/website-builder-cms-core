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
class stats extends lands_core {

      public function __construct() {
            parent::__construct();
      }

      function index() {

            $config = str_replace("www.", "", $_SERVER['HTTP_HOST']);
            redirect("http://stats.landshosting.com.br?config=$config");
            
      }

}

?>
