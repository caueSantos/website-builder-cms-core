<?php

require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Constructor
 *
 * @access public
 */
class lands_painel extends lands_core {

    public $usuario;
    public $modulos;
    public $mbp;
    public $tabela;
    public $modulo_atual = null;

    function __construct() {
        parent::__construct();

//        ver('chegou');
        if ($this->modulo != 'migracao') {
            $pg = '';
            if (is_array($this->uri->segments))
                foreach ($this->uri->segments as $segmento) {
                    $pg.=$segmento . '/';
                }
            
            $this->checa_login($pg);
        };
        if ($this->modulo_atual) {
            $this->app->Template_txf = $this->app->Template_txf . '/' . $this->modulo_atual;
        }
        $this->load->helper('painel');
        if ($this->modulo != 'migracao') {
            $this->carrega_obrigatorios();
        }
    }

    function checa_login($pagina_atual = null, $email = null) {

        if (!isset($this->session->userdata['usuario'])) {
            if ($pagina_atual) {
                redirect("login?redirect_link={$pagina_atual}");
            } else { 
                redirect("login?nivel=admin");
            }
        } else {
            $this->smarty->assign('usuario_logado', $this->session->userdata['usuario']);
            return true;
        }
    } 

    function index() {
        die('lands_core nao possui metodo index');
    }

    /**
     * Conecta ao banco do gerenciador
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function conecta_model_gerenciador($dados) {
        $this->painel_model_gerenciador->db = null;
//         ver('dq');
        $this->painel_model_gerenciador = $this->load->model('painel_model_gerenciador', 'painel_model_gerenciador', $dados);
        $this->painel_model_gerenciador->db = $this->load->database($dados, TRUE);
        $this->painel_model_gerenciador->inicializa($this->app, $this->cliente);
    }

    /**
     * Conecta ao banco do gerenciador
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function conecta_model_tabela($con) {
        $this->conexao_cliente = $this->config_conexao($con);
        $this->mt = $this->load->model('painel_model_tabela', 'mt', $this->conexao_cliente);
        $this->mt->db = $this->load->database($this->conexao_cliente, TRUE);
        $this->mt->inicializa($this->app, $this->cliente);
        return $this->conexao_cliente;
    }

    /**
     * Carrega página do sistema
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function config_conexao($obj) {
//busca na tabela conexoes do banco lands_core.
//cria conexao com a base de dados do cliente baseado nos dados da tabela conexoes;
        $array_conexao = array(
            'hostname' => $obj->Bd_host_txf,
            'username' => $obj->Bd_usuario_txf,
            'password' => $obj->Bd_senha_txf,
            'database' => $obj->Bd_database_txf,
            'dbdriver' => 'mysql',
            'dbprefix' => '',
            'pconnect' => TRUE,
            'db_debug' => TRUE,
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'autoinit' => TRUE,
            'stricton' => FALSE
        );
        return $array_conexao;
    }

    function carrega_avisos($tipo = null, $id_aviso = null) {

//        $this->carrega_model('painel_avisos');
//        $this->painel_avisos->busca_avisos();

        $where = " where ( Ativo_sel='SIM' and Usuarios_for='{$this->usuario->Id_int}' ) or ( Ativo_sel='SIM' and Tipo_sel='GERAL')";
        $todos_avisos = $this->mbc->executa_sql("select * from avisos ", $where);

        $cont = 0;
        foreach ($todos_avisos as $aviso) {

            $sql = "select count(*) as total from avisos_visualizacao where Usuarios_for={$this->usuario->Id_int} and Avisos_for=$aviso->Id_int";
            $visu = $this->mbc->executa_sql($sql);

            if ($visu[0]) {
                $aviso->Vizualizacoes = $visu[0]->total;
                if ($aviso->Vizualizacoes == 0) {
                    $cont = $cont + 1;
                }
            }
        }

        $this->smarty->assign('todos_avisos', $todos_avisos);
        $this->smarty->assign('total_nao_lidos', $cont);

        if ($tipo != null) {
            if ($this->uri->segment(2)) {
                $segment2 = $this->uri->segment(2);
                $where = "where ( Ativo_sel='SIM' and Usuarios_for='{$this->usuario->Id_int}' and Tipo_sel LIKE '%{$segment2}%') or ( Ativo_sel='SIM' and Tipo_sel LIKE '%{$segment2}%')";
            } else {
                $this->smarty->assign('segment2', '');
            }
        }
        $avisos = $this->mbc->buscar_completo("avisos", $where);

        $cont = 0;
        foreach ($avisos as $aviso) {

            $sql = "select count(*) as total from avisos_visualizacao where Usuarios_for={$this->usuario->Id_int} and Avisos_for=$aviso->Id_int";
            $visu = $this->mbc->executa_sql($sql);

            if ($visu[0]) {
                $aviso->Vizualizacoes = $visu[0]->total;
                if ($aviso->Vizualizacoes == 0) {
                    $cont = $cont + 1;
                }
            }
        }


        $this->smarty->assign('avisos', $avisos);
    }

    function carrega_obrigatorios() {
        $this->usuario = $this->session->userdata['usuario'];
        $this->smarty->assign('usuario', $this->usuario);
        $this->carrega_modulos();
        $this->carrega_avisos();
    }

    /**
     * Carrega página do sistema
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function carrega_pagina($nome_pagina = null, $tipo = 'pagina', $arquivo_layout = 'layout') {


        if (!isset($nome_pagina)) {
            $nome_pagina = $this->pagina_atual;
        }
        $this->tipo = $tipo;
        $this->smarty->assign("pagina_atual", $this->pagina_atual);
        $this->switch_pagina();
        $this->load->database('default', TRUE);
        $this->carrega_dados($nome_pagina);

//        $this->smarty->assign('modulo_atual',$this->modulo);
//        $this->smarty->assign('modulo_atual',$modulo);

        $this->model_smarty->render_modular($this->app->Template_txf, $arquivo_layout, $this->modulo, $nome_pagina);
//            $this->model_smarty->render_avancado($this->pagina_atual, $this->app->Template_txf);
    }

    // carrega os modulos do painel e monta o objeto modulos para o cliente
    function carrega_modulos() {

        $this->conecta_mbc($this->app->Conexoes_for);
        $id_usuario = $this->usuario->Id_int;


        $modulos = $this->mbc->executa_sql("select * from modulos");
        /* IDEIA 01 */
        foreach ($modulos as $modulo) {
            $tipo = $modulo->Extensao_txf;
            $modulo->Modulos = array();
            $modulo->Modulos = $this->mbc->executa_sql("select * from modulos_$tipo where Usuarios_for='$id_usuario'");
        }
        $this->modulos = $modulos;
        $this->restringe_modulos_usuario();
        $this->smarty->assign('modulos', $this->modulos);
        /* FIM IDEIA 01 */
        //carrega os genciadores de conteudo;
        //   $this->cliente_logado->Modulos = $this->mbc->executa_sql("select * from modulos where Dominio_txf='" . $this->cliente_logado->Dominio_txf . "'");
    }

    function restringe_modulos_usuario() {
        
    }

}