<?php /* Smarty version Smarty-3.1.12, created on 2020-09-17 10:48:45
         compiled from "core\templates\producao\diagnostico\site\exames.tpl" */ ?>
<?php /*%%SmartyHeaderCode:219245f63693d512b44-94110755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e743e1bf588590e74929c23f95b35ea5869bb710' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\exames.tpl',
      1 => 1600349719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219245f63693d512b44-94110755',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'labcloud_config' => 0,
    'x_api_key' => 0,
    'x_lab_id' => 0,
    'headers' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'segment2' => 0,
    'todas_categorias' => 0,
    'categoria' => 0,
    'i' => 0,
    'exames_categorias' => 0,
    'exames' => 0,
    'exame' => 0,
    'segment3' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f63693d5a1a84_07111034',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f63693d5a1a84_07111034')) {function content_5f63693d5a1a84_07111034($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['x_api_key'] = new Smarty_variable($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Chave_api_txf, null, 0);?>

 $_from = $_smarty_tpl->tpl_vars['todas_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
"
"

 $_from = $_smarty_tpl->tpl_vars['exames_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
 $_from = $_smarty_tpl->tpl_vars['exames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exame']->key => $_smarty_tpl->tpl_vars['exame']->value){
$_smarty_tpl->tpl_vars['exame']->_loop = true;
?>
">
</div>
</div>



 dia(s)
"
").click();