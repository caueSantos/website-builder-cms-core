<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:29
         compiled from "core\templates\producao\hubvet\site\solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8800601b7ef582f1e4-90869881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fed1ba42ec66015ac4290e110360328cd8540ded' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\solucoes.tpl',
      1 => 1610265498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8800601b7ef582f1e4-90869881',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7ef584fca3_29170302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7ef584fca3_29170302')) {function content_601b7ef584fca3_29170302($_smarty_tpl) {?><main id="solucoes" itemprop="mainContentOfPage">  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/banner.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/controle.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/oferecer.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/visao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable(2, null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/parceiros/parceiros-lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/parceiros/parceiros-depoimentos.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>