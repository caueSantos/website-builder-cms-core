<?php

	require_once(COMMONPATH . 'core/lands_frame.php');
	require_once(COMMONPATH . 'libraries/GoogleTranslate.php');

	/**
	 * Constructor
	 *
	 * @access public
	 */
	class lands_core extends lands_frame
	{

		public $app = array();
		public $vars = array();
		public $dados_conexao;
		public $cliente = array();
		public $_settings = array();
		public $pagina_atual;
		//      public $_name_class = 'core_main';
		public $_skin = 'modelo';
		public $_modulo = 'padrao';
		public $_template = 'padrao';
		public $mbc;
		public $consultas = array();
		public $conexao_cliente = array();
		public $clausula_exibicao_paginas = null;
		public $id_conexao_core = 0;
		public $dispositivo;
		public $tipo;
		public $configuracoes_ftp;

		function __construct()
		{
			parent::__construct();

			$this->load->helper('url');
			$this->load->helper('text');
			$this->load->helper('lands');
			//        $this->load->helper('super');

			$this->load->helper('devices');
			$this->load->helper('labcloud');
			$this->load->helper('instagram');
			//        ver('travou');
			// ver('o vedana parou com os sites');

			$this->load->library('smarty');
			$this->load->library('session');
			$this->load->helper('file');
			$this->load->helper('opencart');
			$this->load->model('model_banco');
			//   $this->load->model('model_forms');
			$this->load->model('model_smarty');
//        ver($GLOBALS);
			$this->GoogleTranslate = new GoogleTranslate();
			$this->load->library("GoogleTranslate");

			if (isset($_REQUEST['teste'])) {
				echo "Virtua Server";
				$vedaninha = 'alo';
			}

			header("Access-Control-Allow-Origin: *");

			//        ver('o vedana parou com os sites');
			// $this->smarty->debugging = 1;

			$this->verifica_seguranca();
			$this->verifica_htaccess();

			if ($this->mbc && $this->mbc->tabelaexiste('traducao')) {

				$this->app->Traducao = new StdClass();
				$con_trad = $this->mbc->executa_sql('select * from traducao');

				foreach ($con_trad as $trans) {
					$this->app->Traducao->{$trans->Chave_txf} = $trans->Valor_txf;
				}

			}

			if ($this->mbc && $this->mbc->tabelaexiste('configs')) {

				$this->app->Site_config = new StdClass();
				$con_trad = $this->mbc->executa_sql('select * from configs');

				foreach ($con_trad as $trans) {
					$this->app->Site_config->{$trans->Chave_txf} = $trans->Valor_txf;
				}

			}

			if ($this->app->Linguagem_banco_sel) {
				$linguagens = opcoes_linguagens(linguagens_disponiveis(null, true));
				if (isset($linguagens[$this->app->Linguagem_banco_sel])) {
					$this->app->Intl = $linguagens[$this->app->Linguagem_banco_sel];
				}
			}


			//      ver('parou os sites');
			if (is_lands() && $this->app->Lands_id != 'config') {
				$this->output->enable_profiler(false);
			}

			if ($this->app->Linguagem_banco_sel) {
				$idioma = $this->app->Linguagem_banco_sel;
				//$this->app->Url_cliente = $this->app->Url_cliente . $idioma . '/';
			}

		}

		function file_force_contents($dir, $contents)
		{
			$parts = explode('/', $dir);
			$file = array_pop($parts);
			$dir = '';
			foreach ($parts as $part)
				if (!is_dir($dir .= "/$part"))
					mkdir($dir);
			file_put_contents("$dir/$file", $contents);
		}

		function verifica_htaccess()
		{
			if (file_exists(FCPATH . ".htaccess")) {

			} else {
				$htaccess = file_get_contents(APPPATH . "../.htaccess");
				$this->file_force_contents(FCPATH . ".htaccess", $htaccess);
				echo "criou htaccess";

				$email = array();
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

				$this->email->from($this->cliente->Smtp_usuario_txf);
				$this->email->reply_to("bruna.branco@landsagenciaweb.com.br");
				$this->email->_replyto_flag = TRUE;

				$this->email->to("bruna.branco@landsagenciaweb.com.br");

				$this->email->set_mailtype('html');
				$this->email->subject("Conta invadida");
				$this->email->message("Atenção, a conta do site {$this->app->Url_cliente} teve o htaccess removido");

				//        ver($this->email);
				if ($this->email->send()) {
					echo "email enviado";
					return TRUE;
				} else {
					ver($this->email->print_debugger(), 1);
					echo "email não enviado";
					return FALSE;
				}
			}
		}

		function index()
		{
			die('lands_core nao possui metodo index');
		}

		function layout()
		{

			redirect('http://assets.lands.net.br/layouts/' . $this->app->Lands_id);
		}

		function busca_cep()
		{

			echo busca_cep();
		}

		function info()
		{
			phpinfo();
		}

		function carrega_model($model, $id_conexao = null)
		{

			try {
				if ($id_conexao == null) {
					$id_conexao = $this->app->Conexoes_for;
				}
				$this->load->database('default', null, true);
				$this->conecta_mbc($id_conexao);
				$this->load->model($model, $model, $this->dados_conexao);
				$this->$model->db = $this->load->database($this->dados_conexao, TRUE);
				$this->load->database($this->dados_conexao, null, TRUE);
				return true;
			} catch (Exception $e) {
				echo $e;
				return false;
			}
		}

		function iframe()
		{
			$url = $_REQUEST['url'];
			if ($this->uri->segment(2)) {
				$tpl = $this->uri->segment(2);
				$iframe = file_get_contents($url);
				$this->smarty->assign('iframe', $iframe);
				$this->model_smarty->render_tpl("iframes/$tpl", $this->app->Template_txf);
			} else {
				echo file_get_contents($url);
			}


			die();
		}

		function configura_idioma($idioma = null)
		{

			if (!$idioma) {
				$idioma = $this->uri->segment($this->app->Segmento_padrao_txf - 1);
			}

			if (!$this->app->Idioma_padrao_txf) {
				$idioma_navegador = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);

				switch ($idioma_navegador) {
					case 'pt':
						$this->app->Idioma_padrao_txf = 'br';

						break;
					case 'en':
						$this->app->Idioma_padrao_txf = 'en';
						break;
					default:
						$this->app->Idioma_padrao_txf = 'en';
						break;
				}
			}

			switch ($idioma) {
				case 'pt-br':
					$this->idioma = 'pt-br';
					$this->nome_idioma = 'Português';

					break;
				case 'br':
					$this->idioma = 'br';
					$this->nome_idioma = 'Português';

					break;
				case 'it':
					$this->idioma = 'it';
					$this->nome_idioma = 'Italiano';
					break;
				case 'en':
					$this->idioma = 'en';
					$this->nome_idioma = 'English';
					break;
				case 'es':
					$this->idioma = 'es';
					$this->nome_idioma = 'Español';
					break;
				case 'de':
					$this->idioma = 'de';
					$this->nome_idioma = 'Deutsch';
					break;
				case 'liberar':
					$this->liberar();
					break;

				default:
					$this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf - 1);
					redirect($this->app->Url_cliente . $this->app->Idioma_padrao_txf . '/' . $this->pagina_atual);
					break;
			}


			$arquivo_textos = (COMMONPATH . "../templates/{$this->app->Template_txf}/idiomas/{$this->idioma}.php");

			if (file_exists($arquivo_textos)) {
				include($arquivo_textos);
				$this->smarty->assign('texto', $texto);
			}

			$this->app->Url_atual = $this->app->Url_cliente . $this->idioma . '/';
			$this->smarty->assign('app', $this->app);
			$this->smarty->assign('assets', $this->app->Url_cliente . $this->app->Pasta_assets);
			$this->smarty->assign('painel', $this->app->Url_cliente . $this->app->Pasta_painel);
			$this->session->set_userdata('idioma', $this->idioma);
			$this->smarty->assign('idioma', $this->idioma);
		}

		function checa_login($pagina_atual = null)
		{
			//        ver($this->app->Lands_id);
			if (!isset($this->session->userdata['usuario'])) {

				if ($pagina_atual) {
					redirect("login?redirect_link={$pagina_atual}");
				} else {
					redirect("login");
				}
			} else {
				$this->smarty->assign('usuario_logado', $this->session->userdata['usuario']);
				return true;
			}
		}

		function liberar()
		{

			$ips = IP_LANDS;
			$ips = $ips . ',' . $_SERVER['REMOTE_ADDR'];
			$dados['Filtro_ip_txf'] = $ips;
			$this->model_banco->updateTable('apps', $dados, 'Lands_id', $this->app->Lands_id);
		}

		function fazer_busca($tabelas = null, $valor = null)
		{
			if (!$tabelas) {
				$tabelas = $_REQUEST['Tabelas_txf'];
			}
			if (!$valor) {
				$valor = $_REQUEST['valor'];
			}
			if (!isset($tabelas)) {

				redirect($this->app->Url_cliente);
				ver('Você deve definir as tabelas no qual a busca será feita');
				die();
			}

			$tabelas = explode(',', $tabelas);
			$limite = null;
			$campos = null;
			if ($_REQUEST['Campos_txf']) {
				$campos = explode(',', $_REQUEST['Campos_txf']);
				//            $campos[] = $_REQUEST['Campos_txf'];
			}

			if ($_REQUEST['Limite_txf']) {
				$limite = $_REQUEST['Limite_txf'];
			}
			$this->conecta_mbc($this->app->Conexoes_for);

			if ($_REQUEST['codificacao'] == 'html') {
				$valor = htmlentities($valor);
			}

			foreach ($tabelas as $tabela) {


				$resultado[$tabela] = $this->mbc->get_busca($tabela, $valor, $limite, $campos);
			}

			$this->smarty->assign('resultado', $resultado);
			return $resultado;
		}

		function logout()
		{
			if (isset($_REQUEST['redirect_link'])) {
				redirect('login/logout?redirect_link=' . $_REQUEST['redirect_link']);
			} else {
				redirect('login/logout');
			}
		}

		/**
		 * Verifica a segurança do site
		 *
		 * @access  public
		 * @param
		 * @return
		 */
		function verifica_seguranca()
		{


			$teste_ab = rand(1, 2);
			$this->smarty->assign('teste_ab', $teste_ab);

			//            foreach ($feriados as $feriado){
			//             $result[]=arruma_data($feriado);
			//            }
			// verifica se ja foi definido o ID E SENHA DO APP
			(defined('LANDS_ID')) or exit('LANDS_ID NAO FOI DEFINIDO');
			(defined('LANDS_PASS')) or exit('LANDS_PASS NAO FOI DEFINIDO');
			$this->smarty->assign('_SERVER', $_SERVER);

			$this->load->model('model_seguranca');

			// verifica se o app esta cadastrado na tabela de apps da do banco de dados lands_core..
			// caso nao esteja ativo mata a aplicacao;
			//configura os atributos do objeto app....

			$this->app = $this->model_seguranca->verifica_ativacao(LANDS_ID, LANDS_PASS);

			//   $this->app->Dispositivo=get_device();
			// nao misturar as sessões...
			if ($this->app->Sessao_privada_sel == 'SIM') {


				//        if (is_lands()) {
				if (isset($this->session->userdata['usuario'])) {
					if (is_object($this->session->userdata['usuario'])) {
						if ($this->session->userdata['usuario']->app != $this->app->Lands_id) {
							$this->session->unset_userdata('usuario');
						}
					}
					if (is_array($this->session->userdata['usuario'])) {
						if ($this->session->userdata['usuario']['app'] != $this->app->Lands_id) {
							$this->session->unset_userdata('usuario');
						}
					}
				}
				//        }
			}


			/* MANTER TODOS OS SITES DESABILITADOS, HABILITAR SOMENTE QUANDO NECESSÁRIO FAZSER ALGUMA ANÁLISE */
			if ($this->app->Grava_acesso_sel == 'SIM') {
				$this->model_seguranca->grava_acesso($this->app);
			}
			//


			if (isset($this->app->Url_curl_txf)) {
				if ($this->app->Url_curl_txf != '') {
					$this->app->Url_cliente_real = $this->app->Url_cliente;
					$this->app->Url_cliente = $this->app->Url_curl_txf;
				}
			}

			$this->cliente = $this->model_seguranca->busca_dados_cliente($this->app->Clientes_for);

			$this->model_banco->inicializa(array('app' => $this->app, 'cliente' => $this->cliente));
			$this->model_smarty->inicializa($this->app, $this->cliente);

			// ver($this->cliente);
			//analisa o tipo de app para tomar para iniciar a execucao;
			$vars[] = $this->model_seguranca->analisa_tipo($this->app->Tipo_app_sel);
			$this->assign_vars();


			if ($this->uri->segment(1)) {
				switch ($this->uri->segment(1)) {
					case 'liberar':
						$this->liberar();
						redireciona($this->app->Url_cliente);
						break;
					//                case 'layout':
					//                    $this->layout();
					//                    break;
				}
			}
			//app multilinguagem
			if ($this->uri->segment(2)) {
				switch ($this->uri->segment(2)) {
					case 'liberar':
						$this->liberar();

						redireciona($this->app->Url_cliente);
						break;
					//                case 'layout':
					//                    $this->layout();
					//                    break;
				}
			}


			$vars[] = $this->model_seguranca->verifica_estado_do_site($this->app);
			if ($this->app->Estado_sel == 'UPDATE' && is_lands()) {
				if ($this->app->Template_dev_txf == '') {
					die('pasta template dev em branco');
				}
				$this->app->Template_txf = $this->app->Template_dev_txf;
			}
			$this->conecta_mbc($this->app->Conexoes_for, true);
			$this->vars = $vars;
			$this->assign_vars();
			//assign nas variaves da classe e do app;
		}

		/**
		 * Assina as principais variáveis
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function assign_vars($vars = null)
		{

			if (isset($this->uri->segments[1])
				&& $this->uri->segments[1] == $this->app->Linguagem_banco_sel) {
				unset($this->uri->segments[1]);
				$this->uri->segments = array_filter(array_merge(array(0), array_values($this->uri->segments)));
			} else {
				if (array_search($this->uri->segments[1], array_keys(lista_linguagens())) !== false) {
					redirect($this->app->Url_cliente . $this->app->Linguagem_banco_sel);
				}
			}

			$url_atual = $this->app->Url_cliente;

			$segmentos = $this->uri->segments;
			foreach ($segmentos as $segmento) {
				$url_atual .= $segmento . '/';
			}

			$this->smarty->assign('url_atual', $url_atual);
			$this->smarty->assign('url_cliente_linguagem', $this->app->Url_cliente_linguagem);
			//assign no base_url antes dos outros pois vai ser utilizado na compilação.
			$this->smarty->assign('base_url', base_url());
			$this->smarty->assign('IP_LANDS', IP_LANDS);
			//utilizada pelo felipe para definir o base _url....
			$arqs = 'http://assets.lands.net.br/' . $this->app->Pasta_assets;
			$this->smarty->assign('site_lands', 'http://landsagenciaweb.com.br/');
			$this->smarty->assign('Pasta_assets', $arqs);
			$this->smarty->assign('url_arquivos', $arqs);
			$this->smarty->assign('app', $this->app);
			$this->smarty->assign('assets', $this->app->Url_cliente . $this->app->Pasta_assets);
			$this->smarty->assign('painel', $this->app->Url_cliente . $this->app->Pasta_painel);
			$this->smarty->assign('cliente', $this->cliente);
			$this->smarty->assign('vars', $this->vars);
			$this->smarty->assign('sessao', $this->session->all_userdata());
			//        ver($_SESSION);
			if (!isset($_SESSION)) {
				session_start();
			}
			$this->smarty->assign('sessao_nativa', $_SESSION);
			$caminho = $this->app->Url_cliente . $this->app->Pasta_painel . '/';
			$this->smarty->assign('caminho', $caminho);
			$this->smarty->assign('data', date("d/m/Y"));
			$this->smarty->assign('dia_semana_hoje', diasemana(date("Y-m-d")));
			//            ver(diasemana(date("Y-m-d")));
			$this->smarty->assign('dia_hoje', date("d"));
			$this->smarty->assign('mes_atual', date("m"));
			$this->smarty->assign('ano', date("Y"));
			$this->smarty->assign('eh_feriado', eh_feriado());
			$this->smarty->assign('ci_session', $this->session->all_userdata());

			$this->smarty->assign('server_name', '//' . $_SERVER['SERVER_NAME'] . '/');

			if (isset($_POST)) {
				$this->smarty->assign('post', $_POST);
			}
			if (isset($this->session->userdata['usuario'])) {
				$this->smarty->assign('usuario', $this->session->userdata['usuario']);
			}
			$this->smarty->assign('ip_cliente', $_SERVER['REMOTE_ADDR']);
			$this->smarty->assign('COMMONPATH', COMMONPATH);
			$caminho_tpl = COMMONPATH . '../templates/' . $this->app->Template_txf . '/';
			$this->smarty->assign('CAMINHO_TPL', $caminho_tpl);

			$templates = COMMONPATH . '../templates/';
			$this->smarty->assign('TEMPLATES', $templates);

			if ($this->uri->segment($this->app->Segmento_padrao_txf)) {
				$this->smarty->assign('pagina_atual', $this->uri->segment($this->app->Segmento_padrao_txf));
				$this->pagina_atual = $this->uri->segment($this->app->Segmento_padrao_txf);
			} else {
				$this->smarty->assign('pagina_atual', $this->app->Pagina_inicial_txf);
				$this->pagina_atual = $this->app->Pagina_inicial_txf;
			}
			$this->pagina_atual = strtolower($this->pagina_atual);

			// monta o segmento 2 e segmento 3
			//atualizado em 05/08/2014
			if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
				$this->smarty->assign('segment2', $this->uri->segment($this->app->Segmento_padrao_txf + 1));
			} else {
				$this->smarty->assign('segment2', '');
			}
			if ($this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
				$this->smarty->assign('segment3', $this->uri->segment($this->app->Segmento_padrao_txf + 2));
			} else {
				$this->smarty->assign('segment3', '');
			}
			if ($this->uri->segment($this->app->Segmento_padrao_txf + 3)) {
				$this->smarty->assign('segment4', $this->uri->segment($this->app->Segmento_padrao_txf + 3));
			} else {
				$this->smarty->assign('segment4', '');
			}
			if ($this->uri->segment($this->app->Segmento_padrao_txf + 4)) {
				$this->smarty->assign('segment5', $this->uri->segment($this->app->Segmento_padrao_txf + 4));
			} else {
				$this->smarty->assign('segment5', '');
			}


			if ($_REQUEST) {
				$this->smarty->assign('requisicao', $_REQUEST);
			}


			// _template = pasta dentro da view que sera assigbada
			//  $this->_template = $this->app->Template_txf;

			if (isset($vars)) {
				foreach ($vars as $key => $value) {
					$this->smarty->assign($key, $value);
				}
			}

			foreach ($this->app as $key => $value) {
				$this->smarty->assign($key, $value);
			}
		}

		function importar_conexoes_painel($id_cliente = null)
		{
			//buscar_via_ws;
		}

		/**
		 * Carrega página do sistema
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function carrega_pagina($nome_pagina = null, $tipo = 'pagina')
		{

			if (!isset($nome_pagina)) {
				$nome_pagina = $this->pagina_atual;
			}
			$nome_pagina = strtolower($nome_pagina);
			//funcao chamada pela classe filha.... (core_main)..
			//carrega os dados necessários para exibicao da página...
			//ver($nome_pagina);
			$this->tipo = $tipo;
			$this->carrega_dados($nome_pagina, $tipo);
			$this->switch_pagina();
			$this->executa_seo();
			//ver($this->pagina_atual);
			$this->model_smarty->render($this->pagina_atual, $this->app->Template_txf);
		}

		function executa_seo()
		{

			$this->conecta_mbc($this->app->Conexoes_for);
			if ($this->mbc->tabelaexiste('seo')) {

				$dados_seo = $this->mbc->buscar_tudo("seo", "where Pagina_txf='{$this->pagina_atual}' and Ativo_sel='SIM'");

				if (!isset($dados_seo[0])) {
					$dados_seo = $this->mbc->buscar_tudo("seo", "where Pagina_txf='default' and Ativo_sel='SIM'");
				}

				if ($dados_seo[0]) {

					foreach ($dados_seo as $seo) {
						foreach ($seo as $key => $value) {
//                        ver($value,1);
							$seo->$key = $this->smarty->fetch("string:{$value}");
						}
					}
					$dados_seo[0]->Titulo_sma = trim(strip_tags($seo->Titulo_sma, '<(.*?)>'));
					$dados_seo[0]->Descricao_sma = trim(strip_tags($seo->Descricao_sma, '<(.*?)>'));
					$dados_seo[0]->Imagem_sma = trim(strip_tags($seo->Imagem_sma, '<(.*?)>'));
				} else {
					$dados_seo[0]->Titulo_sma = $this->app->Titulo_txf;
					$dados_seo[0]->Descricao_sma = $this->app->Descricao_txf;
				}

				$dados_seo_final = $this->mbc->complementa_registros($dados_seo, 'seo');

				/* CRIA AS VARIAVEIS FINAL DO SEO */
				$descricao = trim(strip_tags($dados_seo_final[0]->Descricao_sma, '<(.*?)>'));
				$this->smarty->assign('descricao', $descricao);

				$social_titulo = trim(strip_tags($dados_seo_final[0]->Titulo_sma, '<(.*?)>'));
				$this->smarty->assign('social_titulo', $social_titulo);

				//ver($dados_seo_final);
				if ($dados_seo_final[0]->Imagens[0]->Caminho_txf) {
					$social_imagem = $this->app->Url_cliente . $this->app->Pasta_painel . $dados_seo_final[0]->Imagens[0]->Caminho_txf;
					$dados_seo_final[0]->Imagem_sma = $social_imagem;
				} else {
					$social_imagem = "{$dados_seo_final[0]->Imagem_sma}";
				}

				$this->smarty->assign('social_imagem', $social_imagem);
				$this->smarty->assign('seo', $dados_seo_final[0]);
			}
		}

		function conecta_ftp($id_conexao)
		{


			if ($id_conexao) {
				$conexao_ftp = $this->model_banco->executa_sql("select * from conexoes_ftp where Id_int=$id_conexao");

				if (!$conexao_ftp[0]) {
					die('dados para conexao ftp nao encontrado');
				}
				$this->load->library('ftp');
				$config['hostname'] = $conexao_ftp[0]->Servidor_txf;
				$config['username'] = $conexao_ftp[0]->Usuario_txf;
				$config['password'] = $conexao_ftp[0]->Senha_txf;

				$this->configuracoes_ftp = $conexao_ftp[0];
				$config['debug'] = FALSE;
				return $this->ftp->connect($config);
			} else {
				//            die('conecta ftp sem id de conexao');
				return false;
			}
		}

		function ativar_senha()
		{

			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);

			if (!isset($_REQUEST['Tabela_txf']))
				die('funcao cadastrar necessita Tabela_txf como parametro');
			$tabela = $_REQUEST['Tabela_txf'];
			//verifica usuario ja cadastrado;

			$dados = $_REQUEST;
			$dados['Senha_txp'] = $_REQUEST['Senha_txp'];
			//se nao encontrar, cadastra, senao retorna erro.
			$this->conecta_mbc($this->app->Conexoes_for);

			$gravou = $this->mbc->updateTable($tabela, $dados, 'Id_int', $dados['Id_int']);
			$this->session->set_userdata('senha_temporaria', $dados['Senha_temp_txf']);
			$this->session->set_userdata('email', $dados['Email_txf']);
			redirect('/login');
		}

		function switch_pagina()
		{
			$this->smarty->assign('titulo_pagina', ucfirst($this->pagina_atual));

			switch ($this->pagina_atual) {
				case 'busca':
					//                ver('chegou');
					$this->fazer_busca();
					break;
			}
		}

		function carrega_queries_face($nome_pagina = null)
		{
			if (!isset($nome_pagina)) {
				$nome_pagina = $this->pagina_atual;
			}


			//     $meus_dados = $this->lands_fb->buscar('me', 'feed');
			//

			$queries = $this->model_banco->buscar_tudo("queries_fb where (Pagina_txf='{$this->pagina_atual}' or Pagina_txf='default') and (Lands_id='{$this->app->Lands_id}') and (Ativo_sel='SIM')");
			//        $queries = $this->model_banco->buscar_tudo("queries_fb where $this->clausula_exibicao_paginas");


			if (isset($queries[0]->Id_int)) {
				$this->load->library('lands_fb', $this->app);
				foreach ($queries as $query) {
					$limite = '';

					switch ($query->Api_sel) {
						case 'GRAPH_API':

							if ($query->Limite_txf != '') {
								$limite = '?limit=' . $query->Limite_txf;
							}

							$resposta = $this->lands_fb->get($query->Id_objeto_txf, $query->Item_txf . $limite);
							break;
						case 'FQL':
							$consulta = str_replace('{fbuser}', $this->fbuser, $query->Fql_txa);
							$resposta = $this->lands_fb->api(array('method' => 'fql.query', 'query' => $consulta));


							break;
					}


					$resposta = array_to_object($resposta);
					$this->smarty->assign($query->Variavel_txf, $resposta);
				}
			}
		}

		/**
		 * Carrega página do sistema
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function carrega_dados($pagina_atual = '', $tipo = 'pagina')
		{

			if ($pagina_atual != '') {
				$this->pagina_atual = $pagina_atual;
			}

			//(Tipo_sel='{$tipo}' or Tipo_sel='default') and

			$this->smarty->assign('url', $this->uri);
			// clausula where padrao utilizada para arbir as views pela queries e paginas_dados
			$this->clausula_exibicao_paginas = " (Tipo_sel='{$tipo}' or Tipo_sel='default') and (FIND_IN_SET('{$this->pagina_atual}', Pagina_txf) or Pagina_txf='default') and (Lands_id='{$this->app->Lands_id}') and (Ativo_sel='SIM') ;";

			//procura na tabela queries quais queries deverao ser executadas
			$dados['query'] = "queries where $this->clausula_exibicao_paginas";

			$consulta_sql = $this->model_banco->buscar_tudo($dados['query']);

			//        ver($this->uri,1);
			//        ver($consulta_sql);
			//pega as conexoes do cliente e faz as querias
			//        ver(      $this->clausula_exibicao_paginas);
			if (isset($consulta_sql[0]->Id_int)) {
				$this->consultas = $consulta_sql;
				// trata a query e segue em frente executando e já fazendo o assign no smarty;
				//$objetos = $this->realiza_consultas($this->consultas);

				$this->realiza_consultas($this->consultas);

				//   $this->app->objetos = $objetos;
			}
			//  ver($this->app);
			//  die('nao obteve resultados para' . $dados['sql_usada']);
			//               ver('ta aki');


			$this->load->database('default', null, true);

			if (isset($this->app->fb_app_ID) && ($this->app->fb_secret)) {

				//            $this->carrega_queries_face($pagina_atual);
			}

			//            ver($this->pagina_atual);
			//comentado por VEDANA em 12/03/2015
			//  if ($this->pagina_atual != 'login') {

			$dados['templates'] = "blocos where (Pagina_txf='{$this->pagina_atual}' or Pagina_txf='default') and (Lands_id='{$this->app->Lands_id}') and (Ativo_sel='SIM')";
			$ob = $this->model_banco->buscar_tudo($dados['templates']);
			if (isset($ob[0]->Id_int)) {

				foreach ($ob as $templates) {

					if ($templates->Tipo_sel == 'VIRTUAL') {
						$this->smarty->assign($templates->Variavel_txf, $this->smarty->fetch("string:{$templates->Conteudo_txa}"));
					}
					if ($templates->Tipo_sel == 'TPL') {
						$this->model_smarty->carrega_bloco($templates->Variavel_txf, $templates->Arquivo_tpl_txf, $this->app->Template_txf);
					}
				}
			}

			$this->smarty->assign('app', $this->app);
			$this->smarty->assign('assets', $this->app->Url_cliente . $this->app->Pasta_assets);
			$this->smarty->assign('painel', $this->app->Url_cliente . $this->app->Pasta_painel);

			if ($tipo == 'ajax') {
				$arquivo = COMMONPATH . "../templates/{$this->app->Template_txf}/ajax/{$pagina_atual}.tpl";
				$arquivo = str_replace("//", "/", $arquivo);

				if (file_exists($arquivo)) {
					$this->model_smarty->render_ajax($pagina_atual, $this->app->Template_txf);
					die();
				} else {
					//                echo "arquivo inexistente";
				}
			}
		}

		// -------------------------------------------------------------------------

		/**
		 * Salva um array no arquivo pagseguro...php em cache/
		 * @param type $array
		 */
		public function grava_log($array = null)
		{
			if ($this->app->Grava_log_sel == 'SIM') {
				$data = array();
				$data[] = 'Lands_id: ' . $this->app->Lands_id;
				$data[] = 'Pagina_atual: ' . $this->pagina_atual;
				if (isset($this->usuario_logado)) {
					if (isset($this->usuario_logado->Nome_txf)) {
						$data[] = 'Usuario: ' . $this->usuario_logado->Nome_txf;
					}
				}
				if (isset($this->usuario)) {
					if (isset($this->usuario->Nome_txf)) {
						if ($this->usuario->Nome_txf) {
							$data[] = 'Usuario: ' . $this->usuario->Nome_txf;
						}
					}
					if (isset($this->usuario->Nome_fantasia_txf)) {
						if ($this->usuario->Nome_fantasia_txf) {
							$data[] = 'Usuario: ' . $this->usuario->Nome_fantasia_txf;
						}
					}
				}
				$data[] = 'Ip_usuario: ' . $_SERVER['REMOTE_ADDR'];
				$data[] = 'Horário: ' . date("Y-m-d_h_i_s");
				if (isset($array)) {
					if (is_array($array)) {
						foreach ($array as $c => $v) {
							$data[] = $c . ': ' . $v;
						}
					}
				}
				$data[] = '-------------------------------------';
				$output = implode("\n", $data);
				$this->load->helper('file');
				write_file(COMMONPATH . "logs/" . $this->app->Lands_id . "_" . date("Y-m-d_h_i_s") . ".txt", $output);
			}
		}

		/**
		 * Faz as queries do banco de dados
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function realiza_consultas($conteudo_sql)
		{

			$resultados = array();

			foreach ($conteudo_sql as $query) {
				//                  $sql = $this->trata_sql($query->Consulta_sql_txf);
				if ($this->uri->segment(1)) {
					$consulta = str_replace('{segment1}', str_replace(" ", " ", $this->uri->segment(1)), $query->Consulta_sql_txf);
				} else {
					$consulta = str_replace('{segment1}', str_replace(" ", " ", $this->app->Pagina_inicial_txf), $query->Consulta_sql_txf);
				}

				$consulta = str_replace('{segment2}', str_replace(" ", " ", $this->uri->segment(2)), $consulta);
				$consulta = str_replace('{segment3}', str_replace(" ", " ", $this->uri->segment(3)), $consulta);
				$consulta = str_replace('{segment4}', str_replace(" ", " ", $this->uri->segment(4)), $consulta);

				if (isset($this->idioma)) {
					$consulta = str_replace('{idioma}', $this->idioma, $consulta);
				}
				if ($this->app->Multilinguagem_sel == 'SIM') {
					$query->Conexoes_for = $this->app->Conexoes_for;
				};
				$this->conecta_mbc($query->Conexoes_for);

				//LINHA MARAVILHOSA QUE PERMITE UTILIZAR VARIÁVEIS BUSCADAS ANTERIORMENTE NAS QUERIES, E PERMITE SMARTY NAS QUERIES
				$consulta = $this->smarty->fetch("string: {$consulta}");
//            if ($this->app->Lands_id == 'quiron') {
//                ver($consulta);
//            }
				$resultados[] = $this->executa_sql('mbc', $query, $consulta);
			}


			return $resultados;
		}

		function carrega_mbc($id_conexao)
		{
			$this->conecta_mbc($id_conexao);
		}

		/**
		 * Conecta ao banco do cliente
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function conecta_mbc($id_conexao = null, $primeira_conexao = false)
		{
//			/error_reporting(E_ALL);
			if (isset($id_conexao)) {

				//utilizada para o metodo load_data(consultas_etc)
				$con = $this->model_banco->executa_sql("select * from conexoes where Id_int =$id_conexao");

			} else {
				//  die('sem id da conexao');
				//utilizada nos metodos de post, onde não há o Id da conexao
				ver('conecta_mbc sem id de conexao');
				$con = $this->model_banco->executa_sql("select * from conexoes where Id_cliente_int =" . $this->app->Cliente_id);
			}


			if (isset($con[0])) {
				$this->dados_conexao = $this->config_conexao_cliente($con[0]);
			} else {
				echo '..... Nao encontrou conexoes para o cliente.';
			}

			if (isset($this->mbc->db)) {
				if ($this->dados_conexao['database'] != $this->mbc->db->database) {
					$this->mbc = $this->load->model('model_banco_cliente', 'mbc', $this->dados_conexao);
					$this->mbc->db = $this->load->database($this->dados_conexao, TRUE);
					$this->mbc->seta_idioma('pt_BR');
				}
			} else {

				$this->mbc = $this->load->model('model_banco_cliente', 'mbc', $this->dados_conexao);
				$this->mbc->db = $this->load->database($this->dados_conexao, TRUE);
				$this->mbc->seta_idioma('pt_BR');
			}

			return $this->dados_conexao;
		}

		/**
		 * Carrega página do sistema
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function config_conexao_cliente($obj)
		{
			//busca na tabela conexoes do banco lands_core.
			//cria conexao com a base de dados do cliente baseado nos dados da tabela conexoes;
			$this->conexao_cliente = array(
				'hostname' => $obj->Servidor_txf,
				'username' => $obj->Usuario_txf,
				'password' => $obj->Senha_txp,
				'database' => $obj->Database_txf,
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
			return $this->conexao_cliente;
		}

		/**
		 * Executa SQL
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function executa_sql($model = 'mbc', $query, $filtro_sql)
		{

			if ($model == 'mbc') {


				//analisa os segmentos 2 e 3
				//            if (!intval($this->uri->segment($this->app->Segmento_padrao_txf + 1))) {
				if (isset($query->Segment2_txf)) {
					if ($query->Segment2_txf != '') {


						$achou = false;
						if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
							$achou = true;
							$consulta = str_replace('{segment2}', str_replace(" ", " ", urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1))), $query->Segment2_txf);
							//                                       $consulta = str_replace('{segment2}', str_replace("_", " ", urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1))), $query->Segment2_txf);
							$this->smarty->assign('segment2', urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1)));
						}
						if ($achou) {

							$filtro_sql .= " and " . $consulta;
						}
					}
				}
				//            }
				//            if (!intval($this->uri->segment($this->app->Segmento_padrao_txf + 2))) {
				if (isset($query->Segment3_txf)) {
					if ($query->Segment3_txf != '') {
						$achou2 = false;
						if ($this->uri->segment($this->app->Segmento_padrao_txf + 2)) {
							$achou2 = true;
							$consulta2 = str_replace('{segment3}', str_replace(" ", " ", urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2))), ($query->Segment3_txf));
							//                                    $consulta2 = str_replace('{segment3}', str_replace("_", " ", urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2))), ($query->Segment3_txf));
							$this->smarty->assign('segment3', urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2)));
						}
						if ($achou2) {
							$filtro_sql .= " and " . $consulta2;
						}
					}
				}

				if (isset($query->Segment4_txf)) {
					if ($query->Segment4_txf != '') {
						$achou2 = false;
						if ($this->uri->segment($this->app->Segmento_padrao_txf + 3)) {
							$achou2 = true;
							$consulta2 = str_replace('{segment4}', str_replace(" ", " ", urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 3))), ($query->Segment4_txf));
							//                                    $consulta2 = str_replace('{segment3}', str_replace("_", " ", urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 2))), ($query->Segment3_txf));
							$this->smarty->assign('segment4', urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 3)));
						}
						if ($achou2) {
							$filtro_sql .= " and " . $consulta2;
						}
					}
				}
				//            }

				switch ($query->Metodo_txf) {
					case 'SQL':
						if (isset($query->Group_by_txf)) {
							if ($query->Group_by_txf != '') {
								$var = str_replace('GROUP BY', '', $query->Group_by_txf);
								$var = str_replace('Group by', '', $var);
								$var = str_replace('group by', '', $var);
								$filtro_teste = str_replace('group by', '', $filtro_sql);
								$filtro_teste = str_replace('Group by', '', $filtro_teste);
								$filtro_teste = str_replace('GROUP BY', '', $filtro_teste);

								if ($filtro_teste == $filtro_sql) {
									$filtro_sql .= " group by " . $var;
								}
							}
						}

						if (isset($query->Order_by_txf)) {
							if ($query->Order_by_txf != '') {
								$var = str_replace('ORDER BY', '', $query->Order_by_txf);
								$var = str_replace('Order by', '', $var);
								$var = str_replace('order by', '', $var);
								$filtro_teste = str_replace('order by', '', $filtro_sql);
								$filtro_teste = str_replace('Order by', '', $filtro_teste);
								$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

								if ($filtro_teste == $filtro_sql) {
									$filtro_sql .= " order by " . $var;
								}
							}
						}

						$qr = $query->Tabela_txf . '  ' . $filtro_sql;
						//                    if(is_lands()){
						//                        if($query->Tabela_txf=='produtos'){
						//                            ver($qr,1);
						//                        }
						//                    }

						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($qr, 1);
						}
						$valor = $this->mbc->buscar_tudo($qr, null, $query->Campos_txf);


						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}


						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;
					case 'SQL MANUAL':

						if (isset($query->Order_by_txf)) {
							if ($query->Order_by_txf != '') {
								$var = str_replace('ORDER BY', '', $query->Order_by_txf);
								$var = str_replace('Order by', '', $var);
								$var = str_replace('order by', '', $var);
								$filtro_teste = str_replace('order by', '', $filtro_sql);
								$filtro_teste = str_replace('Order by', '', $filtro_teste);
								$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

								if ($filtro_teste == $filtro_sql) {
									$filtro_sql .= " order by " . $var;
								}
							}
						}


						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($filtro_sql, 1);
						}

						$valor = $this->mbc->executa_sql($filtro_sql);


						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}

						//     $this->load->database($query->Base_dados_txf, TRUE);


						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'PAGINACAO':
						// $this->load->database($query->Base_dados_txf, TRUE);
						$valor = $this->mbc->valores_paginacao_generic($this->app, $this->pagina_atual, $query->Tabela_txf, $filtro_sql, (intval($this->uri->segment(2) > 0)) ? intval($this->uri->segment(2)) : '1', $query->Qtde_registro_pagina_txf);
						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}


						$this->smarty->assign($query->Variavel_txf, $valor);
						break;
					case 'PAGINACAO CATEGORIA':
						// $this->load->database($query->Base_dados_txf, TRUE);

						foreach ($this->uri->segments as $key => $segmento) {
							if (intval($segmento)) {
								$numero_segmento = $key;
							}
						}
						if ($numero_segmento) {
							$categoria = '/';
							$categoria .= $this->uri->segment($numero_segmento - 1);
						} else {
							$categoria = '/';
							$categoria .= $this->uri->segment(2);
						}
						$page = str_replace("//", "/", $this->pagina_atual . $categoria);
						$valor = $this->mbc->valores_paginacao_categoria($this->app, $page, $query->Tabela_txf, $filtro_sql, (intval($this->uri->segment($numero_segmento) > 0)) ? intval($this->uri->segment($numero_segmento)) : '1', $query->Qtde_registro_pagina_txf);
						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'PAGINACAO C/ SUBCATEGORIA':
						//         $this->load->database($query->Base_dados_txf, TRUE);
						$valor = $this->mbc->valores_paginacao_generic_categoria($query->Tabela_txf, $filtro_sql, (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $query->Qtde_registro_pagina_txf);

						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'IMAGENS E CONTEUDO':
						//       $this->load->database($query->Base_dados_txf, TRUE);
						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}

						$valor = $this->mbc->buscar_desc_imagens($query->Tabela_txf, $filtro_sql);
						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'REGISTRO_IMAGENS_VIDEOS':
						//       $this->load->database($query->Base_dados_txf, TRUE);
						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}


						$valor = $this->mbc->buscar_registro_imagens_videos($query->Tabela_txf, $filtro_sql);
						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'BUSCAR_COMPLETO_VIN':

						//       $this->load->database($query->Base_dados_txf, TRUE);
						if (isset($query->Group_by_txf)) {
							if ($query->Group_by_txf != '') {
								$var = str_replace('GROUP BY', '', $query->Group_by_txf);
								$var = str_replace('Group by', '', $var);
								$var = str_replace('group by', '', $var);
								$filtro_teste = str_replace('group by', '', $filtro_sql);
								$filtro_teste = str_replace('Group by', '', $filtro_teste);
								$filtro_teste = str_replace('GROUP BY', '', $filtro_teste);

								if ($filtro_teste == $filtro_sql) {
									$filtro_sql .= " group by " . $var;
								}
							}
						}


						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}


						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($filtro_sql, 1);
						}
						$valor = $this->mbc->buscar_completo_vin($query->Tabela_txf, $filtro_sql, $query->Campo_imagem_txf, $query->Campos_txf);


						// BUSCA CHBS
						if ($query->Tabela_chb) {
							$tabelas = explode(",", $query->Tabela_chb);
							foreach ($tabelas as $tabela) {
								$valor = $this->busca_chbs($valor, $query->Tabela_txf, $tabela);
							}
						}


						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}

						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'SUPER_PAGINACAO':
						//       $this->load->database($query->Base_dados_txf, TRUE);
						if (isset($query->Group_by_txf)) {
							if ($query->Group_by_txf != '') {
								$var = str_replace('GROUP BY', '', $query->Group_by_txf);
								$var = str_replace('Group by', '', $var);
								$var = str_replace('group by', '', $var);
								$filtro_teste = str_replace('group by', '', $filtro_sql);
								$filtro_teste = str_replace('Group by', '', $filtro_teste);
								$filtro_teste = str_replace('GROUP BY', '', $filtro_teste);

								if ($filtro_teste == $filtro_sql) {
									$filtro_sql .= " group by " . $var;
								}
							}
						}

						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}


						$config = new stdClass();
						if ($query->Tipo_paginacao == 'URL') {
							if ($query->Segmento_paginacao_txf) {
								$base = $this->app->Url_cliente;
								foreach ($this->uri->segments as $key => $value) {
									if ($key < $query->Segmento_paginacao_txf) {
										$base .= $value . '/';
									}
								}
								$config->uri_segment = $query->Segmento_paginacao_txf;
								$config->per_page = $query->Qtde_registro_pagina_txf;
								$config->base_url = $base;
							} else {
								die('segmento paginacao eh obrigatorio');
							}
						} else {

							$base = $this->app->Url_cliente;
							foreach ($this->uri->segments as $key => $value) {
								$base .= $value . '/';
							}
							$config->per_page = $query->Qtde_registro_pagina_txf;
							$config->base_url = $base;
							$config->page_query_string = TRUE;
						}


						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($filtro_sql, 1);
						}

						if ($query->Campo_imagem_txf) {
							$campo_imagem = $query->Campo_imagem_txf;
						} else {
							$campo_imagem = null;
						}

						$valor = $this->mbc->super_paginacao($query->Tabela_txf, $filtro_sql, $config, null, $campo_imagem);


						// BUSCA CHBS
						if ($query->Tabela_chb) {
							$tabelas = explode(",", $query->Tabela_chb);
							foreach ($tabelas as $tabela) {
								$valor->registros = $this->busca_chbs($valor->registros, $query->Tabela_txf, $tabela);
							}
						}


						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}

						//                    if (isset($valor)) {
						//                        $vars[$query->Variavel_txf] = $valor;
						//                    }

						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'BUSCAR_COMPLETO':
						//       $this->load->database($query->Base_dados_txf, TRUE);
						if (isset($query->Group_by_txf)) {
							if ($query->Group_by_txf != '') {
								$var = str_replace('GROUP BY', '', $query->Group_by_txf);
								$var = str_replace('Group by', '', $var);
								$var = str_replace('group by', '', $var);
								$filtro_teste = str_replace('group by', '', $filtro_sql);
								$filtro_teste = str_replace('Group by', '', $filtro_teste);
								$filtro_teste = str_replace('GROUP BY', '', $filtro_teste);

								if ($filtro_teste == $filtro_sql) {
									$filtro_sql .= " group by " . $var;
								}
							}
						}

						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}

						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($filtro_sql, 1);
						}


						$valor = $this->mbc->buscar_completo($query->Tabela_txf, $filtro_sql, $query->Campo_imagem_txf, $query->Campos_txf);

						// BUSCA CHBS
						if ($query->Tabela_chb) {

							$tabelas = explode(",", $query->Tabela_chb);
							foreach ($tabelas as $tabela) {
								$valor = $this->busca_chbs($valor, $query->Tabela_txf, $tabela);
							}
						}


						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}

						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
//                    ver($query->Variavel_txf,1);
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'SQL MANUAL_COMPLETO':


						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($filtro_sql, 1);
						}
						$valor_temp = $this->mbc->executa_sql($filtro_sql);

						$valor = $this->mbc->complementa_registros($valor_temp, $query->Tabela_txf);


						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}

						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;

					case 'IMAGENS E CONTEUDO E CATEGORIA':

						if (!isset($this->app->Campo_categoria_txf)) {
							die('Voce deve cadastrar o campo Campo_categoria_txf para utilizar IMAGENS E CONTEUDO E CATEGORIA');
						}


						if ($this->uri->segment($this->app->Segmento_padrao_txf + 1)) {
							$categoria = urldecode($this->uri->segment($this->app->Segmento_padrao_txf + 1));
							$filtro_sql .= " and a." . $this->app->Campo_categoria_txf . "='$categoria'";
							$this->smarty->assign('categoria_escolhida', $categoria);
						}

						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}
						$valor = $this->mbc->buscar_desc_imagens($query->Tabela_txf, $filtro_sql);
						//     $this->load->database($query->Base_dados_txf, TRUE);

						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;


					case 'IMAGENS E CONTEUDO E PAGINACAO':


						if (isset($query->Order_by_txf)) {
							$var = str_replace('ORDER BY', '', $query->Order_by_txf);
							$var = str_replace('Order by', '', $var);
							$var = str_replace('order by', '', $var);
							$filtro_teste = str_replace('order by', '', $filtro_sql);
							$filtro_teste = str_replace('Order by', '', $filtro_teste);
							$filtro_teste = str_replace('ORDER BY', '', $filtro_teste);

							if ($filtro_teste == $filtro_sql) {
								$filtro_sql .= " order by " . $var;
							}
						}


						//     $this->load->database($query->Base_dados_txf, TRUE);
						$valor = $this->mbc->valores_paginacao_generic_categoria($query->Tabela_txf, $filtro_sql, (intval($this->uri->segment(3) > 0)) ? intval($this->uri->segment(3)) : '1', $query->Qtde_registro_pagina_txf);


						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;
					case 'VIDEOS E CONTEUDO':
						die('consulta com VIDEOS E CONTEUDO E PAGINACAO nao implementado ');
						//     $this->load->database($query->Base_dados_txf, TRUE);
						$valor = $this->mbc->buscar_desc_videos($query->Tabela_txf, $filtro_sql);
						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}
						$this->smarty->assign($query->Variavel_txf, $valor);
						break;
					case 'TESTE':

//                    ver($vars);
//                    foreach ($vars as $var) {
//                        $this->smarty->fetch(strins$var);
//                    }
						//     $this->load->database($query->Base_dados_txf, TRUE);

						if ($query->Debug_sel == 'SIM') {
							ver($query, 1);
							ver($filtro_sql, 1);
						}

//                    ver($filtro_sql);
						$valor = $this->mbc->buscar_completo($query->Tabela_txf, $filtro_sql);
						if (isset($valor)) {
							$vars[$query->Variavel_txf] = $valor;
						}

						if ($query->Debug_sel == 'SIM') {
							ver($valor, 1);
						}
//                    ver($valor);

						$this->smarty->assign($query->Variavel_txf, $valor);
						break;
					default:
						break;
				}
//                ver($vars);
			} else
				die('Funcao sem utilizar o model mbc nao foi implementada ate o momento. (executa_sql)');

			if ($query->Tipo_sel == 'bloco') {
				$this->smarty->assign('bloco_' . $query->Variavel_txf, $this->smarty->fetch(COMMONPATH . "../templates/{$this->_template}/blocos/{$query->Arquivo_tpl_txf}.tpl"));
			}
			if (isset($vars)) {
				return $vars;
			} else
				return ('nao encontrou respostas');
		}

		function busca_chbs($registros, $tabela1, $tabela2)
		{

			if ($this->mbc->tabelaexiste($tabela2)) {
//            ver($tabela2);
				$registro2 = array();
				foreach ($registros as $registro) {
					$nome = $tabela2;
					$registro->$nome = array();
					$sql = "select c.*  from {$tabela1} p 
                inner join checkboxes ch on ch.Id_objeto_con=p.Id_int
                inner join {$tabela2} c on ch.Id_chb_con=c.Id_int 
                where ch.Tabela_con='{$tabela1}' and ch.Tabela_chb_con='{$tabela2}' and ch.Id_objeto_con={$registro->Id_int}";

					$registro->$nome = $this->mbc->executa_sql($sql);
					$registro->$nome = $this->mbc->complementa_registros($registro->$nome, $tabela2);
					$registro2[] = $registro;
				}
				return $registro2;
			} else {
				echo "tabela $tabela2 do CHB não existe";
				return false;
			}
		}

		/**
		 * Ajax
		 *
		 * @access  public
		 * @param array
		 * @return  bool
		 */
		function ajax($params = null)
		{
			// abre as views em ajax
			//troca a base de dados para a padrao do site
			// assign nas variaveis do site.
			$this->output->enable_profiler(FALSE);

			$this->conecta_mbc($this->app->Conexoes_for);
			$this->smarty->assign('app', $this->app);
			$this->smarty->assign('assets', $this->app->Url_cliente . $this->app->Pasta_assets);
			$this->smarty->assign('painel', $this->app->Url_cliente . $this->app->Pasta_painel);
			$this->assign_vars();
			switch ($this->uri->segment(2)) {
				case 'trabalhos':
					$trab = $this->mbc->buscar_desc_imagens("trabalhos", " where a.Id_int=" . $this->uri->segment(3));
					$this->smarty->assign('tra', $trab);

					$this->model_smarty->render_ajax('trabalhos_detalhes', $this->app->Template_txf);
					break;

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
				case 'lojas':
					$id_loja = $this->uri->segment(3);

					$lojas = $this->mbc->buscar_completo("lojas", "where Id_int={$id_loja}");
					foreach ($lojas as $loja) {
						$loja->Servicos = $this->mbc->executa_sql("select c.*,ps.Nome_txf from checkboxes c
                                                                left outer join produtos_servicos ps on ps.Id_int=c.Id_chb_con
                                                                where c.Id_objeto_con={$id_loja} and c.Tabela_chb_con='produtos_servicos' order by ps.Nome_txf");
					}


					$this->smarty->assign('lojas', $lojas);
					$this->model_smarty->render_ajax('loja', $this->app->Template_txf);

					break;

				case 'produtos':
					$id_produto = $this->uri->segment(3);
					$produtos = $this->mbc->buscar_completo("produtos", "where Id_int={$id_produto}");
					$this->smarty->assign('produtos', $produtos);
					$this->model_smarty->render_ajax('produto', $this->app->Template_txf);

					break;

				case 'imagem':
					$id_img = $this->uri->segment(3);
					$imagens = $this->mbc->buscar_tudo("imagens", "where Id_int={$id_img}");


					$tabela = $imagens[0]->Tabela_con;
					$id_registro = $imagens[0]->Id_imagem_con;

					$registro = $this->mbc->buscar_completo($tabela, "where Id_int={$id_registro}");


					$relacionados = $this->mbc->buscar_completo("banco_imagens", "where Marca_sel='{$registro[0]->Marca_sel}' and Colecao_txf='{$registro[0]->Colecao_txf}' and Ativo_sel='SIM'");


					$this->smarty->assign('relacionados', $relacionados);

					$this->smarty->assign('registro', $registro);
					$this->smarty->assign('imagens', $imagens);
					$this->model_smarty->render_ajax('imagem', $this->app->Template_txf);

					break;
				default:
					die('caiu no default');
					break;
			}
		}

	}

