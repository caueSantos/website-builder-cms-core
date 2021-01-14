
<?php

require_once(COMMONPATH . 'core/lands_core.php');

/**
 * Constructor
 *
 * @access public
 */
class lands_config extends lands_core {

    public $default_view;
    public $output;
    public $tabela;
    public $appid = 'core';
    public $conteudo2;
    public $modulo = 'config';
    public $app = array();
    public $tabelas;
    public $asana_key = '2jDf4qFe.A3i5JMavVeaQob6ucDCtlMN';
    public $workspace_id = '8158385712203';
    public $projetos_asana;
    public $usuario_logado;

    function __construct() {
        parent::__construct();

        $this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
        $this->pagina_atual = ($this->pagina_atual != "" ? $this->pagina_atual : $this->app->Pagina_inicial_txf);

//        if (!is_lands()) {
//            if(!isset($_REQUEST['senha'])){
//                die('acesso negado');
//            } else {
//                if($_REQUEST['senha']!='Ld230551'){
//                 die('acesso negado');
//                }
//            }
//           
//                    
//        }
//        

        $this->checa_login();

        $this->usuario_logado = $this->session->userdata['usuario'];
    }

    function index() {
        die('lands_core nao possui metodo index');
    }

    /**
     * Carrega página do sistema
     *
     * @access	public
     * @param	array
     * @return	bool
     */
    function carrega_pagina($nome_pagina = null) {
        if (!isset($nome_pagina)) {
            $nome_pagina = $this->pagina_atual;
        }
//        $this->conecta_mbc(0);
        $this->carrega_dados($nome_pagina);
        $this->carrega_menu_config();
        $this->switch_pagina();

        $this->model_smarty->render($this->pagina_atual, $this->app->Template_txf);
    }

    function switch_tabela() {
        $this->tabela = $this->uri->segment($this->app->Segmento_padrao_txf + 1);

        $this->grocery_crud->set_table($this->tabela);
        $this->grocery_crud->set_theme('datatables');
        $this->grocery_crud->set_language('pt-br.portuguese');





        switch ($this->tabela) {
            case 'apps' :

                $this->grocery_crud->set_relation('Conexoes_for', 'conexoes', 'Nome_conexao_txf');
                $this->grocery_crud->set_relation('Clientes_for', 'clientes', 'Fantasia_txf');
                $this->grocery_crud->unset_columns('Conta_cpanel_txf', 'Lands_pass', 'Segmento_padrao_txf', 'Pagina_inicial_txf', 'Tipo_app_sel', 'Logo_txa', 'Favicon_txf', 'Url_facebook_txf', 'Url_facebook_aba_txf', 'Url_curl_txf', 'Titulo_txf', 'Pasta_assets', 'Pasta_painel', 'Template_txf', 'Template_relatorio_txf', 'Ativo_sel', 'Tabela_info_txf', 'Tabela_contato_txf', 'Campo_categoria_txf', 'Idioma_padrao_txf', 'Grava_acesso_sel', 'Grava_log_sel', 'Observacoes_txa', 'Analytics_txa', 'Copia_emails_txf');



                $this->grocery_crud->order_by('Lands_id');
                break;
            case 'queries' :

                $this->grocery_crud->set_relation('Conexoes_for', 'conexoes', 'Nome_conexao_txf'); //$related_title_field, $where_clause = null, $order_by = null)
//                        $this->grocery_crud->required_fields('Pagina_txf', "Tabela_txf", "Variavel_txf", "Consulta_sql_txf", "Metodo_txf", "Paginacao_sel", "Qtde_registro_pagina_txf");

                $this->grocery_crud->unset_columns('Tipo_sel', 'Arquivo_tpl_txf', 'Base_dados_txf', 'Qtde_registro_pagina_txf', 'Ativo_sel', 'Campos_txf', 'Segment2_txf', 'Segment3_txf', 'Order_by_txf', 'Explicacao_txa', 'Campo_imagem_txf', 'Explicacao_txa', 'Consulta_sql_txf');
                $this->grocery_crud->order_by('Lands_id');
                break;

            case 'conexoes' :
                $this->grocery_crud->set_relation('Clientes_for', 'clientes', 'Fantasia_txf');
                $this->grocery_crud->unset_columns('Porta_txf', 'Ativo_sel');
                break;
            case 'clientes_smtp' :
                $this->grocery_crud->set_relation('Clientes_for', 'clientes', 'Fantasia_txf');

                break;
            case 'marketing' :
                $this->grocery_crud->unset_columns('Ramo_txf', 'Email_txf', 'Observacao_txa');
                $this->grocery_crud->order_by("Agenda_dat, Cliente_txf", "desc");
                break;
            case 'clientes' :
                $this->grocery_crud->unset_columns('Dominio_txf', 'Endereco_txf', 'Numero_txf', 'Bairro_txf', 'Cidade_txf', 'Estado_sel', 'Telefone_txf', 'Fanpage_txf', 'Logomarca_ico');
                $this->grocery_crud->order_by('Fantasia_txf');
                break;
        }



        $crud = $this->grocery_crud->render();

        $this->smarty->assign('tabela', $this->tabela);
        $this->smarty->assign('crud', $crud);
    }

    function carrega_menu_config() {

        $lista_aplicativos = $this->model_banco->executa_sql("select a.*,a.Id_int as Id_app, c.* from apps a left outer join conexoes c on c.Id_int=a.Conexoes_for where a.Ativo_sel='SIM' order by a.Clientes_for, a.Lands_id");

        foreach ($lista_aplicativos as $aplicativo) {
            $aplicativo->Conexao = $this->mbc->executa_sql("select * from conexoes where Id_int={$aplicativo->Conexoes_for}");
        }

        $this->conecta_mbc(44);


        $clientes_painel = $this->mbc->buscar_tudo('clientes');

        foreach ($lista_aplicativos as $aplicativo) {
            foreach ($clientes_painel as $painel) {
                if ($painel->Nome_bd_txf == $aplicativo->Conexao[0]->Database_txf) {
                    $aplicativo->Painel = $painel;
                }
            }
        }




        $this->lista_aplicativos = $lista_aplicativos;
        $this->smarty->assign('lista_aplicativos', $lista_aplicativos);

        $this->tabelas = $this->model_banco->executa_sql('show tables');
        $this->smarty->assign('tabelas', $this->tabelas);
//        $this->conecta_mbc(44);
//        $clientes_painel = $this->mbc->buscar_tudo('clientes');
//        $this->smarty->assign('clientes_painel', $clientes_painel);
//            $this->load->library('asana', $this->asana_key);
//            $this->projetos_asana = json_decode($this->asana->getProjects());
//            $this->smarty->assign('projetos_asana', $this->projetos_asana->data);
        //  ver($usuarios);
    }

    function create() {

        if ($_REQUEST['lands_id']) {
            $nomesite = $_REQUEST['lands_id'];
        } else {
            $nomesite = 'core_wizard';
        }
//ver($nomesite); 

        switch ($this->uri->segment(2)) {
            case 'files':
                //$this->conecta_ftp(4);

                $this->load->library('ftp');
                $config['hostname'] = $_REQUEST['ftp']['host'];
                $config['username'] = $_REQUEST['ftp']['user'];
                $config['password'] = $_REQUEST['ftp']['pass'];
                
                $path = $_REQUEST['ftp']['path'];
//                ver($_REQUEST);
                //$path = 'public_html/subdominios/sites/core_wizard';
 
                if ($this->ftp->connect($config)) {

                    $origem_index = APPPATH . '../index_padrao.php';
                    $origem_htaccess = APPPATH . '../.htaccess';
                    $origem_temp = APPPATH . '../index_temp.php';
//$caue='oi';

                    $reading = fopen($origem_index, 'r');
                    $writing = fopen($origem_temp, 'w');

                    $replaced = false;

                    while (!feof($reading)) {
                        $line = fgets($reading);
                        if (stristr($line, '$cabecalho')) {
                            $line = "define('LANDS_ID', '$nomesite'); define('LANDS_PASS', '$nomesite');  define('TIPO_APP', 'site');";
                            $replaced = true;
                        }
                        fputs($writing, $line);
                    }
                    fclose($reading);
                    fclose($writing);



//        $this->ftp->debug = TRUE;
//                    ver($path);
                    if (file_exists($origem_index)) {
                        $this->ftp->mkdir($path);
                        $this->ftp->upload($origem_temp, $path . '/index.php', 'binary', 0775);
                        $this->ftp->upload($origem_htaccess, $path . '/.htaccess', 'binary', 0775);
                        
                        
                        echo 'criou index';
                    } else {
                        echo('nao criou index');
                    }
                } else {
                    die('nao conectou no ftp');
                }
//      ver($this->ftp);
//      $this->ftp->changedir($path);
//      ver($this->ftp->list_files(''));


                break;

            case 'core':
                /**/
                //copia a pasta assets
                $origem = APPPATH . '../assets/padrao_dev/';
                $destino = APPPATH . "../assets/{$_REQUEST['pasta_assets']}/";
                $this->copia($origem, $destino);


                //copia a pasta templates        
                $origem_tpl = APPPATH . '../templates/padrao_dev/site/';
                $destino_tpl = APPPATH . "../templates/producao/{$_REQUEST['pasta_templates']}/site/";
                $this->copia($origem_tpl, $destino_tpl);


                die('copiou arquivos padrao');
                break;


            default:
                break;
        }








        //cria arquivos no index do cliente (dados de ftp)
        //cria arquivos no core /assets e templates
        //cria aplicativo no core, conexao e cliente 
        //criacao de painel
    }

//   $source = 'dir/dir/dir';
//$dest= 'dest/dir';



    function copia($source, $dest) {
        $prev = dirname($dest);
//        ver($prev);
        if (!is_dir($prev)) {
            $prev2 = dirname($prev);
            if (!is_dir($prev)) {
                mkdir($prev2);
            }
            mkdir($prev);
        }
        if (!file_exists($dest)) {
            mkdir($dest);
        }
        mkdir($dest, 0755);

        foreach (
        $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST) as $item) {
            if ($item->isDir()) {
                mkdir($dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            } else {
                copy($item, $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
            }
        }
    }

}