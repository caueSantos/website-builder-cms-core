<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 09:53:15
         compiled from "core\templates\producao\labcearensediagn\site\blocos\global\localizacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:270175f92c42bd56f74-51477045%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '872c653653e018189b08dd2799f03b5e0631f8c7' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\global\\localizacao.tpl',
      1 => 1603427009,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '270175f92c42bd56f74-51477045',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'enderecos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f92c42bdeaf16_01627463',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c42bdeaf16_01627463')) {function content_5f92c42bdeaf16_01627463($_smarty_tpl) {?><section id="localizacao">
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>
" width="100%" frameborder="0"
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_sel;?>
&output=embed"
 -
,
 -
<?php if ($_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf){?>,<?php }?>
<?php }?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Numero_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf;?>
"