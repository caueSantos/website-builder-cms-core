<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:32
         compiled from "core\templates\producao\abseg\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51225f53dee869a116-33301947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1642a8b40c54260719ad7eaddfd445275b5b6741' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\inicio\\banner.tpl',
      1 => 1599134336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51225f53dee869a116-33301947',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banners' => 0,
    'banner' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53dee87cc777_08135472',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53dee87cc777_08135472')) {function content_5f53dee87cc777_08135472($_smarty_tpl) {?><section id="banners">
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
"
"
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>

" target="_blank" class="text-white fz-18">
