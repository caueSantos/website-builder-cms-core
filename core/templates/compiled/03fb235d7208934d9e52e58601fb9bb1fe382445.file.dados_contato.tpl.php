<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 00:42:58
         compiled from "core\templates\producao\vet_life\site\blocos\contato\dados_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94955f8fa032a6d821-84243167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '03fb235d7208934d9e52e58601fb9bb1fe382445' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\contato\\dados_contato.tpl',
      1 => 1600061478,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94955f8fa032a6d821-84243167',
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
  'unifunc' => 'content_5f8fa032aa29c5_86961296',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8fa032aa29c5_86961296')) {function content_5f8fa032aa29c5_86961296($_smarty_tpl) {?><div class="dados">
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

