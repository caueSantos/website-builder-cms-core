<?php /* Smarty version Smarty-3.1.12, created on 2020-10-18 19:20:56
         compiled from "core\templates\producao\vet_life\site\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153875f8cb1b8065fd8-42143519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12a4ac07d2a927146caea46525edf66a54057c4a' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\sobre.tpl',
      1 => 1599987667,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153875f8cb1b8065fd8-42143519',
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
  'unifunc' => 'content_5f8cb1b80a2744_54366688',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8cb1b80a2744_54366688')) {function content_5f8cb1b80a2744_54366688($_smarty_tpl) {?><main id="sobre">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('sobre_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('sobre_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/sobre.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/mvv.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/galeria_imagens.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/sobre/galeria_videos.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>