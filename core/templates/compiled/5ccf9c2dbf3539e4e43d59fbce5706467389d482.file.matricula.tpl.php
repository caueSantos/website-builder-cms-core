<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:55:05
         compiled from "core\templates\producao\abseg\site\email\matricula.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262405f53df098127a0-30819958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ccf9c2dbf3539e4e43d59fbce5706467389d482' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\email\\matricula.tpl',
      1 => 1599120502,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262405f53df098127a0-30819958',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'cliente' => 0,
    'campos' => 0,
    'nome' => 0,
    'campo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53df098fc310_82634797',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53df098fc310_82634797')) {function content_5f53df098fc310_82634797($_smarty_tpl) {?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
 </title>
,
</strong>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
 $_smarty_tpl->tpl_vars['nome'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['campos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['campo']->key => $_smarty_tpl->tpl_vars['campo']->value){
$_smarty_tpl->tpl_vars['campo']->_loop = true;
 $_smarty_tpl->tpl_vars['nome']->value = $_smarty_tpl->tpl_vars['campo']->key;
?>
:</td>
</td>