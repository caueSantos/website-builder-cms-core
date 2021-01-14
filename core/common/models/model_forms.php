<?php

class Model_forms extends CI_Model {

    function __construct() {

        parent::__construct();
        $this->load->model('model_mail');
    }

    public function envia_post_contato() {

        $enviado = $this->input->post();

        $de_contato = $enviado['email'];
        $de_nome_contato = $enviado['nome'] . " - " . date('d/m/Y');

        // busca a lista de emails dos administradores oriundas da tabela "email_form"
        $para_contato = $enviado['destinatario'];
        $assunto_contato = "[Intensivo Apoio Odontologico] Contato feito pelo site";
        $mensagem_contato = "
                     Nome: " . nl2br($enviado['nome']) . "\n\n
                     Email: " . nl2br($enviado['email']) . "\n\n
                     Assunto: " . $enviado['assunto'] . "\n\n 
                     Mensagem: " . nl2br($enviado['mensagem']) . "\n\n\n         
        ";

        // chama a função que envia os emails para todos os forms do site
        $sucesso = $this->envia_emails($de_contato, $de_nome_contato, $para_contato, $bcc_contato = FALSE, $assunto_contato, $mensagem_contato);

        return $sucesso;
    }

    public function get_emails_contato($tabela, $coluna) {

        $this->db->select($coluna);
        $this->db->from($tabela);
        $query = $this->db->get();

        $retorno = $query->result();
        //print_r($retorno); die();
        if ($retorno) {
            $num_colunas = $query->num_rows();
            $i = 0;
            $emails = '';
            foreach ($retorno as $dado) {

                $emails .= $dado->email;
                $i++;
                if ($i < $num_colunas)
                    $emails .= ',';
            }

            return $emails;
        }else {

            return FALSE;
        }
    }

    // função que envia todo e qual quer email do site
    public function envia_emails($de, $de_nome, $para, $bcc = FALSE, $assunto, $mensagem) {

        $this->email->from($de, $de_nome);
        $this->email->to($para);
        if ($bcc != FALSE)
            $this->email->bcc($bcc);

        $this->email->subject($assunto);
        $this->email->message($mensagem);


        if ($this->email->send()) {

            return TRUE;
        } else {
            echo $this->email->print_debugger();
            return FALSE;
        }
    }

    public function news($email) {
        if ($this->validaEmail($email['email'])) {
            $this->load->model('model_banco');
            $this->load->model('model_banco_basico');
            $conta = $this->model_banco->buscar_tudo("emails_informativo where Email_txf='{$email['email']}'");
            if (count($conta) == 0) {
                $this->model_banco_basico->insertTable('emails_informativo', array('Email_txf' => $email['email']));
                return 'sucesso';
            } else
                return 'existe';
        } else
            return 'invalido';
    }

    function validaEmail($email) {
        $expressao = "^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$";
        if (eregi($expressao, $email)) {
            return true;
        } else {
            return false;
        }
    }

}

?>
