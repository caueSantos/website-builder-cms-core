<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 06:18:08
         compiled from "core\templates\producao\zehimoveis\site\blocos\imoveis\imoveis-filtros.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71535fa65840c240d3-67855435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78ffb3735d308bb7cf4cae8a1e9eb2ac93459a80' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\imoveis\\imoveis-filtros.tpl',
      1 => 1604736105,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71535fa65840c240d3-67855435',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'caracteristicas_tipos' => 0,
    'tipo' => 0,
    'painel' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa65840c6a375_61930144',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa65840c6a375_61930144')) {function content_5fa65840c6a375_61930144($_smarty_tpl) {?><div class="filtros">

  <form id="imoveis-filtros-form" onsubmit="return false">

    <!-- FILTRO DE TIPO -->
    <div id="filtro-tipo">

      <h3 class="filter-group-title title fz-16 text-body-quaternary fw-700">
        Tipo de Imóvel
      </h3>

      <div class="lista mt-25">

        <div class="form-lands-radio custom-control custom-radio">

          <input
            id="filtro-tipo-compra"
            value="compra"
            checked=""
            type="radio"
            name="filtro[Tipo_imovel_sel]"
            class="custom-control-input"
            required="">

          <label class="custom-control-label" for="filtro-tipo-compra">
            Compra
          </label>

        </div>

        <div class="form-lands-radio custom-control custom-radio mt-20">

          <input
            id="filtro-tipo-aluguel"
            value="aluguel"
            type="radio"
            name="filtro[Tipo_imovel_sel]"
            class="custom-control-input"
            required="">

          <label class="custom-control-label" for="filtro-tipo-aluguel">
            Aluguel
          </label>

        </div>

        <!--        <div class="form-lands-radio custom-control custom-radio mt-20">-->

        <!--          <input-->
        <!--            id="filtro-tipo-empreendimento"-->
        <!--            value="empreendimento"-->
        <!--            type="radio"-->
        <!--            name="filtro[Tipo_imovel_sel]"-->
        <!--            class="custom-control-input"-->
        <!--            required="">-->

        <!--          <label class="custom-control-label" for="filtro-tipo-empreendimento">-->
        <!--            Empreendimento-->
        <!--          </label>-->

        <!--        </div>-->

      </div>

    </div>

    <!-- FILTRO DE LOCALIZAÇÃO -->
    <div id="filtro-localizacao" class="mt-35">

      <h3
        class="filter-group-title title fz-16 text-body-quaternary fw-700 cursor-pointer"
        data-toggle="collapse" data-target="#filtro-localizacao-collapse"
        aria-expanded="false"
      >
        Localização <i class="fas fa-chevron-down"></i>
      </h3>

      <div class="collapse show" id="filtro-localizacao-collapse">
        <div class="pt-25">

          <select
            name="filtro[Estado_txf]"
            data-placeholder="Estado"
            type="text"
            id="filtro-localizacao-estado"
            class="custom-select form-lands"
            data-autoload="estados"
          ></select>

          <select
            name="filtro[Cidade_txf]"
            data-placeholder="Cidade"
            type="text"
            class="custom-select form-lands"
            data-autoload="cidades"
            data-autoload-depends="#filtro-localizacao-estado"
            disabled
          ></select>

        </div>
      </div>

    </div>

    <!-- FILTRO DE CARACTERÍSTICAS -->
    <div id="filtro-caracteristicas" class="mt-35">

      <h3
        class="filter-group-title title fz-16 text-body-quaternary fw-700 cursor-pointer"
        data-toggle="collapse" data-target="#filtro-caracteristicas-collapse"
        aria-expanded="false"
      >
        Caracteristicas <i class="fas fa-chevron-down"></i>
      </h3>

      <div class="collapse show" id="filtro-caracteristicas-collapse">
        <div class="pt-25">

          <?php  $_smarty_tpl->tpl_vars['tipo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tipo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['caracteristicas_tipos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tipo']->key => $_smarty_tpl->tpl_vars['tipo']->value){
$_smarty_tpl->tpl_vars['tipo']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['tipo']->value->Exibe_filtro_sel!='NAO'){?>
          <div class="mb-10">

            <div class="mb-15">
              <div class="d-inline-block va-middle" style="width: 22px">
                <img style="width: auto; max-width: 100%; height: auto" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['tipo']->value->Imagens[0]->Caminho_txf;?>
"
                     class="mx-auto pe-none d-block"/>
              </div>

              <div class="pl-5 d-inline-block va-middle fz-16">
                <?php echo $_smarty_tpl->tpl_vars['tipo']->value->Nome_tit;?>

              </div>
            </div>

            <div class="d-inline-block">

              <?php if ($_smarty_tpl->tpl_vars['tipo']->value->Tipo_filtro_sel=='RADIO'){?>

              <div class="btn-group btn-group-toggle" data-toggle="buttons">

                <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 4+1 - (1) : 1-(4)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                <label class="btn btn-lands btn-primary btn-outline btn-sm title br-1 <?php if ($_smarty_tpl->tpl_vars['i']->value>1){?>ml-5<?php }?>">
                  <input type="radio" name="filtro[caracteristicas][<?php echo $_smarty_tpl->tpl_vars['tipo']->value->Nome_url;?>
]" autocomplete="off"
                         value="eq:<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">
                  <span class="fw-700"><?php if ($_smarty_tpl->tpl_vars['i']->value==4){?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</span>
                </label>
                <?php }} ?>

              </div>
              <div class="text-right fz-12 mt-5">
                <div
                  class="d-inline-block cursor-pointer"
                  onclick="limparFiltroRadio('filtro[caracteristicas][<?php echo $_smarty_tpl->tpl_vars['tipo']->value->Nome_url;?>
]')"
                >
                  <i class="fas fa-times va-middle pr-5"></i>
                  Limpar
                </div>
              </div>

              <?php }elseif($_smarty_tpl->tpl_vars['tipo']->value->Tipo_filtro_sel=='RANGE'){?>

              <div class="filtro-range">

                <div class="form-lands-group">
                  <div class="form-lands-suffix fw-700 title lh-0 fz-14 text-body-quaternary">
                    <?php echo $_smarty_tpl->tpl_vars['tipo']->value->Sufixo_txf;?>

                  </div>
                  <input
                    name="filtro[caracteristicas][<?php echo $_smarty_tpl->tpl_vars['tipo']->value->Nome_url;?>
][range][min]"
                    placeholder="Valor mínimo"
                    type="text"
                    class="form-control form-lands money-mask"
                  />
                </div>

                <div class="form-lands-group">
                  <div class="form-lands-suffix fw-700 title lh-0 fz-14 text-body-quaternary">
                    <?php echo $_smarty_tpl->tpl_vars['tipo']->value->Sufixo_txf;?>

                  </div>
                  <input
                    name="filtro[caracteristicas][<?php echo $_smarty_tpl->tpl_vars['tipo']->value->Nome_url;?>
][range][max]"
                    placeholder="Valor máximo"
                    type="text"
                    class="form-control form-lands money-mask"
                  />
                </div>

              </div>

              <?php }?>

            </div>

          </div>
          <?php }?>
          <?php } ?>

        </div>
      </div>

    </div>

    <!-- FILTRO DE PREÇO -->
    <div id="filtro-preco" class="mt-35">

      <h3
        class="filter-group-title title fz-16 text-body-quaternary fw-700 cursor-pointer"
        data-toggle="collapse" data-target="#filtro-preco-collapse"
        aria-expanded="false"
      >
        Preço <i class="fas fa-chevron-down"></i>
      </h3>

      <div class="collapse show" id="filtro-preco-collapse">
        <div class="pt-25">

          <div class="form-lands-group">
            <div class="fw-700 title icone lh-0 fz-14 text-body-quaternary">R$</div>
            <input
              name="filtro[Valor_min_txf]"
              placeholder="Valor mínimo"
              type="text"
              class="form-control form-lands money-mask"
            />
          </div>

          <div class="form-lands-group mb-0">
            <div class="fw-700 title icone lh-0 fz-14 text-body-quaternary">R$</div>
            <input
              name="filtro[Valor_max_txf]"
              placeholder="Valor máximo"
              type="text"
              class="form-control form-lands money-mask"
            />
          </div>

        </div>
      </div>

    </div>

    <div id="limpar-filtros" class="fz-14 text-right mt-15">

      <div
        class="d-inline-block cursor-pointer"
        onclick="limparFiltrosImoveis()"
      >
        <i class="fas fa-times va-middle pr-5"></i>
        Limpar filtros
      </div>

    </div>

    <div id="botao-aplicar-filtros" class="d-block d-md-none">
      <button type="submit" class="btn-lands btn-secondary">
        Aplicar Filtros
      </button>
    </div>

  </form>

</div>

<button type="button" id="acionador-filtro" class="d-md-none">
  <i class="fas fa-filter"></i>
</button>
<?php }} ?>