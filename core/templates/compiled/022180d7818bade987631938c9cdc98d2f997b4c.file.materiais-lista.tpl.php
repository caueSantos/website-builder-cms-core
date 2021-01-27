<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:06:39
         compiled from "core\templates\producao\hubvet\site\blocos\materiais\materiais-lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11169600f954f0e2883-62043017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '022180d7818bade987631938c9cdc98d2f997b4c' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\materiais\\materiais-lista.tpl',
      1 => 1610941580,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11169600f954f0e2883-62043017',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f954f0e8242_64743908',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f954f0e8242_64743908')) {function content_600f954f0e8242_64743908($_smarty_tpl) {?><section class="materiais-lista">

  <div class="row" id="materiais-container-ajax"></div>
  <div class="row" id="materiais-container-loader">
    <div class="col-12 loader pt-50 pb-50 text-center">
      <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/loader.gif" width="80px"/>
      <div class="text-primary fw-700"><?php echo trans('carregando');?>
</div>
    </div>
  </div>

</section>
<?php }} ?>