<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 06:25:16
         compiled from "core\templates\producao\zehimoveis\site\imoveis.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14735fa659ec6a0182-70294145%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8c1329840ce1be9b0193b5e9470ce672894f65d' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\imoveis.tpl',
      1 => 1604727152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14735fa659ec6a0182-70294145',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'CAMINHO_TPL' => 0,
    'titulos' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa659ec6cb527_11890851',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa659ec6cb527_11890851')) {function content_5fa659ec6cb527_11890851($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['segment2']->value){?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }else{ ?><main id="imoveis" itemprop="mainContentOfPage">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable(titulo('interna_imoveis','tit',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('interna_imoveis','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div class="pb-120 pt-50">    <div class="container">      <div class="row">        <div class="col-md-3 d-none d-md-block"></div>        <div class="col-md-9 fz-14 pb-35">          <div id="contador-imoveis">            Foram encontrados <strong >0 imóveis</strong> para a sua busca!          </div>        </div>      </div>      <div class="row">        <div class="col-md-3 pr-65">          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/imoveis-filtros.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        </div>        <div class="col-md-9">          <div id="imoveis-lista-ajax" class="row"></div>          <div id="imoveis-placeholder" class="row">            <div class="col-md-4">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>            <div class="col-md-4 mt-30">              <div class="aspect aspect-3-4 bg-body-light br-1 bg-loading">                <div class="aspect-item"></div>              </div>            </div>          </div>          <div id="imovel-nao-encontrado" class="text-center mt-50 d-none">            <figure class="d-inline-block" style="width: 100px">              <img class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/sem-imovel.png"/>            </figure>            <div class="mt-30 fz-18 title fw-700">              Infelizmente não encontramos<br>              o imóvel que você procura =/            </div>          </div>          <section id="paginacao-imoveis" class="paginacao text-right">          </section>        </div>      </div>    </div>  </div></main><?php }?><?php }} ?>