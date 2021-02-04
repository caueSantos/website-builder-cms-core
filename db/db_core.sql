-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
  `Multilinguagem_sel` enum('SIM','NAO') NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL,
  PRIMARY KEY (`Id_int`),
  KEY `Conexoes_for` (`Conexoes_for`),
  KEY `Clientes_for` (`Clientes_for`),
  CONSTRAINT `apps_ibfk_1` FOREIGN KEY (`Conexoes_for`) REFERENCES `conexoes` (`Id_int`),
  CONSTRAINT `apps_ibfk_2` FOREIGN KEY (`Clientes_for`) REFERENCES `clientes` (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `apps` (`Id_int`, `Conta_cpanel_txf`, `Lands_id`, `Lands_pass`, `Nome_app_txf`, `Estado_sel`, `Segmento_padrao_txf`, `Pagina_inicial_txf`, `Filtro_ip_txf`, `Clientes_for`, `Conexoes_for`, `Conexao_ftp_for`, `Tipo_app_sel`, `Logo_txa`, `Favicon_txf`, `Url_cliente`, `Url_facebook_txf`, `Url_facebook_aba_txf`, `Url_curl_txf`, `Titulo_txf`, `Descricao_txf`, `Pasta_assets`, `Pasta_painel`, `Template_txf`, `Template_dev_txf`, `Template_relatorio_txf`, `Tabela_info_txf`, `Tabela_contato_txf`, `Campo_categoria_txf`, `Idioma_padrao_txf`, `Grava_acesso_sel`, `Grava_log_sel`, `Observacoes_txa`, `Scripts_txa`, `Robots_txa`, `Scripts_header_txa`, `Scripts_footer_txa`, `Copia_emails_txf`, `Sessao_privada_sel`, `Captcha_sel`, `Multilinguagem_sel`, `Ativo_sel`) VALUES
(1,	'hubvet',	'hubvet',	'hubvet',	'Hubvet',	'CONSTRUCAO',	'1',	'inicio',	'45.229.106.26,1',	1,	1,	0,	'site',	'hubvet.png',	'favicon.png',	'https://localhost/hubvet/',	'',	'',	'',	'Hubvet',	'',	'core/assets/hubvet/site/',	'painel/',	'producao/hubvet/site/',	'',	'relatorios',	'_info',	'_contato',	'',	'',	'NAO',	'NAO',	'',	'',	NULL,	'',	'',	'',	'SIM',	'NAO',	'SIM',	'SIM');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Tabela que conterá os dados gerais dos clientes e usuário,';

INSERT INTO `clientes` (`Id_int`, `Dominio_txf`, `Fantasia_txf`, `Email_txf`, `Endereco_txf`, `Numero_txf`, `Bairro_txf`, `Cidade_txf`, `Estado_sel`, `Cep_txf`, `Telefone_txf`, `Fanpage_txf`, `Facebook_txf`, `Twitter_txf`, `Linkedin_txf`, `Instagram_txf`, `Pinterest_txf`, `Google_plus_txf`, `Logomarca_ico`, `Ativo_sel`) VALUES
(1,	'hubvet.com.br',	'Hubvet',	'contato@hubvet.com.br',	'Rua Frei Gabriel',	'538',	'Centro',	'Lages',	'SC',	'88502-030',	'(49) 99162-6278',	'',	'',	'',	'',	'',	'',	'',	'',	'SIM');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `Linguagem_sel` varchar(100) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`),
  KEY `Clientes_for` (`Clientes_for`),
  CONSTRAINT `conexoes_ibfk_1` FOREIGN KEY (`Clientes_for`) REFERENCES `clientes` (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `conexoes` (`Id_int`, `Clientes_for`, `Nome_conexao_txf`, `Servidor_txf`, `Usuario_txf`, `Senha_txp`, `Database_txf`, `Porta_txf`, `Faz_backup_sel`, `Linguagem_sel`, `Ativo_sel`) VALUES
(1,	1,	'Hubvet - Site',	'localhost',	'root',	'',	'hubvet_site',	'',	'NAO',	'pt-br',	'SIM'),
(2,	1,	'Blog',	'localhost',	'root',	'',	'blog',	'',	'NAO',	'',	'SIM'),
(3,	1,	'Hubvet - Site Inglês',	'localhost',	'root',	'',	'hubvet_site_en',	'',	'NAO',	'en-us',	'SIM');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `queries` (`Id_int`, `Lands_id`, `Debug_sel`, `Apps_for`, `Conexoes_for`, `Pagina_txf`, `Tipo_sel`, `Variavel_txf`, `Tabela_txf`, `Tabela_chb`, `Campos_txf`, `Metodo_txf`, `Consulta_sql_txf`, `Segment2_txf`, `Segment3_txf`, `Segment4_txf`, `Group_by_txf`, `Order_by_txf`, `Campo_imagem_txf`, `Arquivo_tpl_txf`, `Qtde_registro_pagina_txf`, `Segmento_paginacao_txf`, `Tipo_paginacao`, `Explicacao_txa`, `Ativo_sel`) VALUES
(3855,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'telefones',	'telefones',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os telefones para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3869,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'whats',	'whatsapp',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o Endereço da Empresa para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3871,	'hubvet',	'NAO',	1,	1,	'default',	'pagina',	'titulos',	'titulos',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	0,	NULL,	NULL,	'',	'SIM'),
(3907,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'enderecos',	'enderecos',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o Endereço da Empresa para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3908,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'redes_sociais',	'redes_sociais',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o as redes sociais para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3911,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'horarios',	'horarios',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os horarios de atendimento.',	'SIM'),
(3912,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'sobre',	'sobre',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3913,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'banners',	'banners',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3914,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'popup',	'popup',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Id_int is not null and Data_inicio_dat <= now() and Data_fim_dat >= now() and Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Buscar popups em todas páginas',	'SIM'),
(3943,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'textos',	'textos',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os textos',	'SIM'),
(3944,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'emails',	'emails',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os emails para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3948,	'hubvet',	'NAO',	1,	1,	'sobre',	'pagina',	'sobre_mim',	'sobre_mim',	'',	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Buscar popups em todas páginas',	'SIM'),
(3956,	'hubvet',	'NAO',	1,	1,	'imoveis',	'default',	'imoveis',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	'Nome_url=\'{segment2}\'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3957,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'caracteristicas_tipos',	'caracteristicas_tipos',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3958,	'hubvet',	'NAO',	1,	1,	'inicio',	'pagina',	'imoveis_selecao',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\' AND Exibe_selecao_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by RAND() limit 3',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3959,	'hubvet',	'NAO',	1,	1,	'inicio',	'pagina',	'imoveis_novos',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Id_int DESC limit 4',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3960,	'hubvet',	'NAO',	1,	1,	'empreendimentos',	'default',	'empreendimentos',	'empreendimentos',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	'Nome_url=\'{segment2}\'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3961,	'hubvet',	'NAO',	1,	1,	'inicio',	'default',	'empreendimentos',	'empreendimentos',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\' AND Exibe_inicio_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3962,	'hubvet',	'NAO',	1,	1,	'sobre',	'pagina',	'sobre_missao',	'sobre_missao',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3963,	'hubvet',	'NAO',	1,	1,	'sobre',	'pagina',	'sobre_jornada',	'sobre_jornada',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3964,	'hubvet',	'NAO',	1,	1,	'sobre',	'pagina',	'equipe',	'equipe',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3965,	'hubvet',	'NAO',	1,	1,	'inicio',	'pagina',	'imoveis_banner',	'imoveis',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel = \'SIM\' AND Exibe_banner_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(3966,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'mensagens_retorno',	'mensagens_retorno',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os telefones para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3967,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'banners',	'banners',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3968,	'hubvet',	'NAO',	1,	1,	'inicio',	'pagina',	'problemas',	'problemas_tb',	NULL,	'*',	'BUSCAR_COMPLETO_VIN',	'where Ativo_sel=\'SIM\'',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3969,	'hubvet',	'NAO',	1,	1,	'inicio',	'pagina',	'sobre_inicio',	'sobre_inicio',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3970,	'hubvet',	'NAO',	1,	1,	'inicio,funcionalidades',	'pagina',	'funcionalidades',	'funcionalidades',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3971,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'parceiros',	'parceiros',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3972,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'parceiros_depoimentos',	'parceiros_depoimentos',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3973,	'hubvet',	'NAO',	1,	1,	'solucoes',	'pagina',	'solucoes_banner',	'solucoes_banner',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3974,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'solucoes_controle_lista',	'solucoes_controle',	NULL,	'*',	'SQL',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3975,	'hubvet',	'NAO',	1,	1,	'solucoes',	'pagina',	'solucoes_controle',	'solucoes_controle',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3976,	'hubvet',	'NAO',	1,	1,	'solucoes',	'pagina',	'solucoes_oferecer',	'solucoes_oferecer',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3977,	'hubvet',	'NAO',	1,	1,	'solucoes',	'pagina',	'solucoes_oferecer_itens',	'solucoes_oferecer_itens',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3978,	'hubvet',	'NAO',	1,	1,	'solucoes',	'pagina',	'solucoes_visao',	'solucoes_visao',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3979,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'solucoes_oferecer_lista',	'solucoes_oferecer',	NULL,	'*',	'SQL',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3980,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'creditos_secao',	'creditos_secao',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3981,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'historias_secao',	'cases',	NULL,	'*',	'SQL',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by RAND() limit 1',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3982,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'configs',	'configs',	NULL,	'*',	'SQL',	'where Id_int is not null',	'',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3983,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'duvidas_secao',	'duvidas_secao',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3984,	'hubvet',	'NAO',	1,	1,	'funcionalidades',	'default',	'funcionalidades_fluxo',	'funcionalidades_fluxo',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3985,	'hubvet',	'NAO',	1,	1,	'planos',	'pagina',	'planos',	'planos',	'plano_itens',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3986,	'hubvet',	'NAO',	1,	1,	'planos',	'pagina',	'plano_itens',	'plano_itens',	'',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3987,	'hubvet',	'NAO',	1,	1,	'cases',	'pagina',	'cases_banner',	'cases_banner',	'',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3988,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'case_destaque',	'cases',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'',	NULL,	NULL,	NULL,	'order by RAND() limit 1',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3989,	'hubvet',	'NAO',	1,	1,	'cases',	'default',	'cases',	'cases',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3990,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'labels',	'labels',	NULL,	'*',	'SQL',	'where Id_int is not null',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os emails para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(3991,	'hubvet',	'NAO',	1,	1,	'cases',	'default',	'case_interna',	'cases',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	'Nome_url=\'{segment2}\'',	NULL,	NULL,	NULL,	'order by Id_int limit 1',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(3992,	'hubvet',	'NAO',	1,	1,	'materiais',	'default',	'materiais',	'materiais',	'categorias',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3993,	'hubvet',	'NAO',	1,	1,	'materiais',	'default',	'materiais_categorias',	'categorias',	'',	'*',	'SQL',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3994,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'menu_topo_itens',	'menu_topo_itens',	'',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3995,	'hubvet',	'NAO',	1,	1,	'default',	'default',	'menu_topo',	'menu_topo',	'',	'*',	'SQL',	'where Ativo_sel=\'SIM\'\r\n\r\n{if $requisicao[\'persona\']}\r\n and FIND_IN_SET(\'{$requisicao[\'persona\']}\', Labels_hid)\r\n{/if}',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3996,	'hubvet',	'NAO',	1,	1,	'central-de-ajuda',	'default',	'perguntas',	'perguntas',	'categorias',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3997,	'hubvet',	'NAO',	1,	1,	'central-de-ajuda',	'default',	'ajuda_itens',	'ajuda_itens',	'',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3998,	'hubvet',	'NAO',	1,	1,	'central-de-ajuda',	'default',	'ajuda_categorias',	'ajuda_categorias',	'',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(3999,	'hubvet',	'NAO',	1,	1,	'sobre',	'default',	'sobre_linha_tempo',	'sobre_linha_tempo',	'',	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ano_txf, Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'',	'SIM'),
(4000,	'hubvet',	'NAO',	1,	1,	'carreira',	'pagina',	'vagas',	'vagas',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	NULL,	NULL,	NULL,	NULL,	'order by Ordenacao_txf',	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(4001,	'hubvet',	'NAO',	1,	1,	'carreira',	'default',	'emails',	'emails',	NULL,	'*',	'SQL',	'where Ativo_sel=\'SIM\' and Descricao_txf=\'carreira\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca os emails para por nas páginas de contato e topo e rodapé do site',	'SIM'),
(4002,	'hubvet',	'NAO',	1,	1,	'carreira',	'default',	'vaga_interna',	'vagas',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel=\'SIM\'',	'Nome_url=\'{segment2}\'',	NULL,	NULL,	NULL,	'order by Id_int limit 1',	'',	NULL,	NULL,	NULL,	NULL,	'Busca dos banners da página inicio',	'SIM'),
(4003,	'hubvet',	'NAO',	1,	1,	'carreira',	'pagina',	'carreira_parte',	'carreira_parte',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM'),
(4004,	'hubvet',	'NAO',	1,	1,	'carreira',	'pagina',	'carreira_proposta',	'carreira_proposta',	NULL,	'*',	'BUSCAR_COMPLETO',	'where Ativo_sel = \'SIM\'',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	'Busca o texto, imagens e vídeos da página sobre da empresa.',	'SIM');

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


-- 2021-02-04 04:59:56
