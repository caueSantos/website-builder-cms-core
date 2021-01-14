<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 04:54:53
         compiled from "core\templates\producao\diagnostico\site\solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:309625f5dd04d0d3af5-98748377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3fb6513852d486b1b143576dce126bbbe9dfd561' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\solucoes.tpl',
      1 => 1599083702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309625f5dd04d0d3af5-98748377',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'solucoes' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5dd04d109c83_36215749',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5dd04d109c83_36215749')) {function content_5f5dd04d109c83_36215749($_smarty_tpl) {?><main id="niveis-de-ensino">  <?php if (!$_smarty_tpl->tpl_vars['segment2']->value){?>  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('solucoes_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('solucoes_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php }?>  <div id="wrap">    <?php if ($_smarty_tpl->tpl_vars['segment2']->value){?>    <?php if ($_smarty_tpl->tpl_vars['solucoes']->value[0]){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }else{ ?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('page_not_found.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }?>    <?php }else{ ?>    <div class="mt-40">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/banner-solucoes.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>    <div class="container mt-90">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>    <?php }?>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/secao-corretor.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>