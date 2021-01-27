<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 17:49:42
         compiled from "core\templates\producao\hubvet\site\blocos\global\modais.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9166601072569e9582-17517443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c8c6226a4075d3454721c8746837b792131c4da' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\modais.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9166601072569e9582-17517443',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_60107256a05190_10346244',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_60107256a05190_10346244')) {function content_60107256a05190_10346244($_smarty_tpl) {?><div id="modal-encomende" class="modal fade">
  <div class="modal-dialog" style="max-width: var(--container-width); width: 100%;">

    <div class="container fill-height">

      <div class="row justify-content-center fill-height">

        <div class="col-12 col-lg-10">

          <div class="modal-content">

            <div class="pt-0 pb-0 pr-0 pl-0">
              <div class="row no-gutters">

                <div class="col-12 col-lg-5 col-img pr-0 d-none d-lg-block">
                  <figure class="fill-height bg-fake">
                    <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/fundo-modal-encomende.png" alt="Encomende seu imóvel"/>
                  </figure>
                </div>

                <div class="col-12 col-lg-7 col-txt text-center text-lg-left">

                  <div class="pt-80 pt-lg-110 pb-50 pb-lg-110 pl-20 pl-lg-60 pr-20 pr-lg-60">

                    <div class="title-group">
                      <h1 class="title text-body-quaternary fz-32 lh-12 fw-700">
                        <?php echo titulo('encomende_modal','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

                      </h1>
                      <?php if (titulo('encomende_modal','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
                      <div class="texto fz-14 mt-10 lh-15">
                        <?php echo titulo('encomende_modal','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

                      </div>
                      <?php }?>
                    </div>

                    <div class="mt-30">
                      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/form-interessado.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                    </div>

                  </div>

                </div>

              </div>
            </div>

            <div style="position: absolute; right: 30px; top: 30px">
              <button type="button" class="close fz-30" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
                <span class="fz-30 text-accent" aria-hidden="true">&times;</span>
              </button>
            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
</div>
<?php }} ?>