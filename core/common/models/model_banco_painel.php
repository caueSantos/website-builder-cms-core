<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_banco_painel extends Model_banco {

    public $db = null;
    public $app;
    public $nome_campo;
    public $extensao;

    function __construct() {
        parent::__construct();
    }

// chama o MODEL BANCO PAINEL que vai separar a extensao e chamar o modal de edição do campo
// parametros do POST:  [tabela],[id_registro],[campo]
    function editar_campo() {
        $this->conecta_base_cliente($this->configuracoes);
        $parametros = $_POST;
        $this->mbp->editar_campo($parametros);
    }

    function salvar_campo() {
        $this->conecta_base_cliente($this->configuracoes);
        $parametros = $_POST;
        $this->mbp->salvar_campo($parametros);
    }

    function abre_tabela() {
        $objeto_permissao = $this->verifica_permissao();
        if ($objeto_permissao['resultado']) {
            $this->conecta_base_cliente($this->configuracoes);
            $estrutura = $this->mbp->executa_sql("describe $this->tabela");
            $this->smarty->assign('estrutura', $estrutura);
            $registros = $this->mbp->executa_sql("select * from $this->tabela");
            $this->smarty->assign('registros', $registros);
            $this->model_smarty->carrega_bloco('js_tabela', 'js_tabela', $this->app->Template_txf);
            $this->model_smarty->carrega_bloco('tabela', 'tabela', $this->app->Template_txf);
        } else {

            $this->retorna_mensagem($objeto_permissao['mensagem'], 'danger');
        }
    }

    function retorna_mensagem($msg, $tipo = null) {
        if (!isset($tipo)) {
            $tipo = 'info';
        }
        $this->smarty->assign('mensagem', $msg);
        $this->smarty->assign('tipo_msg', $tipo);
        $mensagem_ajax = $this->model_smarty->return_ajax('msg_generica', $this->app->Template_txf);
        $this->smarty->assign('mensagem_ajax', $mensagem_ajax);
    }

    function verifica_permissao() {
        $retorno['resultado'] = false;
        $retorno['mensagem'] = 'Esta tabela não está configurada para ser exibida';
        foreach ($this->menu_tabelas as $tab) {
            if ($tab->Tabela_txf == $this->tabela) {
                $resultado['mensagem'] = '';
                if ($tab->Nivel_sel <= $this->usuario_logado->Nivel_sel) {
                    $this->smarty->assign('tabela_restricao', $tab);
                    $retorno['resultado'] = true;
                } else {
                    $retorno['mensagem'] = "Esta tabela só pode ser acessada por usuários de nível " . $tab->Nivel_sel;
                }
                break;
            }
        }

        return $retorno;
    }

//      function inicializa($app) {
//            $this->app = $app;
//      }
//
//      function editar_campo($dados) {
//            $this->nome_campo = remove_sufixo($dados['campo']);
//            $this->extensao = retorna_extensao($dados['campo']);
//            $this->exibe_modal($dados);
//      }
//
//      function salvar_campo($dados) {
//            $this->nome_campo = remove_sufixo($dados['campo']);
//            $this->extensao = retorna_extensao($dados['campo']);
//
//            $dados['valor'] = $this->trata_valor($dados['valor']);
//
//            $this->trata_salvamento($dados);
//
////            if ($this->updateTable($post_array, $primary_key_value));
//      }
//
//      function trata_valor($valor) {
//
//            switch ($this->extensao) {
//                  case 'txf':
//
//
//                        break;
//                  case 'int':
//                        break;
//                  case 'txa':
//
//                        $valor = htmlentities($valor);
//
//
//                        break;
//            }
//
//            return $valor;
//      }
//
//      function trata_salvamento($dados) {
//            $tabela = $dados['tabela'];
//            $primarykeyValue = $dados['id_registro'];
//            $valor = $dados['valor'];
//            $campo = $dados['campo'];
//            $updateArr[$campo] = $valor;
//            $primaryKey = 'Id_int';
//
//
//            switch ($this->extensao) {
//                  case 'txf':
//                        if ($this->updateTable($tabela, $updateArr, $primaryKey, $primarykeyValue)) {
//                              $this->smarty->assign('resposta', 'salvou_ok');
//                              $this->model_smarty->render_ajax('msg_gerenciador', $this->app->Template_txf);
//                        } else {
//                              $this->smarty->assign('resposta', 'salvou_erro');
//                              $this->model_smarty->render_ajax('msg_gerenciador', $this->app->Template_txf);
//                        }
//
//                        break;
//                  case 'int':
//                        break;
//                  case 'txa':
//
//
//
////                        if ($this->updateTable($tabela, $updateArr, $primaryKey, $primarykeyValue)) {
////                              $this->smarty->assign('resposta', 'salvou_ok');
////                              $this->model_smarty->render_ajax('msg_gerenciador', $this->app->Template_txf);
////                        } else {
////                              $this->smarty->assign('resposta', 'salvou_erro');
////                              $this->model_smarty->render_ajax('msg_gerenciador', $this->app->Template_txf);
////                        }
//                        break;
//            }
//      }
//
//      function exibe_modal($dados) {
//            $tabela = $dados['tabela'];
//            $id = $dados['id_registro'];
//            $campo = $dados['campo'];
//            $this->smarty->assign('tabela', $tabela);
//            $this->smarty->assign('id_registro', $id);
//            $this->smarty->assign('campo_clicado', $campo);
//            $this->smarty->assign('nome_campo', $this->nome_campo);
//
//            switch ($this->extensao) {
//                  case 'txf':
//                        $registro = $this->executa_sql("select Id_int, $campo from $tabela where Id_int=$id");
//                        $this->smarty->assign('registro', $registro[0]);
//                        $this->model_smarty->render_ajax('modal_txf', $this->app->Template_txf);
//                        break;
//                  case 'int':
//                        break;
//                  case 'txa':
//
//                        
//                        $registro = $this->executa_sql("select Id_int, $campo from $tabela where Id_int=$id");
//                        $this->smarty->assign('registro', $registro[0]);
//                        $this->model_smarty->render_ajax('modal_txa', $this->app->Template_txf);
//                        break;
//            }
//      }
}

