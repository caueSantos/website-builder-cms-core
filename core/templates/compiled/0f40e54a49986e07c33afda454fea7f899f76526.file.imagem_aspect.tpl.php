<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:34
         compiled from "core\templates\producao\vet_life\site\componentes\imagem_aspect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208065f90d9760f8f86-86057683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f40e54a49986e07c33afda454fea7f899f76526' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\componentes\\imagem_aspect.tpl',
      1 => 1603060864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208065f90d9760f8f86-86057683',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aspect' => 0,
    'imagem' => 0,
    'radius' => 0,
    'fluid' => 0,
    'height' => 0,
    'hide_bg' => 0,
    'fill_height' => 0,
    'inner_height' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d976143f65_65956232',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d976143f65_65956232')) {function content_5f90d976143f65_65956232($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['aspect']->value)===null||$tmp==='' ? '4-3' : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['imagem']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['radius']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['fluid'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['fluid']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['height'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['height']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['hide_bg'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['hide_bg']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php if ($_smarty_tpl->tpl_vars['height']->value){?><?php if ($_smarty_tpl->tpl_vars['height']->value=='fill'){?><?php $_smarty_tpl->tpl_vars['inner_height'] = new Smarty_variable('auto', null, 0);?><?php $_smarty_tpl->tpl_vars['fill_height'] = new Smarty_variable(true, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['inner_height'] = new Smarty_variable($_smarty_tpl->tpl_vars['height']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['fill_height'] = new Smarty_variable(false, null, 0);?><?php }?><?php }?><div class="aspect aspect-<?php echo $_smarty_tpl->tpl_vars['aspect']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['fill_height']->value){?>fill-height<?php }?>" style="height: <?php echo $_smarty_tpl->tpl_vars['inner_height']->value;?>
">  <figure class="imagem aspect-item overflow-hidden <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-<?php echo $_smarty_tpl->tpl_vars['radius']->value;?>
<?php }?> <?php if (!$_smarty_tpl->tpl_vars['hide_bg']->value){?>bg-body<?php }?>">    <?php if ($_smarty_tpl->tpl_vars['imagem']->value){?>    <img itemprop="image"         src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"         alt="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
"         class="mx-auto <?php if ($_smarty_tpl->tpl_vars['fluid']->value){?>img-fluid<?php }else{ ?>img-fit<?php }?> d-block <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-1<?php }?>"    />    <?php }else{ ?>    <img itemprop="image"         src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel.png"         alt="Imagem indisponível" title="Imagem indisponível"         class="mx-auto <?php if ($_smarty_tpl->tpl_vars['fluid']->value){?>img-fluid<?php }else{ ?>img-fit<?php }?> d-block"    />    <?php }?>  </figure></div><?php }} ?>