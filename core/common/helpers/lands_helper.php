<?php

	use Madcoda\Youtube;

	if (!defined('BASEPATH'))
		exit('No direct script access allowed');

	include_once 'linguagem_helpers.php';

	if (!function_exists('is_url')) {

		function is_url($url)
		{

			if (filter_var($url, FILTER_VALIDATE_URL)) {
				return true;
			}

			return false;

		}

	}

	if (!function_exists('file_get_contents_headers')) {

		function file_get_contents_headers($url, $headers)
		{

			$opts = [
				"http" => [
					"method" => "GET",
					"header" => $headers
				]
			];

			$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
			$file = file_get_contents($url, false, $context);

			return $file;
		}

	}

	if (!function_exists('fake_iframe')) {

		function fake_iframe($url)
		{
			$conteudo_iframe = file_get_contents($url);
			echo $conteudo_iframe;
		}

	}

	if (!function_exists('titulo')) {

		//$type pode ser "tit" ou "sub"
		function titulo($field, $type = 'tit', $array = null)
		{
			try {

				$existe = executa_sql("SHOW TABLES LIKE 'titulos'");

				if (is_null($array) && $existe[0]) {
					$array = executa_sql("select * from titulos where Campo_txf='{$field}'");
				}

				foreach ($array as $element) {
					if ($element->Campo_txf == $field) {
						if ($type == 'tit') {
							if ($element->Titulo_txa) {
								return $element->Titulo_txa;
							}
							return $element->Titulo_txf;
						} else if ($type == 'sub') {
							return $element->Subtitulo_txa;
						} else if ($type == 'desc') {
							return $element->Descricao_txa;
						}
					}
				}
				return $type == 'tit' ? "!!{{$field}}!!" : "";
			} catch (Exception $e) {
				return "!!!Titulo faltando!!!";
			}
		}

	}

	if (!function_exists('trans')) {

		function trans($field)
		{

			$CI = &get_instance();
			$app = $CI->model_banco->app;

			if ($app->Traducao) {
				if ($app->Traducao->{$field}) {
					return $app->Traducao->{$field};
				}
			}

			return '**' . $field . '**';

		}

	}

	if (!function_exists('config')) {

		function config($field)
		{

			$CI = &get_instance();
			$app = $CI->model_banco->app;

			if ($app->Site_config) {
				if ($app->Site_config->{$field}) {
					return $app->Site_config->{$field};
				}
			}

			return '**config = ' . $field . '**';

		}

	}

	if (!function_exists('get_object')) {

		function get_object($array, $field, $cond, $value, $retorna_unico = true)
		{
			if (is_object($array)) {
				$array = object_to_array($array);
			}
			$array_retorno = array();

			foreach ($array as $element) {

				switch ($cond) {

					case '!=':
						if ($element->$field != $value) {
							$array_retorno[] = $element;
						};
					case '>':
						if ($element->$field > $value) {
							$array_retorno[] = $element;
						};
						break;

					case '>=':
						if ($element->$field >= $value) {
							$array_retorno[] = $element;
						};
						break;

					case '<':
						if ($element->$field < $value) {
							$array_retorno[] = $element;
						};
						break;
					case '<=':
						if ($element->$field <= $value) {
							$array_retorno[] = $element;
						};
						break;
					case '==':
						if ($element->$field == $value) {
							$array_retorno[] = $element;
						};
						break;
					default:
						if ($element->$field == $value) {
							$array_retorno[] = $element;
						};

						break;
				}
			}

			$array_retorno = json_decode(json_encode($array_retorno));

			return $array_retorno;
		}

	}

	if (!function_exists('arruma_nome')) {

		function arruma_nome($texto)
		{
			$texto = mb_strtolower($texto);
			$ignorar = ['e', 'da', 'de', 'dos'];
			$palavras = explode(' ', $texto);

			foreach ($palavras as &$palavra) {
				if (in_array($palavra, $ignorar)) {
					$palavra = lcfirst($palavra);
				} else {
					$palavra = ucfirst($palavra);
				}
			}

			return join(' ', $palavras);
		}

	}

	if (!function_exists('generatePIN')) {

		function generatePIN($digits = 4)
		{
			$i = 0; //counter
			$pin = ""; //our default pin is blank.
			while ($i < $digits) {
				//generate a random number between 0 and 9.
				$pin .= mt_rand(0, 9);
				$i++;
			}
			return $pin;
		}

	}

	if (!function_exists('formata_preco')) {

		function formata_preco($preco)
		{
			return number_format((float)$preco, 2, ',', '.');
		}

	}

	if (!function_exists('corta_texto')) {

		function corta_texto($texto, $tamanho = 150, $pontos = FALSE)
		{
			$resposta = mb_substr(strip_tags(html_entity_decode(ignora_tags($texto))), 0, $tamanho);
			if ($pontos) {
				if (mb_strlen($texto) > $tamanho) {

					$resposta .= $pontos;
				}
			}
			return $resposta;
		}

	}

	if (!function_exists('instagram_usuario')) {

		function instagram_usuario($url)
		{
			preg_match_all('/(?:(?:http|https):\/\/)?(?:www.)?(?:instagram.com|instagr.am)\/([A-Za-z0-9-_\.]+)/im', $url, $matches);

			if (isset($matches[1][0])) {
				return $matches[1][0];
			}

			return null;
		}

	}

	if (!function_exists('primeira_imagem')) {

		function primeira_imagem($texto)
		{
			preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $texto, $matches);
			$first_img = $matches[1][0];
			return $first_img;
		}

	}

	if (!function_exists('primeira_palavra')) {

		function encurta_nome($string)
		{
			$partes = explode(' ', $string);
			$id = end(array_keys($partes));

			$resposta = $partes[0] . ' ' . $partes[$id];
			if ($partes[0] == $partes[$id]) {
				return $partes[0];
			}
			$tamanho = strlen($resposta);
			if ($tamanho <= 18) {
				return $resposta;
			} else {
				if ($partes[0]) {
					return $partes[0];
				}
			}
			return '';
		}

	}

	if (!function_exists('parseia_feed')) {

		function parseia_feed($url)
		{
			$xml = simplexml_load_string(file_get_contents($url), "SimpleXMLElement", LIBXML_NOCDATA);
			$json = json_encode($xml);
			return json_decode($json, true);
		}

	}

	if (!function_exists('verifica_vazio')) {

		function verifica_vazio($string)
		{
			return empty(trim(strip_tags(html_entity_decode($string))));
		}

	}

	if (!function_exists('texto_calculadora')) {

		function texto_calculadora($array, $passo, $campo)
		{
			foreach ($array as $registro) {
				if ($passo == $registro->Etapa_campo_txf && $campo == $registro->Nome_campo_txf) {
					return $registro->Texto_campo_txa;
				}
			}
		}

	}

	if (!function_exists('entre_datas')) {

		function entre_datas($inicio, $fim)
		{
			$data = date('Y-m-d');
			if ($data >= $inicio && $data <= $fim) {
				return true;
			} else {
				return false;
			}
		}

	}

	if (!function_exists('analisa_tipos')) {

		function analisa_tipos($ext, $tipos = null)
		{
			if (!$tipos) {
				$tipos = array("pdf", "txt", "doc", "docx", "ppt", "pptx");
			}

			if (in_array($ext, $tipos)) {

				return true;
			} else {
				return false;
			}
		}

	}

	if (!function_exists('var_name')) {

		function var_name(&$var, &$aDefinedVars)
		{
			foreach ($aDefinedVars as $k => $v)
				$aDefinedVars_0[$k] = $v;

			$iVarSave = $var;
			$var = !$var;

			$aDiffKeys = array_keys(array_diff_assoc($aDefinedVars_0, $aDefinedVars));
			$var = $iVarSave;

			return $aDiffKeys[0];
		}

	}

	if (!function_exists('data_diferenca')) {

		function data_diferenca($dt1, $dt2)
		{
			$t1 = strtotime($dt1);
			$t2 = strtotime($dt2);

			$dtd = new stdClass();
			$dtd->interval = $t2 - $t1;
			$dtd->total_sec = abs($t2 - $t1);
			$dtd->total_min = floor($dtd->total_sec / 60);
			$dtd->total_hour = floor($dtd->total_min / 60);
			$dtd->total_day = floor($dtd->total_hour / 24);

			$dtd->day = $dtd->total_day;
			$dtd->hour = $dtd->total_hour - ($dtd->total_day * 24);
			$dtd->min = $dtd->total_min - ($dtd->total_hour * 60);
			$dtd->sec = $dtd->total_sec - ($dtd->total_min * 60);
			return $dtd;
		}

	}

	if (!function_exists('busca_cep')) {

		function busca_cep()
		{

			$cep = $_POST['Cep_txf'];

			$link_cep = "http://api.postmon.com.br/v1/cep/{$cep}";

			$ch = curl_init($link_cep);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);

//                $endereco=  json_decode($response);
			return $response;
		}

	}

	if (!function_exists('formataBytes')) {

		function formataBytes($bytes, $precision = 2)
		{
			$units = array('B', 'KB', 'MB', 'GB', 'TB');

			$bytes = max($bytes, 0);
			$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
			$pow = min($pow, count($units) - 1);

// Uncomment one of the following alternatives
			$bytes /= pow(1024, $pow);
// $bytes /= (1 << (10 * $pow));

			return round($bytes, $precision) . ' ' . $units[$pow];
		}

	}

	if (!function_exists('noticiaIframe')) {

		function noticiaIframe($url, $return = TRUE)
		{

			$url = str_replace(" ", "", $url);
			$url_nova = explode('record', $url);

			if ($url_nova[1]) {
				$link = "http://www.corretoresdeseguros.com.br/cgi-corretoresdeseguros/noticias/cginews_portal.pl?record={$url_nova[1]}";
//http://www.corretoresdeseguros.com.br/cgi-corretoresdeseguros/noticias/cginews_portal.pl?record=28578
				$curl_response = curlContents($link);

				$noticias = $curl_response['contents'];
				$noticias = explode("<table", $noticias);
				$noticias = $noticias[5];
				$noticias = str_replace('border=0 class=texto11>', '', $noticias);

				$noticias = explode("<center", $noticias);
				$noticias = $noticias[0];
//           ver($noticias);
//        $noticias = strip_tags($noticias,"<table>");
//                   $noticias = str_replace('border="1"', 'border="0"', $noticias);
//        $noticias = str_replace("<a ", "", $noticias);
//        $noticias = str_replace("</a>", "", $noticias);
//        $noticias = str_replace("href=", "@@@#VAR", $noticias);
//        $noticias = str_replace("target=_blank>", "#VAR", $noticias);
//        ver($noticias);
				if ($return) {
					return $noticias;
				} else {
					echo $noticias;
				}
			}
		}

	}

	if (!function_exists('curlContents')) {

		function curlContents($url, $method = 'GET', $data = false, $headers = false, $returnInfo = true)
		{
			$ch = curl_init();


			$url = str_replace(' ', '%20', $url);

			if ($method == 'POST') {
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				if ($data !== false) {

					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				}
			} else {
				if ($data !== false) {
					if (is_array($data)) {
						$dataTokens = array();
						foreach ($data as $key => $value) {
							array_push($dataTokens, urlencode($key) . '=' . urlencode($value));
						}
						$data = implode('&', $dataTokens);
					}
					curl_setopt($ch, CURLOPT_URL, $url . '?' . $data);
				} else {
					curl_setopt($ch, CURLOPT_URL, $url);
				}
			}
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			if ($headers !== false) {
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			}

			$contents = curl_exec($ch);

			if ($returnInfo) {
				$info = curl_getinfo($ch);
			}

			curl_close($ch);

			if ($returnInfo) {
				return array('contents' => $contents, 'info' => $info);
			} else {
				return $contents;
			}
		}

	}

	if (!function_exists('classe_masonry')) {

		function classe_masonry($path, $limite_quadrado = 800)
		{
			$classe = "";
			list($width, $height) = getimagesize($path);


			if ($width == $height) {

				if ($width > $limite_quadrado) {
					$classe = "grid-item--width2 grid-item--height2";
				} else {
					$classe = "";
				}
			}

			if ($width > $height * 1.2) {
				$classe = "grid-item--width2";
			}
			if ($height > $width * 1.2) {
				$classe = "grid-item--height2";
			}

			return $classe;
		}

	}

	if (!function_exists('limpa_texto')) {

		function limpa_texto($string)
		{
			$string = trim($string);
			$string = str_replace('"', '', $string);
			$string = str_replace("''", '', $string);
			return remove_acentos($string);
		}

	}

	if (!function_exists('remove_acentos')) {

		function remove_acentos($string)
		{
			return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
		}

	}

	if (!function_exists('dashed_to_snake_case')) {
		function dashed_to_snake_case($value)
		{
			return strtolower(str_replace('-', '_', $value));
		}
	}

	if (!function_exists('imagem_post')) {

		function imagem_post($src, $app = null)
		{
			if ($src) {
				if (strpos($src, "http://") !== false || strpos($src, "https://") !== false) {
					return $src;
				} else {
					$retorno = $app->Url_cliente . $app->Pasta_painel . $src;
					return $retorno;
				}
			} else {
				$retorno = "//assets.lands.net.br/padrao_blog/imagens/indisponivel_post.png";
				return $retorno;
			}
		}

	}

	if (!function_exists('chave')) {

		function chave($t)
		{
			$car = "123456789";
			for ($i = 0; $i < $t; $i++) {
				$chave .= $car{rand(0, strlen($car) - 1)};
			}
			return $chave;
		}

	}

	if (!function_exists('cria_link')) {

		function cria_link($src, $app = null)
		{
			if ($src) {
				if (strpos($src, "http://") !== false || strpos($src, "https://") !== false) {
					return $src;
				} else {
					$retorno = "http://" . $src;
					return $retorno;
				}
			} else {
				$retorno = "javascript:;";
				return $retorno;
			}
		}

	}

	if (!function_exists('stringToColor')) {

		function stringToColor($str)
		{
			$code = dechex(crc32($str));
			$code = substr($code, 0, 6);
			if ($code == 'd0fd2c') {
				$code = '000000';
			}
			return $code;
		}

	}

	if (!function_exists('pontos_dogao')) {

		function pontos_dogao($pontos = null, $email = null)
		{
			$CI = &get_instance();
			$app = $CI->model_banco->app;

			echo "
<style>
    #amostra, #amostra * { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; margin: 0; padding: 0; border: 0; outline: 0; font-size: 100%; vertical-align: baseline; line-height: 1.42857143; }
    #amostra img { margin-bottom: -269px; }
    " . ($pontos ? "#amostra img { margin-bottom: -264px; }" : "") . "
</style>            
<div id='amostra' style='width:328px !important; height:269px !important; position: relative;'>
    <img style='width:328px !important; height:269px !important; position: relative;' src='https://assets.lands.net.br/padrao/img/amostra.png'>
    <div style='width:328px !important; height:269px !important; position: relative; overflow-y:hidden;'>
        <ul style='width:328px !important; height:269px !important; padding: 0px; margin: 0px; list-syle: none;'>";

			if ($pontos) {
				$pontos_array = explode(',', $pontos);
			}

			for ($i = 1; $i <= 2452; $i++) {
				echo "<li id='amostra{$i}' data-id='{$i}' style='display: inline; width: 6px; height: 6px; float: left;' class='amostra  ";
				if (in_array($i, $pontos_array)) {
					echo "vermelho";
				} else {
					echo "branco";
				}
				echo "'>";
				if (in_array($i, $pontos_array)) {
					echo "<img src='https://assets.lands.net.br/padrao/img/vermelho.jpg'>";
				} else {
					echo "";
				}
				echo "</li>";
			}

			echo "<input type='hidden' value='{$pontos}' id='pontos' name='pontos'>";
			echo "<input type='hidden value='' id='amostra_base64' name='amostra_base64'";

			echo '
        </ul>
    </div>
</div>';
		}

	}

	if (!function_exists('pontos_dogao2')) {

		function pontos_dogao2($pontos = null, $email = null)
		{
			$CI = &get_instance();
			$app = $CI->model_banco->app;
//<div style=' width: 328px; height:269px; margin:0 auto;' id='amostra'>
			echo "<div id='amostra'>
            <style>#amostra td{ padding:0 !important;} vermelho{background:red;}</style>
    <table style='width:328px!important; height:269px!important; background: url(https://assets.lands.net.br/{$app->Pasta_assets}imagens/amostra.png) no-repeat;' width='328' height='269'  class='form'>
        <tbody>";
			if ($pontos) {
				$pontos_array = explode(',', $pontos);
			}
			$j = 0;
			for ($i = 1; $i <= 1600; $i++) {
				if ($j == 0) {
					echo "<tr>";
				}
				$j = $j + 1;
				echo "<td id='amostra{$i}' data-id='{$i}' class='amostra ";
				if (in_array($i, $pontos_array)) {
					echo "vermelho";
				} else {
					echo "branco";
				}
				echo "'></td>";
				if ($j == 40) {
					echo "</tr>";
					$j = 0;
				}
			}
			echo "<input type='hidden' value='{$pontos}' id='pontos' name='pontos'>";
			echo '</tbody>
    </table>
</div>';
		}

	}

	if (!function_exists('conta')) {

		function conta($objetos, $campo = null, $valor = null)
		{


			$cont = 0;

			if (isset($objetos[0])) {
				if ($campo != null && $valor != null) {

					foreach ($objetos as $objeto) {
						if ($objeto->$campo == $valor) {
							$cont = $cont + 1;
						}
					}
				} else {
					foreach ($objetos as $objeto) {

						$cont = $cont + 1;
					}
				}
			}


//        if (isset($objetos[0])) {
//            foreach ($objetos as $objeto) {
//
//                if ($objeto->$campo == $valor) {
//                    $cont = $cont + 1;
//                }
//            }
//        }
			return $cont;
		}

	}

	if (!function_exists('calcula_preco')) {

		function calcula_preco($valor, $variacao = '1')
		{
			$porcentagem = 1 + ($variacao / 100);
			$retorno = number_format($valor * $porcentagem, 2, ",", ".");
			return $retorno;
		}

	}

	if (!function_exists('calcula_idade')) {

		function calcula_idade($then)
		{
			$then_ts = strtotime($then);
			$then_year = date('Y', $then_ts);
			$age = date('Y') - $then_year;
			if (strtotime('+' . $age . ' years', $then_ts) > time())
				$age--;
			return $age;
		}

	}

	if (!function_exists('soma_valores')) {

		function soma_valores($valor1, $valor2)
		{
			$val1 = str_replace(',', '.', $valor1);
			$val2 = str_replace(',', '.', $valor2);
			$x = $val1 + $val2;
			$x = number_format($x, 2, ',', '');
			return $x;
		}

	}

	if (!function_exists('nuvem_tags')) {

		function nuvem_tags(&$tags_direita)
		{
			$nivel = 0;
			$total_anterior = $tags_direita[0]->total;
			foreach ($tags_direita as $tag) {
				$total = $tag->total;
				if ($total != $total_anterior) {
					if ($nivel <= 4) {
						$nivel = $nivel + 1;
					} else {
						$nivel = 4;
					}

					$total = $tag->total;
				}
				$total_anterior = $tag->total;
				$tag->nivel = $nivel;
				$tag->class = "tag{$nivel}";
			}
//        return $tags;
			sorteia_array_objetos($tags_direita, array('Nome_txf' => SORT_ASC));
//        $tags=$tags_direita;
//        return $tags;
		}

	}

	if (!function_exists
	('sorteia_asc')) {

		function sorteia_asc(&$array, $campo)
		{
			return sorteia_array_objetos($array, array($campo => SORT_ASC));
		}

	}

	if (!function_exists
	('sorteia_desc')) {

		function sorteia_desc(&$array, $campo)
		{
			return sorteia_array_objetos($array, array($campo => SORT_DESC));
		}

	}

	if (!function_exists
	('sorteia_array_objetos')) {

		function sorteia_array_objetos(&$array, $properties)
		{
			if (is_string($properties)) {
				$properties = array($properties => SORT_ASC);
			}
			uasort($array, function ($a, $b) use ($properties) {
				foreach ($properties as $k => $v) {
					if (is_int($k)) {
						$k = $v;
						$v = SORT_ASC;
					}
					$collapse = function ($node, $props) {
						if (is_array($props)) {
							foreach ($props as $prop) {
								$node = (!isset($node->$prop)) ? null : $node->$prop;
							}
							return $node;
						} else {
							return (!isset($node->$props)) ? null : $node->$props;
						}
					};
					$aProp = $collapse($a, $k);
					$bProp = $collapse($b, $k);
					if ($aProp != $bProp) {
						return ($v == SORT_ASC) ? strnatcasecmp($aProp, $bProp) : strnatcasecmp($bProp, $aProp);
					}
				}
				return 0;
			});
		}

	}

	if (!function_exists
	('varia_data')) {

		function varia_data($dias, $data = null, $formato = 'Y-m-d')
		{
			if ($data == null) {
				$data = date('Y-m-d');
			}

			$data_tras = date($formato, strtotime("{$dias} day" . $data));
			return $data_tras;
//        $data_venc = date("d/m/Y", time() + ($dias * 86400));
		}

	}

	if (!function_exists
	('incrementa_data')) {

		function incrementa_data($dias = 3, $data = null, $formato = 'Y-m-d')
		{


			if ($data == null) {


				$data = date('Y-m-d');
			}

			$data_venc = date('Y-m-d', strtotime($data . " + $dias days"));


			return arruma_data($data_venc, $formato);


//        $data_venc = date("d/m/Y", time() + ($dias * 86400));
		}

	}

	if (!function_exists('formata_zeros_esquerda')) {

		function formata_zeros_esquerda($numero, $casas = 9)
		{
			$string = str_pad($numero, $casas, "0", STR_PAD_LEFT);
			return $string;
		}

	}

	if (!function_exists('carrega_tpl')) {

		function carrega_tpl($arquivo_tpl)
		{

			$CI = &get_instance();
			$app = $CI->model_banco->app;
			return $CI->model_smarty->render_tpl($arquivo_tpl, $app->Template_txf);
		}

	}

	if (!function_exists('retorna_date_time')) {

		function retorna_date_time()
		{

			/*
				$hora = date('H');
				$hora = $hora + 5;
				$dia = date('Y-m-d');

				$hora = $hora . date(':i:s');
				$resultado = $dia . ' ' . $hora;
				return $resultado;
			 */

			$res = date('Y-m-d H:i:s');

			return $res;
		}

	}

	if (!function_exists('gera_cupons')) {

		function gera_cupons($qtd = 1, $tamanho = 10, $prefixo = '')
		{

			$c = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";

			for ($i = 0; $i < $qtd; $i++) {
				$cod = $prefixo;
				for ($j = 0; $j < ($tamanho - strlen($prefixo)); $j++) {
					$cod .= $c{mt_rand(0, 35)};
				}
				$codigos[] = $cod;
			}

			return $codigos;
		}

	}

	if (!function_exists('tem_img_vid_arq')) {

		function tem_img_vid_arq($objeto)
		{
			$retorno = FALSE;

			if (is_array($objeto)) {
				foreach ($objeto as $obj) {
					if (isset($objeto->Imagens[1])) {
						$retorno = true;
						return $retorno;
					}
					if (isset($objeto->Videos[0])) {
						$retorno = true;
						return $retorno;
					}
					if (isset($objeto->Arquivos[0])) {
						$retorno = true;
						return $retorno;
					}
				}
			} else {
				if (isset($objeto->Imagens[1])) {
					$retorno = true;
					return $retorno;
				}
				if (isset($objeto->Videos[0])) {
					$retorno = true;
					return $retorno;
				}
				if (isset($objeto->Arquivos[0])) {
					$retorno = true;
					return $retorno;
				}
			}

			return $retorno;
		}

	}

	if (!function_exists('is_lands')) {

		function is_lands()
		{
			if ($_SERVER['REMOTE_ADDR'] = '::1' || $_SERVER['HTTP_HOST'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '45.229.104.33' || $_SERVER['REMOTE_ADDR'] == IP_LANDS || $_SERVER['HTTP_CF_CONNECTING_IP'] == IP_LANDS || $_SERVER['REMOTE_ADDR'] == IP_VEDANA || $_SERVER['REMOTE_ADDR'] == IP_ADMIN) {
				return true;
			} else {
				return false;
			}
		}

	}

	if (!function_exists('ignora_tags')) {

		function ignora_tags($texto_original)
		{

			for ($i = 1; $i <= 15; $i++) {
				$texto_original = str_replace("[imagem$i]", "", $texto_original);
				$texto_original = str_replace("[video$i]", "", $texto_original);
				$texto_original = str_replace("[arquivo$i]", "", $texto_original);
				$texto_original = str_replace("[nota$i]", "", $texto_original);
				$texto_original = str_replace("[chamanota$i]", "", $texto_original);
				$texto_original = str_replace("[fotos]", "", $texto_original);
				$texto_original = str_replace("[galeria]", "", $texto_original);
			}
			$texto_original = str_replace("[linha]", "", $texto_original);


			return $texto_original;
		}

	}

	if (!function_exists('cria_tags')) {

		function cria_tags($texto_original, $config = null, $imagens = null, $videos = null, $arquivos = null, $notas = null)
		{
			$configuracao['img_classe'] = 'img-responsive';
			$configuracao['img_fora'] = 'centro';
			$configuracao['img_style'] = '';
			$configuracao['img_class_legenda'] = 'legenda';
			$configuracao['vid_fora'] = 'centro';
			$configuracao['vid_style'] = '';
			$configuracao['arq_classe'] = '';
			$configuracao['arq_style'] = '';
			$configuracao['arq_target'] = '_blank';
			$configuracao['chamanota_style'] = 'cursor:pointer';
			$configuracao['nota_style'] = 'line-height:1;';
			$configuracao['nota_numero_style'] = '';
			$configuracao['nota_texto_style'] = '';
			$configuracao['tipo_nota'] = 'popover';


			if (is_array($config)) {
				foreach ($config as $key => $value) {
					$configuracao[$key] = $value;
				}
			}
			$CI = &get_instance();
			$app = $CI->model_banco->app;
			$resposta = $texto_original;

//tag imagem
			if (is_array($imagens)) {


				$cont = 0;
				foreach ($imagens as $img) {

					if ($img->Descricao_txf != '') {
						$title = $img->Descricao_txf;
					} else {
						$title = $img->Caminho_txf;
					}
					$cont = $cont + 1;
					$resposta = str_replace("[imagem$cont]", "<div class='{$configuracao['img_fora']}'><img style='{$configuracao['img_style']}' title='{$title}' alt='{$title}' class='{$configuracao['img_classe']}' src='{$app->Url_cliente}{$app->Pasta_painel}/{$img->Caminho_txf}'/><div class='{$configuracao['img_class_legenda']}'>{$img->Descricao_txf}</div></div>", $resposta);
				}

//            ver($resposta, 1);

				$items = '';
				foreach ($imagens as $img) {
					$items .= "<div class='item'>";
					$items .= "<a  class='fancybox' href='{$app->Url_cliente}{$app->Pasta_painel}{$img->Caminho_txf}' data-fancybox-group='gallery' title='{$img->Descricao_txf}' >";
					$items .= "<img src='{$app->Url_cliente}{$app->Pasta_painel}{$img->Caminho_txf}' class='img-responsive img-fancy' />";
					$items .= "</a><span>{$img->Descricao_txf}</span>";
					$items .= "</div>";
				}

				$resposta = str_replace("[galeria]", "<div class='owl-carousel owl-galeria owl-theme'>{$items}</div>", $resposta);
				$items2 = '';
				foreach ($imagens as $img) {
					$items2 .= "<div class='{$configuracao['img_fora']}'><img style='{$configuracao['img_style']}' title='{$title}' alt='{$title}' class='{$configuracao['img_classe']}' src='{$app->Url_cliente}{$app->Pasta_painel}/{$img->Caminho_txf}'/><div class='{$configuracao['img_class_legenda']}'>{$img->Descricao_txf}</div></div>";
				}
				$resposta = str_replace("[fotos]", "{$items2}", $resposta);
//            ver(strlen($resposta), 0);
			}

//tag video
			if (is_array($videos)) {
				$cont = 0;
				foreach ($videos as $vid) {

					if ($vid->Titulo_txf != '') {
						$title = $vid->Titulo_txf;
					} else {
						$title = $vid->Descricao_txf;
					}
					$cont = $cont + 1;
					$resposta = str_replace("[video$cont]", "<div class='{$configuracao['vid_fora']}'><iframe width='350' height='250' style='{$configuracao['vid_style']}' frameborder='0' src='//www.youtube.com/embed/{$vid->Endereco_txf}' ></iframe></div>", $resposta);
				}
			}

//tag arquivo
			if (is_array($arquivos)) {


//            if (is_lands()) {
				$raiz = $app->Url_cliente;
				$raiz .= $app->Pasta_painel;
				$raiz .= $app->$app->Pasta_painel . '/';
				$raiz = str_replace('painel//', 'painel/', $raiz);
//                $url_completa = str_replace('http:/', '//', $url_completa);
//                $url_completa = str_replace('https:/', '//', $url_completa);
//            }


				$cont = 0;
				foreach ($arquivos as $arq) {

					if ($arq->Descricao_txf != '') {
						$title = $arq->Descricao_txf;
					} else {
						$title = $arq->Nome_txf;
					}
					$cont = $cont + 1;


					$resposta = str_replace("[arquivo$cont]", "<a style='{$configuracao['arq_style']}' target='{$configuracao['arq_target']}' class='{$configuracao['arq_classe']}' href='{$raiz}{$arq->Caminho_txf}' title='{$title}'>{$title}</a>", $resposta);
//                if (is_lands()) {
//
//                } else {
//                    $resposta = str_replace("[arquivo$cont]", "<a style='{$configuracao['arq_style']}' target='{$configuracao['arq_target']}' class='{$configuracao['arq_classe']}' href='{$app->Url_cliente}{$app->Pasta_painel}/{$arq->Caminho_txf}' title='{$title}'>{$title}</a>", $resposta);
//                }
				}
			}


//tag nota
			if (is_array($notas)) {

				$CI = &get_instance();

				$pagina = $CI->uri->uri_string;
				$raiz = $app->Url_cliente;
				$url_completa = $raiz . $pagina;


				$cont = 0;
				foreach ($notas as $nota) {

					$texto_nota = $nota->Nota_txa;

					$cont = $cont + 1;
					if ($configuracao['tipo_nota'] == 'popover') {
						$texto_nota = strip_tags($texto_nota);
						$resposta = str_replace("[chamanota$cont]", "<a  id='chamanota$cont' data-toggle='popover' data-placement='top' data-content='{$texto_nota}' style='{$configuracao['chamanota_style']}'  title='Nota $cont' class='chamanota'>[$cont]</a>", $resposta);
						$resposta = str_replace("[nota$cont]", "", $resposta);
					} else {
						$resposta = str_replace("[chamanota$cont]", "<a  id='chamanota$cont' class='chamanota' href='$url_completa#nota$cont'>[$cont]</a>", $resposta);
						$resposta = str_replace("[nota$cont]", "<div id='nota$cont' class='nota' style='{$configuracao['nota_style']}' href='$url_completa#chamanota$cont'><span class='nota_numero' style='{$configuracao['nota_numero_style']}'>[$cont]</span><span class='nota_texto' style='{$configuracao['nota_texto_style']}'>$texto_nota</span></div>", $resposta);
					}
				}
			}

//tag linha
			$resposta = str_replace("[linha]", "<hr>", $resposta);


			return $resposta;
		}

	}

	if (!function_exists('remove_tag')) {

		function remove_tag($texto, $tag)
		{
			$texto = str_replace("<$tag>", "", $texto);
			$texto = str_replace("<$tag>", "", $texto);

			return $texto;
		}

	}

	if (!function_exists('mascara')) {

		function mascara($string, $mascara = null)
		{


			$string = str_replace("-", "", $string);
			$string = str_replace("(", "", $string);
			$string = str_replace(")", "", $string);
			$string = str_replace(" ", "", $string);

			switch ($mascara) {
				case 'cep':
					$mascara = '##.###-###';
					break;
				case 'cep2':
					$mascara = '#####-###';
					break;
				case 'tel':

					$mascara = '(##) ####-####';
					break;

				case 'cpf':
					$mascara = '###.###.###-##';
					break;
				case 'tel_sp':
					$mascara = '(###) ####-####';
					break;

				default:
					$mascara = $string;
					break;
			}

			for ($i = 0; $i < strlen($string); $i++) {
				$mascara[strpos($mascara, "#")] = $string[$i];
			}

			return $mascara;
		}

	}

	if (!function_exists('dias_feriados')) {

		function dias_feriados($ano = null, $fixos = true)
		{
			if ($ano === null) {
				$ano = intval(date('Y'));
			}
//ver($fixos);
			$pascoa = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
			$dia_pascoa = date('j', $pascoa);
			$mes_pascoa = date('n', $pascoa);
			$ano_pascoa = date('Y', $pascoa);

			if ($fixos == true) {

				$feriados = array(
// Tatas Fixas dos feriados Nacionail Basileiras
					mktime(0, 0, 0, 1, 1, $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 4, 21, $ano), // Tiradentes - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 5, 1, $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 9, 7, $ano), // Dia da Independência - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 10, 12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
					mktime(0, 0, 0, 11, 2, $ano), // Todos os santos - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 11, 15, $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 12, 25, $ano), // Natal - Lei nº 662, de 06/04/49
// These days have a date depending on easter
					mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48, $ano_pascoa), //2ºferia Carnaval
					mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47, $ano_pascoa), //3ºferia Carnaval
					mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2, $ano_pascoa), //6ºfeira Santa
					mktime(0, 0, 0, $mes_pascoa, $dia_pascoa, $ano_pascoa), //Pascoa
					mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60, $ano_pascoa), //Corpus Cirist
				);
			} else {
//  ver('chegou');
				$feriados = array(
// Tatas Fixas dos feriados Nacionail Basileiras
					mktime(0, 0, 0, 1, 1, $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 4, 21, $ano), // Tiradentes - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 5, 1, $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 9, 7, $ano), // Dia da Independência - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 10, 12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
					mktime(0, 0, 0, 11, 2, $ano), // Todos os santos - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 11, 15, $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
					mktime(0, 0, 0, 12, 25, $ano), // Natal - Lei nº 662, de 06/04/49
				);
			}

			sort($feriados);
			foreach ($feriados as $feriado) {
				$result[] = date("d/m/Y", $feriado);
			}

			return ($result);
		}

	}

	if (!function_exists('feriado')) {

		function feriado($data = null, $fixos = TRUE)
		{
			if ($data === null) {
				$data = date('d/m/Y');
			}
			$data_sql = formata_data_sql($data);
			$ano = arruma_data($data_sql, 'Y');
			$feriados = dias_feriados($ano, $fixos);
			return in_array($data, $feriados);
		}

	}

	if (!function_exists('eh_feriado')) {

		function eh_feriado($data = null, $retorno = 'BOOLEAN', $fixos = TRUE)
		{
			if ($data === null) {
				$data = date('d/m/Y');
			}

//        ver($data);
			$data_sql = formata_data_sql($data);
			$ano = arruma_data($data_sql, 'Y');

			$resposta = 'NAO';
			$feriados = dias_feriados($ano, $fixos);
			if ($retorno == 'BOOLEAN') {
				$reposta = false;
			} else {
				$resposta = 'NAO';
			}
			foreach ($feriados as $feriado) {
				if ($data == $feriado) {

					if ($retorno == 'BOOLEAN') {
						$resposta = true;
					} else {
						$resposta = 'SIM';
					}
				}
			}

			return ($resposta);
		}

	}

	if (!function_exists('diasemana')) {

		function diasemana($data)
		{
			$ano = substr("$data", 0, 4);
			$mes = substr("$data", 5, -3);
			$dia = substr("$data", 8, 9);

			$diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

			switch ($diasemana) {
				case"0":
					$diasemana = "Domingo";
					break;
				case"1":
					$diasemana = "Segunda-Feira";
					break;
				case"2":
					$diasemana = "Terça-Feira";
					break;
				case"3":
					$diasemana = "Quarta-Feira";
					break;
				case"4":
					$diasemana = "Quinta-Feira";
					break;
				case"5":
					$diasemana = "Sexta-Feira";
					break;
				case"6":
					$diasemana = "Sábado";
					break;
			}

			return $diasemana;
		}

	}

	function MOD($number, $base)
	{
		return $number % $base;
	}

	if (!function_exists('eh_par')) {

		function eh_par($numero = 0)
		{
			$resultado = MOD($numero, 2);
			return !$resultado;
		}

	}

	if (!function_exists('senha_aleatoria')) {

		function senha_aleatoria($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
		{

// Caracteres de cada tipo
			$lmin = 'abcdefghijklmnopqrstuvwxyz';
			$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$num = '1234567890';
			$simb = '!@#$%*-';
// Variáveis internas
			$retorno = '';
			$caracteres = '';

// Agrupamos todos os caracteres que poderão ser utilizados
			$caracteres .= $lmin;
			if ($maiusculas)
				$caracteres .= $lmai;
			if ($numeros)
				$caracteres .= $num;
			if ($simbolos)
				$caracteres .= $simb;
// Calculamos o total de caracteres possíveis
			$len = strlen($caracteres);
			for ($n = 1; $n <= $tamanho; $n++) {
// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
				$rand = mt_rand(1, $len);
// Concatenamos um dos caracteres na variável $retorno
				$retorno .= $caracteres[$rand - 1];
			}
			return $retorno;
		}

	}

	if (!function_exists('imagem')) {

		function imagem($caminho, $objeto, $classe = null, $campo_titulo = null)
		{

			$resposta = '<img src="' . $caminho . $objeto->Caminho_txf . '" ';
			if (isset($classe)) {
				$resposta .= 'class="' . $classe . '" ';
			}
			if (isset($campo_titulo)) {
				$resposta .= 'alt="' . $objeto->$campo_titulo . '" title="' . $objeto->$campo_titulo . '" ';
			}
			$resposta .= '/>';
			return $resposta;
		}

	}

	if (!function_exists('redireciona')) {

		function redireciona($url = null, $tipo = 'self')
		{
			echo "<script> $tipo.location='$url'</script>";
		}

	}

	if (!function_exists('remove_sufixo')) {

		function remove_sufixo($var = '', &$ext = '')
		{
			$var = explode('_', $var);

			$var = str_replace(array('-', '_'), ' ', $var);

			if (count($var) > 1)
				$ext = array_pop($var);


			$var = implode(' ', $var);

			$var = ucwords($var);

			return $var;
		}

	}

	if (!function_exists('remove_sufixo2')) {

		function remove_sufixo2($var = '', &$ext = '')
		{
			$var = explode('_', $var);

//        $var = str_replace(array('-', '_'), ' ', $var);

			if (count($var) > 1)
				$ext = array_pop($var);


			$var = implode('_', $var);

//        $var = ucwords($var);

			return $var;
		}

	}

	if (!function_exists('retorna_extensao')) {

		function retorna_extensao($var = '', &$ext = '')
		{
			$var = explode('_', $var);

			$var = str_replace(array('-', '_'), ' ', $var);

			if (count($var) > 1)
				$ext = array_pop($var);


			$var = implode(' ', $var);

			$var = ucwords($var);

			return $ext;
		}

	}

	if (!function_exists('converte_data')) {

		function converte_data($data, $formato_entrada = 'd/m/Y', $formato_saida = 'Y-m-d')
		{
			$date = DateTime::createFromFormat($formato_entrada, $data);
			return $date->format($formato_saida);
		}

	}

	if (!function_exists('formata_data_sql')) {

		function formata_data_sql($data)
		{
			$data_temp = explode('/', $data);

			$data_sql = $data_temp[2] . '-' . $data_temp[1] . '-' . $data_temp[0];
			return $data_sql;
		}

	}

	if (!function_exists('formata_data')) {

		function formata_data($time = '', $fmt = 'DATE_LANDS')
		{
			$formats = array(
				'DATE_LANDS' => '%d/%m/%Y',
				'BACKUP' => '%d_%m_%Y_%H_%i_%s',
				'LANDS' => '%d%m%Y%H%i%s',
				'd.m.Y_H.i' => '%d.%m.%Y_%H.%i'
			);
			if (!isset($formats[$fmt])) {
				return FALSE;
			}
			return mdate($formats[$fmt], $time);
		}

	}

	if (!function_exists('arruma_data')) {

		function arruma_data($data = '', $formato = 'd/m/Y')
		{

			if ($data == '0000-00-00' || $data == '0000-00-00 00:00:00' || $data == '') {
				if ($formato == 'H:i') {
					return 'Sem hora';
				}
				return 'Sem data';
			}
			$newDate = date($formato, strtotime($data));

			return $newDate;
		}

	}

	if (!function_exists('retorna_dia')) {

		function retorna_dia($data = '', $formato = 'd')
		{
			$newDate = date($formato, strtotime($data));

			return $newDate;
		}

	}

	if (!function_exists('retorna_ano')) {

		function retorna_ano($data = '', $formato = 'Y')
		{
			$newDate = date($formato, strtotime($data));

			return $newDate;
		}

	}

	if (!function_exists('retorna_numero_mes')) {

		function retorna_numero_mes($data = '', $caracteres = null)
		{
			if (!$data) {
				$data = date('Y-m-d');
			}
			$newDate = date('m', strtotime($data));
			return $newDate;
		}

	}

	if (!function_exists('retorna_mes_fromstring')) {

		function retorna_mes_fromstring($mes = '', $caracteres = 3)
		{
			$mes = strtolower(substr($mes, 0, $caracteres));

			switch ($mes) {
				case 'jan':
					$numero = '01';
					break;
				case 'feb':
					$numero = '02';
					break;
				case 'mar':
					$numero = '03';
					break;
				case 'apr':
					$numero = '04';
					break;
				case 'may':
					$numero = '05';
					break;
				case 'jun':
					$numero = '06';
					break;
				case 'jul':
					$numero = '07';
					break;
				case 'aug':
					$numero = '08';
					break;
				case 'sep':
					$numero = '09';
					break;
				case 'oct':
					$numero = '10';
					break;
				case 'nov':
					$numero = '11';
					break;
				case 'dez':
					$numero = '12';
					break;
			}


			return $numero;
		}

	}

	if (!function_exists('retorna_mes')) {

		function retorna_mes($data = '', $caracteres = null)
		{
			$newDate = date('m', strtotime($data));
			switch ($newDate) {
				case 1:
					$mes = 'Janeiro';
					break;
				case 2:
					$mes = 'Fevereiro';
					break;
				case 3:
					$mes = 'Março';
					break;
				case 4:
					$mes = 'Abril';
					break;
				case 5:
					$mes = 'Maio';
					break;
				case 6:
					$mes = 'Junho';
					break;
				case 7:
					$mes = 'Julho';
					break;
				case 8:
					$mes = 'Agosto';
					break;
				case 9:
					$mes = 'Setembro';
					break;
				case 10:
					$mes = 'Outubro';
					break;
				case 11:
					$mes = 'Novembro';
					break;
				case 12:
					$mes = 'Dezembro';
					break;
			}

			if (isset($caracteres)) {
				$retorno = substr($mes, 0, $caracteres);
			} else {
				$retorno = $mes;
			}
			return $retorno;
		}

	}

	if (!function_exists('retorna_nome_mes')) {

		function retorna_nome_mes($numero, $caracteres = null)
		{

			switch ($numero) {
				case 1:
					$mes = 'Janeiro';
					break;
				case 2:
					$mes = 'Fevereiro';
					break;
				case 3:
					$mes = 'Março';
					break;
				case 4:
					$mes = 'Abril';
					break;
				case 5:
					$mes = 'Maio';
					break;
				case 6:
					$mes = 'Junho';
					break;
				case 7:
					$mes = 'Julho';
					break;
				case 8:
					$mes = 'Agosto';
					break;
				case 9:
					$mes = 'Setembro';
					break;
				case 10:
					$mes = 'Outubro';
					break;
				case 11:
					$mes = 'Novembro';
					break;
				case 12:
					$mes = 'Dezembro';
					break;
			}

			if (isset($caracteres)) {
				$retorno = substr($mes, 0, $caracteres);
			} else {
				$retorno = $mes;
			}
			return $retorno;
		}

	}

	if (!function_exists('data_dm')) {

		function data_dm($data = '', $formato = 'd/m')
		{
			$newDate = date($formato, strtotime($data));

			return $newDate;
		}

	}

	if (!function_exists('data_dmy')) {

		function data_dmy($data = '', $formato = 'd/m/Y')
		{
			$newDate = date($formato, strtotime($data));

			return $newDate;
		}

	}

	function vname(&$var, $scope = 0)
	{
		$old = $var;
		if (($key = array_search($var = 'unique' . rand() . 'value', !$scope ? $GLOBALS : $scope)) && $var = $old)
			return $key;
	}

	function variable_name(&$var, $scope = false, $prefix = 'UNIQUE', $suffix = 'VARIABLE')
	{
		if ($scope) {
			$vals = $scope;
		} else {
			$vals = $GLOBALS;
		}
//
//    echo "<pre>";
//    print_r($GLOBALS);
		$old = $var;
		$var = $new = $prefix . rand() . $suffix;
		$vname = FALSE;
		foreach ($vals as $key => $val) {
			if ($val === $new)
				$vname = $key;
		}
		$var = $old;

		return $vname;
	}

	if (!function_exists('ver_forca')) {

		function ver_forca($var = null, $encerrar = '0', $nome_var = null)
		{


			echo '<br>******************** debug *******************<br>';
			try {
				throw new Exception('teste');
				1 > 2;
			} catch (Exception $e) {
//                echo 'Exceção capturada: ', $e->getMessage(), "\n";
				$erro = ($e->getTrace());
				$debug = new stdClass();

//                echo vname($var, $e->getTrace());
				//echoes 'testvar'
				$debug->arquivo = $erro[0]['file'];
				$debug->line = $erro[0]['line'];
//                $debug->parametros=$erro[0]['args'];
			}

//            echo "variavel:";
//            echo vname($var, get_defined_vars());
//            echo "<br>";
//            $vedanaaa = 'teste';
//            echo "var = " . variable_name($vedanaaa);
			echo '<pre>';
//             print_r(get_defined_vars());
			echo "<br>";


			if ($var) {
				echo "arquivo: ";
				print_r($debug->arquivo);
				echo "<br>linha: ";
				print_r($debug->line);
				echo '<br>*************************************<br>';
				print_r($var);
			} else {
				echo "arquivo: ";
				print_r($debug->arquivo);
				echo "<br>linha: ";
				print_r($debug->line);
				echo '<br>*************************************<br>';
				print_r('empty');
			}

			echo '    <br></pre><br>*************** encerrou o debusg ***************<br>';
			if ($encerrar == '0')
				die('programa encerrado propositalmente');

		}

	}

	if (!function_exists('ver')) {

		function ver($var = null, $encerrar = '0', $nome_var = null)
		{

			if (is_lands()) {
				echo '<br>******************** debug *******************<br>';
				try {
					throw new Exception('teste');
				} catch (Exception $e) {
//                echo 'Exceção capturada: ', $e->getMessage(), "\n";
					$erro = ($e->getTrace());
					$debug = new stdClass();

//                echo vname($var, $e->getTrace());
					//echoes 'testvar'
					$debug->arquivo = $erro[0]['file'];
					$debug->line = $erro[0]['line'];
//                $debug->parametros=$erro[0]['args'];
				}

//            echo "variavel:";
//            echo vname($var, get_defined_vars());
//            echo "<br>";
//            $vedanaaa = 'teste';
//            echo "var = " . variable_name($vedanaaa);
				echo '<pre>';
//             print_r(get_defined_vars());
				echo "<br>";


				if ($var) {
					echo "arquivo: ";
					print_r($debug->arquivo);
					echo "<br>linha: ";
					print_r($debug->line);
					echo '<br>*************************************<br>';
					print_r($var);
				} else {
					echo "arquivo: ";
					print_r($debug->arquivo);
					echo "<br>linha: ";
					print_r($debug->line);
					echo '<br>*************************************<br>';
					print_r('empty');
				}

				echo '    <br></pre><br>*************** encerrou o debusg ***************<br>';
				if ($encerrar == '0')
					die('programa encerrado propositalmente');
			}
		}

	}

	if (!function_exists('lands_nav')) {


		function lands_nav($message = null)
		{

			$CI = &get_instance();

			if (!isset($CI->session->userdata['navigation']))
				$CI->session->userdata['navigation'] = '';

			$CI->session->userdata['navigation'] .= '[' . hora() . '] =>' . $message . '<br>';

			return $CI->session->userdata['navigation'];
		}

	}

	if (!function_exists('busca_sql')) {


		function busca_sql($sql = null)
		{

			$CI = &get_instance();

			return $CI->model_banco->executa_sql($sql);
		}

	}

	if (!function_exists('seta_redirect')) {

		function seta_redirect($pagina = 'inicio')
		{

			$CI = &get_instance();
			$CI->session->set_userdata('redirect_link', $pagina);
		}

	}

	if (!function_exists('data_extenso')) {

		function data_extenso($data = null, $dia_semana = FALSE)
		{
			$CI = &get_instance();
			if ($data == null) {

				$var = $CI->mbc->executa_sql("SELECT DAY(CURRENT_DATE()) as dia, MONTHNAME(CURRENT_DATE()) as mes,  YEAR(CURRENT_DATE()) as ano");
				$retorno = $var[0]->dia . ' de ' . $var[0]->mes . ' de ' . $var[0]->ano;
			} else {

				setlocale(LC_TIME, 'portuguese');
				date_default_timezone_set('America/Sao_Paulo');
				if (!$dia_semana) {
					$retorno = utf8_encode(strftime("%d de %B de %Y", strtotime($data)));
				} else {
					$retorno = utf8_encode(strftime("%A, %d de %B de %Y", strtotime($data)));
				}
			}


			return $retorno;
		}

	}

	if (!function_exists('valorPorExtenso')) {

		function valorPorExtenso($valor = 0, $complemento = true)
		{
			$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
			$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");

			$c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
			$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
			$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
			$u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

			$z = 0;

			$valor = number_format($valor, 2, ".", ".");
			$inteiro = explode(".", $valor);
			for ($i = 0; $i < count($inteiro); $i++)
				for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++)
					$inteiro[$i] = "0" . $inteiro[$i];

// $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
			$fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
			for ($i = 0; $i < count($inteiro); $i++) {
				$valor = $inteiro[$i];
				$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
				$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
				$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

				$r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
				$t = count($inteiro) - 1 - $i;
				if ($complemento == true) {
					$r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
					if ($valor == "000")
						$z++;
					elseif ($z > 0)
						$z--;
					if (($t == 1) && ($z > 0) && ($inteiro[0] > 0))
						$r .= (($z > 1) ? " de " : "") . $plural[$t];
				}
				if ($r)
					$rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
			}

			return ($rt ? $rt : "zero");
		}

	}

	if (!function_exists('tabela_imagens')) {


		function tabela_imagens($tabela = null, $where = null)
		{

			$CI = &get_instance();

			$var = $CI->mbc->buscar_registro_imagens_videos($tabela, $where);

			return $var;
		}

	}

	if (!function_exists('busca_completo')) {


		function buscar_completo($tabela = null, $where = null, $campo_imagem = null)
		{

			$CI = &get_instance();

			$var = $CI->mbc->buscar_completo($tabela, $where, $campo_imagem);

			return $var;
		}

	}

	if (!function_exists('complementa_registros')) {


		function complementa_registros($result, $tabela, $campo_imagem = null)
		{

			$CI = &get_instance();

			$var = $CI->mbc->complementa_registros($result, $tabela, $campo_imagem);

			return $var;
		}

	}

	if (!function_exists('tabela')) {


		function tabela($tabela = null, $where = null)
		{

			$CI = &get_instance();

			$var = $CI->mbc->buscar_tudo($tabela, $where);

			return $var;
		}

	}

	if (!function_exists('busca_imagens_videos')) {


		function busca_imagens_videos($tabela, $and = "")
		{

			$CI = &get_instance();

			$var = $CI->mbc->buscar_registro_imagens_videos($tabela, $and);

			return $var;
		}

	}

	if (!function_exists('executa_sql')) {


		function executa_sql($sql = null)
		{

			$CI = &get_instance();

			$var = $CI->mbc->executa_sql($sql);

			return $var;
		}

	}

	if (!function_exists('wp_categories')) {

		function wp_categories($id_conexao, $quantidade, $categoria = false, $wp_prefix = '')
		{

			$CI = &get_instance();
			$dados_conexao = $CI->model_banco->executa_sql("select * from conexoes WHERE Id_int = $id_conexao");
			$dados_conexao = $dados_conexao[0];

			$conn = new mysqli($dados_conexao->Servidor_txf, $dados_conexao->Usuario_txf, $dados_conexao->Senha_txp, $dados_conexao->Database_txf);
			mysqli_set_charset($conn, 'utf8');

			$result = $conn->query("SELECT * FROM {$wp_prefix}_terms t
                INNER JOIN {$wp_prefix}_term_taxonomy tt ON tt.term_id = t.term_id 
                WHERE tt.taxonomy = 'category'
                ORDER BY t.slug");

			$categories = [];
			foreach ($result as $cat) {
				$cat = (object)$cat;
				$categories[] = $cat;
			}
			return $categories;
		}

	}

	if (!function_exists('wp_posts')) {

		function wp_posts($id_conexao, $quantidade, $categoria = false, $wp_prefix = '')
		{

			$CI = &get_instance();
			$dados_conexao = $CI->model_banco->executa_sql("select * from conexoes WHERE Id_int = $id_conexao");
			$dados_conexao = $dados_conexao[0];

			$conn = new mysqli($dados_conexao->Servidor_txf, $dados_conexao->Usuario_txf, $dados_conexao->Senha_txp, $dados_conexao->Database_txf);
			mysqli_set_charset($conn, 'utf8');

			$result = $conn->query("SELECT p.*, u.display_name as 'post_author_name' FROM {$wp_prefix}_posts p LEFT JOIN {$wp_prefix}_users u ON p.post_author = u.ID WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date DESC LIMIT 0, $quantidade");

			if ($categoria !== false) {
				$result = $conn->query("SELECT wt.name,
             p.*, u.display_name AS 'post_author_name'
             FROM {$wp_prefix}_posts p
             LEFT JOIN {$wp_prefix}_users u ON p.post_author = u.ID
             INNER JOIN {$wp_prefix}_term_relationships r ON r.object_id=p.ID
             INNER JOIN {$wp_prefix}_term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
             INNER JOIN {$wp_prefix}_terms wt ON wt.term_id = t.term_id AND wt.slug = '$categoria'
             WHERE t.taxonomy='category'
             AND post_status = 'publish'
             AND post_type = 'post'
             ORDER BY post_date DESC
             LIMIT 0, $quantidade");
			}

			foreach ($result as $noticia) {
				$noticia = (object)$noticia;

				// Buscar imagem
				$noticia->image = primeira_imagem($noticia->post_content);


				// Buscar categorias
				$result = $conn->query("SELECT wt.* FROM {$wp_prefix}_posts p
            INNER JOIN {$wp_prefix}_term_relationships r ON r.object_id=p.ID
            INNER JOIN {$wp_prefix}_term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
            INNER JOIN {$wp_prefix}_terms wt on wt.term_id = t.term_id
            WHERE p.ID={$noticia->ID} AND t.taxonomy='category'");

				foreach ($result as $category) {
					$noticia->categories[] = $category['name'];
				}

				// Concatenar categorias
				$noticia->concat_categories = implode(', ', $noticia->categories);

				// Buscar tags
				$result = $conn->query("SELECT wt.* FROM {$wp_prefix}_posts p
            INNER JOIN {$wp_prefix}_term_relationships r ON r.object_id=p.ID
            INNER JOIN {$wp_prefix}_term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
            INNER JOIN {$wp_prefix}_terms wt on wt.term_id = t.term_id
            WHERE p.ID={$noticia->ID} AND t.taxonomy='post_tag'");
				$noticia->tags = mysqli_fetch_assoc($result);

				foreach ($result as $tag) {
					$noticia->tags[] = $tag['name'];
				}

				// Concatenar tags
				$noticia->concat_tags = implode(', ', $noticia->tags);

				$noticias[] = $noticia;
			}

			return $noticias;
		}

	}

	if (!function_exists('wp_events')) {

		function wp_events($id_conexao, $quantidade)
		{

			$CI = &get_instance();
			$dados_conexao = $CI->model_banco->executa_sql("select * from conexoes WHERE Id_int = $id_conexao");
			$dados_conexao = $dados_conexao[0];

			$conn = new mysqli($dados_conexao->Servidor_txf, $dados_conexao->Usuario_txf, $dados_conexao->Senha_txp, $dados_conexao->Database_txf);
			mysqli_set_charset($conn, 'utf8');
			$result = $conn->query("SELECT p.*, m.meta_value FROM _posts p INNER JOIN _postmeta m ON m.post_id=p.ID  WHERE meta_key='_EventStartDate' and post_status = 'publish' AND post_type = 'tribe_events'  ORDER BY meta_value ASC LIMIT 0, $quantidade");
			$data_atual = date('Y-m-d H:i:s');
			foreach ($result as $noticia) {
				if ($noticia['meta_value'] >= $data_atual) {
					$noticia = (object)$noticia;

					$noticia->image = primeira_imagem($noticia->post_content);
					$results = $conn->query("SELECT m.* FROM _posts p
            INNER JOIN _postmeta m ON m.post_id=p.ID
            WHERE p.ID={$noticia->ID}");
					//     $results = mysqli_fetch_assoc($result);
					//     ver($results);
					foreach ($results as $category) {
						$campo = $category['meta_key'];
						$valor = $category['meta_value'];
						$noticia->$campo = $valor;
					}
					$noticias[] = $noticia;
				}
			}

			return $noticias;
		}

	}

	if (!function_exists('lands_crud')) {

		function lands_crud($tabela = null, $where = null)
		{
			$CI = &get_instance();
			if ($CI->uri->segment(2))
				$tabela = $CI->uri->segment(2);
			else
				$tabela = 'layouts';
//  $CI->load->library('grocery_crud_categories');
			$CI->load->library('grocery_crud');
			$CI->load->model('grocery_crud_model');
			$crud = new grocery_crud();
			$crud->set_table($tabela);

			$crud->set_subject(singular($tabela));

			/* WHERE É UM ARRAY $where= array('key'=>'value'); */
			if ($where !== null) {
				if (is_array($where)) {
					$crud->where($where);
				} else {
					lands_nav('CRUD -> Condição where não era um array e foi desconsiderada');
				}
			}

//$dados['descricao']= $CI->model_banco->descrever($tabela);

			$output = $crud->render();
			$dados['output'] = object_to_array($output);
			$dados['css_files'] = $crud->get_css_files();
			$dados['js_files'] = $crud->get_js_files();
			return $dados;
		}

	}

	if (!function_exists('lands_config')) {


		function lands_config()
		{

			$CI = &get_instance();

			$tabela = 'config';
			$config_painel['username'] = 'landshos_master';
			$config_painel['password'] = 'Ld230551';
			$config_painel['database'] = 'landshos_painel';
			$config_painel['dbdriver'] = 'mysql';
			$config_painel['dbprefix'] = '';
			$config_painel['pconnect'] = TRUE;
			$config_painel['db_debug'] = TRUE;
			$config_painel['cache_on'] = FALSE;
			$config_painel['cachedir'] = '';
			$config_painel['char_set'] = 'utf8';
			$config_painel['dbcollat'] = 'utf8_general_ci';
			$config_painel['swap_pre'] = '';
			$config_painel['autoinit'] = TRUE;
			$config_painel['stricton'] = FALSE;

			$CI->load->library('grocery_crud_categories');

			$CI->load->library('grocery_CRUD');

			$CI->load->model('grocery_crud_model', '', $config_painel);
//			$site;
//$tipo_conteudo = null;
			$site = $CI->uri->segment(1);
			$tipo_conteudo = $CI->uri->segment(2);


			$crud = new grocery_CRUD();

//unset_fields

			$crud->set_table($tabela);
//if ($site=='pagina')
			$crud->edit_fields('view_name', 'content');

//  $crud->unset_fields('id', 'funcao', 'nome_var', 'tabela', 'select', 'conteudo', 'tipo_conteudo');
			$crud->columns('site', 'header', 'footer', 'view_name', 'content');
			$crud->set_subject(singular($tabela));
//if ($site=='pagina') ///
			if (!isset($tipo_conteudo)) {
				$tipo_conteudo = 'layout';
				$crud->where('tipo_conteudo', $tipo_conteudo);
			}
			$crud->where('site', $site);

			$output = $crud->render();


			$dados['output'] = object_to_array($output);
			$dados['css_files'] = $crud->get_css_files();
			$dados['js_files'] = $crud->get_js_files();


			return $dados;
		}

	}

	if (!function_exists('img_crud')) {

		function img_crud($tabela = null, $where = null)
		{
			$CI = &get_instance();
			if ($CI->uri->segment(3))
				$tabela = $CI->uri->segment(3);
			else
				$tabela = 'example_1';
//  $CI->load->library('grocery_crud_categories');
			$CI->load->library('grocery_crud');
			$CI->load->model('grocery_crud_model');
			$crud = new grocery_crud();
			$crud->set_table($tabela);

			$crud->set_subject(singular($tabela));

			/* WHERE É UM ARRAY $where= array('key'=>'value'); */
			if ($where !== null) {
				if (is_array($where)) {
					$crud->where($where);
				} else {
					lands_nav('CRUD -> Condição where não era um array e foi desconsiderada');
				}
			}

//$dados['descricao']= $CI->model_banco->descrever($tabela);

			$output = $crud->render();
			$dados['output'] = object_to_array($output);
			$dados['css_files'] = $crud->get_css_files();
			$dados['js_files'] = $crud->get_js_files();
			return $dados;
		}

	}

	if (!function_exists('processa_url')) {

		function processa_url()
		{


			$CI = &get_instance();


			if ($CI->uri->segment(1))
				$url['controller'] = $CI->uri->segment(1);


			if ($CI->uri->segment(2))
				$url['funcao'] = $CI->uri->segment(2);


			if ($CI->uri->segment(3))
				$url['param1'] = $CI->uri->segment(3);


			if ($CI->uri->segment(4))
				$url['param2'] = $CI->uri->segment(4);


			if ($CI->uri->segment(5))
				$url['param3'] = $CI->uri->segment(5);


			if (!isset($url['funcao']))
				$url['funcao'] = 'index';


			return array_to_object($url);
		}

	}

	if (!function_exists('object_to_array')) {


		function object_to_array($object)
		{


			if (is_object($object)) {


// Gets the properties of the given object with get_object_vars function


				$object = get_object_vars($object);
			}


			return (is_array($object)) ? array_map(__FUNCTION__, $object) : $object;
		}

	}

	if (!function_exists('array_to_object')) {

		function array_to_object($array)
		{
			return (is_array($array)) ? (object)array_map(__FUNCTION__, $array) : $array;
		}

	}

	if (!function_exists('youtube_channel_videos')) {

		function youtube_channel_videos($channel_id, $maxResults = 30)
		{
			try {
				require_once(COMMONPATH . 'third_party/php-youtube-api/vendor/autoload.php');
//				$youtube = new Madcoda\Youtube(array('key' => 'AIzaSyB1YeIAq1-TebAQLt18dZlPhAetiy0_RfM'));
				$youtube = new Madcoda\Youtube(array('key' => 'AIzaSyCEx2Svs_N2mxyd2yDFSfYGr3VdaEXoydI'));


				$videos = $youtube->searchChannelVideos('', $channel_id, $maxResults);
				return $videos;
			} catch (Exception $e) {

				return null;
			}
		}

	}

	if (!function_exists('youtube_channel')) {

		function youtube_channel($channel_id)
		{
			require_once(COMMONPATH . 'third_party/php-youtube-api/vendor/autoload.php');
			$youtube = new Madcoda\Youtube(array('key' => 'AIzaSyB1YeIAq1-TebAQLt18dZlPhAetiy0_RfM'));
			$channel = $youtube->getChannelById($channel_id);
			return $channel;
		}

	}

	if (!function_exists('youtube_channel_by_name')) {

		function youtube_channel_by_name($channel_name)
		{
			require_once(COMMONPATH . 'third_party/php-youtube-api/vendor/autoload.php');
			$youtube = new Madcoda\Youtube(array('key' => 'AIzaSyB1YeIAq1-TebAQLt18dZlPhAetiy0_RfM'));
			$channel = $youtube->getChannelByName($channel_name);
			return $channel;
		}

	}

	if (!function_exists('array_get')) {

		/**
		 * Get an item from an array using "dot" notation.
		 *
		 * @param array $array
		 * @param string $key
		 * @param mixed $default
		 * @return mixed
		 */
		function array_get($array, $key, $default = null, $dot = '.')
		{
			if (is_null($key))
				return $array;
			if (isset($array[$key]))
				return $array[$key];
			foreach (explode($dot, $key) as $segment) {
				if (!is_array($array) || !array_key_exists($segment, $array)) {
					return $default;
				}
				$array = $array[$segment];
			}
			return $array;
		}

	}

	if (!function_exists('group_by')) {

		function group_by($array, $key)
		{
			$array = object_to_array($array);
			$return = array();
			foreach ($array as $val) {
				$return[$val[$key]][] = $val;
			}
			return json_decode(json_encode(($return)));
		}

	}

	if (!function_exists('avaliacao_estrelas')) {

		function avaliacao_estrelas($tabela_avaliacao, $coluna, $tabela_con, $registros)
		{

			$registro_unico = false;
			if (!is_array($registros)) {
				$registros = [$registros];
				$registro_unico = true;
			}

			//converte os registros em array
			$registros = object_to_array($registros);

			//Pega todos os Id's para serem usados na consulta
			$map = array_map(function ($item) {
				return $item['Id_int'];
			}, $registros);
			$ids = implode(',', $map);

			if (empty($map)) {
				return (json_decode(json_encode($registros)));
			}

			$resultados = object_to_array(executa_sql("select *, {$coluna} from {$tabela_avaliacao} where 
            Id_objeto_con IN ( {$ids} ) and Tabela_con = '{$tabela_con}'"));

			//agrupa os resultados pelo id do registro
			$resultados = object_to_array(group_by($resultados, 'Id_objeto_con'));

			foreach ($registros as &$registro) {

				$id_registro = $registro['Id_int'];
				$media = 0;

				$resultado_bd = $resultados[$id_registro];

				$registro['avaliacoes'] = [
					'media' => 5,
					'registros' => []
				];

				if (isset($resultado_bd)) {

					//soma as avaliacoes
					foreach ($resultado_bd as $r) {
						$media += (int)$r[$coluna];
					}

					//calcula a media das avaliacoes para cada registro
					$media = round($media / count($resultado_bd), 2);
					if ($media == 0) {
						$media = 5;
					}

					$registro['avaliacoes']['media'] = $media;
					$registro['avaliacoes']['registros'] = $resultado_bd;
				}
			}

			return (json_decode(json_encode($registros)));
		}

	}

	if (!function_exists('ordena_array')) {

		function ordena_array(&$arr, $col, $dir = SORT_ASC)
		{

			$arr = json_decode(json_encode($arr), 1);

			$sort_col = array();
			foreach ($arr as $key => $row) {
				$sort_col[$key] = $row[$col];
			}

			array_multisort($sort_col, $dir, $arr);

			return json_decode(json_encode($arr));
		}

	}

	if (!function_exists('monta_whatsapp')) {

		//EX: $filtro=['Tipo_sel', '=', 'WHATSAPP']
		function monta_whatsapp($telefones, array $filtro = [])
		{

			if (isset($filtro[3]) || !isset($filtro[2])) {
				return $telefones;
			}

			if (!empty($filtro) === true && (is_array($telefones) || is_object($telefones))) {
				$telefones = get_object($telefones, $filtro[0], $filtro[1], $filtro[2], false);
				foreach ($telefones as $key => &$value) {
					$value->Whatsapp_formatado = '55' . preg_replace('/[^0-9]/', '', $value->Ddd_txf . $value->Numero_txf);
				}
			}

			return $telefones;
		}

	}

	if (!function_exists('array_reverse_recursive')) {
		function array_reverse_recursive($arr)
		{
			foreach ($arr as $key => $val) {
				if (is_array($val))
					$arr[$key] = array_reverse_recursive($val);
			}
			return array_reverse($arr);
		}
	}

	if (!function_exists('array_filtro')) {
		function array_filtro($arr, $key)
		{

			$novo = [];
			$arr = json_decode(json_encode($arr), 1);

			array_map(function ($item) use ($key, &$novo) {
				if (isset($item[$key])) {
					$novo[] = $item[$key];
				}
				return true;
			}, $arr);

			return json_decode(json_encode($novo));

		}
	}

	if (!function_exists('sanitize')) {

		function sanitize($var, $type)
		{
			switch ($type) {
				case 'html':
					$safe = htmlspecialchars($var);
					break;
				case 'sql':
					$safe = mysql_real_escape_string($var);
					break;
				case 'file':
					$safe = preg_replace('/(\/|-|_)/', '', $var);
					break;
				case 'shell':
					$safe = escapeshellcmd($var);
					break;
				default:
					$safe = htmlspecialchars($var);
			}
			return $safe;
		}

	}

	if (!function_exists('monta_imoveis_zeh')) {
		function monta_imoveis_zeh($imoveis, $caracteristicas_tipos)
		{

			$imoveis_retorno = [];

			foreach ($imoveis as $key => $imovel) {

				$imoveis_retorno[$key] = $imovel;

				$planta_baixa = get_object($imovel->Imagens, 'Campo_sel', '=', 'Planta_baixa_ico');
				$imagens = get_object($imovel->Imagens, 'Campo_sel', '=', 'Imagens_ico');

				$imovel->Imagens = $imagens;
				$imovel->Planta_baixa = $planta_baixa;

				$caracteristicas = [];
				foreach ($imovel->Caracteristicas_vin as $caracteristica) {
					if ($caracteristica->Tipo_sel) {

						$tipo = get_object($caracteristicas_tipos, 'Nome_url', '=', $caracteristica->Tipo_sel);
						if (isset($tipo[0])) {
							$tipo[0]->Valor_min_txf = $caracteristica->Valor_min_txf;
							$tipo[0]->Valor_max_txf = $caracteristica->Valor_max_txf;
							$caracteristicas[] = $tipo[0];
						}
					}
				}

				$imoveis_retorno[$key]->Caracteristicas_vin = ordena_array($caracteristicas, 'Ordenacao_txf');

			}

			return json_decode(json_encode($imoveis_retorno));

		}
	}

	if (!function_exists('paginate')) {

		function paginate($items, $curr_page = 1, $ipp = 12, $count = false)
		{

			$items_total = $count === false ? count($items) : $count;
			$pages_total = ceil($items_total / $ipp);
			$next_page = $curr_page < $pages_total ? $curr_page + 1 : null;
			$prev_page = $curr_page > 1 ? $curr_page - 1 : null;
			$offset = ($curr_page - 1) * $ipp;
			$items_slice = array_slice($items, $offset, $ipp);

			return array(
				"prev_page" => $prev_page,
				"curr_page" => $curr_page,
				"next_page" => $next_page,
				"items" => $items,
				"items_curr" => count($items_slice),
				"items_total" => $items_total,
				"pages_total" => $pages_total,
				"per_page" => $ipp
			);
		}

	}

	if (!function_exists('formata_moeda_banco')) {
		function formata_moeda_banco($str)
		{
			$str = preg_replace('/\D/', '', $str);
			$str = number_format(($str / 100), 2);
			$str = str_replace(',', '', $str);
			return $str;
		}
	}

	if (!function_exists('carrega_estilo')) {
		function carrega_estilo($estilos = [], $pagina = 'default')
		{

			$estilos_finais = '';

			$CI = &get_instance();
			$app = $CI->model_banco->app;

			$pagina_atual = $CI->uri->segment($app->Segmento_padrao_txf);

			if (is_array($estilos)) {
				foreach ($estilos as $estilo) {
					$estilos_finais .= '<link rel="stylesheet" href="' . $estilo . '"/>';
				}
			} else {
				$estilos_finais = '<link rel="stylesheet" href="' . $estilos . '"/>';
			}

			if ($pagina != 'default') {
				if ($pagina == $pagina_atual) {
					return $estilos_finais;
				}
			} else {
				return $estilos_finais;
			}

		}
	}

	if (!function_exists('carrega_script')) {
		function carrega_script($scripts = [], $pagina = 'default')
		{

			$scripts_finais = '';

			$CI = &get_instance();
			$app = $CI->model_banco->app;

			$pagina_atual = $CI->uri->segment($app->Segmento_padrao_txf);

			if (is_array($scripts)) {
				foreach ($scripts as $script) {
					$script_url = $app->Url_cliente . $app->Pasta_assets . 'js/' . $script;
					$scripts_finais .= '<script type="text/javascript" src="' . $script_url . '"></script>';
				}
			} else {
				$script_url = $app->Url_cliente . $app->Pasta_assets . 'js/' . $scripts;
				$scripts_finais = '<script type="text/javascript" src="' . $script_url . '"></script>';
			}

			if ($pagina != 'default') {
				if ($pagina == $pagina_atual) {
					return $scripts_finais;
				}
			} else {
				return $scripts_finais;
			}

		}
	}

	if (!function_exists('junta_registros')) {
		function junta_registros($registros_pai, $campo_pai, $registros_filhos, $campo_filhos, $campo_nome)
		{

			foreach ($registros_pai as &$pai) {
				$pai->{$campo_nome} = get_object($registros_filhos, $campo_filhos, '=', $pai->{$campo_pai});
			}

			return $registros_pai;

		}
	}

	if (!function_exists('gera_link')) {
		function gera_link($link, $append_query = false)
		{

			$CI = &get_instance();
			$app = $CI->model_banco->app;

			$qs = '';
			$hash = '';

			$starts_with_http = substr($link, 0, strlen('http')) === 'http';
			$is_internal_link = substr($link, 0, strlen($app->Url_cliente_linguagem)) === $app->Url_cliente_linguagem;

			if ($starts_with_http && !$is_internal_link) {
				return $link;
			}

			if($append_query === true && $_SERVER['QUERY_STRING']){
				$qs = '?' . $_SERVER['QUERY_STRING'];
			}

			$link = str_replace($app->Url_cliente, '', $link);
			$link = str_replace($qs, '', $link);

			$is_hash = parse_url($link,PHP_URL_FRAGMENT);
			if($is_hash){
				$link = str_replace('#' . $is_hash, '', $link);
				$hash = '#' . $is_hash;
			}

			return $app->Url_cliente_linguagem . $link . $qs . $hash;

		}
	}

