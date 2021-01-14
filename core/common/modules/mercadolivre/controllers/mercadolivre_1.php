<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class mercadolivre extends lands_core {

    public function __construct() {
        parent::__construct();
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

            case 'notificacoes':
                ver('chegou');

                break;
            case 'login_ml':

                ver($_REQUEST);
                break;
            case 'opencart':

                if ($this->uri->segment(2)) {
                    $id_produto = $this->uri->segment(2);
                }

                if ($id_produto) {
                    $produtos = $this->mbc->executa_sql("select * from product p left outer join product_description pd on pd.product_id=p.product_id where p.product_id='{$id_produto}'");
                } else {
                    $produtos = $this->mbc->executa_sql("select * from product p left outer join product_description pd on pd.product_id=p.product_id");
                }


                $this->smarty->assign('produtos', $produtos);


                break;
            case 'produtos' :
                $where = " where Id_int is not null";
                if ($this->uri->segment(2)) {
                    $id_produto = $this->uri->segment(2);
                    $where.=" and Id_int=$id_produto";
                }


                $produtos = $this->mbc->buscar_completo('produtos', $where);
                $this->smarty->assign('produtos', $produtos);
                break;


            default:
                if ($this->app->Lands_id == 'dluca_ml') {
                    $this->carrega_anuncio();
                }
                break;
        }
    }

    function carrega_anuncio() {
        if ($this->uri->segment(1)) {
            $segment1 = $this->uri->segment(1);
            $this->segment1 = $segment1;
            $where = "where Layout_sel='{$segment1}'";

            $layouts = $this->mbc->executa_sql("select * from layouts where Nome_txf='{$segment1}'");

            $layout = $layouts[0]->Arquivo_txf . '.tpl';
            $this->smarty->assign('layout', $layout);
        } else {
            $layout = 'layout_padrao.tpl';
            $this->smarty->assign('layout', $layout);
        }



        if ($this->uri->segment(2)) {
            $segment2 = $this->uri->segment(2);
            $this->segment2 = $segment2;
            $where.=" and Url_amigavel_txf='{$segment2}'";
        }

        $anuncios = $this->mbc->buscar_completo('anuncios', $where);


        $this->anuncio = $anuncios[0];
        $this->smarty->assign('anuncios', $anuncios);
    }

}

?>