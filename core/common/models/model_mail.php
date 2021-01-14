<?php

require COMMONPATH . 'third_party/phpmailer/class.phpmailer.php';

class Model_mail extends Model_banco {

    public $app;
    public $cliente;

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }

    function envia_formulario($app, $formulario = null) {

        if (!isset($formulario)) {
            die('Formulario nao foi passado por parâmetro');
        }
        $this->app = $app;

        $this->smarty->assign('post', $_POST);

        try {

            $caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/forms/{$formulario}.tpl";

            $mensagem_formatada = $this->smarty->fetch($caminho);
        } catch (Exception $e) {
            $mensagem_formatada = $this->smarty->fetch(COMMONPATH . "../templates/padrao/forms/{$formulario}.tpl");
        }



        $dados = $_POST;
        $dados['Mensagem_txa'] = $mensagem_formatada;
        $dados['Assunto_txf'] = $formulario . " enviado por $app->Titulo_txf";

        return $this->envia_email($dados, 'boolean');
    }

       function envia_email_solicitacao_novo($email, $formulario = null) {
//ver($this->session->all_userdata('email'));
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        if (isset($formulario)) {
            $mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");

            //$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
            $email['Mensagem_txa'] = $mensagem;
        }
        $enviou = $this->envia_email_solicitacao($email, TRUE);
        return $enviou;
    }
    

    
    function envia_email_tpl($email, $formulario = null) {
//ver($this->session->all_userdata('email'));
        if (!isset($email['Nome_txf'])) {
            $email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
        }
        $email['Destinatario_txf'] = $email['Destinatario_txf'];
        if (isset($formulario)) {
            $mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");

            //$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
            $email['Mensagem_txa'] = $mensagem;
        }
        
       
      //ver($email);
//        if (is_lands()) {
//            echo($mensagem);
//        }
       

        $enviou = $this->envia_email_novo($email, TRUE);
        return $enviou;
    }

     function envia_email_solicitacao($email, $copia_cliente = TRUE) {
        $this->load->library('email');
        if ($this->cliente) {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $this->cliente->Smtp_host_txf,
                'smtp_port' => $this->cliente->Smtp_porta_txf,
                'smtp_user' => $this->cliente->Smtp_usuario_txf,
                'smtp_pass' => $this->cliente->Smtp_senha_txf,
                'smtp_crypto' => $this->cliente->Smtp_seguranca_txf,
//                 'smtp_crypto' => 'ssl'
            );
            
//            $config['send_multipart']=FALSE;
            $config['charset'] = 'utf-8';
//            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $this->email->initialize($config);
        }
        
//        ver($config);
//        
        

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

//        ver($this->email);
        if ($this->email->send()) {
            return TRUE;
        } else {
            ver($this->email->print_debugger(), 1);
            return FALSE;
        }
    }


    function envia_email_novo($email, $copia_cliente = TRUE) {
        $this->load->library('email');
        if ($this->cliente) {
            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $this->cliente->Smtp_host_txf,
                'smtp_port' => $this->cliente->Smtp_porta_txf,
                'smtp_user' => $this->cliente->Smtp_usuario_txf,
                'smtp_pass' => $this->cliente->Smtp_senha_txf,
                'smtp_crypto' => $this->cliente->Smtp_seguranca_txf,
//                 'smtp_crypto' => 'ssl'
            );
            
//            $config['send_multipart']=FALSE;
            
            $config['charset'] = 'utf-8';
//            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $this->email->initialize($config);
        }
        
//        ver($this->email);

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

//        ver($this->email);
        if ($this->email->send()) {
            return TRUE;
        } else {
            ver($this->email->print_debugger(), 1);
            return FALSE;
        }
    }

    function envia_email_smtp($dados, $copia_cliente = TRUE) {

        $mail = new PHPMailer;
        if (is_lands()) {
            $mail->SMTPDebug = 1;
        } else {
            $mail->SMTPDebug = 0;
        }
        $mail->IsSMTP();
        $mail->Host = $dados->Host;
        $mail->Port = $dados->Port;
        $mail->SMTPAuth = true;
        
        $mail->Username = $dados->Username;
        $mail->Password = $dados->Password;
        $mail->SMTPSecure = 'tls';
        $mail->From = $dados->From;
        $mail->FromName = $dados->FromName;
        foreach ($dados->Destinatarios as $destinatario) {
            $mail->AddAddress($destinatario);
        }
        $copias = $this->app->Copia_emails_txf;
        if ($copia_cliente) {
            $copias.=',' . $dados->Email_txf;
        }
        $copias_final = explode(',', $copias);

        foreach ($copias_final as $copia) {
            $mail->AddBcc($copia);
        }
        $mail->IsHTML(true);                                  // Set email format to HTML

        $mail->Subject = $dados->Subject;
        $mail->Body = $dados->Body;
        $mail->AltBody = $dados->AltBody;
        if (!$mail->Send()) {
            
            ver($mail->ErrorInfo,1);
            ver($mail);
            return false;
        } else {
            return true;
        }
    }
    
    function envia_email($contato, $retorno = NULL) {
        $this->load->library('email');

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

        $this->email->from($contato['Email_txf'], $contato['Nome_txf']);
        $this->email->to($contato['Destinatario_txf']);
        $this->email->bcc($contato['Email_txf'] . ',leonel@landsdigital.com.br,gustavo.vedana@landsdigital.com.br');
        $this->email->set_mailtype('html');
        $this->email->subject($contato['Assunto_txf']);
        $this->email->message($contato['Mensagem_txa']);
        if ($this->email->send()) {
            if ($retorno == 'boolean') {
                return TRUE;
            } else {
                return $this->smarty->fetch("blocos/retorno-alert-success.tpl");
            }
        } else {
            echo $this->email->print_debugger();
            if ($retorno == 'boolean') {
                return FALSE;
            } else {
                return $this->smarty->fetch("blocos/retorno-alert-error.tpl");
            }
        }
    }

}

?>
