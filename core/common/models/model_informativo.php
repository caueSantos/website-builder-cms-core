<?php

class Model_informativo extends CI_Model {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    private $tabela_emails_info = '_emails_informativo';
    public $campo_email;
    public $valor_email;
    public $grupo_padrao = 'TODOS';

    function __construct() {

        parent::__construct();


        $this->load->model('model_mail');
    }

    public function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

// ------------------------------------------------------------------------

    /**
     * Classe Cadastro_model
     *
     * Função: Cadastra o email do internauta no Banco de dados do site e do Informativo da Lands
     *
     * @package		Models
     * @author		Equipe Lands Agência Interativa
     * @category	    Model
     */
    function prepara_informativo_local($lands_id, $tabela_info_txf = null, $retorno = null) {
        if (!isset($lands_id)) {
            die('Lands ID nao foi passado como parametro na criacao da tabela informativo');
        }

        if (isset($tabela_info_txf))
            $this->tabela_emails_info = $tabela_info_txf;

        if (isset($_REQUEST['Email_txf'])) {
            $this->campo_email = 'Email_txf';
        }
        if (isset($_REQUEST['email'])) {
            $this->campo_email = 'email';
        }

//        print_r($_REQUEST);
        if (!isset($this->campo_email)) {
            die('nao encontrou campo do email no post');
        }


        $this->valor_email = $_REQUEST[$this->campo_email];
        $dados = $_POST;

        $dados['campo_email'] = $this->campo_email;
        $dados['valor_email'] = $this->valor_email;
        $dados['tabela_emails_info'] = $this->tabela_emails_info;
      


        if ($this->model_banco->tabelaexiste($this->tabela_emails_info)) {
            $dados['next'] = 'inserir';
        } else {

            $dados['next'] = 'criar_tabela';
        }
        return $dados;
    }

    public function valida_email($email = null) {
        if (!isset($email)) {
            $email = $_POST['Email_txf'];
        }
        //$expressao = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
        $expressao = '/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (preg_match($expressao, $email)) {
            return true;
        } else {
            return false;
        }
    }

    public function verifica_duplicidade($dados, $retorno = null) {
        $sql = "select * from " . $dados['tabela_emails_info'] . " where " . $dados['campo_email'] . "='" . $dados['valor_email'] . "'";


        $res = $this->db->query($sql);
        $registros = $res->result();



        if (isset($registros[0]->Id_int)) {


            if ($retorno == 'boolean') {
                return false;
            } else {
//   echo 'Usuario já cadastrado no info e no site';
                $dados['mensagem'] = 'Email já cadastrado!';
                $dados['resposta'] = 'duplicado';
                $dados['css_message'] = '<span style="color:#D83F4A">Email já cadastrado</span>';

                return $dados;
            }
        } else {
            if ($retorno == 'boolean') {
                return true;
            } else {
                $dados['mensagem'] = '';
                $dados['resposta'] = 'ok';

                return $dados;
            }
        }
    }

    function insere_info_local($dados, $retorno = '') {
        if (!isset($dados['Grupo_sel'])) {
            $dados['Grupo_sel'] = $this->grupo_padrao;
        }

        $this->output->enable_profiler(FALSE);
        $inserir2 = $this->model_banco->db_insert($dados['tabela_emails_info'], $dados);

        if ($inserir2) {

// echo('nao inseriu acho'); die();
            if ($retorno == 'boolean') {
                return true;
            } else {
// echo 'Usuário já existe no info mas foi cadastrado no site!';
                $dados['mensagem'] = 'Email cadastrado com sucesso!';
                $dados['resposta'] = 'ok';
                $dados['css_message'] = '<span style="color:green">Email cadastrado com sucesso</span>';
                return $dados;
            }
        } else {

//        echo('nseriu acho'); die();
            if ($retorno == 'boolean') {
                return false;
            } else {
                $dados['mensagem'] = 'Erro ao gravar email!';
                $dados['resposta'] = 'erro';

                return $dados;
            }
        }
    }

    public function criar_tabela_info($lands_id = null, $tabela_emails_info = null) {
        if (!isset($lands_id)) {
            die('Lands ID nao foi passado como parametro na criacao da tabela informativo');
        }
        $now = date('Y-m-d');
        $script[] = " SET NAMES utf8;";
        $script[] = "SET foreign_key_checks = 0;";
        $script[] = "SET time_zone = 'SYSTEM';";
        $script[] = "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';";

        if (isset($tabela_emails_info)) {
            $this->tabela_emails_info = $tabela_emails_info;
        }
        $script[] = "CREATE TABLE `$this->tabela_emails_info` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  `Grupo_sel` enum('TODOS','ALUNOS','PROFESSORES','GERENTES') NOT NULL,  `Data_dat` date NOT NULL,
  `Ultimoenvio_dat` date NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
        $script[] = "COMMIT;";
        $script[] = "INSERT INTO `$this->tabela_emails_info` (`Id_int`, `Lands_id`, `Email_txf`, `Ativo_sel`, `Grupo_sel`, `Ultimoenvio_dat`) VALUES
(1, '" . $lands_id . "', 'gustavo.vedana@landsdigital.com.br.com', 'SIM', 'TODOS', '$now');
";
        print_r("..Criando tabela $this->tabela_emails_info");
        foreach ($script as $key => $value) {
            $res = $this->db->query($value);
            if ($res == false) {
                echo 'Erro ao executar';
                break;
            }
            $resposta[] = $res;
        }

        return $resposta;
    }

}

