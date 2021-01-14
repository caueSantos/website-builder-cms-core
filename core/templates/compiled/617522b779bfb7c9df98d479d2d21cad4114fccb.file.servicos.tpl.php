<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 14:26:46
         compiled from "core\templates\producao\diagnostico\site\servicos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81695f64edd6775817-87845557%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '617522b779bfb7c9df98d479d2d21cad4114fccb' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\servicos.tpl',
      1 => 1600030785,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81695f64edd6775817-87845557',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'servicos' => 0,
    'CAMINHO_TPL' => 0,
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64edd67ace03_03456257',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64edd67ace03_03456257')) {function content_5f64edd67ace03_03456257($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['segment2']->value){?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('page_not_found.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php }else{ ?><main id="servicos">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('servicos_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('servicos_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap">    <div class="container mt-50 mb-50 mt-md-90 mb-md-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }?><?php }} ?>