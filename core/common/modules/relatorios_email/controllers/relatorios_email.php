<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class relatorios_email extends lands_core {

    public function __construct() {

        parent::__construct();
        $this->load->helper('relatorios_email');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        if ($this->pagina_atual != 'cron') {
            $this->checa_login();
        }
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



        switch ($this->pagina_atual) {

            case 'inicio' :

                break;

            case 'cron':
                $this->processa_cron();
                break;

            default:
                break;
        }
    }

    function processa_cron() {

        require_once(COMMONPATH . 'third_party/relatorios_email/vendor/autoload.php');
        

        $cwsDebug = new Cws\CwsDebug();
      //  $cwsDebug->setDebugVerbose();
       // $cwsDebug->setEchoMode();

        $cwsMbh = new Cws\MailBounceHandler\Handler($cwsDebug);

// process mode
        $cwsMbh->setNeutralProcessMode(); // default
//$cwsMbh->setMoveProcessMode();
//$cwsMbh->setDeleteProcessMode();

        /*
         * Eml folder
         */
//if ($cwsMbh->openEmlFolder(__DIR__.'/emls') === false) {
//    $error = $cwsMbh->getError();
//
//    return;
//}

        /*
         * Local mailbox
         */
        /* if ($cwsMbh->openImapLocal('/home/email/temp/mailbox') === false) {
          $error = $cwsMbh->getError();
          return;
          } */

        /*
         * Remote mailbox
         */

        $cwsMbh->setImapMailboxService(); // default
        $cwsMbh->setMailboxHost('mail.landsmail.srv.br'); // default 'localhost'
        $cwsMbh->setMailboxPort(143); // default const MAILBOX_PORT_IMAP
//$cwsMbh->setMailboxUsername('noreply@nfelafi.com.br');
//$cwsMbh->setMailboxPassword('a9x35fx0');
        $cwsMbh->setMailboxUsername('gustavo.vedana@landsdigital.com.br');
        $cwsMbh->setMailboxPassword('landsdigital12');

        $regex = "(\s?(?P<weekday>Mon|Tue|Wed|Thu|Fri|Sat|Sun))[,]?\s?(?P<day>[0-9]{1,2})\s(?P<month>Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(?P<year>[0-9]{4})\s(?P<hours>[0-9]{2}):(?P<minutes>[0-9]{2})(:(?P<seconds>[0-9]{2}))?\s(?P<timezone>[\+|\-][0-9]{4})\s?";
//$cwsMbh->setMailboxSecurity(CwsMailBounceHandler::MAILBOX_SECURITY_SSL); // default const MAILBOX_SECURITY_NOTLS
//$cwsMbh->setMailboxCertValidate(); // default const MAILBOX_CERT_NOVALIDATE
$cwsMbh->setMailboxName('INBOX'); // default 'INBOX'
        if ($cwsMbh->openImapRemote() === false) {
            $error = $cwsMbh->getError();
            return;
        }
//ver('chjegou');
// process mails!
        $result = $cwsMbh->processMails();

        $emails = $result->getMails();

        $emails_db = array();
        foreach ($emails as $email) {
//    ver($email, 1);

            $email_lido = trata_email($email);

            $emails_db[] = $email_lido;
        }



        ver($emails_db);

        if (!$result instanceof \Cws\MailBounceHandler\Models\Result) {
            $error = $cwsMbh->getError();
        } else {
            // continue with Result
            $counter = $result->getCounter();
            echo '<h2>Counter</h2>';
            echo 'total : ' . $counter->getTotal() . '<br />';
            echo 'fetched : ' . $counter->getFetched() . '<br />';
            echo 'processed : ' . $counter->getProcessed() . '<br />';
            echo 'unprocessed : ' . $counter->getUnprocessed() . '<br />';
            echo 'deleted : ' . $counter->getDeleted() . '<br />';
            echo 'moved : ' . $counter->getMoved() . '<br />';

            $mails = $result->getMails();
            echo '<h2>Mails</h2>';
            foreach ($mails as $mail) {
                if (!$mail instanceof \Cws\MailBounceHandler\Models\Mail) {
                    continue;
                }
                echo '<h3>' . $mail->getToken() . '</h3>';
                echo 'subject : ' . $mail->getSubject() . '<br />';
                echo 'type : ' . $mail->getType() . '<br />';
                echo 'recipients :<br />';
                foreach ($mail->getRecipients() as $recipient) {
                    if (!$recipient instanceof \Cws\MailBounceHandler\Models\Recipient) {
                        continue;
                    }
                    echo '- ' . $recipient->getEmail() . '<br />';
                }
            }
        }
    }

}

?>