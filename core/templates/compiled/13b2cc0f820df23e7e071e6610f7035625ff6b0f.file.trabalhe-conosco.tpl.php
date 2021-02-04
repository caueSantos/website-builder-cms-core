<?php /* Smarty version Smarty-3.1.12, created on 2021-02-02 00:29:38
         compiled from "core\templates\producao\hubvet\site\trabalhe-conosco.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77816018b9120705d1-78938821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13b2cc0f820df23e7e071e6610f7035625ff6b0f' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\trabalhe-conosco.tpl',
      1 => 1584564582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77816018b9120705d1-78938821',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6018b912087457_37816842',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6018b912087457_37816842')) {function content_6018b912087457_37816842($_smarty_tpl) {?><main id="trabalhe-conosco" itemprop="mainContentOfPage">    <div id="wrap">                        <?php if (!$_smarty_tpl->tpl_vars['segment2']->value){?>                        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/trabalhe-conosco/lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        <?php }else{ ?>                        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/trabalhe-conosco/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        <?php }?>    </div></main><?php }} ?>