<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\componentes\video-aspect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28341601b635fdf0664-61862920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4b96e323c45ca299f5d71a9734c072fbf9f39af' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\componentes\\video-aspect.tpl',
      1 => 1612116514,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28341601b635fdf0664-61862920',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aspect' => 0,
    'video' => 0,
    'radius' => 0,
    'fluid' => 0,
    'height' => 0,
    'hide_bg' => 0,
    'fill_height' => 0,
    'disponivel' => 0,
    'id' => 0,
    'inner_height' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fe41928_68093684',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fe41928_68093684')) {function content_601b635fe41928_68093684($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['aspect']->value)===null||$tmp==='' ? '4-3' : $tmp), null, 0);?>
 <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-<?php echo $_smarty_tpl->tpl_vars['radius']->value;?>
<?php }?> overflow-hidden <?php if (!$_smarty_tpl->tpl_vars['hide_bg']->value){?>bg-light-body<?php }?> <?php if ($_smarty_tpl->tpl_vars['fill_height']->value){?>fill-height<?php }?> d-block <?php if ($_smarty_tpl->tpl_vars['disponivel']->value){?>fancybox hover hover-opacity<?php }else{ ?>pe-none<?php }?>"
<?php }else{ ?>javascript:void(0);<?php }?>"
"
"
/mqdefault.jpg"
" title="<?php echo $_smarty_tpl->tpl_vars['video']->value->Descricao_txf;?>
"
imagens/indisponivel.png"