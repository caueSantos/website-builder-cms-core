<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:57:36
         compiled from "core\templates\producao\hubvet\site\blocos\planos\planos-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16353601b7ec0a6c103-10523436%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9a2062f83747326b7cd824660940563bd41ace49' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\planos\\planos-header.tpl',
      1 => 1610328447,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16353601b7ec0a6c103-10523436',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7ec0a7bd36_55264781',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7ec0a7bd36_55264781')) {function content_601b7ec0a7bd36_55264781($_smarty_tpl) {?><section class="planos-header bg-primary text-white pt-40 pb-40 pt-md-80 pb-md-80">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-8">

        <div class="title-group text-center">
          <h1 class="title fz-38 lh-12 fw-400">
            <?php echo titulo('planos_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('planos_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto fz-16 mt-15 lh-15">
            <?php echo titulo('planos_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>

      </div>

    </div>

  </div>

</section>
<?php }} ?>