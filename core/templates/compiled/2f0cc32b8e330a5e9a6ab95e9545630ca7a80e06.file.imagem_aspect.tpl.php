<?php /* Smarty version Smarty-3.1.12, created on 2021-01-03 01:09:18
         compiled from "core\templates\producao\hubvet\site\componentes\imagem_aspect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:231885ff1355e5234c8-13243045%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f0cc32b8e330a5e9a6ab95e9545630ca7a80e06' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\componentes\\imagem_aspect.tpl',
      1 => 1604351639,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '231885ff1355e5234c8-13243045',
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
  'unifunc' => 'content_5ff1355e570037_68713834',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff1355e570037_68713834')) {function content_5ff1355e570037_68713834($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['aspect']->value)===null||$tmp==='' ? '4-3' : $tmp), null, 0);?>
 <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-<?php echo $_smarty_tpl->tpl_vars['radius']->value;?>
<?php }?> overflow-hidden <?php if (!$_smarty_tpl->tpl_vars['hide_bg']->value){?>bg-light-body<?php }?> <?php if ($_smarty_tpl->tpl_vars['fill_height']->value){?>fill-height<?php }?>" style="height: <?php echo $_smarty_tpl->tpl_vars['inner_height']->value;?>
">
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
"
imagens/indisponivel.png"