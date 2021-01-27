<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:28:47
         compiled from "core\templates\producao\hubvet\site\blocos\ajuda\perguntas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32102600fa88f11ea24-94936868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a0c8820d21524045c6a8e4c6f4250257bd34d92' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\ajuda\\perguntas.tpl',
      1 => 1611635471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32102600fa88f11ea24-94936868',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa88f1244a1_96930446',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa88f1244a1_96930446')) {function content_600fa88f1244a1_96930446($_smarty_tpl) {?><section class="container pt-50 pt-lg-60">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-6">

      <div class="text-center">
        <h3 class="title fz-24 fz-lg-32 fw-400 lh-1 text-primary">
          Dúvidas <strong>frequentes</strong>
        </h3>
        <div class="texto fz-18 mt-10 lh-1">
          Vamos resolver seu problema o mais rápido possível!
        </div>
      </div>

      <div id="perguntas-container" class="pt-30">
        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('ajax/perguntas.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

      </div>

    </div>
  </div>
</section>
<?php }} ?>