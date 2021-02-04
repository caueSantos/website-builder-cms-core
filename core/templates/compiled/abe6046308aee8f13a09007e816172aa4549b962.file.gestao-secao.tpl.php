<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:53:14
         compiled from "core\templates\producao\hubvet\site\blocos\global\gestao-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28913601b619a918705-76586163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abe6046308aee8f13a09007e816172aa4549b962' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\gestao-secao.tpl',
      1 => 1612407193,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28913601b619a918705-76586163',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b619a92a496_90243587',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b619a92a496_90243587')) {function content_601b619a92a496_90243587($_smarty_tpl) {?><section
  class="gestao-secao text-white pt-70 pb-80 overflow-hidden bg-primary">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-md-6 text-center">
        <div class="align-center">
          <div class="title-group">
            <h1 class="title fz-32 lh-12 fw-700">
              <?php echo titulo('cadastrar_secao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

            </h1>
            <?php if (titulo('cadastrar_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
            <div class="texto fz-14 mt-10 lh-15">
              <?php echo titulo('cadastrar_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

            </div>
            <?php }?>
          </div>
        </div>
      </div>
      </div>

    <div class="row justify-content-center mt-30">

      <div class="col-md-6">
        <div class="row justify-content-center">

          <div class="col-12 col-md-7">
            <input
              type="email" class="form-lands mb-0 form-outline form-dark" name="Email_txf"
              placeholder="<?php echo trans('form_email');?>
*"
              required
            />
          </div>

          <div class="col-12 col-md-5 pl-md-0">
            <button type="submit"
                    class="btn-lands btn-lg btn-block btn-accent pl-25 pr-25">
              <?php echo trans('cadastrar_botao');?>

            </button>
          </div>

        </div>
      </div>

    </div>

  </div>

</section>
<?php }} ?>