<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 13:29:16
         compiled from "core\templates\producao\diagnostico\site\blocos\contato\dados_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90205f64e05c688833-62520594%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11677e29b6c65894a43f228693c4af4305ac516e' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\contato\\dados_contato.tpl',
      1 => 1600061478,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90205f64e05c688833-62520594',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'enderecos' => 0,
    'endereco' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'emailsa' => 0,
    'email' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64e05c708c23_04223651',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64e05c708c23_04223651')) {function content_5f64e05c708c23_04223651($_smarty_tpl) {?><div class="dados">
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Bairro_txf;?>
<br/>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
,<br/>

 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>
 $_from = $_smarty_tpl->tpl_vars['emailsa']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
?>
 -

