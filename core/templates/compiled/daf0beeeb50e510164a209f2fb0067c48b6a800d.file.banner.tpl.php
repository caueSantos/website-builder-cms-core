<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63515fd2df4a298e01-12647127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'daf0beeeb50e510164a209f2fb0067c48b6a800d' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\inicio\\banner.tpl',
      1 => 1604789894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63515fd2df4a298e01-12647127',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'imoveis_banner' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a2cc336_05913869',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a2cc336_05913869')) {function content_5fd2df4a2cc336_05913869($_smarty_tpl) {?><section id="banners" class="pt-45 pb-60">



imoveis" class="text-primary text-secondary-hover fw-700">
imagens/fundo-banner.png" class="pe-none"
 $_from = $_smarty_tpl->tpl_vars['imoveis_banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
"
"
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>

imoveis/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Nome_url;?>
" target="_blank"