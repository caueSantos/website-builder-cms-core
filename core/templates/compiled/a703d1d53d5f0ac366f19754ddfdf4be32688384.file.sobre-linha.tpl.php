<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:39
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-linha.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27747601b6357e39974-11834109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a703d1d53d5f0ac366f19754ddfdf4be32688384' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-linha.tpl',
      1 => 1612120894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27747601b6357e39974-11834109',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_linha_tempo' => 0,
    'titulos' => 0,
    'linha' => 0,
    'key' => 0,
    'linha_count' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6357e66969_16077780',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6357e66969_16077780')) {function content_601b6357e66969_16077780($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_linha_tempo']->value[0]){?>


 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_linha_tempo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['linha']->key => $_smarty_tpl->tpl_vars['linha']->value){
$_smarty_tpl->tpl_vars['linha']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['linha']->key;
?>



<?php echo $_smarty_tpl->tpl_vars['linha']->value->Imagens[0]->Caminho_txf;?>
" style="max-height: 60px; max-width: 100%"/>