<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:00:14
         compiled from "core\templates\producao\zehimoveis\site\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16355fa645fe674125-25008039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '662fdbb103aae14f02a52154710f9152a462d5f3' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\sobre.tpl',
      1 => 1604357259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16355fa645fe674125-25008039',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa645fe68df73_57643724',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa645fe68df73_57643724')) {function content_5fa645fe68df73_57643724($_smarty_tpl) {?><main id="sobre">  <div id="wrap" class="pb-50">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-mim.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-carreira.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-referencia.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/equipe.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>