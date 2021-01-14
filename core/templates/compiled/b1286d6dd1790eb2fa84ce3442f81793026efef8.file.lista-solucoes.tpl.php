<?php /* Smarty version Smarty-3.1.12, created on 2020-11-01 19:58:32
         compiled from "core\templates\producao\zehimoveis\site\blocos\inicio\lista-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214065f9f2f8896a859-24373353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b1286d6dd1790eb2fa84ce3442f81793026efef8' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\inicio\\lista-solucoes.tpl',
      1 => 1603328256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214065f9f2f8896a859-24373353',
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
  'unifunc' => 'content_5f9f2f889809d6_22278968',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9f2f889809d6_22278968')) {function content_5f9f2f889809d6_22278968($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?><section id="servicos" class="servicos-lista pt-50 pb-50 pb-md-70 pt-md-80 text-white bg-body-light">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8 text-center">        <div class="align-center">          <div class="title-group text-primary lh-12">            <?php if (titulo('secao_servicos','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="fz-14 tt-upper subtitle">              <?php echo titulo('secao_servicos','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <h1 class="title fz-40 fw-700">              <?php echo titulo('secao_servicos','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>          </div>        </div>      </div>    </div>    <div class="mt-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div></section><?php }?><?php }} ?>