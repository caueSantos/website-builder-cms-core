<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:39
         compiled from "core\templates\producao\abseg\site\ajax\perguntas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:255825f50e9ab0df950-17457317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b8b5536a177a4a107f2bb42a6d9f917b87af7cb' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\ajax\\perguntas.tpl',
      1 => 1599137578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '255825f50e9ab0df950-17457317',
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
  'unifunc' => 'content_5f50e9ab0fea42_85692505',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9ab0fea42_85692505')) {function content_5f50e9ab0fea42_85692505($_smarty_tpl) {?><div id="perguntas-ajax">
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['perguntas']->value->registros; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pergunta']->key => $_smarty_tpl->tpl_vars['pergunta']->value){
$_smarty_tpl->tpl_vars['pergunta']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['pergunta']->key;
?>
"
</span>
"

