<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');

class Model_hipereventos extends Model_banco_cliente {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    private $tabela_inscricoes = 'inscricoes';
    private $tabela_bloqueios = 'bloqueios';
    private $tabela_promocoes = 'promocoes';
    private $dados;
    public $namespace_empresa;
    public $namespace_promocao;

    function __construct() {

        parent::__construct();
        if (isset($_POST)) {
            $this->dados = $_POST;
        }
    }

    function inicializa($promocao) {
        $this->namespace_empresa = $promocao[0]->Namespace_empresa_sel;
        $this->namespace_promocao = $promocao[0]->Namespace_promocao_txf;
    }

    function insere_inscricao() {
        if (isset($_POST['Tabela_txf'])) {
            $this->tabela_inscricoes = $_POST['Tabela_txf'];
        }

        $hora = date('H');
        $hora = $hora + 5;
        $dia = date('Y-m-d');
        $hora = $hora . date(':i:s');
        $_POST['Data_dat'] = $dia;
        $_POST['Data_hora_dat'] = $dia . ' ' . $hora;

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

        $sql = "select * from $this->tabela_bloqueios where Ativo_sel='SIM'  ";
        $bloqueados = $this->model_banco->executa_sql($sql);
        $bloqueio = false;
        if (isset($bloqueados[0]->Id_int)) {

            foreach ($bloqueados as $bloqueado) {
                $bloqueado_id = explode('/', $bloqueado->Usuario_sel);
                $bloqueado->Nome_txf = $bloqueado_id[0];
                $bloqueado->Facebook_id_txf = $bloqueado_id[1];

                if ($bloqueado->Facebook_id_txf == $user) {

                    if ($bloqueado->Namespace_empresa_sel == $this->namespace_empresa) {
                        if ($bloqueado->Namespace_promocao_txf == $this->namespace_promocao || $bloqueado->Namespace_promocao_txf == 'TODAS' || $bloqueado->Namespace_promocao_txf == '') {
                            $bloqueio = true;
                        }
                    }
                    if ($bloqueado->Namespace_empresa_sel == 'TODAS') {
                        $bloqueio = true;
                    }
                }
            }
        }


        return $bloqueio;
    }

    function verifica_inscricao_dupla($user = null) {

        if (!isset($user)) {
            $user = $_POST['Facebook_id_txf'];
        }

        $sql = "select * from {$this->tabela_inscricoes} where Facebook_id_txf='{$user}' and Namespace_empresa_txf='{$this->namespace_empresa}' and Namespace_promocao_txf='{$this->namespace_promocao}' ";


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

    function atualiza_registro() {
//            ver($_POST);
        $dados = $_POST;
        if (!isset($dados['Tabela_txf']))
            die('Campo Tabela_txf nao encontrado');
        if (!isset($dados['Id_int']))
            die('Campo Id_int nao encontrado');
//            $dados['Ultima_atualizacao_dat'] = retorna_date_time();

        return $this->model_banco->updateTable($dados['Tabela_txf'], $_POST, 'Id_int', $dados['Id_int']);
    }

}

