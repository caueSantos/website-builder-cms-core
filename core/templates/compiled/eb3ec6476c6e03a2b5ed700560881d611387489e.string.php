<?php /* Smarty version Smarty-3.1.12, created on 2020-12-12 20:43:34
         compiled from "eb3ec6476c6e03a2b5ed700560881d611387489e" */ ?>
<?php /*%%SmartyHeaderCode:72515fd5479691f029-36109179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb3ec6476c6e03a2b5ed700560881d611387489e' => 
    array (
      0 => 'eb3ec6476c6e03a2b5ed700560881d611387489e',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '72515fd5479691f029-36109179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd54796927b45_25297968',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd54796927b45_25297968')) {function content_5fd54796927b45_25297968($_smarty_tpl) {?> where Ativo_sel='SIM'

<?php if ($_smarty_tpl->tpl_vars['requisicao']->value["oi"]){?>
 and FIND_IN_SET('<?php echo $_smarty_tpl->tpl_vars['requisicao']->value["persona"];?>
', Tags_hid)
<?php }?><?php }} ?>