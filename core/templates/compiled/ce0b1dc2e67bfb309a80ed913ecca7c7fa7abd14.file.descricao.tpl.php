<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:07:05
         compiled from "core\templates\producao\hubvet\site\blocos\cases\interna\descricao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6039600f9569600d65-60280612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce0b1dc2e67bfb309a80ed913ecca7c7fa7abd14' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\interna\\descricao.tpl',
      1 => 1611466433,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6039600f9569600d65-60280612',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'case' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f956960a424_40861043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f956960a424_40861043')) {function content_600f956960a424_40861043($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['case']->value->Descricao_txa){?>
<section class="case-descricao pt-60 pb-60 pb-md-80">

  <div class="row justify-content-center">

    <div class="col-md-8">

      <div class="fz-16 texto lh-15">
        <?php echo $_smarty_tpl->tpl_vars['case']->value->Descricao_txa;?>

      </div>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>