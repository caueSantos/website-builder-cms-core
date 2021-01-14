<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(COMMONPATH . 'libraries/smarty/libs/Smarty.class.php');

class CI_Smarty extends Smarty {

    function __construct() {
        date_default_timezone_set('America/Sao_Paulo');
        //date_default_timezone_set('America/Phoenix');
//        if (is_lands()) {
//            @ini_set('display_errors', 'on');
//            define('_PS_DEBUG_SQL_', true);
//            ver($this);
//            $this->debugging = true;
//        }
        parent::__construct();

//        $this->autoload_filters['pre'] => array('whitespace_control');
        $this->setTemplateDir(COMMONPATH . '../templates');
        $this->setCompileDir(COMMONPATH . '../templates/compiled');
        $this->setConfigDir(COMMONPATH . 'libraries/smarty/configs');
        $this->setCacheDir(COMMONPATH . 'libraries/smarty/cache');

        $this->assign('APPPATH', APPPATH);
        $this->assign('BASEPATH', BASEPATH);
        $this->assign('COMMONPATH', COMMONPATH);
        if (is_lands()) {
//    $this->registerPlugin('pre', 'whitespace_control', 'smarty_prefilter_whitespace_control');
//            $this->loadFilter('pre','smarty_prefilter_whitespace_control');
            //   $this->autoload_filters['pre'] => array('whitespace_control');
        }

//        $this->registerPlugin('block', 'stripws' ,'smarty_block_stripws');
//         $this->caching = Smarty::CACHING_LIFETIME_CURRENT; // Does something <img src="http://searchdaily.net/wp-includes/images/smilies/icon_smile.gif" alt="icon smile CodeIgniter 2 Smarty 3 integration" class="wp-smiley" title="CodeIgniter 2 Smarty 3 integration"> 
        
        if (method_exists($this, 'assignByRef')) {
            $ci = & get_instance();
            $this->assignByRef("ci", $ci);
        }
        
        $this->force_compile = 1;
        $this->caching = false;
        $this->cache_lifetime = 120;
//        $this->compile_check = true;
//        $this->debugging = true;

        $this->loadFilter('output', 'trimwhitespace');
        
//        log_message('debug', "Smarty Class Initialized");
    }

    function assign($val1, $val2) {
//        $GLOBALS['vars'][$val1] = json_encode($val2);
        parent::assign($val1, $val2);
    }

    function view($template_name) {
        if (strpos($template_name, '.') === FALSE && strpos($template_name, ':') === FALSE) {
            $template_name .= '.tpl';
        }


        //  print_r($CI->app);
//print_r($this->getDebugTemplate());
//die();
//            if (isset($_REQUEST['is_rest'])) {
//                  if ($_REQUEST['is_rest'] == true)
//                        if (isset($GLOBALS['vars'])) {
//
//                              print_r($GLOBALS['vars']);
//                        }
//
//
//
//                  die();
//            }
        parent::display($template_name);
    }

    function troca_delimitador($esq, $dir) {
        $this->left_delimiter = "$esq";
        $this->right_delimiter = $dir;
    }

}

?>