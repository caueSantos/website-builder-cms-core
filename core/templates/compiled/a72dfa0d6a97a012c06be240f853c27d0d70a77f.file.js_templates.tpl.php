<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:52
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\global\js_templates.tpl" */ ?>
<?php /*%%SmartyHeaderCode:277775f90ff80e9abb5-50439504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a72dfa0d6a97a012c06be240f853c27d0d70a77f' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\global\\js_templates.tpl',
      1 => 1603337843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277775f90ff80e9abb5-50439504',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff80ea1750_49534041',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff80ea1750_49534041')) {function content_5f90ff80ea1750_49534041($_smarty_tpl) {?><script type="text/template" id="servico-modal-content">
  <div class="container fill-height">

    <div class="row justify-content-center fill-height">

      <div class="col-12 col-md-11">

        <div class="modal-content">

          <div class="pt-60 pb-50 pr-20 pl-20 pt-md-60 pb-md-60 pr-md-100 pl-md-100">
            <div class="row">

              <div class="col-12 col-md-5 col-img pr-md-55">

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

              <div class="col-12 col-md-7 col-txt pt-50 text-center text-md-left">
                <h3 class="title fz-26 fz-md-40 fw-700 text-primary lh-12"><<?php ?>%&titulo%<?php ?>></h3>
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
<?php }} ?>