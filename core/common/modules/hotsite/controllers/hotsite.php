<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once(COMMONPATH . 'core/lands_core.php');

class hotsite extends lands_core {

    public $configuracoes;

    public function __construct() {
        parent::__construct();
        $this->load->helper('tradutor');
        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);

        $this->busca_configs();
        if ($this->configuracoes->Tempo_real_ativo_sel == 'SIM') {
            $this->busca_posts();
            
             
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

    function busca_configs() {

        
        if ($this->mbc->tabelaexiste("configuracoes")) {
            $configuracoes = $this->mbc->buscar_completo("configuracoes", "where Id_int is not null");

            if ($configuracoes[0]) {
                $this->configuracoes = $configuracoes[0];
                $this->smarty->assign('configuracoes', $configuracoes);
            }
        }
        
      
    }

    function busca_posts() {


        $lista_posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and data_dat <= CURRENT_DATE() order by Data_dat desc, Hora_txf desc, Id_int desc");
        $this->smarty->assign("lista_posts", $lista_posts);

 

        foreach ($lista_posts as $noticia) {

            $id = $noticia->Id_int;
            $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
            $this->smarty->assign("posts", $posts);



            $bloco = new stdClass();
            $bloco->Hora = $posts[0]->Hora_txf;
            $bloco->Titulo = $posts[0]->Titulo_txf;

            $bloco->Html_txf = $this->model_smarty->retorna_tpl_modulo($this->app->Template_txf, 'blocos', 'noticia');

            $blocos[] = $bloco;
        }
        $this->smarty->assign('blocos', $blocos);
    }

    /**
     * Ajax
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function ajax($params = null) {
        // abre as views em ajax
        //troca a base de dados para a padrao do site 
        // assign nas variaveis do site.
        $this->output->enable_profiler(FALSE);

        $this->conecta_mbc($this->app->Conexoes_for);
        $this->smarty->assign('app', $this->app);
        $this->assign_vars();
        switch ($this->uri->segment(2)) {

            case 'posts':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
                    redirect($this->app->Pagina_inicial_txf);
                }
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
                if (!isset($posts[0])) {
                    die('Post nao encontrado');
                }

                $this->smarty->assign('posts', $posts);
                $this->model_smarty->render_bloco('posts', $this->app->Template_txf);
                break;
            case 'noticia_galeria':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
                    die('id nao encontrado');
                }
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
                $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
                if (!isset($posts[0])) {
                    die('Post nao encontrado');
                }

                $this->smarty->assign('posts', $posts);
                $this->model_smarty->render_bloco('noticia_galeria', $this->app->Template_txf);
                break;

            default :
                die('caiu no default');
                break;
        }
    }

    function switch_pagina() {

        switch ($this->pagina_atual) {
            case 'posts':
                if (!$this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
                    die('id nao encontrado');
                }
                $id = $this->uri->segment($this->app->Segmento_padrao_txf + 1);
                $posts = $this->mbc->buscar_completo("post", "where Ativo_sel='SIM' and Id_int=" . $id);
                if (!isset($posts[0])) {
                    die('Post nao encontrado');
                }
                $this->smarty->assign('postsurl', $posts);
                break;

            case 'busca':
                $this->fazer_busca();
                break;
        }
    }

}

?>