<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:21
         compiled from "core\templates\producao\abseg\site\componentes\imagem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19625f50e9993c0402-18368487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ac471e911bb104dc54323a22a7744a5c35b8f83d' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\componentes\\imagem.tpl',
      1 => 1595876123,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19625f50e9993c0402-18368487',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'height' => 0,
    'radius' => 0,
    'fill_height' => 0,
    'no_bg' => 0,
    'figure_height' => 0,
    'imagem' => 0,
    'painel' => 0,
    'fluid' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9993eb493_32834187',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9993eb493_32834187')) {function content_5f50e9993eb493_32834187($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['height']->value){?><?php $_smarty_tpl->tpl_vars['height'] = new Smarty_variable(300, null, 0);?><?php }?><figure class="imagem-principal<?php if ($_smarty_tpl->tpl_vars['radius']->value){?> br-1<?php }?><?php if ($_smarty_tpl->tpl_vars['fill_height']->value){?> fill-height<?php }?><?php if (!$_smarty_tpl->tpl_vars['no_bg']->value){?> bg-body<?php }?>"style="height: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['figure_height']->value)===null||$tmp==='' ? 'auto' : $tmp);?>
">    <?php if ($_smarty_tpl->tpl_vars['imagem']->value){?>        <img height="<?php echo $_smarty_tpl->tpl_vars['height']->value;?>
" itemprop="image"             src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"             alt="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
"             class="mx-auto <?php if ($_smarty_tpl->tpl_vars['fluid']->value){?>img-fluid<?php }else{ ?>img-fit<?php }?> d-block <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-1<?php }?>"/>    <?php }else{ ?>        <img height="<?php echo $_smarty_tpl->tpl_vars['height']->value;?>
" itemprop="image"             src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel.png"             alt="Imagem indisponível" title="Imagem indisponível"             class="mx-auto <?php if ($_smarty_tpl->tpl_vars['fluid']->value){?>img-fluid<?php }else{ ?>img-fit<?php }?> d-block <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-1<?php }?>"/>    <?php }?></figure><?php }} ?>