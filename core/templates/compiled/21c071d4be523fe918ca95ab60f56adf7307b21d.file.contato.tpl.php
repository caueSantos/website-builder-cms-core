<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:44
         compiled from "core\templates\producao\abseg\site\contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:106145f50e9b09e80f1-48043429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21c071d4be523fe918ca95ab60f56adf7307b21d' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\contato.tpl',
      1 => 1599061942,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106145f50e9b09e80f1-48043429',
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
  'unifunc' => 'content_5f50e9b0a1a082_15313537',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9b0a1a082_15313537')) {function content_5f50e9b0a1a082_15313537($_smarty_tpl) {?><main id="contato">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('interna_contato','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('interna_contato','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap" class="pb-70">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-md-6 col-form text-center pt-40">          <h1 class="title fw-400 text-primary fz-32">            <?php echo titulo('interna_contato_form','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-14 lh-15">            <?php echo titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>          <div class="mt-30">            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/endereco.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/secao-corretor.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>