<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "c1bd090b550c0e2fd53fe1ba617d117023e0ac87" */ ?>
<?php /*%%SmartyHeaderCode:25498601b7f044243e8-32886581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1bd090b550c0e2fd53fe1ba617d117023e0ac87' => 
    array (
      0 => 'c1bd090b550c0e2fd53fe1ba617d117023e0ac87',
      1 => 0,
      2 => 'string',
    ),
  ),
  'nocache_hash' => '25498601b7f044243e8-32886581',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7f04425392_83439983',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04425392_83439983')) {function content_601b7f04425392_83439983($_smarty_tpl) {?> where Id_int is not null and Data_inicio_dat <= now() and Data_fim_dat >= now() and Ativo_sel='SIM'<?php }} ?>