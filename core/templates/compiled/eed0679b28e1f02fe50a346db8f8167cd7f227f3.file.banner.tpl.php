<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:318625ffd8a94414606-88585153%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eed0679b28e1f02fe50a346db8f8167cd7f227f3' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\banner.tpl',
      1 => 1610426739,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '318625ffd8a94414606-88585153',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banners' => 0,
    'banner' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9443fbc7_62785155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9443fbc7_62785155')) {function content_5ffd8a9443fbc7_62785155($_smarty_tpl) {?><section id="banners" class="bg-dark-grey text-white">
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
"
"
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"

" target="_blank" class="btn-lands btn-primary text-white">
