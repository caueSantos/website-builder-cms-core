<?php

class Model_inscricoes_facebook extends CI_Model {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    private $tabela_inscricoes = 'inscricoes';
    private $tabela_bloqueios = 'bloqueios';
    private $tabela_promocoes = 'promocoes';
    private $dados;

    function __construct() {
        parent::__construct();
        if (isset($_POST)) {
            $this->dados = $_POST;
        }
    }

    function insere_inscricao() {
        if (isset($_POST['Tabela_txf'])) {
            $this->tabela_inscricoes = $_POST['Tabela_txf'];
        }




        if (!$this->verifica_usuario_bloqueado()) {
            if (!$this->verifica_inscricao_dupla()) {
                if ($this->model_banco->db_insert($this->tabela_inscricoes, $_POST)) {
                    $retorno['resultado'] = 'ok';
                    $retorno['mensgagem'] = 'Inserido com sucesso';
                    return $retorno;
                } else {
                    $retorno['resultado'] = 'erro';
                    $retorno['mensgagem'] = 'Erro ao inserir';
                    return $retorno;
                }
            } else {
                $retorno['resultado'] = 'duplicado';
                $retorno['mensgagem'] = 'Já cadastrado';
                return $retorno;
            }
        } else {
            $retorno['resultado'] = 'bloqueado';
            $retorno['mensgagem'] = 'Usuário Bloqueado';
            return $retorno;
        }
    }

    function envia_email() {
        $this->load->model('model_mail');
    }

    function verifica_usuario_bloqueado($user = null) {
        if (!isset($user)) {
            $user = $_POST['Facebook_id_txf'];
        }

        $sql = "select * from $this->tabela_bloqueios where Ativo_sel='SIM' and Facebook_id_txf='" . $user . "' ";
        $bloqueado = $this->model_banco->executa_sql($sql);
        if (isset($bloqueado[0]->Id_int)) {
            return true;
        } else {
            return false;
        }
    }

    function verifica_inscricao_dupla($user = null, $promocao = null) {
        if (!isset($promocao)) {
            $promocao = $_POST['Id_objeto_con'];
        }
        if (!isset($user)) {
            $user = $_POST['Facebook_id_txf'];
        }
        $sql = "select * from $this->tabela_inscricoes where Facebook_id_txf='" . $user . "' and Id_objeto_con=" . $promocao . " ";

        $inscrito = $this->model_banco->executa_sql($sql);
        if (isset($inscrito[0]->Id_int)) {
            return true;
        } else {
            return false;
        }
    }

    function verifica_promocao_encerrada($promocao = null) {
        if (!isset($promocao)) {
            $promocao = $_POST['Id_objeto_con'];
        }


        if ($promocao[0]->Fim_dat >= date('Y-m-d')) {

            return false;
        } else {

            return true;
        }
    }

    function verifica_promocao_nao_iniciada($promocao = null) {
        if (!isset($promocao)) {
            $promocao = $_POST['Id_objeto_con'];
        }


        if ($promocao[0]->Inicio_dat <= date('Y-m-d')) {

            return false;
        } else {

            return true;
        }
    }

    function verifica_sexo_invalido($usuario = null, $promocao = null) {
        if (!isset($promocao)) {
            $promocao = $_POST['Id_objeto_con'];
        }
        if (!isset($usuario)) {
            die('Função verifica sexo não recebeu o parâmetro $usuario');
        }

        if ($promocao[0]->Sexo_permitido_sel == 'TODOS') {
            return false;
        } else {
            if ($usuario['gender'] == $promocao[0]->Sexo_permitido_sel) {

                return false;
            } else
                return true;
        }
    }

    function atualiza_registro() {
        $dados = $_POST;
        if (!isset($dados['Tabela_txf']))
            die('Campo Tabela_txf nao encontrado');

        $this->model_banco->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int']);
    }

}

