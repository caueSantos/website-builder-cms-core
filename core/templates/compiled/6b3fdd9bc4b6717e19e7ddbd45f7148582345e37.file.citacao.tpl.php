<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:07:05
         compiled from "core\templates\producao\hubvet\site\blocos\cases\interna\citacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4630600f95695ce8a1-65081410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b3fdd9bc4b6717e19e7ddbd45f7148582345e37' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\interna\\citacao.tpl',
      1 => 1611466281,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4630600f95695ce8a1-65081410',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'case' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f95695ed2d5_10316383',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f95695ed2d5_10316383')) {function content_600f95695ed2d5_10316383($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['case']->value->Depoimento_txa){?>
<section class="case-depoimento pt-md-90 pb-md-70 pt-50 pb-50 text-center bg-body-light">

  <div class="bg-fake text-left">
    <div class="align-center">
      <img style="left: -60px; top: -30px" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/aspas.png" class="pe-none"/>
    </div>
  </div>

  <div class="container text-body-tertiary">

    <div class="row justify-content-center">

      <div class="col-md-8">

        <h1 class="title fw-700 fz-32 lh-12">
          <?php echo $_smarty_tpl->tpl_vars['case']->value->Depoimento_txa;?>

        </h1>

        <?php if ($_smarty_tpl->tpl_vars['case']->value->Depoimento_autor_txf){?>
        <div class="fz-22 fw-700 title mt-60">
          <?php echo $_smarty_tpl->tpl_vars['case']->value->Depoimento_autor_txf;?>

        </div>
        <?php if ($_smarty_tpl->tpl_vars['case']->value->Depoimento_autor_subtitulo_txf){?>
        <div class="fz-14">
          <i><?php echo $_smarty_tpl->tpl_vars['case']->value->Depoimento_autor_subtitulo_txf;?>
</i>
        </div>
        <?php }?>
        <?php }?>

      </div>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>