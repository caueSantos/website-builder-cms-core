<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:48
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216665f90ff7cd2a010-15212115%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '017c8b7606b82137d4ad0b15d53f43810a78fbdb' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\inicio\\banner.tpl',
      1 => 1603330137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216665f90ff7cd2a010-15212115',
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
  'unifunc' => 'content_5f90ff7cd66c28_28837285',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7cd66c28_28837285')) {function content_5f90ff7cd66c28_28837285($_smarty_tpl) {?><section id="banners">
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>
"
"
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>



" target="_blank" class="text-white fz-12 ff-secondary fw-500">

#secao-contato-whats"