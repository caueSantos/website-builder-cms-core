<?php

class Painel_model_login extends Model_banco {

    public $app;
    public $cliente;

    function __construct() {
        parent::__construct();
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;

        if ($cliente) {
            $this->cliente = $cliente;
        }
    }
    function verifica_super_usuario($usuario){
        $usuario->Tipo='admin';
        if($usuario->Id_int==375 || $usuario->Id_int==30 || $usuario->Id_int==166){
            
            return TRUE;
        } else {
            
            return FALSE;
        }
    
        
    }
    function autentica_usuario($email, $password = null) {
        $dados = array(
            'email' => $email,
            'password2' => $password,
        );
        
        $resposta = $this->painel_model_api->chama_api("ValidateLogin", $dados);
//        ver($resposta);
        if ($resposta['result'] == 'success') {
            if (isset($resposta['contactid'])) {
                //busca um contato
                $dados_contato = array();
                $dados_contato['userid'] = $resposta['userid'];
                $contatos = $this->painel_model_api->chama_api("GetContacts", $dados_contato);

                foreach ($contatos['contacts']['contact'] as $contato) {
                    if ($contato['email'] == $email) {
                        $usuario = new stdClass();
                        $usuario->Id_int = $contato['userid'];
                        $usuario->Nome_txf = $contato['firstname'];
                        $usuario->Sobrenome_txf = $contato['lastname'];
                        $usuario->Email_txf = $contato['email'];
                        $usuario->Empresa_txf = $contato['companyname'];
                    }
                }
            } else {
                //busca um cliente
                $dados_cliente = array();
                $dados_cliente['clientid'] = $resposta['userid'];
                $cliente = $this->painel_model_api->chama_api("GetClientsDetails", $dados_cliente);

                $usuario = new stdClass();
                $usuario->Id_int = $cliente['userid'];
                $usuario->Nome_txf = $cliente['firstname'];
                $usuario->Sobrenome_txf = $cliente['lastname'];
                $usuario->Email_txf = $cliente['email'];
                $usuario->Empresa_txf = $cliente['companyname'];
            }
            return $usuario;
        } else {
            return FALSE;
        }
    }

}

?>
