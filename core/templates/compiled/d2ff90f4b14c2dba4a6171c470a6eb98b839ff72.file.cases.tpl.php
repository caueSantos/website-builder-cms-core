<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:00
         compiled from "core\templates\producao\hubvet\site\cases.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18435ffd8a902aeb07-07817186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2ff90f4b14c2dba4a6171c470a6eb98b839ff72' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\cases.tpl',
      1 => 1610425043,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18435ffd8a902aeb07-07817186',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'case_interna' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a902dd194_03375078',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a902dd194_03375078')) {function content_5ffd8a902dd194_03375078($_smarty_tpl) {?><main id="planos">  <div id="wrap">    <?php if ($_smarty_tpl->tpl_vars['segment2']->value){?>    <?php if ($_smarty_tpl->tpl_vars['case_interna']->value[0]){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/interna/case.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }else{ ?>    <?php echo redirect(gera_link('cases',true));?>
    <?php }?>    <?php }?>    <?php if (!$_smarty_tpl->tpl_vars['segment2']->value){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/banner.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/destaque.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/cases-lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }?>  </div></main><?php }} ?>