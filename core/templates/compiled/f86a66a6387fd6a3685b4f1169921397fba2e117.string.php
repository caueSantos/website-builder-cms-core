<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 23:29:59
         compiled from "f86a66a6387fd6a3685b4f1169921397fba2e117" */ ?>
<?php /*%%SmartyHeaderCode:296845ff11e1733ac16-52660329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f86a66a6387fd6a3685b4f1169921397fba2e117' => 
    array (
      0 => 'f86a66a6387fd6a3685b4f1169921397fba2e117',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '296845ff11e1733ac16-52660329',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff11e1734c448_24986984',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff11e1734c448_24986984')) {function content_5ff11e1734c448_24986984($_smarty_tpl) {?> where Ativo_sel='SIM'

<?php if ($_smarty_tpl->tpl_vars['requisicao']->value['persona']){?>
 and FIND_IN_SET('<?php echo $_smarty_tpl->tpl_vars['requisicao']->value['persona'];?>
', Tags_hid)
<?php }?><?php }} ?>