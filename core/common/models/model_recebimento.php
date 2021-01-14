<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');
require COMMONPATH . 'third_party/moip/vendor/autoload.php';

use Moip\Moip;
use Moip\MoipBasicAuth;

class Model_recebimento extends Model_banco_cliente {

    public $db;
    public $app;
    public $moip;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function insere_atualiza($dados) {
        if (is_object($dados)) {
            $array = object_to_array($dados);
        } else {
            $array = $dados;
        }

        if (strpos($dados->nascimento, "/") > -1) {
            $dados->nascimento = data_bd($dados->nascimento);
            $array['nascimento'] = $dados->nascimento;
        }

        $recebimento = $this->busca_recebimento($dados->id_sistema, $dados->referencia);
        if ($recebimento) {

            $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->updateTable('recebimentos', $array, 'Id_int', $recebimento->Id_int, TRUE);
        } else {

            $array['Data_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->db_insert('recebimentos', $array, TRUE);
        }
    }

    function atualiza_status_original($id_recebimento, $status) {

        $array['gateway_status'] = $status;
//        ver($array,1);
//        ver($id_recebimento);
        //  echo "<div class='text-center'>$status</div>";
        return $this->mbc->updateTable("recebimentos", $array, 'Id_int', $id_recebimento, TRUE);
    }

    function atualiza_status($id_recebimento, $meio, $status, $ambiente = 'PRODUCAO') {
        $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
        $array['meio_escolhido'] = $meio;
        $array['status'] = $status;
        $array['ambiente'] = $ambiente;
        //  echo "<div class='text-center'>$status</div>";
        return $this->mbc->updateTable("recebimentos", $array, 'Id_int', $id_recebimento, TRUE);
    }

    function atualiza_id_pagto($id_recebimento, $resposta) {

        $array['id_meio'] = $resposta;
        return $this->mbc->updateTable("recebimentos", $array, 'Id_int', $id_recebimento, 1);
    }

    function armazena_log($tabela, $meio, $outros_dados, $dados, $id_recebimento, $id_usuario, $id_sistema) {

        $array = array();

        $array['outros_dados'] = json_encode($outros_dados);
        $array['dados'] = json_encode($dados);
        $array['id_sistema'] = $id_sistema;
        $array['id_recebimento'] = $id_recebimento;
        $array['id_usuario'] = $id_usuario;
        $array['meio'] = $meio;
        $array['Atualizacao_dat'] = date('Y-m-d H:i:s');
        $array['Data_dat'] = date('Y-m-d H:i:s');
        $array['url_anterior'] = $_SERVER['HTTP_REFERER'];

        $this->mbc->db_insert($tabela, $array);
    }

    function busca_requisicoes($tabela, $id_recebimento) {

        $logs = $this->mbc->executa_sql("select * from $tabela where id_recebimento='{$id_recebimento}'");
        if ($logs[0]) {
            return $logs;
        } else {
            return false;
        }
    }

    function busca_recebimentos_em_aberto($id_sistema,$gateway=null) {
    
//        $sql = "select * from recebimentos where id_sistema='{$id_sistema}' and   id_meio!='' and status!='pago' and status!='cancelado' ";
        $sql = "select * from recebimentos where id_sistema='{$id_sistema}' and  Data_dat>CURRENT_DATE - INTERVAL 15 DAY and  id_meio!='' and status!='pago' and status!='cancelado' and status!='estornado' ";
        
        if($gateway){
     $sql.=" and meio_escolhido='{$gateway}'"   ;
    }


        $recebimentos = $this->mbc->executa_sql($sql);

        if ($recebimentos[0]) {
            return $recebimentos;
        } else {
            return FALSE;
        }
    }

    function busca_recebimentos_sistema($id_sistema = FALSE, $filtros = null) {
        $where = '';
        if ($id_sistema) {
            $where = "where id_sistema='{$id_sistema}'";
        }
        
        $recebimentos = $this->mbc->executa_sql("select * from recebimentos $where order by Id_int desc");
        if ($recebimentos[0]) {
            return $recebimentos;
        } else {
            return FALSE;
        }
    }
    
    
    

    function busca_recebimento($id_sistema, $referencia) {
        $recebimento = $this->mbc->executa_sql("select * from recebimentos where id_sistema='{$id_sistema}' and referencia='{$referencia}'");
        if ($recebimento[0]) {
            return $recebimento[0];
        } else {
            return FALSE;
        }
    }

    function busca_pagamentos($id_recebimento) {
        $pagamentos = $this->mbc->executa_sql("select * from log_retornos where id_recebimento='{$id_recebimento}'");
        if ($pagamentos) {
            return $pagamentos;
        } else {
            return FALSE;
        }
    }

    function busca_recebimento_id($id) {        
        $recebimento = $this->mbc->executa_sql("select * from recebimentos where Id_int='{$id}'");
        if ($recebimento[0]) {
            return $recebimento[0];
        } else {
            return FALSE;
        }
    }

    function busca_usuario($email) {

        $usuario = $this->mbc->executa_sql("select * from usuarios where email='{$email}'");
        if ($usuario[0]) {
            return $usuario[0];
        } else {
            return FALSE;
        }
    }

    function busca_usuario_id($id) {

        $usuario = $this->mbc->executa_sql("select * from usuarios where Id_int='{$id}'");
        if ($usuario[0]) {
            return $usuario[0];
        } else {
            return FALSE;
        }
    }

    function busca_usuarios() {

        $usuario = $this->mbc->executa_sql("select * from usuarios");
        if ($usuario[0]) {
            return $usuario;
        } else {
            return FALSE;
        }
    }

    function busca_sistemas($imagens = TRUE) {
        if ($imagens == TRUE) {
            $sistema = $this->mbc->buscar_completo("sistemas", "where Ativo_sel='SIM'");
        } else {
            $sistema = $this->mbc->buscar_tudo("sistemas", "where Ativo_sel='SIM'");
        }
        if ($sistema[0]) {
            return $sistema;
        } else {
            return FALSE;
        }
    }

    function busca_sistema_nome($nome = null) {
        $where = "";
        if ($nome) {
            $where = "where Nome_txf='{$nome}'";
        }
        $sistema = $this->mbc->buscar_completo("sistemas", "$where");
        if ($sistema[0]) {
            return $sistema[0];
        } else {
            return FALSE;
        }
    }

    function busca_sistema_id($id) {

        $sistema = $this->mbc->buscar_completo("sistemas", "where Id_int='{$id}'");
        if ($sistema[0]) {
            return $sistema[0];
        } else {
            return FALSE;
        }
    }

    function busca_conta_moip_id($id) {

        $conta = $this->mbc->executa_sql("select * from contas_moip where Id_int='{$id}'");
        if ($conta[0]) {
            return $conta[0];
        } else {
            return FALSE;
        }
    }
    
       function busca_conta_cielo_id($id) {

        $conta = $this->mbc->executa_sql("select * from contas_cielo where Id_int='{$id}'");
        if ($conta[0]) {
            return $conta[0];
        } else {
            return FALSE;
        }
    }

    function busca_contas_moip() {

        $conta = $this->mbc->executa_sql("select * from contas_moip");
        if ($conta[0]) {
            return $conta;
        } else {
            return FALSE;
        }
    }

    function atualiza_recebimentos_usuario($usuario) {
        unset($usuario->Id_int);
        unset($usuario->Tipo_sel);
        unset($usuario->Data_dat);
        unset($usuario->Atualizacao_dat);
        $array = object_to_array($usuario);

//          ver($array);
        $this->mbc->updateTable("recebimentos", $array, "email", $array['email']);
    }

    function insere_atualiza_usuario($dados) {
        if (is_object($dados)) {
            $array = object_to_array($dados);
        } else {
            $array = $dados;
        }
        if (strpos($dados->nascimento, "/") > -1) {
            $dados->nascimento = data_bd($dados->nascimento);
            $array['nascimento'] = $dados->nascimento;
        }
        $usuario = $this->busca_usuario($dados->email);

        if ($usuario) {
            unset($array['Id_int']);
            $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            $user = $this->mbc->updateTable('usuarios', $array, 'Id_int', $usuario->Id_int, TRUE);
            return $user;
        } else {

//            $array['nascimento'] = data_bd($dados->nascimento);
            $array['Data_dat'] = date('Y-m-d H:i:s');
            return $this->mbc->db_insert('usuarios', $array, TRUE);
        }
    }

    function valida_campos_usuario($usuario) {

        if ($usuario->nascimento == '0000-00-00') {

            ver("data de nascimento invalida", 1);
            return false;
        }
        if (!$usuario->cpf) {
            ver("sem cpf", 1);
            return false;
        }
        if (!$usuario->email) {
            ver("sem email", 1);
            return false;
        }
        if (!$usuario->telefone) {
            ver("sem telefone", 1);
            return false;
        }
        if (!$usuario->Endereco_txf) {
            ver("sem Endereco_txf", 1);
            return false;
        }
        if (!$usuario->Bairro_txf) {
            ver("sem Bairro_txf", 1);
            return false;
        }
        if (!$usuario->Cidade_txf) {
            ver("sem Cidade_txf", 1);
            return false;
        }
        if (!$usuario->Estado_sel) {
            ver("sem Estado_sel", 1);
            return false;
        }

        return true;
    }

    

}

