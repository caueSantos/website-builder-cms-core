<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:26:17
         compiled from "core\templates\producao\hubvet\site\ajax\orientacoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:72600fa7f91de1a8-03485532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '355e31b655c49ab5956979eaf33a2f38ea83b04e' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\ajax\\orientacoes.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '72600fa7f91de1a8-03485532',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orientacoes' => 0,
    'item' => 0,
    'fundo' => 0,
    'painel' => 0,
    'assets' => 0,
    'icone' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa7f921df58_23496174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa7f921df58_23496174')) {function content_600fa7f921df58_23496174($_smarty_tpl) {?><div id="orientacoes-ajax">
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orientacoes']->value->registros; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
<?php echo $_smarty_tpl->tpl_vars['fundo']->value[0]->Caminho_txf;?>
"/>
imagens/caminhao.jpg"/>
"
<?php echo $_smarty_tpl->tpl_vars['icone']->value[0]->Caminho_txf;?>
"
</div>
</div>
"

"
