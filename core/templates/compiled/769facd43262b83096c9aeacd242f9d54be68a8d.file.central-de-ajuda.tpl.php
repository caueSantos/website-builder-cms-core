<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:50:19
         compiled from "core\templates\producao\hubvet\site\central-de-ajuda.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27943601b6efbf178c7-32309299%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '769facd43262b83096c9aeacd242f9d54be68a8d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\central-de-ajuda.tpl',
      1 => 1612407521,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27943601b6efbf178c7-32309299',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6efbf2e611_92171279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6efbf2e611_92171279')) {function content_601b6efbf2e611_92171279($_smarty_tpl) {?><main id="central">  <div id="wrap" class="pb-50 pb-md-80">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/pesquisa.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/base.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/materiais-horizontal-secao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/perguntas.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>