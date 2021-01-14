<?php

/**
 * Classe para leitura de emails via imap
 *
 * @version 0.1
 * @link https://github.com/bruno-barros/PagSeguro-Codeigniter
 * @author Bruno Barros <brunodanca/gmail.com>
 * 
 * 
 */
require_once(COMMONPATH . 'third_party/smtpreport/vendor/autoload.php');

class mail_reader {

    public function __construct() {
        $this->ci = &get_instance();
    }

    public function processa_caixa($caixa, $pasta = '', $ultima_data = null) {
        if (!$caixa->Host_txf) {
            die('parametro $caixa->Host_txf obrigatorio');
        }
        if (!$caixa->Email_txf) {
            die('parametro $caixa->Email_txf obrigatorio');
        }
        if (!$caixa->Senha_txf) {
            die('parametro $caixa->Senha_txf obrigatorio');
        }
        if (!$pasta) {
            die('parametro $pasta obrigatorio');
        }

        $cwsDebug = new Cws\CwsDebug();
        // $cwsDebug->setDebugVerbose();
        // $cwsDebug->setEchoMode();

        $cwsMbh = new Cws\MailBounceHandler\Handler($cwsDebug);

// process mode
        $cwsMbh->setNeutralProcessMode(); // default
        //     $cwsMbh->setMoveProcessMode();
//$cwsMbh->setDeleteProcessMode();


        $cwsMbh->setImapMailboxService(); // default
        $cwsMbh->setMailboxHost($caixa->Host_txf); // default 'localhost'
        $cwsMbh->setMailboxPort(143); // default const MAILBOX_PORT_IMAP
//$cwsMbh->setMailboxUsername('noreply@nfelafi.com.br');
//$cwsMbh->setMailboxPassword('a9x35fx0');
        $cwsMbh->setMailboxUsername($caixa->Email_txf);
        $cwsMbh->setMailboxPassword($caixa->Senha_txf);

        $cwsMbh->setMailboxName($pasta); // default 'INBOX'
        if ($cwsMbh->openImapRemote() === false) {
            $error = $cwsMbh->getError();
            return;
        }

// process mails!
        $result = $cwsMbh->processMails($ultima_data);
//        ver($result);
        $emails = $result->getMails();
//ver($emails);

        $emails_db = array();
        $cont = 0;
        foreach ($emails as $email) {
            $email_lido = $this->trata_email($email, $pasta);
            if ($email_lido->Data_dat > $ultima_data) {
                $cont = $cont + 1;
                $emails_db[] = $email_lido;
            }
        }
        echo "$cont emails novos processados<br>";

        if (!$result instanceof \Cws\MailBounceHandler\Models\Result) {
            $error = $cwsMbh->getError();
        }

        return $emails_db;
    }

    function retorna_data_email($header) {

        return date('Y-m-d H:i:s', strtotime($header->Date));
    }

    function retorna_destinatario_email($header) {
        $resultado = array();

        if (preg_match('/To:(?P<text>.+)\r\n/', $header, $resultado)) {
            if (preg_match_all('/(?P<to>([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])' .
                            '(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+)/', $resultado['text'], $reciever)) {
                if (isset($reciever['to'])) {
                    return implode(',', $reciever['to']);
                } else {
                    return 'sem destinatario';
                }
            }
        }
    }

    function retorna_assunto_email($header) {
        $subject = array();
        if (preg_match('/Subject:(?P<subject>.+)\r\n/', $header, $subject)) {
            if ($subject['subject']) {
                return ($subject['subject']);
            } else {
                return 'assunto nao identificado';
            }
        }
    }

    function parse_header($textoheader) {

        $cwsMbh = new Cws\MailBounceHandler\Handler();
//    ver($header,1);    
        $novo_header = $cwsMbh->parseHeader($textoheader);
        return array_to_object($novo_header);
    }

    function trata_email($email, $pasta = null) {

        $email_lido = new stdClass();
        $header = $email->getHeader();
        $header_parseado = $this->parse_header($header);
//        ver($header_parseado, 1); 
        $recipients = $email->getRecipients();


        $email_lido->Data_dat = $this->retorna_data_email($header_parseado);
        $email_lido->Destinatario_txf = $this->retorna_destinatario_email($header);
        $email_lido->Assunto_txf = $email->getSubject();
//        $email_lido->Assunto_txf=$this->retorna_assunto_email($header);
//        $email_lido->Assunto_txf = $email->getSubject();
        if ($pasta != 'SENT') {
            if ($recipients[0]) {

                $email_lido->Tipo_txf = 'bounce';
                $email_lido->Acao_txf = $recipients[0]->getAction();
                $email_lido->Status_txf = $recipients[0]->getStatus();
                $email_lido->Status_texto_txf = $this->trata_codigo($recipients[0]->getStatus());
                $email_lido->Destinatario_txf = $recipients[0]->getEmail();
                $email_lido->Tipo_bounce_txf = $recipients[0]->getBounceType();
                $email_lido->Categoria_bounce_txf = $recipients[0]->getBounceCat();
                $assunto = $recipients[0]->getSubject();
                $assunto = str_replace("=?ISO-8859-1?Q?Comunica=E7=E3o?=", "Comunicação", $assunto);
                $assunto = str_replace("=?ISO-8859-1?Q?Eletr=F4nica_n=BA?=", "Eletrônica", $assunto);
                $assunto = str_replace("=?ISO-8859-1?Q?Cobran=E7a?=", "Cobrança", $assunto);

                $email_lido->Assunto_original_txf = $assunto;
            }
        }
//    else {
//        $email_lido->Acao_txf = '';
//        $email_lido->Status_txf = '';
//        $email_lido->Email_txf = '';
//        $email_lido->Tipo_bounce_txf = '';
//        $email_lido->Categoria_bounce_txf = '';
//    }


        return $email_lido;
    }

    function trata_codigo($codigo) {

        switch ($codigo) {
            case '421':
                return 'Serviço não disponível, fechando canal de transmissão';
                break;
            case '450':
                return 'Ação de correio solicitada não realizada: caixa de correio não disponível (por exemplo, caixa de correio ocupada)';
                break;
            case '451':
                return 'Ação solicitada abortada: erro no processamento';
                break;
            case '550':
                return 'A caixa de correio do usuário não estava disponível (como não encontrada)';
                break;
            case '551':
                return 'O destinatário não é local para o servidor.';
                break;
            case '553':
                return 'O comando foi anulado porque o nome da caixa de correio é inválido.';
                break;
            case '5.0.0':
                return 'Endereço não existe';
                break;
            case '5.1.1':
                return 'Endereço da caixa de correio de destino incorreto';
                break;
            case '5.1.2':
                return 'Endereço do sistema de destino incorrecto';
                break;
            case '5.1.3':
                return 'Sintaxe do endereço da caixa de correio de destino incorreto';
                break;
            case '5.1.4':
                return 'Endereço de caixa de correio de destino ambíguo';
                break;
            case '5.1.5':
                return 'Endereço de caixa de correio de destino válido';
                break;
            case '5.1.6':
                return 'A caixa de correio foi movida';
                break;
            case '5.1.7':
                return 'Sintaxe do endereço da caixa de correio do remetente inválido';
                break;
            case '5.1.8':
                return 'Endereço do sistema do remetente inválido';
                break;
            case '5.2.0':
                return 'Outro ou indefinido status da caixa de correio';
                break;
            case '5.2.1':
                return 'Caixa de correio desativada, não aceitando mensagens';
                break;
            case '5.1.0':
                return 'Outro status de endereço';
                break;
            case '5.3.0':
                return 'Outro ou indefinido status do sistema de correio';
                break;

            case '5.4.1':
                return 'Nenhuma resposta do host';
                break;
            case '5.4.2':
                return 'Ligação incorrecta';
                break;
            case '5.4.0':
                return 'Outro ou indefinido rede ou status de roteamento';
                break;
            case '5.4.3':
                return ':Falha do servidor de roteamento';
                break;
            case '5.4.4':
                return 'Não é possível rotear';
                break;
            case '5.4.7':
                return 'Prazo de entrega expirado';
                break;
            case '5.5.0':
                return 'Status do protocolo outro ou indefinido';
                break;

            case '5.2.2':
                return 'Caixa de correio cheia';
                break;
            case '5.3.1': return 'Sistema de correio lotado';
                break;

            case '5.2.3':
                return 'O comprimento da mensagem excede o limite administrativo.';
                break;
            case '5.2.4':
                return 'Problema de expansão da lista de discussão';
                break;
            case '5.3.4':
                return 'Mensagem muito grande para o sistema';
                break;
            case '5.5.3':
                return 'Demasiados destinatários';
                break;
            case '5.7.0':
                return 'Outro status de segurança ou indefinido';
                break;
            case '5.7.1':
                return 'Entrega não autorizada, mensagem recusada';
                break;
            case '5.7.2':
                return 'Expansão da lista de endereços proibida';
                break;
            case '5.7.7':
                return 'Falha de integridade da mensagem';
                break;


            case '452':
                return 'Ação solicitada não tomada: armazenamento insuficiente do sistema';
                break;
            case '500':
                return 'O servidor não conseguiu reconhecer o comando devido a um erro de sintaxe.';
                break;
            case '501':
                return 'Um erro de sintaxe foi encontrado em argumentos de comando.';
                break;
            case '502':
                return 'Este comando não está implementado.';
                break;
            case '503':
                return 'O servidor encontrou uma sequência incorreta de comandos.';
                break;
            case '504':
                return 'Um parâmetro de comando não é implementado.';
                break;
            case '552':
                return 'A ação foi abortada devido à alocação de armazenamento excedida.';
                break;
            case '554':
                return 'A transação falhou por algum motivo não especificado.';
                break;
            case '5.3.2':
                return 'Sistema que não aceita mensagens de rede';
                break;
            case '5.3.3':
                return 'Sistema não capaz de recursos selecionados';
                break;
            case '5.4.5':
                return 'Congestionamento da rede';
                break;
            case '5.4.6':
                return 'O loop de roteamento foi detectado';
                break;
            case '5.5.1':
                return 'Comando inválido';
                break;
            case '5.5.2':
                return 'Erro de sintaxe';
                break;
            case '5.5.4':
                return 'Argumentos de comando inválidos';
                break;
            case '5.5.5':
                return 'Versão incorreta do protocolo';
                break;
            case '5.6.0':
                return 'Outro ou erro de mídia indefinido';
                break;
            case '5.6.1':
                return 'Mídia não suportada';
                break;
            case '5.6.2':
                return 'Conversão necessária e proibida';
                break;
            case '5.6.3':
                return 'É necessária a conversão, mas não é suportada';
                break;
            case '5.6.4':
                return 'Conversão com perda realizada';
                break;
            case '5.6.5':
                return 'Falha na conversão';
                break;
            case '5.7.3':
                return 'Conversão de segurança necessária, mas não possível';
                break;
            case '5.7.4':
                return 'Recursos de segurança não suportados';
                break;
            case '5.7.5':
                return 'Falha criptográfica';
                break;
            case '5.7.6':
                return 'Algoritmo criptográfico não suportado';
                break;
            default:
                return 'desconhecido';
                break;
        }
    }

//            case '5.0.0' :
//                return "Unknown issue";
//                break;
//            case '5.1.0' :
//                return "Other address status";
//                break;
//            case '5.1.1' :
//                return "Bad destination mailbox address";
//                break;
//            case '5.1.2' :
//                return "Bad destination system address";
//                break;
//            case '5.1.3' :
//                return "Bad destination mailbox address syntax";
//                break;
//            case '5.1.4' :
//                return "Destination mailbox address ambiguous";
//                break;
//            case '5.1.5' :
//                return "Destination mailbox address valid";
//                break;
//            case '5.1.6' :
//                return "Mailbox has moved";
//                break;
//            case '5.1.7' :
//                return "Bad sender's mailbox address syntax";
//                break;
//            case '5.1.8' :
//                return "Bad sender's system address";
//                break;
//            case '5.2.0' :
//                return "Other or undefined mailbox status";
//
//            case '5.2.1' :
//                return "Mailbox disabled, not accepting messages";
//                break;
//            case '5.2.2' :
//                return "Mailbox full";
//                break;
//            case '5.2.3' :
//                return "Message length exceeds administrative limit.";
//                break;
//            case '5.2.4' :
//                return "Mailing list expansion problem";
//                break;
//            case '5.3.0' :
//                return "Other or undefined mail system status";
//                break;
//            case '5.3.1' :
//                return "Mail system full";
//                break;
//            case '5.3.2' :
//                return "System not accepting network messages";
//                break;
//            case '5.3.3' :
//                return "System not capable of selected features";
//                break;
//            case '5.3.4' :
//                return "Message too big for system";
//                break;
//            case '5.4.0' :
//                return "Other or undefined network or routing status";
//                break;
//            case '5.4.1' :
//                return "No answer from host";
//                break;
//            case '5.4.2' :
//                return "Bad connection";
//                break;
//            case '5.4.3' :
//                return "Routing server failure";
//                break;
//            case '5.4.4' :
//                return "Unable to route";
//                break;
//            case '5.4.5' :
//                return "Network congestion";
//                break;
//            case '5.4.6' :
//                return "Routing loop detected";
//                break;
//            case '5.4.7' :
//                return "Delivery time expired";
//                break;
//            case '5.5.0' :
//                return "Other or undefined protocol status";
//                break;
//            case '5.5.1' :
//                return "Invalid command";
//                break;
//            case '5.5.2' :
//                return "Syntax error";
//                break;
//            case '5.5.3' :
//                return "Too many recipients";
//                break;
//            case '5.5.4' :
//                return "Invalid command arguments";
//                break;
//            case '5.5.5' :
//                return "Wrong protocol version";
//                break;
//            case '5.6.0' :
//                return "Other or undefined media error";
//                break;
//            case '5.6.1' :
//                return "Media not supported";
//                break;
//            case '5.6.2' :
//                return "Conversion required and prohibited";
//                break;
//            case '5.6.3' :
//                return "Conversion required but not supported";
//                break;
//            case '5.6.4' :
//                return "Conversion with loss performed";
//                break;
//            case '5.6.5' :
//                return "Conversion failed";
//                break;
//            case '5.7.0' :
//                return "Other or undefined security status";
//                break;
//            case '5.7.1' :
//                return "Delivery not authorized, message refused";
//                break;
//            case '5.7.2' :
//                return "Mailing list expansion prohibited";
//                break;
//            case '5.7.3' :
//                return "Security conversion required but not possible";
//                break;
//            case '5.7.4' :
//                return "Security features not supported";
//                break;
//            case '5.7.5' :
//                return "Cryptographic failure";
//                break;
//            case '5.7.6' :
//                return "Cryptographic algorithm not supported";
//                break;
//            case '5.7.7' :
//                return "Message integrity failure";
//                break;
//            default:
//                return 'desconhecido';
//                break;
//        }
//     public function processa_conta($caixa, $pasta = '') {
//        if (!$caixa->Host_txf) {
//            die('parametro $caixa->Host_txf obrigatorio');
//        }
//        if (!$caixa->Email_txf) {
//            die('parametro $caixa->Email_txf obrigatorio');
//        }
//        if (!$caixa->Senha_txf) {
//            die('parametro $caixa->Senha_txf obrigatorio');
//        }
//        if (!$pasta) {
//            die('parametro $pasta obrigatorio');
//        }
//
//
//        $mbox = imap_open("{{$caixa->Host_txf}:143}", $caixa->Email_txf, $caixa->Senha_txf, OP_READONLY);
//
//        $some = imap_search($mbox, 'SINCE "8 August 2016"', SE_UID);
//        $msgnos = imap_search($mbox, 'ALL');
//        $uids = imap_search($mbox, 'ALL', SE_UID);
//        foreach ($some as $mensagem) {
//            $email_number = imap_msgno($mbox, $mensagem);
//            $overview[] = imap_fetch_overview($mbox, $email_number, 0);
//        }
//
//        ver($overview);
//
//
////        ver($some, 1);
////        ver($msgnos, 1);
////        ver($uids);
////        ver($mbox, 1);
////        $list = imap_getmailboxes($mbox, "{{$caixa->Host_txf}:143}", '*');
////
////        ver($list);
////
//        $MC = imap_check($mbox);
////ver($MC);
//// Fetch an overview for all messages in INBOX
//        $result = imap_fetch_overview($mbox, "1:{$MC->Nmsgs}", 0);
////        ver($result);
//        foreach ($result as $overview) {
//            echo "#{$overview->msgno} ({$overview->date}) - From: {$overview->from}
//    {$overview->subject}\n";
//        }
//
//        imap_close($mbox);
//
//
//        
//
//        return $mailboxFound;
//    }
//    function teste($caixa) {
//        $host = $caixa->Host_txf; //aqui você deve informar o seu servidor de Email, pode ser imap.domínio ou pop.domínio 
//        $usuario = $caixa->Email_txf;
//        $senha = $caixa->Senha_txf;
//
//        $caixaDeCorreio = imap_open("{" . $host . ":143}INBOX", $usuario, $senha);
//
//        if (!$caixaDeCorreio) {
//            print_r(imap_errors());
//        } else {
//
//            $listaPastas = imap_getmailboxes($caixaDeCorreio, "{" . $host . "}", "*");
//            if (is_array($listaPastas)) {
//                // Preparando a listagem de pastas
//                echo ("<p>Listando as pastas do seu IMAP</p>\n");
//                foreach ($listaPastas as $chavePastas => $valorPastas) {
//                    echo "<p><b>" . str_replace("{" . $host . "}", "", $valorPastas->name) . "</b><br>\n";
//
//                    $host2 = str_replace("}", ":143/novalidate-cert}", $valorPastas->name);
//
//                    $caixaDeCorreio1 = imap_open($host2, $usuario, $senha);
//                    if (!$caixaDeCorreio1) {
//                        echo "Erro ao tentar listar a pasta " . $valorPastas->name;
//                        print_r(imap_errors());
//                    } else {
//                        $check = imap_mailboxmsginfo($caixaDeCorreio1);
//                        if ($check) {
//                            // Mostrando os detalhes de cada pasta
//                            echo "Total de mensagens: <i>" . $check->Nmsgs . "</i><br>\n";
//                            echo "Mensagens nao lidas: <i>" . $check->Unread . "</i><br>\n";
//                            echo "Tamanho total: <i>" . $check->Size . " Bytes</i><br>\n";
//                            echo "</p>\n";
//                        } else {
//                            echo "Erro ao obter os detalhes das pastas:<br>" . imap_last_error();
//                        }
//                        $caixaDeCorreio1 = imap_close($caixaDeCorreio1);
//                    }
//                }
//            } else {
//                echo "Nao consegui obter a lista de pastas:<br>" . imap_last_error();
//            }
//            $caixaDeCorreio = imap_close($caixaDeCorreio);
//        }
//    }
}

?>