<?php

class Model_mailer extends CI_Model {

    function __construct() {
        parent::__construct();
        $templates = COMMONPATH . '../templates/';
        $this->smarty->assign('TEMPLATES', $templates);
        $this->load->library('email');
    }

    function inicializa($app, $cliente = null) {

        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function agenda_envio($tipo, $dados, $retorna = FALSE) {
        if (!is_object($dados)) {
            $dados = array_to_object($dados);
        }
        $agenda = array();


        $agenda['Tipo_sel'] = $tipo;

        $agenda['Status_sel'] = 'aguardando';
        $agenda['Sender_txf'] = 'contato@eventtools.com.br';

        $agenda['Data_dat'] = date('Y-m-d H:i:s');

        $agenda['Destinatario_txf'] = $dados->Email_txf;


        $agenda['Objeto_jso'] = json_encode($dados);




        if (!$dados->Email_txf) {
            return FALSE;
//            die('Email nao passado por parametro');
        } else {

            $ultimo = $this->mbc->db_insert('mailer', $agenda, TRUE);

            if ($ultimo) {
                if ($retorna) {
                    return $ultimo->Id_int;
                } else {
                    $enviou = $this->model_mailer->processa_envio($ultimo->Id_int, $dados);
                    if ($enviou) {
                        return TRUE;
                    } else {
                        $this->mensagem->envia_alerta("Erro ao enviar email", "error", "Atenção");
                        die();
                    }
                }
            } else {
                return FALSE;
            }
        }
    }

    function processa_envio($id = null, $dados = null) {
        if ($id) {
            $where = " and Id_int={$id}";
        } else {
            $where = " and Status_sel!='enviado'";
        }

        $lista = $this->mbc->executa_sql("select *  from mailer where Id_int is not null $where");

        foreach ($lista as $email) {
            if ($id) {
                $this->dispara_email($email, $dados);
                return true;
            } else {
                return $this->dispara_email($email, $dados);
            }
        }
    }

    function dispara_email($mail, $dados) {

        $id = $mail->Id_int;

        if ($mail->Registro_txf && $mail->Tabela_txf) {
            $registro = $this->mbc->executa_sql("select * from {$mail->Tabela_txf} where Id_int={$mail->Registro_txf}");
            $this->smarty->assign('registro', $registro);
        }

        $email['Email_txf'] = 'contato@eventtools.com.br';
        $email['Nome_txf'] = 'Eventtools - Plataforma de Eventos';
        $email['Sender_txf'] = $mail->Sender_txf;
        $email['Destinatario_txf'] = $mail->Destinatario_txf;

        switch ($mail->Tipo_sel) {



            case 'enviar_pagamento':
                $email['Assunto_txf'] = 'Pague agora - ' . $this->app->Nome_app_txf;

                $objeto = json_decode($mail->Objeto_jso);
                $inscricoes[0] = $objeto;
                $this->smarty->assign('inscricoes', $inscricoes);

                $usuario_inscricao = $this->mbc->executa_sql("select * from usuarios where Email_txf='{$objeto->Email_txf}'");
                $this->smarty->assign('usuario_inscricao', $usuario_inscricao);

                $eventos = $this->mbc->executa_sql("select * from eventos where Url_amigavel_txf='{$objeto->Evento_txf}'");
                $this->smarty->assign('eventos', $eventos);

                $tpl = 'enviar_pagamento';

                $texto = '';
                switch ($objeto->Status_novo_sel) {
                    case 'FINALIZADO':
                        $texto = "Sua inscrição foi realizada com sucesso no evento '{$eventos[0]->Nome_txf}'!<br> Clique no link para acessar a plataforma!";

                        $link = "{$this->app->Url_cliente}fazer_login?auto=true&Email_txf={$objeto->Email_txf}&redirect_link=inscricao/{$objeto->Id_int}";

                        $this->smarty->assign('link', $link);
                        break;
                    case 'CANCELADO':
                        $texto = "Sua inscrição no evento '{$eventos[0]->Nome_txf}' foi cancelada por passar do prazo máximo permitido pela plataforma! <br>Clique no link para realizar novamente sua inscrição e garantir sua vaga.";
                        $link = "{$this->app->Url_cliente}fazer_login?auto=true&Email_txf={$objeto->Email_txf}&redirect_link=inscricao/{$objeto->Id_int}";

                        $this->smarty->assign('link', $link);
                        break;
                    case 'AGUARDANDO 24H':
                        $texto = "Percebemos que você ainda não finalizou sua inscrição para o evento  '{$eventos[0]->Nome_txf}'!<br> Após realizar o cadastro, você possui um prazo de até 48 horas para confirmar sua inscrição e realizar o pagamento, após esse prazo sua inscrição é cancelada. <br> Não perca essa grande oportunidade e garanta agora sua vaga!!!<br>Para realizar o pagamento, basta clicar no link abaixo!";

                        $link = "{$this->app->Url_cliente}fazer_login?auto=true&Email_txf={$objeto->Email_txf}&redirect_link=inscricao/{$objeto->Id_int}/pagar";

                        $this->smarty->assign('link', $link);
                        break;
                    case 'AGUARDANDO 48H':
                        $texto = "Hoje é o ultimo dia para confirmar sua inscrição e realizar o pagamento para o evento '{$eventos[0]->Nome_txf}'. <br>Aproveite agora e confirme sua presença em nosso encontro. <br>Em 24 horas sua inscrição será cancelada!";

                        $link = "{$this->app->Url_cliente}fazer_login?auto=true&Email_txf={$objeto->Email_txf}&redirect_link=inscricao/{$objeto->Id_int}/pagar";

                        $this->smarty->assign('link', $link);
                        break;
                    case 'AGUARDANDO':
                        $texto = "Obrigado por se inscrever no evento '{$eventos[0]->Nome_txf}'!<br> Para efetuar o pagamento, basta clicar no link abaixo!";
                        $link = "{$this->app->Url_cliente}fazer_login?auto=true&Email_txf={$objeto->Email_txf}&redirect_link=inscricao/{$objeto->Id_int}/pagar";

                        $this->smarty->assign('link', $link);
                        break;
                }
                $this->smarty->assign('texto', $texto);

                break;

            default:
                echo ('Tipo de disparo nao programado');
                break;
        }




        $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$tpl}.tpl";
        $mensagem = $this->smarty->fetch($caminho);
        print_r($mensagem);
//$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
        $email['Mensagem_txa'] = $mensagem;

        $status = $mail->Status_sel;
//ver($mensagem);
$enviou=true; 
//        $enviou = $this->envia_email($email, TRUE);

        if ($enviou) {
            echo "retornou TRUE<br>";
            $status = 'enviado';
            $atualizacao['Status_sel'] = $status;
            $atualizacao['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            $this->mbc->updateTable('mailer', $atualizacao, 'Id_int', $id);
            return TRUE;
        } else {

            $status = 'erro';
            $atualizacao['Erro_txa'] = $this->email->print_debugger();
            $atualizacao['Status_sel'] = $status;
            $atualizacao['Data_atualizacao_dat'] = date('Y-m-d H:i:s');
            $this->mbc->updateTable('mailer', $atualizacao, 'Id_int', $id);
            echo "retornou false<br>";
            return FALSE;
        }
    }

    function envia_email($email, $copia_cliente = TRUE) {


        if ($this->cliente) {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $this->cliente->Smtp_host_txf,
                'smtp_port' => $this->cliente->Smtp_porta_txf,
                'smtp_user' => $this->cliente->Smtp_usuario_txf,
                'smtp_pass' => $this->cliente->Smtp_senha_txf
            );


//            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";


            $this->email->initialize($config);
        }


        $this->email->from($this->cliente->Smtp_usuario_txf, $email['Nome_txf']);
        $this->email->reply_to($email['Email_txf']);
        $this->email->_replyto_flag = TRUE;
        $this->email->to($email['Destinatario_txf']);

        $copias = $this->app->Copia_emails_txf;

        if ($copia_cliente) {
            $copias.=',' . $email['Email_txf'];
        }

        $this->email->bcc($copias);
        $this->email->set_mailtype('html');
        $this->email->subject($email['Assunto_txf']);
        $this->email->message($email['Mensagem_txa']);

//        return TRUE;
//        if ($email['Destinatario_txf'] == 'leonardo.borges@landsagenciaweb.com.br') {

        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
//        } else {
//            echo "pulou envio para {$email['Destinatario_txf']}<br>";
//            return FALSE;
//        }
    }

}