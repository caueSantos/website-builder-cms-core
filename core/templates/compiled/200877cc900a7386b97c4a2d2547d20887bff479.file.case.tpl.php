<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:07:05
         compiled from "core\templates\producao\hubvet\site\blocos\cases\interna\case.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15320600f9569519ce5-92559374%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '200877cc900a7386b97c4a2d2547d20887bff479' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\interna\\case.tpl',
      1 => 1611466495,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15320600f9569519ce5-92559374',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'case_interna' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f9569545fa5_29967207',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f9569545fa5_29967207')) {function content_600f9569545fa5_29967207($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['case'] = new Smarty_variable($_smarty_tpl->tpl_vars['case_interna']->value[0], null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/interna/banner.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/interna/citacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cases/interna/descricao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/gestao-secao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>