<?php /*%%SmartyHeaderCode:210047892512fa1d895e018-46119394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '004d2b3658c43e84aee42b0f9cd0a70ac546f8ae' => 
    array (
      0 => '004d2b3658c43e84aee42b0f9cd0a70ac546f8ae',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '210047892512fa1d895e018-46119394',
  'variables' => 
  array (
    'menus_disponiveis' => 0,
    'value_menus' => 0,
    'menu_arr' => 0,
    'menu_institucional' => 0,
    'menu' => 0,
    'menu_produtos' => 0,
    'menu_prod' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_512fa1d8a08959_18982470',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_512fa1d8a08959_18982470')) {function content_512fa1d8a08959_18982470($_smarty_tpl) {?>									<ul id='menu'>
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
								 	   <li><a href="produtos/bobinas" >Bobinas</a></li>
					 	   <li><a href="produtos/etiquetadoras" >Etiquetadoras</a></li>
					 	   <li><a href="produtos/etiquetas" >Etiquetas</a></li>
					 	   <li><a href="produtos/etiquetas_comemorativas" >Etiquetas Comemorativas</a></li>
					 	   <li><a href="produtos/lacres" >Lacres</a></li>
					 	   <li><a href="produtos/ribbon" >RIBBON</a></li>
					 	   <li><a href="produtos/rotulos" >Rótulos</a></li>
					 	   <li><a href="produtos/suprimentos" >Suprimentos</a></li>
					 	   <li><a href="produtos/tags" >Tags</a></li>
						       	  </ul>
		            
  		</li>
		
  		<li><a href="promocoes">Promoções</a></li>
  
  
        <li><a href="representantes" >Representantes</a></li>
        <li><a href="noticias" >Notícias</a></li>
        <li><a href="dicas" >Dicas</a></li>
        <li><a href="downloads" >Downloads</a></li>
        <li><a href="contato" >Contato</a></li>
      </ul><?php }} ?>