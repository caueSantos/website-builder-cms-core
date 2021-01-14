<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:21
         compiled from "core\templates\producao\abseg\site\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39985f50e9990dd6f4-73336062%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '643462bee826d862b0c60256b36ae4ab0e9242dc' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\sobre.tpl',
      1 => 1599059133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39985f50e9990dd6f4-73336062',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9990fcc60_07051702',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9990fcc60_07051702')) {function content_5f50e9990fcc60_07051702($_smarty_tpl) {?><main id="sobre">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable('Quem <strong>somos</strong>', null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable('Saiba um pouco mais sobre nós', null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/mvv.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/secao-corretor.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>