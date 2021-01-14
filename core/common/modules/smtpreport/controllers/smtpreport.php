
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class smtpreport extends lands_core {

    public $usuario;
    public $caixas;

    public function __construct() {

        parent::__construct();
        ini_set('max_execution_time', '2000');
        ini_set('memory_limit', '512M');

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
    }

    function index() {
        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
            $funcao_atual = $this->pagina_atual;
//executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function switch_pagina() {


        $this->checa_login();
        $this->carrega_obrigatorios();

        switch ($this->pagina_atual) {

            case 'inicio' :

                break;
          
            case 'caixa':
                if ($this->uri->segment(2)) {
                    $id_caixa = $this->uri->segment(2);
                }
                $this->abre_caixa($id_caixa);

                $data_inicio = varia_data(-7, null, 'd/m/Y');
                $data_final = date('d/m/Y');
              

                $where = "";
                if ($_POST) {
                  

                    if ($_POST['periodo']) {

                        $periodo = $_POST['periodo'];

                        $data_inicio = $_POST['data_inicio'];
                        $data_final = $_POST['data_fim'];


                        switch ($periodo) {
                            case 'hoje':
                                $data_inicio = varia_data(0, null, 'd/m/Y');
                                $data_final = varia_data(0, null, 'd/m/Y');
                                break;
                            case 'ontem':
                                $data_inicio = varia_data(-1, null, 'd/m/Y');
                                $data_final = varia_data(0, null, 'd/m/Y');
                                break;
                            case 'ultima_semana':
                                $data_inicio = varia_data(-7, null, 'd/m/Y');
                                $data_final = date('d/m/Y');
                                break;
                            default:
                             

                                break;
                        }
                    } else {
                        
                        $data_inicio = $_POST['data_inicio'];
                        $data_final = $_POST['data_fim'];
                   
                        
                    }


                    $where = $this->cria_where($data_inicio, $data_final);
                } else {
                    $where = $this->cria_where($data_inicio, $data_final);
                }
                
                  $this->smarty->assign('data_inicial', $data_inicio);
                $this->smarty->assign('data_final', $data_final);
                $this->cria_dashboard($id_caixa, $where);

//                ver($where,1);
                $lista_bounces = $this->mbc->executa_sql("select * from bounces where Id_caixa={$id_caixa} $where");
                $this->smarty->assign("lista_bounces", $lista_bounces);
                
                  $lista_unicos = $this->mbc->executa_sql("select * from bounces where Id_caixa={$id_caixa} $where group by Destinatario_txf");
                  if($lista_unicos[0]){
                      $total_unicos=count($lista_unicos);
                  } else {
                      $total_unicos=0;
                  }
                $this->smarty->assign("lista_unicos", $lista_unicos);
                $this->smarty->assign("total_unicos", $total_unicos);

                $lista_enviados = $this->mbc->executa_sql("select * from enviados where Id_caixa={$id_caixa} $where");
                $this->smarty->assign("lista_enviados", $lista_enviados);


                if ($_POST) {

                    $this->model_smarty->render_ajax('resumo', $this->app->Template_txf);
                    die();
                }
                break;

            case 'cron':
                $this->processa_cron();
                break;

            default:
                break;
        }
    }

    function cria_where($data_inicial, $data_final) {
        $data_inicio = varia_data(0, date_create_from_format('d/m/Y', $data_inicial)->format('Y-m-d'), 'Y-m-d H:i:s');
        $data_fim = varia_data(+1, date_create_from_format('d/m/Y', $data_final)->format('Y-m-d'), 'Y-m-d H:i:s');
        $where.=" and Data_dat>='$data_inicio' and Data_dat<='$data_fim' ";
        return $where;
    }

    function cria_dashboard($id_caixa, $where = '') {



        $query = "select count(*) as total from enviados where Id_caixa={$id_caixa} $where";
        $enviados = $this->mbc->executa_sql($query);
        $this->smarty->assign("total_enviados", $enviados[0]->total);

        $bounces = $this->mbc->executa_sql("select count(*) as total from bounces where Id_caixa={$id_caixa} $where");
        $this->smarty->assign("total_bounces", $bounces[0]->total);

        $entregues = $enviados[0]->total - $bounces[0]->total;
        $this->smarty->assign("total_entregues", $entregues);
    }

    function abre_caixa($id_caixa = null) {
        if (!$id_caixa) {
            die('Acesso inválido');
        }
        $where = "where Ativo_sel='SIM' ";
        $where.= " and Id_int='$id_caixa'";


        $caixa_atual = $this->mbc->executa_sql("select * from caixas $where");
//                ver($caixa_atual); 
        if ($caixa_atual[0]) {
            $this->verifica_seguranca_caixa($caixa_atual[0]);
            $this->smarty->assign("caixa_atual", $caixa_atual[0]);
        } else {
            die('Caixa não encontrada');
        }
    }

    function verifica_seguranca_caixa($caixa_atual) {
        if ($caixa_atual->Id_objeto_con != $this->usuario->Id_int) {
            die("Esta caixa nao pertence a seu usuario");
        }
    }

    function carrega_obrigatorios() {

        $this->usuario = $this->session->userdata['usuario'];
        $this->caixas = $this->mbc->executa_sql("select * from caixas where Id_objeto_con={$this->usuario->Id_int}");
        $this->smarty->assign("caixas", $this->caixas);
    }

    function cron() {

        $this->load->library('mail_reader');
        $where = '';
        if ($this->uri->segment(2)) {
            $id_caixa = $this->uri->segment(2);
            $where.=" and Id_int=$id_caixa";
        }

        $caixas = $this->mbc->executa_sql("select * from caixas where Ativo_sel='SIM' $where");
//        ver($caixas);

        foreach ($caixas as $caixa) {
//            $this->mail_reader->processa_conta($caixa, 'INBOX');
//  $this->mail_reader->teste($caixa, 'INBOX');
//            ver('chegou');
            $this->processa_bounces($caixa, 'INBOX');
//            $this->processa_enviados($caixa, 'SENT');
//            $this->processa_enviados($caixa, 'Itens Enviados');
        }
    }

    function retorna_log($caixa) {


        $ultimo_objeto = $this->mbc->executa_sql("select * from log_pesquisa where Id_caixa={$caixa->Id_int} limit 1");
        if ($ultimo_objeto[0]) {
            return $ultimo_objeto[0];
        } else {
            return null;
        }
    }

    function insere_atualiza_ultimo($caixa, $data_atualizada = null, $campo = 'Ultima_data_inbox') {
        if (!$data_atualizada) {
            $data_atualizada = date('Y-m-d H:i:s');
        }


        $array[$campo] = $data_atualizada;
        $array['Id_caixa'] = $caixa->Id_int;

        $ultimo = $this->retorna_log($caixa);
        if ($ultimo) {
            echo "Ultima atualização atualizada para $data_atualizada<br>";
            $this->mbc->updateTable("log_pesquisa", $array, 'Id_caixa', $caixa->Id_int);
        } else {
            echo "Ultima atualização inserida para $data_atualizada<br>";
            $this->mbc->db_insert("log_pesquisa", $array);
        }
    }

    function processa_bounces($caixa, $pasta) {
        $ultimo = $this->retorna_log($caixa);

        echo "processando {$pasta}<br>";
        $emails_recebidos = $this->mail_reader->processa_caixa($caixa, $pasta, $ultimo->Ultima_data_inbox);



        sorteia_array_objetos($emails_recebidos, array('Data_dat' => SORT_DESC));
//        ver($emails_recebidos[0],1);



        $data_atualizada = null;
        foreach ($emails_recebidos as $email) {
            $data_atualizada = $email->Data_dat;
            break;
        }
        $cont = 0;
        if ($emails_recebidos[0]) {
            foreach ($emails_recebidos as $recebido) {
                if ($recebido->Tipo_txf == 'bounce') {
                    $recebido->Id_caixa = $caixa->Id_int;
                    $objeto_recebido = object_to_array($recebido);
                    $this->mbc->db_insert('bounces', $objeto_recebido);
                    $cont = $cont + 1;
                }
            }
            $this->insere_atualiza_ultimo($caixa, $data_atualizada, 'Ultima_data_inbox');
        } else {
            $this->insere_atualiza_ultimo($caixa, $data_atualizada, 'Ultima_data_inbox');
        }
        echo "{$cont} Bounces gravados<br>";
    }

    function processa_enviados($caixa, $pasta) {
        $ultimo = $this->retorna_log($caixa);
        echo "<br><br>processando {$pasta}<br>";
        $emails_enviados = $this->mail_reader->processa_caixa($caixa, $pasta, $ultimo->Ultima_data_sent);
        $cont2 = 0;
//        ver($emails_enviados);
        sorteia_array_objetos($emails_enviados, array('Data_dat' => SORT_DESC));
        $data_atualizada = null;
        foreach ($emails_enviados as $email) {
            $data_atualizada = $email->Data_dat;
            break;
        }
        if ($emails_enviados[0]) {
            foreach ($emails_enviados as $enviado) {
                if ($enviado->Data_dat > $data_atualizada) {
                    $enviado->Id_caixa = $caixa->Id_int;
                    $objeto_enviado = object_to_array($enviado);
                    $this->mbc->db_insert('enviados', $objeto_enviado);
                    $cont2 = $cont2 + 1;
                }
            }
            $this->insere_atualiza_ultimo($caixa, $data_atualizada, 'Ultima_data_sent');
        } else {
            $this->insere_atualiza_ultimo($caixa, $data_atualizada, 'Ultima_data_sent');
        }
        echo "{$cont2} Enviados gravados<br>";
    }

}

?>