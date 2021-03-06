<?php

class Model_contato extends CI_Model {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    private $tabela_emails_contato = '_contato';
    public $campo_email;
    public $valor_email;
    public $grupo_padrao = 'TODOS';
    public $app;

    function __construct() {

        parent::__construct();
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

// ------------------------------------------------------------------------

    /**
     * Classe Cadastro_model
     *
     * Função: Cadastra o email do internauta no Banco de dados do site e do contato da Lands
     *
     * @package		Models
     * @author		Equipe Lands Agência Interativa
     * @category	    Model
     */
    function prepara_contato_local($lands_id, $tabela_contato_txf = null, $retorno = null) {
        if (!isset($lands_id)) {
            die('Lands ID nao foi passado como parametro na criacao da tabela contato');
        }
        if (isset($tabela_contato_txf)) {
            $this->tabela_emails_contato = $tabela_contato_txf;
        } else {
            if ($_POST['tabela']) {
                $this->tabela_emails_contato = $_POST['tabela'];
            }
        }

        if ($_POST['tabela']) {
            $this->tabela_emails_contato = $_POST['tabela'];
        }




        if (isset($_REQUEST['Email_txf'])) {
            $this->campo_email = 'Email_txf';
        }
        if (isset($_REQUEST['email'])) {
            $this->campo_email = 'email';
        }
        if (!isset($this->campo_email)) {
            die('nao encontrou campo do email no post');
        }
        $dados = $_REQUEST;

        $this->valor_email = $_REQUEST[$this->campo_email];

        $dados['campo_email'] = $this->campo_email;
        $dados['valor_email'] = $this->valor_email;
        $dados['tabela_emails_contato'] = $this->tabela_emails_contato;


        if ($this->model_banco->tabelaexiste($this->tabela_emails_contato)) {
            $dados['next'] = 'inserir';
        } else {

            $dados['next'] = 'criar_tabela';
        }
        return $dados;
    }

    function insere_contato_local($dados, $retorno = '') {

        $now = date('Y-m-d');
        if (!isset($_REQUEST['Data_dat']))
            $_REQUEST['Data_dat'] = $now;
        if (!isset($_REQUEST['Setor_sel'])) {
            $_REQUEST['Setor_sel'] = 'Desenvolvimento';
        }
        if (!isset($_REQUEST['Mensagem_txa'])) {


            if (isset($_REQUEST['Caminho_txf'])) {
                $_REQUEST['Mensagem_txa'] = "<h4>Imagem Solicitada {$_REQUEST['Imagem_txf']}</h4>";
                $_REQUEST['Mensagem_txa'].="<a target='_blank' href='{$this->app->Url_cliente}{$this->app->Pasta_painel}{$_REQUEST['Caminho_txf']}'><img src='{$this->app->Url_cliente}{$this->app->Pasta_painel}{$_REQUEST['Caminho_txf']}'></a><br>{$this->app->Url_cliente}{$this->app->Pasta_painel}{$_REQUEST['Caminho_txf']}";
            }




            //            $_REQUEST['Mensagem_txa'] = 'Desenvolvimento';
        }
        if (!isset($_REQUEST['Destinatario_txf'])) {
            $_REQUEST['Destinatario_txf'] = 'TODOS';
        }
        if (isset($_REQUEST['Extra_txa'])) {
            $_REQUEST['Extra_txa'] = serialize($_REQUEST['Extra_txa']);
        }
        if (isset($dados['tabela_emails_contato']))
            $this->tabela_emails_contato = $dados['tabela_emails_contato'];




        if ($_FILES['Arquivos_arq']['name']) {




            if (isset($_POST['pasta'])) {
                $pasta_painel = $_POST['pasta'];
            } else {
                $pasta_painel = $this->app->Pasta_painel;
            }



            $name = $_FILES['Arquivos_arq']['name']; //Atribui uma array com os nomes dos arquivos à variável
            $tmp_name = $_FILES['Arquivos_arq']['tmp_name']; //Atribui uma array com os nomes temporários dos arquivos à variável
            $extensoes = explode(',', $_REQUEST['Extensoes_txf']);


            if ($name) {

                $ext = pathinfo($name, PATHINFO_EXTENSION);

                if ($this->analisa_tipos($ext, $extensoes)) {
                    $new_name = $this->tabela_emails_contato . '_' . date("Y.m.d-H.i.s") . '.' . $ext;
                    $pasta = $this->db->database;
                    $dir = FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/';
                    $dir = str_replace('//', '/', $dir);
                    $arquivo = $dir . $new_name;

                    $caminho_relativo = 'arquivos/' . $pasta . '/' . $new_name;
                    $caminho_relativo = str_replace('//', '/', $caminho_relativo);


                    move_uploaded_file($tmp_name, $arquivo);
                    if (file_exists($arquivo)) {


                        $arquivo_inserir['Tabela_con'] = $this->tabela_emails_contato;
                        $arquivo_inserir['Descricao_txf'] = 'Arquivo de contato';
                        $arquivo_inserir['Caminho_txf'] = $caminho_relativo;
                        $arquivo_inserir['Tipo_txf'] = $ext;
                        $arquivo_inserir['Nome_txf'] = $name;
                        $arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($name));
                        $arquivo_inserir['Data_int'] = time();
                        $arquivo_inserir['Id_arquivo_con'] = '';
                        $this->smarty->assign('arquivo', $arquivo_inserir);

                        $inseriu = $this->model_banco->db_insert($this->tabela_emails_contato, $_REQUEST);
                        if ($inseriu) {
                            $ultimo = $this->model_banco->executa_sql("select * from $this->tabela_emails_contato order by Id_int desc limit 1");
                            $id = $ultimo[0]->Id_int;
                            $arquivo_inserir['Id_arquivo_con'] = $id;
                            $this->model_banco->db_insert('arquivos', $arquivo_inserir);
                        }
                    } else {



                        $inseriu = $this->model_banco->db_insert($this->tabela_emails_contato, $_REQUEST);
                        if ($inseriu) {
                            $ultimo = $this->model_banco->executa_sql("select * from $this->tabela_emails_contato order by Id_int desc limit 1");
                            $id = $ultimo[0]->Id_int;
                            $arquivo_inserir['Id_arquivo_con'] = $id;
                            $this->model_banco->db_insert('arquivos', $arquivo_inserir);
                        }
                    }
                } else {
                    die('tipo de arquivo inválido inválido');
                    return false;
                }
            } else {
                die('arquivo sem nome');
            }
        } else {



            $inseriu = $this->model_banco->db_insert($this->tabela_emails_contato, $_REQUEST);
        }



        if ($inseriu) {

            if ($retorno == 'boolean') {
                return true;
            } else {
                $resposta['mensagem'] = 'Contato inserido com sucesso!';
                $resposta['resposta'] = 'ok';
                $resposta['color'] = 'green';
                return (object) $resposta;
            }
        } else {
//        echo('nseriu acho'); die();
            if ($retorno == 'boolean') {
                return false;
            } else {
                $resposta['mensagem'] = 'Erro ao gravar email!';
                $resposta['resposta'] = 'erro';
                return (object) $resposta;
            }
        }
    }

    function analisa_tipos($ext, $tipos = null) {
        if (!$tipos) {
            $tipos = array("pdf", "txt", "doc", "docx", "ppt", "pptx");
        }

        if (in_array($ext, $tipos)) {

            return true;
        } else {
            return false;
        }
    }

    public function criar_tabela_contato($lands_id = null, $tabela_emails_contato = null) {
        if (!isset($lands_id)) {
            die('Lands ID nao foi passado como parametro na criacao da tabela contato');
        }
        $now = date('Y-m-d');
        $script[] = " SET NAMES utf8;";
        $script[] = "SET foreign_key_checks = 0;";
        $script[] = "SET time_zone = 'SYSTEM';";
        $script[] = "SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';";

        if (isset($tabela_emails_contato)) {
            $this->tabela_emails_contato = $tabela_emails_contato;
        }
        $script[] = "CREATE TABLE `$this->tabela_emails_contato` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Nome_txf` varchar(255) NOT NULL,
  `Produto_txf` varchar(255) NOT NULL,
  `Telefone_txf` varchar(255) NOT NULL,
  `Cidade_txf` varchar(255) NOT NULL,
  `Estado_sel` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Arquivos_arq` varchar(255) NOT NULL,
  `Destinatario_txf` varchar(255) NOT NULL,
  `Mensagem_txa` longtext CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Data_dat` date NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;";
        $script[] = "COMMIT;";
        $script[] = "INSERT INTO `$this->tabela_emails_contato` (`Id_int`, `Lands_id`, `Email_txf`,  `Mensagem_txa`, `Destinatario_txf`,`Data_dat`) VALUES
(1, '" . $lands_id . "', 'guvedana@gmail.com','Mensagem de teste', 'TODOS', '$now');
";
        print_r("..Criando tabela $this->tabela_emails_contato");
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

