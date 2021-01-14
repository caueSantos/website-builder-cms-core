-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `zehimove_core`;

DROP TABLE IF EXISTS `acessos`;
CREATE TABLE `acessos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Ip_txf` varchar(255) NOT NULL,
  `Origem_txf` varchar(255) NOT NULL DEFAULT 'Indefinida',
  `Acesso_dat` datetime NOT NULL,
  `Pagina_txf` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `apps`;
CREATE TABLE `apps` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Conta_cpanel_txf` varchar(255) NOT NULL,
  `Lands_id` varchar(255) NOT NULL,
  `Lands_pass` varchar(255) NOT NULL,
  `Nome_app_txf` varchar(255) NOT NULL,
  `Estado_sel` enum('CONSTRUCAO','MANUTENCAO','FINALIZADO','UPDATE') NOT NULL DEFAULT 'CONSTRUCAO',
  `Segmento_padrao_txf` varchar(1) NOT NULL DEFAULT '1',
  `Pagina_inicial_txf` varchar(255) NOT NULL DEFAULT 'inicio',
  `Filtro_ip_txf` varchar(255) NOT NULL DEFAULT '179.178.53.22',
  `Clientes_for` int(11) NOT NULL,
  `Conexoes_for` int(11) NOT NULL,
  `Conexao_ftp_for` int(11) NOT NULL,
  `Tipo_app_sel` enum('site','mailing') NOT NULL DEFAULT 'site',
  `Logo_txa` varchar(255) NOT NULL DEFAULT 'http://core.landshosting.com.br/assets/',
  `Favicon_txf` varchar(255) NOT NULL DEFAULT 'favicon.png',
  `Url_cliente` tinytext NOT NULL,
  `Url_facebook_txf` tinytext NOT NULL,
  `Url_facebook_aba_txf` tinytext NOT NULL,
  `Url_curl_txf` tinytext NOT NULL,
  `Titulo_txf` varchar(70) NOT NULL DEFAULT 'Inserir Titulo',
  `Descricao_txf` varchar(150) NOT NULL,
  `Pasta_assets` varchar(255) NOT NULL DEFAULT 'http://core.landshosting.com.br/assets/modelo/',
  `Pasta_painel` varchar(255) NOT NULL DEFAULT '/painel',
  `Template_txf` varchar(255) NOT NULL DEFAULT 'padrao',
  `Template_dev_txf` varchar(255) NOT NULL,
  `Template_relatorio_txf` varchar(255) NOT NULL DEFAULT 'relatorios',
  `Tabela_info_txf` varchar(255) NOT NULL,
  `Tabela_contato_txf` varchar(255) NOT NULL,
  `Campo_categoria_txf` varchar(255) NOT NULL,
  `Idioma_padrao_txf` varchar(255) NOT NULL,
  `Grava_acesso_sel` enum('SIM','NAO') NOT NULL DEFAULT 'NAO',
  `Grava_log_sel` enum('SIM','NAO') NOT NULL DEFAULT 'NAO',
  `Observacoes_txa` text NOT NULL,
  `Scripts_txa` text NOT NULL,
  `Robots_txa` text,
  `Scripts_header_txa` text NOT NULL,
  `Scripts_footer_txa` text NOT NULL,
  `Copia_emails_txf` varchar(255) NOT NULL,
  `Sessao_privada_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  `Captcha_sel` enum('SIM','NAO') NOT NULL DEFAULT 'NAO',
  `Ativo_sel` enum('SIM','NAO') NOT NULL,
  PRIMARY KEY (`Id_int`),
  KEY `Conexoes_for` (`Conexoes_for`),
  KEY `Clientes_for` (`Clientes_for`),
  CONSTRAINT `apps_ibfk_1` FOREIGN KEY (`Conexoes_for`) REFERENCES `conexoes` (`Id_int`),
  CONSTRAINT `apps_ibfk_2` FOREIGN KEY (`Clientes_for`) REFERENCES `clientes` (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `apps` (`Id_int`, `Conta_cpanel_txf`, `Lands_id`, `Lands_pass`, `Nome_app_txf`, `Estado_sel`, `Segmento_padrao_txf`, `Pagina_inicial_txf`, `Filtro_ip_txf`, `Clientes_for`, `Conexoes_for`, `Conexao_ftp_for`, `Tipo_app_sel`, `Logo_txa`, `Favicon_txf`, `Url_cliente`, `Url_facebook_txf`, `Url_facebook_aba_txf`, `Url_curl_txf`, `Titulo_txf`, `Descricao_txf`, `Pasta_assets`, `Pasta_painel`, `Template_txf`, `Template_dev_txf`, `Template_relatorio_txf`, `Tabela_info_txf`, `Tabela_contato_txf`, `Campo_categoria_txf`, `Idioma_padrao_txf`, `Grava_acesso_sel`, `Grava_log_sel`, `Observacoes_txa`, `Scripts_txa`, `Robots_txa`, `Scripts_header_txa`, `Scripts_footer_txa`, `Copia_emails_txf`, `Sessao_privada_sel`, `Captcha_sel`, `Ativo_sel`) VALUES
(1,	'zehimoveis',	'zehimoveis',	'zehimoveis',	'Zeh Imóveis',	'FINALIZADO',	'1',	'inicio',	'45.229.106.26,177.37.83.236',	1,	1,	0,	'site',	'zehimoveis.png',	'favicon.png',	'https://localhost/zehimoveis/',	'',	'',	'',	'Zeh Imóveis',	'',	'core/assets/zehimoveis/site/',	'painel/',	'producao/zehimoveis/site/',	'',	'relatorios',	'_info',	'_contato',	'',	'',	'NAO',	'NAO',	'',	'',	NULL,	'',	'',	'',	'SIM',	'NAO',	'SIM');

DROP TABLE IF EXISTS `apps_config`;
CREATE TABLE `apps_config` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Campo_txf` varchar(255) NOT NULL,
  `Valor_txa` text NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `blocos`;
CREATE TABLE `blocos` (
  `Id_int` int(255) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Tipo_sel` enum('TPL','VIRTUAL') NOT NULL DEFAULT 'VIRTUAL',
  `Pagina_txf` varchar(255) NOT NULL DEFAULT 'default',
  `Variavel_txf` varchar(255) NOT NULL,
  `Conteudo_txa` text NOT NULL,
  `Arquivo_tpl_txf` varchar(255) NOT NULL,
  `Template_txf` varchar(255) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Dominio_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Fantasia_txf` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `Email_txf` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Endereco_txf` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Numero_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Bairro_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Cidade_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Estado_sel` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Cep_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Telefone_txf` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Fanpage_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Facebook_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Twitter_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Linkedin_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Instagram_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Pinterest_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Google_plus_txf` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Logomarca_ico` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Ativo_sel` enum('SIM','NAO') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Tabela que conterá os dados gerais dos clientes e usuário,';

INSERT INTO `clientes` (`Id_int`, `Dominio_txf`, `Fantasia_txf`, `Email_txf`, `Endereco_txf`, `Numero_txf`, `Bairro_txf`, `Cidade_txf`, `Estado_sel`, `Cep_txf`, `Telefone_txf`, `Fanpage_txf`, `Facebook_txf`, `Twitter_txf`, `Linkedin_txf`, `Instagram_txf`, `Pinterest_txf`, `Google_plus_txf`, `Logomarca_ico`, `Ativo_sel`) VALUES
(1,	'zehimoveisosticos.com.br',	'Zeh Imóveis',	'contato@zehimoveisosticos.com.br',	'Rua Coronel João Lourenço Porto',	'252',	'Centro',	'Campina Grande',	'PB',	'58400-240 ',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'SIM');

DROP TABLE IF EXISTS `clientes_smtp`;
CREATE TABLE `clientes_smtp` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Clientes_for` int(11) NOT NULL,
  `Smtp_usuario_txf` varchar(255) NOT NULL,
  `Smtp_host_txf` varchar(255) NOT NULL DEFAULT 'mail.landshosting.com.br',
  `Smtp_senha_txf` varchar(255) NOT NULL DEFAULT 'Ld230551',
  `Smtp_porta_txf` varchar(255) NOT NULL DEFAULT '587',
  `Smtp_seguranca_txf` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `clientes_smtp` (`Id_int`, `Clientes_for`, `Smtp_usuario_txf`, `Smtp_host_txf`, `Smtp_senha_txf`, `Smtp_porta_txf`, `Smtp_seguranca_txf`) VALUES
(1,	1,	'contato@landsagenciaweb.com.br',	'186.226.56.200',	'ldlf8384@1',	'587',	'1');

DROP TABLE IF EXISTS `conexoes`;
CREATE TABLE `conexoes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Clientes_for` int(11) DEFAULT NULL,
  `Nome_conexao_txf` varchar(255) NOT NULL,
  `Servidor_txf` varchar(255) NOT NULL,
  `Usuario_txf` varchar(255) NOT NULL,
  `Senha_txp` varchar(255) NOT NULL,
  `Database_txf` varchar(255) NOT NULL,
  `Porta_txf` varchar(255) NOT NULL,
  `Faz_backup_sel` varchar(255) NOT NULL DEFAULT 'SIM',
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`),
  KEY `Clientes_for` (`Clientes_for`),
  CONSTRAINT `conexoes_ibfk_1` FOREIGN KEY (`Clientes_for`) REFERENCES `clientes` (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `conexoes` (`Id_int`, `Clientes_for`, `Nome_conexao_txf`, `Servidor_txf`, `Usuario_txf`, `Senha_txp`, `Database_txf`, `Porta_txf`, `Faz_backup_sel`, `Ativo_sel`) VALUES
(1,	1,	'Zeh Imóveis - Site',	'localhost',	'root',	'',	'zehimoveis_site',	'',	'NAO',	'SIM'),
(2,	1,	'Blog',	'localhost',	'root',	'',	'blog',	'',	'NAO',	'SIM');

DROP TABLE IF EXISTS `conexoes_ftp`;
CREATE TABLE `conexoes_ftp` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_conexao_txf` varchar(255) NOT NULL,
  `Servidor_txf` varchar(255) NOT NULL,
  `Usuario_txf` varchar(255) NOT NULL,
  `Senha_txf` varchar(255) NOT NULL,
  `Path_txf` varchar(255) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `keys`;
CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` int(1) NOT NULL DEFAULT '0',
  `is_private_key` int(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `queries`;
CREATE TABLE `queries` (
  `Id_int` int(255) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL DEFAULT 'default',
  `Debug_sel` varchar(255) NOT NULL DEFAULT 'NAO',
  `Apps_for` int(11) NOT NULL,
  `Conexoes_for` int(11) NOT NULL,
  `Pagina_txf` varchar(255) DEFAULT NULL,
  `Tipo_sel` enum('pagina','ajax','default') DEFAULT NULL,
  `Variavel_txf` varchar(255) DEFAULT NULL,
  `Tabela_txf` varchar(255) DEFAULT NULL,
  `Tabela_chb` varchar(255) DEFAULT NULL,
  `Campos_txf` varchar(255) DEFAULT '*',
  `Metodo_txf` enum('SUPER_PAGINACAO','BUSCAR_COMPLETO_VIN','BUSCAR_COMPLETO','REGISTRO_IMAGENS_VIDEOS','SUPER_PAGINACAO','SQL','SQL MANUAL','SQL MANUAL_COMPLETO','PAGINACAO','PAGINACAO CATEGORIA','IMAGENS E CONTEUDO','IMAGENS E CONTEUDO E PAGINACAO','IMAGENS E CONTEUDO E CATEGORIA','VIDEOS E CONTEUDO','SHOW TABLES','TESTE') DEFAULT NULL,
  `Consulta_sql_txf` text,
  `Segment2_txf` varchar(255) DEFAULT NULL,
  `Segment3_txf` varchar(255) DEFAULT NULL,
  `Segment4_txf` varchar(255) DEFAULT NULL,
  `Group_by_txf` varchar(255) DEFAULT NULL,
  `Order_by_txf` varchar(255) DEFAULT NULL,
  `Campo_imagem_txf` varchar(255) DEFAULT NULL,
  `Arquivo_tpl_txf` varchar(255) DEFAULT NULL,
  `Qtde_registro_pagina_txf` int(255) DEFAULT '5',
  `Segmento_paginacao_txf` int(255) DEFAULT NULL,
  `Tipo_paginacao` enum('URL','QUERY_STRING') DEFAULT NULL,
  `Explicacao_txa` text NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`),
  KEY `Apps_for` (`Apps_for`),
  KEY `Conexoes_for` (`Conexoes_for`),
  CONSTRAINT `queries_ibfk_7` FOREIGN KEY (`Apps_for`) REFERENCES `apps` (`Id_int`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `queries_ibfk_8` FOREIGN KEY (`Conexoes_for`) REFERENCES `conexoes` (`Id_int`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3966 DEFAULT CHARSET=latin1;

INSERT INTO `queries` (`Id_int`, `Lands_id`, `Debug_sel`, `Apps_for`, `Conexoes_for`, `Pagina_txf`, `Tipo_sel`, `Variavel_txf`, `Tabela_txf`, `Tabela_chb`, `Campos_txf`, `Metodo_txf`, `Consulta_sql_txf`, `Segment2_txf`, `Segment3_txf`, `Segment4_txf`, `Group_by_txf`, `Order_by_txf`, `Campo_imagem_txf`, `Arquivo_tpl_txf`, `Qtde_registro_pagina_txf`, `Segmento_paginacao_txf`, `Tipo_paginacao`, `Explicacao_txa`, `Ativo_sel`) VALUES
(3855,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'telefones',	'telefones',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os telefones para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3869,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'whats',	'whatsapp',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o Endereço da Empresa para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3871,	'zehimoveis',	'NAO',	1,	1,	'default',	'pagina',	'titulos',	'titulos',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	0,	NULL,	NULL,	'',	'SIM'),
(3907,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'enderecos',	'enderecos',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o Endereço da Empresa para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3908,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'redes_sociais',	'redes_sociais',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o as redes sociais para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3911,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'horarios',	'horarios',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os horarios de atendimento.',	'SIM'),
(3912,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'sobre',	'sobre',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3913,	'zehimoveis',	'NAO',	1,	1,	'inicio',	'pagina',	'banners',	'banners',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3914,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'popup',	'popup',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Id_int is not null and Data_inicio_dat <= now() and Data_fim_dat >= now() and Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Buscar popups em todas páginas',	'SIM'),
(3943,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'textos',	'textos',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os textos',	'SIM'),
(3944,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'emails',	'emails',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os emails para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3948,	'zehimoveis',	'NAO',	1,	1,	'sobre',	'pagina',	'sobre_mim',	'sobre_mim',	'',	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Buscar popups em todas páginas',	'SIM'),
(3952,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'labcloud_config',	'labcloud_config',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3954,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'selos',	'selos',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3955,	'zehimoveis',	'NAO',	1,	1,	'inicio',	'pagina',	'parceiros',	'parceiros',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3956,	'zehimoveis',	'NAO',	1,	1,	'imoveis',	'default',	'imoveis',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	'Nome_url=\'{segment2}\'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3957,	'zehimoveis',	'NAO',	1,	1,	'default',	'default',	'caracteristicas_tipos',	'caracteristicas_tipos',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3958,	'zehimoveis',	'NAO',	1,	1,	'inicio',	'pagina',	'imoveis_selecao',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\' AND Exibe_selecao_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by RAND() limit 3',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3959,	'zehimoveis',	'NAO',	1,	1,	'inicio',	'pagina',	'imoveis_novos',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Id_int DESC limit 4',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3960,	'zehimoveis',	'NAO',	1,	1,	'empreendimentos',	'default',	'empreendimentos',	'empreendimentos',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	'Nome_url=\'{segment2}\'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3961,	'zehimoveis',	'NAO',	1,	1,	'inicio',	'default',	'empreendimentos',	'empreendimentos',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\' AND Exibe_inicio_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3962,	'zehimoveis',	'NAO',	1,	1,	'sobre',	'pagina',	'sobre_carreira',	'sobre_carreira',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3963,	'zehimoveis',	'NAO',	1,	1,	'sobre',	'pagina',	'sobre_referencia',	'sobre_referencia',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3964,	'zehimoveis',	'NAO',	1,	1,	'sobre',	'pagina',	'equipe',	'equipe',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3965,	'zehimoveis',	'NAO',	1,	1,	'inicio',	'pagina',	'imoveis_banner',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel = \'SIM\' AND Exibe_banner_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_txf` varchar(255) NOT NULL,
  `Lands_id` varchar(255) NOT NULL,
  `Login_txf` varchar(255) NOT NULL,
  `Senha_txp` varchar(255) NOT NULL,
  `Nivel_sel` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `_contato`;
CREATE TABLE `_contato` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Nome_txf` varchar(255) NOT NULL,
  `Produto_txf` varchar(255) NOT NULL,
  `Telefone_txf` varchar(255) NOT NULL,
  `Cidade_txf` varchar(255) NOT NULL,
  `Estado_sel` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Destinatario_txf` varchar(255) NOT NULL,
  `Setor_sel` varchar(255) NOT NULL,
  `Mensagem_txa` longtext CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Data_dat` date NOT NULL,
  `Ultimoenvio_dat` date NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `_contatos_site`;
CREATE TABLE `_contatos_site` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Nome_txf` varchar(255) NOT NULL,
  `Produto_txf` varchar(255) NOT NULL,
  `Telefone_txf` varchar(255) NOT NULL,
  `Cidade_txf` varchar(255) NOT NULL,
  `Estado_sel` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Arquivos_arq` varchar(255) NOT NULL,
  `Destinatario_txf` varchar(255) NOT NULL,
  `Mensagem_txa` longtext CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Data_dat` date NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-11-07 08:35:04
