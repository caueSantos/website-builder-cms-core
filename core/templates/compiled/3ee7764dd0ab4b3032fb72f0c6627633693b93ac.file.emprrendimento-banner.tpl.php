<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 23:29:59
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\emprrendimento-banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208775ff11e1780e3f6-85153054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ee7764dd0ab4b3032fb72f0c6627633693b93ac' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\emprrendimento-banner.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208775ff11e1780e3f6-85153054',
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
  'unifunc' => 'content_5ff11e17841b06_85500735',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff11e17841b06_85500735')) {function content_5ff11e17841b06_85500735($_smarty_tpl) {?><section id="banner-empreendimentos" class="pt-40 pb-40 pt-lg-80 pb-lg-80">
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