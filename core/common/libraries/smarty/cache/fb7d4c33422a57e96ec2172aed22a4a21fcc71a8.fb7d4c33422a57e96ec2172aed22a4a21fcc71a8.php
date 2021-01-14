<?php /*%%SmartyHeaderCode:285391713511e7159815301-81507784%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb7d4c33422a57e96ec2172aed22a4a21fcc71a8' => 
    array (
      0 => 'fb7d4c33422a57e96ec2172aed22a4a21fcc71a8',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '285391713511e7159815301-81507784',
  'variables' => 
  array (
    'menu_institucional' => 0,
    'menu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_511e7159855bf5_53227479',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_511e7159855bf5_53227479')) {function content_511e7159855bf5_53227479($_smarty_tpl) {?><div id='rodape_a_titulo'>
      <ul>
        <li style="width:178px;">EMPRESA</li>
        <li style="width:150px; ">PRODUTOS</li>
        <li style="width:160px;">TRABALHE CONOSCO</li>
        <li style="width:115px;">REDES SOCIAIS</li>
        <li>INFORMATIVO</li>
      </ul>
    </div>
</div>
  <div id='rodape_a_conteudo'>
    <ul id='menu_rodape'>
				    <li><a href="empresa/8/quem_somos" >Quem Somos</a></li>
				    <li><a href="empresa/9/missao" >Missão</a></li>
				    <li><a href="empresa/11/valores" >Valores</a></li>
				    <li><a href="empresa/13/politica_de_qualidade" >Política de Qualidade</a></li>
		    </ul>
      <ul id='menu_rodape'>
      <li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Bobinas'); movetela('404'); return false" >Bobinas</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Etiquetadoras'); movetela('404'); return false" >Etiquetadoras</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Etiquetas'); movetela('404'); return false" >Etiquetas</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Etiquetas+Comemorativas'); movetela('404'); return false" >Etiquetas Comemorativas</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Lacres'); movetela('404'); return false" >Lacres</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=R%F3tulos'); movetela('404'); return false" >Rótulos</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Suprimentos'); movetela('404'); return false" >Suprimentos</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Tags'); movetela('404'); return false" >Tags</a></li>    </ul>
    <ul style="width:135px;" id='menu_rodape'>
      <li><a href='#'  onclick="ajax('#conteudo','trabalhe.php');" > » Envie seu Currículo</a></li>
      <li><a href='#'  onclick="ajax('#conteudo','trabalhe.php');" > » Seja um representante</a></li>
    </ul>
    <ul style="width:90px;" id='menu_rodape'>
      <li style="float:left; padding-left:5px;"><a href="#"><img src="imagens/twitter.png" width="30" height="30" border="0" /></a></li>
      <li style="float:left; padding-left:5px;"><a href="#"><img src="imagens/facebook.png" width="30" height="30" border="0" /></a></li>
    </ul>
  <!--  <ul id='menu_rodape_logo'>
    </ul>-->
    
    
    
    <ul style="width:280px;margin:0;padding-right:0;" id='menu_rodape'>


        <div id='inicio_caixa_info_texto'>Receba nossas novidades e promoções em seu e-mail:</div>
        <div id='inicio_caixa_info_campo'>
          <input type="text" onfocus="this.value = ''" onblur="if(this.value == ''){ this.value = 'Digite seu E-mail';}" value="Digite seu E-mail"  id='info' />
          <input type="button" id='bt_info' value='' onclick="verificaEmail()" />
          <div id='retorno_info'></div>
      </div>



    </ul>
    
    
    
    <div style="clear:both"></div>
    
  </div>
<div id='rodape_b'>
  <div id='cont_b'>
    <div onclick="location.href ='http://www.landsdigital.com.br'" id='credito'><img src="imagens/landsdigital.png" width="20" height="20" /></div>
    <div id='copy'> Art's Bobinas e Etiquetas © 2012 </div>
  </div>
</div>
  <div style="clear:both"></div><?php }} ?>