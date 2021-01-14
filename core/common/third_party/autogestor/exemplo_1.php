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
	 * Exemplo utilizando a classe AutoGestorWs
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
	 * O n�o cumprimento desta regra implica no bloqueio da API.
	 * Para exibir as imagens, as mesmas dever�o ser copiadas para o servidor onde est� hospedado o site do Cliente.
	 *
	 * Inicialmente o limite � estabelecido em 500 conex�es di�rias para serem utilizadas apenas no per�odo de testes.
	 * Depois de conclu�da a integra��o com a API AutoGestor, o desenvolvedor deve avisar o Autogestor atrav�s do
	 * endere�o de e-mail: atendimento@autogestor.net para que este limite seja reduzido para 50 conex�es di�rias.
	 */

	// Inclui o arquivo que contem a Class AutoGestorWs
	include('AutoGestorWs.php');

	// Instancia a Class
	$rest = new AutoGestorWs();

	// Fornece a chave de acesso e identifica��o do Cliente
	$rest->chave( '4297f44b13955235245b2497399d7a93' );

	// Define o prop�sito da requisi��o
	$rest->acao( 'ag_lista_itens' );

	// Informa o Charset - Encoding (Influencia no retorno)
	$rest->encoding('iso-8859-1');

	// Retorna um Objeto SimpleXMLElement ao inv�s de uma String XML
	$rest->objeto( true );

	// Executa a requisi��o
	$xml = $rest->executa();

	if( $xml->status == "sucesso" )
	{
		if( $xml->registros >= 1 )
		{
			// Looping nos registros
			foreach( $xml->registro as $registro )
			{
				// Imprime na tela
				print 'Marca: <b>' . utf8_decode( $registro->marca ) . '</b>';
				print ' | Modelo: <b>' . utf8_decode( $registro->modelo ) . '</b>';
				print ' | Versao: <b>' . utf8_decode( $registro->versao ) . '</b>';
				print ' | Km: <b>' . utf8_decode( $registro->km ) . '</b>';
				print ' | Cor: <b>' . utf8_decode( $registro->cor ) . '</b><br><br><br>';

				// Caso existam acess�rios...
				if( count($registro->acessorios->item) )
				{
					print "Acessorios: <br>";

					foreach( $registro->acessorios->item as $acessorio )
					{
						print "- " . $acessorio . "<br>";
					}

					print "<br><br>";
				}

				// Caso existam FOTOS...
				if( count( $registro->fotos->url ) )
				{
					// Autorisa o "fopen" em conex�es externas.
					ini_set( "allow_url_fopen" , 1 );

					print "Fotos: <br>";

					// Looping nas Fotos
					foreach( $registro->fotos->url as $foto )
					{
						print "- {$foto}<br>";

						// Coleta apenas o nome e extens�o da imagem.
						$foto_nome = substr( $foto , strrpos( $foto , '/' ) + 1 );

						// Diret�rio onde ser� salva a imagem.
						$dir = 'imagens';

						// Le o conte�do do arquivo no sistema AutoGestor.
						$get_foto = file_get_contents( $foto );

						// Caso tenha feito a leitura do arquivo...
						if( $get_foto )
						{
							// Salva a imagem no servidor onde est� o site do Cliente.
							file_put_contents( $dir . $foto_nome , $get_foto );
						}

					}//END foreach $registro->fotos

					print "<br><br>";

				}//END if count($registro->fotos)

			}//END foreach $xml->registro

		}//END if $xml->registros

		// N�o cont�m ve�culos
		else
		{
			print "Nao contem veiculos";
		}

	}//END if $xml->status

	// ERRO
	else
	{
		print '<pre>';

		// Imprime o Erro
		print_r( $rest->erro() );
	}
