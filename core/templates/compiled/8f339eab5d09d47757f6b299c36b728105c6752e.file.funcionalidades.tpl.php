<?php /* Smarty version Smarty-3.1.12, created on 2021-01-10 23:30:22
         compiled from "core\templates\producao\hubvet\site\blocos\funcionalidades\funcionalidades.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197665ffbaa2e6b0231-18878677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f339eab5d09d47757f6b299c36b728105c6752e' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\funcionalidades\\funcionalidades.tpl',
      1 => 1610322771,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197665ffbaa2e6b0231-18878677',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'funcionalidades' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffbaa2e6ccf80_61461221',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffbaa2e6ccf80_61461221')) {function content_5ffbaa2e6ccf80_61461221($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['funcionalidades']->value[0]){?>
<section class="planos-funcionalidades">

  <div class="fiuncionalidades pt-50 pb-70">

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="title-group text-center">
            <h1 class="title fz-40 text-primary lh-12 fw-400">
              <?php echo titulo('funcionalidades_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

            </h1>
            <?php if (titulo('funcionalidades_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
            <div class="texto text-body-secondary fz-18 mt-5 lh-15">
              <?php echo titulo('funcionalidades_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

            </div>
            <?php }?>
          </div>
        </div>
      </div>

      <div class="row mt-50">

        <div class="col-12">
          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/funcionalidades/funcionalidades-lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>

        <div class="col-12">

          <?php if (is_url(config('funcionalidades_interna_botao_link'))){?>
          <div class="botao mt-20 text-center">
            <a target="_blank" class="btn-lands btn-primary" href="<?php echo gera_link(config('funcionalidades_interna_botao_link'),true);?>
">
              <?php echo trans('funcionalidades_interna_botao');?>

            </a>
          </div>
          <?php }?>

        </div>

      </div>
    </div>

  </div>

</section>
<?php }?>
<?php }} ?>