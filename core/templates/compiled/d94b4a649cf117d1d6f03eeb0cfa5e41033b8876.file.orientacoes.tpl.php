<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:38
         compiled from "core\templates\producao\abseg\site\ajax\orientacoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:285785f50e9aad43d43-48198132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd94b4a649cf117d1d6f03eeb0cfa5e41033b8876' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\ajax\\orientacoes.tpl',
      1 => 1599130023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285785f50e9aad43d43-48198132',
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
  'unifunc' => 'content_5f50e9aad830a3_87401786',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9aad830a3_87401786')) {function content_5f50e9aad830a3_87401786($_smarty_tpl) {?><div id="orientacoes-ajax">
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
