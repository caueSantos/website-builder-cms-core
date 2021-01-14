<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class frontend_multi extends lands_core {

    public $idioma;
    public $nome_idioma;

    public function __construct() {
        parent::__construct();
      $this->load->library("GoogleTranslate");
        $this->load->helper('tradutor');
        
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);
        $this->configura_idioma();
//        ver($this->idioma,1);
//        ver($this->nome_idioma);  
//         $this->idioma = 'pt-br';
//                $this->nome_idioma = 'Portugues_txa';

    }

   

    function index() {


        //$this->app->Url_cliente;
        if (!method_exists(__CLASS__, $this->pagina_atual)) {
            $this->carrega_pagina($this->pagina_atual);
        } else {
            $funcao_atual = $this->pagina_atual;
            //executa uma funcao que deve ser programa nesta classe.
            $this->$funcao_atual();
        }
    }

    function switch_pagina() {
     //   $this->app->Url_atual = $this->app->Url_cliente . $this->idioma . '/';
       // $this->smarty->assign('app', $this->app);
         
        switch ($this->pagina_atual) {
            case 'busca':
                $this->fazer_busca();
                break;
        }
    }

    function fazer_busca() {

        if (!isset($_POST['Tabelas_txf'])) {
            redirect($this->app->Url_atual);
            ver('Você deve definir as tabelas no qual a busca será feita');
            die();
        }
        $tabelas = explode(',', $_POST['Tabelas_txf']);
        $this->conecta_mbc($this->app->Conexoes_for);

        foreach ($tabelas as $tabela) {
            $resultado[$tabela] = $this->mbc->get_busca($tabela, $_POST['valor']);
        }

        $this->smarty->assign('resultado', $resultado);
    }
    
    
    /* OVERRIDE */
     function carrega_pagina($nome_pagina = null, $tipo = 'pagina') {
        if (!isset($nome_pagina)) {
            $nome_pagina = $this->pagina_atual;
        }
        
        $nome_pagina = strtolower($nome_pagina);
        $this->tipo = $tipo;
        $this->carrega_dados($nome_pagina, $tipo);
        $this->switch_pagina();
        $this->executa_seo();
        $this->model_smarty->render($this->pagina_atual, $this->app->Template_txf);
    }

}

?>