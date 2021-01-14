-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

USE `zehimove_site`;

DROP TABLE IF EXISTS `adicionais`;
CREATE TABLE `adicionais` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_objeto_con` int(11) NOT NULL,
  `Tabela_con` varchar(250) NOT NULL,
  `Tipo_sel` varchar(250) NOT NULL,
  `Valor_txf` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

INSERT INTO `adicionais` (`Id_int`, `Id_objeto_con`, `Tabela_con`, `Tipo_sel`, `Valor_txf`) VALUES
(16,	4,	'imoveis',	'IPTU',	'R$ 290,00'),
(17,	4,	'imoveis',	'Condomínio',	'R$ 100,00');

DROP TABLE IF EXISTS `arquivos`;
CREATE TABLE `arquivos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_arquivo_con` int(11) DEFAULT NULL,
  `Tabela_con` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Descricao_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Caminho_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Tipo_txf` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Nome_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Data_int` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo_txa` varchar(255) NOT NULL,
  `Titulo_menor_txa` varchar(255) NOT NULL,
  `Texto_txa` longtext NOT NULL,
  `Ordenacao_txf` varchar(255) NOT NULL,
  `Imagem_ico` varchar(255) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

INSERT INTO `banners` (`Id_int`, `Titulo_txa`, `Titulo_menor_txa`, `Texto_txa`, `Ordenacao_txf`, `Imagem_ico`, `Ativo_sel`) VALUES
(42,	'Zeh Imóveis',	'VOC&Ecirc; CONHECE A',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris volutpat donec nunc lectus. Adipiscing praesent sit nulla felis purus nisl, volutpat faucibus blandit. Fames quis auctor tempus, eu libero est. Eu sed sed tortor velit augue. Porta diam lorem mauris enim. Sapien gravida sit massa erat blandit.',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'SIM'),
(48,	'Eu sou o <strong>Banner 3</strong>',	'',	'Os servi&ccedil;os da ControlLab est&atilde;o essencialmente direcionados a todos os laborat&oacute;rios que se preocupam em garantir a qualidade confiabilidade de seus laudos de an&aacute;lise.\r\n\r\nOs servi&ccedil;os da ControlLab est&atilde;o essencialmente direcionados a todos os laborat&oacute;rios que se preocupam em garantir a qualidade confiabilidade de seus laudos de an&aacute;lise.\r\n\r\n',	'2',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'SIM');

DROP TABLE IF EXISTS `caracteristicas`;
CREATE TABLE `caracteristicas` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_objeto_con` int(11) NOT NULL,
  `Tabela_con` varchar(250) NOT NULL,
  `Tipo_sel` varchar(250) NOT NULL,
  `Valor_min_txf` varchar(100) NOT NULL,
  `Valor_max_txf` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO `caracteristicas` (`Id_int`, `Id_objeto_con`, `Tabela_con`, `Tipo_sel`, `Valor_min_txf`, `Valor_max_txf`) VALUES
(4,	1,	'imoveis',	'dormitorios',	'',	'10'),
(5,	1,	'imoveis',	'garagem',	'1',	'5'),
(6,	1,	'imoveis',	'banheiros',	'1',	'3'),
(7,	2,	'imoveis',	'dormitorios',	'3',	''),
(9,	4,	'imoveis',	'garagem',	'1',	''),
(10,	4,	'imoveis',	'dormitorios',	'4',	''),
(11,	4,	'imoveis',	'banheiros',	'2',	''),
(12,	3,	'imoveis',	'banheiros',	'3',	''),
(13,	3,	'imoveis',	'dormitorios',	'2',	'6'),
(14,	8,	'imoveis',	'metragem',	'300',	'600'),
(15,	4,	'imoveis',	'metragem',	'150',	'300');

DROP TABLE IF EXISTS `caracteristicas_tipos`;
CREATE TABLE `caracteristicas_tipos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_tit` varchar(500) NOT NULL,
  `Nome_url` varchar(500) NOT NULL,
  `Sufixo_txf` varchar(500) NOT NULL,
  `Exibe_filtro_sel` varchar(500) NOT NULL DEFAULT 'NAO',
  `Tipo_filtro_sel` varchar(500) NOT NULL DEFAULT 'RADIO',
  `Imagens_ico` varchar(500) NOT NULL,
  `Ordenacao_txf` varchar(500) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `caracteristicas_tipos` (`Id_int`, `Nome_tit`, `Nome_url`, `Sufixo_txf`, `Exibe_filtro_sel`, `Tipo_filtro_sel`, `Imagens_ico`, `Ordenacao_txf`) VALUES
(1,	'Dormitórios',	'dormitorios',	'',	'SIM',	'RADIO',	'',	'2'),
(2,	'Garagem',	'garagem',	'',	'SIM',	'RADIO',	'',	'1'),
(3,	'Banheiros',	'banheiros',	'',	'SIM',	'RADIO',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'3'),
(4,	'Metragem',	'metragem',	'm²',	'SIM',	'RANGE',	'',	'4');

DROP TABLE IF EXISTS `checkboxes`;
CREATE TABLE `checkboxes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_objeto_con` int(11) NOT NULL DEFAULT '0',
  `Tabela_con` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Id_chb_con` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Tabela_chb_con` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`Id_int`),
  KEY `fk_checkboxes_produtos1` (`Id_objeto_con`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='## painel  ##';


DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_txf` varchar(255) NOT NULL,
  `Site_txf` varchar(255) NOT NULL,
  `Logo_ico` varchar(255) NOT NULL,
  `Ativo_sel` varchar(255) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `emails`;
CREATE TABLE `emails` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Email_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'contato@landshosting.com.br',
  `Descricao_txf` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Contato',
  `Ativo_sel` enum('SIM','NAO') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `emails` (`Id_int`, `Email_txf`, `Descricao_txf`, `Ativo_sel`) VALUES
(1,	'contato@exemplo.com.br',	'Atendimento',	'SIM');

DROP TABLE IF EXISTS `empreendimentos`;
CREATE TABLE `empreendimentos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_tit` varchar(300) NOT NULL,
  `Nome_url` varchar(300) NOT NULL,
  `Valor_txf` varchar(300) NOT NULL,
  `Descricao_curta_txa` longtext NOT NULL,
  `Descricao_txa` longtext NOT NULL,
  `Mapa_txf` longtext NOT NULL,
  `Mapa360_vin` longtext NOT NULL,
  `Imagens_ico` varchar(200) NOT NULL,
  `Videos_vid` varchar(200) NOT NULL,
  `Exibe_inicio_sel` varchar(200) NOT NULL DEFAULT 'NAO',
  `Ordenacao_txf` varchar(200) NOT NULL DEFAULT '0',
  `Ativo_sel` varchar(200) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `empreendimentos` (`Id_int`, `Nome_tit`, `Nome_url`, `Valor_txf`, `Descricao_curta_txa`, `Descricao_txa`, `Mapa_txf`, `Mapa360_vin`, `Imagens_ico`, `Videos_vid`, `Exibe_inicio_sel`, `Ordenacao_txf`, `Ativo_sel`) VALUES
(1,	'Empreendimento 1',	'empreendimento-1',	'10000.0',	'Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.',	'Integer viverra ante quis libero faucibus aliquet quis sed risus. Ut ac volutpat mi. Quisque a gravida lorem. Praesent in urna posuere, commodo quam ac, rhoncus nisi. Nulla elementum neque pharetra convallis semper. Pellentesque eget feugiat justo, vitae porta sapien. Curabitur bibendum aliquam enim. Nunc ultricies felis a venenatis consectetur. Quisque placerat, mauris ut feugiat sodales, nisi mi malesuada enim, et lacinia orci dui non enim. Sed molestie, lacus in molestie aliquet, odio augue tristique lorem, sit amet vestibulum mi turpis sed dui. Quisque quam tortor, hendrerit nec lorem sed, accumsan consequat quam. Sed efficitur risus sapien. Praesent eget viverra odio. Mauris mauris dolor, dictum eget elit vel, commodo hendrerit turpis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Ut quis sollicitudin mi.\r\n\r\nPellentesque eu tincidunt risus. Donec pharetra ultricies tortor, sed rutrum sem hendrerit id. Suspendisse vel mollis neque, consectetur fringilla erat. Proin feugiat, urna in ultricies gravida, felis nibh auctor est, id egestas massa quam quis dui. Curabitur pellentesque enim eros, a cursus quam luctus at. Nunc blandit est ut ipsum sollicitudin maximus. Quisque interdum arcu ipsum, et lobortis sapien scelerisque nec. Nullam accumsan laoreet congue.',	'',	'',	'',	'',	'SIM',	'0',	'SIM'),
(2,	'Empreendimento 2',	'empreendimento-2',	'999,95',	'Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.',	'Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.',	'!1m18!1m12!1m3!1d3151.724019518823!2d-122.48044378532619!3d37.8199328173344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808586deffffffc3%3A0xcded139783705509!2sPonte%20Golden%20Gate!5e0!3m2!1spt-BR!2sbr!4v1604627584494!5m2!1spt-BR!2sbr',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'SIM',	'0',	'SIM');

DROP TABLE IF EXISTS `enderecos`;
CREATE TABLE `enderecos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Endereco_txf` varchar(255) NOT NULL,
  `Bairro_txf` varchar(255) NOT NULL,
  `Cidade_txf` varchar(255) NOT NULL,
  `Estado_txf` varchar(255) NOT NULL,
  `Cep_txf` varchar(255) NOT NULL,
  `Mapa_txf` longtext NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `enderecos` (`Id_int`, `Endereco_txf`, `Bairro_txf`, `Cidade_txf`, `Estado_txf`, `Cep_txf`, `Mapa_txf`) VALUES
(2,	'R. Heitor Villa Lobos, 525 Órion Parque - Salas 209, 308 e 309',	'São Francisco',	'Lages',	'SC',	'88506-400',	'');

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE `equipe` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_txf` varchar(255) NOT NULL,
  `Cargo_txf` varchar(255) NOT NULL,
  `Imagens_ico` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Telefone_txf` varchar(255) NOT NULL,
  `Whatsapp_txf` varchar(255) NOT NULL,
  `Facebook_txf` varchar(255) NOT NULL,
  `Linkedin_txf` varchar(255) NOT NULL,
  `Ordenacao_txf` varchar(255) NOT NULL,
  `Ativo_sel` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `equipe` (`Id_int`, `Nome_txf`, `Cargo_txf`, `Imagens_ico`, `Email_txf`, `Telefone_txf`, `Whatsapp_txf`, `Facebook_txf`, `Linkedin_txf`, `Ordenacao_txf`, `Ativo_sel`) VALUES
(1,	'Nome do Colaborador',	'Administrativo',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'+5512912345678',	'+5512912345678',	'https://www.facebook.com',	'https://www.linkedin.com',	'2',	'SIM'),
(3,	'Nome do Colaborador',	'Corretor de Imóveis',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'contato@example.com',	'+5512912345678',	'+5512912345678',	'https://www.facebook.com',	'',	'5',	'SIM'),
(4,	'Nome do Colaborador',	'Corretora de Imóveis',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'contato@example.com',	'',	'+5512912345678',	'https://www.facebook.com',	'https://www.linkedin.com',	'6',	'SIM'),
(5,	'Nome do Colaborador',	'Corretor de Imóveis',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'contato@example.com',	'+5512912345678',	'',	'https://www.facebook.com',	'https://www.linkedin.com',	'7',	'SIM'),
(6,	'Nome do Colaborador',	'Sócio Proprietário',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'contato@example.com',	'+5512912345678',	'+5512912345678',	'https://www.facebook.com',	'https://www.linkedin.com',	'11',	'SIM'),
(7,	'Nome do Colaborador',	'Corretor de Imóveis',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'contato@example.com',	'+5512912345678',	'+5512912345678',	'',	'https://www.linkedin.com',	'8',	'SIM');

DROP TABLE IF EXISTS `excecoes`;
CREATE TABLE `excecoes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Adicional_sel` varchar(20) NOT NULL DEFAULT '',
  `Sql_txa` varchar(200) NOT NULL DEFAULT '',
  `Tabela_txf` varchar(50) NOT NULL DEFAULT '',
  `Campo_txf` varchar(50) NOT NULL DEFAULT '',
  `Campo_busca_txf` varchar(50) NOT NULL DEFAULT '',
  `Sql_aux_txa` varchar(200) NOT NULL DEFAULT '',
  `Campo_busca_aux_txf` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COMMENT='## painel  ##';

INSERT INTO `excecoes` (`Id_int`, `Adicional_sel`, `Sql_txa`, `Tabela_txf`, `Campo_txf`, `Campo_busca_txf`, `Sql_aux_txa`, `Campo_busca_aux_txf`) VALUES
(3,	'false',	'show tables',	'selects_checkboxes',	'Tabela_sel',	'0',	'',	'0'),
(4,	'true',	'show tables',	'selects_checkboxes',	'Campo_tabela_sel',	'0',	'show columns from',	'0'),
(5,	'false',	'select Nome_url from caracteristicas_tipos order by Nome_url',	'caracteristicas',	'Tipo_sel',	'0',	'',	'0'),
(6,	'false',	'select Nome_url from unidades order by Nome_url',	'enderecos',	'Unidade_sel',	'0',	'',	'0'),
(7,	'false',	'select Nome_url from unidades order by Nome_url',	'horarios',	'Unidade_sel',	'0',	'',	'0'),
(8,	'false',	'select Nome_url from unidades order by Nome_url',	'emails',	'Unidade_sel',	'0',	'',	'0'),
(9,	'false',	'select Nome_url from unidades order by Nome_url',	'telefones',	'Unidade_sel',	'0',	'',	'0'),
(10,	'false',	'select Nome_url from agenda_categorias order by Nome_url',	'agenda',	'Categoria_sel',	'0',	'',	'0'),
(11,	'false',	'select Nome_url from niveis_ensino order by Nome_url',	'niveis_dados',	'Nivel_sel',	'0',	'',	'0'),
(12,	'false',	'select Nome_url from esportes order by Nome_url',	'esportes_turmas_categorias',	'Esporte_sel',	'0',	'',	'0'),
(13,	'false',	'select Nome_url from esportes_turmas_categorias order by Nome_url',	'esportes_turmas',	'Turma_categoria_sel',	'0',	'',	'0');

DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Semana_txf` varchar(255) NOT NULL DEFAULT '08:00h às 12:00h e 14:00h às 18:00h',
  `Sabado_txf` varchar(255) NOT NULL DEFAULT '08:00h às 12:00h ',
  `Domingo_txf` varchar(255) NOT NULL DEFAULT 'Fechado',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `horarios` (`Id_int`, `Semana_txf`, `Sabado_txf`, `Domingo_txf`) VALUES
(1,	'08:00 às 18:00',	'Plantão (Whatsapp)',	'Fechado');

DROP TABLE IF EXISTS `imagens`;
CREATE TABLE `imagens` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_imagem_con` int(11) DEFAULT NULL,
  `Tabela_con` varchar(50) NOT NULL DEFAULT '',
  `Descricao_txf` varchar(255) NOT NULL DEFAULT '',
  `Caminho_txf` varchar(100) NOT NULL DEFAULT '',
  `Ordem_int` int(11) DEFAULT NULL,
  `Campo_sel` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=790 DEFAULT CHARSET=latin1 COMMENT='Grava endereco das imagens e tabela';

INSERT INTO `imagens` (`Id_int`, `Id_imagem_con`, `Tabela_con`, `Descricao_txf`, `Caminho_txf`, `Ordem_int`, `Campo_sel`) VALUES
(1,	NULL,	'Teste',	'Nenhuma',	'img/teste.png',	NULL,	'Imagens_ico'),
(699,	42,	'banners',	'',	'img/zehimoveis_site/42_banners_7912.jpg',	NULL,	'Imagem_ico'),
(700,	1,	'sobre',	'',	'img/zehimoveis_site/1_sobre_9151.jpg',	NULL,	'Imagens_ico'),
(701,	1,	'solucoes',	'',	'img/zehimoveis_site/1_solucoes_9646.jpg',	NULL,	'Imagens_ico'),
(702,	2,	'solucoes',	'',	'img/zehimoveis_site/2_solucoes_3314.jpg',	NULL,	'Imagens_ico'),
(703,	3,	'solucoes',	'',	'img/zehimoveis_site/3_solucoes_14216.jpg',	NULL,	'Imagens_ico'),
(704,	4,	'solucoes',	'',	'img/zehimoveis_site/4_solucoes_3097.jpg',	NULL,	'Imagens_ico'),
(705,	5,	'solucoes',	'',	'img/zehimoveis_site/5_solucoes_7908.jpg',	NULL,	'Imagens_ico'),
(706,	6,	'solucoes',	'',	'img/zehimoveis_site/6_solucoes_6096.jpg',	NULL,	'Imagens_ico'),
(707,	7,	'solucoes',	'',	'img/zehimoveis_site/7_solucoes_10823.jpg',	NULL,	'Imagens_ico'),
(708,	8,	'solucoes',	'',	'img/zehimoveis_site/8_solucoes_12955.jpg',	NULL,	'Imagens_ico'),
(709,	9,	'parceiros',	'',	'img/zehimoveis_site/9_parceiros_2068.png',	NULL,	'Imagens_ico'),
(710,	8,	'parceiros',	'',	'img/zehimoveis_site/8_parceiros_8426.png',	NULL,	'Imagens_ico'),
(711,	7,	'parceiros',	'',	'img/zehimoveis_site/7_parceiros_5575.png',	NULL,	'Imagens_ico'),
(712,	6,	'parceiros',	'',	'img/zehimoveis_site/6_parceiros_1199.png',	NULL,	'Imagens_ico'),
(713,	4,	'parceiros',	'',	'img/zehimoveis_site/4_parceiros_4007.png',	NULL,	'Imagens_ico'),
(714,	3,	'parceiros',	'',	'img/zehimoveis_site/3_parceiros_14474.png',	NULL,	'Imagens_ico'),
(715,	1,	'parceiros',	'',	'img/zehimoveis_site/1_parceiros_5742.png',	NULL,	'Imagens_ico'),
(716,	1,	'selos',	'',	'img/zehimoveis_site/1_selos_11183.png',	NULL,	'Imagem_ico'),
(717,	2,	'selos',	'',	'img/zehimoveis_site/2_selos_10085.png',	NULL,	'Imagem_ico'),
(718,	48,	'banners',	'',	'img/zehimoveis_site/48_banners_14354.jpg',	NULL,	'Imagem_ico'),
(719,	1,	'imoveis',	'',	'img/zehimoveis_site/1_imoveis_12781.jpg',	NULL,	'Imagens_ico'),
(720,	1,	'imoveis',	'',	'img/zehimoveis_site/1_imoveis_13814.jpg',	NULL,	'Imagens_ico'),
(721,	1,	'imoveis',	'',	'img/zehimoveis_site/1_imoveis_9756.jpg',	NULL,	'Imagens_ico'),
(722,	1,	'imoveis',	'',	'img/zehimoveis_site/1_imoveis_8689.jpg',	NULL,	'Imagens_ico'),
(723,	2,	'caracteristicas_tipos',	'',	'img/zehimoveis_site/2_caracteristicas_tipos_3898.png',	NULL,	'Imagens_ico'),
(724,	1,	'caracteristicas_tipos',	'',	'img/zehimoveis_site/1_caracteristicas_tipos_4339.png',	NULL,	'Imagens_ico'),
(725,	3,	'caracteristicas_tipos',	'',	'img/zehimoveis_site/3_caracteristicas_tipos_3998.png',	NULL,	'Imagens_ico'),
(726,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_8378.jpg',	NULL,	'Imagens_ico'),
(728,	1,	'sobre_mim',	'',	'img/zehimoveis_site/1_sobre_mim_1508.png',	NULL,	'Imagens_ico'),
(731,	1,	'sobre_mim',	'',	'img/zehimoveis_site/1_sobre_mim_7312.png',	NULL,	'Imagens_ico'),
(732,	1,	'sobre_carreira',	'',	'img/zehimoveis_site/1_sobre_carreira_2461.jpg',	NULL,	'Imagens_ico'),
(734,	1,	'sobre_referencia',	'',	'img/zehimoveis_site/1_sobre_referencia_6394.png',	NULL,	'Imagens_ico'),
(735,	6,	'equipe',	'',	'img/zehimoveis_site/6_equipe_3222.png',	NULL,	'Imagens_ico'),
(736,	3,	'equipe',	'',	'img/zehimoveis_site/3_equipe_2730.png',	NULL,	'Imagens_ico'),
(737,	7,	'equipe',	'',	'img/zehimoveis_site/7_equipe_7920.png',	NULL,	'Imagens_ico'),
(738,	5,	'equipe',	'',	'img/zehimoveis_site/5_equipe_10859.png',	NULL,	'Imagens_ico'),
(739,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_681.jpg',	NULL,	'Imagens_ico'),
(740,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_11871.jpg',	NULL,	'Imagens_ico'),
(741,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_12985.jpg',	NULL,	'Imagens_ico'),
(742,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_12504.jpg',	NULL,	'Imagens_ico'),
(743,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_8438.jpg',	NULL,	'Imagens_ico'),
(744,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_10337.jpg',	NULL,	'Imagens_ico'),
(745,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_3976.jpg',	NULL,	'Imagens_ico'),
(746,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_10548.jpg',	NULL,	'Imagens_ico'),
(747,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_13720.jpg',	NULL,	'Imagens_ico'),
(748,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_6002.jpg',	NULL,	'Imagens_ico'),
(749,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_13710.jpg',	NULL,	'Imagens_ico'),
(750,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_12832.jpg',	NULL,	'Imagens_ico'),
(751,	3,	'imoveis',	'',	'img/zehimoveis_site/3_imoveis_8381.jpg',	NULL,	'Imagens_ico'),
(752,	3,	'imoveis',	'',	'img/zehimoveis_site/3_imoveis_9343.jpg',	NULL,	'Imagens_ico'),
(753,	3,	'imoveis',	'',	'img/zehimoveis_site/3_imoveis_9763.jpg',	NULL,	'Imagens_ico'),
(754,	3,	'imoveis',	'',	'img/zehimoveis_site/3_imoveis_4904.jpg',	NULL,	'Imagens_ico'),
(755,	2,	'imoveis',	'',	'img/zehimoveis_site/2_imoveis_1088.jpg',	NULL,	'Imagens_ico'),
(756,	2,	'imoveis',	'',	'img/zehimoveis_site/2_imoveis_12896.jpg',	NULL,	'Imagens_ico'),
(757,	2,	'imoveis',	'',	'img/zehimoveis_site/2_imoveis_6757.jpg',	NULL,	'Imagens_ico'),
(758,	2,	'imoveis',	'',	'img/zehimoveis_site/2_imoveis_11520.jpg',	NULL,	'Imagens_ico'),
(759,	4,	'caracteristicas_tipos',	'',	'img/zehimoveis_site/4_caracteristicas_tipos_8869.png',	NULL,	'Imagens_ico'),
(760,	4,	'imoveis',	'',	'img/zehimoveis_site/4_imoveis_11176.jpg',	NULL,	'Planta_baixa_ico'),
(761,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_7314.jpg',	NULL,	'Imagens_ico'),
(762,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_1687.jpg',	NULL,	'Imagens_ico'),
(763,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_8103.jpg',	NULL,	'Imagens_ico'),
(764,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_1390.jpg',	NULL,	'Imagens_ico'),
(765,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_1799.jpg',	NULL,	'Imagens_ico'),
(766,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_6103.jpg',	NULL,	'Imagens_ico'),
(767,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_13590.jpg',	NULL,	'Imagens_ico'),
(768,	1,	'empreendimentos',	'',	'img/zehimoveis_site/1_empreendimentos_6258.jpg',	NULL,	'Imagens_ico'),
(770,	2,	'empreendimentos',	'',	'img/zehimoveis_site/2_empreendimentos_9365.jpg',	NULL,	'Imagens_ico'),
(771,	2,	'empreendimentos',	'',	'img/zehimoveis_site/2_empreendimentos_6706.jpg',	NULL,	'Imagens_ico'),
(772,	2,	'empreendimentos',	'',	'img/zehimoveis_site/2_empreendimentos_4098.jpg',	NULL,	'Imagens_ico'),
(773,	2,	'empreendimentos',	'',	'img/zehimoveis_site/2_empreendimentos_9434.jpg',	NULL,	'Imagens_ico'),
(774,	2,	'empreendimentos',	'',	'img/zehimoveis_site/2_empreendimentos_6144.jpg',	NULL,	'Imagens_ico'),
(775,	2,	'empreendimentos',	'',	'img/zehimoveis_site/2_empreendimentos_12597.jpg',	NULL,	'Imagens_ico'),
(776,	8,	'imoveis',	'',	'img/zehimoveis_site/8_imoveis_3115.jpg',	NULL,	'Imagens_ico'),
(777,	8,	'imoveis',	'',	'img/zehimoveis_site/8_imoveis_6021.jpg',	NULL,	'Imagens_ico'),
(778,	8,	'imoveis',	'',	'img/zehimoveis_site/8_imoveis_11383.jpg',	NULL,	'Imagens_ico'),
(779,	8,	'imoveis',	'',	'img/zehimoveis_site/8_imoveis_12148.jpg',	NULL,	'Imagens_ico'),
(780,	8,	'imoveis',	'',	'img/zehimoveis_site/8_imoveis_2961.jpg',	NULL,	'Imagens_ico'),
(781,	8,	'imoveis',	'',	'img/zehimoveis_site/8_imoveis_12768.jpg',	NULL,	'Imagens_ico'),
(782,	7,	'imoveis',	'',	'img/zehimoveis_site/7_imoveis_3704.jpg',	NULL,	'Imagens_ico'),
(783,	7,	'imoveis',	'',	'img/zehimoveis_site/7_imoveis_3479.jpg',	NULL,	'Imagens_ico'),
(784,	7,	'imoveis',	'',	'img/zehimoveis_site/7_imoveis_10.jpg',	NULL,	'Imagens_ico'),
(785,	7,	'imoveis',	'',	'img/zehimoveis_site/7_imoveis_8324.jpg',	NULL,	'Imagens_ico'),
(786,	6,	'imoveis',	'',	'img/zehimoveis_site/6_imoveis_13613.jpg',	NULL,	'Imagens_ico'),
(787,	6,	'imoveis',	'',	'img/zehimoveis_site/6_imoveis_1898.jpg',	NULL,	'Imagens_ico'),
(788,	6,	'imoveis',	'',	'img/zehimoveis_site/6_imoveis_7033.jpg',	NULL,	'Imagens_ico'),
(789,	6,	'imoveis',	'',	'img/zehimoveis_site/6_imoveis_903.jpg',	NULL,	'Imagens_ico');

DROP TABLE IF EXISTS `imoveis`;
CREATE TABLE `imoveis` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_imovel_sel` varchar(100) NOT NULL,
  `Nome_tit` varchar(500) NOT NULL,
  `Nome_url` varchar(500) NOT NULL,
  `Descricao_curta_txa` longtext NOT NULL,
  `Descricao_txa` longtext NOT NULL,
  `Planta_baixa_ico` varchar(100) NOT NULL,
  `Imagens_ico` varchar(100) NOT NULL,
  `Videos_vid` varchar(100) NOT NULL,
  `Valor_txf` varchar(500) NOT NULL,
  `Endereco_txf` varchar(500) NOT NULL,
  `Bairro_txf` varchar(500) NOT NULL,
  `Cidade_txf` varchar(500) NOT NULL,
  `Estado_txf` varchar(500) NOT NULL,
  `Cep_txf` varchar(500) NOT NULL,
  `Mapa_txf` varchar(500) NOT NULL,
  `Mapa360_vin` varchar(500) NOT NULL,
  `Caracteristicas_vin` varchar(100) NOT NULL,
  `Adicionais_vin` varchar(100) NOT NULL,
  `Exibe_selecao_sel` varchar(100) NOT NULL,
  `Exibe_banner_sel` varchar(100) NOT NULL,
  `Ativo_sel` varchar(100) NOT NULL DEFAULT 'SIM',
  `Ordenacao_txf` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO `imoveis` (`Id_int`, `Tipo_imovel_sel`, `Nome_tit`, `Nome_url`, `Descricao_curta_txa`, `Descricao_txa`, `Planta_baixa_ico`, `Imagens_ico`, `Videos_vid`, `Valor_txf`, `Endereco_txf`, `Bairro_txf`, `Cidade_txf`, `Estado_txf`, `Cep_txf`, `Mapa_txf`, `Mapa360_vin`, `Caracteristicas_vin`, `Adicionais_vin`, `Exibe_selecao_sel`, `Exibe_banner_sel`, `Ativo_sel`, `Ordenacao_txf`) VALUES
(1,	'compra',	'Imovél Lorem ipsum dolor sit amet,',	'imovel-lorem-ipsum-dolor-sit-amet-',	'',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'750000.00',	'',	'',	'Lages',	'Santa Catarina',	'',	'',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'SIM',	'SIM',	'1'),
(2,	'compra',	'Imóvel Muito parecido com o anterior',	'imovel-muito-parecido-com-o-anterior',	'',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'1500000.00',	'',	'',	'Lages',	'Santa Catarina',	'',	'',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'SIM',	'SIM',	'1'),
(3,	'compra',	'Meu segundo Imóvel ',	'meu-segundo-imovel',	'',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'90000.00',	'',	'',	'Lages',	'Santa Catarina',	'',	'',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'',	'SIM',	'1'),
(4,	'compra',	'Imóvel A',	'imovel-a',	'<div>Apartamento C/ 2 quartos Centro Lages/ SC.</div><div>C/ 2 quartos, sala, cozinha, WC social, &aacute;rea de servi&ccedil;o, depend&ecirc;ncia de empregada com WC e garagem rotativa.</div>',	'<div>A casa fica a aproximadamente 2,5km (4min de carro) do centro de Canela. O espa&ccedil;o &eacute; maravilhoso por causa do ambiente r&uacute;stico e aconchegante e por causa da &aacute;rea externa, que tem uma natureza exuberante e vista para o vale. &Eacute; ideal para casais. A casa possui 01 dormit&oacute;rio com cama de casal, sala de estar com sof&aacute;/cama para duas pessoas e lareira ecol&oacute;gica, cozinha completa com fog&atilde;o campeiro, sala de jantar e banheiro.</div><div><br></div><div>O espa&ccedil;o</div><div>A casa fica em um bairro muito tranquilo e seguro, em uma regi&atilde;o que a fauna e a flora s&atilde;o especialmente preservadas. Tucanos, cotias, bugios e p&aacute;ssaros de todas cores costumam transitar pelo bairro que &eacute; repleto de nascentes, xaxins e &aacute;rvores centen&aacute;rias. O terreno possui 1.500m&sup2; de &aacute;rea preservada e um c&oacute;rrego com pequena cascata, onde o barulho de &aacute;gua corrente transmite paz e relaxamento.</div><div><br></div><div>Acesso do h&oacute;spede</div><div>A casa est&aacute; exclusivamente a disposi&ccedil;&atilde;o do h&oacute;spede.</div><div><br></div><div>Outras observa&ccedil;&otilde;es</div><div>A casa possui cadeirinha infantil para alimenta&ccedil;&atilde;o e ber&ccedil;o, tornando o espa&ccedil;o mais adequado para crian&ccedil;as.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'120000.00',	'R. Heitor Villa Lobos, 525',	'São Francisco',	'Lages',	'Santa Catarina',	'88506-400',	'!1m18!1m12!1m3!1d3656.1183301713286!2d-46.72009021912056!3d-23.60008882515584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce56c31b1fe649%3A0x7d134f4dfc6618c2!2sEst%C3%A1dio%20C%C3%ADcero%20Pompeu%20de%20Toledo!5e0!3m2!1spt-BR!2sbr!4v1604624571653!5m2!1spt-BR!2sbr',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'SIM',	'SIM',	'0'),
(6,	'aluguel',	'Imovél Lorem ipsum dolor sit amet,',	'imovel-lorem-ipsum-dolor-sit-amet-',	'',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'670.00',	'',	'',	'Lages',	'Santa Catarina',	'',	'',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'SIM',	'SIM',	'1'),
(7,	'aluguel',	'Imóvel Muito parecido com o anterior',	'imovel-muito-parecido-com-o-anterior',	'',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'1230.00',	'',	'',	'Lages',	'Santa Catarina',	'',	'',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'SIM',	'SIM',	'1'),
(8,	'aluguel',	'Meu segundo Imóvel ',	'meu-segundo-imovel',	'',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div>',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'950.00',	'R. Heitor Villa Lobos, 525',	'São Francisco',	'Lages',	'Santa Catarina',	'88506-400',	'',	'',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'',	'SIM',	'',	'SIM',	'1');

DROP TABLE IF EXISTS `labcloud_config`;
CREATE TABLE `labcloud_config` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_laboratorio_txf` varchar(100) NOT NULL,
  `Chave_api_txf` varchar(1000) NOT NULL,
  `Link_cadastro_txf` varchar(1000) NOT NULL,
  `Link_login_txf` varchar(1000) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `labcloud_config` (`Id_int`, `Id_laboratorio_txf`, `Chave_api_txf`, `Link_cadastro_txf`, `Link_login_txf`) VALUES
(1,	'26',	'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJJZF9pbnQiOiIxNCIsIkRhdGFfZGF0IjoxNTIzMzg3OTQ2fQ.2fGF4hxoP27HjSNRXXtvTZb0wy3L7hmxHaSDMNqXbtM',	'https://plataforma.labcloud.com.br/login/cadastro-clinica?labid=26',	'https://plataforma.labcloud.com.br/login/login_lab/diagnostico');

DROP TABLE IF EXISTS `leads`;
CREATE TABLE `leads` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo_txf` varchar(255) NOT NULL,
  `Nome_txf` varchar(255) NOT NULL COMMENT 'Nome do inscrito',
  `Email_txf` varchar(255) NOT NULL,
  `Origem_txf` varchar(255) NOT NULL,
  `Data_dat` date NOT NULL,
  `Data_hora_dat` datetime NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_usuario_con` int(11) NOT NULL DEFAULT '0',
  `Acao_txa` longtext COLLATE latin1_general_ci NOT NULL,
  `Tabela_con` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Data_dat` date NOT NULL DEFAULT '0000-00-00',
  `Hora_txf` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Nivel_txf` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='## painel  ##';

INSERT INTO `logs` (`Id_int`, `Id_usuario_con`, `Acao_txa`, `Tabela_con`, `Data_dat`, `Hora_txf`, `Nivel_txf`) VALUES
(8,	215,	'Novo registro Id_int = <b>698</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:36',	'5'),
(9,	215,	'Novo registro Id_int = <b>699</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:49',	'5'),
(10,	215,	'Novo registro Id_int = <b>700</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:48',	'5'),
(11,	215,	'Novo registro Id_int = <b>701</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:59',	'5'),
(12,	215,	'Novo registro Id_int = <b>702</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:06',	'5'),
(13,	215,	'Novo registro Id_int = <b>703</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:13',	'5'),
(14,	215,	'Novo registro Id_int = <b>704</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:20',	'5'),
(15,	215,	'Novo registro Id_int = <b>705</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:27',	'5'),
(16,	215,	'Novo registro Id_int = <b>706</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:35',	'5'),
(17,	215,	'Novo registro Id_int = <b>707</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:42',	'5'),
(18,	215,	'Novo registro Id_int = <b>708</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:50',	'5'),
(19,	215,	'Novo registro Id_int = <b>709</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:33',	'5'),
(20,	215,	'Novo registro Id_int = <b>710</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:40',	'5'),
(21,	215,	'Novo registro Id_int = <b>711</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:46',	'5'),
(22,	215,	'Novo registro Id_int = <b>712</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:53',	'5'),
(23,	215,	'Novo registro Id_int = <b>713</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:06',	'5'),
(24,	215,	'Novo registro Id_int = <b>714</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:14',	'5'),
(25,	215,	'Novo registro Id_int = <b>715</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'04:10:24',	'5'),
(26,	215,	'Novo registro Id_int = <b>716</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'05:10:03',	'5'),
(27,	215,	'Novo registro Id_int = <b>717</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-10-22',	'05:10:10',	'5'),
(28,	216,	'Novo registro Id_int = <b>59</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-01',	'18:11:25',	'5'),
(29,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Podemos te ajudar a encontrar sua nova casa</b> e o seu registro <b>Id_int = 59</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-01',	'18:11:22',	'5'),
(30,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Podemos te ajudar a encontrar sua <b>nova casa?</b></b> e o seu registro <b>Id_int = 59</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-01',	'18:11:32',	'5'),
(31,	216,	'Exclu&iacute;do o registro Id_int = <b>698</b> da tabela <b>imagens</b> ',	'imagens',	'2020-11-01',	'18:11:04',	'5'),
(32,	216,	'Novo registro Id_int = <b>718</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'18:11:18',	'5'),
(33,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Encontre empreendimentos, apartamentos e casas aqui!</b> e o seu registro <b>Id_int = 59</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-01',	'18:11:21',	'5'),
(34,	216,	'Novo registro Id_int = <b>62</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-01',	'18:11:47',	'5'),
(35,	216,	'Novo registro Id_int = <b>61</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-01',	'18:11:10',	'5'),
(36,	216,	'Novo registro Id_int = <b>62</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-01',	'18:11:15',	'5'),
(37,	216,	'Novo registro Id_int = <b>1</b> inserido na tabela imoveis</b>',	'imoveis',	'2020-11-01',	'18:11:19',	'5'),
(38,	216,	'Novo registro Id_int = <b>1</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'19:11:35',	'5'),
(39,	216,	'Deletado o dado estrangeiro com Id_int = <b>1</b> da tabela <b>caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'19:11:44',	'5'),
(40,	216,	'Novo registro Id_int = <b>2</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'19:11:54',	'5'),
(41,	216,	'Novo registro Id_int = <b>3</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'19:11:56',	'5'),
(42,	216,	'Efetuado UPDATE do campo <b>Descricao_txa</b> com o valor = <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div></b> e o seu registro <b>Id_int = 1</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-01',	'20:11:30',	'5'),
(43,	216,	'Novo registro Id_int = <b>719</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'20:11:05',	'5'),
(44,	216,	'Novo registro Id_int = <b>720</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'20:11:06',	'5'),
(45,	216,	'Novo registro Id_int = <b>721</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'20:11:06',	'5'),
(46,	216,	'Novo registro Id_int = <b>722</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'20:11:06',	'5'),
(47,	216,	'Novo registro Id_int = <b>63</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-01',	'20:11:53',	'5'),
(48,	216,	'Deletado o dado estrangeiro com Id_int = <b>2</b> da tabela <b>caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'20:11:08',	'5'),
(49,	216,	'Deletado o dado estrangeiro com Id_int = <b>3</b> da tabela <b>caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'20:11:09',	'5'),
(50,	216,	'Novo registro Id_int = <b>4</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'20:11:17',	'5'),
(51,	216,	'Novo registro Id_int = <b>5</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'20:11:23',	'5'),
(52,	216,	'Novo registro Id_int = <b>723</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'20:11:41',	'5'),
(53,	216,	'Novo registro Id_int = <b>724</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'20:11:53',	'5'),
(54,	216,	'Novo registro Id_int = <b>63</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-01',	'20:11:21',	'5'),
(55,	216,	'Novo registro Id_int = <b>64</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-01',	'20:11:26',	'5'),
(56,	216,	'Efetuado UPDATE do campo <b>Exibe_selecao_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-01',	'20:11:28',	'5'),
(57,	216,	'Efetuado UPDATE do campo <b>Exibe_selecao_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 3</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-01',	'20:11:32',	'5'),
(58,	216,	'Efetuado UPDATE do campo <b>Exibe_selecao_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 2</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-01',	'20:11:36',	'5'),
(59,	216,	'Efetuado UPDATE do campo <b>Exibe_selecao_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 1</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-01',	'20:11:39',	'5'),
(60,	216,	'Novo registro Id_int = <b>60</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-01',	'21:11:18',	'5'),
(61,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Inspire-se com a nossa sele&ccedil;&atilde;o</b> e o seu registro <b>Id_int = 60</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-01',	'21:11:29',	'5'),
(62,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Confira as oportunidades apaixonantes que separamos para voc&ecirc;</b> e o seu registro <b>Id_int = 60</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-01',	'21:11:38',	'5'),
(63,	216,	'Novo registro Id_int = <b>3</b> inserido na tabela caracteristicas_tipos</b>',	'caracteristicas_tipos',	'2020-11-01',	'22:11:49',	'5'),
(64,	216,	'Novo registro Id_int = <b>725</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-01',	'22:11:30',	'5'),
(65,	216,	'Novo registro Id_int = <b>6</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'22:11:50',	'5'),
(66,	216,	'Novo registro Id_int = <b>7</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-01',	'22:11:58',	'5'),
(67,	216,	'Novo registro Id_int = <b>64</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-01',	'22:11:59',	'5'),
(68,	216,	'Novo registro Id_int = <b>61</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-02',	'00:11:31',	'5'),
(69,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Confira as principais op&ccedil;&otilde;es investimentos para voc&ecirc;!</b> e o seu registro <b>Id_int = 61</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-02',	'00:11:42',	'5'),
(70,	216,	'Novo registro Id_int = <b>726</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'16:11:59',	'5'),
(71,	216,	'Novo registro Id_int = <b>65</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'16:11:49',	'5'),
(72,	216,	'Novo registro Id_int = <b>66</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'16:11:54',	'5'),
(73,	216,	'Novo registro Id_int = <b>67</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'16:11:04',	'5'),
(74,	216,	'Novo registro Id_int = <b>68</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'16:11:08',	'5'),
(75,	216,	'Novo registro Id_int = <b>2</b> inserido na tabela empreendimentos</b>',	'empreendimentos',	'2020-11-02',	'16:11:11',	'5'),
(76,	216,	'Efetuado UPDATE do campo <b>Ativo_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 2</b> da tabela <b>empreendimentos</b>',	'empreendimentos',	'2020-11-02',	'17:11:49',	'5'),
(77,	216,	'Efetuado UPDATE do campo <b>Descricao_curta_txa</b> com o valor = <b>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</b> e o seu registro <b>Id_int = 2</b> da tabela <b>empreendimentos</b>',	'empreendimentos',	'2020-11-02',	'17:11:02',	'5'),
(78,	216,	'Efetuado UPDATE do campo <b>Descricao_longa_txa</b> com o valor = <b>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</b> e o seu registro <b>Id_int = 2</b> da tabela <b>empreendimentos</b>',	'empreendimentos',	'2020-11-02',	'17:11:05',	'5'),
(79,	216,	'Novo registro Id_int = <b>8</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-02',	'20:11:35',	'5'),
(80,	216,	'Deletado o dado estrangeiro com Id_int = <b>8</b> da tabela <b>caracteristicas</b>',	'caracteristicas',	'2020-11-02',	'20:11:39',	'5'),
(81,	216,	'Novo registro Id_int = <b>65</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-02',	'20:11:58',	'5'),
(82,	216,	'Novo registro Id_int = <b>66</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-02',	'20:11:15',	'5'),
(83,	216,	'Novo registro Id_int = <b>67</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-02',	'20:11:32',	'5'),
(84,	216,	'Novo registro Id_int = <b>727</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'21:11:30',	'5'),
(85,	216,	'Novo registro Id_int = <b>728</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'21:11:30',	'5'),
(86,	216,	'Exclu&iacute;do o registro Id_int = <b>727</b> da tabela <b>imagens</b> ',	'imagens',	'2020-11-02',	'21:11:57',	'5'),
(87,	216,	'Novo registro Id_int = <b>729</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'21:11:04',	'5'),
(88,	216,	'O campo Id_int da tabela imagens foi atualizado. Id_antigo: 728 Id_novo: img/zehimoveis_site/1_sobre_mim_1508.png',	'imagens',	'2020-11-02',	'21:11:10',	'5'),
(89,	216,	'O campo Id_int da tabela imagens foi atualizado. Id_antigo: 729 Id_novo: img/zehimoveis_site/1_sobre_mim_9392.png',	'imagens',	'2020-11-02',	'21:11:10',	'5'),
(90,	216,	'Exclu&iacute;do o registro Id_int = <b>729</b> da tabela <b>imagens</b> ',	'imagens',	'2020-11-02',	'21:11:13',	'5'),
(91,	216,	'Novo registro Id_int = <b>730</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'21:11:18',	'5'),
(92,	216,	'Exclu&iacute;do o registro Id_int = <b>730</b> da tabela <b>imagens</b> ',	'imagens',	'2020-11-02',	'21:11:00',	'5'),
(93,	216,	'Novo registro Id_int = <b>731</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'21:11:07',	'5'),
(94,	216,	'Novo registro Id_int = <b>69</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'22:11:03',	'5'),
(95,	216,	'Novo registro Id_int = <b>70</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'22:11:07',	'5'),
(96,	216,	'Novo registro Id_int = <b>1</b> inserido na tabela sobre_carreira</b>',	'sobre_carreira',	'2020-11-02',	'22:11:09',	'5'),
(97,	216,	'Efetuado UPDATE do campo <b>Texto_txa</b> com o valor = <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Justo vitae congue consequat auctor ullamcorper lectus mollis diam mattis.<div><br></div><div>Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.</div></b> e o seu registro <b>Id_int = 1</b> da tabela <b>sobre_carreira</b>',	'sobre_carreira',	'2020-11-02',	'22:11:32',	'5'),
(98,	216,	'Novo registro Id_int = <b>732</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'22:11:32',	'5'),
(99,	216,	'Novo registro Id_int = <b>71</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'22:11:09',	'5'),
(100,	216,	'Novo registro Id_int = <b>72</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-02',	'22:11:13',	'5'),
(101,	216,	'Novo registro Id_int = <b>1</b> inserido na tabela sobre_referencia</b>',	'sobre_referencia',	'2020-11-02',	'22:11:16',	'5'),
(102,	216,	'Efetuado UPDATE do campo <b>Texto_txa</b> com o valor = <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Justo vitae congue consequat auctor ullamcorper lectus mollis diam mattis. Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.&nbsp;\r\n<div><br></div><div>Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.</div></b> e o seu registro <b>Id_int = 1</b> da tabela <b>sobre_referencia</b>',	'sobre_referencia',	'2020-11-02',	'22:11:35',	'5'),
(103,	216,	'Novo registro Id_int = <b>733</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'22:11:33',	'5'),
(104,	216,	'Exclu&iacute;do o registro Id_int = <b>733</b> da tabela <b>imagens</b> ',	'imagens',	'2020-11-02',	'22:11:03',	'5'),
(105,	216,	'Novo registro Id_int = <b>734</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'22:11:09',	'5'),
(106,	216,	'Novo registro Id_int = <b>62</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-02',	'22:11:42',	'5'),
(107,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b><!--(figmeta)eyJmaWxlS2V5IjoiT0d3Q2c5b1RKSU9lRlNvRDQwZUZYbiIsInBhc3RlSUQiOi0xLCJkYXRhVHlwZSI6InNjZW5lIn0K(/figmeta)--><!--(figma)ZmlnLWtpd2kDAAAAMx8AALV7a5QkyVVeRFZVP6ZnZmcfeiKEEEIIAWJ2drW7EkIoOyurK6erKnMzs6pnFqFSdlV2d+5UVxWV1T3TixBCll+YN0LYwshCxiAEFu+nhXgYG4zFWxYGZCyEwNjmdTgcDj/4wfdF5KumR/rHnrMd9964eePGjRs3btyoeYvsxmkaHcbh2TwW4vJ11+kNg9D0Q4H/em7THlpts7djB0BlP7D9Cm4obrvXBFwLnJ2e2QFUD8KbHRtAQwHDwKasNcWrJA+DXccb+nbHNfnles8NndbNYdB2+53msO/t+GaT329k4LDp9ohv5rhvt3w7aIN0IbDsnj0E2WsPn+zb/k0Qt6pE3/Y6JF5sOq0W2kvmnSSF6jcAC3ZIczSCCUDybbM5dHuKXShkz3dCjix7s3HsHUVpDDYLXaFNzcHUdQcKlHvJdJxMD/2TCXl6bu8p23fRIdym6qcEbeP70WmDJJqu1e/aPVpHWmZvYAaAjB3f7XsAai3f7JKvvu26HdvsDV3P9s3QcXsgNga2Fbo+oDXaFO16x1FiN+xOx/ECgps+mLBYajUu+PZOv2P6Q8/t3NxRQrYwVK9pN2Gkku9iaN+gSpeCjmORcDm42d12ubL3OT0M1lPUK9uTeDruYlZCPOiZQTAM2xC3w1WB3/hd5Quyafq7Nscyuv1O6Oi1qFFVaLLd99lVt9yOW2CNjrPTDtU3awFsrSA1OXzRdJs7NvAN/UmObmIV/I5J2RcCtxUOlQxgW23TbxaY8gHbt/UMLtk3rE4/0Pa83O6Tdl9ghv3CyFfUKADu7/S7Ts8NnJBDPOBFyXSpF3M9cDsOF1jA3ZoOVhOjUVVQZEFiq+yB1QVIEszN1QCtVtDA1HXVbqo7XVPNrAEPu+4AWHOOsUuDUTSJtdGxzXw7tJS9Ww6nJ1tORw0SOmola/bBQTzKFK07vR42b9A2m+4eOkXTd70SlS0X/oEF7DWH250+9TK2TWt3lVQL4ztLS22DNdd3dhy940Xfg2uilR13TwFQIdQ6BHCEztAyPTp3vcSGLde31NZpUGgzHs0W0TKZTfFNvkEwMpYV5gQsMV1n1y6dzOidHO/Hi/40Wab4xjc5DeE5N+xOAEBCI4QB2sWwZtN0uagsGhYTdMF+pa7smowHBsbITFoLLFNNoN6CxOZQf9HIEMW9FiwXs1uxOUkOp/igECawSxwVwKTbDzPQ0MxWNIeUfH6YilptGTzZN32SDNP33T3lQpxETaP2k32ng5jjK2vXtajrs4TDdhGh1Kjb9sBmt8ylGtuz2SSOpu48zi1b7/e0Z0NHfBZg2wOWQX879E0FGzeUw6uFVjNrzxbJM7PpMprg847dIlPFcHACtbWM6/0AUdxRK1p+PYgXywQ+S5rroavy6bYbhm4XkNGdnaSxdbJIZwssTtNumYgV6BCW7wZwUccHLO2bNn0W6wrMwCGkhvJMTAWxw4JvAK97Kl400FhOB9DaAFtgtugmiwWlF76F/afWVyoA2xFhwu7thFx8oxmlR3qXGRaCKUiidA2pdqL2pLrX2wFJXPdstjIYsDG8Jo+amn1nPlss7/a+muXCBFA6dzGRE/acphpf5oS2nZu3E53NTpY7i2SshdS1Q1bMWSpoaP+sld940XIZL6boApfjKd9CwFKBS6rFOlnO/DhNnoHowkRKHWWZQg9ZQHDos0kcxNmkYHA/cLNwENom11Va8Am9wjivcTr3LIbPWmh3Pdc31VkNZ9ZiYKVlXJjoXFQFKPOYiKGj0S29PoWybcSjp2A2pYHEcRA6MC9gza28EeznzKZtpZms2QmUWGS8jU/KW1i6ZvZDHvKYBT6/fpIuk4MzoJ/0S8+07CE2qk4yauqzQFndUKEFRCQVgfOUPQzdYRbWYZopnBg7WFuniB/wfNuHzYfM04DLvq9mvI3AjbZmdVyVB9QdTiuqiLjo9obwbMUmzBbEDEOnayNeAZddF4neUM3B0LDuqOGrNo9awHXdgdODbA2NqcRlDVweJkEnQ26nVN1o+iZ3xib6du2b+WcXgA5cnWZshYtomialjs9HHEW2EQ4RmxBRszNZNJ0A3jGwAcoWskG0BlIVpIUt3+1iE6sQVauQ8hhVr9B0NGpUKEU4WvP6QVvTMmHrJSWXtVGStKjNklBIusDsUNMySVslJZd0sSRpSZdKQiHpslYUywCmXNh9K8Rc3pUVqhZ5/wqtkPqAGimjZkIfrNJymQ9ViVrks6qkQuKzsUUda8g+YM/BcY903+xh56o8+rlI6FwkACXleXaUIm3WK76BG4LV33YsdAiKzhGJ5KuCGjwfde6EL+jtRVedfCuUhv52hbamI1OBrwejxWwyaSYLvc8gJ3PcTxFXMGkVA/S32KRLbrF4jE29jNFv3/AQO/WetiCBJ6zC5E4fwU0aKa4dGAzwupCTGY5JBSJdmeCokvWF2BTyEH+MffypRfhT16cZPr4DTJ7hj+GDBO6ScBt/akf4U1eSguVsjg9GhEUo5HymdxkYjG60XCR3hFw7vnoVuDy++jAa4/jqNTS144dJrB8/TGLj+GES17xogTjtTMcxvjMOT5Kx8CtCt/LEDJ2n0eQkxjfyRCVpzxVGC1bqRcexkLWD6DiZnIFfpjwCABgQskxHi2S+BFYj7yBaJBE+OTmOF8molRyeLGBaBP3sfiHgCY46gqXbaar7JmA1zOqnwTwawc9WvvWQTbhYz+zYkqG5naXk9xDQ4uJyglUJSNhxk1Iwzl94mFrf6tdWNE/hX+Un2BIqSZdohjlieDYSZqpeA2FYYMzXLFPF8AZImOwOwLWKfC+3e1Ut5HP4i7QOhzIApU+gjIzFKbgc+LTyfokMUcXcVhwtlYH/WHrI0dElrGueYsm0MCwvIL1GbdAqBdE2stvuWuD0mPqsu36zh3bDbPns32z2VHy40Ot3qdIWrmQm2os4hDilS03dXm7r9j6k/WyvmKbKBO+3dPuAb6n2wUDjD/kDdWl8Fjcm2mcHe6ou8Bwr2GP7XCwO6c+zrC71fn6gD+5PazsB6S/gUYv2012/R/1eSKOg/QwcOVzKFzVDdZv4zFbH5Dxe3N3xeWZ+VgBfQ/uSXRzAaD+7hWQJ7Uvbuv2cth73ZaHGP/dJ3b7c0+3nMV1G+/md1jbxL3A91b7CD1X7hZ7+/qq326OdHu4gfKC9hpZ6PuKHHeKPoiX+SnPbH6B9zNweEH8cLfV+YqDlvGoAhdC+eruzx/X5IrTkew1a8n2xudvmPF5rXVfXgC+xWmojvM7yFG5afZ982zh9iVsIbmybLS3fbuEqiLaF9hraHbSPoG1jWI7noKX86209H4y2Q306bfc6/QYJk8p1eg7OdrTude/xJ9B6170nKOfJ696rrqL1r3tXH0UbdK53+V3YcS3y93HQcF0GXbvJ2/IeWupxo7vbJf1mr6Nynad6/d0Q7ZciQaFer0cboP2yAQyO9g1eEJI+REv6G/1dn3jke222+35/m+s+Croe+ceh1iMOeyrlPcAycf0OB6gjoD0a6P5koOf99GBX+cutgR/6aCdor6E9DgJEXiGmaInP0D6Cdo72UbRfjvaVaBdoH0Obon0c7RIt7XSC9lVoT4MAMVuI22gp7w5ayjtDS3nPoKW8r0BLeW9CS3lfiZby3oyW8r4KLeW9RQbBNQr8amkNlIZvJUCR/4QAZb6NAIX+UwKU+s8IUOw/J0C5/4IABf9LApT8NQCUqv+KACV/LQFK/joClPz1BCj5GwhQ8jcSoORvIkDJ30yAkr+FACW/HYDS+VsJUPI7CFDytxGg5H9NgJL/DQFKficBSv52ApT8bwlQ8ncQoOR3AXiEkv8dAUp+NwFK/k4ClPweApT87wlQ8ncRoOT/QICSv5sAJX8PAUp+L4BHKfl7CVDy+whQ8vcRoOTvJ0DJ/5EAJb+fACX/AAFK/kEClPxDBCj5hwG8kpJ/hAAl/ygBSv4xApT84wQo+ScIUPJPEqDknyJAyT9NgJL/EwFK/gCAxyj5ZwhQ8gcJUPLPEqDknyNAyT9PgJJ/gQAl/2cClPyLBCj5vxCg5P8K4HFK/iUClPzLBCj5vxGg5F8hQMn/nQAlf4gAJf8qAUr+NQKU/OsEKPk3ADxByb9JgJJ/iwAl/zYBSv4wAUr+HwQo+SMEKPl3CFDy/yRAyb9LgJJ/D4AKUb9PgJI/SoCS/xcBSv4DApT8vwlQ8scIUPIfEqDkjxOg5D8iQMmfkHfXEZBaLXFci6tC5imWwZyyG83nTHKkcbCYHTMtW87w19iezPaFlPtnyzgVNakLGMKooaB9RHzKjAz51zhaRop3HdlXMsGd0WLSaI6fxs1WyI0lx0Y6lx5F49ntFKBxlBwe4bp8hPQOCeM4XkbJBFA9hsopcwkkjqe4TscoQABeW8bHqhylu9ZPk33c+kaEN1RVVQ+bvUkI48I/7pAjJEaLCHPbFJv7C8qcYmRgF5Qywrhf2fmykCMaAtmzMWMiuWSeXTtN0mQfSZUUdTRZMfyiaKRIuFPxlFyD7Gl6MFsci9eL9UQZ/Y7YUEB4hCR5Ss2Rt0dT0HBzcNgDwhVNQFqHrBNLsy7uB16t/l4RFxYz3DPAAk22UnYAuHigzGdR2WzVnhGX5pxLS/WIN4nL8fHs6cSCFA8VRBhxXd7HBLELQzbhAMJo3IrPBBzmANROMo3bMS0D8QYpzeQwhtwaMnhgOq2cijqRPc3YQLKKmpIWtjU6ipg6x4sULiYLTH3oNDm8kRJ2T+MFSlVxGMGYCAGyNlH1K1UeGcDEKDtPoE2K40U2Didn86MU54pcGxel4xSnilzXnw0wIEiw3QZVK2b3Fik3D6LJZB+VlxY6UrEvLxxhlRcQfmt7dgcDvE3KrXaFJIz6PkpD41TcwF1mMcFE8otP7SjnQ17XwFtNpqUw1uGNOjUfCHk7GS95IzPYdxNAjUBh2DoxMx3hYgVs/SBZpEsrtxSm0IB3VfG1HU5fGGuj2fFxBMWyXVtewwZCWxVaYTMfYKLKjhjqvPBofJptiLVmYUthGAtcLDFlKUtJhr5/KksatVOF9OLl7dniVq7CFP4eTTDYWI2YK3J+eRmxUJjENCSNmQpfyuDseH82ycSnCsG4CGQazoWkFGDgVsnNFdD5W5gNNigMm4vNg6FhqIWSc9CQUaBYhLlDOSXQjw9iXGcxeWPzIJnEu/B8eGmqOtXIBoakI7UjxErcSqmqB1GZ+BQJiKznkbUxSRBcFmfUIZwFJ/u8ze6DjQSxlFyv+WyKZdYDrZ9MDyaszU7BU5W4kaT9vCseI8Jsaq2t/PtulGL1MkONcqqWKucn+5MkPYIwjkttw1kYR8edUjsOYtw9SPZgBN9VYe8BUQl7BwdpvMRq1hbRODlhjKyX8a+Bpoh/a+l8EUdjcKyHDIDKIZ3pwQxLoeReF3J8knkZtoSHSDZjRzM+TUZ5YT2vvzBBV5V9aeHKpC6RhqKhJMOrO/Ca/tDPAyIvufpjy9obqkNZ3jUIdjQR5HhY7MxNoTWm6Ixhx+QgwdbAauMrLfNdCPL0PgQXL9tjIQXgJRKaqGu2QGEsr6JJwkWPQSyvpdVQN8I8cs56hhbMjYyQ8691zV5fXU7WMwW2EboOFwxITlnXxSjFrFn2xUO2rvCyRpc9QslzAvQcii9x+XKaw/zV8zy7OZ/HCBxqvxj7BVlJ+W6YsiRZueP0IpzFyoaKC8Vrc4C7vypvCJQJs2dbGeypgoPBlj8TUAx4hVP1Ql1kt3HAL5YBznV4diqMjfTk4ADVK3i8Oh7VAK8QqHQVidJC1NLTQ26THg9SLCJQJEr01PfDb4G5J0tGX55Y6McOhU1xLLhTFKekWAdHa7YYxYF6dMO2u5WCvJHpMtjJhAnDaQ17tp3V+8zOnnkzACA76jTiIwxCzJIaXhMy4m8QDMSWYgfVpifHAfYe7JQKnCPZfkMqk2pqQC9FhD48wXZdZNj6KDPzxpy7GC88j4rNHUQorE8tG0QWooozy0NEwALeTsqfLGwI7PWVswRPIgjbITVm/Uo7SPbCjGKX7+6SYmS/FqjZeFlXpYI6SgOoqgFqZC9Mazp2KXmVgKvPhSxkwdMqUTaP0WSAyTEzLiHmlJKSfYLXwrL8hW/K+J2VZLfjIzgf7AN5yo+4IJgC3lmGe20b+6PtdJpDt4WXOHajuoayu/7RhTQXo2LMCI+Y00NzeghDIRdFqKugRoLXmYWfR8VaoM6ODjICfHuySKCPHCfpfBKdKR/cQp6tUeVy0NabnBwm02y0uUJgN3ymk3t8cEtPy1N9fjyJTqajo3t8cIzsFRsBIDaBWk2ANf70BAf+FB3GX6qzFk6g2jA6xEq/cn6ErEWsCUMBmvjYHCuQ13nfIGoVVDM8vqRrXBAqkGrSE9NITbDBVpNeVbr4Wgbqjlej4H1LnTrrGtLkLyrz640M1B2vwZfFEbNZILrzi0eIOUsAFxSgia9NuUkGyI7RatKXICwUGfnFAtGdrxvD+bA14G04l+SlCqoZzEi9knJyUPtyienu7TL62VNmOZzcfeeImtk6RiRB/xW2mtSMVUyxVgPQ/eepmt3ml07q6vAFzgdWCJqpVQ7vamvCsA+eI2rmHeR+VVd+qIprlnYlk3xWDusuBx4SHS6i+RGdBKuxKZ59F0kzXi+oeVF+Uzznbppm3eXec7i/VJIHxueuUjRb5zjBKnUSNGB5HpoM093dVMXu7HayKZ5fxTVLb4m9GOIovYWxwfJpVVyzuEfFLyGwGBChDpjnixfci64/8YBhIBO31al4gfj0CqoZntQUK5qLF4oXFoju9DWufufxIvEZJaa7A6qoZLULBcRLxIvuQdYfhEXPIP9VxkvFZ54jauY+6RaigXhIvDiHddeAaOWi8GzxWasUzba3f/fPT14sXnI3TbPeOM3GLg0Iw372eapmv4lIP/GIp+LN8qUlprufAjMspUlg+Jwqrlm+lDsku329UbysxHT36+nZPWxs3II/N4d115epqTLyvlWKl+eI7ntDrNLnFNVF+XkZrHuGiL5jHGXqRyjwKPFy8fl3kTTjG/VuD/Ic5/ul/IJVkuaLOLKpAlCKHSgeE69YpWi2fZwyM519pKgNyi+s4JpjpO9wnAQKsOJqier+sTpxcbqsi4czUHfEZRCxsiTk2l0kzXjA9dmJZ8fxcnGG4qN8pErQPId6iXIiuR5dJWm+I+z+7JcfrxFJgejOpxWexQ/s4VtVXLNMFMmLxjzAwXJcxTXLlOciwr66K85yRPfNU3W20zqoRIsvL1HdvzhguaaLMNxMUhXsEZbTc0TNvFzohZq1ELWkQHWqQDXDqV74bWiojZp/D+7bSnELVIQ6tX3F68QdRbyOqg9/hbItzlKdRSkty8Tr7VI8k6Sa6umbIsVC6lcAKj6oXkffNMYT6GnewwnzAv6VVfaBTuBw+r+ZOyZ7nrSQhcymHd4AOEGM8VUrvVD/zvIkQrpUcrxFFZ4yFsx5tIgZKnBxrXJ9dZWrDV/ALkKsqLK8tcriLrDGCHkSDxcVcjDBKR+Pn4oXM3S9rdrVyx5+9aPzGM8b5zsz7xIHKEqd723hAKHq4ggvIZVuhPhUPI3iVYVWZLITvJHQ7TCFH5byayQiX3aHZh6HnejjyWSOi6m6zgY4DpdFx9eWHaXbqL2I7fl1EgEQyUw0YRKB2X69nJ2qegrOZr2ISsg3ZOWPZgzT4y0eI2NVv1GyHIQkEofubN6JD7B6ZXaAvfRNKww+o+ldHN9ccmzPlsvZ8T2kfMvdPPcS9PaSqexJmGPgIRuT4X761rt5Qhw9qyzvoLW4xTDDFL6IiBPhJOD++japfRv+qysr2L+wnfL8d0gEeLBmq6IqG++UeEkqaSEWAGWOd1ZIzbLi8e0yjoofvXRQg4CdcV0pf33SwwPTSCkdHM9mSxZy8Nm7ZTI9gluxlDsJdCzGcr0rJwcqYJYd78k7Quyxkvw9OdlW4aXseG/RoY6usuN78w6eGyX5fTm5ok+LPzehGuj/KZmkRRds+h3AdWdO+U6ZElJ2+HGJFzOFrvrdz8qTvEYFM1SD0nfJCc5E2Cjbg2/EAxu+hCVdfeMdoCYBB8/C0vdlSxpwjMpy/rTEKVvpKgPlT0o8tSXpaox8v4yV3WhUM0UBgADoPwDOYHaANAhaZaJA/kGQe7Npfz7GkZ2J+KFMTbgc/GOkuNErPGz4UUnDaYAp/IhEiQOOeJRMxlCrmZwiNLA29aMV5/IQ8OLFKR4IKBdD/BgFTbGK6FTmbcHAJYm/E9wSP0H/19Eiq4q9W2LSqRJSXJ4/IGEiFTmgFr4NwS7aeAYshw+T4xhpBXz0A1XObgQE/6sd9TMSSN5T2QwflOMYB9ZU4bi9YMGQpOCDn6tUk3Tuhlzu5+U9fW674ITf/YKMsrv7ByVeGWGt1aOro3KgQeYYDbw/TjFTHBtA1eTeJ/EUOTtViuRhWXW8R+LYyzp4C19CcM6ApfqlvK9UxynnjHdgPGOe4zDLktp7JZ431ZGQ6baFV84l3KuPxe2saL2OZ0998eeMMGX5Ibz1HSLYjd2pG7b0D3lSMZe/WtAPDlY6fq2ygMHR7GQyDo5xlpjq6Ylu+usyZT6hs4vX4ulUoeWtIkubsIa/qbugnMrXy47f0h176vWjKX5bozrVBv5hZQ4EFVW38fHgOtd7DavLOsJHclzFm9+BA2fRmOxbeIRNUusaNP3dnC8eDzIDbeFBVhuIC1WUS35Ryt+HGKgPt1wEJ3Nu5SxKMTKZPC4ZeJk/fFSrm2VZ2I+cVBPPuYWANJPwSQT8gSxeh6AsXn1vxWfhIjk8xAb+iBQfg/4Bd/4OPGEO/j8sN2TFcVK8Y8uPy9MZdqh9itl7R3izpH3+CN6C0mT/kwTIT2j9vQVWdHFW6P/HK2S1vA7eSFNkjH+iu7IZV7peK/5P1sU4lH0KtflTwz/VPdmq+2ptN8X/XaHqsxzk/yfp6szWmFZvx5gAgg9CJiaKB6D/r79So6jhg3hygNT2z7KcpANTpggN8s/JmFnOwykO1zsbsFyGPI/G/2Up/0Jy73SQGqql/xUp/lIGn+IjVCTnGRG21cU3vFlKI6yKMfBWly7hkA0h908m0DzEcokPSRYCmVggKiDjjU/jCVjUMx+yQf4eElXd7fIDUXP9pu3rcnG/VyLS6TXxFgCofBmpeAMU0PU7jIAs5jcwru5IsdtkLUmVNVXIrRff24rXWEtKOSHICOOyQlqJ15hN0VEJ17VVF67fwysbZVwpD4a1QhdTiRTGpZKtyF8rISkEK1Ioo6RUtVhJoOolTzlgRYt7RjcW+rPTUIlpsZieU/T5uMHoNLlnqN88f2RcKAc8dxxvaX1biEPsR3XxInxqEWkGRGadrlzKLNvUp7Fo7No3t13Tp1vAR3Z77h6K1vwpMarV6rFI3th2b+CpxwZseMGjaGrBnhNa7aGnfpBZ3y3Xy2AdmQ//eGGQMLWiZmN9GCvexkx0sDIM/cqtLiJYF2OQxLcZ6OB9o2h6GqVMupCh4wDDC7GQc+QoE0z7FHyYr6HwZkx7sOJY0x/taGl19e99KEr/k5+XCan7ldDObKTsCnsYFTICgV4bvsffuFuiNUlGtwReNMc4GvEKDufl99q+xbpJY4rZgz/LcQrDG6E2Bk5JveRC1mYaykaQR7NlOp8tM9RIb0fzDK7d/bGOE42ZxjKuTyVgnu8Np9xzWV89+2wbwWiOOtHSGePeJhqwdYpNh7wGAQe2NPax+QJclWM+BWC4bPRUfAIPvWHhmuUlQxgt19/LnMu38RIX0IskLm8qenn4el/FYlyiMMLaDHtIDfYneOmbxrcLxDinY5M61gDlswEFc0nStuZ0pr349l1TwKTGhXJ/ig26qoDHpwl4N38o6uB1UKltbru+BqXldrtOqBFj9dPd+OyANRg+ligpf4YJwOaHUIDXSWOJqJEuo+M5kOztKDtH8cn+6qxywzoI9nfgbEaq+AtXwiONHlun/PADVBiWuVG1QjgFhTxPDmAH3G//AhbVQjMlUvFXiOxVJevKw5EUlnul0UfI0XKE8cDKPy3I4poO61MaAo9Co6wqUEdAPIx1wGtw+6pt/nuw/7HapR/FA02a7z2c0BuzfQx0CrXEutwcx4wePS3zAlYPC6r2YorkR27paeT7LxUfkxKvLqu7JRUfl/IShlpA2y1xWdkl58n8Bc5z3wrdu8eOwee+uLLMWXLxTe5GbIL758DKhUnFX0v5QACFkQ/g3eHJkxiFRz5K4pjA7HpZpEDBALkr1pkEbd+0Gy8jyIiEIffxWIr8MZ4wv6YHwN5dGB82FcZD1BD+KKvLYUAFBdSmpUTcK2SdNsjxv5GyoWSLU7mWIhGKJpmV16MREqhU1MVGygtQEKvyNHo2czzksE+ICzluIV/Fwijyq8XWHJbkedsQFxWYaY7zR6FIZrllIPCyHtiLziazaAzCfemKvRIo+rdSXqlMpDDN3+Hp6gCSBsjGMHXM9wEl3Uk9GjiaTM7ck2WajGN7OprAQ3A8qk0qxYOK0YMJEex88VAzOTiwjk54Lq1XhoL/Sb2f8XI51k+qPXTDlnBvdTyo7+sazozU0JiTKs/B7DDg2ojSU1PVPaBIeISLBUkYYp2j5xYw6lMMkI+PNdPrjzWCApmSqfh77Fai2zj0FVf9HwBDCQAATVcJfM1XFr73f9972USQRK1J7EsaSyjBu/eKtdMamppRBi0jQZRES1rtRCQiEdTY91pqbVpiJ2aiJbS2UKJjqamalmprrXVsY853nqR9Py/f9+4595xzzz333EtKRyjhUlIIR7iku0vqkLRRSSljhUf6TxBCBIhKoooQUrCeqCNcjvuVwcOSolr+plEBQB+GEIkJoeCxGSVHjpR9MfAuGcqXj7rAlCRTwe6eqWPGpEb9KXlUEpnzE88MBuUJ4ZokxE2f5alixR42Pk3cnBssKrKHcJJnVs+i0RoQ1Xw/vKB7LVHbiRCRIoribCAaSimc9MWLFqV/kp+fXnriBPQU/tA6pWgkGk8oKekhmiSkJQ95c8zglETRKXVkoij/GcM/m8rfxegqC8xNtgnznNzV4+5Q/ojf9KM/mW7hCaR/5JnlPhFGM64mjBNSOpPOqCAaKpdIT0ab19tTep1JBZMv01C5xPGMHzHrGiQ5xdtfpKFyiXomkU5OwbqlNFQucT2zppzckjtuGiqXuD3jXy2MENLl5Ba7a9NQucTjyQjL7iik28kt7PZnGiqX+HnSH/b+QUiPk1sQOZyGyiX+nozESmeE9KMEHCyioXJJgCdj/93Gwj8gQMryVPoyKxxKfkcVdnvD7sSHi68kn9dv9HwuPuV6iwXx/3MJ938DhXheNHMmyEwps6SYKEU2ZVmKHClypZgsRZ4UU6RYIMUy+ZQ+IfR9GrJO1l8VugYThHNYiiPSOSrFMfrl8T/hCHmibk3bulUrqzZ2r8NkV0QDu6JGc6v23W1sg51oC2zxbX3rgNQ/955mSZMBIbr2X+rb+Z2neanwoyzVjajctzqjmlkcziQkpopNrZLdQT13tqLdPTbUe6FXME9xVo/W5sDL9w2TToOStAJJraL0axVjCLO9qtmW2oZsiLnVXIzKBJ7WhOJqQqFmDSpeIkoDYcMBmTivnmXJW7qpzRxRpP++oBmW9x+N5c3vHGSA6vPlNZjQYszj/JZWXU2IM19EtbDX061JnhVjnT4Vg21p3f6GCTKgQJCSwZcq+XJ050kYJ60si2KDErJfuzDbflueUSCwFuwE2VGXH2m197C0M4vT9IPeP5ijJSVeNXHePhN0ul5RzeZLGVWXaSOZIAmsUVr3nMaUMcNnabaBxMMokL2APM7fbKCRe+WE4Sl1N90ysHHyj45lo5E5QRZegOwWBHGwBgLDFETKNhA6jALhRchg54oBUyB7D39kpsZfMOPtdqOqu06ZHm0PmbnV9pvj908aVWfTFtO78LyBP6AKL5jMJDLnTZ9G+20v8hTKmc8GnT02CmQvIEkd3mAN7AxPGTO8Mtv45th9zUYpRRpegOwWBHGwBgLDFETKNhA6jALhRZx3CUkVoX96lK8VzfUOnFGsgR+MvOwbcPepaAZfekV/uD/KqF0ROaTahHZoFSOV9TEmM4vv6ujJVQ3VXXUqnmuauoyBUN1rPICqapM+8lEOo0qetcGs7LpDA79/P8zwQEhMrHn3s+Umbkq8UQtTZsMlr3Rq/CCjqCrNmVWjzVs60IRmZxo1ac9h3vvdY+fovKqLjMoc4aU48g3wfP0vfQPIuF/WPH1m1U1fpHFTpIXLYUM9Vg2c0Yk8BKEeGamW5zJZUWOjubmONLBBKIwhlc6Qe7IBg5vf/om3suMLtK8gC1NKzZ0nXxuKyahbpUfNrogvzNol+xlV5b67mITEbDH//EOJod7xsUmYftpsqLXYZ+PjL6eZFt9eNHU3vc2o6KQxAbbfdtA3sHr0bi4FypxRyNLWpRuNCXyNIv4UKRxllt1YRzFMpXpeadSwoWvN58sXm6dfF1KAs42a3/kIpW+qwVrgiYxe5CQDsWk8gCShaKi5aKWiD1BjuuSFJ7QulTZnIe18vSJq44xIMpOXKji04i5eOoozNMoJX9oOTe+CSdRj99315+6gvN+FMMGp4v6RNqcaNxQguikPUN9jDQrLNwXdFDaATtyUvVRuzwi3YxA0gW+O7TTorepvYQXcMFFRBEJRa2DSqGWeT2Pn7fE8BQgbDghbbfP6P6jfhFuFHICEZnfU9c5RJFTj3p23a1MUd71rl1CsIAgeGrwaHA8sDzaAdGP4Fi4OURZWdm3DvhQInGNfORrKLof3JP9X7u+U2CIm6OKsQRusMQUIGw4IGhZLSJOStYjuI5flufALY0C2DgJ3rAH/mAKEDQcEVoXcuvQGXSa0WOweyIVe0/WEEbVwfwzWSR0iLXDY0IbWAZnfOdonWZgSSzfiDD3evmCRfj2kUhxHAFQB62tR4cVhp6nbkUblvu2oLGMtEDYcEFhlyb8fRFg0lXuNye/FNTVRn7YsMnGWWhZuNBxVtexGdyZP8hMstTyj+if2t3lVzxogToIDgrWxBCmkQ0OXIOW0zqZX+Y6O9e/BqDoN6sqkgSfepxGw3stTgLDhgMAqSw698xmdwLbW3eeYUbhB0Q3oODAqv6xwJrjwL/Q6asi6G7cxHSk323BAYJUlcNPAI31+K/d9gA2iyK4ycp8hFDibrAGLmAKEDQcEVlmCyF6qUGw4sgMv7+SGdXHNEkaufZCazQdSdBQZHh6IDAgb/CSBVZbATaz/8z6/eDRQHPgwcicmFNR9qBpIA2cAU4Cw4YCgylhCmhaqXIeYi8KkQS5Qtg4Cd6wB/yS1QNjgyB5l/GJUXtV+Zva1x3RhZFELI1UTuIB6YZD9peFmRkXVxwQdHMul+9KP2sod9DL743G69K+nR3LxlFWTOEuPFxCqZHTMIDzd+CrYfvAdo6jL2Q9GDsPVaoAO9SkmdFia0JUabaq7+phGLf2NauDJ4ps4YP2HjFQem5mgjeN5wndLZM4V7f3uK8PPGnrbGSfaj2r9LDXqQKN+PP49QiXDVxjRbpisGf2EnhouQzeYY0+N+1kDQ7P3aB7o0XaK3n7wHu57rXBZ9Wu3zdvzr8epQe/vQG+8QpRoETojUJ0al8wEr0AK0Ks+/bWU2l4aVdZ0aqj0iMBm9k/swHVAW+h7byHL1FTp3Jf63lvddtw2SANCoNtnKC0uyNLly8g1CIJ7kt9brVvdpivxFquTR6Mg7bZjK2sh/fRfB5rM+9avXWsmeBG99/Na4/hl/es38jDjE0Mt7qSRYg89DvaYpgO+QlfcwHPKjAjxfw==(/figma)--><span style=\"white-space:pre-wrap;\">Nosso Time</span></b> e o seu registro <b>Id_int = 62</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-02',	'22:11:56',	'5'),
(108,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Conhe&ccedil;a aqueles que transformam sonhos em realidade!</b> e o seu registro <b>Id_int = 62</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-02',	'22:11:07',	'5'),
(109,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Nosso Time</b> e o seu registro <b>Id_int = 62</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-02',	'22:11:18',	'5'),
(110,	216,	'Novo registro Id_int = <b>68</b> inserido na tabela restricao</b>',	'restricao',	'2020-11-02',	'22:11:54',	'5'),
(111,	216,	'Novo registro Id_int = <b>735</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'23:11:19',	'5'),
(112,	216,	'Novo registro Id_int = <b>736</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'23:11:25',	'5'),
(113,	216,	'Novo registro Id_int = <b>737</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'23:11:32',	'5'),
(114,	216,	'Novo registro Id_int = <b>738</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-02',	'23:11:39',	'5'),
(115,	216,	'Efetuado UPDATE do campo <b>Facebook_txf</b> com o valor = <b></b> e o seu registro <b>Id_int = 7</b> da tabela <b>equipe</b>',	'equipe',	'2020-11-02',	'23:11:00',	'5'),
(116,	216,	'Efetuado UPDATE do campo <b>Whatsapp_txf</b> com o valor = <b></b> e o seu registro <b>Id_int = 5</b> da tabela <b>equipe</b>',	'equipe',	'2020-11-02',	'23:11:04',	'5'),
(117,	216,	'Efetuado UPDATE do campo <b>Email_txf</b> com o valor = <b></b> e o seu registro <b>Id_int = 1</b> da tabela <b>equipe</b>',	'equipe',	'2020-11-02',	'23:11:07',	'5'),
(118,	216,	'Efetuado UPDATE do campo <b>Telefone_txf</b> com o valor = <b></b> e o seu registro <b>Id_int = 4</b> da tabela <b>equipe</b>',	'equipe',	'2020-11-02',	'23:11:12',	'5'),
(119,	216,	'Efetuado UPDATE do campo <b>Linkedin_txf</b> com o valor = <b></b> e o seu registro <b>Id_int = 3</b> da tabela <b>equipe</b>',	'equipe',	'2020-11-02',	'23:11:23',	'5'),
(120,	216,	'Novo registro Id_int = <b>63</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-03',	'00:11:28',	'5'),
(121,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Entre em contato!</b> e o seu registro <b>Id_int = 63</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'00:11:37',	'5'),
(122,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Preencha o formul&aacute;rio abaixo e vamos entrar contato</b> e o seu registro <b>Id_int = 63</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'00:11:43',	'5'),
(123,	216,	'Novo registro Id_int = <b>64</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-03',	'00:11:09',	'5'),
(124,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Informa&ccedil;&otilde;es de contato</b> e o seu registro <b>Id_int = 64</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'00:11:15',	'5'),
(125,	216,	'Novo registro Id_int = <b>65</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-03',	'04:11:14',	'5'),
(126,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Avalie seu im&oacute;vel</b> e o seu registro <b>Id_int = 65</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:24',	'5'),
(127,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Se voc&ecirc; est&aacute; pensando em alugar ou vender seu im&oacute;vel n&oacute;s podemos te ajudar.</b> e o seu registro <b>Id_int = 65</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:31',	'5'),
(128,	216,	'Novo registro Id_int = <b>66</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-03',	'04:11:49',	'5'),
(129,	216,	'Novo registro Id_int = <b>67</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-03',	'04:11:55',	'5'),
(130,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Preencha o formul&aacute;rio abaixo e entraremos em contato</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:04',	'5'),
(131,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Quer an&uacute;nciar conosco?</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:10',	'5'),
(132,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Quer anunciar conosco?</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:15',	'5'),
(133,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Quer anunciar conosco?</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:15',	'5'),
(134,	216,	'Efetuado UPDATE do campo <b>Campo_txf</b> com o valor = <b>cadastre_imovel_interna</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:24',	'5'),
(135,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Quer anunciar conosco?</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:57',	'5'),
(136,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Preencha o formul&aacute;rio abaixo e entraremos em contato</b> e o seu registro <b>Id_int = 67</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'04:11:01',	'5'),
(137,	216,	'Novo registro Id_int = <b>68</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-03',	'05:11:51',	'5'),
(138,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Quer receber todas as novidades no seu e-mail?</b> e o seu registro <b>Id_int = 68</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'05:11:55',	'5'),
(139,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Assine nossa newsletter e receba informa&ccedil;&otilde;es sobre novos im&oacute;veis no seu e-mail </b> e o seu registro <b>Id_int = 68</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-03',	'05:11:06',	'5'),
(140,	216,	'Novo registro Id_int = <b>739</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:09',	'5'),
(141,	216,	'Novo registro Id_int = <b>740</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:09',	'5'),
(142,	216,	'Novo registro Id_int = <b>741</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:09',	'5'),
(143,	216,	'Novo registro Id_int = <b>742</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:10',	'5'),
(144,	216,	'Novo registro Id_int = <b>743</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:10',	'5'),
(145,	216,	'Novo registro Id_int = <b>744</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:10',	'5'),
(146,	216,	'Novo registro Id_int = <b>745</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:11',	'5'),
(147,	216,	'Novo registro Id_int = <b>746</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:11',	'5'),
(148,	216,	'Novo registro Id_int = <b>747</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:11',	'5'),
(149,	216,	'Novo registro Id_int = <b>748</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:12',	'5'),
(150,	216,	'Novo registro Id_int = <b>749</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:12',	'5'),
(151,	216,	'Novo registro Id_int = <b>750</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:12',	'5'),
(152,	216,	'Novo registro Id_int = <b>751</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:23',	'5'),
(153,	216,	'Novo registro Id_int = <b>752</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:24',	'5'),
(154,	216,	'Novo registro Id_int = <b>753</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:24',	'5'),
(155,	216,	'Novo registro Id_int = <b>754</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:24',	'5'),
(156,	216,	'Novo registro Id_int = <b>755</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:34',	'5'),
(157,	216,	'Novo registro Id_int = <b>756</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:34',	'5'),
(158,	216,	'Novo registro Id_int = <b>757</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:35',	'5'),
(159,	216,	'Novo registro Id_int = <b>758</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-03',	'05:11:35',	'5'),
(160,	216,	'Novo registro Id_int = <b>73</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-03',	'05:11:58',	'5'),
(161,	216,	'Novo registro Id_int = <b>74</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-03',	'05:11:00',	'5'),
(162,	216,	'Efetuado UPDATE do campo <b>Exibe_banner_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:05',	'5'),
(163,	216,	'Efetuado UPDATE do campo <b>Exibe_banner_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 2</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:09',	'5'),
(164,	216,	'Efetuado UPDATE do campo <b>Exibe_banner_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 1</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:13',	'5'),
(165,	216,	'Efetuado UPDATE do campo <b>Nome_tit</b> com o valor = <b>Meu segundo Imóvel </b> e o seu registro <b>Id_int = 3</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:34',	'5'),
(166,	216,	'Efetuado UPDATE do campo <b>Nome_tit</b> com o valor = <b>Imóvel Muito parecido com o anterior</b> e o seu registro <b>Id_int = 2</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:47',	'5'),
(167,	216,	'Efetuado UPDATE do campo <b>Descricao_txa</b> com o valor = <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae ante vel erat aliquet ultrices vitae non sapien. Proin laoreet mauris neque, id lacinia ante vestibulum id. Integer elementum mollis metus vitae imperdiet. Donec accumsan sollicitudin volutpat. Aliquam dictum nulla ultricies sollicitudin luctus. Morbi sit amet purus vitae lectus condimentum efficitur. Cras vitae lorem mi. Duis in faucibus mi. Nulla sodales ante a sem tincidunt viverra. Proin fringilla mi orci. Curabitur orci massa, eleifend sit amet pellentesque tempor, rhoncus laoreet dolor. Maecenas congue odio id lorem efficitur, at faucibus augue placerat. Pellentesque a bibendum sem. Nunc lacinia eget purus quis sodales. Nam volutpat bibendum semper. Etiam consectetur dignissim est, vitae pulvinar lorem pellentesque ac.\r\n&nbsp;<div><br></div><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.</div></b> e o seu registro <b>Id_int = 1</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:54',	'5'),
(168,	216,	'Efetuado UPDATE do campo <b>Nome_tit</b> com o valor = <b>Imovél Lorem ipsum dolor sit amet,</b> e o seu registro <b>Id_int = 1</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-03',	'05:11:03',	'5'),
(169,	216,	'Novo registro Id_int = <b>9</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-03',	'06:11:45',	'5'),
(170,	216,	'Novo registro Id_int = <b>10</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-03',	'06:11:50',	'5'),
(171,	216,	'Novo registro Id_int = <b>11</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-03',	'06:11:55',	'5'),
(172,	216,	'Novo registro Id_int = <b>12</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-03',	'06:11:04',	'5'),
(173,	216,	'Novo registro Id_int = <b>13</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-03',	'06:11:10',	'5'),
(174,	216,	'Novo registro Id_int = <b>14</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-03',	'06:11:15',	'5'),
(175,	216,	'Novo registro Id_int = <b>75</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-04',	'23:11:43',	'5'),
(176,	216,	'Novo registro Id_int = <b>76</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-04',	'23:11:49',	'5'),
(177,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>123456.00</b> e o seu registro <b>Id_int = 8</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:34',	'5'),
(178,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>900000.00</b> e o seu registro <b>Id_int = 7</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:48',	'5'),
(179,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>4000000.00</b> e o seu registro <b>Id_int = 6</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:07',	'5'),
(180,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>120000.00</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:15',	'5'),
(181,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>90000.00</b> e o seu registro <b>Id_int = 3</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:25',	'5'),
(182,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>1500000.00</b> e o seu registro <b>Id_int = 2</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:34',	'5'),
(183,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>750000.00</b> e o seu registro <b>Id_int = 1</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:41',	'5'),
(184,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>950.00</b> e o seu registro <b>Id_int = 8</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:57',	'5'),
(185,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>1230.00</b> e o seu registro <b>Id_int = 7</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:08',	'5'),
(186,	216,	'Efetuado UPDATE do campo <b>Valor_txf</b> com o valor = <b>670.00</b> e o seu registro <b>Id_int = 6</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-04',	'23:11:15',	'5'),
(187,	216,	'Novo registro Id_int = <b>14</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-04',	'23:11:26',	'5'),
(188,	216,	'Novo registro Id_int = <b>759</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-05',	'00:11:31',	'5'),
(189,	216,	'Novo registro Id_int = <b>15</b> inserido na tabela caracteristicas</b>',	'caracteristicas',	'2020-11-05',	'00:11:54',	'5'),
(190,	216,	'Efetuado UPDATE do campo <b>Ativo_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'00:11:23',	'5'),
(191,	216,	'Novo registro Id_int = <b>77</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-05',	'00:11:08',	'5'),
(192,	216,	'Novo registro Id_int = <b>78</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-05',	'00:11:12',	'5'),
(193,	216,	'Novo registro Id_int = <b>79</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-05',	'00:11:23',	'5'),
(194,	216,	'Novo registro Id_int = <b>80</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-05',	'00:11:31',	'5'),
(195,	216,	'Efetuado UPDATE do campo <b>Tipo_filtro_sel</b> com o valor = <b>RANGE</b> e o seu registro <b>Id_int = 4</b> da tabela <b>caracteristicas_tipos</b>',	'caracteristicas_tipos',	'2020-11-05',	'00:11:38',	'5'),
(196,	216,	'Efetuado UPDATE do campo <b>Tipo_filtro_sel</b> com o valor = <b>RADIO</b> e o seu registro <b>Id_int = 3</b> da tabela <b>caracteristicas_tipos</b>',	'caracteristicas_tipos',	'2020-11-05',	'00:11:41',	'5'),
(197,	216,	'Efetuado UPDATE do campo <b>Tipo_filtro_sel</b> com o valor = <b>RADIO</b> e o seu registro <b>Id_int = 2</b> da tabela <b>caracteristicas_tipos</b>',	'caracteristicas_tipos',	'2020-11-05',	'00:11:44',	'5'),
(198,	216,	'Efetuado UPDATE do campo <b>Tipo_filtro_sel</b> com o valor = <b>RADIO</b> e o seu registro <b>Id_int = 1</b> da tabela <b>caracteristicas_tipos</b>',	'caracteristicas_tipos',	'2020-11-05',	'00:11:47',	'5'),
(199,	216,	'Efetuado UPDATE do campo <b>Exibe_filtro_sel</b> com o valor = <b>SIM</b> e o seu registro <b>Id_int = 4</b> da tabela <b>caracteristicas_tipos</b>',	'caracteristicas_tipos',	'2020-11-05',	'00:11:54',	'5'),
(200,	216,	'Novo registro Id_int = <b>41</b> inserido na tabela <b>videos</b></b>',	'videos',	'2020-11-05',	'01:11:14',	'5'),
(201,	216,	'Novo registro Id_int = <b>42</b> inserido na tabela <b>videos</b></b>',	'videos',	'2020-11-05',	'01:11:52',	'5'),
(202,	216,	'Efetuado UPDATE do campo <b>Descricao_curta_txa</b> com o valor = <b><div>Nulla facilisi. Quisque tempus tempor sem ac vulputate. Nulla ac orci nulla. Curabitur tortor risus, facilisis sodales fermentum a, molestie eu diam. Duis consequat quis justo at congue. Vestibulum congue nisl nulla. Nunc pellentesque mi et lorem pellentesque semper.<br></div></b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'04:11:57',	'5'),
(203,	216,	'Novo registro Id_int = <b>81</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-05',	'04:11:02',	'5'),
(204,	216,	'Novo registro Id_int = <b>16</b> inserido na tabela adicionais</b>',	'adicionais',	'2020-11-05',	'04:11:59',	'5'),
(205,	216,	'Novo registro Id_int = <b>82</b> inserido na tabela selects_checkboxes</b>',	'selects_checkboxes',	'2020-11-05',	'04:11:09',	'5'),
(206,	216,	'Novo registro Id_int = <b>17</b> inserido na tabela adicionais</b>',	'adicionais',	'2020-11-05',	'04:11:16',	'5'),
(207,	216,	'Efetuado UPDATE do campo <b>Descricao_txa</b> com o valor = <b><div>A casa fica a aproximadamente 2,5km (4min de carro) do centro de Canela. O espa&ccedil;o &eacute; maravilhoso por causa do ambiente r&uacute;stico e aconchegante e por causa da &aacute;rea externa, que tem uma natureza exuberante e vista para o vale. &Eacute; ideal para casais. A casa possui 01 dormit&oacute;rio com cama de casal, sala de estar com sof&aacute;/cama para duas pessoas e lareira ecol&oacute;gica, cozinha completa com fog&atilde;o campeiro, sala de jantar e banheiro.</div><div><br></div><div>O espa&ccedil;o</div><div>A casa fica em um bairro muito tranquilo e seguro, em uma regi&atilde;o que a fauna e a flora s&atilde;o especialmente preservadas. Tucanos, cotias, bugios e p&aacute;ssaros de todas cores costumam transitar pelo bairro que &eacute; repleto de nascentes, xaxins e &aacute;rvores centen&aacute;rias. O terreno possui 1.500m&sup2; de &aacute;rea preservada e um c&oacute;rrego com pequena cascata, onde o barulho de &aacute;gua corrente transmite paz e relaxamento.</div><div><br></div><div>Acesso do h&oacute;spede</div><div>A casa est&aacute; exclusivamente a disposi&ccedil;&atilde;o do h&oacute;spede.</div><div><br></div><div>Outras observa&ccedil;&otilde;es</div><div>A casa possui cadeirinha infantil para alimenta&ccedil;&atilde;o e ber&ccedil;o, tornando o espa&ccedil;o mais adequado para crian&ccedil;as.</div></b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:07',	'5'),
(208,	216,	'Novo registro Id_int = <b>69</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-05',	'05:11:10',	'5'),
(209,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Ficou interessado(a)?</b> e o seu registro <b>Id_int = 69</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-05',	'05:11:21',	'5'),
(210,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Preencha o formul&aacute;rio abaixo e vamos entrar em contato com voc&ecirc;</b> e o seu registro <b>Id_int = 69</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-05',	'05:11:27',	'5'),
(211,	216,	'Efetuado UPDATE do campo <b>Descricao_curta_txa</b> com o valor = <b><div>Apartamento C/ 2 quartos Centro Lages/ SC.</div><div>C/ 2 quartos, sala, cozinha, WC social, &aacute;rea de servi&ccedil;o, depend&ecirc;ncia de empregada com WC e garagem rotativa.</div></b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:58',	'5'),
(212,	216,	'Efetuado UPDATE do campo <b>Bairro_txf</b> com o valor = <b>São Francisco</b> e o seu registro <b>Id_int = 8</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:40',	'5'),
(213,	216,	'Efetuado UPDATE do campo <b>Cep_txf</b> com o valor = <b>88506-400</b> e o seu registro <b>Id_int = 8</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:50',	'5'),
(214,	216,	'Efetuado UPDATE do campo <b>Cep_txf</b> com o valor = <b>88506-400</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:04',	'5'),
(215,	216,	'Efetuado UPDATE do campo <b>Bairro_txf</b> com o valor = <b>São Francisco</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:13',	'5'),
(216,	216,	'Efetuado UPDATE do campo <b>Ordenacao_txf</b> com o valor = <b>1</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:22',	'5'),
(217,	216,	'Efetuado UPDATE do campo <b>Ordenacao_txf</b> com o valor = <b>0</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-05',	'05:11:10',	'5'),
(218,	216,	'Novo registro Id_int = <b>1</b> inserido na tabela mapa360</b>',	'mapa360',	'2020-11-06',	'01:11:43',	'5'),
(219,	216,	'Novo registro Id_int = <b>2</b> inserido na tabela mapa360</b>',	'mapa360',	'2020-11-06',	'01:11:18',	'5'),
(220,	216,	'Efetuado UPDATE do campo <b>Endereco_txf</b> com o valor = <b>R. Heitor Villa Lobos, 525</b> e o seu registro <b>Id_int = 8</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-06',	'02:11:57',	'5'),
(221,	216,	'Efetuado UPDATE do campo <b>Endereco_txf</b> com o valor = <b>R. Heitor Villa Lobos, 525</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-06',	'02:11:31',	'5'),
(222,	216,	'Efetuado UPDATE do campo <b>Mapa_txf</b> com o valor = <b>!1m18!1m12!1m3!1d3656.1183301713286!2d-46.72009021912056!3d-23.60008882515584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce56c31b1fe649%3A0x7d134f4dfc6618c2!2sEst%C3%A1dio%20C%C3%ADcero%20Pompeu%20de%20Toledo!5e0!3m2!1spt-BR!2sbr!4v1604624571653!5m2!1spt-BR!2sbr</b> e o seu registro <b>Id_int = 4</b> da tabela <b>imoveis</b>',	'imoveis',	'2020-11-06',	'02:11:14',	'5'),
(223,	216,	'Novo registro Id_int = <b>760</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:39',	'5'),
(224,	216,	'Novo registro Id_int = <b>70</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-06',	'02:11:20',	'5'),
(225,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Podemos te ajudar a\r\nencontrar sua nova casa?</b> e o seu registro <b>Id_int = 70</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-06',	'02:11:33',	'5'),
(226,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Encontre empreendimentos, apartamentos e casas aqui!</b> e o seu registro <b>Id_int = 70</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-06',	'02:11:42',	'5'),
(227,	216,	'Novo registro Id_int = <b>761</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:30',	'5'),
(228,	216,	'Novo registro Id_int = <b>762</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:31',	'5'),
(229,	216,	'Novo registro Id_int = <b>763</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:31',	'5'),
(230,	216,	'Novo registro Id_int = <b>764</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:31',	'5'),
(231,	216,	'Novo registro Id_int = <b>765</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:32',	'5'),
(232,	216,	'Novo registro Id_int = <b>766</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:32',	'5'),
(233,	216,	'Novo registro Id_int = <b>767</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:33',	'5'),
(234,	216,	'Novo registro Id_int = <b>768</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'02:11:33',	'5'),
(235,	216,	'Efetuado UPDATE do campo <b>Link_mapa_txf</b> com o valor = <b>https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.724019518823!2d-122.48044378532619!3d37.8199328173344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808586deffffffc3%3A0xcded139783705509!2sPonte%20Golden%20Gate!5e0!3m2!1spt-BR!2sbr!4v1604627584494!5m2!1spt-BR!2sbr</b> e o seu registro <b>Id_int = 2</b> da tabela <b>empreendimentos</b>',	'empreendimentos',	'2020-11-06',	'02:11:33',	'5'),
(236,	216,	'Novo registro Id_int = <b>3</b> inserido na tabela mapa360</b>',	'mapa360',	'2020-11-06',	'02:11:01',	'5'),
(237,	216,	'Efetuado UPDATE do campo <b>Link_mapa_txf</b> com o valor = <b>!1m18!1m12!1m3!1d3151.724019518823!2d-122.48044378532619!3d37.8199328173344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808586deffffffc3%3A0xcded139783705509!2sPonte%20Golden%20Gate!5e0!3m2!1spt-BR!2sbr!4v1604627584494!5m2!1spt-BR!2sbr</b> e o seu registro <b>Id_int = 2</b> da tabela <b>empreendimentos</b>',	'empreendimentos',	'2020-11-06',	'02:11:05',	'5'),
(238,	216,	'Deletado o dado estrangeiro com Id_int = <b>3</b> da tabela <b>mapa360</b>',	'mapa360',	'2020-11-06',	'02:11:10',	'5'),
(239,	216,	'Novo registro Id_int = <b>4</b> inserido na tabela mapa360</b>',	'mapa360',	'2020-11-06',	'02:11:18',	'5'),
(240,	216,	'Novo registro Id_int = <b>769</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:08',	'5'),
(241,	216,	'Exclu&iacute;do o registro Id_int = <b>769</b> da tabela <b>imagens</b> ',	'imagens',	'2020-11-06',	'03:11:45',	'5'),
(242,	216,	'Novo registro Id_int = <b>43</b> inserido na tabela <b>videos</b></b>',	'videos',	'2020-11-06',	'03:11:13',	'5'),
(243,	216,	'Exclu&iacute;do o registro Id_int = <b>43</b> da tabela <b>videos</b> ',	'videos',	'2020-11-06',	'03:11:49',	'5'),
(244,	216,	'Novo registro Id_int = <b>44</b> inserido na tabela <b>videos</b></b>',	'videos',	'2020-11-06',	'03:11:52',	'5'),
(245,	216,	'Novo registro Id_int = <b>770</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:18',	'5'),
(246,	216,	'Novo registro Id_int = <b>771</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:18',	'5'),
(247,	216,	'Novo registro Id_int = <b>772</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:18',	'5'),
(248,	216,	'Novo registro Id_int = <b>773</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:18',	'5'),
(249,	216,	'Novo registro Id_int = <b>774</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:18',	'5'),
(250,	216,	'Novo registro Id_int = <b>775</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'03:11:19',	'5'),
(251,	216,	'Novo registro Id_int = <b>776</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:47',	'5'),
(252,	216,	'Novo registro Id_int = <b>777</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:47',	'5'),
(253,	216,	'Novo registro Id_int = <b>778</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:47',	'5'),
(254,	216,	'Novo registro Id_int = <b>779</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:48',	'5'),
(255,	216,	'Novo registro Id_int = <b>780</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:48',	'5'),
(256,	216,	'Novo registro Id_int = <b>781</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:48',	'5'),
(257,	216,	'Novo registro Id_int = <b>782</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:58',	'5'),
(258,	216,	'Novo registro Id_int = <b>783</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:58',	'5'),
(259,	216,	'Novo registro Id_int = <b>784</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:59',	'5'),
(260,	216,	'Novo registro Id_int = <b>785</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:59',	'5'),
(261,	216,	'Novo registro Id_int = <b>786</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:15',	'5'),
(262,	216,	'Novo registro Id_int = <b>787</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:15',	'5'),
(263,	216,	'Novo registro Id_int = <b>788</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:15',	'5'),
(264,	216,	'Novo registro Id_int = <b>789</b> inserido na tabela <b>imagens</b>',	'imagens',	'2020-11-06',	'04:11:15',	'5'),
(265,	216,	'Novo registro Id_int = <b>71</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-07',	'07:11:50',	'5'),
(266,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Encomende seu im&oacute;vel!</b> e o seu registro <b>Id_int = 71</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-07',	'07:11:59',	'5'),
(267,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Preencha o formul&aacute;rio abaixo e entraremos em contato com voc&ecirc;</b> e o seu registro <b>Id_int = 71</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-07',	'07:11:07',	'5'),
(268,	216,	'Novo registro Id_int = <b>72</b> inserido na tabela titulos</b>',	'titulos',	'2020-11-07',	'07:11:03',	'5'),
(269,	216,	'Efetuado UPDATE do campo <b>Titulo_txa</b> com o valor = <b>Novos im&oacute;veis cadastrados</b> e o seu registro <b>Id_int = 72</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-07',	'07:11:16',	'5'),
(270,	216,	'Efetuado UPDATE do campo <b>Subtitulo_txa</b> com o valor = <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam.</b> e o seu registro <b>Id_int = 72</b> da tabela <b>titulos</b>',	'titulos',	'2020-11-07',	'07:11:23',	'5');

DROP TABLE IF EXISTS `mapa360`;
CREATE TABLE `mapa360` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_objeto_con` int(11) NOT NULL,
  `Tabela_con` varchar(100) NOT NULL,
  `Titulo_txf` varchar(300) NOT NULL,
  `Link_360_txf` longtext NOT NULL,
  `Ordenacao_txf` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `mapa360` (`Id_int`, `Id_objeto_con`, `Tabela_con`, `Titulo_txf`, `Link_360_txf`, `Ordenacao_txf`) VALUES
(1,	4,	'imoveis',	'Vista de cima',	'!4v1604620525271!6m8!1m7!1sCAoSLEFGMVFpcE8tTEViYTJEdjFRMGYwSHBuS21Sc0ZqOHcweEVaTU9IS2tKdW5V!2m2!1d-23.6000888!2d-46.7200902!3f260!4f10!5f0.7820865974627469',	'0'),
(2,	4,	'imoveis',	'Logo do SP',	'!4v1604620173345!6m8!1m7!1sCAoSLEFGMVFpcE5NNC13elgtZUJsNVpsMnc1SGdnYUZWck1ZSHJWRlp5ZjFHck1I!2m2!1d-23.6000888!2d-46.7200902!3f260!4f10!5f0.7820865974627469',	'1'),
(4,	2,	'empreendimentos',	'G Gate',	'!4v1604627674244!6m8!1m7!1sF%3A-d2DJPm8NrsE%2FW_hTG3mCxOI%2FAAAAAAAAmQM%2FrkwtYq9Ct4wBcQ_tAkKYEvoOGi6zb8CAACLIBGAYYCw!2m2!1d37.8199286!2d-122.4782551!3f98.729904!4f4.726685000000003!5f0.7820865974627469',	'2');

DROP TABLE IF EXISTS `parceiros`;
CREATE TABLE `parceiros` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_txf` varchar(250) NOT NULL,
  `Imagens_ico` varchar(250) NOT NULL,
  `Endereco_txa` varchar(1000) NOT NULL,
  `Telefones_txa` varchar(1000) NOT NULL,
  `Link_site_txf` varchar(500) NOT NULL,
  `Ordenacao_txf` varchar(100) NOT NULL,
  `Ativo_sel` varchar(50) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `parceiros` (`Id_int`, `Nome_txf`, `Imagens_ico`, `Endereco_txa`, `Telefones_txa`, `Link_site_txf`, `Ordenacao_txf`, `Ativo_sel`) VALUES
(1,	'Parceiro n 1',	'',	'R. Heitor Villa Lobos, 525 -&nbsp;<div>Salas 209, 308 e 309\r\nS&atilde;o Francisco, Lages - SC&nbsp;</div><div>88.506-400</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM'),
(2,	'MASP',	'',	'Av. Paulista, 1578 -&nbsp;<div>Bela Vista, S&atilde;o Paulo - SP,&nbsp;</div><div>01310-200</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM'),
(3,	'Estádio do Morumbi',	'',	'Pra&ccedil;a Roberto Gomes Pedrosa, 1 -&nbsp;<div>Morumbi, S&atilde;o Paulo - SP,&nbsp;</div><div>05653-070</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM'),
(4,	'Parceiro n 4',	'',	'R. Heitor Villa Lobos, 525 -&nbsp;<div>Salas 209, 308 e 309\r\nS&atilde;o Francisco, Lages - SC&nbsp;</div><div>88.506-400</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div><div><b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div></div>',	'https://example.com',	'0',	'SIM'),
(6,	'Parceiro n 5',	'',	'R. Heitor Villa Lobos, 525 -&nbsp;<div>Salas 209, 308 e 309\r\nS&atilde;o Francisco, Lages - SC&nbsp;</div><div>88.506-400</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM'),
(7,	'Parceiro n 6',	'',	'R. Heitor Villa Lobos, 525 -&nbsp;<div>Salas 209, 308 e 309\r\nS&atilde;o Francisco, Lages - SC&nbsp;</div><div>88.506-400</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM'),
(8,	'Parceiro n 7',	'',	'R. Heitor Villa Lobos, 525 -&nbsp;<div>Salas 209, 308 e 309\r\nS&atilde;o Francisco, Lages - SC&nbsp;</div><div>88.506-400</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM'),
(9,	'Parceiro n 8',	'',	'R. Heitor Villa Lobos, 525 -&nbsp;<div>Salas 209, 308 e 309\r\nS&atilde;o Francisco, Lages - SC&nbsp;</div><div>88.506-400</div>',	'<b>+55 49 3380-8732&nbsp;</b><div><b>+55 49 99928-0396</b></div>',	'https://example.com',	'0',	'SIM');

DROP TABLE IF EXISTS `popup`;
CREATE TABLE `popup` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_sel` varchar(255) NOT NULL,
  `Titulo_txf` varchar(255) NOT NULL,
  `Texto_txa` longtext NOT NULL,
  `Imagem_ico` varchar(255) NOT NULL,
  `Data_inicio_dat` date NOT NULL,
  `Data_fim_dat` date NOT NULL,
  `Delay_txf` varchar(255) NOT NULL DEFAULT '0',
  `Exibir_ao_sair_sel` varchar(255) NOT NULL DEFAULT 'NAO',
  `Ativo_sel` varchar(255) NOT NULL DEFAULT 'NAO',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `popup` (`Id_int`, `Tipo_sel`, `Titulo_txf`, `Texto_txa`, `Imagem_ico`, `Data_inicio_dat`, `Data_fim_dat`, `Delay_txf`, `Exibir_ao_sair_sel`, `Ativo_sel`) VALUES
(1,	'MISTO',	'Feliz Natal!',	'Tudo certo pessoal?<div><br></div><div>[imagem1]</div>',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'2018-01-01',	'2020-12-31',	'0',	'NAO',	'NAO');

DROP TABLE IF EXISTS `redes_sociais`;
CREATE TABLE `redes_sociais` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Facebook_txf` varchar(255) NOT NULL,
  `Twitter_txf` varchar(255) NOT NULL,
  `Linkedin_txf` varchar(255) NOT NULL,
  `Pinterest_txf` varchar(255) NOT NULL,
  `Instagram_txf` varchar(255) NOT NULL,
  `Youtube_txf` varchar(255) NOT NULL,
  `Telegram_txf` varchar(255) NOT NULL,
  `Whatsapp_txf` varchar(255) NOT NULL,
  `Skype_txf` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `redes_sociais` (`Id_int`, `Facebook_txf`, `Twitter_txf`, `Linkedin_txf`, `Pinterest_txf`, `Instagram_txf`, `Youtube_txf`, `Telegram_txf`, `Whatsapp_txf`, `Skype_txf`) VALUES
(1,	'https://www.facebook.com/',	'',	'https://www.linkedin.com/',	'',	'https://www.instagram.com/',	'',	'',	'whats',	'skype:echo123?chat');

DROP TABLE IF EXISTS `restricao`;
CREATE TABLE `restricao` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Tabela_txf` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `Nivel_sel` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `Label_txf` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Limite_exibicao_sel` int(11) DEFAULT '0',
  `Explicacao_txa` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='## painel  ##';

INSERT INTO `restricao` (`Id_int`, `Tabela_txf`, `Nivel_sel`, `Label_txf`, `Limite_exibicao_sel`, `Explicacao_txa`) VALUES
(1,	'emails',	'3',	'2 - Contato - Emails',	0,	'Cadastro dos emails de contato'),
(2,	'usuarios',	'5',	'1 - Admin - Usuários',	0,	'Cadastro dos usuários do Painel '),
(3,	'restricao',	'5',	'1 - Admin - Restrição',	0,	'Cadastro das tabelas disponíveis para acesso.'),
(7,	'enderecos',	'3',	'2 - Contato - Endereços',	0,	'Cadastro do endereços da sua empresa'),
(8,	'redes_sociais',	'3',	'2 - Contato - Redes Sociais',	0,	'Cadastro das redes sociais da sua empresa, cadastrar o link completo com http:// ex: (https://facebook.com/landsagenciaweb)'),
(9,	'sobre',	'3',	'4 - Sobre',	0,	'Cadastro dos textos da página sobre. Você também poderá adicionar imagens e vídeos da sua empresa.'),
(10,	'telefones',	'3',	'2 - Contato - Telefones',	0,	'Cadastro dos telefones da empresa'),
(16,	'banners',	'3',	'3 - Início - Banners',	0,	'Cadastro dos banners da p&aacute;gina inicial'),
(23,	'seo',	'5',	'1 - Admin - SEO',	0,	'Ajustes no SEO do site'),
(26,	'popup',	'3',	'Popups',	0,	'Cadastro de popups do site'),
(33,	'whatsapp',	'3',	'Plugin WhatsApp',	0,	'Cadastro das informações do Plugin WhatsApp'),
(34,	'_contato',	'3',	'2 - Contatos Recebidos',	0,	'Realiza&ccedil;&atilde;o de matr&iacute;cula pelo site'),
(36,	'titulos',	'5',	'1 - Titulos do Site',	0,	''),
(56,	'solucoes',	'3',	'5 - Serviços',	0,	''),
(58,	'labcloud_config',	'3',	'1 - Labcloud Config.',	0,	''),
(60,	'selos',	'3',	'7 - Rodapé - Selos',	0,	''),
(61,	'parceiros',	'3',	'6 - Parceiros',	0,	''),
(62,	'imoveis',	'',	'3 - Imóveis',	0,	''),
(63,	'caracteristicas_tipos',	'',	'3 - Características - Tipos',	0,	''),
(64,	'empreendimentos',	'',	'Empreendimentos',	0,	''),
(65,	'sobre_mim',	'',	'3 - Sobre Mim',	0,	''),
(66,	'sobre_carreira',	'',	'3 - Sobre - Carreira',	0,	''),
(67,	'sobre_referencia',	'',	'3 - Sobre - Referência',	0,	''),
(68,	'equipe',	'',	'3 - Sobre - Equipe',	0,	'');

DROP TABLE IF EXISTS `selects_checkboxes`;
CREATE TABLE `selects_checkboxes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Campo_txf` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Tabela_sel` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `Campo_tabela_sel` varchar(45) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='## painel  ##';

INSERT INTO `selects_checkboxes` (`Id_int`, `Campo_txf`, `Tabela_sel`, `Campo_tabela_sel`) VALUES
(61,	'SIM',	'imoveis',	'Ativo_sel'),
(62,	'NAO',	'imoveis',	'Ativo_sel'),
(63,	'SIM',	'imoveis',	'Exibe_selecao_sel'),
(64,	'NAO',	'imoveis',	'Exibe_selecao_sel'),
(65,	'SIM',	'empreendimentos',	'Exibe_inicio_sel'),
(66,	'NAO',	'empreendimentos',	'Exibe_inicio_sel'),
(67,	'SIM',	'empreendimentos',	'Ativo_sel'),
(68,	'NAO',	'empreendimentos',	'Ativo_sel'),
(69,	'SIM',	'sobre_carreira',	'Ativo_sel'),
(70,	'NAO',	'sobre_carreira',	'Ativo_sel'),
(71,	'SIM',	'sobre_referencia',	'Ativo_sel'),
(72,	'NAO',	'sobre_referencia',	'Ativo_sel'),
(73,	'SIM',	'imoveis',	'Exibe_banner_sel'),
(74,	'NAO',	'imoveis',	'Exibe_banner_sel'),
(75,	'aluguel',	'imoveis',	'Tipo_imovel_sel'),
(76,	'compra',	'imoveis',	'Tipo_imovel_sel'),
(77,	'SIM',	'caracteristicas_tipos',	'Exibe_filtro_sel'),
(78,	'NAO',	'caracteristicas_tipos',	'Exibe_filtro_sel'),
(79,	'RADIO',	'caracteristicas_tipos',	'Tipo_filtro_sel'),
(80,	'RANGE',	'caracteristicas_tipos',	'Tipo_filtro_sel'),
(81,	'IPTU',	'adicionais',	'Tipo_sel'),
(82,	'Condomínio',	'adicionais',	'Tipo_sel');

DROP TABLE IF EXISTS `selos`;
CREATE TABLE `selos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Imagem_ico` varchar(200) NOT NULL,
  `Nome_txf` varchar(500) NOT NULL,
  `Link_txf` varchar(500) NOT NULL,
  `Ordenacao_txf` varchar(100) NOT NULL DEFAULT '0',
  `Ativo_sel` varchar(100) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `selos` (`Id_int`, `Imagem_ico`, `Nome_txf`, `Link_txf`, `Ordenacao_txf`, `Ativo_sel`) VALUES
(1,	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'Selo A',	'http://example.com',	'1',	'SIM'),
(2,	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'Selo B',	'http://example.com',	'2',	'SIM');

DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Pagina_txf` varchar(255) NOT NULL,
  `Titulo_sma` longtext NOT NULL,
  `Descricao_sma` longtext NOT NULL,
  `Keywords_sma` longtext NOT NULL,
  `Imagem_sma` longtext NOT NULL,
  `Imagem_ico` varchar(255) NOT NULL,
  `Ativo_sel` varchar(255) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `seo` (`Id_int`, `Pagina_txf`, `Titulo_sma`, `Descricao_sma`, `Keywords_sma`, `Imagem_sma`, `Imagem_ico`, `Ativo_sel`) VALUES
(1,	'default',	'Zeh Imóveis',	'Zeh Imóveis',	'',	'{$app->Url_cliente}{$app->Pasta_painel}/{$banners[0]->Imagens[0]->Caminho_txf}',	'',	'SIM');

DROP TABLE IF EXISTS `sobre`;
CREATE TABLE `sobre` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Sobre_txa` longtext NOT NULL,
  `Sobre_rodape_txa` longtext NOT NULL,
  `Imagens_ico` varchar(60) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '<img src="imagens/visualizar_geral.png" rel="Visualizar">',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `sobre` (`Id_int`, `Sobre_txa`, `Sobre_rodape_txa`, `Imagens_ico`) VALUES
(1,	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris volutpat donec nunc lectus. Adipiscing praesent sit nulla felis purus nisl, volutpat faucibus blandit. Fames quis auctor tempus, eu libero est. Eu sed sed tortor velit augue. Porta diam lorem mauris enim. Sapien gravida sit massa erat blandit.',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed fermentum scelerisque pellentesque imperdiet fringilla velit tincidunt. Elementum purus metus non feugiat. Praesent neque maecenas pellentesque nulla sit sit. A in sit nulla sed laoreet elementum consequat. Fringilla amet proin vitae tristique eget vitae urna faucibus. ',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />');

DROP TABLE IF EXISTS `sobre_carreira`;
CREATE TABLE `sobre_carreira` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo_txf` varchar(300) NOT NULL,
  `Texto_txa` longtext NOT NULL,
  `Imagens_ico` varchar(100) NOT NULL,
  `Ativo_sel` varchar(100) NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sobre_carreira` (`Id_int`, `Titulo_txf`, `Texto_txa`, `Imagens_ico`, `Ativo_sel`) VALUES
(1,	'Mais de 10 anos de carreira!',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Justo vitae congue consequat auctor ullamcorper lectus mollis diam mattis.<div><br></div><div>Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.</div>',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'SIM');

DROP TABLE IF EXISTS `sobre_mim`;
CREATE TABLE `sobre_mim` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo_txf` varchar(300) NOT NULL,
  `Especializacao_txf` varchar(300) NOT NULL,
  `Sobre_txa` longtext NOT NULL,
  `Imagens_ico` varchar(300) NOT NULL,
  `Ativo_sel` varchar(300) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sobre_mim` (`Id_int`, `Titulo_txf`, `Especializacao_txf`, `Sobre_txa`, `Imagens_ico`, `Ativo_sel`) VALUES
(1,	'Me chamo Cleiton Fávero ',	'Sou especialista em consultoria imobiliaria',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Justo vitae congue consequat auctor ullamcorper lectus mollis diam mattis. Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.',	'',	'SIM');

DROP TABLE IF EXISTS `sobre_referencia`;
CREATE TABLE `sobre_referencia` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Titulo_txf` varchar(300) NOT NULL,
  `Texto_txa` longtext NOT NULL,
  `Imagens_ico` varchar(300) NOT NULL,
  `Ativo_sel` varchar(300) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `sobre_referencia` (`Id_int`, `Titulo_txf`, `Texto_txa`, `Imagens_ico`, `Ativo_sel`) VALUES
(1,	'Referência no segmento de alto padrão',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Justo vitae congue consequat auctor ullamcorper lectus mollis diam mattis. Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.&nbsp;\r\n<div><br></div><div>Euismod non, fringilla mauris odio. Elit, potenti enim ante erat mollis. Integer vitae habitant quis tortor feugiat vel sollicitudin quisque.</div>',	'<img rel=\'Visualizar\' src=\'imagens/visualizar_geral.png\' />',	'SIM');

DROP TABLE IF EXISTS `solucoes`;
CREATE TABLE `solucoes` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_tit` varchar(300) NOT NULL,
  `Nome_url` varchar(500) NOT NULL,
  `Texto_txa` longtext NOT NULL,
  `Imagens_ico` varchar(300) NOT NULL,
  `Ordenacao_txf` varchar(300) NOT NULL,
  `Ativo_sel` varchar(300) NOT NULL DEFAULT 'SIM',
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `solucoes` (`Id_int`, `Nome_tit`, `Nome_url`, `Texto_txa`, `Imagens_ico`, `Ordenacao_txf`, `Ativo_sel`) VALUES
(1,	'Somente 4',	'somente-4',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div>',	'Sala de Dança / Centro Desportivo',	'4',	'SIM'),
(2,	'Serviço de número 3 que deveria ter um nome muito longo',	'servico-de-numero-3-que-deveria-ter-um-nome-muito-longo',	'',	'Sala de Dança / Centro Desportivo',	'3',	'SIM'),
(3,	'Serviço que o número deveria ser 2',	'servico-que-o-numero-deveria-ser-2',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div>',	'Sala de Dança / Centro Desportivo',	'2',	'SIM'),
(4,	'Serviço número 1',	'servico-numero-1',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.',	'Sala de Dança / Centro Desportivo',	'1',	'SIM'),
(5,	'Somente 4',	'somente-4',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div><div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div>',	'Sala de Dança / Centro Desportivo',	'4',	'SIM'),
(6,	'Serviço de número 3 que deveria ter um nome muito longo',	'servico-de-numero-3-que-deveria-ter-um-nome-muito-longo',	'',	'Sala de Dança / Centro Desportivo',	'3',	'SIM'),
(7,	'Serviço que o número deveria ser 2',	'servico-que-o-numero-deveria-ser-2',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<div><br></div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.<br></div>',	'Sala de Dança / Centro Desportivo',	'2',	'SIM'),
(8,	'Serviço número 1',	'servico-numero-1',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Elementum arcu laoreet fermentum venenatis quis eu facilisis. Sed neque et, egestas tempor a nunc eu convallis. Congue in neque, nisi, dictumst orci lacus ullamcorper. Adipiscing ut blandit eu orci. Pretium nibh sit scelerisque elit nisi mattis magna augue. Turpis nulla elit egestas maecenas nisi, eu, rhoncus. Penatibus id molestie donec dignissim cras dictum quam. Est pulvinar habitant semper odio vitae lorem vel nullam. Diam lectus magna id.',	'Sala de Dança / Centro Desportivo',	'1',	'SIM');

DROP TABLE IF EXISTS `telefones`;
CREATE TABLE `telefones` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Ddd_txf` varchar(2) NOT NULL,
  `Numero_txf` varchar(15) NOT NULL,
  `Tipo_sel` varchar(15) NOT NULL DEFAULT 'FIXO',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `telefones` (`Id_int`, `Ddd_txf`, `Numero_txf`, `Tipo_sel`) VALUES
(6,	'47',	'9 9976-1918',	'WHATSAPP'),
(7,	'83',	'3321-6440',	'FIXO');

DROP TABLE IF EXISTS `textos`;
CREATE TABLE `textos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Estrutura_txa` longtext NOT NULL,
  `Contato_txa` longtext NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `textos` (`Id_int`, `Estrutura_txa`, `Contato_txa`) VALUES
(1,	'Teste! Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et dolor volutpat, tincidunt nibh a, viverra dolor.\r\n',	'Entre em contato, responderemos o mais breve poss&iacute;vel!<b><br></b>');

DROP TABLE IF EXISTS `titulos`;
CREATE TABLE `titulos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Campo_txf` varchar(250) NOT NULL,
  `Titulo_txa` varchar(1000) NOT NULL,
  `Subtitulo_txa` longtext NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

INSERT INTO `titulos` (`Id_int`, `Campo_txf`, `Titulo_txa`, `Subtitulo_txa`) VALUES
(42,	'secao_servicos',	'Nossos Serviços',	'Conhe&ccedil;a os'),
(48,	'secao_sobre',	'Zeh Imóveis',	'Sobre n&oacute;s'),
(49,	'secao_restrita',	'Acesse a àrea de clientes',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris volutpat donec nunc lectus. Adipiscing praesent sit nulla felis purus nisl, volutpat faucibus blandit.'),
(56,	'secao_contato_whats',	'Entre em contato conosco ou nós ligamos para você',	''),
(57,	'secao_parceiros',	'Nossos Parceiros',	'Conhe&ccedil;a os'),
(58,	'secao_contato',	'Contato',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris volutpat donec nunc lectus. '),
(59,	'banner_inicio',	'Podemos te ajudar a encontrar sua <b>nova casa?</b>',	'Encontre empreendimentos, apartamentos e casas aqui!'),
(60,	'imoveis_selecao_inicio',	'Inspire-se com a nossa sele&ccedil;&atilde;o',	'Confira as oportunidades apaixonantes que separamos para voc&ecirc;'),
(61,	'interna_empreendimentos',	'Confira as principais op&ccedil;&otilde;es investimentos para voc&ecirc;!',	''),
(62,	'sobre_interna_equipe',	'Nosso Time',	'Conhe&ccedil;a aqueles que transformam sonhos em realidade!'),
(63,	'interna_contato_form',	'Entre em contato!',	'Preencha o formul&aacute;rio abaixo e vamos entrar contato'),
(64,	'interna_contato_dados',	'Informa&ccedil;&otilde;es de contato',	''),
(65,	'avalie_imovel_interna',	'Avalie seu im&oacute;vel',	'Se voc&ecirc; est&aacute; pensando em alugar ou vender seu im&oacute;vel n&oacute;s podemos te ajudar.'),
(67,	'cadastre_imovel_interna',	'Quer anunciar conosco?',	'Preencha o formul&aacute;rio abaixo e entraremos em contato'),
(68,	'newsletter',	'Quer receber todas as novidades no seu e-mail?',	'Assine nossa newsletter e receba informa&ccedil;&otilde;es sobre novos im&oacute;veis no seu e-mail '),
(69,	'entre_contato_simples',	'Ficou interessado(a)?',	'Preencha o formul&aacute;rio abaixo e vamos entrar em contato com voc&ecirc;'),
(70,	'interna_imoveis',	'Podemos te ajudar a\r\nencontrar sua nova casa?',	'Encontre empreendimentos, apartamentos e casas aqui!'),
(71,	'encomende_modal',	'Encomende seu im&oacute;vel!',	'Preencha o formul&aacute;rio abaixo e entraremos em contato com voc&ecirc;'),
(72,	'imoveis_novos_inicio',	'Novos im&oacute;veis cadastrados',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam.');

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Nome_completo_txf` varchar(45) NOT NULL DEFAULT '',
  `Cpf_txf` varchar(45) NOT NULL DEFAULT '',
  `Data_nascimento_dat` date DEFAULT NULL,
  `Telefone_txf` varchar(45) DEFAULT NULL,
  `Celular_txf` varchar(45) DEFAULT NULL,
  `Sexo_sel` varchar(45) NOT NULL DEFAULT '',
  `Cep_txf` varchar(45) NOT NULL DEFAULT '',
  `Endereco_txf` varchar(60) NOT NULL DEFAULT '',
  `Complemento_txf` varchar(100) DEFAULT NULL,
  `Bairro_txf` varchar(60) NOT NULL DEFAULT '',
  `Cidade_txf` varchar(45) NOT NULL DEFAULT '',
  `Estado_sel` varchar(45) NOT NULL DEFAULT '',
  `Email_txf` varchar(60) DEFAULT NULL,
  `Senha_txp` varchar(45) NOT NULL DEFAULT '',
  `Nivel_sel` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id_int`),
  KEY `fk_usuarios_logs1` (`Id_int`),
  KEY `fk_usuarios_selects_checkboxes2` (`Estado_sel`),
  KEY `fk_usuarios_selects_checkboxes1` (`Nivel_sel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='## painel  ##';


DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Id_video_con` int(11) DEFAULT NULL,
  `Tabela_con` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Titulo_txf` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Endereco_txf` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Descricao_txa` longtext CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Filtros_txf` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Data_txf` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `timestamp_hid` varchar(255) NOT NULL,
  PRIMARY KEY (`Id_int`),
  KEY `fk_videos_noticias1` (`Id_video_con`),
  KEY `fk_videos_empresa1` (`Id_video_con`),
  KEY `fk_videos_galeria_videos1` (`Id_video_con`),
  KEY `fk_videos_produtos1` (`Id_video_con`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='## painel  ##';

INSERT INTO `videos` (`Id_int`, `Id_video_con`, `Tabela_con`, `Titulo_txf`, `Endereco_txf`, `Descricao_txa`, `Filtros_txf`, `Data_txf`, `timestamp_hid`) VALUES
(16,	9,	'servicos',	'',	'09R8_2nJtjg',	'',	'',	'',	'1454700540'),
(17,	8,	'servicos',	'',	'qpgTC9MDx1o',	'',	'',	'',	'1454700553'),
(18,	7,	'servicos',	'',	'fwK7ggA3-bU',	'',	'',	'',	'1454700570'),
(19,	1,	'produtos',	'',	'0w7XfaWtWxA',	'',	'',	'',	'1454701635'),
(20,	17,	'produtos',	'',	'0w7XfaWtWxA',	'',	'',	'',	'1454701833'),
(21,	18,	'produtos',	'',	'0w7XfaWtWxA',	'',	'',	'',	'1454702487'),
(22,	21,	'produtos',	'',	'0w7XfaWtWxA',	'',	'',	'',	'1454702756'),
(23,	20,	'produtos',	'',	'0w7XfaWtWxA',	'',	'',	'',	'1454702761'),
(24,	19,	'produtos',	'',	'0w7XfaWtWxA',	'',	'',	'',	'1454702776'),
(27,	13,	'servicos',	'',	'EHwzIPuttwE',	'',	'',	'',	'1509219175'),
(28,	13,	'servicos',	'',	'AzEOUmBfNmw',	'',	'',	'',	'1509219230'),
(29,	28,	'produtos',	'',	'2Tjrn0BFDj4',	'',	'',	'',	'1509219666'),
(30,	28,	'produtos',	'',	'2Tjrn0BFDj4',	'',	'',	'',	'1509219672'),
(31,	3,	'diferenciais',	'',	'3mHzvIJb5Jg',	'',	'',	'',	'1549909927'),
(36,	1,	'sobre',	'',	'53f5ne-8io8',	'',	'',	'',	'1599988862'),
(37,	1,	'sobre',	'',	'9t9sa0TMebQ',	'',	'',	'',	'1599988872'),
(38,	1,	'sobre',	'',	'Xp-r0U7CiRM',	'',	'',	'',	'1599988901'),
(39,	1,	'sobre',	'',	'NwirTBLty5M',	'',	'',	'',	'1599988916'),
(40,	1,	'solucoes',	'',	'vtX4TfWGfO8',	'',	'',	'',	'1600058918'),
(41,	4,	'imoveis',	'',	'rsJqQQzv58E',	'',	'',	'',	'1604534774'),
(42,	4,	'imoveis',	'',	'zFJ4H0t7dWs',	'',	'',	'',	'1604536252'),
(44,	2,	'empreendimentos',	'',	'IA9xKr_Dmek',	'',	'',	'',	'1604628592');

DROP TABLE IF EXISTS `whatsapp`;
CREATE TABLE `whatsapp` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Cabecalho_txf` varchar(255) NOT NULL,
  `Texto_balao_txf` varchar(255) NOT NULL,
  `Numero_txf` varchar(255) NOT NULL,
  `Abrir_inicio_sel` varchar(255) NOT NULL DEFAULT 'NAO',
  `Abrir_delay_txf` varchar(255) NOT NULL DEFAULT '0',
  `Ativo_sel` varchar(255) NOT NULL DEFAULT 'NAO',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `whatsapp` (`Id_int`, `Cabecalho_txf`, `Texto_balao_txf`, `Numero_txf`, `Abrir_inicio_sel`, `Abrir_delay_txf`, `Ativo_sel`) VALUES
(1,	'Zeh Imóveis',	'Envie-nos uma mensagem por WhatsApp!',	'+551299999-9999',	'NAO',	'0',	'SIM');

DROP TABLE IF EXISTS `_contato`;
CREATE TABLE `_contato` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Nome_txf` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Telefone_txf` varchar(255) NOT NULL,
  `Destinatario_txf` varchar(255) NOT NULL,
  `Mensagem_txa` longtext CHARACTER SET latin1 COLLATE latin1_general_ci,
  `Data_dat` date NOT NULL,
  `Tipo_contato_txf` varchar(255) NOT NULL DEFAULT 'CONTATO',
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `_info`;
CREATE TABLE `_info` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  `Grupo_sel` enum('TODOS','ALUNOS','PROFESSORES','GERENTES') NOT NULL,
  `Data_dat` date NOT NULL,
  `Ultimoenvio_dat` date NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `_info` (`Id_int`, `Lands_id`, `Email_txf`, `Ativo_sel`, `Grupo_sel`, `Data_dat`, `Ultimoenvio_dat`) VALUES
(1,	'zehimoveis',	'cauesantosre4@gmail.com',	'SIM',	'TODOS',	'2020-11-06',	'0000-00-00');

DROP TABLE IF EXISTS `_informativo`;
CREATE TABLE `_informativo` (
  `Id_int` int(11) NOT NULL AUTO_INCREMENT,
  `Lands_id` varchar(255) NOT NULL,
  `Email_txf` varchar(255) NOT NULL,
  `Ativo_sel` enum('SIM','NAO') NOT NULL DEFAULT 'SIM',
  `Grupo_sel` enum('TODOS','ALUNOS','PROFESSORES','GERENTES') NOT NULL,
  `Data_dat` date NOT NULL,
  `Ultimoenvio_dat` date NOT NULL,
  PRIMARY KEY (`Id_int`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- 2020-11-07 08:35:30
