<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class garagem extends lands_core {

    public function __construct() {
        parent::__construct();
//        $this->load->helper('imobiliaria');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
//        ver('chegou');
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

    function filtro() {

        $where = '';

        switch ($this->uri->segment(2)) {
            case 'bairros':
                if ($_REQUEST['Cidade_sel'] != '') {

                    $where .= " and Cidade_sel='{$_REQUEST['Cidade_sel']}' ";

                    $bairros = $this->mbc->executa_sql("select * from imoveis where Id_int is not null $where group by Bairro_sel");
                }

                $nome_pagina = $_REQUEST['nome_pagina'];
                $this->smarty->assign("nome_pagina", $nome_pagina);



                $this->smarty->assign("bairros", $bairros);
                $this->model_smarty->render_ajax('filtro_bairros', $this->app->Template_txf);


                break;

            default:
                die('filtro invalido');
                break;
        }
    }

    function switch_pagina() {

        switch ($this->pagina_atual) {
            case 'inicio':
                $veiculos=$this->mbc->buscar_completo("veiculos","where Ativo_sel='SIM' order by Ano_sel DESC");
                
                if ($this->mbc->tabelaexiste('opcionais')){
                    foreach ($veiculos as $veiculo){
                        $opcionais=$this->mbc->executa_sql("select o.Nome_txf from checkboxes c left outer join opcionais o on o.Id_int=c.Id_chb_con  where Id_objeto_con={$veiculo->Id_int} and Tabela_con='veiculos' and Tabela_chb_con='opcionais'");
                        $veiculo->opcionais= $opcionais;
                    }
                    
                    
                }
//                ver($veiculos);
                $this->smarty->assign('veiculos',$veiculos);
                break;
                   
            case 'veiculos' :

//                ver($_REQUEST);
                $where = "where Ativo_sel='SIM' ";

                if ($_REQUEST['Referencia_txf'] && $_REQUEST['Referencia_txf'] != 'COD 000') {
                    $where .= " and Referencia_txf='{$_REQUEST['Referencia_txf']}'";
                } else {

                    if ($_REQUEST['Nome_txf']) {
                        $where .= " and Nome_txf LIKE '%{$_REQUEST['Nome_txf']}%'";
                    }

                    if ($_REQUEST['Marca_sel']) {
                        $where .= " and Marca_sel='{$_REQUEST['Marca_sel']}'";
                    }

                    if ($_REQUEST['Linha_sel']) {
                        $where .= " and Linha_sel='{$_REQUEST['Linha_sel']}'";
                    }

                    if ($_REQUEST['Combustivel_sel']) {
                        $where .= " and Combustivel_sel='{$_REQUEST['Combustivel_sel']}'";
                    }

//                      ver($_REQUEST);
                    if ($_REQUEST['Cor_sel']) {
                        $where .= " and Cor_sel='{$_REQUEST['Cor_sel']}'";
                    }
//                    if ($_REQUEST['Cidade_sel']) {
//                        $where .= " and Cidade_sel='{$_REQUEST['Cidade_sel']}'";
//                        $bairros = $this->mbc->executa_sql("select * from imoveis $where group by Bairro_sel");
//                        $this->smarty->assign("bairros", $bairros);
//                    }
                    if ($_REQUEST['Ano_sel']) {
                        $where .= " and Ano_sel='{$_REQUEST['Ano_sel']}'";
                    }
                    if ($_REQUEST['Estado_sel']) {
                        $where .= " and Estado_sel='{$_REQUEST['Estado_sel']}'";
                    }


                    if ($_REQUEST['preco_min']) {
                        $preco_min = str_replace("R$", "", $_REQUEST['preco_min']);
//                    $preco_min = $preco_min . '000';
                        $where .= " and Valor_txf>={$preco_min}";
                    }
                    if ($_REQUEST['preco_max']) {
                        $preco_max = str_replace("R$", "", $_REQUEST['preco_max']);
//                    $preco_max = $preco_max . '000';
                        $where .= " and Valor_txf<={$preco_max}";
                    }
                }


                $where.=" order by Valor_txf";

//                ver($where, 1);
                $this->smarty->assign('where', $where);
                $veiculos = $this->mbc->buscar_completo("veiculos", "$where");
                
                $this->smarty->assign("veiculos", $veiculos);

                if ($this->uri->segment(2) == 'ajax') {

                    $this->model_smarty->render_ajax('veiculos', $this->app->Template_txf);
                    die();
                }
                break;

            case 'busca':
                $this->fazer_busca();
                break;
        }
    }

}

?>