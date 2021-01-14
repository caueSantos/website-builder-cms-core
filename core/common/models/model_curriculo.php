<?php

class Model_curriculo extends CI_Model {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    private $tabela_curriculo = 'curriculos';
    public $campo_email;
    public $valor_email;
    public $grupo_padrao = 'TODOS';
    public $app;

    function __construct() {

        parent::__construct();


        $this->load->model('model_mail');
    }

// ------------------------------------------------------------------------
    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    public function valida_email($email = null) {
        if (!isset($email)) {
            $email = $_POST['Email_txf'];
        }


        $expressao = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
        if (eregi($expressao, $email)) {
            return true;
        } else {
            return false;
        }
    }

    public function cria_tabela_curriculo($lands_id = null, $tabela_curriculo = null) {
        if (!isset($lands_id)) {
            die('Lands ID nao foi passado como parametro na criacao da tabela informativo');
        }
        $now = date('Y-m-d');
        $script[] = " SET NAMES utf8;";
        $script[] = "SET foreign_key_checks = 0;";
        $script[] = "SET time_zone = 'SYSTEM';";
        $script[] = "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';";

        if (isset($tabela_curriculo)) {
            $this->tabela_curriculo = $tabela_curriculo;
        }



        $script[] = "CREATE TABLE `$this->tabela_curriculo` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Email_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Telefone_txf` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Departamento_sel` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Curriculo_arq` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $script[] = "COMMIT;";
        $script[] = "DROP TABLE IF EXISTS `arquivos`;";
        $script[] = "CREATE TABLE `arquivos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_arquivo_con` int(11) DEFAULT NULL,
  `Tabela_con` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Descricao_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Caminho_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Tipo_txf` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Nome_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Data_int` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;";



        print_r("..Criando tabela $this->tabela_curriculo e arquivos");
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

