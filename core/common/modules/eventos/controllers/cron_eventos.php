<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_eventos.php');

class cron_eventos extends lands_eventos {

    public function __construct() {
        parent::__construct();
        $this->load->helper('landspay');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'cron');
        
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

    function executa_cron_avisos() {
        $eventos = $this->mbc->executa_sql("select * from eventos where Tipo_inscricao_sel='PAGAS'");

        if ($eventos) {
            foreach ($eventos as $evento) {

                $hoje = date('Y-m-d');
                $where = " where  Status_sel!='FINALIZADO' and Status_sel!='CANCELADO' and Evento_txf='{$evento->Url_amigavel_txf}' order by Data_dat";
                $inscricoes = $this->mbc->buscar_tudo('inscricoes', $where);

                foreach ($inscricoes as $inscricao) {
                    echo "processando inscricao $inscricao->Email_txf <br>";
                    $id = FALSE;
                    $data_inscricao = $inscricao->Data_dat;

                    if ($inscricao->Pago_sel == 'SIM') {
                        $array['Status_sel'] = 'FINALIZADO';
                        $array['Data_atualizacao_dat'] = date('Y-m-d H:i:s');

                        $this->mbc->updateTable('inscricoes', $array, 'Id_int', $inscricao->Id_int);
                        //$this->agenda_envio($inscricao,'inscricoes','confirma_pagamento');
                    } else {

                        if ($inscricao->Data_atualizacao_dat == '0000-00-00 00:00:00') {
                            $inscricao->Data_atualizacao_dat = $inscricao->Data_dat;
                            $array2['Data_atualizacao_dat'] = $inscricao->Data_dat;
                        }
                        $objprazo = data_diferenca($hoje, $data_inscricao);
                        $prazo = $objprazo->day;

                        //  echo "id= {$inscricao->Id_int}  ---  Já se passaram $prazo desde a inscrição do dia  {$data_inscricao} ate {$hoje}!<br>";

                        if ($inscricao->Status_sel != 'FINALIZADO' && $inscricao->Status_sel != 'CANCELADO') {
                            if ($prazo == 0) {
                                $status = 'AGUARDANDO';
                                $array2['Status_sel'] = $status;
                                $inscricao->Status_novo_sel = $status;
                                $array2['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
                                $retorno = $this->agenda_envio($inscricao, 'enviar_pagamento');
                                $this->conecta_mbc($this->app->Conexoes_for);
                                $this->mbc->updateTable('inscricoes', $array2, 'Id_int', $inscricao->Id_int);
                            }


                            if ($prazo == 1) {
                                $status = 'AGUARDANDO 24H';
                                $array2['Status_sel'] = $status;
                                $inscricao->Status_novo_sel = $status;
                                $array2['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
                                $retorno = $this->agenda_envio($inscricao, 'enviar_pagamento');
                                $this->conecta_mbc($this->app->Conexoes_for);
                                $this->mbc->updateTable('inscricoes', $array2, 'Id_int', $inscricao->Id_int);
                            }

                            if ($prazo == 2) {
                                $status = 'AGUARDANDO 48H';
                                $array2['Status_sel'] = $status;
                                $inscricao->Status_novo_sel = $status;
                                $array2['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
                                echo "inscricao $inscricao->Email_txf atualizada para $inscricao->Status_novo_sel<br>";
                                $retorno = $this->agenda_envio($inscricao, 'enviar_pagamento');
                                $this->conecta_mbc($this->app->Conexoes_for);
                                $this->mbc->updateTable('inscricoes', $array2, 'Id_int', $inscricao->Id_int);
                            }
                            if ($prazo > 2) {
                                $status = 'CANCELADO';
                                $array2['Status_sel'] = $status;
                                $inscricao->Status_novo_sel = $status;
                                $array2['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
                                echo "inscricao $inscricao->Email_txf atualizada para $inscricao->Status_novo_sel<br>";
                                $retorno = $this->agenda_envio($inscricao, 'enviar_pagamento');
                                $this->conecta_mbc($this->app->Conexoes_for);
                                $this->mbc->updateTable('inscricoes', $array2, 'Id_int', $inscricao->Id_int);
                                //$this->mbc->db_delete('inscricoes', 'Id_int', $inscricao->Id_int);
                            }
//                    if ($prazo > 7) {
//                        $status = 'CANCELADO';
//                        $array2['Status_sel'] = $status;
//                        $inscricao->Status_novo_sel = $status;
//                        $array2['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
//                        echo "inscricao $inscricao->Email_txf atualizada para $inscricao->Status_novo_sel<br>";
//                        $this->conecta_mbc($this->app->Conexoes_for);
//                        $this->mbc->db_delete('inscricoes', 'Id_int', $inscricao->Id_int);
//                        //        $retorno=   $this->agenda_envio($inscricao, 'enviar_pagamento');
//                    }
                        } else {
                            echo "inscricao $inscricao->Email_txf ja estava para $inscricao->Status_sel<br>";
                        }
                    }
                }
            }
        } else {
            die('nenhum evento a ser sincronizado');
        }
        die('cron encerrado');
    }

    function switch_pagina() {


        switch ($this->pagina_atual) {
            case 'cron_avisos' :
                $this->executa_cron_avisos();
                break;

            case 'cron_novo':
                $inscricoes = $this->mbc->executa_sql("select i.*, e.id_sistema from inscricoes i left outer join eventos e on e.Url_amigavel_txf=i.Evento_txf where e.Cron_ativo_sel='SIM' and i.Origem_pagto_txf='online' ");
                echo count($inscricoes) . " inscricoes realizadas<br>";
              
                if (is_array($inscricoes)) {
                    foreach ($inscricoes as $inscricao) {
                        $status = $inscricao->Pago_sel;
                        echo "analizando a inscricao {$inscricao->Id_int} ";

//                    $pagamentos = $this->mbc->executa_sql("select * from lands_pay.pagamentos where referencia=$inscricao->Id_int and id_sistema='$inscricao->id_sistema'");
//
//
//                    if ($pagamentos[0]) {
//                        if($inscricao->Email_txf=='vet.saccomani@gmail.com'){
//                            ver($pagamentos);
//                        }
//                        $inscricao->Pago_sel = 'NAO';
//                        foreach ($pagamentos as $pagamento) {
//                            if ($pagamento->status == 'pago') {
//                                $inscricao->Pago_sel = 'SIM';
//                            }
//                        }
//
//                        $update['Pago_sel'] = $inscricao->Pago_sel;
//                        echo "- status de pagamento = $inscricao->Pago_sel - {$inscricao->Email_txf}<br>";
//                        $this->mbc->updateTable("inscricoes", $update, 'Id_int', $inscricao->Id_int);
//                    } else {
//procura inscricao diferente

                  

                        $pagamentos = $this->mbc->executa_sql("select * from lands_pay.pagamentos where email='$inscricao->Email_txf' and id_sistema='$inscricao->id_sistema'");
                        if ($pagamentos) {
                            $inscricao->Pago_sel = 'NAO';
                            foreach ($pagamentos as $pagamento) {
                                if ($pagamento->status == 'pago') {
                                    $inscricao->Pago_sel = 'SIM';
                                }
                            }
                            if ($inscricao->Pago_sel != $status) {
                                $update['Pago_sel'] = $inscricao->Pago_sel;
                                echo "- status de pagamento = $inscricao->Pago_sel - {$inscricao->Email_txf}<br>";
                                $this->mbc->updateTable("inscricoes", $update, 'Id_int', $inscricao->Id_int);
                            } else {
                                echo "- não alterado Pago= $inscricao->Pago_sel - {$inscricao->Email_txf}<br>";
                            }
                        } else {
                            echo "- <b>nao possuiu pagamento</b> - {$inscricao->Email_txf}<br>";
                            //    $pagamentos = $this->mbc->executa_sql("select * from lands_pay.pagamentos where email='$inscricao->Email_txf'");
                        }
//                    }
                    }
                } else {
                    echo "nenhuma inscrição a ser sincronizada";
                    die();
                }
                break;

            case 'cron_landspay':
                $inscricoes = $this->mbc->executa_sql("select i.*, e.id_sistema from inscricoes i left outer join eventos e on e.Url_amigavel_txf=i.Evento_txf where e.Cron_ativo_sel='SIM' and i.Origem_pagto_txf='online'");

                echo count($inscricoes) . " inscricoes realizadas<br>";
                
                if(is_array($inscricoes)){
                    
                foreach ($inscricoes as $inscricao) {
                    $status = $inscricao->Pago_sel;
                    echo "analizando a inscricao {$inscricao->Id_int} ";
                    $sql = "select * from lands_payv2.recebimentos where referencia=$inscricao->Id_int and id_sistema='$inscricao->id_sistema'";
                    $pagamentos = $this->mbc->executa_sql($sql);
//                    if ($inscricao->Id_int == 2397) {
//                        ver($pagamentos, 1);
//                        ver($sql);
//                    }

                    if ($pagamentos[0]) {

                        $inscricao->Pago_sel = 'NAO';
                        foreach ($pagamentos as $pagamento) {
                            if ($pagamento->status == 'pago') {
                                $inscricao->Pago_sel = 'SIM';
                            }
                        }

                        $update['Pago_sel'] = $inscricao->Pago_sel;
                        echo "- status de pagamento = $inscricao->Pago_sel - {$inscricao->Email_txf}<br>";
                        $this->mbc->updateTable("inscricoes", $update, 'Id_int', $inscricao->Id_int);
                    } else {
                        echo "- <b>nao possuiu pagamento</b> - {$inscricao->Email_txf}<br>";
                        //    $pagamentos = $this->mbc->executa_sql("select * from lands_pay.pagamentos where email='$inscricao->Email_txf'");
                    }
//                    }
                }
                } else {
                    die('nenhuma inscrição a ser sincronizada');
                }

                die();

                break;
            case 'cron_pagto':

                die('cron desativado');

                $inscricoes = $this->mbc->executa_sql("select i.*, e.id_sistema from inscricoes i left outer join eventos e on e.Url_amigavel_txf=i.Evento_txf where e.Cron_ativo_sel='SIM' ");

                $cont = 0;
                $cont = 0;
                foreach ($inscricoes as $inscricao) {

                    echo "({$inscricao->Evento_txf})  consultando pagamendo da inscricao {$inscricao->Id_int}, de {$inscricao->Email_txf}, que o estado atual é {$inscricao->Status_sel}<br>";


//                    if ($inscricao->Email_txf == 'sicrestoni@gmail.com') {

                    $consulta_pagto = consulta_pagamento($inscricao->id_sistema, $inscricao->Id_int);

//                    }


                    if ($consulta_pagto[0]) {

                        $minha_inscricao = new stdClass();
                        $minha_inscricao->Id_int = $inscricao->Id_int;
                        $minha_inscricao->id_sistema = $inscricao->id_sistema;
                        $minha_inscricao->Email_txf = $inscricao->Email_txf;
                        $minha_inscricao->Valor_txf = $inscricao->Valor_txf;
                        $minha_inscricao->Pago_sel = $inscricao->Pago_sel;


                        $meu_pagto = new stdClass();
                        $meu_pagto->Id_int = $consulta_pagto[0]->Id_int;
                        $meu_pagto->id_sistema = $consulta_pagto[0]->id_sistema;
                        $meu_pagto->email = $consulta_pagto[0]->email;
                        $meu_pagto->valor = $consulta_pagto[0]->valor;
                        $meu_pagto->status = $consulta_pagto[0]->status;


                        if ($meu_pagto->status == 'pago') {

                            if ($minha_inscricao->Pago_sel != 'SIM') {
                                $cont = $cont + 1;
                            }
                            $minha_inscricao->Pago_sel = 'SIM';
                        } else {
                            if ($minha_inscricao->Pago_sel != 'NAO') {
                                $cont = $cont + 1;
                            }
                            $minha_inscricao->Pago_sel = 'NAO';
                        }
                        $id = $minha_inscricao->Id_int;
                        $this->mbc->updateTable('inscricoes', object_to_array($minha_inscricao), 'Id_int', $id);
                    }
                }
                echo "<br>$cont pagamentos modificados";
                die();
                break;
        }
    }

//                    if ($consulta_pagto[0]) {
//                        if ($this->atualiza_inscricao($consulta_pagto[0], $inscricao, FALSE)) {
//                            $cont = $cont + 1;
//                        }
//                        if (is_lands()) {
//                        } else {
//
//                            if ($inscricao->Pago_sel == 'SIM') {
//                                $status = 'pago';
//                            } else {
//                                $status = 'aguardando';
//                            }
//                            if ($status != $consulta_pagto[0]->status) {
//                                if ($consulta_pagto[0]->status == 'pago') {
//                                    $status2 = 'SIM';
//                                }
//                                if ($consulta_pagto[0]->status == 'aguardando') {
//                                    $status2 = 'NAO';
//                                }
//                                $cont = $cont + 1;
//
//                                
//                                $this->atualiza_pagamento_inscricao($inscricao->Id_int, $status2);
//                            }
//                        }
//                    }
//                    }





    function atualiza_inscricao($pagamento, $inscricao, $force = FALSE) {

//        ver('chegou');

        if ($inscricao->Pago_sel == 'SIM') {
            $status = 'pago';
        } else {
            $status = 'aguardando';
        }

//        ver($pagamento);
//        ver($status);

        if (($status != $pagamento->status ) || ($force == TRUE)) {
            if ($pagamento->status == 'pago') {
                $status2 = 'SIM';
                $array['Pago_sel'] = 'SIM';
            }
            if ($pagamento->status == 'aguardando') {
                $status2 = 'NAO';
                $array['Pago_sel'] = 'NAO';
            }


            switch ($pagamento->meio_escolhido) {
                case 'boleto_cef':
                    $array['Destino_pagto_txf'] = 'lands';
                    $array['Tipo_pagto_txf'] = 'boleto';

                    break;
                case 'moip':
                    $array['Destino_pagto_txf'] = 'moip';
                    $array['Tipo_pagto_txf'] = 'moip';

                    break;
                case 'boleto_acil':
                    $array['Destino_pagto_txf'] = 'acil';
                    $array['Tipo_pagto_txf'] = 'boleto';
                    break;
                case 'cielo':
                    $array['Destino_pagto_txf'] = 'lands';
                    $array['Tipo_pagto_txf'] = 'cartao';
                    break;

                case 'dinheiro_acil':
                    $array['Destino_pagto_txf'] = 'acil';
                    $array['Tipo_pagto_txf'] = 'boleto';
                    break;

                case 'gratis':
                    $array['Destino_pagto_txf'] = 'gratis';
                    $array['Tipo_pagto_txf'] = 'gratis';
                    break;
                default:
// ver($pagamento);
                    break;
            }

            echo "vai atualizar {$pagamento->referencia} <br>";

            $this->mbc->updateTable('inscricoes', $array, 'Id_int', $pagamento->referencia);
            return true;
        } else {
            return false;
        }
    }

    function atualiza_pagamento_inscricao($id_inscricao, $status) {

        $array = array();
        $array['Pago_sel'] = $status;


        $this->mbc->updateTable('inscricoes', $array, 'Id_int', $id_inscricao);
    }

}

