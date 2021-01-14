<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'modules/landspayv2/controllers/landspayv2.php');

class cron extends landspayv2 {

    public $modulo = 'admin';
    public $aplicativo;
    public $compra;
    public $id_sistema = 3;

    public function __construct() {
        parent::__construct();

        $this->load->helper('landspay');

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : 'cron');
//        ver('chegou2');
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
        $this->conecta_mbc($this->app->Conexoes_for);

        $this->carrega_model('model_recebimento');
        $this->carrega_model('model_moipv2');

//ver($this->usuario);
//        $this->model_moip->inicia_moip(3);


        switch ($this->pagina_atual) {
            case 'inicio':

                break;


            case 'cron_moip':

                $sistemas = $this->model_recebimento->busca_sistemas(FALSE);

                foreach ($sistemas as $sistema) {
                    $sistema->conta_moip = $this->model_recebimento->busca_conta_moip_id($sistema->Contas_moip_for);
                    $sistema->recebimentos = $this->model_recebimento->busca_recebimentos_em_aberto($sistema->Id_int);

                    $this->model_moipv2->inicializa($this->app, $this->cliente, $sistema, $sistema->conta_moip);
                    foreach ($sistema->recebimentos as $recebimento) {
//                        $pagto_moip = $this->model_moipv2->busca_pagamento($recebimento->id_meio);
                        $pagamento = $this->model_moipv2->busca_pagamento($recebimento->id_meio);
                        $status_ingles = $pagamento->status;
                        $status = $this->model_moipv2->trata_status_moip($status_ingles);
                        $this->model_recebimento->atualiza_status($recebimento->Id_int, 'moip', $status, $sistema->conta_moip->Tipo_sel);
                        echo "recebimento {$recebimento->Id_int} atualizado -> id pagamento = {$recebimento->id_meio}<br>";
                    }
                }

           

                die();


//        $sql = "select pr.*,p.status from pagamentos_retornos  pr left outer join pagamentos p on p.Id_int=pr.id_pagamento where pr.meio='moip' and p.status!='pago' and p.status!='cancelado' and pr.ambiente='{$this->ambiente}'";
//        where pr.meio='moip' and p.status!='pago' and p.status!='cancelado' and pr.ambiente='{$this->ambiente}'
//                foreach ($contas_moip as $conta) {
//
//                    $this->model_moipv2->inicializa($this->app, $this->cliente, $conta->id_sistema, $conta->Email_secundario_txf);
//
//                    $this->model_moipv2->executa_cron();
//                }

                break;
        }
    }

}

?>