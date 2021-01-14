<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class imobiliaria extends lands_core {

    public function __construct() {
        parent::__construct();
        $this->load->helper('imobiliaria');
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

    function filtro() {

        $where = '';

        switch ($this->uri->segment(2)) {
            case 'bairros':
                
//                ver($_REQUEST);
                if ($_REQUEST['Cidade_sel'] != '') {

                    $where .= " and Cidade_sel='{$_REQUEST['Cidade_sel']}' ";

                    $bairros = $this->mbc->executa_sql("select * from imoveis where Id_int is not null $where group by Bairro_sel");
                }

                $nome_pagina = $_REQUEST['nome_pagina'];
                $this->smarty->assign("nome_pagina", $nome_pagina);



                $this->smarty->assign("requisicao", $_REQUEST);
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
            case 'imoveis' :


                $where = "where Ativo_sel='SIM' ";



                if ($_REQUEST['Referencia_txf'] && $_REQUEST['Referencia_txf'] != 'COD 000') {
                    $where .= " and Referencia_txf='{$_REQUEST['Referencia_txf']}'";
                } else {


                    if ($_REQUEST['Categoria_sel']) {
                        $where .= " and Categoria_sel='{$_REQUEST['Categoria_sel']}'";
                    }

                    if ($_REQUEST['Destaque_sel']) {
                        $where .= " and Destaque_sel='{$_REQUEST['Destaque_sel']}'";
                    }

                    if ($_REQUEST['Lancamento_sel']) {
                        $where .= " and Lancamento_sel='{$_REQUEST['Lancamento_sel']}'";
                    }

                    if ($_REQUEST['Descricao_txa']) {
//                        OR CONVERT(`Descricao_txa` USING utf8)  '%lages%'
                        $where .= " and Descricao_txa LIKE '%{$_REQUEST['Descricao_txa']}%'";
//                        $where .= " or Cidade_txf LIKE '%{$_REQUEST['Descricao_txa']}%'";
//                        $where .= " or Bairro_txf LIKE '%{$_REQUEST['Descricao_txa']}%'";
                    }

                    if ($_REQUEST['Oferta_sel']) {
                        $where .= " and Oferta_sel='{$_REQUEST['Oferta_sel']}'";
                    }

//                      ver($_REQUEST);
                    if ($_REQUEST['Operacao_sel']) {
                        $where .= " and Operacao_sel='{$_REQUEST['Operacao_sel']}'";
                    }
                    if ($_REQUEST['Cidade_sel']) {
                        $where .= " and Cidade_sel='{$_REQUEST['Cidade_sel']}'";
                        $bairros = $this->mbc->executa_sql("select * from imoveis $where group by Bairro_sel");
                        $this->smarty->assign("bairros", $bairros);
                    }
                    if ($_REQUEST['Bairro_sel']) {
                        $where .= " and Bairro_sel='{$_REQUEST['Bairro_sel']}'";
                    }
                    if ($_REQUEST['Tipo_imovel_sel']) {
                        $where .= " and Tipo_imovel_sel='{$_REQUEST['Tipo_imovel_sel']}'";
                    }
                    if ($_REQUEST['Quartos_sel']) {
                        $where .= " and Quartos_sel>='{$_REQUEST['Quartos_sel']}'";
                    }
                    
                     if ($_REQUEST['Garagem_sel']) {
                        $where .= " and Garagem_sel>='{$_REQUEST['Garagem_sel']}'";
                    }
                    if ($_REQUEST['Suites_sel']) {
                        $where .= " and Suites_sel>='{$_REQUEST['Suites_sel']}'";
                    }

                    if ($_REQUEST['Banheiros_sel']) {
                        $where .= " and Banheiros_sel>='{$_REQUEST['Banheiros_sel']}'";
                    }
                    if ($_REQUEST['preco_min']) {
                        $preco_min = str_replace("R$", "", $_REQUEST['preco_min']);
                        $preco_min = str_replace(".", "", $preco_min);
//                    $preco_min = $preco_min . '000';
                        $where .= " and Valor_txf>={$preco_min}";
                    }
                    if ($_REQUEST['preco_max']) {
                        $preco_max = str_replace("R$", "", $_REQUEST['preco_max']);
                        $preco_max = str_replace(".", "", $preco_max);
//                    $preco_max = $preco_max . '000';
                        $where .= " and Valor_txf<={$preco_max}";
                    }

                    if ($_REQUEST['suites_min']) {
                        $where .= " and Suites_sel>={$_REQUEST['suites_min']}";
                    }

                    if ($_REQUEST['quartos_min']) {
                        $where .= " and Quartos_sel>={$_REQUEST['quartos_min']}";
                    }

                    if ($_REQUEST['banheiros_min']) {
                        $where .= " and Banheiros_sel>={$_REQUEST['banheiros_min']}";
                    }
                    if ($_REQUEST['garagem_min']) {
                        $where .= " and Garagem_sel>={$_REQUEST['garagem_min']}";
                    }


                    if ($_REQUEST['area_min']) {
                        $_REQUEST['area_min'] = str_replace(".", "", $_REQUEST['area_min']);
                        $where .= " and Metragem_total_txf>={$_REQUEST['area_min']}";
                         
                    }
                    if ($_REQUEST['area_max']) {
                        $_REQUEST['area_max'] = str_replace(".", "", $_REQUEST['area_max']);
                        $where .= " and Metragem_total_txf<={$_REQUEST['area_max']}";
                    }


//                    if ($_REQUEST['suites_max']) {
//                        $where .= " and Suites_sel<={$_REQUEST['suites_max']}";
//                    }

                    if ($_REQUEST['Endereco_txf']) {
                        $where .= " and Endereco_txf  LIKE '%{$_REQUEST['Endereco_txf']}%'";
                    }
                }


                $where.=" order by Valor_txf";

//                ver($_REQUEST, 1);
//                ver($where, 1);
//                $this->smarty->assign('requisicao', $_REQUEST);
//                ver($where);
                $this->smarty->assign('where', $where);
                $imoveis = $this->mbc->buscar_completo("imoveis", "$where");


                if ($_REQUEST['busca']) {
                    $imoveis = $this->mbc->get_busca("imoveis", $_REQUEST['busca'], null, null, null);
//                     ver(count($imoveis));
                }

                $this->smarty->assign("imoveis", $imoveis);

                if ($this->uri->segment(2) == 'ajax') {

                    $this->model_smarty->render_ajax('imoveis', $this->app->Template_txf);
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