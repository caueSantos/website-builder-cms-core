<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 16:14:19
         compiled from "core\templates\producao\diagnostico\site\blocos\solucoes\banner-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50495f5e6f8bebc523-40004090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa350de6e84aab71871932a433453602690bda81' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\solucoes\\banner-solucoes.tpl',
      1 => 1599323733,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50495f5e6f8bebc523-40004090',
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
  'unifunc' => 'content_5f5e6f8beec234_41322682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5e6f8beec234_41322682')) {function content_5f5e6f8beec234_41322682($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['banner_solucoes']->value[0]){?>
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