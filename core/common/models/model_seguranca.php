<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once('model_banco_basico.php');

	class Model_seguranca extends model_banco
	{

		function __construct()
		{
			parent::__construct();
		}

		/**
		 * Initialize the user preferences
		 *
		 * Accepts an associative array as input, containing display preferences
		 *
		 * @access  public
		 * @param array  config preferences
		 * @return  void
		 */
		function verifica_ativacao($lands_id = null, $lands_pass = null)
		{

			//ve se o aplicativo está ativo no sistema.
			if (!isset($lands_id)) {
				die('Funcao verifica_ativacao necessita de parametro $lands_id do cliente.');
			}
			if (!isset($lands_pass)) {
				die('Funcao verifica_ativacao necessita de parametro $lands_pass do cliente.');
			}

			//carrega o banco de dados lands_core
			$this->load->database('default', null, true);

			//carrega os models com a nova conexão.
			$this->load->model('model_banco_basico');
			$this->load->model('model_banco');

//            ver($app);

//        ver('chegou');

//busca o applicativo pelo seu login e senha. definidos no dominio do cliente atraves do DEFINE('LANDS_ID',$XXX);
			$app = $this->model_banco->executa_sql("select a.*, a.Titulo_txf as titulo  from apps a 
                                                      where a.Lands_id='" . $lands_id . "' and a.Lands_pass='" . $lands_pass . "' and a.Ativo_sel='SIM'");
//ver($app);

			$query = "select * from apps_config where Lands_id='" . $lands_id . "' or Lands_id='default' and Ativo_sel='SIM'";
			$configs = $this->model_banco->executa_sql($query);


			if (isset($configs[0])) {
				foreach ($configs as $config) {
					$campo = $config->Campo_txf;
					$valor = $config->Valor_txa;
					$app[0]->$campo = $valor;
				}
			}


			//se nao encontrou encerra a aplicacao
			if (isset($app[0]->Id_int)) {

				// linguegens disponíveis no banco
				$linguagens_disponiveis = linguagens_disponiveis($app[0], true);

				// linguagens preferenciais do navegador
				$linguagem_navegador = prefered_language($linguagens_disponiveis);

				// carrega o cookie do usuário
				$this->load->helper('cookie');
				$preferencias_usuario = get_cookie('lands_preferencias_usuario');

				if ($preferencias_usuario) {
					$preferencias_usuario = json_decode($preferencias_usuario);
				}

				// Troca a linguagem do site via post
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				if ($_POST['Mudar_linguagem_sel']) {

					$_POST['Mudar_linguagem_sel'] = strtolower($_POST['Mudar_linguagem_sel']);

					$this->muda_linguagem_cookie($_POST['Mudar_linguagem_sel']);

					if ($linguagem_navegador == $_POST['Mudar_linguagem_sel']) {
						redirect($app[0]->Url_cliente);
					}
					redirect($app[0]->Url_cliente . $_POST['Mudar_linguagem_sel']);

				}

				/**
				 * define a linguagem qnd o usuário entra no site pela primeira vez
				 * e não tem cookie. Seta o cookie pela linguagem do navegador
				 */
				if ($linguagem_navegador) {
					if (!isset($preferencias_usuario->linguagem)) {
						$this->muda_linguagem_cookie($linguagem_navegador);
						redirect($app[0]->Url_cliente);
					}
				}

				// Troca a linguagem pelo segmento da url
				if(isset($this->uri->segments[1])
				&& $preferencias_usuario->linguagem != $this->uri->segments[1]){
					if(array_search($this->uri->segments[1], $linguagens_disponiveis) !== false){
						$this->muda_linguagem_cookie($this->uri->segments[1]);
					}
				}

				/**
				 * Troca o banco de dados de acordo com a linguagem
				 */
				if ($app[0]->Multilinguagem_sel == 'SIM') {

					$muda_url = true;
					if ($linguagem_navegador == $preferencias_usuario->linguagem) {
						$muda_url = false;
					}

					$app[0] = $this->configura_idioma_banco($app[0], $muda_url);

				}

				$this->app = $app[0];
				return $app[0];

			} else {
				die("Aplicativo $lands_id nao registrado no core");
			}
		}

		function grava_acesso($app = null)
		{


			if ($_SERVER['REMOTE_ADDR'] != IP_LANDS) {
				$acessos['Lands_id'] = $this->app->Lands_id;
				$acessos['Ip_txf'] = $_SERVER['REMOTE_ADDR'];
				$acessos['Pagina_txf'] = $_SERVER['REQUEST_URI'];
				$acessos['Acesso_dat'] = date("Y-m-d H:i:s");
				if (isset($_REQUEST['o'])) {
					$acessos['Origem_txf'] = $_REQUEST['o'];
				}
				$this->model_banco->db_insert('acessos', $acessos);
			}
		}

		function muda_linguagem_cookie($linguagem)
		{

			$linguagem_padrao = 'pt-br';

			$this->load->helper('cookie');

			$con = $this->model_banco->executa_sql("select * from conexoes where Linguagem_sel = '{$linguagem}'");

			if (!$con) {
				$linguagem = $linguagem_padrao;
			}

			// busca a linguagem do cookie
			$preferencias_usuario = get_cookie('lands_preferencias_usuario');
			if ($preferencias_usuario) {
				$preferencias_usuario = json_decode($preferencias_usuario);
			} else {
				$preferencias_usuario = new StdClass();
			}

			$preferencias_usuario->linguagem = $linguagem;

			$prefs_to_json = json_encode($preferencias_usuario);

			set_cookie(
				'lands_preferencias_usuario',
				$prefs_to_json,
				time() + (10 * 365 * 24 * 60 * 60)
			);

			$_COOKIE['lands_preferencias_usuario'] = $prefs_to_json;

		}

		function configura_idioma_banco($app, $mudar_url = false)
		{

			$linguagem = 'pt-br';

			$this->load->helper('cookie');

			// busca a linguagem do cookie
			$preferencias_usuario = get_cookie('lands_preferencias_usuario');
			if ($preferencias_usuario) {
				$preferencias_usuario = json_decode($preferencias_usuario);
				if ($preferencias_usuario->linguagem) {
					$linguagem = $preferencias_usuario->linguagem;
				}
			}

			$con = $this->model_banco->executa_sql("select * from conexoes where Linguagem_sel = '{$linguagem}'");

			if ($con) {

				$app->Conexoes_for = $con[0]->Id_int;
				$app->Linguagem_banco_sel = $con[0]->Linguagem_sel;

			} else {

				$preferencias_usuario->linguagem = 'pt-br';

				set_cookie(
					'lands_preferencias_usuario',
					json_encode($preferencias_usuario),
					time() + (10 * 365 * 24 * 60 * 60)
				);

			}

			$ling_url = '';
			if ($app->Linguagem_banco_sel && $mudar_url === true) {
				$ling_url = $app->Linguagem_banco_sel . '/';
			}

			$app->Url_cliente_linguagem = $app->Url_cliente . $ling_url;

			return $app;

		}

		/**
		 * Initialize the user preferences
		 *
		 * Accepts an associative array as input, containing display preferences
		 *
		 * @access  public
		 * @param array  config preferences
		 * @return  void
		 */
		function analisa_tipo($tipo = 'site')
		{

			if (defined('APP_ID'))
				$this->app->fb_app_ID = APP_ID;
			if (defined('APP_SECRET'))
				$this->app->fb_secret = APP_SECRET;
//            switch ($tipo) {
//                  case 'site':
//
//                        break;
//
//
//                  case 'painel':
//                        echo "Tipo de app ($tipo) não implementada.";
//                        die();
//                        break;
//                  case 'blog':
//                        echo "Tipo de app ($tipo) não implementada.";
//                        die();
//                        break;
//                  case 'facebook':
//
//
//                        break;
//                  default: echo 'Não foi definido o tipo de aplicativo.';
//                        die();
//                        break;
//            }
			return $tipo;
		}

		/**
		 * Initialize the user preferences
		 *
		 * Accepts an associative array as input, containing display preferences
		 *
		 * @access  public
		 * @param array  config preferences
		 * @return  void
		 */
		function busca_dados_cliente($id = null)
		{
			if (!isset($id)) {
				die('Funcao busca_dados_cliente necessita de parametro Id do cliente.');
			}

//carrega o banco de dados lands_core
			$this->load->database('default', null, true);

//carrega os models com a nova conexão.
			$this->load->model('model_banco_basico');
			$this->load->model('model_banco');

//busca o applicativo pelo seu login e senha. definidos no dominio do cliente atraves do DEFINE('LANDS_ID',$XXX);


			$cli = $this->model_banco->executa_sql("select c.*, smtp.Smtp_host_txf,smtp.Smtp_usuario_txf,smtp.Smtp_senha_txf,smtp.Smtp_porta_txf from clientes c left outer join clientes_smtp smtp on smtp.Clientes_for=c.Id_int where c.Id_int=$id");


			if (!$cli[0]->Smtp_host_txf) {
				$cli[0]->Smtp_host_txf = 'ssl://mail.lands.net.br';
			}
			if (!$cli[0]->Smtp_usuario_txf) {
				$cli[0]->Smtp_usuario_txf = 'sender@lands.net.br';
			}
			if (!$cli[0]->Smtp_senha_txf) {
				$cli[0]->Smtp_senha_txf = 'ldlf8384@1';
			}
			if (!$cli[0]->Smtp_porta_txf) {
				$cli[0]->Smtp_porta_txf = '465';
			}

//        ver($cli);


//        if (!$cli[0]->Smtp_host_txf) {
//            $cli[0]->Smtp_host_txf = 'ssl://smtp.gmail.com';
//        }
//        if (!$cli[0]->Smtp_usuario_txf) {
//            $cli[0]->Smtp_usuario_txf = 'sender.lands@gmail.com';
//        }
//        if (!$cli[0]->Smtp_senha_txf) {
//            $cli[0]->Smtp_senha_txf = 'Ld230551';
//        }
//        if (!$cli[0]->Smtp_porta_txf) {
//            $cli[0]->Smtp_porta_txf = '465';
//        }
//                $cli = $this->model_banco->executa_sql("select * from clientes where Id_int=$id");
//se nao encontrou encerra a aplicacao
			if (isset($cli[0]->Id_int)) {
				$this->cliente = $cli[0];
				return $cli[0];
			} else {
				die('Cliente nao registrado no core');
			}
		}

		/**
		 * Initialize the user preferences
		 *
		 * Accepts an associative array as input, containing display preferences
		 *
		 * @access  public
		 * @param array  config preferences
		 * @return  void
		 */
		function verifica_estado_do_site($app = null)
		{
			if (!isset($app))
				die('verifica estado do site necessita objeto(app) como parametro'); //ver($this->app);


			$ips_permitidos = explode(',', $app->Filtro_ip_txf, 3);

			if (!isset($ips_permitidos[1])) {
				$ips_permitidos[1] = '0';
			}
			if (!isset($ips_permitidos[2])) {
				$ips_permitidos[2] = '0';
			}


			if (($_SERVER['REMOTE_ADDR'] != $ips_permitidos[0]) && ($_SERVER['REMOTE_ADDR'] != $ips_permitidos[1]) && ($_SERVER['REMOTE_ADDR'] != $ips_permitidos[2]) && (!isset($_REQUEST['liberar']))) {

				switch ($app->Estado_sel) {
					case 'CONSTRUCAO':

						try {

							$tela_temporario = COMMONPATH . "../templates/" . $app->Template_txf . "/temporario.tpl";
							echo $this->smarty->fetch($tela_temporario);
						} catch (Exception $e) {
							$tela_temporario = COMMONPATH . "../templates/padrao/temporario.tpl";
							echo $this->smarty->fetch($tela_temporario);
						}
						exit;
						break;
					case 'FINALIZADO':
						break;
					case 'UPDATE':
						break;
					case 'MANUTENCAO':
						try {

							$tela_temporario = COMMONPATH . "../templates/" . $app->Template_txf . "/manutencao.tpl";
							echo $this->smarty->fetch($tela_temporario);
						} catch (Exception $e) {
							$tela_temporario = COMMONPATH . "../templates/padrao/manutencao.tpl";
							echo $this->smarty->fetch($tela_temporario);
						}
						exit;


						break;

					default:
						die('Estágio de construcao nao definido');
						break;
				}
			}

		}

	}

	//close:class:standartdb_model

	/* End of file standartdb_model.php	 */
	/* Location: ./application/models/standartdb_model.php */

