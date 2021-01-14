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
	 * Exemplo utilizando a classe AutoGestorWs
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
	 * O não cumprimento desta regra implica no bloqueio da API.
	 * Para exibir as imagens, as mesmas deverão ser copiadas para o servidor onde está hospedado o site do Cliente.
	 *
	 * Inicialmente o limite é estabelecido em 500 conexões diárias para serem utilizadas apenas no período de testes.
	 * Depois de concluída a integração com a API AutoGestor, o desenvolvedor deve avisar o Autogestor através do
	 * endereço de e-mail: atendimento@autogestor.net para que este limite seja reduzido para 50 conexões diárias.
	 */

	// Inclui o arquivo que contem a Class AutoGestorWs
	include('AutoGestorWs.php');

	// Instancia a Class
	$rest = new AutoGestorWs();

	// Fornece a chave de acesso e identificação do Cliente
	$rest->chave( '4297f44b13955235245b2497399d7a93' );

	// Define o propósito da requisição
	$rest->acao( 'ag_lista_itens' );

	// Informa o Charset - Encoding (Influencia no retorno)
	$rest->encoding('iso-8859-1');

	// Retorna um Objeto SimpleXMLElement ao invés de uma String XML
	$rest->objeto( true );

	// Executa a requisição
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

				// Caso existam acessórios...
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
					// Autorisa o "fopen" em conexões externas.
					ini_set( "allow_url_fopen" , 1 );

					print "Fotos: <br>";

					// Looping nas Fotos
					foreach( $registro->fotos->url as $foto )
					{
						print "- {$foto}<br>";

						// Coleta apenas o nome e extensão da imagem.
						$foto_nome = substr( $foto , strrpos( $foto , '/' ) + 1 );

						// Diretório onde será salva a imagem.
						$dir = 'imagens';

						// Le o conteúdo do arquivo no sistema AutoGestor.
						$get_foto = file_get_contents( $foto );

						// Caso tenha feito a leitura do arquivo...
						if( $get_foto )
						{
							// Salva a imagem no servidor onde está o site do Cliente.
							file_put_contents( $dir . $foto_nome , $get_foto );
						}

					}//END foreach $registro->fotos

					print "<br><br>";

				}//END if count($registro->fotos)

			}//END foreach $xml->registro

		}//END if $xml->registros

		// Não contém veículos
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
