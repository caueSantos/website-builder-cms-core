<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:25
         compiled from "core\templates\producao\hubvet\site\blocos\cases\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10997601b7ef137c441-12330198%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4b243f1ab4ce65b258ee14086ddc5a375092107' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\banner.tpl',
      1 => 1610420801,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10997601b7ef137c441-12330198',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cases_banner' => 0,
    'tipo' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7ef13b2790_59398178',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7ef13b2790_59398178')) {function content_601b7ef13b2790_59398178($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['cases_banner']->value[0]){?>
<section class="cases-banner bg-dark-grey text-white pt-50 pb-50 pb-md-80">

  <div class="container">

    <div class="row justify-content-center <?php if (!$_smarty_tpl->tpl_vars['cases_banner']->value[0]->Imagens[0]){?>text-center<?php }?>">

      <div class="col-12 col-md-6">

        <div class="align-center">

          <div class="pr-md-100">
            <h1 class="title fz-34 lh-12">
              <?php echo $_smarty_tpl->tpl_vars['cases_banner']->value[0]->Titulo_txa;?>

            </h1>

            <?php if ($_smarty_tpl->tpl_vars['cases_banner']->value[0]->Texto_txa){?>
            <div class="texto fz-16 lh-15 mt-20">
              <?php echo $_smarty_tpl->tpl_vars['cases_banner']->value[0]->Texto_txa;?>

            </div>
            <?php }?>
          </div>

          <div class="mt-30">

            <form class="experimente-form" onsubmit="return false">
              <div class="row justify-content-center">

                <div class="col-12 col-md-7">
                  <input
                    type="email" class="form-lands form-outline form-dark" name="Email_txf"
                    placeholder="<?php echo trans('form_email');?>
*"
                    required
                  />
                </div>

                <div class="col-12 col-md-5 pl-md-0">
                  <button type="submit"
                          class="btn-lands btn-lg btn-block <?php if ($_smarty_tpl->tpl_vars['tipo']->value==1){?>btn-secondary<?php }else{ ?>btn-primary<?php }?> btn-block pl-25 pr-25">
                    <?php echo trans('experimente_secao_botao');?>

                  </button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

      <?php if ($_smarty_tpl->tpl_vars['cases_banner']->value[0]->Imagens[0]){?>
      <div class="col-12 col-md-6">
        <img
          src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['cases_banner']->value[0]->Imagens[0]->Caminho_txf;?>
"
          alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['cases_banner']->value[0]->Titulo_txa);?>
"
          title="<?php echo strip_tags($_smarty_tpl->tpl_vars['cases_banner']->value[0]->Titulo_txa);?>
"
          class="img-fluid pe-none d-block mx-auto"
        />
      </div>
      <?php }?>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>