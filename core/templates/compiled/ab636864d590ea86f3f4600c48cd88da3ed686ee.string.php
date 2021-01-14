<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 06:38:51
         compiled from "ab636864d590ea86f3f4600c48cd88da3ed686ee" */ ?>
<?php /*%%SmartyHeaderCode:59085ff0311b9440f1-17475952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab636864d590ea86f3f4600c48cd88da3ed686ee' => 
    array (
      0 => 'ab636864d590ea86f3f4600c48cd88da3ed686ee',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '59085ff0311b9440f1-17475952',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff0311b993390_05656868',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff0311b993390_05656868')) {function content_5ff0311b993390_05656868($_smarty_tpl) {?> where Id_int is not null
<?php if ($_smarty_tpl->tpl_vars['requisicao']->value["oi"]){?>
 and Tipo_sel ='<?php echo $_smarty_tpl->tpl_vars['requisicao']->value["oi"];?>
'
<?php }?><?php }} ?>