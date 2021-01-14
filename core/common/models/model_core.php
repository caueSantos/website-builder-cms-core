<?php

require_once(COMMONPATH . 'models/model_banco_cliente.php');

class Model_core extends Model_banco_cliente {

    public $db;
//  public $tabela_emails_proprietario = 'contato';
    public $usuario;

    function __construct() {

        parent::__construct();
      ver('chegou');
    }

    function inicializa($app, $cliente = null) {
        $this->app = $app;
        if ($cliente) {
            $this->cliente = $cliente;
        }
    }
function busca_app($lands_id){
    
}
    

}

