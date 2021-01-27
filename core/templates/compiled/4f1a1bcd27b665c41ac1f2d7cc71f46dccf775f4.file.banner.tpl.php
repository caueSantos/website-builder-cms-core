<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:07:05
         compiled from "core\templates\producao\hubvet\site\blocos\cases\interna\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31537600f956955ca24-45085885%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f1a1bcd27b665c41ac1f2d7cc71f46dccf775f4' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\interna\\banner.tpl',
      1 => 1611465776,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31537600f956955ca24-45085885',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'case' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f95695bb495_99541026',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f95695bb495_99541026')) {function content_600f95695bb495_99541026($_smarty_tpl) {?><section class="case-banner pt-md-120 pb-md-100 pt-50 pb-50 text-center bg-primary text-white">

  <?php if ($_smarty_tpl->tpl_vars['case']->value->Imagens[0]->Caminho_txf){?>
  <div class="bg-fake">
    <img src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['case']->value->Imagens[0]->Caminho_txf;?>
" class="pe-none img-fit"/>
  </div>
  <div class="bg-fake bg-primary" style="opacity: .85"></div>
  <?php }?>

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-md-8">

        <h1 class="title fw-700 fz-36">
          <?php echo $_smarty_tpl->tpl_vars['case']->value->Texto_principal_txa;?>

        </h1>

        <?php if ($_smarty_tpl->tpl_vars['case']->value->Texto_secundario_txa){?>
        <div class="texto mt-20 fz-14">
          <?php echo $_smarty_tpl->tpl_vars['case']->value->Texto_secundario_txa;?>

        </div>
        <?php }?>

      </div>

    </div>

  </div>

</section>

<?php if ($_smarty_tpl->tpl_vars['case']->value->Texto_terciario_txa){?>
<section class="case-banner-2 pt-50 pb-50">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-md-8 text-center">
        <div class="texto fz-16">
          <?php echo $_smarty_tpl->tpl_vars['case']->value->Texto_terciario_txa;?>

        </div>
      </div>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>