<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:34
         compiled from "core\templates\producao\vet_life\site\blocos\inicio\lista-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79435f90d9762ae675-30659128%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e1c09326b81fbde7fce5c7218a49bf41a9227c87' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\inicio\\lista-solucoes.tpl',
      1 => 1603328256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79435f90d9762ae675-30659128',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servicos' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d9762c1a55_74495999',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d9762c1a55_74495999')) {function content_5f90d9762c1a55_74495999($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?><section id="servicos" class="servicos-lista pt-50 pb-50 pb-md-70 pt-md-80 text-white bg-body-light">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8 text-center">        <div class="align-center">          <div class="title-group text-primary lh-12">            <?php if (titulo('secao_servicos','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="fz-14 tt-upper subtitle">              <?php echo titulo('secao_servicos','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <h1 class="title fz-40 fw-700">              <?php echo titulo('secao_servicos','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>          </div>        </div>      </div>    </div>    <div class="mt-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div></section><?php }?><?php }} ?>