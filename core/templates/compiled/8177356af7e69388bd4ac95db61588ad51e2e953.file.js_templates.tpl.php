<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\global\js_templates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:284545ffd8a94e63f76-24294325%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8177356af7e69388bd4ac95db61588ad51e2e953' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\js_templates.tpl',
      1 => 1607661363,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284545ffd8a94e63f76-24294325',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a94e9c2b7_16869413',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a94e9c2b7_16869413')) {function content_5ffd8a94e9c2b7_16869413($_smarty_tpl) {?><script type="text/template" id="servico-modal-content">
  <div class="container fill-height">

    <div class="row justify-content-center fill-height">

      <div class="col-12 col-lg-11">

        <div class="modal-content">

          <div class="pt-60 pb-50 pr-20 pl-20 pt-lg-60 pb-lg-60 pr-lg-100 pl-lg-100">
            <div class="row">

              <div class="col-12 col-lg-5 col-img pr-lg-55">

                <div class="aspect aspect-1-1 br-100 overflow-hidden bg-body-light">
                  <figure class="imagem aspect-item">
                    <img class="img-fit" src="<<?php ?>%imagem%<?php ?>>" alt="<<?php ?>%titulo_alt%<?php ?>>"/>
                  </figure>
                </div>

                <div class="info text-center mt-30">
                  <div class="text-body-secondary">
                    <div><strong>Deseja mais informações?</strong></div>
                    Entre em contato conosco
                  </div>
                  <a href="javascript:void(0);"
                     class="pl-30 pr-30 btn-lands btn-outline bw-2 mt-20 btn-sm"
                     onclick="document.querySelector('.lands-whatsapp-fab').click()">
                    <i class="fz-18 fab fa-whatsapp fw-500 mr-5"></i>
                    WhatsApp
                  </a>
                </div>

              </div>

              <div class="col-12 col-lg-7 col-txt pt-50 text-center text-lg-left">
                <h3 class="title fz-26 fz-lg-40 fw-700 text-primary lh-12"><<?php ?>%&titulo%<?php ?>></h3>
                <div class="texto fz-16 text-body-secondary mt-30 lh-18"><<?php ?>%&descricao%<?php ?>></div>
              </div>

            </div>
          </div>

          <div style="position: absolute; right: 30px; top: 30px">
            <button type="button" class="close fz-30" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
              <span class="fz-30 text-primary" aria-hidden="true">&times;</span>
            </button>
          </div>

        </div>

      </div>

    </div>

  </div>
</script>

<script type="text/template" id="imovel-item-content">
  <div class="col-12 col-md-6 col-lg-4 pb-30">
    <article class="imovel-item fill-height">

      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
imoveis/<<?php ?>%= it.Nome_url %<?php ?>>"
         class="fill-height text-body-primary hover hover-scale-up hover-shadow d-block br-1 overflow-hidden"
         style="border: 1px solid #F0F0F8;">

        <div class="aspect aspect-4-3 overflow-hidden bg-body-light">
          <figure class="aspect-item">
            <img
              class="img-fit"
              src="<<?php ?>%? it.Imagens[0] %<?php ?>><<?php ?>%= it._appUtils.painel %<?php ?>><<?php ?>%= it.Imagens[0].Caminho_txf %<?php ?>><<?php ?>%??%<?php ?>><<?php ?>%= it._appUtils.assets %<?php ?>>imagens/indisponivel-quadrada.png<<?php ?>%?%<?php ?>>"
              alt="<<?php ?>%= it.Nome_url %<?php ?>>"
            />
          </figure>
        </div>

        <div class="pl-25 pr-25 pt-35 <<?php ?>%? it.Caracteristicas_vin.length %<?php ?>>pb-20<<?php ?>%??%<?php ?>>pb-35<<?php ?>%?%<?php ?>>">

          <div class="title fz-18 fw-700 text-body-secondary" data-clamp="1">
            <<?php ?>%= it.Nome_tit %<?php ?>>
          </div>

          <<?php ?>%? it.Descricao_txa %<?php ?>>
          <div class="desc mt-20" data-clamp="3">
            <<?php ?>%= it.Descricao_txa %<?php ?>>
          </div>
          <<?php ?>%?%<?php ?>>

          <<?php ?>%? it.Caracteristicas_vin %<?php ?>>
          <div class="caracteristicas mt-30">
            <div class="row">
              <<?php ?>%~ it.Caracteristicas_vin :value%<?php ?>>
              <<?php ?>%? value.Valor_min_txf.length || value.Valor_max_txf.length %<?php ?>>
              <div class="col-12 col-md-6 col-lg-6 mb-15" title="<<?php ?>%= value.Nome_tit %<?php ?>>">

                <div class="d-flex fill-height">

                  <<?php ?>%? value.Imagens[0] %<?php ?>>
                  <div class="align-self-center mr-10" style="width: 24px;">
                    <img style="width: auto; height: auto" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<<?php ?>%= value.Imagens[0].Caminho_txf %<?php ?>>"
                         class="mx-auto pe-none d-block"/>
                  </div>
                  <<?php ?>%?%<?php ?>>

                  <div class="align-self-center fw-700 fz-14 lh-12">
                      <<?php ?>%? value.Valor_min_txf.length %<?php ?>>
                      <<?php ?>%= value.Valor_min_txf %<?php ?>>
                      <<?php ?>%?%<?php ?>>

                      <<?php ?>%? value.Valor_min_txf.length && value.Valor_max_txf.length %<?php ?>>
                      a
                      <<?php ?>%?%<?php ?>>

                      <<?php ?>%? value.Valor_max_txf.length %<?php ?>>
                      <<?php ?>%= value.Valor_max_txf %<?php ?>>
                      <<?php ?>%?%<?php ?>>

                      <<?php ?>%? value.Sufixo_txf %<?php ?>>
                      <<?php ?>%= value.Sufixo_txf %<?php ?>>
                      <<?php ?>%?%<?php ?>>
                  </div>

                </div>

              </div>
              <<?php ?>%?%<?php ?>>
              <<?php ?>%~%<?php ?>>
            </div>
          </div>
          <<?php ?>%?%<?php ?>>

        </div>

      </a>

    </article>
  </div>
</script>
<?php }} ?>