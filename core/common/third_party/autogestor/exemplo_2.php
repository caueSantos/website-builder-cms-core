<?php

	/**
	 * A T E N Ç Ã O !!!
	 *
	 * Este é um script com finalidades de "exemplificar" o uso da Api AutoGestor, e não deve ser utilizado em
	 * ambiente de produção.
	 *
	 * O desenvolvimento da programação fica a encargo do técnico responsavel pela integração contratado pelo Cliente.
	 *
	 *
	 *
	 * O B S E R V A Ç Ã O !!!
	 *
	 * Este exemplo NÃO utiliza a classe AutoGestorWs
	 *
	 * A chave de acesso: "4297f44b13955235245b2497399d7a93"
	 * é fornecida apenas para fins de testes.
	 * O Cliente deve solicitar a sua Chave de Acesso pessoal e
	 * somente assim terá acesso aos seus verdadeiros registros.
	 *
	 * Para solicitar a Chave de Acesso definitiva o Cliente deve
	 * Enviar um e-mail para atendimento@autogestor.net.
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

	// Primeiro passo é construir o XML de requisição
	$xml = '<?xml version="1.0" encoding="UTF-8"?>' .
			'<requisicao>' .
				'<chave>4297f44b13955235245b2497399d7a93</chave>' .
				'<acao>ag_lista_itens</acao>' .
			'</requisicao>';

	// Configura e executa a requisição via CURL
	$ch = curl_init();

	curl_setopt_array(
		$ch ,
		array(
			CURLOPT_URL => "http://ws.autogestor.net/api/",
			CURLOPT_POSTFIELDS => array( 'xml' => $xml ),
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_FAILONERROR => 1,
			CURLOPT_TIMEOUT => 300,
			CURLOPT_HEADER => 0,
		)
	);

	$result = curl_exec( $ch );

	$error = curl_error( $ch );

	curl_close( $ch );

	// Verificando a requisição
	if( $result )
	{
		// Comverte o XML de retorno em Objeto
		$xml = simplexml_load_string( $result , 'SimpleXMLElement' , LIBXML_NOCDATA );

		print '<pre>';

		// Exibindo o resultado
		print_r( $xml );
	}
	else
	{
		print "Requisição falhou!<br>Erro: ";

		// Exibe o Erro
		print $error;
	}
