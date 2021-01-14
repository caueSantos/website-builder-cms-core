<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 13:29:16
         compiled from "core\templates\producao\diagnostico\site\contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53855f64e05c20c090-42849838%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df74632dd68bf981355acea6e418b4bbe20ac0d6' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\contato.tpl',
      1 => 1600348387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53855f64e05c20c090-42849838',
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
  'unifunc' => 'content_5f64e05c285188_87745355',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64e05c285188_87745355')) {function content_5f64e05c285188_87745355($_smarty_tpl) {?><main id="contato">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('interna_contato','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('interna_contato','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap" class="pb-60">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-md-10 pt-50 text-center text-md-left">          <div class="row">            <div class="col-md-4">              <h1 class="title fw-600 text-secondary fz-22">                <?php echo titulo('interna_contato_dados','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </h1>              <?php if (titulo('interna_contato_dados','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>              <div class="texto fz-16 lh-15">                <?php echo titulo('interna_contato_dados','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </div>              <?php }?>              <div class="mt-30">                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/dados_contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
              </div>            </div>            <div class="col-md-7 offset-md-1 mt-50 mt-md-0">              <h1 class="title fw-600 text-secondary fz-22">                <?php echo titulo('interna_contato_form','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </h1>              <?php if (titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>              <div class="texto fz-16 lh-15 mt-10">                <?php echo titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </div>              <?php }?>              <div class="mt-30">                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
              </div>            </div>          </div>        </div>      </div>    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>