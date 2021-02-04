<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\carreira.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29376601b635fcd8b50-82551167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d8edbc7df6a80131c0b35f3695a7c2eeec4029d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\carreira.tpl',
      1 => 1612238714,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29376601b635fcd8b50-82551167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'vaga_interna' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fcff285_38811464',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fcff285_38811464')) {function content_601b635fcff285_38811464($_smarty_tpl) {?><main id="carreira" itemprop="mainContentOfPage">  <div id="wrap">    <?php if ($_smarty_tpl->tpl_vars['segment2']->value){?>    <?php if ($_smarty_tpl->tpl_vars['vaga_interna']->value[0]){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/interna/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }else{ ?>    <?php echo redirect(gera_link('carreira',true));?>
    <?php }?>    <?php }?>    <?php if (!$_smarty_tpl->tpl_vars['segment2']->value){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/carreira-titulo.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/carreira-parte.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/carreira-proposta.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }?>  </div></main><?php }} ?>