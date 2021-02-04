<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:50:20
         compiled from "core\templates\producao\hubvet\site\blocos\ajuda\perguntas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2169601b6efc11ef93-16402359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a0c8820d21524045c6a8e4c6f4250257bd34d92' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\ajuda\\perguntas.tpl',
      1 => 1612407497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2169601b6efc11ef93-16402359',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'perguntas' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6efc134945_49751593',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6efc134945_49751593')) {function content_601b6efc134945_49751593($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['perguntas']->value[0]){?>
<section class="container pt-50 pt-lg-60">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-6">

      <div class="title-group text-center">
        <h1 class="title fz-36 fw-400 text-primary">
          <?php echo titulo('ajuda_perguntas','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

        </h1>
        <?php if (titulo('ajuda_perguntas','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
        <div class="texto fz-16 mt-15">
          <?php echo titulo('ajuda_perguntas','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

        </div>
        <?php }?>
      </div>

      <div id="perguntas-container" class="pt-30">
        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('ajax/perguntas.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

      </div>

    </div>
  </div>
</section>
<?php }?>
<?php }} ?>