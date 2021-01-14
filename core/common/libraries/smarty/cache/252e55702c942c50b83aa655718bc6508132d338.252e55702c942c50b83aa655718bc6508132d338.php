<?php /*%%SmartyHeaderCode:1264517903511e1745749cc1-29020268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '252e55702c942c50b83aa655718bc6508132d338' => 
    array (
      0 => '252e55702c942c50b83aa655718bc6508132d338',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '1264517903511e1745749cc1-29020268',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_511e17457551a5_02491381',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_511e17457551a5_02491381')) {function content_511e17457551a5_02491381($_smarty_tpl) {?><ul id='menu'>
        <li><a href="#" onclick="ajax('#conteudo','inicio.php'); return false"  >Início</a></li>
        <li></li>
        <li><a href="#" onclick="ajax('#conteudo','empresa.php'); movetela('404'); return false" >Empresa</a>
          <ul id='menu_produtos'>
            <li><a href='#' onclick="ajax('#conteudo','empresa.php?id=8'); movetela('404'); return false" >Quem Somos</a></li><li><a href='#' onclick="ajax('#conteudo','empresa.php?id=9'); movetela('404'); return false" >Missão</a></li><li><a href='#' onclick="ajax('#conteudo','empresa.php?id=11'); movetela('404'); return false" >Valores</a></li><li><a href='#'  onclick="ajax('#conteudo','empresa.php?id=13'); movetela('404'); return false" >Política de Qualidade</a></li>          </ul>
        </li>
        <li><a href="#" onclick="ajax('#conteudo','produtos.php'); movetela('404'); return false" >Produtos</a>
          <ul id='menu_produtos'>
            <li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Bobinas'); movetela('404'); return false" >Bobinas</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Etiquetadoras'); movetela('404'); return false" >Etiquetadoras</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Etiquetas'); movetela('404'); return false" >Etiquetas</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Etiquetas+Comemorativas'); movetela('404'); return false" >Etiquetas Comemorativas</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Lacres'); movetela('404'); return false" >Lacres</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=R%F3tulos'); movetela('404'); return false" >Rótulos</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Suprimentos'); movetela('404'); return false" >Suprimentos</a></li><li><a href='#' onclick="ajax('#conteudo','produtos.php?filtro_categoria=Tags'); movetela('404'); return false" >Tags</a></li>          </ul>
        
		
		<li><a onclick="ajax('#conteudo','promocoes.php'); movetela('404'); return false" href="#">Promoções</a></li>
        <li><a onclick="ajax('#conteudo','representantes.php'); movetela('404'); return false" href="#">Representantes</a></li>
        <li><a onclick="ajax('#conteudo','noticias.php'); movetela('404'); return false" href="#">Notícias</a></li>
        <li><a onclick="ajax('#conteudo','dicas.php'); movetela('404'); return false" href="#">Dicas</a></li>
        <li><a onclick="ajax('#conteudo','downloads.php'); movetela('404'); return false" href="#">Downloads</a></li>
        <li><a onclick="ajax('#conteudo','contato.php'); movetela('404'); return false" href="#">Contato</a></li>
      </ul><?php }} ?>