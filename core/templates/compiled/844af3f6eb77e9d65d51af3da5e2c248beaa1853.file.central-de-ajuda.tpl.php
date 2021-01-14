<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:38
         compiled from "core\templates\producao\abseg\site\central-de-ajuda.tpl" */ ?>
<?php /*%%SmartyHeaderCode:137195f50e9aaa66eb0-51036730%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '844af3f6eb77e9d65d51af3da5e2c248beaa1853' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\central-de-ajuda.tpl',
      1 => 1599131404,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '137195f50e9aaa66eb0-51036730',
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
  'unifunc' => 'content_5f50e9aaaa50c9_72389550',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9aaaa50c9_72389550')) {function content_5f50e9aaaa50c9_72389550($_smarty_tpl) {?><main id="central">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('internal_central','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('internal_central','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap" class="pb-20">    <section class="container pt-30 pb-40">      <div class="row justify-content-center">        <div class="col-12 col-lg-8">          <div class="text-center">            <h3 class="title fz-32 fw-400 lh-1 text-primary">              <?php echo titulo('interna_central_orientacao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h3>            <?php if (titulo('interna_central_orientacao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-14 mt-10 lh-15">              <?php echo titulo('interna_central_orientacao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>          <div id="orientacoes-container" class="pt-50">            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('ajax/orientacoes.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </section>    <section class="bg-secondary text-white pt-50 pt-md-80 pb-50 pb-md-80">      <div class="container">        <div class="row justify-content-center">          <div class="col-12 col-lg-6">            <div class="text-center">              <div class="fz-18">                Em caso de dúvidas              </div>              <h3 class="title fz-48 fw-700 lh-1">                entre em contato              </h3>              <div class="texto fz-18 mt-10">                Vamos resolver seu problema o mais rápido possível!              </div>            </div>            <div class="mt-30">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/central/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </section>    <section class="container pt-50 pt-md-60">      <div class="row justify-content-center">        <div class="col-12 col-lg-6">          <div class="text-center">            <h3 class="title fz-32 fw-400 lh-1 text-primary">              Dúvidas <strong>frequentes</strong>            </h3>            <div class="texto fz-18 mt-10 lh-1">              Vamos resolver seu problema o mais rápido possível!            </div>          </div>          <div id="perguntas-container" class="pt-30">            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('ajax/perguntas.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </section>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/noticias.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/secao-corretor.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><script>  $(function () {    function carregaConteudo($container, pagina, params = '') {      var loader = '<div class="dot-elastic"></div>';      var height = $container.height();      $.ajax({        url: window.appUrl + 'super_ajax/' + pagina + '?' + params,        type: "get",        beforeSend: function () {          rolagem($container.attr('id'), 200, 300);          $container.html('<div class="text-center pt-50 pb-50" style="height: ' + height + 'px">' + loader + '</div>');        },        success: function (data) {          setTimeout(function () {            $container.html(data);          }, 600);        },        error: function () {          $container.html("Erro ao abrir página");        }      });    }    // carregaConteudo($("#perguntas-container"), 'perguntas');    // carregaConteudo($("#orientacoes-container"), 'orientacoes');    $('body').on('click', '#perguntas-ajax .pagination .page-item a', function (e) {      e.preventDefault();      var $this = $(this), params = new URL($this.attr('href'));      params = params.search.replace('?', '');      carregaConteudo($("#perguntas-container"), 'perguntas', params);    }).on('click', '#orientacoes-ajax .pagination .page-item a', function (e) {      e.preventDefault();      var $this = $(this), params = new URL($this.attr('href'));      params = params.search.replace('?', '');      carregaConteudo($("#orientacoes-container"), 'orientacoes', params);    });  });</script><?php }} ?>