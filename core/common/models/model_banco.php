<?php

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');
	require_once('model_banco_basico.php');

	class Model_banco extends model_banco_basico
	{

		function __construct()
		{

			parent::__construct();
			$this->load->library('table');
			$this->load->library('session');
//            $this->session->userdata['url_anterior'] = current_url();
//            $this->load->helper('lands_model');
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
		public function inicializa($param)
		{
			foreach ($param as $key => $value) {
				$this->$key = $value;
			}
		}

		function super_paginacao($tabela, $where = '', $config = null, $query = null, $campo_imagem = null)
		{
			if ($query) {
				$total = count($this->executa_sql($query));
			} else {
				$total_temp = $this->executa_sql("select count(*) as total from $tabela $where");
				$total = $total_temp[0]->total;
			}

//        count($this->buscar_tudo($tabela, $where));
			if (is_object($config)) {
				$config = object_to_array($config);
			}
			$this->load->library('pagination');
			$config['total_rows'] = $total;
			$this->pagination->initialize($config);
			$limite = $this->pagination->per_page;
			$where .= " LIMIT {$limite}";


			if ($this->pagination->page_query_string) {
				$this->pagination->base_url .= "?total=$total";
			}
//        &page=5
			if ($this->pagination->page_query_string == TRUE && $_REQUEST['page']) {
				$offset = $_REQUEST['page'];
				$where .= " OFFSET {$offset}";
			}
			if ($this->pagination->page_query_string == FALSE) {
				if ($this->uri->segment($this->pagination->uri_segment)) {
					$offset = $this->uri->segment($this->pagination->uri_segment);
					$where .= " OFFSET {$offset}";
				}
			}

			$retorno = new stdClass();
			if ($query) {
				$retorno->registros = $this->executa_sql($query . $where);
			} else {
				$retorno->registros = $this->buscar_completo($tabela, $where, $campo_imagem);
			}
			$retorno->paginacao = $this->pagination->create_links();

			return $retorno;
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
		function buscar_imagens_videos($tabela, $and = "")
		{


			$query = $this->db->query("SELECT distinct a.*, i.Caminho_txf, v.Endereco_txf 
                        FROM $tabela a           
			LEFT OUTER JOIN imagens i ON                        i.Id_imagem_con = a.Id_int
                        LEFT OUTER JOIN videos v ON                        v.Id_video_con = a.Id_int
                        LEFT OUTER JOIN comentarios c ON                        c.Id_objeto_con = a.Id_int
                        WHERE (i.Tabela_con = '$tabela' or v.Tabela_con='$tabela') $and
    ");


			$result = $query->result();


//       $array = array();
//
//        foreach ($result as $key => $valor) {
//            if (in_array($valor->Id_int, $array)) {
//                unset($result[$key]);
//            } else {
//                $array[] = $valor->Id_int;
//            }
//        }
			return $result;
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
		function seta_idioma($idioma)
		{
			$this->db->query("SET lc_time_names = '$idioma'");
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
		function executa_sql($sql, $retorno = 'true')
		{
			//die( "vai executar a query $sql");//die('chegou no executa sql');
			$dados['lc_time_names'] = 'pt_BR';

			$query = $this->db->query($sql);
			if (!is_bool($query)) {

				if ($retorno == 'false') {
					return true;
				} else {
					$result = $query->result();
				}

				if ($query->num_rows() >= 1)
					return $result;
				else
					return false;
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
		function buscar_desc_imagens($tabela, $and = "")
		{
			$val = str_replace("where", "and", $and);
			$val = str_replace("order by Id_int", "order by Id_int, i.Id_int", $val);
			$sql = "SELECT a.*, i.Caminho_txf
                        FROM $tabela a           
			LEFT OUTER JOIN imagens i ON i.Id_imagem_con = a.Id_int
                        WHERE (i.Tabela_con is null or i.Tabela_con = '$tabela' )" . $val . " 
        ";


			$query = $this->db->query($sql);


			$result = $query->result();


			$array = array();

			foreach ($result as $key => $valor) {
				if (in_array($valor->Id_int, $array)) {
					unset($result[$key]);
				} else {
					$array[] = $valor->Id_int;
				}
			}
			return $result;
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
		function buscar_registro_imagens_videos($tabela, $and = "")
		{
			$val = str_replace("where", "and", $and);

			$sql = "SELECT * from " . $tabela . " where Id_int is not null " . $val;
			$query = $this->db->query($sql);
			$result = $query->result();
			$query_imagens = $this->db->query("select * from imagens where Tabela_con='$tabela' order by Id_int");
			$imagens = $query_imagens->result();

			$query_videos = $this->db->query("select * from videos where Tabela_con='$tabela' order by Id_int");
			$videos = $query_videos->result();


			foreach ($result as $key => $registro) {

				foreach ($imagens as $imagem) {
					if ($result[$key]->Id_int == $imagem->Id_imagem_con) {
						$result[$key]->Imagens[] = $imagem;
					}
				}
				foreach ($videos as $video) {
					if ($result[$key]->Id_int == $video->Id_video_con) {
						$result[$key]->Videos[] = $video;
					}
				}

				if (!isset($result[$key]->Imagens[0])) {
					$result[$key]->Imagens = array();
				}
				if (!isset($result[$key]->Videos[0])) {
					$result[$key]->Videos = array();
				}
			}
			$array = array();

			foreach ($result as $key => $valor) {
				if (in_array($valor->Id_int, $array)) {
					unset($result[$key]);
				} else {
					$array[] = $valor->Id_int;
				}
			}

			return $result;
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
		function buscar_completo($tabela, $and = "", $campo_imagem = "", $campos = "*")
		{

			$val = str_replace("where", "and", $and);

			$sql = "SELECT $campos from " . $tabela . " where Id_int is not null " . $val;

//        ver($sql,1);
			$query = $this->db->query($sql);
			$result = $query->result();

			$result = $this->complementa_registros($result, $tabela, $campo_imagem);
			return $result;
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
		function buscar_completo_vin($tabela, $and = "", $campo_imagem = "", $campos = "*")
		{

			$val = str_replace("where", "and", $and);

			$sql = "SELECT $campos from " . $tabela . " where Id_int is not null " . $val;

			$campos_vin = array();
			$colunas = $this->executa_sql("show columns from $tabela");

			foreach ($colunas as $coluna) {
				$nome_campo = $coluna->Field;
				if (retorna_extensao($nome_campo) == 'vin') {
					$campo_vin = new stdClass();
					$campo_vin->Campo = $nome_campo;
					$campo_vin->Tabela = strtolower(remove_sufixo($nome_campo));
					$campos_vin[] = $campo_vin;
				}
			}

//        ver($sql,1);
			$query = $this->db->query($sql);
			$result = $query->result();
			$result = $this->complementa_registros($result, $tabela, $campo_imagem);

			if (isset($campos_vin[0])) {
//            ver($result,1);
//            ver($tabela,1);
//            ver($campos_vin,1);
				$result = $this->busca_vins($result, $tabela, $campos_vin);
			}
//        ver($result);
			return $result;
		}

		function busca_vins($result, $tabela = null, $campos_vin = null, $completa_registros = false)
		{

			$app = $this->load->module('apps');

			foreach ($result as $registro) {
//            ver($registro);
				foreach ($campos_vin as $campo) {
					$where = '';
					$nome_campo = $campo->Campo;
					if ($this->campoexiste('Ativo_sel', $campo->Tabela)) {
						$where = " and Ativo_sel='SIM'";
					}
					if ($this->campoexiste('Exibe_inicio_sel', $campo->Tabela) && $app->pagina_atual == $app->app->Pagina_inicial_txf) {
						$where .= " and Exibe_inicio_sel='SIM'";
					}
					if ($this->campoexiste('Ordenacao_txf', $campo->Tabela)) {
						$where .= " order by Ordenacao_txf";
					}
//					error_reporting(E_ALL);
					$registro->$nome_campo = $this->buscar_tudo($campo->Tabela, "where Id_objeto_con={$registro->Id_int} and Tabela_con='{$tabela}' $where");

					$registro->$nome_campo = complementa_registros($registro->$nome_campo, $campo->Tabela, 'Imagens_ico');

				}
			}
			return $result;
		}

		function complementa_registros($result, $tabela, $campo_imagem = null)
		{

			$sql = "select * from imagens where Tabela_con='$tabela'";

			if ($campo_imagem) {
				$sql .= " and Campo_sel='$campo_imagem' ";
			}
			$sql .= " order by Ordem_int,Id_int";

			if ($this->tabelaexiste("imagens")) {
				$query_imagens = $this->db->query($sql);
				$imagens = $query_imagens->result();
			}

			if ($this->tabelaexiste("videos")) {
				$query_videos = $this->db->query("select * from videos where Tabela_con='$tabela' order by Id_int");
				$videos = $query_videos->result();
			}
			if ($this->tabelaexiste("arquivos")) {
				$query_arquivos = $this->db->query("select * from arquivos where Tabela_con='$tabela' order by Id_int");
				$arquivos = $query_arquivos->result();
			}


			if ($this->tabelaexiste("notas")) {
				$query_notas = $this->db->query("select * from notas where Tabela_con='$tabela' order by Numero_txf");
				$notas = $query_notas->result();
			}

			if ($this->tabelaexiste("tags")) {
				$campo_ord = 'Id_int';
				if ($this->field_exists('Nome_txf', 'tags')) {
					$campo_ord = 'Nome_txf';
				} else {
					if ($this->field_exists('Palavra_txf', 'tags')) {
						$campo_ord = 'Palavra_txf';
					}
				}
				$query_tags = $this->db->query("select * from tags where Tabela_con='$tabela' order by $campo_ord");
				$tags = $query_tags->result();
			}

//ver($result);


			foreach ($result as $key => $registro) {

				foreach ($imagens as $imagem) {
					if ($result[$key]->Id_int == $imagem->Id_imagem_con) {
						$result[$key]->Imagens[] = $imagem;
					}
				}
				foreach ($videos as $video) {
					if ($result[$key]->Id_int == $video->Id_video_con) {
						$result[$key]->Videos[] = $video;
					}
				}
				if (isset($arquivos)) {
					foreach ($arquivos as $arquivo) {
						if ($result[$key]->Id_int == $arquivo->Id_arquivo_con) {
							$result[$key]->Arquivos[] = $arquivo;
						}
					}
				}

				if (isset($notas)) {
					foreach ($notas as $nota) {
						if ($result[$key]->Id_int == $nota->Id_objeto_con) {
							$result[$key]->Notas[] = $nota;
						}
					}
				}

				if (isset($tags)) {
					foreach ($tags as $tag) {
						if ($result[$key]->Id_int == $tag->Id_objeto_con) {
							$result[$key]->Tags[] = $tag;
						}
					}
				}

				if (!isset($result[$key]->Imagens[0])) {
					$result[$key]->Imagens = array();
				}
				if (!isset($result[$key]->Videos[0])) {
					$result[$key]->Videos = array();
				}
				if (!isset($result[$key]->Arquivos[0])) {
					$result[$key]->Arquivos = array();
				}
				if (!isset($result[$key]->Notas[0])) {
					$result[$key]->Notas = array();
				}
				if (!isset($result[$key]->Tags[0])) {
					$result[$key]->Tags = array();
				}
			}
			$array = array();

			foreach ($result as $key => $valor) {
				if (in_array($valor->Id_int, $array)) {
					unset($result[$key]);
				} else {
					$array[] = $valor->Id_int;
				}
			}

			return $result;
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
		function buscar_desc_imagens_duplo($tabela, $tabela2 = null, $and = "")
		{
			$val = str_replace("where", "and", $and);
			$val = str_replace("order by Id_int", "order by Id_int, i.Id_int", $val);

			$query = $this->db->query("SELECT a.*, b.*, i.Caminho_txf
                        FROM $tabela a           
			LEFT OUTER JOIN imagens i ON i.Id_imagem_con = a.Id_int
			LEFT OUTER JOIN $tabela2 b ON b.Id_" . $tabela . "_con = a.Id_int
                        WHERE (i.Tabela_con is null or i.Tabela_con = '$tabela' ) 
						and (b.Id_" . $tabela . "_con if null or b.Id_" . $tabela . "_con='$tabela' )" . $val . " 
        ");

			$result = $query->result();
			$array = array();

			foreach ($result as $key => $valor) {
				if (in_array($valor->Id_int, $array)) {
					unset($result[$key]);
				} else {
					$array[] = $valor->Id_int;
				}
			}
			return $result;
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
		function gera_url($string, $enc = "UTF-8")
		{
			$a = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ";

			$b = "aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr";

			$string = utf8_decode($string);

			$string = strtr($string, utf8_decode($a), $b); //substitui letras acentuadas por "normais"

			$string = str_replace(" ", "_", $string); // retira espaco

			$string = strtolower($string); // passa tudo para minusculo

			return utf8_encode($string); //finaliza, gerando uma saída para a funcao
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
		function buscar($tabela)
		{
			$dados = $this->session->all_userdata();
			if (!isset($valor))
				$valor = $this->input->post('valor');

			$dados['busca'][$tabela] = $this->get_busca($tabela, $valor);
			return $dados['busca'];
		}

		//funcao generica que procura pelo like em todos os campos da tabela;

		/**
		 * Initialize the user preferences
		 *
		 * Accepts an associative array as input, containing display preferences
		 *
		 * @access  public
		 * @param array  config preferences
		 * @return  void
		 */
		function busca_posts($tabela = null, $valor = null, $limite = null, $campos = null, $imagens = null)
		{


			if (!isset($campos)) {
				$campos = $this->db->list_fields($tabela);
			}
			if ($valor === null) {
				$valor = $this->input->post('buscar');
			}

			//   $query = $this->db->like('id', $valor);
			$pesq = "SELECT * FROM " . $tabela . " a ";


			$pesq .= " WHERE ((a.Id_int is null ) ";


//            $valor=  str_replace('de', '',$valor);
//            $valor=  str_replace('da', '',$valor);
//            $valor=  str_replace('do', '',$valor);
//             $valor=  str_replace('em', '',$valor);
			$valor = str_replace('  ', ' ', $valor);
			if (isset($_REQUEST['Tipo_busca_txf'])) {
				if ($_REQUEST['Tipo_busca_txf'] == 'exata') {
					$valores[0] = $valor;
				}
			} else {
				$valores = explode(' ', $valor);
			}


			foreach ($valores as $valor) {
				foreach ($campos as $campo) {
					$pesq .= " OR (a." . $campo . " LIKE '%" . $valor . "%') ";
				}
			}
			$pesq .= " ) ";

			if ($this->campoexiste("Ativo_sel", $tabela)) {
				$pesq .= " and a.Ativo_sel='SIM' ";
			}

			if ($tabela == 'post') {
				$pesq .= " order by Data_dat DESC";
			}
//        ver($pesq);
//
			if (isset($limite))
				$pesq .= "LIMIT " . $limite;


			$query = $this->db->query("$pesq");
			$result = $query->result();

			$result = $this->complementa_registros($result, $tabela);

			return $result;
		}

//funcao generica que procura pelo like em todos os campos da tabela;

		/**
		 * Initialize the user preferences
		 *
		 * Accepts an associative array as input, containing display preferences
		 *
		 * @access  public
		 * @param array  config preferences
		 * @return  void
		 */
		function get_busca($tabela = null, $valor = null, $limite = null, $campos = null, $imagens = null)
		{


			if (!isset($campos)) {
				$campos = $this->db->list_fields($tabela);
			} else {
				$campos_salva = $campos;
				$campos = [];
				foreach ($this->db->list_fields($tabela) as $campo_tabela) {
					if (array_search($campo_tabela, $campos_salva) !== false) {
						$campos[] = $campo_tabela;
					}
				};
			}

			$tem_id_int = false;
			if ($this->campoexiste('Id_int', $tabela)) {
				$tem_id_int = true;
			}

			if ($valor === null) {
				$valor = $this->input->post('buscar');
			}

			//   $query = $this->db->like('id', $valor);
			$pesq = "SELECT * FROM " . $tabela . " a ";
			if (isset($imagens) && $tem_id_int === true) {
				$pesq .= " LEFT OUTER JOIN imagens i ON i.Id_imagem_con = a.Id_int ";
			}
			if ($tem_id_int === true) {
				$pesq .= " WHERE ((a.Id_int is null ) ";
			} else {
				$pesq .= " WHERE ((a." . $campos[0] . " is null ) ";
			}

//            $valor=  str_replace('de', '',$valor);
//            $valor=  str_replace('da', '',$valor);
//            $valor=  str_replace('do', '',$valor);
//             $valor=  str_replace('em', '',$valor);
			$valor = str_replace('  ', ' ', $valor);
			if (isset($_REQUEST['Tipo_busca_txf'])) {
				if ($_REQUEST['Tipo_busca_txf'] == 'exata') {
					$valores[0] = $valor;
				}
			} else {
				$valores = explode(' ', $valor);
			}


			foreach ($valores as $valor) {
				foreach ($campos as $campo) {
					$pesq .= " OR (a." . $campo . " LIKE '%" . $valor . "%') ";
				}
			}
			$pesq .= " ) ";

			if ($this->campoexiste("Ativo_sel", $tabela)) {
				$pesq .= " and a.Ativo_sel='SIM' ";
			}

			if (isset($limite))
				$pesq .= "LIMIT " . $limite;

			$query = $this->db->query("$pesq");
			$result = $query->result();

			$result = $this->complementa_registros($result, $tabela);

			return $result;
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
		function myquery($sql)
		{
			return $this->db->query($sql);
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
		function get_busca_param($tabela = null, $valor = null, $limite = null, $campos = null, $param = null)
		{
			if (!isset($campos)) {
				$campos = $this->db->list_fields($tabela);
			}
			//   $query = $this->db->like('id', $valor);
			$pesq = "SELECT * FROM " . $tabela;
			$pesq .= " WHERE ((id LIKE '%" . $valor . "%') ";
			foreach ($campos as $campo) {
				$pesq .= " OR (" . $campo . " LIKE '%" . $valor . "%') ";
			}
			$pesq .= " ) ";
			if (isset($limite))
				$pesq .= "LIMIT " . $limite;

			$query = $this->db->query("$pesq");
			$result = $query->result_array();
			return $result;
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
		function get_busca_obj($tabela = null, $valor = null, $limite = null, $campos = null)
		{
			if (!isset($campos)) {
				$campos = $this->db->list_fields($tabela);
			}
			//   $query = $this->db->like('id', $valor);
			$pesq = "SELECT * FROM " . $tabela;
			$pesq .= " WHERE ((Id_int LIKE '%" . $valor . "%') ";
			foreach ($campos as $campo) {
				$pesq .= " OR (" . $campo . " LIKE '%" . $valor . "%') ";
			}
			$pesq .= " ) ";
			if (isset($limite))
				$pesq .= "LIMIT " . $limite;
			$query = $this->db->query("$pesq");
			$result = $query->result_object();
			return $result;
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
		function valores_paginacao_generic($app, $pagina_atual, $tabela, $where = "", $pagina = '1', $quantidade_registros = '6', $segment2 = '')
		{

			if ($segment2 != '') {
				$segment2 .= '/';
			}


			$registros = array();
			$registros = (object)$registros;
			$inicio = 0;

			if ($pagina != 1) {
				$inicio = ($pagina - 1) * $quantidade_registros;
			}

			$query = $this->db->query("SELECT * FROM $tabela $where");
			$registros->quantidade = count($query->result());
			$query_reg = $this->db->query("SELECT * FROM $tabela $where LIMIT $inicio, $quantidade_registros");
			$registros->registros = $query_reg->result();
			$registros->registros = $this->complementa_registros($registros->registros, $tabela);
			$registros->total_paginas = ceil($registros->quantidade / $quantidade_registros);
			$registros->prev = $pagina - 1;
			$registros->next = $pagina + 1;
			$registros->pagina = $pagina;
			if ($registros->pagina > 1) {
				$registros->prev_link = $registros->prev;
			} else {
				$registros->prev_link = "";
			}
			if ($registros->total_paginas > $registros->pagina) {
				$registros->next_link = $registros->next;
			} else {
				$registros->next_link = "";
			}
			if ($registros->total_paginas > 1) {
				$var = '<div class="pagination pagination-large pagination-centered "><ul class="pagination">';
				$painel = "";
				if ($registros->prev_link != "") {
					$var .= '<li><a href="' . $app->Url_cliente . $pagina_atual . '/' . $segment2 . $registros->prev_link . '" title="Anterior">«</a></li>';
				} else {
					$var .= "<li class=''><span>«</span></li>";
				}


				for ($x = 1; $x <= $registros->total_paginas; $x++) {
					if ($x != $registros->pagina) {
						switch ($x) {
							case 1:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->total_paginas:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina - 3:
								$var .= "<li><span>..</span></li>";
								break;
							case $registros->pagina - 2:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina - 1:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina + 1:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina + 2:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina + 3:
								$var .= "<li><span>..</span></li>";
								break;
						}
					} else {
						$var .= "<li class='active'><span>$x</span></li>";
					}
				}

				/*    for ($x = 1; $x <= $registros->total_paginas; $x++) {
					if ($x == $registros->pagina) {
					$var .= "<li class='active'><span>$x</span></li>";
					} else {
					$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2.$x . "'>$x</a></li>";
					}
					}
				 */

				if ($registros->next_link != "") {

					$var .= '<li><a href ="' . $app->Url_cliente . $pagina_atual . '/' . $segment2 . $registros->next_link . '" title = "Próxima">»</a></li>';
				} else {
					$var .= "<li class = 'active'><span>»<span></li>";
				}
				$var .= "</ul></div>";
				$registros->paginacao = $var;
			}

			return $registros;
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
		function get_busca_array($tabela = null, $valor = null, $limite = null, $campos = null)
		{
			if (!isset($campos)) {
				$campos = $this->db->list_fields($tabela);
			}
			//   $query = $this->db->like('id', $valor);
			$pesq = "SELECT * FROM " . $tabela;
			$pesq .= " WHERE ((id LIKE '%" . $valor . "%') ";
			foreach ($campos as $campo) {
				$pesq .= " OR (" . $campo . " LIKE '%" . $valor . "%') ";
			}
			$pesq .= " ) ";
			if (isset($limite))
				$pesq .= "LIMIT " . $limite;
			$query = $this->db->query("$pesq");
			$result = $query->result_array();
			return $result;
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
		function get_usuario_details($id = false)
		{
			if (isset($id)) {
				$query = $this->db->query("SELECT u.id, u.id_empresa, u.id_tipo, u.nome as nomeusuario, e.nome as nomeempresa, t.nome as tipoacesso, u.usuario, u.senha, u.ativo, 
                                u.ultima_alteracao, u.id_gerenciador_unico
                                FROM usuarios u
                                LEFT OUTER JOIN servicos_empresas e ON u.id_empresa = e.id 
                                LEFT OUTER JOIN usuarios_tipo t ON u.id_tipo = t.id
                                WHERE (u.id=" . $id . ")");

				$result = $query->result();
				return $result;
			} else
				return false;
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
		function buscar_pelo_id($tabela, $id = null)
		{
			// if (!isset($valorchave) || !isset($chaveprimaria)) {
			if (isset($id)) {

				$query = $this->db->query("SELECT * FROM " . $tabela . " WHERE id=" . $id);
			} else {
				$query = $this->db->query("SELECT * FROM " . $tabela);
			}
			$result = $query->result();

			return $result;
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
		function buscar_tudo($tabela, $where = '', $campos = ' * ')
		{
			$sql = "SELECT $campos FROM $tabela $where";
//			ver($this->db);
			$query = $this->db->query($sql);

			$result = $query->result();
//			ver($this->db->query($sql));
			return $result;
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
		function valores_paginacao($tabela, $where = "", $pagina = '1', $quantidade_registros = '6')
		{
			$registros = array();
			$registros = (object)$registros;
			$inicio = 0;

			if ($pagina != 1) {
				$inicio = ($pagina - 1) * $quantidade_registros;
			}

			$query = $this->db->query("SELECT * FROM $tabela where 1 = '1' $where");

			$registros->quantidade = count($query->result());

			$registros->registros = $this->buscar_desc_imagens($tabela, "$where LIMIT $inicio, $quantidade_registros");

			$registros->total_paginas = ceil($registros->quantidade / $quantidade_registros);

			$registros->prev = $pagina - 1;
			$registros->next = $pagina + 1;
			$registros->pagina = $pagina;

			if ($registros->pagina > 1) {
				$registros->prev_link = $registros->prev;
			} else {
				$registros->prev_link = "";
			}

			if ($registros->total_paginas > $registros->pagina) {
				$registros->next_link = $registros->next;
			} else {
				$registros->next_link = "";
			}

			return $registros;
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
		function comparavalores($tabela, $campo1, $campo2, $valor1, $valor2)
		{

			$this->db->where($campo1, $valor1);
			$this->db->where($campo2, $valor2);
			$query = $this->db->get($tabela);

			if ($query->num_rows == 1) {
				$result = $query->result();
			} else {
				$result = false;
			}

			return $result;
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
		function buscartabelasimples($tabela, $chaveprimaria, $valorchave)
		{
			$query = $this->db->query("SELECT * FROM " . $tabela . " WHERE " . $chaveprimaria . " = '" . $valorchave . "'");
			$result = $query->result();
			if ($query->num_rows() == 1)
				return $result;
			else
				return false;
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
		function buscartabela($tabela, $chaveprimaria = null, $valorchave = null, $campos = null)
		{
			//   echo "<br>chegou no model BANCO!! trazendo o paramtro EMAIL = " . $valorchave;
			// echo "<br>vai procurar o EMAIL " . $valorchave;
			// echo "<br> no CAMPO " . $chaveprimaria;
			// echo "<br> da TABELA " . $tabela;

			if ($this->tabelaexiste($tabela)) {
				//echo "<br> Encontrou a TABELA " . $tabela;
				if (!isset($valorchave) || !isset($chaveprimaria)) {
					$query = $this->db->query('SELECT * FROM ' . $tabela);
				} else {

					if ($this->campoexiste($chaveprimaria, $tabela)) {
						//                echo "<br> Encontrou o CAMPO ".$chaveprimaria;

						$query = $this->db->query('SELECT * FROM ' . $tabela . ' WHERE ' . $chaveprimaria . ' = "' . $valorchave . '"');

						//   $this->montarcabecalho($tabela);
						//       echo "<br> Query resultado<br> " . $tabela;
						$result = $query->result();
						//     $xxx[]=($result);
						if ($query->num_rows() == 1)
							return $result;
						else
							return false;
					} else {
						return false;
					}
				}
			} else
				return false;
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
		function buscarvarios($tabela, $chaveprimaria = null, $valorchave = null, $limite = null)
		{
			//   echo "<br>chegou no model BANCO!! trazendo o paramtro EMAIL = " . $valorchave;
			// echo "<br>vai procurar o EMAIL " . $valorchave;
			// echo "<br> no CAMPO " . $chaveprimaria;
			// echo "<br> da TABELA " . $tabela;

			if ($this->tabelaexiste($tabela)) {
				//echo "<br> Encontrou a TABELA " . $tabela;
				if (!isset($valorchave) || !isset($chaveprimaria)) {
					$query = $this->db->query('SELECT * FROM ' . $tabela);
				} else {

					if ($this->campoexiste($chaveprimaria, $tabela)) {
						//                echo "<br> Encontrou o CAMPO ".$chaveprimaria;

						$query = $this->db->query('SELECT * FROM ' . $tabela . ' WHERE ' . $chaveprimaria . ' = "' . $valorchave . '" LIMIT ' . $limite . '');

						//   $this->montarcabecalho($tabela);
						//       echo "<br> Query resultado<br> " . $tabela;
						$result = $query->result();
						//     $xxx[]=($result);

						return $result;
					} else {
						return false;
					}
				}
			} else
				return false;
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
		function valores_paginacao_categoria($app, $pagina_atual, $tabela, $where = "", $pagina = '1', $quantidade_registros = '6', $segment2 = '')
		{

			if ($segment2 != '') {
				$segment2 .= '/';
			}


			$registros = array();
			$registros = (object)$registros;
			$inicio = 0;

			if ($pagina != 1) {
				$inicio = ($pagina - 1) * $quantidade_registros;
			}

			$query = $this->db->query("SELECT * FROM $tabela $where");
			$registros->quantidade = count($query->result());
			$query_reg = $this->db->query("SELECT * FROM $tabela $where LIMIT $inicio, $quantidade_registros");
			$registros->registros = $query_reg->result();
			$registros->registros = $this->complementa_registros($registros->registros, $tabela);
			$registros->total_paginas = ceil($registros->quantidade / $quantidade_registros);
			$registros->prev = $pagina - 1;
			$registros->next = $pagina + 1;
			$registros->pagina = $pagina;
			if ($registros->pagina > 1) {
				$registros->prev_link = $registros->prev;
			} else {
				$registros->prev_link = "";
			}
			if ($registros->total_paginas > $registros->pagina) {
				$registros->next_link = $registros->next;
			} else {
				$registros->next_link = "";
			}
			if ($registros->total_paginas > 1) {
				$var = '<div class="pagination pagination-large pagination-centered "><ul class="pagination">';
				$painel = "";
				if ($registros->prev_link != "") {
					$var .= '<li><a href="' . $app->Url_cliente . $pagina_atual . '/' . $segment2 . $registros->prev_link . '" title="Anterior">«</a></li>';
				} else {
					$var .= "<li class=''><span>«</span></li>";
				}


				for ($x = 1; $x <= $registros->total_paginas; $x++) {
					if ($x != $registros->pagina) {
						switch ($x) {
							case 1:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->total_paginas:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina - 3:
								$var .= "<li><span>..</span></li>";
								break;
							case $registros->pagina - 2:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina - 1:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina + 1:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina + 2:
								$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2 . $x . "'>$x</a></li>";
								break;
							case $registros->pagina + 3:
								$var .= "<li><span>..</span></li>";
								break;
						}
					} else {
						$var .= "<li class='active'><span>$x</span></li>";
					}
				}

				/*    for ($x = 1; $x <= $registros->total_paginas; $x++) {
					if ($x == $registros->pagina) {
					$var .= "<li class='active'><span>$x</span></li>";
					} else {
					$var .= "<li><a href='" . $app->Url_cliente . $pagina_atual . "/" . $segment2.$x . "'>$x</a></li>";
					}
					}
				 */

				if ($registros->next_link != "") {

					$var .= '<li><a href ="' . $app->Url_cliente . $pagina_atual . '/' . $segment2 . $registros->next_link . '" title = "Próxima">»</a></li>';
				} else {
					$var .= "<li class = 'active'><span>»<span></li>";
				}
				$var .= "</ul></div>";
				$registros->paginacao = $var;
			}

			return $registros;
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
		function valores_paginacao_generic_categoria($tabela, $where = "", $pagina = '1', $quantidade_registros = '6')
		{
			$registros = array();
			$registros = (object)$registros;
			$inicio = 0;

			if ($pagina != 1) {
				$inicio = ($pagina - 1) * $quantidade_registros;
			}


			$val = str_replace("where", "and", $where);
			$val = str_replace("order by Id_int", "order by Id_int, i.Id_int", $val);
			$sql = "SELECT a.*, i.Caminho_txf
                        FROM $tabela a           
			LEFT OUTER JOIN imagens i ON i.Id_imagem_con = a.Id_int
                        WHERE (i.Tabela_con is null or i.Tabela_con = '$tabela' )" . $val . " 
        ";

			$query = $this->db->query($sql);


			//   $this->buscar_completo($tabela,$where);
//echo 'querryyyyy<br>';
//            $xxx[]=(count($query->result())); die();
//            $registros;


			$registros->quantidade = count($query->result());


			$query_reg = $this->db->query("$sql LIMIT $inicio, $quantidade_registros");


			$registros->registros = $query_reg->result();


			$registros->total_paginas = ceil($registros->quantidade / $quantidade_registros);

			$registros->prev = $pagina - 1;
			$registros->next = $pagina + 1;
			$registros->pagina = $pagina;

			if ($registros->pagina > 1) {
				$registros->prev_link = $registros->prev;
			} else {
				$registros->prev_link = "";
			}

			if ($registros->total_paginas > $registros->pagina) {
				$registros->next_link = $registros->next;
			} else {
				$registros->next_link = "";
			}

			if ($registros->total_paginas > 1) {
				$var = "<ul class='paginacao'>";
				$painel = "";
				if ($registros->prev_link != "") {
					$var .= '<li><a href="' . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $registros->prev_link . '" title="Anterior">Anterior</a></li>';
				} else {
					$var .= "<li class='atual'>Anterior</li>";
				}

				for ($x = 1; $x <= $registros->total_paginas; $x++) {
					if ($x == $registros->pagina) {
						$var .= "<li class='atual'>$x</li>";
					} else {
						$var .= "<li><a href='" . $this->uri->segment(1) . '/' . $this->uri->segment(2) . "/$x'>$x</a></li>";
					}
				}

				if ($registros->next_link != "") {

					$var .= '<li><a href = "' . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $registros->next_link . '" title = "Próxima">Próxima</a></li>';
				} else {
					$var .= "<li class = 'atual'>Próxima</li>";
				}
				$var .= "</ul>";

				$registros->view_paginas = $var;
			}


			return $registros;
		}

	}

	//close:class:standartdb_model

	/* End of file standartdb_model.php	 */
	/* Location: ./application/models/standartdb_model.php */

