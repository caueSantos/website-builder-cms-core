<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 14:26:46
         compiled from "core\templates\producao\diagnostico\site\componentes\galeria_imagens_carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:147145f64edd6e08ae8-82127479%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17b7518eba498f9fc0c61f35e0ed6ce1974b4431' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\componentes\\galeria_imagens_carousel.tpl',
      1 => 1599991170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '147145f64edd6e08ae8-82127479',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'itens' => 0,
    'nav' => 0,
    'dots' => 0,
    'imagens' => 0,
    'id' => 0,
    'pagination' => 0,
    'item_class' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64edd6e55149_27090909',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64edd6e55149_27090909')) {function content_5f64edd6e55149_27090909($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['itens']->value)===null||$tmp==='' ? '1-2-4' : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['nav'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['nav']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['dots'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['dots']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable(('galeria-imagem-').(uniqid()), null, 0);?><?php if ($_smarty_tpl->tpl_vars['imagens']->value[0]){?><div class="galeria" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">  <div class="owl-carousel carousel-galeria"       data-owl-carousel       data-rwd="<?php echo $_smarty_tpl->tpl_vars['itens']->value;?>
"       data-owl-loop="true"       data-owl-autoplay="true"       data-owl-autoplay-timeout="6000"       data-owl-margin="30"       data-owl-dots="<?php if ($_smarty_tpl->tpl_vars['pagination']->value){?>true<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['dots']->value;?>
<?php }?>"       data-owl-nav="<?php echo $_smarty_tpl->tpl_vars['nav']->value;?>
"       data-owl-dots-container="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-dots"       data-dot-class="owl-dot col-lg"       data-owl-nav-text="@icon:fas fa-chevron-left@ Anterior--Próximo @icon:fas fa-chevron-right@"       data-owl-nav-container="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-nav"       data-owl-dots-each="1"  >    <?php  $_smarty_tpl->tpl_vars['imagem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['imagem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['imagens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imagem']->key => $_smarty_tpl->tpl_vars['imagem']->value){
$_smarty_tpl->tpl_vars['imagem']->_loop = true;
?>    <div class="item">      <a class="aspect aspect-3-2 d-block fancybox hover hover-opacity <?php echo $_smarty_tpl->tpl_vars['item_class']->value;?>
"         href="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"         data-fancybox="galeria-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"      >        <figure class="imagem aspect-item">          <img itemprop="image" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"               alt="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
" class="img-fit"/>        </figure>      </a>    </div>    <?php } ?>  </div>  <div class="carousel-super-nav mx-auto">    <?php if ($_smarty_tpl->tpl_vars['pagination']->value){?>    <div class="owl-nav mt-50 d-flex">      <div class="flex-grow-1">        <div class="owl-dots row no-gutters v-meio pl-40 pr-40">        </div>      </div>    </div>    <?php }?>    <?php if ($_smarty_tpl->tpl_vars['dots']->value&&!$_smarty_tpl->tpl_vars['pagination']->value){?>    <div class="rounded-dots d-block text-center mt-30">      <div class="owl-dots fz-18"></div>    </div>    <?php }?>  </div></div><?php }?><?php }} ?>