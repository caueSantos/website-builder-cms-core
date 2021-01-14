<?php /* Smarty version Smarty-3.1.12, created on 2020-12-10 21:33:29
         compiled from "core\templates\producao\zehimoveis\site\blocos\empreendimentos\interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244685fd2b04922d983-94353187%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff578e941e1fa896d2189fb4073157686a19b947' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\empreendimentos\\interna.tpl',
      1 => 1605585896,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244685fd2b04922d983-94353187',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'empreendimentos' => 0,
    'empreendimento' => 0,
    'imagens' => 0,
    'painel' => 0,
    'img' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2b0492662d6_07516578',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2b0492662d6_07516578')) {function content_5fd2b0492662d6_07516578($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['empreendimento'] = new Smarty_variable($_smarty_tpl->tpl_vars['empreendimentos']->value[0], null, 0);?>
<?php $_smarty_tpl->tpl_vars['videos'] = new Smarty_variable($_smarty_tpl->tpl_vars['empreendimento']->value->Videos, null, 0);?>
<?php $_smarty_tpl->tpl_vars['imagens'] = new Smarty_variable($_smarty_tpl->tpl_vars['empreendimento']->value->Imagens, null, 0);?>
<main id="empreendimento" class="text-body-tertiary" itemprop="mainContentOfPage">

  <div class="head pt-50 pb-50 pt-lg-120 pb-lg-120">

    <div class="pe-none bg-fake">
      <?php if ($_smarty_tpl->tpl_vars['imagens']->value[0]){?>
      <?php $_smarty_tpl->tpl_vars['img'] = new Smarty_variable(array_rand($_smarty_tpl->tpl_vars['imagens']->value), null, 0);?>
      <img src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagens']->value[$_smarty_tpl->tpl_vars['img']->value]->Caminho_txf;?>
" class="img-fit"/>
      <?php }?>
    </div>

    <div class="bg-fake bg-primary" style="opacity: 0.8"></div>

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-6 text-center text-white">

          <h1 class="title fw-700 fz-48 mt-10">
            <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Nome_tit;?>

          </h1>

          <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_curta_txa){?>
          <div class="texto descricao-curta mt-15 fz-16">
            <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_curta_txa;?>

          </div>
          <?php }?>

          <div
            class="preco d-inline-block ff-secondary fz-18 text-secondary bg-white text-body-primary br-100 lh-1 pl-30 pr-30 pl-lg-70 pr-lg-70 pt-15 pb-15 mt-25"
            style="letter-spacing: -0.04em;">
            <span>Lotes a partir de </span>
            <strong class="text-accent">R$ <?php echo formata_preco($_smarty_tpl->tpl_vars['empreendimento']->value->Valor_txf);?>
</strong>
          </div>

        </div>
      </div>

    </div>

  </div>

  <div id="wrap" class="pt-50 pb-50 pb-lg-120">

    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/galeria-mista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


    <div class="mt-50">
      <div class="container text-center text-lg-left">
        <div class="row">

          <div class="col-lg-7">
            <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_txa){?>
            <div id="imoveis-tabs-descricao">
              <ul class="nav nav-pills pl-20" role="tablist">
                <li class="nav-item">
                  <a class=" active" data-toggle="tab" href="#descricao" role="tab" aria-controls="descricao"
                     aria-selected="true">Descrição</a>
                </li>
              </ul>
              <hr class="mt-0"/>
              <div class="tab-content pt-15">
                <div class="tab-pane fade show active" id="descricao" role="tabpanel" aria-labelledby="descricao-tab">
                  <div class="texto">
                    <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_txa;?>

                  </div>
                </div>
              </div>
            </div>
            <?php }?>
          </div>

          <div class="col-lg-4 offset-lg-1 text-center text-lg-left pt-60 pt-lg-0 d-none d-lg-block">

            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/entre-contato-simples.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


          </div>

        </div>
      </div>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Mapa360_vin){?>
    <div class="mt-100">
      <?php $_smarty_tpl->tpl_vars['mapas'] = new Smarty_variable($_smarty_tpl->tpl_vars['empreendimento']->value->Mapa360_vin, null, 0);?>
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/empreendimentos/galeria-360.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Mapa_txf){?>
    <section id="mapa" class="bg-body-light mt-70">
      <iframe
        src="https://www.google.com/maps/embed?pb=<?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Mapa_txf;?>
" width="100%" frameborder="0"
        style="border:0; height: 37.5rem"
        allowfullscreen></iframe>
    </section>
    <?php }?>

    <div>
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/form-interessado.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>

  </div>

</main>
<?php }} ?>