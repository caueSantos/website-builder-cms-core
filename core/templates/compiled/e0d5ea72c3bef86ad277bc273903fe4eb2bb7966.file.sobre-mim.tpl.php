<?php /* Smarty version Smarty-3.1.12, created on 2021-01-10 20:11:25
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-mim.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262385ffb7b8d4cdb48-98754974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0d5ea72c3bef86ad277bc273903fe4eb2bb7966' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-mim.tpl',
      1 => 1604744351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262385ffb7b8d4cdb48-98754974',
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
  'unifunc' => 'content_5ffb7b8d527d25_74136478',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffb7b8d527d25_74136478')) {function content_5ffb7b8d527d25_74136478($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_mim']->value[0]){?>
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Imagens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imagem']->key => $_smarty_tpl->tpl_vars['imagem']->value){
$_smarty_tpl->tpl_vars['imagem']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['imagem']->key;
?>
 bg-fake">
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
" class="d-block ml-auto" style="max-height: 100%; height: 100%;"/>


