<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:32
         compiled from "core\templates\producao\abseg\site\blocos\solucoes\banner-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:325925f53dee8a0b5d0-36782804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c328fb36f7d49aa882a1a5b829d1108a2f6d8d2' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\solucoes\\banner-solucoes.tpl',
      1 => 1599323733,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '325925f53dee8a0b5d0-36782804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banner_solucoes' => 0,
    'banner' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53dee8a39912_88526417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53dee8a39912_88526417')) {function content_5f53dee8a39912_88526417($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['banner_solucoes']->value[0]){?>
 $_from = $_smarty_tpl->tpl_vars['banner_solucoes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
"
"
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>


solucoes/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Link_solucao_txf;?>
" class="btn-lands btn-accent btn-outline">