<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:32
         compiled from "core\templates\producao\abseg\site\blocos\solucoes\interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104195f50e9a4c35ef1-49251443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54e992ad06200136f79d1223b25d60b19e5542d7' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\solucoes\\interna.tpl',
      1 => 1599136641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104195f50e9a4c35ef1-49251443',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes' => 0,
    'solucao' => 0,
    'imagens' => 0,
    'painel' => 0,
    'CAMINHO_TPL' => 0,
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9a4c768e1_55020383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9a4c768e1_55020383')) {function content_5f50e9a4c768e1_55020383($_smarty_tpl) {?><div id="solucao" xmlns="http://www.w3.org/1999/html">  <?php $_smarty_tpl->tpl_vars['solucao'] = new Smarty_variable($_smarty_tpl->tpl_vars['solucoes']->value[0], null, 0);?>  <?php $_smarty_tpl->tpl_vars['imagens'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['solucao']->value->Imagens,'Campo_sel','==','Imagens_ico'), null, 0);?>  <section class="banner-solucao text-white">    <?php if ($_smarty_tpl->tpl_vars['imagens']->value[0]){?>    <figure class="bg-fake imagem">      <img alt="<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagens']->value[0]->Caminho_txf;?>
" class="img-fit"/>    </figure>    <?php }?>    <div class="bg-fake" style="background: linear-gradient(90deg, #FF1B45 30%, rgba(255, 27, 69, .2) 100%);"    ></div>    <div class="bg-fake"         style="background: linear-gradient(-110deg, rgba(255, 27, 69, .4) 00%, rgba(255, 27, 69, 0) 20%);"    ></div>    <div class="txt pt-50 pb-50 pt-md-120 pb-md-120 align-center text-center text-md-left">      <div class="container pt-md-80">        <div class="row">          <div class="col-12 col-md-7">            <div class="headinterna bs-0">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/navegacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>            <h1 class="title fw-700 fz-30 fz-md-48 mt-15">              <?php echo strip_tags($_smarty_tpl->tpl_vars['solucao']->value->Nome_tit);?>
            </h1>            <div class="fz-18">Entenda como funciona o seguro</div>            <?php if ($_smarty_tpl->tpl_vars['solucao']->value->Texto_txa){?>            <div class="texto fz-14 lh-18 mt-25 pr-md-100">              <?php echo $_smarty_tpl->tpl_vars['solucao']->value->Texto_txa;?>
            </div>            <?php }?>          </div>        </div>      </div>    </div>  </section>  <section class="cotacao-solucao mt-50">    <div class="container">      <div class="row">        <div class="col-12">          <div class="br-1 overflow-hidden">            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/secao-cotacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </section>  <?php if ($_smarty_tpl->tpl_vars['solucao']->value->Caracteristicas_txa){?>  <section class="caracteristicas-solucao text-center mt-50 mt-md-80">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-md-8">          <h3 class="title fz-32 fw-400 text-primary">            <strong>Características</strong> da Solução          </h3>          <div class="texto mt-15 lh-18">            <?php echo $_smarty_tpl->tpl_vars['solucao']->value->Caracteristicas_txa;?>
          </div>        </div>      </div>    </div>  </section>  <?php }?>  <?php if ($_smarty_tpl->tpl_vars['solucao']->value->seguradoras){?>  <section class="seguradoras-solucao text-center mt-50 mt-md-80">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-md-8">          <h3 class="title fz-32 fw-400 text-primary">            <?php echo titulo('solucao_seguradoras','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h3>          <?php if (titulo('solucao_seguradoras','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-14 mt-10">            <?php echo titulo('solucao_seguradoras','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>        <div class="col-12">          <div class="seguradoras-lista mt-50">            <?php $_smarty_tpl->tpl_vars['seguradoras'] = new Smarty_variable($_smarty_tpl->tpl_vars['solucao']->value->seguradoras, null, 0);?>            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/lista-seguradoras.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </section>  <?php }?>  <section class="cotacao-solucao bg-secondary text-white pt-50 pb-50 pt-md-80 pb-md-100 mt-50">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-md-10 text-white text-center">          <h3 class="title fz-32 fw-400">            <span class="d-block fz-18">Realize uma cotação e </span>            <strong>simule online</strong>          </h3>          <div class="texto fz-18 mt-10">            Preencha as informações abaixo e faça sua cotação aogra mesmo          </div>          <hr class="mt-20 mb-40"/>        </div>      </div>      <div class="row justify-content-center">        <div class="col-12 col-md-5 col-lg-5 custom-control-secondary">          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cotacao/form_cotacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        </div>      </div>    </div>  </section></div><?php }} ?>