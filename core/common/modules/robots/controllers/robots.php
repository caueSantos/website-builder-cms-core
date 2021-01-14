<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class robots extends lands_core {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        header('Content-Type: text/plain');
        
        if ($this->app->Robots_txa) {
            $content = $this->app->Robots_txa;
        } else {
            $content = "User-agent: *
Allow: /
Disallow: /post/
Disallow: /admin/
Disallow: /painel/arquivos/
Disallow: /adminer/
Disallow: /super_ajax/
Disallow: /post_ajax/
Disallow: /relatorios/
Disallow: /cron_solution/
Disallow: /ws/
Disallow: /exportar/
Disallow: /importar/
Disallow: /vivareal/
Disallow: /ingaia/
Disallow: /atualize/
Disallow: /migracao/";
        }
        
        die($content);
    }
}

?>