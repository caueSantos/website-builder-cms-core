<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:39
         compiled from "core\templates\producao\abseg\site\blocos\cotacao\form_cotacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181625f53deef59b218-38127113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2114a151193e705df7453a872de7146253ec3284' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\cotacao\\form_cotacao.tpl',
      1 => 1599130540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181625f53deef59b218-38127113',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'layout' => 0,
    'cols' => 0,
    'estados_civis' => 0,
    'estado' => 0,
    'solucoes' => 0,
    'solucoes_lista' => 0,
    'solucao' => 0,
    'app' => 0,
    'emails' => 0,
    'pagina_atual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53deef651d48_99516053',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53deef651d48_99516053')) {function content_5f53deef651d48_99516053($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['layout']->value==2){?><?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable('col-12 col-md-6', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable('col-12', null, 0);?><?php }?>
">
 $_from = $_smarty_tpl->tpl_vars['estados_civis']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['estado']->key => $_smarty_tpl->tpl_vars['estado']->value){
$_smarty_tpl->tpl_vars['estado']->_loop = true;
?>
">

">
">
 $_from = $_smarty_tpl->tpl_vars['solucoes_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>
" value="<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
">

" name="Lands_id" type="hidden"/>
"/>-->
