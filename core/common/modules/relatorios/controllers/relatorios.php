<?php

if (!defined('BASEPATH'))
      exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class relatorios extends lands_core {

      public $relatorios_disponiveis;

      public function __construct() {
            parent::__construct();
            $this->load->helper('tradutor');

            $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
            $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);

            $this->checa_login();
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
            $pagina = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
            $this->relatorios_disponiveis = $this->busca_relatorios();
            $this->smarty->assign('relatorios_disponiveis', $this->relatorios_disponiveis);
            switch ($pagina) {

                  case 'contatos' :
                        if (isset($this->relatorios_disponiveis->contatos)) {
                              $tabela = $this->app->Tabela_contato_txf;
                              $contatos = $this->mbc->buscar_tudo($tabela, ' order by Data_dat desc');
                              $this->smarty->assign('contatos', $contatos);

                              $this->model_smarty->render_modulo_padrao($this->app->Template_txf, 'relatorios', 'contatos');
                              //   $pagina_relatorio = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'relatorios', 'contatos');
                              // echo ($pagina_relatorio);
                              die();
                        } else {
                              die('relatorio nao disponivel');
                        }
//                        ver($pagina_relatorio);

                        break;
                  case 'informativos' :
                        if (isset($this->relatorios_disponiveis->informativos)) {
                              $tabela = $this->app->Tabela_info_txf;
                              $informativos = $this->mbc->buscar_tudo($tabela, ' order by Data_dat desc');
                              $this->smarty->assign('informativos', $informativos);

                              $this->model_smarty->render_modulo_padrao($this->app->Template_txf, 'relatorios', 'informativos');

                              //$pagina_relatorio = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'relatorios', 'informativos');
                              //echo ($pagina_relatorio);
                              die();
                        } else {
                              die('relatorio nao disponivel');
                        }
                        break;


                  case 'cadastros' :
                        if (isset($this->relatorios_disponiveis->cadastros)) {
                              $tabela = $this->relatorios_disponiveis->cadastros;
                              $cadastros = $this->mbc->buscar_tudo($tabela, ' order by Tipo_pessoa_txf,Nome_txf,Nome_fantasia_txf');

                              $this->smarty->assign('cadastros', $cadastros);


                              $this->model_smarty->render_modulo_padrao($this->app->Template_txf, 'relatorios', 'cadastros');
                              //  $pagina_relatorio = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'relatorios', 'cadastros');
                              // echo ($pagina_relatorio);
                              die();
                        } else {
                              die('relatorio nao disponivel');
                        }
                        break;

                  case 'curriculos' :
                        if (isset($this->relatorios_disponiveis->curriculos)) {
                              $tabela = $this->relatorios_disponiveis->curriculos;
                              if ($this->mbc->campoexiste('Data_dat', $this->relatorios_disponiveis->curriculos)) {
                                    $orderby = "order by Data_dat desc, Id_int desc";
                                    $this->smarty->assign('tem_data', TRUE);
                              } else {
                                    $orderby = "order by Id_int desc";
                              }
                              $curriculos = $this->mbc->buscar_completo($this->relatorios_disponiveis->curriculos, $orderby);
                              $this->smarty->assign('curriculos', $curriculos);
                              $this->model_smarty->render_modulo_padrao($this->app->Template_txf, 'relatorios', 'curriculos');
                              //  $pagina_relatorio = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'relatorios', 'curriculos');
                              //  echo ($pagina_relatorio);
                              die();
                        } else {
                              die('relatorio nao disponivel');
                        }

                        break;

                  case 'emails' :
                        if (isset($this->relatorios_disponiveis->emails)) {
                              $lista_emails_final = $this->busca_relatorio_emails();
                              $this->smarty->assign('lista_emails', $lista_emails_final);
                              $this->model_smarty->render_modulo_padrao($this->app->Template_txf, 'relatorios', 'emails');
                              //$pagina_relatorio = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'relatorios', 'emails');
                              // echo ($pagina_relatorio);
                              die();
                        } else {
                              die('relatorio nao disponivel');
                        }

                        break;
            }

            if ($this->app->Segmento_padrao_txf == 2) {
                  $this->configura_idioma();
            }

            //$this->model_smarty->render_padrao($this->pagina_atual, $this->app->Template_txf);
            $this->model_smarty->render_padrao($this->pagina_atual,$this->app->Template_relatorio_txf);
            die();
      }

      function busca_relatorios() {
            $this->conecta_mbc($this->app->Conexoes_for);
            $rels = new stdClass();
            if ($this->mbc->tabelaexiste($this->app->Tabela_contato_txf)) {
                  $rels->contatos = $this->app->Tabela_contato_txf;
            }
            if ($this->mbc->tabelaexiste($this->app->Tabela_info_txf)) {
                  $rels->informativos = $this->app->Tabela_info_txf;
            }

            if ($this->mbc->tabelaexiste('curriculos')) {
                  $rels->curriculos = 'curriculos';
            }

            if ($this->mbc->tabelaexiste('cadastros')) {
                  $rels->cadastros = 'cadastros';
            }

            if (isset($rels->informativos) || isset($rels->contatos) || isset($rels->cadastros) || isset($rels->curriculos)) {
                  $rels->emails = 'ok';
            }

            return $rels;
      }

      function busca_relatorio_emails() {
            unset($this->relatorios_disponiveis->emails);
            foreach ($this->relatorios_disponiveis as $key => $value) {
                  $emails[$key] = $this->mbc->executa_sql("select Email_txf from $value group by Email_txf");
            }
            foreach ($emails as $key => $value) {
                  foreach ($value as $item) {
                        $ob = new stdClass();
                        $ob->tabela = $key;
                        $ob->Email_txf = $item->Email_txf;
                        $lista_emails[] = $ob;
                  }
            }
            return $lista_emails;
      }

}

?>