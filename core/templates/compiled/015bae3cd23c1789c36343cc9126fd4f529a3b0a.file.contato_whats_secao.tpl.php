<?php /* Smarty version Smarty-3.1.12, created on 2020-11-01 18:19:27
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\contato_whats_secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40475f9f184f0883e7-14971495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '015bae3cd23c1789c36343cc9126fd4f529a3b0a' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\contato_whats_secao.tpl',
      1 => 1603426152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40475f9f184f0883e7-14971495',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f9f184f09e6b7_05900847',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9f184f09e6b7_05900847')) {function content_5f9f184f09e6b7_05900847($_smarty_tpl) {?><section id="secao-contato-whats" class="text-center text-md-left secao-contato-whats text-white pt-20" style="background-color: #343434">

 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</li>
imagens/contato_secao.png" alt="Aparelho Celular"/>