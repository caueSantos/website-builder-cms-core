<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\inicio\emprrendimento-banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:317505fd2df4a3a82c1-67323047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b017ecfb9c9f23aa54b3c3736b5838f4186383b' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\inicio\\emprrendimento-banner.tpl',
      1 => 1604744351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '317505fd2df4a3a82c1-67323047',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'empreendimentos' => 0,
    'empreendimento' => 0,
    'app' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a3cff36_85512995',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a3cff36_85512995')) {function content_5fd2df4a3cff36_85512995($_smarty_tpl) {?><section id="banner-empreendimentos" class="pt-40 pb-40 pt-lg-80 pb-lg-80">
imagens/fundo-empreendimentos-inicio.png"/>
 $_from = $_smarty_tpl->tpl_vars['empreendimentos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['empreendimento']->key => $_smarty_tpl->tpl_vars['empreendimento']->value){
$_smarty_tpl->tpl_vars['empreendimento']->_loop = true;
?>


empreendimentos/<?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Nome_url;?>
"
"
"
"/>