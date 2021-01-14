<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 04:03:18
         compiled from "core\templates\producao\diagnostico\site\blocos\inicio\banner-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:251045f5dc4360d8789-12667477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9093c8bbd54d2d4abe0929417df323d76d18560' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\inicio\\banner-solucoes.tpl',
      1 => 1599072503,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '251045f5dc4360d8789-12667477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banner_solucoes' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5dc4360e0986_13300334',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5dc4360e0986_13300334')) {function content_5f5dc4360e0986_13300334($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['banner_solucoes']->value[0]){?><section id="banner-solucoes" class="pt-40 pt-md-70">  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/banner-solucoes.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</section><?php }?><?php }} ?>