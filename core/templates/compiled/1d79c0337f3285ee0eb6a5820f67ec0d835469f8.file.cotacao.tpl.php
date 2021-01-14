<?php /* Smarty version Smarty-3.1.12, created on 2020-09-11 10:09:27
         compiled from "core\templates\producao\diagnostico\site\cotacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129925f5b77070ec686-85735156%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d79c0337f3285ee0eb6a5820f67ec0d835469f8' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\cotacao.tpl',
      1 => 1599159200,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129925f5b77070ec686-85735156',
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
  'unifunc' => 'content_5f5b7707174b25_16203259',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5b7707174b25_16203259')) {function content_5f5b7707174b25_16203259($_smarty_tpl) {?><main id="cotacao-interna" itemprop="mainContentOfPage">  <div id="wrap">    <div class="cotacao bg-secondary pt-20 pt-md-60 pb-40 pb-md-0">      <div class="container">        <div class="row linha">          <div class="col-lg-5 col-txt pb-40 pb-md-0 text-center text-md-left">            <div class="pt-md-100 pb-md-100">              <h1 class="title text-white fz-28 fz-xl-32 fw-400 lh-12">                <?php echo titulo('cotacao_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </h1>              <?php if (titulo('cotacao_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>              <div class="texto fz-14 mt-25 lh-2 text-white details-white pr-md-100">                <?php echo titulo('cotacao_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </div>              <?php }?>            </div>          </div>          <div class="col-lg-7 col-form">            <div>              <div class="box-1 pl-20 pl-md-50 pt-40 pt-md-50 pb-20 pb-md-70 pt-md-50 pr-20 pr-md-50 br-2 bs-1"                   style="position: absolute; left: 0; width: 100%"              >                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cotacao/form_cotacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
              </div>            </div>          </div>        </div>      </div>    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/secao-corretor.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><script>  $(function () {    function wrapHeight(){      var boxH = $('#cotacao-interna .col-form .box-1').outerHeight();      var wrapH = $('#wrap').height();      var diff = boxH - wrapH;      $('#wrap').height(wrapH + (diff) + 60);    }    var target = document.querySelector('#cotacao-interna .cotacao .box-1');    var observer = new MutationObserver(function(mutations) {      mutations.forEach(function(mutation) {        wrapHeight();      });    });    var config = { attributes: true, childList: true, characterData: true, subtree: true };    if($(window).width() > 991){      wrapHeight();      observer.observe(target, config);    }else{      observer.disconnect();    }  });</script><?php }} ?>