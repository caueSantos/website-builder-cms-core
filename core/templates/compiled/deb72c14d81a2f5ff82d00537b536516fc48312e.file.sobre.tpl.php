<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203015ffd8a94612424-83760168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'deb72c14d81a2f5ff82d00537b536516fc48312e' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\sobre.tpl',
      1 => 1609723207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203015ffd8a94612424-83760168',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_inicio' => 0,
    'key' => 0,
    'painel' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9463e960_90212925',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9463e960_90212925')) {function content_5ffd8a9463e960_90212925($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_inicio']->value[0]){?>
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_inicio']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
" style="height: 300px; <?php if ($_smarty_tpl->tpl_vars['key']->value>0){?>display: none;<?php }?>">
<?php echo $_smarty_tpl->tpl_vars['item']->value->Imagens[0]->Caminho_txf;?>
"
"
 $_from = $_smarty_tpl->tpl_vars['sobre_inicio']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>


