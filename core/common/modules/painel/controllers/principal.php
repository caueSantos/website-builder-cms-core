<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_painel.php');

class principal extends lands_painel {

    public $modulo = "principal";

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

        $CI = & get_instance();
        $CI->pagina_atual = $this->pagina_atual;
        
        switch ($this->pagina_atual) {

            case 'avisos' :
                $tipo = null;
                if ($this->uri->segment(2)) {


                    $tipo = $this->uri->segment(2);
                }
                $this->carrega_avisos($tipo);
//                $avisos=$this->mbc->buscar_completo();

                break;
            case 'aviso' :
                $id = null;
                if ($this->uri->segment(2)) {
                    $id = $this->uri->segment(2);
                } else {
                    redireciona($this->app->Url_cliente . 'avisos');
                }

                $where = " where Id_int=$id";
                $aviso = $this->mbc->buscar_completo("avisos", $where);
                if ($aviso[0]->Tipo_sel == 'GERAL' || $aviso[0]->Usuarios_for == "{$this->usuario->Id_int}") {
                    $atualizacao=array();
                    $atualizacao['Avisos_for'] = $aviso[0]->Id_int;
                    $atualizacao['Usuarios_for']=$this->usuario->Id_int;
                    $atualizacao['Data_dat'] = date('Y-m-d H:i:s');
                    $this->mbc->db_insert('avisos_visualizacao', $atualizacao);
                    $this->smarty->assign('meu_aviso', $aviso[0]);
                } else {
                    die('acesso invalido');
                }
                break;
            default:
                break;
        }
    }

}

?>