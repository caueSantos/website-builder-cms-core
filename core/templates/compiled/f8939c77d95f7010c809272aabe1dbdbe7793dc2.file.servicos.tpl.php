<?php /* Smarty version Smarty-3.1.12, created on 2020-11-01 20:54:29
         compiled from "core\templates\producao\zehimoveis\site\servicos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:299435f9f3ca5181d61-87324727%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8939c77d95f7010c809272aabe1dbdbe7793dc2' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\servicos.tpl',
      1 => 1600030785,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '299435f9f3ca5181d61-87324727',
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
  'unifunc' => 'content_5f9f3ca51c4944_07961754',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9f3ca51c4944_07961754')) {function content_5f9f3ca51c4944_07961754($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['segment2']->value){?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('page_not_found.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><?php }else{ ?><main id="servicos">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('servicos_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('servicos_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap">    <div class="container mt-50 mb-50 mt-md-90 mb-md-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }?><?php }} ?>