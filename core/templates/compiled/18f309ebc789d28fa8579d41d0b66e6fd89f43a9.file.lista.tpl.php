<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31050601b635fe51b30-99867704%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18f309ebc789d28fa8579d41d0b66e6fd89f43a9' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\lista.tpl',
      1 => 1612238569,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31050601b635fe51b30-99867704',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'vagas' => 0,
    'app' => 0,
    'vaga' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fe839f1_45527418',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fe839f1_45527418')) {function content_601b635fe839f1_45527418($_smarty_tpl) {?><div id="lista-vagas" class="lista-vagas pt-50 pt-md-70 pb-50 pb-md-80">


 $_from = $_smarty_tpl->tpl_vars['vagas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vaga']->key => $_smarty_tpl->tpl_vars['vaga']->value){
$_smarty_tpl->tpl_vars['vaga']->_loop = true;
?>
carreira/<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_url;?>
"
<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]->Caminho_txf;?>
"/>





