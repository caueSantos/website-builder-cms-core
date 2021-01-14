<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:49
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\global\contato_secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:306355f90ff7d7dfec6-09793163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c06698b45d35ea0ca05fe1ca07068f85de186a92' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\global\\contato_secao.tpl',
      1 => 1603328371,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '306355f90ff7d7dfec6-09793163',
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
  'unifunc' => 'content_5f90ff7d7f0fe1_54469904',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7d7f0fe1_54469904')) {function content_5f90ff7d7f0fe1_54469904($_smarty_tpl) {?><section id="contato" class="text-center bg-body-light pt-50 pb-50 pt-md-60 pb-md-80">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-8">        <div class="title-group">          <div class="fz-14 tt-upper subtitle text-primary">            Entre em          </div>          <h1 class="title fz-40 fw-700 text-primary">            <?php echo titulo('secao_contato','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('secao_contato','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-5">            <?php echo titulo('secao_contato','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>      </div>    </div>    <div class="row justify-content-center mt-30">      <div class="col-12 col-md-6">        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }} ?>