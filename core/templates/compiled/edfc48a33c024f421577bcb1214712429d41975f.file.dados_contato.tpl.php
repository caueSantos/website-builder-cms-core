<?php /* Smarty version Smarty-3.1.12, created on 2020-12-13 00:41:42
         compiled from "core\templates\producao\hubvet\site\blocos\contato\dados_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:275465fd57f66d3c677-39248177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edfc48a33c024f421577bcb1214712429d41975f' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\contato\\dados_contato.tpl',
      1 => 1604359743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '275465fd57f66d3c677-39248177',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'telefones' => 0,
    'telefone' => 0,
    'emails' => 0,
    'email' => 0,
    'whats' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd57f66d678f5_19730266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd57f66d678f5_19730266')) {function content_5fd57f66d678f5_19730266($_smarty_tpl) {?><div class="dados">
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['telefone']->key;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>

 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['emails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['email']->key;
?>

