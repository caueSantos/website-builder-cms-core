<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:49
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\global\localizacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:224705f90ff7d975541-44555633%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bcd474edc879bf987d9cec6806720e98ff0b977e' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\global\\localizacao.tpl',
      1 => 1603327580,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '224705f90ff7d975541-44555633',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'enderecos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff7d9b9fb8_68221273',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7d9b9fb8_68221273')) {function content_5f90ff7d9b9fb8_68221273($_smarty_tpl) {?><section id="localizacao">
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