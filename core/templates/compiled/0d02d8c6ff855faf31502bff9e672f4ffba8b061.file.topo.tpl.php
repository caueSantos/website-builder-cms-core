<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69175ffd8a949c81b9-58404268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d02d8c6ff855faf31502bff9e672f4ffba8b061' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\topo.tpl',
      1 => 1610319463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69175ffd8a949c81b9-58404268',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'assets' => 0,
    'cliente' => 0,
    'solucoes_controle_lista' => 0,
    'solucoes_oferecer_lista' => 0,
    'itens' => 0,
    'solucao' => 0,
    'app' => 0,
    'linguagens' => 0,
    'linguagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a94b71aa6_79492139',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a94b71aa6_79492139')) {function content_5ffd8a94b71aa6_79492139($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">
" class="d-block" title="<?php echo trans('menu_topo_logo_title');?>
">
imagens/logo-topo.png"
">
imagens/logo-topo-escuro.png"
">
"
"

"
"

 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>
<?php $_tmp1=ob_get_clean();?><?php echo gera_link(('solucoes#').($_tmp1),true);?>
">

"
"

"
"

 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>
<?php $_tmp2=ob_get_clean();?><?php echo gera_link(('cases#').($_tmp2),true);?>
">

"
"

 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>
<?php $_tmp3=ob_get_clean();?><?php echo gera_link(('conteudo#').($_tmp3),true);?>
">

" method="post">
 $_from = $_smarty_tpl->tpl_vars['linguagens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['linguagem']->key => $_smarty_tpl->tpl_vars['linguagem']->value){
$_smarty_tpl->tpl_vars['linguagem']->_loop = true;
?>
"
" width="24px" height="17px"/>
