<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_smarty extends CI_Model {

    public $app;
    public $cliente;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function render_ajax_modular($view, $layout = 'padrao', $modulo = null) {
        $caminho = COMMONPATH . "../templates/{$layout}/{$modulo}/ajax/{$view}.tpl";
        try {
            echo $this->smarty->fetch($caminho);
        } catch (Exception $e) {
            echo $this->smarty->fetch(COMMONPATH . "../templates/padrao/ajax/{$view}.tpl");
        }
    }
    
   
    

    function render_modular($layout_app = 'app', $layout, $modulo, $view) {

        $content = COMMONPATH . "../templates/{$layout_app}/{$modulo}/{$view}.tpl";
        $view_final = "{$layout_app}/{$modulo}/{$layout}";

//        ver($content,1);
//        ver($view_final,1);
        try {
//atribui ao content a view a ser aberta..
            $this->smarty->assign('content', $this->smarty->fetch($content));

//exibe o layout.tpl  
            $this->smarty->view($view_final);
        } catch (Exception $e) {
//            ver('chegou no excetpion',1);

            try {
                $tela_notfound = COMMONPATH . "../templates/{$layout_app}/{$modulo}/page_not_found.tpl";
                $this->smarty->assign('content', $this->smarty->fetch($tela_notfound));
                $this->smarty->view($view_final);
            } catch (Exception $e) {
//                 ver('chegou no excetpion 2',1);
                $tela_notfound = COMMONPATH . "../templates/padrao/page_not_found.tpl";
                $this->smarty->assign('content', $this->smarty->fetch($tela_notfound));
                $this->smarty->view($view_final);
            }
        }
    }

//faz o fetch na pagina a ser aberta;
//layout= pasta na qual está o .tpl..
//view= arquivo tpl a ser renderizado.
    function render($view, $layout = 'padrao') {

        
        try {
//atribui ao content a view a ser aberta..

            $this->smarty->assign('content', $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/{$view}.tpl"));


//exibe o layout.tpl  
            $this->smarty->view("{$layout}/layout");
        } catch (Exception $e) {

            try {


                $tela_notfound = COMMONPATH . "../templates/{$layout}/page_not_found.tpl";



                $this->smarty->assign('content', $this->smarty->fetch($tela_notfound));
                $this->smarty->view($layout . '/layout');
            } catch (Exception $e) {


                $tela_notfound = COMMONPATH . "../templates/padrao/page_not_found.tpl";

                $this->smarty->assign('content', $this->smarty->fetch($tela_notfound));
                $this->smarty->view($layout . '/layout');
            }
        }
        switch ($this->app->Tipo_app_sel) {
            case 'mailing':

                break;
            default:
                $this->render_bloco('sweetalert', 'padrao');


//                     $this->render_bloco('alerta_problema', 'padrao');

                break;
        }
    }

    function render_padrao($view, $layout = 'padrao') {

        try {
//atribui ao content a view a ser aberta..
            $this->smarty->assign('content', $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/{$view}.tpl"));

//exibe o layout.tpl  
            $this->smarty->view("{$layout}/layout");
        } catch (Exception $e) {
            //atribui ao content a view a ser aberta..
            $this->smarty->assign('content', $this->smarty->fetch(COMMONPATH . "../templates/padrao/{$view}.tpl"));

//exibe o layout.tpl  
            $this->smarty->view("{$layout}/layout");
        }
    }

    function render_modulo_padrao($layout, $modulo, $view) {

        try {
//atribui ao content a view a ser aberta..
            $this->smarty->assign('content', $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/{$modulo}/{$view}.tpl"));

//exibe o do modulo desejado layout.tpl  
            $this->smarty->view("{$layout}/{$modulo}/layout");
        } catch (Exception $e) {


            //atribui ao content a view a ser aberta..
            $this->smarty->assign('content', $this->smarty->fetch(COMMONPATH . "../templates/padrao/{$modulo}/{$view}.tpl"));

//exibe o layout.tpl  da pasta padrao do modulo desejado
            $this->smarty->view("padrao/{$modulo}/layout");
        }
    }

    function render_avancado($view, $pasta_template = 'padrao', $arquivo_layout = 'layout') {
        $content = COMMONPATH . "../templates/{$pasta_template}/{$view}.tpl";
        $view_final = "{$pasta_template}/{$arquivo_layout}";

        try {
//atribui ao content a view a ser aberta..
            $this->smarty->assign('content', $this->smarty->fetch($content));

//exibe o layout.tpl  
            $this->smarty->view($view_final);
        } catch (Exception $e) {

            try {


                $tela_notfound = COMMONPATH . "../templates/{$pasta_template}/page_not_found.tpl";

                $this->smarty->assign('content', $this->smarty->fetch($tela_notfound));
                $this->smarty->view($view_final);
            } catch (Exception $e) {



                $tela_notfound = COMMONPATH . "../templates/padrao/page_not_found.tpl";

                $this->smarty->assign('content', $this->smarty->fetch($tela_notfound));
                $this->smarty->view($view_final);
            }
        }
    }

    function render_ajax($view, $layout = 'padrao') {
        $caminho = COMMONPATH . "../templates/{$layout}/ajax/{$view}.tpl";

//        ver($caminho);

        try {
            echo $this->smarty->fetch($caminho);
        } catch (Exception $e) {
            echo $this->smarty->fetch(COMMONPATH . "../templates/padrao/ajax/{$view}.tpl");
        }
    }

    function render_bloco($view, $layout = 'padrao') {
        try {
            echo $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/blocos/{$view}.tpl");
        } catch (Exception $e) {
            echo $this->smarty->fetch(COMMONPATH . "../templates/padrao/blocos/{$view}.tpl");
        }
    }

    function retrurn_ajax($view, $layout = 'padrao') {
        try {
            return $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/ajax/{$view}.tpl");
        } catch (Exception $e) {
            return $this->smarty->fetch(COMMONPATH . "../templates/padrao/ajax/{$view}.tpl");
        }
    }

    function return_ajax($view, $layout = 'padrao') {
        try {
            return $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/ajax/{$view}.tpl");
        } catch (Exception $e) {
            return $this->smarty->fetch(COMMONPATH . "../templates/padrao/ajax/{$view}.tpl");
        }
    }

    function retrurn_email($view, $layout = 'padrao') {
        $x = $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/email/{$view}.tpl");
        return $x;
    }

    function carrega_bloco($variavel, $view, $layout = 'padrao') {
        try {
            $this->smarty->assign('bloco_' . $variavel, $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/blocos/{$view}.tpl"));
        } catch (Exception $e) {
            ver($e);
        }
    }

    function render_tpl($view, $layout = 'padrao') {
        $arquivo = COMMONPATH . "../templates/{$layout}/{$view}.tpl";


        echo $this->smarty->fetch($arquivo);
    }

    function retorna_tpl($view, $layout = 'padrao') {
        try {
            return $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/{$view}.tpl");
        } catch (Exception $e) {
            return $this->smarty->fetch(COMMONPATH . "../templates/padrao/{$view}.tpl");
        }
    }
 
    function retorna_tpl_modulo($layout, $modulo, $view) {
        try {
            return $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/{$modulo}/{$view}.tpl");
        } catch (Exception $e) {
            return $this->smarty->fetch(COMMONPATH . "../templates/padrao/{$modulo}/{$view}.tpl");
        }
    }

    function carrega_tpl_modulo($layout, $modulo, $view, $variavel) {

        try {
            $this->smarty->assign('bloco_' . $variavel, $this->smarty->fetch(COMMONPATH . "../templates/{$layout}/{$modulo}/{$view}.tpl"));
        } catch (Exception $e) {
            ver($e);
        }
    }

}

