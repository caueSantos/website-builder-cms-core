<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once(COMMONPATH . 'core/lands_core.php');

	class post extends lands_core
	{

		/**
		 * Index Page for this controller.
		 *
		 * Maps to the following URL
		 *    http://example.com/index.php/welcome
		 *  - or -
		 *    http://example.com/index.php/welcome/index
		 *  - or -
		 * Since this controller is set as the default controller in
		 * config/routes.php, it's displayed at http://example.com/
		 *
		 * So any other public methods not prefixed with an underscore will
		 * map to /index.php/welcome/<method_name>
		 * @see http://codeigniter.com/user_guide/general/urls.html
		 */
		public function __construct()
		{
			parent::__construct();
//        $this->load->helper('language');
//        $this->load->language('welcome');
			$this->load->helper('lands');
			$this->load->helper('landing');
//        $this->load->helper('tradutor');
			$_REQUEST['data_atual'] = date('Y-m-d');
//        $mail->CharSet = 'UTF-8';
			header('Content-Type: text/html; charset=UTF-8');
			$this->load->model('model_smarty');
			if (is_lands()) {
				$this->configura_idioma();
			}

			$this->output->enable_profiler(FALSE);
		}

		function index()
		{


			$this->router();
		}

		/* FUNCAO SOBREPOSTA PARA NAO FAZER BLOQUEAR CASO O SITE ESTEJA EM CONSTRUCAO */

		function verifica_seguranca()
		{

// verifica se ja foi definido o ID E SENHA DO APP
			(defined('LANDS_ID')) or exit('LANDS_ID NAO FOI DEFINIDO');
			(defined('LANDS_PASS')) or exit('LANDS_PASS NAO FOI DEFINIDO');
			$this->smarty->assign('_SERVER', $_SERVER);

			$this->load->model('model_seguranca');

// verifica se o app esta cadastrado na tabela de apps da do banco de dados lands_core..
// caso nao esteja ativo mata a aplicacao;
//configura os atributos do objeto app....

			$this->app = $this->model_seguranca->verifica_ativacao(LANDS_ID, LANDS_PASS);

			if (isset($this->app->Url_curl_txf)) {
				if ($this->app->Url_curl_txf != '')
					$this->app->Url_cliente = $this->app->Url_curl_txf;
			}

			$this->cliente = $this->model_seguranca->busca_dados_cliente($this->app->Clientes_for);
			$this->model_banco->inicializa(array('app' => $this->app, 'cliente' => $this->cliente));

// ver($this->cliente);
//analisa o tipo de app para tomar para iniciar a execucao;
			$vars[] = $this->model_seguranca->analisa_tipo($this->app->Tipo_app_sel);
			$this->assign_vars();

			switch ($this->uri->segment($this->app->Segmento_padrao_txf)) {
				case 'liberar':
					$this->liberar();
					redirect($this->app->Url_cliente);
					break;
				case 'layout':
					$this->layout();
					break;
			}


			$this->assign_vars();
//assign nas variaves da classe e do app;
		}

		function router($param = null)
		{


//ver($_POST);
//        if (!isset($_REQUEST['Lands_id'])) {
//            die('Acesso invalido, Lands_id não foi definido');
//        }

			$segmento = (int)$this->app->Segmento_padrao_txf;
			$segmento = $segmento + 1;


			if ($this->uri->segment($segmento)) {
				$segmento_post = $this->uri->segment($segmento);
			} else {
				$segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
			}

//        ver('chewbgou');

			if ($this->app->MAUTIC_ACCESS_TOKEN) {

				if (!isset($_POST['Form_id'])) {
					$_POST['Form_id'] = $segmento_post;
				}


				if ($_POST['Captcha_key'] || $this->app->Captcha_sel == 'SIM' && $segmento_post != 'informativo') {
					$this->valida_captcha();
				}
				$this->grava_mautic_job();
			}


			switch ($segmento_post) {
				case 'grava_mautic_externo':

//                $_POST['Lands_id']='lald';
					if ($_POST['Lands_id']) {

						$app = $this->model_banco->executa_sql("select * from apps where Lands_id='{$_POST['Lands_id']}'");
						if ($app[0]) {
							$this->app = $app[0];
							$configs = $this->model_banco->executa_sql("select * from apps_config where Lands_id='{$this->app->Lands_id}'");
							foreach ($configs as $config) {

								$this->app->{$config->Campo_txf} = $config->Valor_txa;
							}
						}

						if (!isset($_POST['Form_id'])) {
							$_POST['Form_id'] = $segmento_post;
						}

						$this->grava_mautic_job();
					}

					break;

				case 'calculadora_financeira':

					$this->carrega_model('model_calculadora');
					$this->model_calculadora->inicializa($this->app, $this->cliente);

					$this->model_calculadora->calculadora_controller();

					break;
				case 'contato':

					die('Deprecated function');

					break;

				case 'enviar_contato':

//                if (is_lands()) {
//                    error_reporting(E_ALL);
//ini_set('display_errors','On');
//                            $_POST['POST'] = json_encode($_POST);
//        $_POST['SERVER'] = json_encode($_SERVER);
//        $_POST['APP'] = json_encode($this->app);
//if (!isset($_POST['Form_id'])) {
//                $_POST['Form_id'] = $segmento_post;
//            }
//        $array['POST'] = $_POST;
//        $array['SERVER'] = $_SERVER;
//        $array['APP'] = $this->app;
//        $inserir['Processado_sel'] = 'NAO';
//        $inserir['Lands_id'] = $this->app->Lands_id;
//        $inserir['Form_id'] = $_POST['Form_id'];
//        $inserir['Dados_jso'] = json_encode($array);
//        $inserir['Data_dat'] = date('Y-m-d H:i:s');
//        $this->load->library('mauticlib');
//        $this->mauticlib->inicializa($this->app);
//        $this->mauticlib->autoriza();
//        $this->mauticlib->integra_form();
//                    ver($_POST);
//                    //$this->postar_contato_novissimo();
//                } else {
//                ver($_POST);
					$this->postar_contato();
//                }


					break;
				case 'enviar_contato_mautic':


					$this->postar_contato();


					break;

				case 'hiperofertas':


					$this->postar_hiperofertas();

					break;
				case 'lista_transmissao':

					$this->postar_lista_transmissao();
					break;

				case 'calcular_imc':

					$peso = $_POST['Peso_txf'];
					$altura = $_POST['Altura_txf'];
					$peso = str_replace(',', '.', $peso);
					$altura = str_replace(',', '.', $altura);
					$imc = $peso / ($altura * $altura);

					if ($imc <= 18.499) {

						$classificacao = "abaixo";
					}

					if ($imc >= 18.5 && $imc <= 24.99) {
						$classificacao = "normal";
					}

					if ($imc >= 25 && $imc <= 29.99) {
						$classificacao = "acima";
					}
					if ($imc >= 30 && $imc <= 39.99) {
						$classificacao = "obeso";
					}
					if ($imc >= 40) {
						$classificacao = "morbido";
					}

					$imc = round($imc, 2);


					$this->smarty->assign('classificacao', $classificacao);
					$this->smarty->assign('imc', $imc);
					$this->smarty->assign('mensagem', 'imc_ok');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

					break;


				case 'pergunta' :
					$this->output->enable_profiler(FALSE);
					$this->model_banco_basico->insertTable('perguntas', $this->input->post());
					echo "<div id='enviado'>Pergunta enviada com sucesso!</div>";
					break;
				case 'informativo':

					$this->postar_informativo();
					break;

				case 'modal_orcamento':
					$this->postar_orcamento();
					break;
//            case 'curriculo':
//                $this->output->enable_profiler(FALSE);
//                $this->postar_curriculo();
//                break;


				case 'cadastrar_usuario':


					$this->cadastrar_usuario();
					break;

				case 'gerar_senha':


					$this->gerar_senha();

					break;


				case 'editar':


					$this->editar();
					break;
				case 'bannerfull':
					$this->session->set_userdata('bannerfull', 'sim');
					redirect($this->app->Url_cliente);


					$this->editar();
					break;

				case 'ativar_senha':
					$this->ativar_senha();

					break;
				case 'curriculo':


					$this->postar_curriculo();
					break;

				case 'lead':
					$this->postar_lead();
					break;

				case 'buscar_imoveis':
					$this->buscar_imoveis();
					break;

				case 'cadastro':
					$this->postar_cadastro();
					break;
				case 'acesso':
					$this->postar_acesso();
					break;
				case 'registro_produto':


					$this->postar_registro_produto();
					break;

				case 'editar_cadastro':
					$this->editar_cadastro();

					break;
				case 'maioridade':
					if ($_POST['resposta'] == 'SIM') {
						$this->session->set_userdata('maioridade', 'SIM');
					}
					if (isset($_POST['redirect'])) {
						redirect($_POST['redirect']);
					} else {
						redirect($this->app->Url_cliente);
					}
					break;

				case 'assinarsky':

					$this->load->model('model_mail');
					$this->model_mail->inicializa($this->app, $this->cliente);
					$email = $_POST;

					$url_pacote = $_POST['Pacote_sel'];
					$this->conecta_mbc($this->app->Conexoes_for);
					$this->mbc->db_insert('pedidos_assinatura', $_POST);
					$pacote = $this->mbc->executa_sql("select * from pacotes where Url_amigavel_txf='$url_pacote'");

					$this->smarty->assign('pacote', $pacote[0]);

					$email['Email_txf'] = $email['Email_txf'];
					$email['Nome_txf'] = $email['Nome_txf'];
					$email['Assunto_txf'] = "Nova Assinatura Sky - " . $this->app->Nome_app_txf;


					if ($this->model_mail->envia_email_tpl($email, 'assinatura')) {
						$this->smarty->assign('mensagem', 'pedido_enviado');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
						die();
					} else {
						$this->smarty->assign('mensagem', 'pedido_erro');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
						die();
					}
					break;

				case 'empreendimentos':


					$this->output->enable_profiler(FALSE);
					$id = $_POST['Id_int'];
					$this->conecta_mbc($this->app->Conexoes_for);
					$empreendimento = $this->mbc->buscar_registro_imagens_videos('empreendimentos', "where Id_int=$id");
					if (!isset($empreendimento[0]->Id_int))
						die('nao achou nenhum empreendimento com o id ' . $id);
					$this->smarty->assign('empr', $empreendimento);

					$this->model_smarty->render_ajax('empreendimento', $this->app->Template_txf);
					break;

				case 'facebook':
					die('vai chamar o model facebook');
					break;
				case 'busca' :
					break;

				case 'compara' :
					$this->output->enable_profiler(FALSE);
					$id = $_POST['Id_int'];
					$tabela = $_POST['Tabela_txf'];
					$this->session->set_userdata('tabela', $tabela);
					$this->conecta_mbc($this->app->Conexoes_for);

					if (isset($id)) {
						$item_antes = $this->mbc->buscar_registro_imagens_videos($tabela, "where Id_int=$id");
						$item[0]->Id_int = $item_antes[0]->Id_int;
						$item[0]->Nome_txf = $item_antes[0]->Nome_txf;
					}


					if ($id == $this->session->userdata['item1']->Id_int) {
						echo '<script>alert("Este ítem já está na lista.");</script>';
						$this->smarty->assign('item1', $this->session->userdata['item1']);
						$this->smarty->assign('item2', $this->session->userdata['item2']);
						$this->smarty->assign('item3', $this->session->userdata['item3']);

						$this->model_smarty->render_ajax('compara', $this->app->Template_txf);
						exit();
					}

					if ($id == $this->session->userdata['item2']->Id_int) {
						echo '<script>alert("Este ítem já está na lista.");</script>';
						$this->smarty->assign('item1', $this->session->userdata['item1']);
						$this->smarty->assign('item2', $this->session->userdata['item2']);
						$this->smarty->assign('item3', $this->session->userdata['item3']);

						$this->model_smarty->render_ajax('compara', $this->app->Template_txf);
						exit();
					}

					if ($id == $this->session->userdata['item3']->Id_int) {
						echo '<script>alert("Este ítem já está na lista.");</script>';
						$this->smarty->assign('item1', $this->session->userdata['item1']);
						$this->smarty->assign('item2', $this->session->userdata['item2']);
						$this->smarty->assign('item3', $this->session->userdata['item3']);

						$this->model_smarty->render_ajax('compara', $this->app->Template_txf);
						exit();
					}

//atualiza a sessao
					if (!isset($this->session->userdata['item1'])) {
						$this->session->set_userdata('item1', $item[0]);
					} else {
						if (!isset($this->session->userdata['item2'])) {
							$this->session->set_userdata('item2', $item[0]);
						} else {
							if (!isset($this->session->userdata['item3'])) {
								$this->session->set_userdata('item3', $item[0]);
							} else {
								$this->smarty->assign('mensagem', "limite");
							}
						}
					}

					$this->smarty->assign('item1', $this->session->userdata['item1']);
					$this->smarty->assign('item2', $this->session->userdata['item2']);
					$this->smarty->assign('item3', $this->session->userdata['item3']);

					$this->model_smarty->render_ajax('compara', $this->app->Template_txf);
					break;

				case 'promocao':
					$this->postar_promocao();
					break;
				case 'remove_compara' :
					$this->output->enable_profiler(FALSE);
					$id = $_POST['Id_int'];
					$tabela = $_POST['Tabela_txf'];
// $this->conecta_mbc($this->app->Conexoes_for);


					if ($id == 'todos') {
						$this->session->unset_userdata('item1');
						$this->session->unset_userdata('item2');
						$this->session->unset_userdata('item3');
						$this->smarty->assign('mensagem', "vazio");
					} else {

						$this->smarty->assign('id', $id);
						$this->session->unset_userdata("item$id");
						$this->smarty->assign('mensagem', "removido");
					}

					if (isset($this->session->userdata['item1']))
						$this->smarty->assign('item1', $this->session->userdata['item1']);
					if (isset($this->session->userdata['item2']))
						$this->smarty->assign('item2', $this->session->userdata['item2']);
					if (isset($this->session->userdata['item3']))
						$this->smarty->assign('item3', $this->session->userdata['item3']);

					$this->model_smarty->render_ajax('compara', $this->app->Template_txf);
					break;
			}

//        if ($this->app->MAUTIC_ACCESS_TOKEN) {
//
//            if (!isset($_POST['Form_id'])) {
//                $_POST['Form_id'] = $segmento_post;
//            }
//            $this->grava_mautic_job();
//        }
		}

		function grava_mautic_job()
		{

//        $_POST['POST'] = json_encode($_POST);
//        $_POST['SERVER'] = json_encode($_SERVER);
//        $_POST['APP'] = json_encode($this->app);
//        $this->load->library('mauticlib');
//        $this->mauticlib->inicializa($this->app);
//        $this->mauticlib->autoriza();
//        $this->mauticlib->integra_form();


			$array['POST'] = $_POST;
			$array['SERVER'] = $_SERVER;
			$array['APP'] = $this->app;

			$inserir['Processado_sel'] = 'NAO';
			if ($_POST['Lands_id']) {
				$inserir['Lands_id'] = $_POST['Lands_id'];
			} else {
				$inserir['Lands_id'] = $this->app->Lands_id;
			}
			$inserir['Form_id'] = $_POST['Form_id'];
			$inserir['Dados_jso'] = json_encode($array);
			$inserir['Data_dat'] = date('Y-m-d H:i:s');

			$this->model_banco->db_insert('mautic_job', $inserir, true);
		}

		function gerar_senha()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);


			if (!isset($_POST['Tabela_txf']))
				die('funcao gerar_senha necessita Tabela_txf como parametro');
			$tabela = $_POST['Tabela_txf'];

			if (!isset($_POST['Email_txf']))
				die('funcao gerar_senha necessita Email como parametro');
			$email = $_POST['Email_txf'];
//verifica usuario ja cadastrado;
			$dados['Tabela_txf'] = $tabela;
			$dados['Email_txf'] = $_POST['Email_txf'];
			$dados['Senha_temp_txf'] = senha_aleatoria(5, true, true);

			$query = "select * from $tabela where Email_txf='$email'";

			$usu = $this->mbc->executa_sql($query);

			if (isset($usu[0]->Id_int)) {
				$dados['usuario'] = $usu[0];

//se nao encontrar, cadastra, senao retorna erro.
				$gravou = $this->mbc->updateTable($tabela, $dados, 'Email_txf', $dados['Email_txf']);

				if ($gravou) {

					$this->smarty->assign('dados', $dados);
					$enviou = $this->reenvia_email_senha($dados, 'recuperacao_senha');
					if ($enviou) {
						$this->smarty->assign('resposta', 'email_ok');
						$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
					} else {

						$this->smarty->assign('resposta', 'email_erro');
						$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
					}
				} else {
					$this->smarty->assign('resposta', 'senha_temp_erro');
					$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
				}
			} else {
				$this->smarty->assign('email', $_POST['Email_txf']);
				$this->smarty->assign('resposta', 'email_nao_cadastrado');
				$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
			}
		}

		function reenvia_email_senha($usuario, $formulario)
		{


//ver($this->session->all_userdata('email'));
			$email['Email_txf'] = 'contato@parkgirassol.com.br';
			$email['Nome_txf'] = $this->app->Nome_app_txf;
			$email['Destinatario_txf'] = $usuario['Email_txf'] . ',gustavo.vedana@landsdigital.com.br';
			$email['Assunto_txf'] = 'Recuperação de senha';


//$mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");
			$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
			$email['Mensagem_txa'] = $mensagem;

//            ver($email);
			$this->load->model('model_mail');
			$this->model_mail->inicializa($this->app, $this->cliente);
			$enviou = $this->model_mail->envia_email($email, 'boolean');
			return $enviou;
		}

		function envia_email($email, $formulario = null, $copia_cliente = TRUE)
		{

			if (!isset($email['Nome_txf'])) {
				$email['Nome_txf'] = 'Email do Site ' . $this->app->Nome_app_txf;
			}
			$email['Destinatario_txf'] = $email['Destinatario_txf'];
			$email['Assunto_txf'];


			if (isset($formulario)) {
				if (!file_exists(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl")) {
					die('arquivo tpl do email nao existe');
				}
				$mensagem = $this->smarty->fetch(COMMONPATH . "../templates/{$this->app->Template_txf}/email/{$formulario}.tpl");

//            echo ($mensagem);
//            die();
//d
//$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('recuperacao_senha', $this->app->Template_txf));
				$email['Mensagem_txa'] = $mensagem;
			}

//        ver($mensagem);


			$this->load->model('model_mail');
			$this->model_mail->inicializa($this->app, $this->cliente);
//             $enviou = $this->model_mail->envia_email($email, 'boolean');
			$enviou = $this->model_mail->envia_email_novo($email, $copia_cliente);

			return $enviou;
		}

		function cadastrar_usuario()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);

			if (!isset($_POST['Tabela_txf']))
				die('funcao cadastrar necessita Tabela_txf como parametro');
			$tabela = $_POST['Tabela_txf'];
//verifica usuario ja cadastrado;
			$usu = $this->mbc->executa_sql("select * from $tabela where Email_txf='" . $_POST['Email_txf'] . "'");
			$dados = $_POST;
			$dados['Senha_txp'] = md5($_POST['Senha_txp']);
//se nao encontrar, cadastra, senao retorna erro.
			if (!isset($usu[0]->Id_int)) {
				$this->conecta_mbc($this->app->Conexoes_for);


				$gravou = $this->mbc->db_insert($tabela, $dados);
				if ($gravou) {
					$this->smarty->assign('resposta', 'gravou_ok');
					$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
				} else {
					$this->smarty->assign('resposta', 'gravou_erro');
					$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
				}
			} else {
				$this->smarty->assign('email', $_POST['Email_txf']);
				$this->smarty->assign('resposta', 'usuario_existente');
				$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
			}
			if (isset($_POST['redirect'])) {
				$redirect = $_POST['redirect'];

				echo "<script>top.location='$redirect';</script>";
			}
		}

		function editar()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);

			if (!isset($_POST['Tabela_txf']))
				die('funcao cadastrar necessita Tabela_txf como parametro');
			$tabela = $_POST['Tabela_txf'];
//verifica usuario ja cadastrado;

			$dados = $_POST;
			$dados['Senha_txp'] = md5($_POST['Senha_txp']);
//se nao encontrar, cadastra, senao retorna erro.
			$this->conecta_mbc($this->app->Conexoes_for);

			$gravou = $this->mbc->updateTable($tabela, $dados, 'Id_int', $dados['Id_int']);
			if ($gravou) {
				$this->session->set_userdata('usuario', $_POST);
				$this->smarty->assign('resposta', 'editou_ok');
				$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
			} else {
				$this->smarty->assign('resposta', 'editou_erro');
				$this->model_smarty->render_ajax('msg_cadastro', $this->app->Template_txf);
			}

			if (isset($_POST['redirect'])) {
				$redirect = $_POST['redirect'];

				echo "<script>top.location='$redirect';</script>";
			}
		}

		protected function editar_cadastro()
		{


			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);
//verifica se a tabela foi passada por post;

			if (!isset($_POST['Tabela_txf'])) {
				$this->smarty->assign('mensagem', 'tabela');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			if (!isset($_POST['Id_int'])) {
				die('Id_int nao encontrado');
			}
			$id = $_POST['Id_int'];

			$tabela = $_POST['Tabela_txf'];

//verifica se a tabela existe
			if (!$this->mbc->tabelaexiste($tabela)) {
				$this->smarty->assign('tabela', $tabela);
				$this->smarty->assign('mensagem', 'tabela_nao_existe');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

//edita registro
			if ($this->mbc->updateTable($tabela, $_POST, 'Id_int', $id)) {

				$this->smarty->assign('mensagem', 'edicao_ok');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
//envia email
			} else {
				$this->smarty->assign('mensagem', 'edicao_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		function postar_orcamento()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);
			if (isset($_POST['Tabela_txf'])) {

				if ($this->mbc->tabelaexiste($_POST['Tabela_txf'])) {
					$this->mbc->db_insert($_POST['Tabela_txf'], $_POST);
				} else {
					die('tabela nao existe');
				}
			}

			$this->load->model('model_mail');
			$this->model_mail->inicializa($this->app, $this->cliente);
			$email = $_POST;
			$email['Assunto_txf'] = "Novo Orçamento - " . $this->app->Nome_app_txf;

			if ($this->model_mail->envia_email_tpl($email, 'orcamento')) {
				$this->smarty->assign('mensagem', 'orcamento_enviado');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			} else {
				$this->smarty->assign('mensagem', 'orcamento_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		function postar_registro_produto()
		{

			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);
			if (isset($_POST['Tabela_txf'])) {

				if ($this->mbc->tabelaexiste($_POST['Tabela_txf'])) {
					$this->mbc->db_insert($_POST['Tabela_txf'], $_POST);
				} else {
					die('tabela nao existe');
				}
			}

			$this->load->model('model_mail');
			$this->model_mail->inicializa($this->app, $this->cliente);
			$email = $_POST;
			$email['Assunto_txf'] = "Registro de Produto - " . $this->app->Nome_app_txf;

			if ($this->model_mail->envia_email_tpl($email, 'registro')) {
				$this->smarty->assign('mensagem', 'registro_ok');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			} else {
				$this->smarty->assign('mensagem', 'registro_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		function postar_cadastro()
		{


			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);


			if (isset($_POST['Nascimento_dat'])) {
				$_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
			}
			if (isset($_POST['Data_dat'])) {
				$_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
			} else {
				$_POST['Data_dat'] = date('Y-m-d');
			}


			$_POST['Data_hora_dat'] = date('Y-m-d H:i:s');


//verifica se a tabela foi passada por post;


			if (!isset($_POST['Tabela_txf'])) {
				$this->smarty->assign('mensagem', 'tabela');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			if (!isset($_POST['Destinatario_txf'])) {
				$this->smarty->assign('mensagem', 'destinatario');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			if (!isset($_POST['Email_txf'])) {
				$this->smarty->assign('mensagem', 'email');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
			$tabela = $_POST['Tabela_txf'];


//verifica se a tabela existe
			if (!$this->mbc->tabelaexiste($tabela)) {
				$this->smarty->assign('tabela', $tabela);
				$this->smarty->assign('mensagem', 'tabela_nao_existe');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}


//verifica se existe algum registro com o e-mail associado
			if (!$_POST['Permite_duplo_cadastro_txf']) {


				$email = $_POST['Email_txf'];
				$sql = "select * from $tabela where Email_txf = '$email'";
				$email_bd = $this->mbc->executa_sql($sql);
//ver($x);
				if (isset($email_bd[0]->Id_int)) {

					$this->smarty->assign('mensagem', 'email_ja_existe');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
			}


//insere registro
			if ($this->mbc->db_insert($tabela, $_POST)) {

				$email = $_POST;
				if (!isset($email['Assunto_txf'])) {
					$email['Assunto_txf'] = 'Cadastro no Site ' . $this->app->Nome_app_txf;
				}
				$this->smarty->assign('cadastro', $_POST);


//envia email
//ver($email);
				if ($this->envia_email($email, 'cadastro')) {

					$this->smarty->assign('mensagem', 'cadastro_inserido');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				} else {

					$this->smarty->assign('mensagem', 'cadastro_erro');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				}
				die();
			} else {

				$this->smarty->assign('mensagem', 'cadastro_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		function postar_hiperofertas()
		{


			$this->conecta_mbc(90);
			$this->namespace_empresa = $_POST['Namespace_empresa_txf'];
			$this->namespace_promocao = $_POST['Namespace_promocao_txf'];
			$promocao = $this->mbc->buscar_completo("promocoes", "where Namespace_empresa_sel='{$this->namespace_empresa}' and Namespace_promocao_txf='{$this->namespace_promocao}'");
//$_POST['Destinatario_txf']=$this->
			$id_promocao = $promocao[0]->Id_int;


			$this->carrega_model('model_hiperofertas', 90);
			$this->model_hiperofertas->inicializa($promocao);

//                        if(!$this->admin){

			if ($this->model_hiperofertas->verifica_promocao_encerrada($promocao)) {

				$this->smarty->assign('mensagem', 'cadastro_encerrado');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
//                        }

			$inseriu = $this->model_hiperofertas->insere_inscricao();

			$this->smarty->assign('promocao_inscricao', $promocao);
			if ($inseriu['resultado'] == 'ok') {

				$this->carrega_model('model_formulario');
				$this->model_formulario->inicializa($this->app, $this->cliente);
				$this->model_formulario->envia_formulario($this->app, 'email_inscricao');
				$this->smarty->assign('mensagem', 'cadastro_inserido');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			} else {
				if ($inseriu['resultado'] == 'erro') {

					$this->smarty->assign('mensagem', 'cadastro_erro');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
				if ($inseriu['resultado'] == 'duplicado') {

					$this->smarty->assign('mensagem', 'cadastro_duplicado');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
				if ($inseriu['resultado'] == 'bloqueado') {

					$this->smarty->assign('mensagem', 'cadastro_bloqueado');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
			}
		}

		function postar_acesso()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);


			if (isset($_POST['Data_dat'])) {
				$_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
			} else {
				$_POST['Data_dat'] = date('Y-m-d');
			}
			$_POST['Data_hora_dat'] = date('Y-m-d H:i:s');
//verifica se a tabela foi passada por post;
			if (!isset($_POST['Tabela_txf'])) {
				$this->smarty->assign('mensagem', 'tabela');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
			if ($_POST['Marcador_txf']) {
				$this->smarty->assign('marcador', $_POST['Marcador_txf']);
			}
			$tabela = $_POST['Tabela_txf'];
			if ($_POST['Tpl_retorno_txf']) {
				$tpl_retorno = $_POST['Tpl_retorno_txf'];
			} else {
				$tpl_retorno = "acesso";
			}

//verifica se a tabela existe
			if (!$this->mbc->tabelaexiste($tabela)) {
				$this->smarty->assign('tabela', $tabela);
				$this->smarty->assign('mensagem', 'tabela_nao_existe');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
			$acesso = $_POST;
			$acesso['Ip_txf'] = $_SERVER['REMOTE_ADDR'];
			$acesso['Acesso_dat'] = date("Y-m-d H:i:s");
			if (isset($_REQUEST['utm_source'])) {
				$acesso['Source_txf'] = $_REQUEST['utm_source'];
			}
			if (isset($_REQUEST['utm_medium'])) {
				$acesso['Medium_txf'] = $_REQUEST['utm_medium'];
			}
			if (isset($_REQUEST['utm_content'])) {
				$acesso['Content_txf'] = $_REQUEST['utm_content'];
			}
			if (isset($_REQUEST['utm_campaign'])) {
				$acesso['Campaign_txf'] = $_REQUEST['utm_campaign'];
			}


//insere registro

			if ($this->mbc->db_insert($tabela, $acesso)) {
				$this->smarty->assign('mensagem', 'acesso_ok');
				$this->model_smarty->render_ajax($tpl_retorno, $this->app->Template_txf);

				die();
			} else {
				ver("nao inseriu");
				$this->smarty->assign('mensagem', 'acesso_erro');
				$this->model_smarty->render_ajax($tpl_retorno, $this->app->Template_txf);
				die();
			}
		}

		function postar_lista_transmissao()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);


			if (isset($_POST['Nascimento_dat'])) {
				$_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
			}
			if (isset($_POST['Data_dat'])) {
				$_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
			} else {
				$_POST['Data_dat'] = date('Y-m-d');
			}
			$_POST['Data_hora_dat'] = date('Y-m-d H:i:s');
//verifica se a tabela foi passada por post;
			if (!isset($_POST['Tabela_txf'])) {
				die('tabela nao definida');
			}
			$tabela = $_POST['Tabela_txf'];

//verifica se a tabela existe
			if (!$this->mbc->tabelaexiste($tabela)) {
				die("Tabela $tabela nao existe");
				$this->smarty->assign('tabela', $tabela);
				$this->smarty->assign('mensagem', 'tabela_nao_existe');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

//verifica se existe algum registro com o e-mail associado
			if (!$_POST['Permite_duplo_cadastro_txf']) {
				$telefone = $_POST['Telefone_txf'];
				$sql = "select * from $tabela where Telefone_txf = '$telefone'";
				$registro_bd = $this->mbc->executa_sql($sql);
//ver($x);
				if (isset($registro_bd[0]->Id_int)) {
					$this->smarty->assign('mensagem', 'registro_repetido');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
			}
//insere registro
			if ($this->mbc->db_insert($tabela, $_POST)) {

				$this->session->set_userdata("exibe_popup", 'NAO');
				$this->smarty->assign('mensagem', 'registro_inserido');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
			} else {
				$this->smarty->assign('mensagem', 'registro_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		/**
		 * @param $data
		 * @throws Exception
		 */
		function atualizar_lead($data)
		{

			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);

			$required = ['Tabela_txf'];

			//checa se a tabela está ok
			if (count(array_intersect($required, array_keys($data))) != count($required)) {
				die('Campo "Tabela_txf" não informado');
			}
			if (!$this->mbc->tabelaexiste($data['Tabela_txf'])) {
				die('A tabela "' . $data['Tabela_txf'] . '" não informado');
			}

			$tabela = $data['Tabela_txf'];

			//checa o id
			if (!isset($data['Id_int'])) {
				die('Campo "Id_int" não informado');
			}
			$checa_id = $this->mbc->executa_sql('select count(*) as total from ' . $tabela . ' where Id_int = ' . $data['Id_int']);
			if ((int)$checa_id[0]->total !== 1) {
				die('O id ' . $data->Id_int . ' não existe na tabela ' . $tabela);
			}

			$atualiza = $this->mbc->updateTable($tabela, $data, 'Id_int', $data['Id_int']);
			$this->insere_e_atualiza_arquivos($tabela);

			if ($atualiza) {

				if (isset($data['Envia_email_txf']) && $data['Envia_email_txf'] != 'NAO') {

					if (!isset($data['Assunto_txf'])) {
						$data['Assunto_txf'] = 'Novo Lead no Site ' . $this->app->Nome_app_txf;
					}
					if (isset($data['Tpl_txf'])) {
						if ($data['Tpl_txf']) {
							$arquivo_email = $data['Tpl_txf'];
						} else {
							$arquivo_email = 'lead';
						}
					} else {
						$arquivo_email = 'lead';
					}

					if ($this->envia_email($data, $arquivo_email)) {

						$this->smarty->assign('mensagem', 'lead_atualiza_inserido');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

						if ($_REQUEST['redirect_link']) {
							redireciona($_REQUEST['redirect_link']);
						}

					} else {
						$this->smarty->assign('mensagem', 'lead_erro');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					}
				} else {

					$this->smarty->assign('mensagem', 'lead_atualiza_erro');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					if ($_REQUEST['redirect_link']) {
						redireciona($_REQUEST['redirect_link']);
					}

				}

				$this->smarty->assign('mensagem', 'lead_atualiza_inserido');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
			} else {
				$this->smarty->assign('mensagem', 'lead_atualiza_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
			}

		}

		function insere_e_atualiza_arquivos($tabela, $id = null)
		{

			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);

			if ($_FILES) {

				$pasta_painel = $this->app->Pasta_painel;
				if (isset($_POST['pasta'])) {
					$pasta_painel = $_POST['pasta'];
				}

				$pasta = $this->dados_conexao['database'];
				$upload_path_url = $this->app->Url_cliente . $pasta_painel . '/arquivos/' . $pasta . '/';

				if (!file_exists(FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/')) {
					echo '<div id="status">error</div>';
					echo '<div id="message">Criando pasta arquivos.</div>';
					mkdir(FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/', 0755, true);
				}

				$config['upload_path'] = FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/';
				$config['allowed_types'] = '*';
				$config['overwrite'] = TRUE;

				$name = $_FILES['Arquivos_arq']['name'];
				$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				$new_name = $tabela . '_' . date("Y.m.d-H.i.s") . '.' . $ext;
				$config['file_name'] = $new_name;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('Arquivos_arq')) {
					echo '<div id="status">error</div>';
					echo '<div id="message">' . $this->upload->display_errors() . '</div>';
				} else {
					$ultimo_lead = $this->mbc->executa_sql("select * from $tabela order by Id_int desc;");
					$id = $ultimo_lead[0]->Id_int;
					$data = array('upload_data' => $this->upload->data());
					$arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($data['upload_data']['file_name']));
					$arquivo['Caminho_txf'] = 'arquivos/' . $pasta . '/' . $arquivo['Nome_txf'];
					$arquivo['Tipo_txf'] = str_replace('.', '', $data['upload_data']['file_ext']);
					$arquivo['Id_arquivo_con'] = $id;
					$arquivo['Tabela_con'] = $tabela;
					$arquivo['Data_int'] = time();
					$this->mbc->db_insert('arquivos', $arquivo);
				}
			}
		}

		function postar_lead()
		{

			if (strtolower($_SERVER['REQUEST_METHOD']) == 'put') {

				$_PUT = [];
				parse_str(file_get_contents('php://input'), $_PUT);

				if (isset($_PUT['Id_int'])) {
					$this->atualizar_lead($_PUT);
					die();
				}

			} else if (strtolower($_POST['method']) == 'put') {

				if (isset($_POST['Id_int'])) {
					$this->atualizar_lead($_POST);
					die();
				}

			}
//			ver($_POST);
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);

			if (isset($_POST['Nascimento_dat'])) {
				$_POST['Nascimento_dat'] = formata_data_sql($_POST['Nascimento_dat']);
			}
			if (isset($_POST['Data_dat'])) {
				$_POST['Data_dat'] = formata_data_sql($_POST['Data_dat']);
			} else {
				$_POST['Data_dat'] = date('Y-m-d');
			}

			$_POST['Data_hora_dat'] = date('Y-m-d H:i:s');

			//verifica se a tabela foi passada por post;
			if (!isset($_POST['Tabela_txf'])) {
				$this->smarty->assign('mensagem', 'tabela');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			if (!isset($_POST['Destinatario_txf'])) {
				$this->smarty->assign('mensagem', 'destinatario');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			if (!isset($_POST['Email_txf'])) {
				$this->smarty->assign('mensagem', 'email');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			$tabela = $_POST['Tabela_txf'];

			// Verifica se a tabela existe
			if (!$this->mbc->tabelaexiste($tabela)) {
				$this->smarty->assign('tabela', $tabela);
				$this->smarty->assign('mensagem', 'tabela_nao_existe');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}

			// Verifica se existe algum registro com o e-mail associado
			if (!$_POST['Permite_duplo_cadastro_txf']) {
				$email = $_POST['Email_txf'];
				$sql = "select * from $tabela where Email_txf = '$email'";
				$email_bd = $this->mbc->executa_sql($sql);

				if (isset($email_bd[0]->Id_int)) {
					$this->smarty->assign('mensagem', 'email_ja_existe');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
			}

			// Landing pages
			if ($_POST['Registro_tabela_txf'] == 'landing_pages' && $_POST['Registro_id_txf']) {
				$landings = $this->mbc->executa_sql("select * from landing_pages where Id_int = '{$_POST['Registro_id_txf']}'");

				// Verifica se existe limite de inscrição
				if ($landings[0] && $landings[0]->Limite_inscricao_int) {
					$total = $this->mbc->executa_sql("select count(*) as total from leads where Id_objeto_con = '{$landings[0]->Id_int}' and Tabela_con = 'landing_pages'");
					$total = $total[0]->total;
					$sem_vagas = $total >= $landings[0]->Limite_inscricao_int;

					if ($sem_vagas) {
						$this->smarty->assign('mensagem', 'sem_vagas');
						$this->smarty->assign('limite_inscricao_mensagem', $landings[0]->Limite_inscricao_mensagem_txa);
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
						die();
					}
				}

				// Mensagem de sucesso
				$this->smarty->assign('sucesso_mensagem', $landings[0]->Mensagem_sucesso_txa);
			}

			// Executa qualquer query
			if ($_POST['Sql_tabela_txf']) {
				$tabela_nova = addslashes($_POST['Sql_tabela_txf']);
				$id = addslashes($_POST['Sql_id_txf']);
				$where = addslashes($_POST['Sql_where_txf']);
				$conexao = addslashes($_POST['Sql_conexao_txf']);
				$registros = $this->executa_query($tabela_nova, $where, $id, $conexao);
			}

			// Pega um registro anexado ao formulário
			if ($_POST['Registro_tabela_txf']) {
				$tabela_nova = addslashes($_POST['Registro_tabela_txf']);
				$id = addslashes($_POST['Registro_id_txf']);
				$registros = $this->executa_query($tabela_nova, $where, $id, $conexao);
			}

			// Insere registro
			$_POST['Dados_jso'] = json_encode($_POST);
			if ($this->mbc->db_insert($tabela, $_POST)) {
				if ($_FILES) {
					if (isset($_POST['pasta'])) {
						$pasta_painel = $_POST['pasta'];
					} else {
						$pasta_painel = $this->app->Pasta_painel;
					}

					$pasta = $this->dados_conexao['database'];
					$upload_path_url = $this->app->Url_cliente . $pasta_painel . '/arquivos/' . $pasta . '/';

					if (!file_exists(FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/')) {
						echo '<div id="status">error</div>';
						echo '<div id="message">Criando pasta arquivos.</div>';
						mkdir(FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/', 0755, true);
					}

					$config['upload_path'] = FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/';
					$config['allowed_types'] = '*';
					$config['overwrite'] = TRUE;

					$name = $_FILES['Arquivos_arq']['name'];
					$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
					$new_name = $tabela . '_' . date("Y.m.d-H.i.s") . '.' . $ext;
					$config['file_name'] = $new_name;

					$this->load->library('upload', $config);

//                ver($_FILES);

					if (!$this->upload->do_upload('Arquivos_arq')) {
						echo '<div id="status">error</div>';
						echo '<div id="message">' . $this->upload->display_errors() . '</div>';
					} else {
						$this->conecta_mbc($this->app->Conexoes_for);

						$ultimo_lead = $this->mbc->executa_sql("select * from $tabela order by Id_int desc;");
						$id = $ultimo_lead[0]->Id_int;
						$data = array('upload_data' => $this->upload->data());
						$arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($data['upload_data']['file_name']));
						$arquivo['Caminho_txf'] = 'arquivos/' . $pasta . '/' . $arquivo['Nome_txf'];
						$arquivo['Tipo_txf'] = str_replace('.', '', $data['upload_data']['file_ext']);
						$arquivo['Id_arquivo_con'] = $id;
						$arquivo['Tabela_con'] = $tabela;
						$arquivo['Data_int'] = time();

						$this->conecta_mbc($this->app->Conexoes_for);
						$this->mbc->db_insert('arquivos', $arquivo);
					}
				}

				$email = $_POST;
				if (!isset($email['Assunto_txf'])) {
					$email['Assunto_txf'] = 'Novo Lead no Site ' . $this->app->Nome_app_txf;
				}

				$lead_inserido = $this->mbc->buscar_completo($tabela, " order by Id_int desc limit 1");
				$this->smarty->assign('lead_inserido', $lead_inserido);

				$this->smarty->assign('cadastro', $_POST);

				if (isset($_POST['Tpl_txf'])) {
					if ($_POST['Tpl_txf']) {
						$arquivo_email = $_POST['Tpl_txf'];
					} else {
						$arquivo_email = 'lead';
					}
				} else {
					$arquivo_email = 'lead';
				}


				if ($_POST['Tabela_con'] == 'landing_pages'
					&& $_POST['Id_objeto_con']
					&& $this->mbc->tabelaexiste('campos')) {

					$campos = [];

					foreach ($_POST as $key => $value) {
						$campo = $this->mbc->executa_sql("
                            select c.* from campos c
                            where c.Input_txf = '$key'");
						if ($campo[0]) {
							$campo[0]->Valor_txf = $value;
							$campos[] = $campo[0];
						}
					}

					$this->smarty->assign('campos_extras', $campos);
				}

				if (isset($_POST['Envia_email_txf']) && $_POST['Envia_email_txf'] != 'NAO') {
					if ($this->envia_email($email, $arquivo_email)) {
						$this->smarty->assign('mensagem', 'lead_inserido');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);

						if ($_REQUEST['redirect_link']) {
							redireciona($_REQUEST['redirect_link']);
						}
					} else {
						$this->smarty->assign('mensagem', 'lead_erro');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					}
				} else {

					$this->smarty->assign('mensagem', 'lead_inserido');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					if ($_REQUEST['redirect_link']) {
						redireciona($_REQUEST['redirect_link']);
					}

				}

				die();
			} else {
				ver("nao inseriu");
				$this->smarty->assign('mensagem', 'cadastro_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		protected function executa_query($tabela = null, $where = null, $id = null, $conexao = null)
		{
			if ($conexao) {
				$this->conecta_mbc($conexao);
			}

			$where_final = "where Id_int is not null";
			if ($where) {
				$where_final .= " and $where";
			}
			if ($id) {
				$where_final .= " and Id_int=$id";
			}
//ver($tabela,1);
//        ver($where_final,1);
//        ver($where_final);
			$registros = $this->mbc->buscar_completo($tabela, $where_final);

			$this->smarty->assign('registros', $registros);

			return ($registros);
		}

		function postar_promocao()
		{
			$this->output->enable_profiler(FALSE);
			$this->conecta_mbc($this->app->Conexoes_for);
			if (isset($_POST['Tabela_txf'])) {
				$tabela = $_POST['Tabela_txf'];
			} else {
				$tabela = "inscricoes";
			}

			$inscricao = $_POST;
			$mensagem = htmlspecialchars_decode($this->model_smarty->retorna_tpl('email/inscricao', $this->app->Template_txf));
			$inscricao['Tpl_email_txf'] = $mensagem;


			if ($this->mbc->tabelaexiste($tabela)) {
				$this->mbc->db_insert($tabela, $inscricao);
			} else {
				die('tabela nao existe');
			}

			$this->load->model('model_mail');
			$this->model_mail->inicializa($this->app, $this->cliente);
			$email = $_POST;
			$email['Assunto_txf'] = "Cadastro Promoção - " . $this->app->Nome_app_txf;

			if ($this->model_mail->envia_email_tpl($email, 'inscricao')) {
				$this->smarty->assign('mensagem', 'envio_ok');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			} else {
				$this->smarty->assign('mensagem', 'envio_erro');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
				die();
			}
		}

		function configura_idioma()
		{
			if (isset($_REQUEST['Idioma_txf'])) {
				if ($_REQUEST['Idioma_txf']) {

					$idioma = $_REQUEST['Idioma_txf'];


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
					}

					$arquivo_textos = (COMMONPATH . "../templates/{$this->app->Template_txf}/idiomas/{$this->idioma}.php");

					if (file_exists($arquivo_textos)) {
						include($arquivo_textos);
						$this->smarty->assign('texto', $texto);
					}
					$this->app->Url_atual = $this->app->Url_cliente . $this->idioma . '/';
					$this->smarty->assign('app', $this->app);
					$this->session->set_userdata('idioma', $this->idioma);
					$this->smarty->assign('idioma', $this->idioma);
				}
			}
		}

		function valida_captcha()
		{

			$segmento = (int)$this->app->Segmento_padrao_txf;
			$segmento = $segmento + 1;


			if ($this->uri->segment($segmento)) {
				$segmento_post = $this->uri->segment($segmento);
			} else {
				$segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
			}


			$key = $_POST['Captcha_key'];


			if (isset($_POST['g-recaptcha-response'])) {
				$captcha_data = $_POST['g-recaptcha-response'];
			} else {

				if ($segmento_post == 'curriculo') {

					echo '<div id="status">error</div>';
					echo '<div id="message">Captcha Inválido 2.</div>';
					exit();
				} else {
					$this->smarty->assign('mensagem', 'captcha_invalido');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
			}


#Os parâmetros podem ficar em um array
			$vetParametros = array(
				"secret" => $key,
				"response" => $captcha_data,
				"remoteip" => $_SERVER["REMOTE_ADDR"]
			);
# Abre a conexão e informa os parâmetros: URL, método POST, parâmetros e retorno numa string
			$curlReCaptcha = curl_init();
			curl_setopt($curlReCaptcha, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($curlReCaptcha, CURLOPT_POST, true);
			curl_setopt($curlReCaptcha, CURLOPT_POSTFIELDS, http_build_query($vetParametros));
			curl_setopt($curlReCaptcha, CURLOPT_RETURNTRANSFER, true);
# A resposta é um objeto json em uma string, então só decodificar em um array (true no 2º parâmetro)
			$vetResposta = json_decode(curl_exec($curlReCaptcha), true);

//        ver($vetResposta,1);
# Fecha a conexão
			curl_close($curlReCaptcha);

# Analisa o resultado (no caso de erro, pode informar os códigos)
			if ($vetResposta["success"]) {

				return true;
			} else {

				if ($segmento_post == 'curriculo') {

					echo '<div id="status">error</div>';
					echo '<div id="message">Captcha Inválido 1.</div>';
					exit();
				} else {

					$this->smarty->assign('mensagem', 'captcha_invalido');
					$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					die();
				}
			}
		}

		function postar_contato()
		{
//
//        ver($_POST);
// movido para o router..

			if (!$this->app->MAUTIC_ACCESS_TOKEN) {
				if ($_POST['Captcha_key'] || $this->app->Captcha_sel == 'SIM') {
					$this->valida_captcha();
				}
			}


			$this->output->enable_profiler(FALSE);
			if (isset($_POST['Tpl_txf'])) {
				if ($_POST['Tpl_txf']) {
					$arquivo_email = $_POST['Tpl_txf'];
				} else {
					$arquivo_email = 'contato';
				}
			} else {
				$arquivo_email = 'contato';
			}

			if ($_POST['Newsletter_sel']) {
				$this->postar_informativo();
			}


			if ($this->carrega_model('model_contato')) {

				$this->model_contato->inicializa($this->app, $this->cliente);
//se nao tiver definido a tabela_contato_txf do app envia sem parâmetros, pegando o default="_contato"


				if ($this->app->Tabela_contato_txf != '') {
					$dados_contato = $this->model_contato->prepara_contato_local($this->app->Lands_id, $this->app->Tabela_contato_txf);
				} else {
					$dados_contato = $this->model_contato->prepara_contato_local($this->app->Lands_id);
				}

				$dados_contato['Lands_id'] = $this->app->Lands_id;
				$dados_contato['Data_dat'] = date('Y-m-d');


				if ($dados_contato['next'] == 'criar_tabela') {

					$script = $this->model_contato->criar_tabela_contato($this->app->Lands_id);
					$this->postar_contato();
				} else {

//ver('cjegpi');
					$resultado_final = $this->model_contato->insere_contato_local($dados_contato);


					if ($this->mbc->tabelaexiste('_contato_bkp')) {
						$dados_contato['tabela_emails_contato'] = '_contato_bkp';
						$this->model_contato->insere_contato_local($dados_contato);
					}

					if ($resultado_final->resposta == 'erro') {
						$this->smarty->assign('mensagem', 'contato_erro');
						$this->smarty->assign('texto', $resultado_final->mensagem);
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
						die();
					}


					$this->load->model('model_formulario');

					$this->model_formulario->inicializa($this->app, $this->cliente);
//ver('cjeg');

					if ($this->model_formulario->envia_formulario($this->app, $arquivo_email)) {
//                    ver('ok');
						$this->smarty->assign('mensagem', 'contato_ok');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					} else {
//                    ver('erro');
						$this->smarty->assign('mensagem', 'contato_erro');
						$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
					}
					$this->load->database('default', null, true);
					return $resultado_final;
				}
			}
		}

		function postar_informativo()
		{
			$this->output->enable_profiler(FALSE);
			$this->load->database('default', null, true);
			$this->conecta_mbc($this->app->Conexoes_for);
			$this->carrega_model('model_informativo');
			$this->model_informativo->inicializa($this->app, $this->cliente);
//$email_usuario['Email_txf'] = $this->input->post();
			$dados_info = $this->model_informativo->prepara_informativo_local($this->app->Lands_id, $this->app->Tabela_info_txf);

			$dados_info['Lands_id'] = $this->app->Lands_id;
			$dados_info['Data_dat'] = date('Y-m-d');

			if ($dados_info['next'] == 'criar_tabela') {
				$script = $this->model_informativo->criar_tabela_info($this->app->Lands_id, $this->app->Tabela_info_txf);
				$this->postar_informativo();
				die();
			} else {
				if ($this->model_informativo->valida_email($_POST['Email_txf'])) {
					$liberacao = $this->model_informativo->verifica_duplicidade($dados_info);
					if ($liberacao['resposta'] != 'ok') {
//   $resultado_final = $liberacao['css'];
						$resultado_final = $liberacao['mensagem'];
						$resultado_final2 = $liberacao['css_message'];
						$this->smarty->assign('mensagem', $liberacao);
					} else {
						$re = $this->model_informativo->insere_info_local($dados_info);
						$resultado_final = $re['mensagem'];
						$resultado_final2 = $re['css_message'];
						$this->smarty->assign('mensagem', $re);
					}

					$this->smarty->assign('resultado', $liberacao['resposta']);
					$this->smarty->assign('resposta', $resultado_final);
					$this->smarty->assign('resposta_css', $resultado_final2);
					$this->model_smarty->render_ajax('informativo_resposta', $this->app->Template_txf);
					$this->load->database('default', null, true);
					return $resultado_final;
				} else {

					$this->smarty->assign('resultado', 'email_invalido');
					$resultado_final = 'Email_inválido';
					$resultado_final2 = '<span style="color:#D83F4A">Email inválido</span>';
					$this->smarty->assign('resposta', $resultado_final);
					$this->smarty->assign('resposta_css', $resultado_final2);
					$this->model_smarty->render_ajax('informativo_resposta', $this->app->Template_txf);
					$this->load->database('default', null, true);
					return $resultado_final;
				}
			}
		}

		function postar_curriculo()
		{

			if (!$this->app->MAUTIC_ACCESS_TOKEN) {
				if ($_POST['Captcha_key'] || $this->app->Captcha_sel == 'SIM') {
					if ($this->valida_captcha() !== true) {
						echo '<div id="status">error</div>';
						echo '<div id="message">Captcha Inválido.</div>';
						exit();
					}
				}
			}

			if (isset($_POST['pasta'])) {
				$pasta_painel = $_POST['pasta'];
			} else {
				$pasta_painel = $this->app->Pasta_painel;
			}


			$this->output->enable_profiler(FALSE);
			$this->load->database('default', null, true);
			$this->conecta_mbc($this->app->Conexoes_for);
			$this->carrega_model('model_curriculo');
			$_POST['Data_dat'] = retorna_date_time();
			if (!$this->verifica_campos_curriculo()) {
				echo '<div id="status">error</div>';
				echo '<div id="message">Preencha todos os campos.</div>';
				exit();
			}
			if (!$_FILES) {
				echo '<div id="status">error</div>';
				echo '<div id="message">Envio do arquivo é obrigatório.</div>';
				exit();
			}

			if ($this->mbc->tabelaexiste('curriculos')) {
				$pasta = $this->dados_conexao['database'];
				$upload_path_url = $this->app->Url_cliente . $pasta_painel . '/arquivos/' . $pasta . '/';

				if (!file_exists(FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/')) {
					echo '<div id="status">error</div>';
					echo '<div id="message">Criando pasta arquivos.</div>';
					mkdir(FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/', 0755, true);
				}


//            ver($upload_path_url);
				$config['upload_path'] = FCPATH . $pasta_painel . '/arquivos/' . $pasta . '/';

//		$config['upload_path'] = './uploads/';
//            $config['allowed_types'] = 'doc|docx|ppt|pptx|txt|rtf|pdf|jpg|png|zip|avi';
				$config['allowed_types'] = '*';
				$config['overwrite'] = TRUE;
//            ver($config);
				/* $config['max_size']	= '1000';
				 *
					$config['max_width']  = '1024';
					$config['max_height']  = '768'; */


				$this->load->library('upload', $config);
				if (!$this->upload->do_upload()) {
					echo '<div id="status">error</div>';
					echo '<div id="message">' . $this->upload->display_errors() . '</div>';
				} else {

					$this->conecta_mbc($this->app->Conexoes_for);
					$curriculo = $_POST;
					$curriculo['Curriculo_arq'] = "<img rel='Visualizar' src='imagens/visualizar_geral.png' />";
					if ($this->mbc->db_insert('curriculos', $curriculo)) {
						$ultimo_currico = $this->mbc->executa_sql("select * from curriculos order by Id_int desc;");
					};
					$id = $ultimo_currico[0]->Id_int;
					$data = array('upload_data' => $this->upload->data());
					$arquivo['Nome_txf'] = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($data['upload_data']['file_name']));

					$arquivo['Caminho_txf'] = 'arquivos/' . $pasta . '/' . $arquivo['Nome_txf'];
					$arquivo['Tipo_txf'] = str_replace('.', '', $data['upload_data']['file_ext']);
					$arquivo['Descricao_txf'] = $_POST['Nome_txf'];
					$arquivo['Id_arquivo_con'] = $id;
					$arquivo['Tabela_con'] = 'curriculos';
					$arquivo['Data_int'] = time();

					$this->conecta_mbc($this->app->Conexoes_for);
					$this->mbc->db_insert('arquivos', $arquivo);


					echo '<div id="status">success</div>';
//then output your message (optional)
					echo '<div id="message"> Seu currículo foi enviado com sucesso para nossa base de dados, em breve entraremos em contato. Obrigado.</div>';
//pass the data to js
					echo '<div id="upload_data">' . json_encode($data) . '</div>';
					$email['Email_txf'] = $_POST['Email_txf'];
					$email['Nome_txf'] = $_POST['Nome_txf'];
					$email['Vaga_txf'] = $_POST['Vaga_txf'];
					$email['Telefone_txf'] = $_POST['Telefone_txf'];
					$email['Destinatario_txf'] = $_POST['Destinatario_txf'];
					$email['Assunto_txf'] = 'Novo currículo - ' . $this->app->Nome_app_txf;
					$email['Arquivo_txf'] = $arquivo['Caminho_txf'];
					$email['Arquivo_nome_txf'] = $arquivo['Nome_txf'];

					$dados_email = array_to_object($email);
					$this->smarty->assign('dados_email', $dados_email);


					try {

						$caminho = COMMONPATH . "../templates/{$this->app->Template_txf}/forms/curriculo.tpl";

						$mensagem_formatada = $this->smarty->fetch($caminho);
					} catch (Exception $e) {
						$mensagem_formatada = $this->smarty->fetch(COMMONPATH . "../templates/padrao/forms/curriculo.tpl");
					}


					$email['Mensagem_txa'] = $mensagem_formatada;
//                    $email['Mensagem_txa'] = 'Novo currículo de ' . $email['Nome_txf'] . ' foi enviado em seu site. Para vizualizá-lo acesse o painel de controle. <a href="http://painel.landsdigital.com.br" >http://painel.landsdigital.com.br</a>';
//envia email para o site
					$this->envia_email($email, NULL, FALSE);

//envia confirmacao para o enviador
					$email['Email_txf'] = "webmaster@landshosting.com.br";
					$email['Destinatario_txf'] = $_POST['Email_txf'];
					$email['Nome_txf'] = $this->app->Nome_app_txf;
					$email['Assunto_txf'] = 'Currículo recebido (' . ($this->app->Nome_app_txf) . ')';
					$email['Mensagem_txa'] = "Seu currículo foi enviado com sucesso para o site {$this->app->Nome_app_txf}. Obrigado pelo contato.";
					$this->envia_email($email, NULL, FALSE);
				}
			} else {

				$this->model_curriculo->cria_tabela_curriculo($this->app->Lands_id, 'curriculos');
				$this->postar_curriculo();
			}
		}

		function verifica_campos_curriculo()
		{
			if ($_POST['Email_txf'] == '')
				return false;
			if ($_POST['Nome_txf'] == '')
				return false;

			return true;
		}

		function buscar_imoveis()
		{

			/* CONECTA NO BANCO */

			$this->conecta_mbc($this->app->Conexoes_for);

			function limpa_valor($valor)
			{
				return explode(':', sanitize($valor, 'sql'));
			}

			function filtro_igual($tipo, $tipo_formatado, $valor)
			{
				return "( c_{$tipo_formatado}.Tipo_sel = '{$tipo}' and ( ( {$valor} between c_{$tipo_formatado}.Valor_min_txf AND c_{$tipo_formatado}.Valor_max_txf ) OR ( c_{$tipo_formatado}.Valor_min_txf = {$valor} OR  c_{$tipo_formatado}.Valor_max_txf = {$valor} ) ) )";
			}

			function filtro_igual_maior($tipo, $tipo_formatado, $valor)
			{
				return "( c_{$tipo_formatado}.Tipo_sel = '{$tipo}' and ( c_{$tipo_formatado}.Valor_min_txf >= {$valor} OR c_{$tipo_formatado}.Valor_max_txf <= {$valor} ) )";
			}

			function range_values($campo, $valor)
			{
				$explode = explode('-', $valor);
				if (!isset($explode[0])) $explode[0] = '0';
				if (!isset($explode[1])) $explode[1] = '999999999999.99';

				$novo_valor = '';
				foreach ($explode as $key => $v) {
					if ($key > 0) {
						$novo_valor .= '@';
					}
					$novo_valor .= formata_moeda_banco($v);
				}
				$novo_valor = str_replace('@', ' AND ', $novo_valor);
				return "( {$campo} between {$novo_valor} )";
			}

			function caracteristica_range_values($tipo, $tipo_formatado, $min, $max)
			{

				$sql_min = '';
				$sql_max = '';

				if ($min !== false) {
					$sql_min = "c_{$tipo_formatado}.Valor_min_txf >= {$min}";
				}

				if ($max !== false) {
					$sql_max = "c_{$tipo_formatado}.Valor_max_txf <= {$max}";
				}

				$or = $max !== false && $min !== false ? ' AND ' : '';

				return "( c_{$tipo_formatado}.Tipo_sel = '{$tipo}' and ( {$sql_min} {$or} {$sql_max} ) )";

			}

			/* CONFIG PAGINACAO */
			$paginacao_itens = 9;
			$paginacao_pagina = 1;

			if (isset($_GET['per_page'])) {
				$paginacao_itens = $_GET['per_page'];
			}

			if (isset($_GET['curr_page'])) {
				$paginacao_pagina = $_GET['curr_page'];
			}

			$limite_inicio = ($paginacao_pagina * $paginacao_itens) - ($paginacao_itens);
			$limite_fim = $paginacao_itens;

			/* FILTROS */
			if (isset($_POST['filtro'])) {

				$filtros = $_POST['filtro'];

				$where = '';
				$caracteristicas_joins = '';

				if (isset($filtros['caracteristicas'])) {

					$caracteristicas = $_POST['filtro']['caracteristicas'];

					foreach ($caracteristicas as $tipo => $valor) {

						$tipo_formatado = dashed_to_snake_case(remove_acentos($tipo));

						if (is_array($valor)) {

							if (isset($valor['range'])) {

								$caracteristicas_joins .= " inner join caracteristicas c_{$tipo_formatado} 
									on c_{$tipo_formatado}.Id_objeto_con  = im.Id_int 
									AND ";

								$range = $valor['range'];
								$min = isset($range['min']) ? formata_moeda_banco($range['min']) : false;
								$max = isset($range['max']) ? formata_moeda_banco($range['max']) : false;

								$caracteristicas_joins .= caracteristica_range_values($tipo, $tipo_formatado, $min, $max);

							}

						} else {

							$valor = limpa_valor($valor);
							if (isset($valor[0]) && isset($valor[1])) {

								$caracteristicas_joins .= " inner join caracteristicas c_{$tipo_formatado} 
									on c_{$tipo_formatado}.Id_objeto_con  = im.Id_int 
									AND ";

								if ($valor[0] === 'eq') {
									$caracteristicas_joins .= filtro_igual($tipo, $tipo_formatado, $valor[1]);
								} else if ($valor[0] === 'gte') {
									$caracteristicas_joins .= filtro_igual_maior($tipo, $tipo_formatado, $valor[1]);
								}

							}

						}

					}

				}
				unset($filtros['caracteristicas']);

				/* WHERE */
				$count = 0;
				foreach ($filtros as $campo => $valor) {

					if ($campo != 'Order_by') {

						if ($count > 0) {
							$where .= ' and ';
						}

						$valor_exploded = limpa_valor($valor);
						if (isset($valor_exploded[0]) && isset($valor_exploded[1])) {

							if ($valor_exploded[0] === 'eq') {
								$where .= filtro_igual($campo, $valor_exploded[1]);
							} else if ($valor_exploded[0] === 'gte') {
								$where .= filtro_igual_maior($campo, $valor_exploded[1]);
							} else if ($valor_exploded[0] === 'range') {
								$where .= range_values('im.' . $campo, $valor_exploded[1]);
							}

						} else {

							$where .= "im.{$campo} = '{$valor}'";

						}

						$count++;

					}

				}

			}

			$ativo = "im.Ativo_sel = 'SIM'";
			if (!empty($where)) {
				$where = ' where ' . $where;
				$ativo = ' and ' . $ativo;
			} else {
				$ativo = " where " . $ativo;
			}

			$ordenacao = 'im.Ordenacao_txf';
			if (isset($filtros['Order_by'])) {

				$by = $filtros['Order_by'];
				$by = explode(':', $by);

				if (isset($by[0])) {
					$ordenacao = 'im.' . $by[0];
				}

				if (isset($by[1])) {
					$ordenacao = "CAST({$ordenacao} AS {$by[1]})";
				}

				if (isset($by[2])) {
					$ordenacao .= ' ' . $by[2];
				}

			}

			/* SQL STRING */
			$sql = "select im.* from imoveis im
				{$caracteristicas_joins}
				{$where} {$ativo}
				group by im.Id_int order by {$ordenacao} limit {$limite_inicio}, {$limite_fim}";

			/* COUNT */
			$sql_count = "select COUNT(*) as count from imoveis im
				{$caracteristicas_joins}
				{$where} {$ativo}";

			/* CONTA OS ITENS */
			$count = $this->mbc->executa_sql($sql_count);

			/* FAZ A BUSCA DOS IMOVEIS */
			$q = $this->mbc->executa_sql($sql);

			/* CONFIG VINS DOS IMOVEIS */
			$vins_configs = [
				[
					'Tabela' => 'caracteristicas',
					'Campo' => 'Caracteristicas_vin'
				]
			];

			$q2 = $this->mbc->busca_vins($q, 'imoveis', array_to_object($vins_configs));

			$q3 = $this->mbc->complementa_registros($q2, 'imoveis', 'Imagens_ico');

			$q4 = monta_imoveis_zeh($q3, $this->mbc->buscar_completo('caracteristicas_tipos'));

			echo json_encode(paginate($q4, $paginacao_pagina, $paginacao_itens, $count[0]->count));

			die();

		}

	}

?>
