<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 17:49:42
         compiled from "c1bd090b550c0e2fd53fe1ba617d117023e0ac87" */ ?>
<?php /*%%SmartyHeaderCode:2862660107256234bb0-91806780%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '2862660107256234bb0-91806780',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_60107256235b38_92750873',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60107256235b38_92750873')) {function content_60107256235b38_92750873($_smarty_tpl) {?> where Id_int is not null and Data_inicio_dat <= now() and Data_fim_dat >= now() and Ativo_sel='SIM'<?php }} ?>