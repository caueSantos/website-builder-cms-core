<?php

	/**
	 * AutoGestor.net - Sistema de integração on-line
	 * http://autogestor.net/
	 *
	 * Licenciado apenas para uso conforme contrato de utilização do sistema.
	 *
	 *
	 *
	 * A T E N Ç Ã O !!!
	 *
	 * Este é um script com finalidades de "exemplificar" o uso da Api AutoGestor e a mesma
	 * não garente em hipótese alguma o perefeito funcionamento deste! Ficando a encargo do
	 * desenvolvedor da integração a opção de utilizar ou não este script.
	 *
	 *
	 *
	 * O B S E R V A Ç Ã O !!!
	 *
	 * A redistribuição deste Script é proíbida em qualquer forma!
	 *
	 * O Contratante pode alterar este Script da maneira que lhe convenha
	 * sem a necessidade de comunicar o proprietário.
	 *
	 * Fica determinantemente proibido a remoção dos créditos!
	 *
	 * Para maiores informações envie uma solicitação para o setor reponsável
	 * no endereço abaixo: tecnico@autogestor.net
	 *
	 *
	 *
	 * I M P O R T A N T E !!!
	 *
	 * É determinantemente proibido exibir as imagens no site do Cliente utilizando as URLs capturadas através da API.
	 * O não cumprimento desta regra implica em bloqueio da API.
	 * Para exibir as imagens, as mesmas deverão ser copiadas para o servidor onde está hospedado o site do Cliente.
	 *
	 * Inicialmente o limite é estabelecido em 500 conexões diárias para serem utilizadas apenas no período de testes.
	 * Depois de concluída a integração com o API AutoGestor, o desenvolvedor deve avisar o Autogestor através do
	 * endereço de e-mail: atendimento@autogestor.net para que este limite seja reduzido para 50 conexões diárias.
	 */

	class AutoGestorWs
	{

		public $erro;
		private $url;
		private $xml;
		private $objeto;
		private $matriz;
		private $utf8decode;
		private $chave;
		private $ordem;
		private $busca;
		private $acao;
		private $acoes;
		private $campos_busca;
		private $campos_ordem;
		private $excluidos;
		private $vendidos;
		private $limita;
		private $encoding;

		public function __construct( $c = '' , $a = '' )
		{
			$this->url = 'http://ws.autogestor.net/api/';
			$this->xml = '<?xml version="1.0" encoding="%s"?>';
			$this->xml .= '<requisicao>%s</requisicao>';
			$this->erro = '';
			$this->chave = $c;
			$this->acao = $a;
			$this->objeto = 0;
			$this->matriz = 0;
			$this->utf8decode = 0;
			$this->excluidos = 0;
			$this->vendidos = 0;
			$this->limita = 0;
			$this->encoding = 'utf-8';
			$this->ordem = array();
			$this->busca = array();
			$this->acoes = array(
				'ag_lista_itens'
				,
				'ag_busca_itens'
				,
				'ag_informacoes',
			);
			$this->campos_busca = array(
				'marca' ,
				'modelo' ,
				'versao' ,
				'ano_ini' ,
				'ano_fim' ,
				'km_ini' ,
				'km_fim'
				,
				'placa' ,
				'cor' ,
				'combustivel' ,
				'cadastro_ini' ,
				'cadastro_fim' ,
				'loja',
			);
			$this->campos_ordem = array(
				'marca' ,
				'modelo' ,
				'versao' ,
				'ano_fabricacao' ,
				'ano_modelo' ,
				'km' ,
				'placa' ,
				'cor' ,
				'combustivel' ,
				'cadastro',
				'preco',
			);
		}// __construct()

		/*
			Adiciona uma tag ao elemento pai: <busca></busca>
			$n -> Nome do Campo
			$v -> Valor a ser buscado
			$e -> Tipo de busca (0->Aproximada, 1->Exata)
		 */
		public function busca( $n = '' , $v = '' , $e = 0 )
		{
			$n = strtolower( trim( (string) $n ) );
			$v = trim( (string) $v );
			$e = (int) trim( $e );

			if( !in_array( $n , $this->campos_busca ) ):
				$this->erro .= "O campo <b>$n</b> nao esta disponivel para busca!";
				$this->erro .= " <br />Os campos permitidos para busca sao:<br /> ";
				$this->erro .= ' - ' . implode( '<br /> - ' , $this->campos_busca );

				return false;
			endif;

			if( !strlen( $v ) ):
				$this->erro .= "Para a busca, o campo <b>$n</b> necessita conter um valor!";
				$this->erro .= " <br />Exemplo: $this->busca('marca', 'ford' ,1);<br /> ";
				$this->erro .= " <br />//Buscando Exata pela marca 'ford'. ";

				return false;
			endif;

			// Campos que permitem definir a busca como exata ou aproximada
			$perm = array(
				'marca' ,
				'modelo' ,
				'versao' ,
				'combustivel' ,
				'placa' ,
				'cor',
			);

			$e = (in_array( $n , $perm )) ? $e : 0;

			array_push(
				$this->busca
				, array(
					'tag' => $n
					,
					'atr' => $e
					,
					'val' => $v,
				)
			);

			return true;
		}// busca()

		/*
			Adiciona uma tag ao elemento pai: <ordem></ordem>
			$n -> Nome do Campo
			$t -> Tipo de busca (0->Aproximada, 1->Exata)
		 */
		public function ordem( $n = '' , $t = '' )
		{
			$n = strtolower( trim( (string) $n ) );
			$t = strtolower( trim( (string) $t ) );

			if( !in_array( $n , $this->campos_ordem ) ):
				$this->erro .= "O campo <b>$n</b> nao esta disponivel para ordem!";
				$this->erro .= " <br />Os campos permitidos para ordem sao:<br /> ";
				$this->erro .= ' - ' . implode( '<br /> - ' , $this->campos_ordem );

				return false;
			endif;

			if( !strlen( $t ) || false === strpos( 'dc' , $t ) ):
				$this->erro .= "Para o campo <b>$n</b> necessita setar o tipo de ordem!";
				$this->erro .= " <br />Os tipos de ordem sao:<br /> ";
				$this->erro .= " <br />'d' -> Ordem Decrescente ";
				$this->erro .= " <br />'c' -> Ordem Crescente ";
				$this->erro .= " <br />Exemplo: $this->ordem($n,'c'); // Ordem Crescente para $n";

				return false;
			endif;

			array_push(
				$this->ordem
				, array(
					'tag' => $n
					,
					'val' => $t,
				)
			);

			//
			return true;
		}// ordem()

		/**
		 * @param string $n
		 */
		public function chave( $n = '' )
		{
			$this->chave = $n;
		}

		/**
		 * @param int $n
		 */
		public function objeto( $n = 0 )
		{
			$this->objeto = (int) $n;
		}

		/**
		 * @param int $n
		 */
		public function matriz( $n = 0 )
		{
			$this->matriz = (int) $n;
		}

		/**
		 * @param int $n
		 */
		public function utf8decode( $n = 0 )
		{
			$this->utf8decode = (int) $n;
		}

		/**
		 * @param string $n
		 */
		public function acao( $n = '' )
		{
			$this->acao = $n;
		}

		/**
		 * @param int $n
		 */
		public function limita( $n = 0 )
		{
			$this->limita = (int) $n;
		}

		/**
		 * @param int $n
		 */
		public function excluidos( $n = 0 )
		{
			$this->excluidos = (int) $n;
		}

		/**
		 * @param int $n
		 */
		public function vendidos( $n = 0 )
		{
			$this->vendidos = (int) $n;
		}

		/**
		 * @param string $n
		 */
		public function encoding( $n = '' )
		{
			$n = strtolower( trim( "{$n}" ) );
			$this->encoding = (strlen( $n )) ? $n : 'utf-8';
		}

		/**
		 * @return bool
		 */
		private function compilaXML()
		{
			if( !strlen( $this->chave ) ):
				$this->erro .= 'Necessario fornecer a "chave" de acesso!<br /> ';
				$this->erro .= 'Caso nao possua esta informacao, solicite a nossa equipe tecnica.';

				return false;
			endif;

			if( !in_array( $this->acao , $this->acoes ) ):
				$this->erro .= "A acao $this->acao nao esta disponivel!";
				$this->erro .= ' <br />As acoes diponiveis sao:<br /> ';
				$this->erro .= ' - ' . implode( '<br /> - ' , $this->acoes );

				return false;
			endif;

			$this->xml = sprintf( $this->xml , $this->encoding , "%s" );

			$this->xml = sprintf( $this->xml , "<chave>$this->chave</chave>%s" );

			$this->xml = sprintf( $this->xml , "<acao>$this->acao</acao>%s" );

			$ordem = '';
			$busca = '';
			$listar = '';

			$listar .= ($this->excluidos) ? "<excluidos>$this->excluidos</excluidos>" : '';
			$listar .= ($this->vendidos) ? "<vendidos>$this->vendidos</vendidos>" : '';
			$listar .= ($this->limita) ? "<quantidade>$this->limita</quantidade>" : '';

			if( strlen( $listar ) ):
				$this->xml = sprintf( $this->xml , "<listar>$listar</listar>%s" );
			endif;


			if( is_array( $this->busca ) && count( $this->busca ) ):
				if( $this->acao == 'ag_busca_itens' ):
					foreach( $this->busca as $el ):
						$busca .= "<$el[tag]";
						$busca .= ((int) $el['atr']) ? ' exata="1"' : '';
						$busca .= ">";
						$busca .= $el['val'];
						$busca .= "</$el[tag]>";
					endforeach;

					$this->xml = sprintf( $this->xml , "<busca>$busca</busca>%s" );
				endif;
			endif;

			if( is_array( $this->ordem ) && count( $this->ordem ) ):
				foreach( $this->ordem as $el ):
					$ordem .= "<{$el['tag']}>{$el['val']}</{$el['tag']}>";
				endforeach;

				$this->xml = sprintf( $this->xml , "<ordem>{$ordem}</ordem>%s" );
			endif;

			$this->xml = str_replace( '%s' , '' , $this->xml );

			// Testa o XML gerado
			$teste = @simplexml_load_string( $this->xml );

			if( !is_object( $teste ) ):
				$this->erro .= 'Erro na compilacao do XML!<br />';
				$this->erro .= ' Copie o XML abaixo e envie para avaliacao por parte de nossa equipe.';
				$this->erro .= ' <br /><pre>';
				$this->erro .= $this->xml;

				return false;
			endif;

			return true;
		}// compilaXML()

		/**
		 * @return bool|mixed|SimpleXMLElement
		 */
		private function enviaXML()
		{
			// cURL
			$c = @curl_init();
			// Erro cURL
			if( !$c ):
				$this->erro .= 'Biblioteca CURL nao existe ou desativada!';

				return false;
			endif;
			// Parametros
			$parametros = array(
				'xml' => $this->xml,
			);

			// Seta URL e outras opções
			curl_setopt_array(
				$c ,
				array(
					CURLOPT_URL => $this->url ,
					CURLOPT_POSTFIELDS => $parametros ,
					CURLOPT_RETURNTRANSFER => 1 ,
					CURLOPT_FRESH_CONNECT => 1 ,
					CURLOPT_FORBID_REUSE => 1 ,
					CURLOPT_FAILONERROR => 1 ,
					CURLOPT_TIMEOUT => 300 ,
					CURLOPT_NOSIGNAL => 1 ,
					CURLOPT_VERBOSE => 1 ,
					CURLOPT_HEADER => 0 ,
				)
			);

			// Retorno
			$r = @curl_exec( $c );
			// Mensagem de erro do Curl
			$ce = @curl_error( $c );
			// Não existe retorno mas pode car erro (@).
			@curl_close( $c );
			// Erro de Curl
			if( !$r ):
				$this->erro .= 'Conexao CURL falhou<br />';
				$this->erro .= 'ERRO: ' . $ce;

				return false;
			endif;
			//
			$xml = @simplexml_load_string( $r , 'SimpleXMLElement' , LIBXML_NOCDATA );
			//
			if( !is_object( $xml ) ):
				$this->erro .= "Retorno invalido!<br />RETORNO:<br /><pre>$r";

				return false;
			endif;

			// Retorna o XMl no formato Array
			if( $this->matriz )
			{
				return $this->obj2array( $xml );
			}
			// Retorna no formato String
			elseif( $this->objeto )
			{
				return $xml;
			}
			else
			{
				return $r;
			}

		}// enviaXML()

		/**
		 * @return bool|mixed|SimpleXMLElement
		 */
		public function executa()
		{
			//
			if( !$this->compilaXML() )
			{
				return false;
			}
			//
			$xml = $this->enviaXML();
			//
			if( $xml === false ):
				return false;
			endif;

			// Retorna o XMl no formato String ou Objeto
			return $xml;
		}// executa()

		/**
		 * @return string
		 */
		public function erro()
		{
			return $this->erro;
		}

		/**
		 * @param $data
		 *
		 * @return array
		 */
		public function obj2array( $data )
		{
			if( !is_array( $data ) && !is_object( $data ) )
			{
				return array($data);
			}

			$ret = array();

			$data = (array) $data;

			foreach( $data as $k => $v )
			{
				if( is_object( $v ) )
				{
					$v = (array) $v;
				}

				if( is_array( $v ) )
				{
					$ret[$k] = $this->obj2array( $v );
				}
				elseif( is_string($v) )
				{
					$ret[$k] = ($this->utf8decode) ? utf8_decode( trim("{$v}") ) : trim("{$v}");
				}
				else
				{
					$ret[$k] = $v;
				}
			}

			return $ret;

		}// obj2array()

		//public function __destruct(){ print_r($this->erro); }
	}
