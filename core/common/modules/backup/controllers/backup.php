<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Description of adminer
 *
 * @author guvedana
 */
class backup extends lands_core {

    public $Lands_id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('date');
    }

    function index() {

        switch ($this->uri->segment($this->app->Segmento_padrao_txf)) {
            case 'limpa_logs';
                ver('limpa logs');
                break;
            default:
                $this->inicializa();
                break;
        }
    }

    function inicializa() {

        $sql = "select a.*,a.Id_int as Id_app, c.* from apps a left outer join conexoes c on c.Id_int=a.Conexoes_for where a.Ativo_sel='SIM' and c.Faz_backup_sel='SIM'";



        if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {

            $app = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
            $sql.= " and a.Lands_id ='" . $app . "'";
        }
        $sql.=" order by a.Lands_id";

        $aplicativos = $this->model_banco->executa_sql($sql);

        //    ver($aplicativos);


        if (isset($aplicativos[0]->Id_int)) {
            foreach ($aplicativos as $aplicativo) {
                $this->Lands_id = $aplicativo->Lands_id;
                $this->fazer_backup($aplicativo);
            }
        } else {
            die('Database invalida');
        }

        die('PROCESSO TERMINADO');
    }

    function fazer_backup($aplicativo = null) {

        if (!isset($aplicativo)) {
            die('Funcao fazer_backup necessita do parametro $aplicativo');
        }
        $id_conexao = $aplicativo->Conexoes_for;
        
        $conexao=$this->model_banco->executa_sql("select * from conexoes where Id_int=$id_conexao");
        
        echo "Fazendo backup de {$conexao[0]->Nome_conexao_txf} ( base: {$conexao[0]->Database_txf} ) <br>";
        try {
            $this->conecta_mbc($id_conexao);

            $arquivo = $aplicativo->Lands_id . '_';
            $arquivo .= formata_data(now(), 'BACKUP') . '.txt';

//            $arquivo .= formata_data(now()) . '.txt';
//            $arquivo = str_replace('/', '_', $arquivo);


            $prefs = array(
                'tables' => array(),
                'ignore' => array('view_professore', 'adm_produtos', 'backups'),
                'filename' => $arquivo,
                'format' => 'txt', // gzip, zip, txt

                'add_drop' => TRUE,
                'add_insert' => TRUE,
                'newline' => "\n"
            );

            $this->load->dbutil();


            try {
                $backup = & $this->dbutil->backup($prefs);


                if (write_file(FCPATH . 'backups/' . $arquivo, $backup)) {


                    $dados['Caminho_txf'] = $arquivo;
                    $dados['Data_dat'] = now();
                    $dados['Lands_id'] = $this->Lands_id;
                    echo $arquivo . " foi criado. em " . FCPATH . "backups<br>";
                    $this->load->database('default', null, TRUE);
                    if ($this->model_banco->db_insert('backups', $dados)) {


                        $backups = $this->model_banco->executa_sql("select *  from backups where Lands_id='" . $this->Lands_id . "' order by Id_int");


                        if (count($backups) > 10) {


                            $arq = (FCPATH . 'backups/' . $backups[0]->Caminho_txf);

                            if (file_exists($arq)) {
                                if (unlink($arq)) {
                                    $this->model_banco->deleteRow('backups', 'Id_int', $backups[0]->Id_int);

                                    echo $backups[0]->Caminho_txf . " deletado de " . FCPATH . "backups<br>";
                                } else {
                                    echo('nao deletou' . $arq);
                                }
                            } else {
                                echo('Arquivo inexistente  ' . $arq . '<br>');
                            }
                        }
                    }
                } else {
                    ver('nao chegouchegou');
                    $i = 1;
                }
            } catch (Exception $e) {
                print_r($e);
            }
        } catch (Exception $e) {
            print_r($e);
        }
        echo "***************<br>";
    }

}

