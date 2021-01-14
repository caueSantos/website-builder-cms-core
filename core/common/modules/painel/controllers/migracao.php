<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(COMMONPATH . 'core/lands_painel.php');

class migracao extends lands_painel {

    public $modulo = 'migracao';
    public $configuracoes;
    public $conexao_painel;
    public $menu_tabelas;
    public $conexao_cliente;

//    public $versao; 

    function __construct() {
        parent::__construct();
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
    }

    function index() {


        $funcao = $this->pagina_atual;
        if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
            $funcao = ($this->uri->segment($this->app->Segmento_padrao_txf + 1));
        }
        if (!method_exists(__CLASS__, $funcao)) {

            $this->carrega_pagina($this->pagina_atual);
        } else {
//executa uma funcao que deve ser programa nesta classe.

            $this->$funcao();
        }
    }

    function post() {



        if ($this->uri->segment(3)) {
            $segmento_post = $this->uri->segment(3);
        } else {
            die('tipo de post nao passado');
        }


        switch ($segmento_post) {

            case 'migrar':
                $this->load->model('painel_model_migracao');
                $this->painel_model_migracao->inicializa($this->app, $this->cliente);

                $dados = array();
                $dados['clientes'][] = array_to_object($_POST['clientes']);
                if (is_array($_POST['modulos'])) {
                    foreach ($_POST['modulos'] as $mod) {
                        $dados['modulos'][] = array_to_object($mod);
                    }
                }
//                $obj=new stdClass();
                $modulo_inserido = array();

                $this->load->model('painel_model_gerenciador');
                $cliente = $dados['clientes'][0];
                $modulo = $this->painel_model_migracao->prepara_modulo('principal', $cliente);
                if ($this->painel_model_migracao->verifica_duplicidade_modulo($cliente->Id_int, $cliente->Id_whmcs_txf)) {

                    echo "Criando módulo {$modulo->Nome_txf}<br>";
                    $cliente_inserido = $this->painel_model_migracao->insere_atualiza($modulo);

                    $this->cria_configuracoes($cliente_inserido->Id_int);
                    echo "Criou as configurações do módulo {$modulo->Nome_txf}<br>";
                } else {
                    echo "Módulo {$modulo->Nome_txf} já foi importado antes!<br>";
                }


                if (isset($dados['modulos'])) {
                    if (is_array($dados['modulos'])) {
                        foreach ($dados['modulos'] as $modulo) {
                            if ($this->painel_model_migracao->verifica_duplicidade_modulo($modulo->Id_int, $cliente->Id_whmcs_txf)) {
                                $modulo = $this->painel_model_migracao->prepara_modulo('modulo', $cliente, $modulo);
                                echo "Criando módulo {$modulo->Nome_txf}<br>";
                                $modulo_inserido = $this->painel_model_migracao->insere_atualiza($modulo);
                                $this->cria_configuracoes($modulo_inserido->Id_int);
                                echo "Criou as configurações do módulo {$modulo->Nome_txf}<br>";
                            } else {
                                echo "Módulo {$modulo->Nome_txf} já foi importado antes!<br>";
                            }
                        }
                    }
                }
                $mensagem = "migrou_ok";
                $this->smarty->assign('mensagem', $mensagem);

                $this->model_smarty->render_ajax_modular('mensagens', $this->app->Template_txf, $this->modulo);

                die();
                break;

            default:
                die('tipo de post invalido');
                break;
        }
    }

    function cria_configuracoes($id_modulo) {
        $configuracoes_cliente = $this->painel_model_gerenciador->busca_configuracoes($id_modulo);
        $this->conecta_model_tabela($configuracoes_cliente);
        $this->mt->inicializa($this->app, $this->cliente, $id_modulo);
        $dados_antigos = $this->mt->busca_configuracoes_antigas();


        $this->conexao_painel = $this->dados_conexao;
        $this->painel_model_migracao->troca_conexao($this->conexao_painel);



        foreach ($dados_antigos->restricao as $restricao) {
            $dados = new stdClass();
            $dados->Modulos_gc_for = $id_modulo;
            $dados->Sessao_sel = 'default';
            $dados->Tabela_txf = $restricao->Tabela_txf;
            $dados->Limite_txf = '';
            $dados->Nivel_sel = $restricao->Nivel_sel;

            $dados->Label_txf = $restricao->Label_txf;
            $dados->Explicacao_txa = $restricao->Explicacao_txa;

            $this->painel_model_migracao->insere_atualiza_config($dados);
        }
    }

    function switch_pagina() {

        $this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));
        switch ($this->pagina_atual) {

            case 'migrar':
                $this->conecta_mbc(44);


                $this->load->model('painel_model_migracao');
                $this->painel_model_migracao->inicializa($this->app, $this->cliente);
                $id_cliente = $_POST['id_cliente'];
                

                $clientes = $this->painel_model_migracao->busca_cliente($id_cliente);
                if (isset($clientes->Id_int)) {

                    $this->smarty->assign('clientes', $clientes);
                    $modulos = $this->painel_model_migracao->busca_modulos($clientes->Id_int);
                    $this->smarty->assign('modulos', $modulos);
                } else {
                    die("cliente {$id_cliente} não enontrado");
                }
                




                break;


            default:
                break;
        }
    }

}

