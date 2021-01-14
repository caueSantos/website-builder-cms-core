<?php

	/**
	 * A T E N � � O !!!
	 *
	 * Este � um script com finalidades de "exemplificar" o uso da Api AutoGestor, e n�o deve ser utilizado em
	 * ambiente de produ��o.
	 *
	 * O desenvolvimento da programa��o fica a encargo do t�cnico responsavel pela integra��o contratado pelo Cliente.
	 *
	 *
	 *
	 * O B S E R V A � � O !!!
	 *
	 * Este exemplo N�O utiliza a classe AutoGestorWs
	 *
	 * A chave de acesso: "4297f44b13955235245b2497399d7a93"
	 * � fornecida apenas para fins de testes.
	 * O Cliente deve solicitar a sua Chave de Acesso pessoal e
	 * somente assim ter� acesso aos seus verdadeiros registros.
	 *
	 * Para solicitar a Chave de Acesso definitiva o Cliente deve
	 * Enviar um e-mail para atendimento@autogestor.net.
	 *
	 *
	 *
	 * I M P O R T A N T E !!!
	 *
	 * � determinantemente proibido exibir as imagens no site do Cliente utilizando as URLs capturadas atrav�s da API.
	 * O n�o cumprimento desta regra implica em bloqueio da API.
	 * Para exibir as imagens, as mesmas dever�o ser copiadas para o servidor onde est� hospedado o site do Cliente.
	 *
	 * Inicialmente o limite � estabelecido em 500 conex�es di�rias para serem utilizadas apenas no per�odo de testes.
	 * Depois de conclu�da a integra��o com o API AutoGestor, o desenvolvedor deve avisar o Autogestor atrav�s do
	 * endere�o de e-mail: atendimento@autogestor.net para que este limite seja reduzido para 50 conex�es di�rias.
	 */

	// Primeiro passo � construir o XML de requisi��o
	$xml = '<?xml version="1.0" encoding="UTF-8"?>' .
			'<requisicao>' .
				'<chave>4297f44b13955235245b2497399d7a93</chave>' .
				'<acao>ag_lista_itens</acao>' .
			'</requisicao>';

	// Configura e executa a requisi��o via CURL
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

	// Verificando a requisi��o
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
		print "Requisi��o falhou!<br>Erro: ";

		// Exibe o Erro
		print $error;
	}
