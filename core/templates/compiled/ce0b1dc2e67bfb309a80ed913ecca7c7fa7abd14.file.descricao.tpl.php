<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:53:14
         compiled from "core\templates\producao\hubvet\site\blocos\cases\interna\descricao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28824601b619a9022a8-85052794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '28824601b619a9022a8-85052794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'case' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b619a90a137_48045839',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b619a90a137_48045839')) {function content_601b619a90a137_48045839($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['case']->value->Descricao_txa){?>
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