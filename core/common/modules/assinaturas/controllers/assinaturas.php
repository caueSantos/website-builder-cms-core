<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class assinaturas extends lands_core {

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
        switch ($this->pagina_atual) {
            case 'inicio' :
                $assinaturas = $this->mbc->buscar_completo("assinaturas", "where Ativo_sel='SIM' order by Nome_tit");
                foreach ($assinaturas as $assinatura) {
                    $assinatura->Layout = array();
                    $layout = $this->mbc->buscar_completo("layouts", "where Nome_txf='{$assinatura->Layout_sel}'");
                    $assinatura->Layout = $layout[0];
                    $assinatura->Empresa = array();
                    $empresa = $this->mbc->buscar_completo("empresa", "where Nome_txf='{$layout[0]->Empresa_sel}'");
                    $assinatura->Empresa = $empresa[0];
                }
                $this->smarty->assign('assinaturas', $assinaturas);
                break;
                 case 'editar' :
                     if($this->uri->segment(2)){
                         $id=$this->uri->segment(2);
                         $assinaturas = $this->mbc->buscar_completo("assinaturas", "where Id_int={$id}");
                          $this->smarty->assign('assinaturas', $assinaturas);
                          $layouts = $this->mbc->buscar_completo("layouts");
                $empresas = $this->mbc->buscar_completo("empresa");
                $this->smarty->assign('layouts', $layouts);
                $this->smarty->assign('empresas', $empresas);
                         
                     } else {
                         
                         $assinaturas = $this->mbc->buscar_completo("assinaturas","where Id_int is not null order by Nome_tit");
                foreach ($assinaturas as $assinatura) {
                    $assinatura->Layout = array();
                    $layout = $this->mbc->buscar_completo("layouts", "where Nome_txf='{$assinatura->Layout_sel}'");
                    $assinatura->Layout = $layout[0];
                    $assinatura->Empresa = array();
                    $empresa = $this->mbc->buscar_completo("empresa", "where Nome_txf='{$layout[0]->Empresa_sel}'");
                    $assinatura->Empresa = $empresa[0];
                }
                $this->smarty->assign('assinaturas', $assinaturas);
                         
                     }
                
                break;
            case 'nova' :

                $layouts = $this->mbc->buscar_completo("layouts");
                $empresas = $this->mbc->buscar_completo("empresa");
                $this->smarty->assign('layouts', $layouts);
                $this->smarty->assign('empresas', $empresas);
                break;



            case 'salvar':
//                ver('chegou');
                echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
//Show the image
                echo '<img src="' . $_POST['img_val'] . '" />';
//Get the base-64 string from data
                $filteredData = substr($_POST['img_val'], strpos($_POST['img_val'], ",") + 1);
//Decode the string
                $unencodedData = base64_decode($filteredData);
//Save the image
                $x = file_put_contents('imagem.png', $unencodedData);
                echo "<br>Imagem Gerada, clique com o botão da direita - Salvar imagem";
                die();
                break;
            default:
                $where = '';
                if ($this->uri->segment(1)) {
                    $id_assinatura = $this->uri->segment(1);
                    $where = " and Id_int='{$id_assinatura}'";
                }
                $assinaturas = $this->mbc->buscar_completo("assinaturas", "where Ativo_sel='SIM' $where");
                if ($assinaturas[0]) {
                    $layouts = $this->mbc->buscar_completo("layouts", "where Nome_txf='{$assinaturas[0]->Layout_sel}'");
                    if ($layouts[0]) {
                        foreach ($layouts[0]->Imagens as $imagem) {
                            if ($imagem->Campo_sel == 'Logo_ico') {
                                $layouts[0]->Logo = $imagem->Caminho_txf;
                            }
                            if ($imagem->Campo_sel == 'Fundo_ico') {
                                $layouts[0]->Fundo = $imagem->Caminho_txf;
                            }
                        }
                        $empresa = $this->mbc->buscar_completo("empresa", "where Nome_txf='{$layouts[0]->Empresa_sel}'");
                        if ($empresa[0]) {
                            $this->smarty->assign('empresa', $empresa[0]);
                        } else {
                            die('Empresa da assinatura nao encontrada');
                        }
                        $this->smarty->assign('layout', $layouts[0]);
                        $this->smarty->assign('assinatura', $assinaturas[0]);
                        $this->model_smarty->render_tpl('layouts/' . $layouts[0]->Arquivo_txf, $this->app->Template_txf);
                        $codigo_html = $this->model_smarty->retorna_tpl('layouts/' . $layouts[0]->Arquivo_txf, $this->app->Template_txf);
                        $this->smarty->assign('codigo_html', $codigo_html);
                        $this->model_smarty->render_tpl('blocos/codigo', $this->app->Template_txf);
                    } else {
                        die('Layout de assinatura nao encontrado');
                    }
                } else {

                    die('Assinatura de email nao encontrada');
                }
                die();

                break;
        }
    }

    function enviar() {

        $pagina = $this->uri->segment(2);
        
        switch ($pagina) {
            case 'cadastro':
                $_POST['Nome_url']=url_title($_POST['Nome_tit']);
                
                if ($this->mbc->db_insert('assinaturas', $_POST)) {
                    $this->smarty->assign('mensagem', 'cadastro_inserido');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    redireciona($this->app->Url_cliente.'inicio');
                } else {
                    $this->smarty->assign('mensagem', 'cadastro_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }
                die();



                break;
                 case 'editar':
                     
                $_POST['Nome_url']=url_title($_POST['Nome_tit']);
                
                if ($this->mbc->updateTable('assinaturas', $_POST,'Id_int',$_POST['Id_int'])) {
                    $this->smarty->assign('mensagem', 'cadastro_inserido');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                    redireciona($this->app->Url_cliente.'inicio');
                } else {
                    $this->smarty->assign('mensagem', 'cadastro_erro');
                    $this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
                }
                die();



                break;

            default: die('post invalido');
                break;
        }
    }

}

?>