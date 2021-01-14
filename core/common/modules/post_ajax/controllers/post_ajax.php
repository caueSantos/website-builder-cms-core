<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once(COMMONPATH . 'core/lands_core.php');

	class post_ajax extends lands_core
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
			$this->load->helper('language');
			$this->load->language('welcome');
			$this->load->helper('lands');
			$this->load->helper('tradutor');
			$_REQUEST['data_atual'] = date('Y-m-d');

			$this->load->model('model_smarty');

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
			(defined('LANDS_ID')) OR exit('LANDS_ID NAO FOI DEFINIDO');
			(defined('LANDS_PASS')) OR exit('LANDS_PASS NAO FOI DEFINIDO');
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

		function avaliacao_estrelas()
		{

			$registros = [];

			$tabela = isset($_POST['Tabela_txf']) ? $_POST['Tabela_txf'] : 'avaliacoes';
			$coluna = isset($_POST['Coluna_txf']) ? $_POST['Coluna_txf'] : 'Avaliacao_txf';

			$id_objeto = (int)$_POST['Id_objeto_con'];
			$tabela_referencia = $_POST['Tabela_con'];

			$tpl = isset($_POST['Tpl_txf']) ? $_POST['Tpl_txf'] : false;

			$fez_avaliacao = false;
			$sessao = $this->session->userdata['fez_avaliacao_estrelas'];
			if (is_array($sessao) && in_array($id_objeto, $sessao)) {
				$fez_avaliacao = true;
			}

			if ($fez_avaliacao === true) {
				$this->smarty->assign('mensagem', 'fez_avaliacao_estrelas');
				$this->model_smarty->render_ajax('mensagens', $this->app->Template_txf);
			} else {

				$registros['inserido'] = $this->mbc->db_insert($tabela, $_POST, true);

				$sessao[] = $id_objeto;
				$this->session->set_userdata('fez_avaliacao_estrelas', $sessao);

				$registros['registros'] = $this->mbc->executa_sql("select *, {$coluna} from {$tabela} where 
            Id_objeto_con = {$id_objeto} and  Tabela_con = '{$tabela_referencia}'");

				foreach ($registros['registros'] as $registro) {
					$avaliacoes = $avaliacoes + (int)$registro->{$coluna};
				}

				$registros['media'] = round($avaliacoes / count($registros['registros']), 2);

				if ($tpl === false) {
					echo json_encode([
						'data' => $registros,
						'mensagem' => 'ok'
					]);
				} else {
					$this->smarty->assign('avaliacao_estrelas', $registros);
					$this->model_smarty->render_ajax($tpl, $this->app->Template_txf);
				}

			}

			die();
		}

		function curtir()
		{

			$tabela = $_POST['Tabela_txf'];
			$variavel = $_POST['Variavel_txf'];

			$id = $_POST['Id_int'];
			$tpl = $_POST['Tpl_txf'];
			if ($this->session->userdata['curtidas']) {
				$curtidas = $this->session->userdata['curtidas'];
			} else {
				$curtidas = array();
			}
			$curtidas[] = $id;
			$this->session->set_userdata('curtidas', $curtidas);
			$this->smarty->assign("curtidas", $curtidas);


			$registro = $this->mbc->executa_sql("select Id_int, Curtidas_txf from {$tabela} where Id_int={$id}");
			if ($registro[0]) {
				$registro[0]->Curtidas_txf = $registro[0]->Curtidas_txf + 1;
				unset($registro->Id_int);
				$array = object_to_array($registro[0]);
				$registro = $this->mbc->updateTable($tabela, $array, 'Id_int', $id, TRUE);
				$registros = $this->mbc->buscar_completo("$tabela", "where Ativo_sel='SIM' order by Curtidas_txf desc");

				foreach ($registros as $registro) {
//                    ver($curtidas,1);
					if (!in_array($registro->Id_int, $curtidas)) {
//                    echo "{$registro->Id_int} não esta no array<br>";
//                    print_r($curtidas);
						$registro->curtir = 'SIM';
					} else {
//                      echo "{$registro->Id_int}  esta no array<br>";
//                    print_r($curtidas);
						$registro->curtir = 'NAO';
					}
				}
//ver($registros);
//             ver($registros);
				$this->smarty->assign($variavel, $registros);
				$this->model_smarty->render_ajax($tpl, $this->app->Template_txf);
			}

			die();
		}

		function router($param = null)
		{

			$segmento = (int)$this->app->Segmento_padrao_txf;
			$segmento = $segmento + 1;

			if ($this->uri->segment($segmento)) {
				$segmento_post = $this->uri->segment($segmento);
			} else {
				$segmento_post = $this->uri->segment($this->app->Segmento_padrao_txf);
			}
			$this->conecta_mbc($this->app->Conexoes_for);

			if ($segmento_post != 'busca') {

				$this->carrega_dados($segmento_post, 'ajax');
			}

			switch ($segmento_post) {
				case 'warn':
					$this->processa_warn();
					break;
				case 'busca_imoveis':
					$this->processa_imoveis();
					break;
				case 'curtir':
					$this->curtir();
					break;
				case 'avaliacao_estrelas':
					$this->avaliacao_estrelas();
					break;
				case 'revendas':
					ver('chegou no wats');
					break;
				case 'filtra_cidade':
					$cidade = $_POST['valor'];
					$where = "where nome like '%" . $cidade . "%' OR uf like '%" . $cidade . "%'";
					$cidades = $this->mbc->executa_sql("select * from tb_cidades $where");
					$this->smarty->assign('cidades', $cidades);
					$this->model_smarty->render_ajax('cidades', $this->app->Template_txf);

					break;

				case 'produto':
					if (!isset($_POST['Id_int'])) {
						$id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
					} else {
						$id = $_POST['Id_int'];
					}
					$produto = $this->mbc->buscar_completo("produtos", "where Id_int={$id}");
					$this->smarty->assign('produto', $produto);
					$this->model_smarty->render_ajax('produto', $this->app->Template_txf);
					break;
				case 'busca':


					$valor = $_POST['valor'];
					$tabelas = $_POST['Tabelas_txf'];
					$this->smarty->assign('valor', $valor);


					$resultado = $this->fazer_busca();
//                ver($resultado);
					$this->smarty->assign('resultado', $resultado);


					$this->model_smarty->render_ajax('busca', $this->app->Template_txf);
					break;

				case 'avisos':
//                ver($this->session->all_userdata(),1);
//                ver($this->usuario);
					if (!$this->usuario) {
						echo('sem usuario');
					}
					$avisos = $this->mbc->buscar_completo("avisos", "where Ativo_sel='SIM' and Resultados_sel='SIM' ");
					$this->smarty->assign('avisos', $avisos);
					$this->model_smarty->render_ajax('avisos', $this->app->Template_txf);

					break;

				case 'avaliacao':


					$id = $_POST['Id_int'];
					$tabela = $_POST['Tabela_txf'];
					$campo = $_POST['Campo_txf'];

					$query = "update {$tabela} set {$campo} = {$campo} + 1 where Id_int={$id}";
//        ver($query);
					$registro = $this->mbc->executa_sql($query);
					$this->smarty->assign('mensagem', 'voto_ok');
					$this->model_smarty->render_ajax("mensagens", $this->app->Template_txf);
					die();

					break;
				case 'aviso':

					if (!isset($_POST['Id_int'])) {
						$id = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
					} else {
						$id = $_POST['Id_int'];
					}

					if ($id) {
						$where_id = " and Id_int={$id}";
					}

					$avisos = $this->mbc->buscar_completo("avisos", "where Ativo_sel='SIM' and Resultados_sel='SIM' $where_id");
					$this->smarty->assign('avisos', $avisos);
					$this->model_smarty->render_ajax('aviso', $this->app->Template_txf);
					break;

				case 'modalidades':

					if ($_POST['unidade']) {
						$where = "where u.Nome_url='{$_POST['unidade']}'";
					}

					$sql = "select m.* from checkboxes c
left outer join modalidades m on m.Id_int= c.Id_objeto_con
left outer join unidades u on u.Id_int=c.Id_chb_con
$where group by m.Id_int order by m.Nome_url ";
					$todas_modalidades = $this->mbc->executa_sql($sql);
					$this->smarty->assign('todas_modalidades', $todas_modalidades);
//                ver($todas_modalidades);
					$this->model_smarty->render_ajax('filtro_modalidades', $this->app->Template_txf);
					break;

				case 'grade':
					$where = "";
					if ($_POST['unidade']) {
						$where .= " and Unidade_sel='{$_POST['unidade']}'";
					}
					if ($_POST['modalidade']) {
						$where .= " and Nome_url='{$_POST['modalidade']}'";
					}


					$sql = "select m.Id_int as Id_modalidade, m.Nome_tit as Modalidade,m.Nome_url, h.* from modalidades m 
left outer join horarios h on h.Id_objeto_con=m.Id_int 
where h.Id_objeto_con is not null and m.Ativo_sel='SIM'  and h.Ativo_sel='SIM' $where
group by h.Id_int order by h.Hora_inicio_txf";

					$hmodal = $this->mbc->executa_sql($sql);

					$this->smarty->assign('hmodal', $hmodal);

					$this->model_smarty->render_ajax('grade_horaria', $this->app->Template_txf);
					break;
			}
		}

		function processa_imoveis()
		{

			$segmento_dois = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
			$this->conecta_mbc($this->app->Conexoes_for);
			switch ($segmento_dois) {
				case 'filtro':

					ver($_REQUEST);
					$familia = $_POST['Familia_txf'];
					$modelos = $this->mbc->executa_sql("select Modelo_txf from pecas_reposicao where Familia_sel='$familia' group by Modelo_txf");

					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelos', $modelos);
					$this->model_smarty->render_ajax('modelos', $this->app->Template_txf);
					break;

				case 'modelo':
					$familia = $_POST['Familia_txf'];
					$modelo = $_POST['Modelo_txf'];
					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelo', $modelo);
					$partnumbers = $this->mbc->executa_sql("select Part_number_txf from pecas_reposicao where Familia_sel='$familia' and Modelo_txf='$modelo' group by Part_number_txf");


					$this->smarty->assign('partnumbers', $partnumbers);
					$this->model_smarty->render_ajax('partnumber', $this->app->Template_txf);
					break;
				case 'partnumber':
					$familia = $_POST['Familia_txf'];
					$modelo = $_POST['Modelo_txf'];
					$partnumber = $_POST['Part_number_txf'];

					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelo', $modelo);
					$this->smarty->assign('partnumber', $partnumber);
					$seriais = $this->mbc->executa_sql("select Serial_number_txf from pecas_reposicao where Familia_sel='$familia' and Modelo_txf='$modelo' and Part_number_txf='$partnumber' group by Serial_number_txf");
					$this->smarty->assign('seriais', $seriais);

					$this->model_smarty->render_ajax('serialnumber', $this->app->Template_txf);
					break;
				case 'serial':
					$familia = $_POST['Familia_txf'];
					$modelo = $_POST['Modelo_txf'];
					$partnumber = $_POST['Part_number_txf'];
					$serialnumber = $_POST['Serial_number_txf'];

					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelo', $modelo);
					$this->smarty->assign('partnumber', $partnumber);
					$pecas_reposicao = $this->mbc->executa_sql("select Id_int from pecas_reposicao where Familia_sel='$familia' and Serial_number_txf='$serialnumber' and Modelo_txf='$modelo' and Part_number_txf='$partnumber' group by Serial_number_txf");
					$this->smarty->assign('pecas_reposicao', $pecas_reposicao);
					$arquivos = $this->mbc->executa_sql("select * from arquivos where Tabela_con='pecas_reposicao'");
					$this->smarty->assign('arquivos', $arquivos);
					$this->model_smarty->render_ajax('arquivos', $this->app->Template_txf);
					break;
			}
		}

		function processa_warn()
		{
			$segmento_dois = $this->uri->segment($this->app->Segmento_padrao_txf + 2);
			$this->conecta_mbc($this->app->Conexoes_for);
			switch ($segmento_dois) {
				case 'familia':
					$familia = $_POST['Familia_txf'];
					$modelos = $this->mbc->executa_sql("select Modelo_txf from pecas_reposicao where Familia_sel='$familia' group by Modelo_txf");

					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelos', $modelos);
					$this->model_smarty->render_ajax('modelos', $this->app->Template_txf);
					break;

				case 'modelo':
					$familia = $_POST['Familia_txf'];
					$modelo = $_POST['Modelo_txf'];
					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelo', $modelo);
					$partnumbers = $this->mbc->executa_sql("select Part_number_txf from pecas_reposicao where Familia_sel='$familia' and Modelo_txf='$modelo' group by Part_number_txf");


					$this->smarty->assign('partnumbers', $partnumbers);
					$this->model_smarty->render_ajax('partnumber', $this->app->Template_txf);
					break;
				case 'partnumber':
					$familia = $_POST['Familia_txf'];
					$modelo = $_POST['Modelo_txf'];
					$partnumber = $_POST['Part_number_txf'];

					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelo', $modelo);
					$this->smarty->assign('partnumber', $partnumber);
					$seriais = $this->mbc->executa_sql("select Serial_number_txf from pecas_reposicao where Familia_sel='$familia' and Modelo_txf='$modelo' and Part_number_txf='$partnumber' group by Serial_number_txf");
					$this->smarty->assign('seriais', $seriais);

					$this->model_smarty->render_ajax('serialnumber', $this->app->Template_txf);
					break;
				case 'serial':
					$familia = $_POST['Familia_txf'];
					$modelo = $_POST['Modelo_txf'];
					$partnumber = $_POST['Part_number_txf'];
					$serialnumber = $_POST['Serial_number_txf'];

					$this->smarty->assign('familia', $familia);
					$this->smarty->assign('modelo', $modelo);
					$this->smarty->assign('partnumber', $partnumber);
					$pecas_reposicao = $this->mbc->executa_sql("select Id_int from pecas_reposicao where Familia_sel='$familia' and Serial_number_txf='$serialnumber' and Modelo_txf='$modelo' and Part_number_txf='$partnumber' group by Serial_number_txf");
					$this->smarty->assign('pecas_reposicao', $pecas_reposicao);
					$arquivos = $this->mbc->executa_sql("select * from arquivos where Tabela_con='pecas_reposicao'");
					$this->smarty->assign('arquivos', $arquivos);
					$this->model_smarty->render_ajax('arquivos', $this->app->Template_txf);
					break;
			}
		}

	}

?>
