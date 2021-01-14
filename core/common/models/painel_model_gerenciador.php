<?php

/*
 *  ESTA CLASSE SE COMUNICA COM O BANCO DE DADOS DO PAINEL, 
 *  BUSCA AS CONFIGURAÇÕES DA TABELA DOS CLIENTES
 *  
 */

class Painel_model_gerenciador extends Model_banco_cliente {

    public $app;
    public $cliente;
    public $configuracoes;
    public $versao;

    function __construct() {
        parent::__construct();
    }

    function busca_configuracoes($id_modulo) {

        $configuracoes = $this->mbc->buscar_completo("modulos_gc", "where Id_int={$id_modulo}");
        if ($configuracoes[0]) {
            return $configuracoes[0];
        } else {
            return FALSE;
        }
    }

    function inicializa($app, $cliente = null, $configuracoes = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
        if ($configuracoes) {
            $this->configuracoes = $configuracoes;
            $this->busca_versao();
        }
    }

    function busca_modulos($usuario = FALSE) {
        $where = '';
        $sql = "select * from modulos_gc where Id_int is not null ";
        if ($usuario->Tipo != 'admin') {
            $sql.= " and Usuarios_for={$usuario->Id_int}";
        }

        $modulos = $this->mbc->executa_sql($sql);

        return $modulos;
    }

    function busca_sessoes_menu() {
        $sql = "select Sessao_sel from gerenciador_configs where Modulos_gc_for={$this->configuracoes->Id_int} group by Sessao_sel order by Sessao_sel, Ordenacao_txf, Label_txf";
        $sessoes = $this->executa_sql($sql);

        foreach ($sessoes as $sessao) {
            $sql = "select * from gerenciador_configs where Modulos_gc_for={$this->configuracoes->Id_int} and Sessao_sel='{$sessao->Sessao_sel}' group by Tabela_txf  order by Ordenacao_txf, Label_txf";
            $sessao->Tabelas = $this->executa_sql("$sql");
        }
        return $sessoes;
    }

    function troca_conexao($dados) {
        $this->db = $this->load->database($dados, TRUE);
    }

    function busca_versao() {
        $gerenciador_configs = $this->mbc->executa_sql("select * from gerenciador_configs where Modulos_gc_for={$this->configuracoes->Id_int} ");
        if ($gerenciador_configs[0]) {
            $this->versao = 'nova';
        } else {
            $this->versao = 'antiga';
        }
        return $this->versao;
    }

    function busca_configuracoes_tabela($id) {
        $config_tabela = $this->executa_sql("select * from gerenciador_configs where  Modulos_gc_for={$this->configuracoes->Id_int}  and Id_int={$id}");
        if ($config_tabela[0]) {
            $sql = "select *  from gerenciador_excecoes where Gerenciador_configs_for={$config_tabela[0]->Id_int}";
            $config_tabela[0]->Excecoes = $this->executa_sql($sql);
            if ($config_tabela[0]->Config_jso) {
                $config_tabela[0]->Config = json_decode($config_tabela[0]->Config_jso);
                unset($config_tabela[0]->Config_jso);
            }
            return $config_tabela[0];
        }
        die('acesso negado a tabela');
    }

    function busca_id_tabela($tabela, $id_modulo) {
        $sql = "select * from gerenciador_configs where  Modulos_gc_for={$id_modulo}  and Tabela_txf='{$tabela}'";

        $config_tabela = $this->executa_sql($sql);
        if ($config_tabela[0]) {

            return $config_tabela[0]->Id_int;
        }
    }

}

?>
