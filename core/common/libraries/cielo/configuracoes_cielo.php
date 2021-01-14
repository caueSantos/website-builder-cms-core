<?php
     
require (COMMONPATH . 'libraries/cielo/errorHandling.php');
require_once (COMMONPATH . 'libraries/cielo/pedido.php');
require_once (COMMONPATH . 'libraries/cielo/logger.php'); 

define('VERSAO', "1.1.0");

//session_start();

//if(!isset($_SESSION["pedidos"]))
//{
//	$_SESSION["pedidos"] = new ArrayObject();
//}

// CONSTANTES
define("ENDERECO_BASE", "https://qasecommerce.cielo.com.br");
define("ENDERECO", ENDERECO_BASE."/servicos/ecommwsec.do");

//define("LOJA", "1006993069");
//define("LOJA_CHAVE", "25fbb99741c739dd84d7b06ec78c9bac718838630f30b112d033ce2e621b34f3");
define("CIELO", "1001734898");
define("CIELO_CHAVE", "e84827130b9837473681c2787007da5914d6359947015a5cdb2b8843db0fa832");


?>