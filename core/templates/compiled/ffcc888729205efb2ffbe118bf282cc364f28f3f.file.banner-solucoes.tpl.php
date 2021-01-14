<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:32
         compiled from "core\templates\producao\abseg\site\blocos\inicio\banner-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207555f53dee89547a0-52117170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffcc888729205efb2ffbe118bf282cc364f28f3f' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\inicio\\banner-solucoes.tpl',
      1 => 1599072503,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207555f53dee89547a0-52117170',
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
  'unifunc' => 'content_5f53dee896e221_89364277',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53dee896e221_89364277')) {function content_5f53dee896e221_89364277($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['banner_solucoes']->value[0]){?><section id="banner-solucoes" class="pt-40 pt-md-70">  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/banner-solucoes.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</section><?php }?><?php }} ?>