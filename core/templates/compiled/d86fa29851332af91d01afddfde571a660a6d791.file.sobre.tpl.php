<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 14:23:39
         compiled from "core\templates\producao\diagnostico\site\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125815f64ed1bdb8180-25214348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd86fa29851332af91d01afddfde571a660a6d791' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\sobre.tpl',
      1 => 1599987667,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125815f64ed1bdb8180-25214348',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64ed1bde6da0_56156295',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64ed1bde6da0_56156295')) {function content_5f64ed1bde6da0_56156295($_smarty_tpl) {?><main id="sobre">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('sobre_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('sobre_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/mvv.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/galeria_imagens.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/galeria_videos.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>