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
<?php if ($_valid && !is_callable('content_5f90d976143f65_65956232')) {function content_5f90d976143f65_65956232($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['aspect']->value)===null||$tmp==='' ? '4-3' : $tmp), null, 0);?>
 <?php if ($_smarty_tpl->tpl_vars['fill_height']->value){?>fill-height<?php }?>" style="height: <?php echo $_smarty_tpl->tpl_vars['inner_height']->value;?>
">
<?php }?> <?php if (!$_smarty_tpl->tpl_vars['hide_bg']->value){?>bg-body<?php }?>">
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
"
imagens/indisponivel.png"