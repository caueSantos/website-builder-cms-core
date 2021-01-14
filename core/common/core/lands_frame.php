<?php

class lands_frame extends MX_Controller {

    function __construct() {
        parent::__construct();

        
        
        
        if (!defined('IP_LANDS')) {
            define('IP_LANDS', '45.229.106.26'); 
        } 
        //define('IP_LANDS', '179.186.193.40');
        date_default_timezone_set('America/Sao_Paulo');

        if (!defined('IP_VEDANA')) {
//            define('IP_VEDANA', '179.178.53.22');
            define('IP_VEDANA','177.183.235.93');
//            define('IP_VEDANA','177.85.114.250');
        } 
         if (!defined('IP_ADMIN')) {
//            define('IP_VEDANA', '179.178.53.22');
            define('IP_ADMIN','177.183.239.58');
        } 
        
          
       
        
         
        
    }

    function meuip() {
        die($_SERVER['REMOTE_ADDR']);
    }

    function core_info() {
        echo "**************************************<br>";
        echo "** Development by CORE LandsHosting **<br>";
        echo "******** v0.5b rev 01.08.2015 ************<br>";
    }

}

?>