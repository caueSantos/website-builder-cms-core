<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:00:14
         compiled from "core\templates\producao\zehimoveis\site\blocos\sobre\sobre-mim.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47045fa645fe6a3923-98357518%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb7f5c3d8ce606a84844a0b424a1ec6dbc0e0810' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\sobre\\sobre-mim.tpl',
      1 => 1604732127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47045fa645fe6a3923-98357518',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_mim' => 0,
    'key' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa645fe6d7054_83061426',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa645fe6d7054_83061426')) {function content_5fa645fe6d7054_83061426($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_mim']->value[0]){?>
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Imagens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imagem']->key => $_smarty_tpl->tpl_vars['imagem']->value){
$_smarty_tpl->tpl_vars['imagem']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['imagem']->key;
?>
 bg-fake">
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
" class="d-block ml-auto" style="max-height: 100%; height: 100%;"/>


