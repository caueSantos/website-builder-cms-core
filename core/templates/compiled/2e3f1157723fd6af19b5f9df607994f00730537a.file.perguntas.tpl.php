<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:28:47
         compiled from "core\templates\producao\hubvet\site\ajax\perguntas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10407600fa88f135c81-14421286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2e3f1157723fd6af19b5f9df607994f00730537a' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\ajax\\perguntas.tpl',
      1 => 1611638924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10407600fa88f135c81-14421286',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'perguntas' => 0,
    'key' => 0,
    'pergunta' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa88f15c1f4_89134427',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa88f15c1f4_89134427')) {function content_600fa88f15c1f4_89134427($_smarty_tpl) {?><div id="perguntas-ajax">
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['perguntas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pergunta']->key => $_smarty_tpl->tpl_vars['pergunta']->value){
$_smarty_tpl->tpl_vars['pergunta']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['pergunta']->key;
?>
"
</span>
"

