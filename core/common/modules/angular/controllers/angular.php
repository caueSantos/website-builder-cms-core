<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class angular extends lands_core {

      public function __construct() {
            parent::__construct();
            $this->load->helper('tradutor'); 
            $this->smarty->troca_delimitador('[',']');
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

                  case 'lista_comparacao' :

                        $this->conecta_mbc($this->app->Conexoes_for);
                        if (isset($this->session->userdata['tabela'])) {
                              $tabela = $this->session->userdata['tabela'];
                        } else {
                              die('tabela de comparacao nao encontrada na sessao');
                        }


                        if (isset($this->session->userdata['item1'])) {
                              $id1 = $this->session->userdata['item1']->Id_int;
                              $item1 = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id1");
                              $this->smarty->assign('item1', $item1[0]);
                        }
                        if (isset($this->session->userdata['item2'])) {
                              $id2 = $this->session->userdata['item2']->Id_int;
                              $item2 = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id2");
                              $this->smarty->assign('item2', $item2[0]);
                        }
                        if (isset($this->session->userdata['item3'])) {
                              $id3 = $this->session->userdata['item3']->Id_int;
                              $item3 = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id3");
                              $this->smarty->assign('item3', $item3[0]);
                        }

                        break;

                  case 'busca':
                        $this->fazer_busca();
                        break;
                  
                   case 'boleto':
                           header('Content-type: text/html; charset=utf-8');
                        $this->load->library('lands_boleto');
                  //      $this->lands_boleto->loadBanco('104');
                     //   ver($this->lands_boleto);
                         $this->lands_boleto->cria();
                         die();
                        break;
            }
      }

}

?>