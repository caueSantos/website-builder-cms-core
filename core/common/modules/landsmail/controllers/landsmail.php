<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class landsmail extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
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



        $this->carrega_mala();
//        ver($this->app);
//ver('chegou');

        switch ($this->pagina_atual) {
            case 'inicio' :

                break;
            case 'evento' :
                break;
            case 'curso' :
                break;
            case 'produtos' :

                $where = "where Mala_direta_sel='{$this->segment2}'";
                $produtos = $this->mbc->buscar_completo('produtos', $where);
                $this->smarty->assign('produtos', $produtos);
                break;
            case 'blog' :
                $where = "where Mala_direta_sel='{$this->segment2}'";
                $noticias = $this->mbc->buscar_completo('blog', $where);
                $this->smarty->assign('noticias', $noticias);

                break;
        }
    }
 
    function carrega_mala() {
        
        if ($this->uri->segment(1)) {
            
            $segment1 = $this->uri->segment(1);
            $this->segment1 = $segment1;
            $where = "where Layout_sel='{$segment1}'";
        }
        if ($this->uri->segment(2)) {
            $segment2 = $this->uri->segment(2);
            $this->segment2 = $segment2;
            $where.=" and Url_amigavel_txf='{$segment2}'";
        }
        
        $where.=" order by Id_int desc";
        
        $malas = $this->mbc->buscar_completo('mala_direta', $where);
        
        
        foreach($malas as $mala){
            $mala->Layout=$this->mbc->executa_sql("select * from layouts where Nome_txf='{$mala->Layout_sel}'");
        }
        $this->malas = $malas;
        $this->smarty->assign('malas', $malas);
    }

}

?>