<?php

/*
 *  ESTA CLASSE SE COMUNICA COM O BANCO DE DADOS DO PAINEL, 
 *  BUSCA AS CONFIGURAÇÕES DA TABELA DOS CLIENTES
 *  
 */

class Painel_model_migracao extends Model_banco_cliente {

    public $app;
    public $cliente;
    public $configuracoes;
    public $versao;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null, $configuracoes = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
//        if ($configuracoes) {
//            $this->configuracoes = $configuracoes;
//            $this->busca_versao();
//        }
    }

    function verifica_duplicidade_modulo($id_antigo, $id_usuario) {
        $modulos = $this->mbc->executa_sql("select * from modulos_gc where Id_antigo_hid=$id_antigo and Usuarios_for=$id_usuario");
        if ($modulos[0]) {
            return false;
        } else {
            return true;
        }
    }

    function prepara_modulo($tipo, $cliente_antigo, $modulo_antigo = null) {

        $modulo = new stdClass();

        switch ($tipo) {
            case 'principal':

                $modulo->Id_antigo_hid = $cliente_antigo->Id_int;
                $modulo->Tipo_sel = $tipo;
                $modulo->Nome_txf = $cliente_antigo->Nome_modulo_txf;
                $modulo->Bd_host_txf = $cliente_antigo->Servidor_txf;
                $modulo->Bd_usuario_txf = $cliente_antigo->Usuario_bd_txf;
                $modulo->Bd_senha_txf = $cliente_antigo->Senha_bd_txf;
                $modulo->Bd_database_txf = $cliente_antigo->Nome_bd_txf;
                $modulo->Http_caminho_txf = $cliente_antigo->Host_Ftp_txf;
                $modulo->Ftp_caminho_txf = $cliente_antigo->Path_Ftp_txf;


                break;
            case 'modulo':

                $modulo->Id_antigo_hid = $modulo_antigo->Id_int;
                $modulo->Tipo_sel = $tipo;
                $modulo->Nome_txf = $modulo_antigo->Nome_txf;
                $modulo->Bd_host_txf = $modulo_antigo->Servidor_bd_txf;
                $modulo->Bd_usuario_txf = $modulo_antigo->Usuario_bd_txf;
                $modulo->Bd_senha_txf = $modulo_antigo->Senha_bd_txf;
                $modulo->Bd_database_txf = $modulo_antigo->Nome_bd_txf;
                $modulo->Http_caminho_txf = $modulo_antigo->Host_modulo_txf;
                $modulo->Ftp_caminho_txf = $modulo_antigo->Path_modulo_txf;


                break;
        }

        $modulo->Nome_cliente_txf = $cliente_antigo->Fantasia_txf;
        $modulo->Usuarios_for = $cliente_antigo->Id_whmcs_txf;
        $modulo->Ftp_host_txf = $cliente_antigo->Ftp_host_txf;
        $modulo->Ftp_usuario_txf = $cliente_antigo->Ftp_user_txf;
        $modulo->Ftp_senha_txf = $cliente_antigo->Ftp_pass_txf;

        $modulo->Nivel_sel = 3;
        $modulo->Ativo_sel = 'SIM';


        return $modulo;
    }

    function insere_atualiza($dados) {
        if (is_object($dados)) {
            $array = object_to_array($dados);
        } else {
            $array = $dados;
        }


        if (isset($array['Id_int'])) {
            $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->updateTable('modulos_gc', $array, 'Id_int', $array['Id_int'], TRUE);
        } else {
            $array['Data_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->db_insert('modulos_gc', $array, TRUE);
        }
    }

    function troca_conexao($dados) {
        $this->db = $this->load->database($dados, TRUE);
    }

    function insere_atualiza_config($dados) {
        if (is_object($dados)) {
            $array = object_to_array($dados);
        } else {
            $array = $dados;
        }


        if (isset($array['Id_int'])) {
            $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->updateTable('gerenciador_configs', $array, 'Id_int', $array['Id_int'], TRUE);
        } else {
            $array['Data_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->db_insert('gerenciador_configs', $array, TRUE);
        }
    }

    function busca_cliente($id) {
        $cliente = $this->mbc->executa_sql("select * from clientes where Id_int=$id and Id_whmcs_txf is not null");
        if ($cliente[0]) {
            return $cliente[0];
        } else {
            return false;
        }
    }

    function busca_modulos($id_cliente) {
        $modulos = $this->mbc->executa_sql("select * from modulos where Id_objeto_con=$id_cliente and Tabela_con='clientes'");

        if ($modulos[0]) {
            return $modulos;
        } else {
            return false;
        }
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

}

?>
