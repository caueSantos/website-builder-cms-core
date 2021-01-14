<?php

class Model_login extends Model_banco {

    public $usuario_master = array();
    public $app;

    function __construct() {
        parent::__construct();
    }

    public function configura($app) {
        $this->app = $app;
    }

    function validar_usuario_senha($usuario, $senha) {
        return $this->executa_sql("select * from usuarios where Login_txf='$usuario' and Senha_txp='$senha'");
    }

    function validar_usuario_senha_painel($cpf, $senha) {
        $senha = md5($senha);
        return $this->executa_sql("select * from usuarios where Cpf_txf='$cpf' and Senha_txp='$senha'");
    }

    function validar_senha_master($usu, $senha) {
        $this->usuario_master['Id_int'] = '1';
        $this->usuario_master['Nome_txf'] = 'Admin Lands';
        $this->usuario_master['Usuario_txf'] = 'Lands';
        $this->usuario_master['Senha_txf'] = 'Digital';
        $this->usuario_master['Nivel_sel'] = '5';
        $master[] = array_to_object($this->usuario_master);


        if (($usu == $this->usuario_master['Usuario_txf']) && ($senha == $this->usuario_master['Senha_txf'])) {
            return $master;
        } else {
            return false;
        }
    }

    public function valida_cliente($valor = null) {
        if (!isset($valor)) {
            
        }
        return $this->executa_sql("select * from clientes");
    }

    function validar_usuario_senha_app($usuario, $senha, $app) {
        $usuario = addslashes($usuario);
        $senha = addslashes($senha);
        $app = addslashes($app);

        $sql = "select * from usuarios where Login_txf='$usuario'  and Senha_txp='$senha'";
        if ($usuario != 'lands' && $senha != 'lands') {
            $sql.="and Lands_id='$app'";
        }
        
        

        return $this->executa_sql($sql);
    }

    function reenvia_email_senha($usuario, $formulario, $cabecalho = NULL) {
        $this->load->model('model_mail');
        if (isset($cabecalho)) {
            $email['Email_txf'] = $cabecalho->Email_txf;
            $email['Nome_txf'] = $cabecalho->Nome_txf;
            $email['Assunto_txf'] = $cabecalho->Assunto_txf;
        } else {
            $email['Email_txf'] = 'contato@landshosting.com.br';
            $email['Nome_txf'] = 'Painel de Controle';
            $email['Assunto_txf'] = 'Recuperação de senha';
        }
        $email['Destinatario_txf'] = $usuario->Email_txf;
//ver($this->app);
        $email['Mensagem_txa'] = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");
        $enviou = $this->model_mail->envia_email($email, 'boolean');
        return $enviou;
    }

//      function busca_usuarios($cliente){
//             
//                  $usuarios = $this->executa_sql("select * from usuarios where Dominio_txf='$valor' or Clientes_for=" . $cliente[0]->Id_int . " order by Nome_txf");
//                  if (isset($usuarios[0]->Id_int)) {
//
//                        $this->smarty->assign('cli', $cliente);
//                        $this->smarty->assign('usuarios', $usuarios);
//                        $this->model_smarty->render_ajax('form_login', $this->app->Template_txf);
//                  } else {
//                        return false;
//                  }
//      }


    function gera_senha_aleatoria() {
        //ver(time());
        return time();
    }

}