<?php /* Smarty version Smarty-3.1.12, created on 2020-09-14 02:19:11
         compiled from "core\templates\producao\diagnostico\site\blocos\contato\endereco.tpl" */ ?>
<?php /*%%SmartyHeaderCode:260325f5efd4f086b20-66662879%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6efff318e0dd791ac8e9231544da34f9f45d57d5' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\contato\\endereco.tpl',
      1 => 1599114964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260325f5efd4f086b20-66662879',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'paginas' => 0,
    'titulos' => 0,
    'enderecos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5efd4f0b3f31_60080664',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5efd4f0b3f31_60080664')) {function content_5f5efd4f0b3f31_60080664($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['paginas'] = new Smarty_variable(array('contato','ouvidoria'), null, 0);?>
</h1>

 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>
" width="100%" height="480px" frameborder="0"
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_sel;?>
&output=embed"