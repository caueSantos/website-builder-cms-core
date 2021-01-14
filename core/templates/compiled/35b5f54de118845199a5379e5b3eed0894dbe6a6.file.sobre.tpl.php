<?php /* Smarty version Smarty-3.1.12, created on 2020-12-12 05:44:17
         compiled from "core\templates\producao\hubvet\site\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:231975fd474d13aacf4-16068495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35b5f54de118845199a5379e5b3eed0894dbe6a6' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\sobre.tpl',
      1 => 1604357259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '231975fd474d13aacf4-16068495',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd474d13c0763_57491122',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd474d13c0763_57491122')) {function content_5fd474d13c0763_57491122($_smarty_tpl) {?><main id="sobre">  <div id="wrap" class="pb-50">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-mim.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-carreira.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-referencia.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/equipe.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>