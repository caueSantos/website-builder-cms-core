<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:06:53
         compiled from "core\templates\producao\hubvet\site\blocos\planos\planos-header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7598600f955db1d400-04737021%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '7598600f955db1d400-04737021',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f955db7b6c3_54511794',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f955db7b6c3_54511794')) {function content_600f955db7b6c3_54511794($_smarty_tpl) {?><section class="planos-header bg-primary text-white pt-40 pb-40 pt-md-80 pb-md-80">

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