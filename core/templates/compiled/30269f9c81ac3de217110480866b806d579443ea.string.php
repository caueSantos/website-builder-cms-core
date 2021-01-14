<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 06:38:51
         compiled from "30269f9c81ac3de217110480866b806d579443ea" */ ?>
<?php /*%%SmartyHeaderCode:55545ff0311ba004f2-15421973%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30269f9c81ac3de217110480866b806d579443ea' => 
    array (
      0 => '30269f9c81ac3de217110480866b806d579443ea',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '55545ff0311ba004f2-15421973',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff0311ba09f61_59205804',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff0311ba09f61_59205804')) {function content_5ff0311ba09f61_59205804($_smarty_tpl) {?> where Ativo_sel='SIM'

<?php if ($_smarty_tpl->tpl_vars['requisicao']->value["persona"]){?>
 and FIND_IN_SET('<?php echo $_smarty_tpl->tpl_vars['requisicao']->value["persona"];?>
', Tags_hid)
<?php }?><?php }} ?>