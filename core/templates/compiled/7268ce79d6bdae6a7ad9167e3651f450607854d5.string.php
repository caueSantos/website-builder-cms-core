<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:03
         compiled from "7268ce79d6bdae6a7ad9167e3651f450607854d5" */ ?>
<?php /*%%SmartyHeaderCode:4735ffd8a93f0c1d2-58189762%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7268ce79d6bdae6a7ad9167e3651f450607854d5' => 
    array (
      0 => '7268ce79d6bdae6a7ad9167e3651f450607854d5',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '4735ffd8a93f0c1d2-58189762',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a93f20755_35205687',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a93f20755_35205687')) {function content_5ffd8a93f20755_35205687($_smarty_tpl) {?> where Ativo_sel='SIM'

<?php if ($_smarty_tpl->tpl_vars['requisicao']->value['persona']){?>
 and FIND_IN_SET('<?php echo $_smarty_tpl->tpl_vars['requisicao']->value['persona'];?>
', Labels_hid)
<?php }?><?php }} ?>