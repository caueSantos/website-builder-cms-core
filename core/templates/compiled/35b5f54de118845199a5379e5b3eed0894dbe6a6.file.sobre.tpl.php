<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:39
         compiled from "core\templates\producao\hubvet\site\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28385601b6357cd5ee9-51557547%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35b5f54de118845199a5379e5b3eed0894dbe6a6' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\sobre.tpl',
      1 => 1612156525,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28385601b6357cd5ee9-51557547',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6357cf35d5_99980384',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6357cf35d5_99980384')) {function content_601b6357cf35d5_99980384($_smarty_tpl) {?><main id="sobre">  <div id="wrap" class="pb-50">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-titulo.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-missao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-jornada.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre-linha.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/equipe.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/parceiros/parceiros-depoimentos.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>