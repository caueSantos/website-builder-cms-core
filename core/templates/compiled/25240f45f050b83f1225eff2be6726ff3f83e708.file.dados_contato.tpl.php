<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:04:01
         compiled from "core\templates\producao\zehimoveis\site\blocos\contato\dados_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201295fa646e1864576-40703602%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25240f45f050b83f1225eff2be6726ff3f83e708' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\contato\\dados_contato.tpl',
      1 => 1604359743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201295fa646e1864576-40703602',
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
  'unifunc' => 'content_5fa646e1890401_79410166',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa646e1890401_79410166')) {function content_5fa646e1890401_79410166($_smarty_tpl) {?><div class="dados">
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

