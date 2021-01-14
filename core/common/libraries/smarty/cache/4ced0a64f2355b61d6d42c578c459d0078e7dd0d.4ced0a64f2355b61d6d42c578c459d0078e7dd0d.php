<?php /*%%SmartyHeaderCode:614974225511e17ee3d40a4-81750009%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ced0a64f2355b61d6d42c578c459d0078e7dd0d' => 
    array (
      0 => '4ced0a64f2355b61d6d42c578c459d0078e7dd0d',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '614974225511e17ee3d40a4-81750009',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_511e17ee3db303_04801814',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_511e17ee3db303_04801814')) {function content_511e17ee3db303_04801814($_smarty_tpl) {?><ul id='menu'>
        <li><a href="#" onclick="inicio'); return false"  >Início</a></li>
        <li></li>
        <li><a href="#" onclick="empresa" >Empresa</a>
          <ul id='menu_produtos'>
            <li><a href="empresa?id=8" >Quem Somos</a></li><li><a href="empresa?id=9" >Missão</a></li><li><a href="empresa?id=11" >Valores</a></li><li><a href='#'  onclick="empresa?id=13" >Política de Qualidade</a></li>          </ul>
        </li>
        <li>
		<a href="#" onclick="produtos" >Produtos</a>
            <ul id='menu_produtos'>
            <li><a href="produtos?filtro_categoria=Bobinas" >Bobinas</a></li>
			<li><a href="produtos?filtro_categoria=Etiquetadoras" >Etiquetadoras</a></li>
			<li><a href="produtos?filtro_categoria=Etiquetas" >Etiquetas</a></li>
			<li><a href="produtos?filtro_categoria=Etiquetas+Comemorativas" >Etiquetas Comemorativas</a></li>
			<li><a href="produtos?filtro_categoria=Lacres" >Lacres</a></li><li><a href="produtos?filtro_categoria=R%F3tulos" >Rótulos</a></li>
			<li><a href="produtos?filtro_categoria=Suprimentos" >Suprimentos</a></li>
			<li><a href="produtos?filtro_categoria=Tags" >Tags</a></li>          
		    </ul>
		<li><a onclick="promocoes" href="#">Promoções</a></li>
        <li><a onclick="representantes" href="#">Representantes</a></li>
        <li><a onclick="noticias" href="#">Notícias</a></li>
        <li><a onclick="dicas" href="#">Dicas</a></li>
        <li><a onclick="downloads" href="#">Downloads</a></li>
        <li><a onclick="contato" href="#">Contato</a></li>
      </ul><?php }} ?>