<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 06:25:16
         compiled from "core\templates\producao\zehimoveis\site\blocos\imoveis\interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:290305fa659ec6dbc73-99853427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35bf52a982032cc0341a7d201abd51ba19131eff' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\imoveis\\interna.tpl',
      1 => 1604737472,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '290305fa659ec6dbc73-99853427',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imoveis' => 0,
    'caracteristicas_tipos' => 0,
    'imovel' => 0,
    'caracteristica' => 0,
    'painel' => 0,
    'adicional' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa659ec79eea9_18468665',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa659ec79eea9_18468665')) {function content_5fa659ec79eea9_18468665($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['imovel'] = new Smarty_variable(monta_imoveis_zeh($_smarty_tpl->tpl_vars['imoveis']->value,$_smarty_tpl->tpl_vars['caracteristicas_tipos']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars['imovel'] = new Smarty_variable($_smarty_tpl->tpl_vars['imovel']->value[0], null, 0);?>
<?php $_smarty_tpl->tpl_vars['videos'] = new Smarty_variable($_smarty_tpl->tpl_vars['imovel']->value->Videos, null, 0);?>
<?php $_smarty_tpl->tpl_vars['imagens'] = new Smarty_variable($_smarty_tpl->tpl_vars['imovel']->value->Imagens, null, 0);?>
<main id="imoveis" class="text-body-tertiary text-center text-md-left imovel-interno" itemprop="mainContentOfPage">

  <div id="wrap" class="pt-50 pb-120">

    <div class="container">

      <div class="row">

        <div class="col-md-6">

          <div class="endereco fz-14">
            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Endereco_txf){?><?php echo $_smarty_tpl->tpl_vars['imovel']->value->Endereco_txf;?>
<?php }?>

            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Bairro_txf){?>
            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Endereco_txf){?> - <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Bairro_txf;?>

            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Estado_txf){?>
            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Bairro_txf){?> - <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Estado_txf;?>

            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Cep_txf){?>
            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Estado_txf){?>, <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Cep_txf;?>

            <?php }?>
          </div>

          <h1 class="title fw-700 text-body-quaternary fz-24 mt-15">
            <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>

          </h1>

          <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Descricao_curta_txa){?>
          <div class="descricao-curta mt-15">
            <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Descricao_curta_txa;?>

          </div>
          <?php }?>

          <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Caracteristicas_vin){?>
          <div class="caracteristicas mt-25 text-body-quaternary">
            <div class="row">
              <?php  $_smarty_tpl->tpl_vars['caracteristica'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['caracteristica']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['imovel']->value->Caracteristicas_vin; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['caracteristica']->key => $_smarty_tpl->tpl_vars['caracteristica']->value){
$_smarty_tpl->tpl_vars['caracteristica']->_loop = true;
?>
              <div class="col-6 text-center text-md-left col-md-auto mb-15 pr-40" title="<?php echo strip_tags($_smarty_tpl->tpl_vars['caracteristica']->value->Nome_tit);?>
">

                <div class="d-flex fill-height justify-content-center justify-content-md-start">

                  <?php if ($_smarty_tpl->tpl_vars['caracteristica']->value->Imagens[0]){?>
                  <div class="align-self-center mr-10" style="width: 24px;">
                    <img style="width: auto; height: auto" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Imagens[0]->Caminho_txf;?>
"
                         class="mx-auto pe-none d-block"/>
                  </div>
                  <?php }?>
                  <div class="align-self-center fw-700 fz-14 lh-12">
                    <?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Valor_min_txf;?>

                    <?php if ($_smarty_tpl->tpl_vars['caracteristica']->value->Valor_max_txf){?>
                    a <?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Valor_max_txf;?>

                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['caracteristica']->value->Sufixo_txf){?>
                    <?php echo $_smarty_tpl->tpl_vars['caracteristica']->value->Sufixo_txf;?>

                    <?php }?>
                  </div>

                </div>

              </div>
              <?php } ?>
            </div>
          </div>
          <?php }?>

        </div>

        <div class="col-md"></div>

        <div class="col-md-auto">
          <div class="align-center text-md-right">
            <div class="preco ff-secondary fz-24 text-secondary fw-700">
              R$ <?php echo formata_preco($_smarty_tpl->tpl_vars['imovel']->value->Valor_txf);?>

            </div>
            <div class="tipo fz-14" style="letter-spacing: 0.34em;">
              <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Tipo_imovel_sel=='compra'){?>
              COMPRA
              <?php }else{ ?>
              ALUGUEL
              <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Adicionais_vin){?>
            <div class="adicionais mt-10">
              <?php  $_smarty_tpl->tpl_vars['adicional'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['adicional']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['imovel']->value->Adicionais_vin; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['adicional']->key => $_smarty_tpl->tpl_vars['adicional']->value){
$_smarty_tpl->tpl_vars['adicional']->_loop = true;
?>
              <div class="adicional">
                <?php echo $_smarty_tpl->tpl_vars['adicional']->value->Tipo_sel;?>
: <?php echo $_smarty_tpl->tpl_vars['adicional']->value->Valor_txf;?>

              </div>
              <?php } ?>
            </div>
            <?php }?>
          </div>
        </div>

      </div>

    </div>

    <div class="mt-40">
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/galeria-mista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>

    <div class="mt-50">
      <div class="container">
        <div class="row">

          <div class="col-md-7">
            <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Descricao_txa||$_smarty_tpl->tpl_vars['imovel']->value->Planta_baixa){?>
            <div id="imoveis-tabs-descricao">
              <ul class="nav nav-pills pl-20" role="tablist">

                <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Descricao_txa){?>
                <li class="nav-item">
                  <a class=" active" data-toggle="tab" href="#descricao" role="tab" aria-controls="descricao"
                     aria-selected="true">Descrição</a>
                </li>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Planta_baixa){?>
                <li class="nav-item">
                  <a data-toggle="tab" href="#planta" role="tab" aria-controls="planta"
                     aria-selected="false">Planta Baixa</a>
                </li>
                <?php }?>

              </ul>
              <hr class="mt-0"/>
              <div class="tab-content pt-15">

                <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Descricao_txa){?>
                <div class="tab-pane fade show active" id="descricao" role="tabpanel" aria-labelledby="descricao-tab">
                  <div class="texto">
                    <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Descricao_txa;?>

                  </div>
                </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Planta_baixa){?>
                <div class="tab-pane fade" id="planta" role="tabpanel" aria-labelledby="planta-tab">
                  <a class="fancybox" data-fancybox="planta-baixa"
                     href="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Planta_baixa[0]->Caminho_txf;?>
">
                    <figure>
                      <img class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Planta_baixa[0]->Caminho_txf;?>
" alt="Planta baixa"/>
                    </figure>
                  </a>
                </div>
                <?php }?>

              </div>
            </div>
            <?php }?>
          </div>

          <div class="col-md-4 offset-md-1 pt-60 pt-md-0 d-none d-md-block">

            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/entre-contato-simples.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


          </div>

        </div>
      </div>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Mapa360_vin){?>
    <div class="mt-100">
      <?php $_smarty_tpl->tpl_vars['mapas'] = new Smarty_variable($_smarty_tpl->tpl_vars['imovel']->value->Mapa360_vin, null, 0);?>
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/galeria-360.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['imovel']->value->Mapa_txf){?>
    <section id="mapa" class="bg-body-light mt-70">
      <iframe
        src="https://www.google.com/maps/embed?pb=<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Mapa_txf;?>
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