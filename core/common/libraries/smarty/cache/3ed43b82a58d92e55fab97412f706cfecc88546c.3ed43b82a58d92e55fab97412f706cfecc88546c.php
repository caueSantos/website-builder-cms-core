<?php /*%%SmartyHeaderCode:1623004980511e86677c6df9-74514619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ed43b82a58d92e55fab97412f706cfecc88546c' => 
    array (
      0 => '3ed43b82a58d92e55fab97412f706cfecc88546c',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1623004980511e86677c6df9-74514619',
  'variables' => 
  array (
    'menu_institucional' => 0,
    'menu' => 0,
    'menu_produtos' => 0,
    'menu_prod' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_511e866784f662_75686407',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_511e866784f662_75686407')) {function content_511e866784f662_75686407($_smarty_tpl) {?><ul id='menu'>
        <li><a href="inicio"  >Início</a></li>
        <li></li>
        <li><a href="empresa" >Empresa</a>
		          <ul id="menu_produtos">
						    <li><a href="empresa/8/quem_somos" >Quem Somos</a></li>
				    <li><a href="empresa/9/missao" >Missão</a></li>
				    <li><a href="empresa/11/valores" >Valores</a></li>
				    <li><a href="empresa/13/politica_de_qualidade" >Política de Qualidade</a></li>
				          </ul>
		        <li>
		<a href="produtos" >Produtos</a>
                    <ul id="menu_produtos">
								 	   <li><a href="empresa/bobinas" >Bobinas</a></li>
					 	   <li><a href="empresa/etiquetadoras" >Etiquetadoras</a></li>
					 	   <li><a href="empresa/etiquetas" >Etiquetas</a></li>
					 	   <li><a href="empresa/etiquetas_comemorativas" >Etiquetas Comemorativas</a></li>
					 	   <li><a href="empresa/lacres" >Lacres</a></li>
					 	   <li><a href="empresa/rotulos" >Rótulos</a></li>
					 	   <li><a href="empresa/suprimentos" >Suprimentos</a></li>
					 	   <li><a href="empresa/tags" >Tags</a></li>
						       	  </ul>
		            
  		</li>
		<li><a href="promocoes">Promoções</a></li>
        <li><a href="representantes" >Representantes</a></li>
        <li><a href="noticias" >Notícias</a></li>
        <li><a href="dicas" >Dicas</a></li>
        <li><a href="downloads" >Downloads</a></li>
        <li><a href="contato" >Contato</a></li>
      </ul><?php }} ?>