<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:59:44
         compiled from "core\templates\producao\hubvet\site\blocos\contato\contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19508601b632079b647-52768297%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '733eeb7caea1ca7374d1ad5b691d5a436da459b5' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\contato\\contato.tpl',
      1 => 1612076505,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19508601b632079b647-52768297',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b63207a6423_39794791',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b63207a6423_39794791')) {function content_601b63207a6423_39794791($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tipo']->value)===null||$tmp==='' ? 0 : $tmp), null, 0);?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/form_contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>