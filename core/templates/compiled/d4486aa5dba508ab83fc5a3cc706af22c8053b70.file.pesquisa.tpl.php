<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:28:46
         compiled from "core\templates\producao\hubvet\site\blocos\ajuda\pesquisa.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1605600fa88ef17196-42501972%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4486aa5dba508ab83fc5a3cc706af22c8053b70' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\ajuda\\pesquisa.tpl',
      1 => 1611635391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1605600fa88ef17196-42501972',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa88ef2bfd7_23999389',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa88ef2bfd7_23999389')) {function content_600fa88ef2bfd7_23999389($_smarty_tpl) {?><section class="ajuda-busca bg-dark-grey text-white pt-50 pb-50 pb-md-100">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="title-group text-center">
          <h1 class="title text-white fz-36 fw-400 lh-12">
            <?php echo titulo('ajuda_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('ajuda_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto fz-16 mt-20 lh-15 text-white">
            <?php echo titulo('ajuda_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>
      </div>
    </div>

    <div class="row no-gutters justify-content-center mt-25">
      <div class="col-md-6 pr-lg-15">
        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/form_busca_ajuda.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

      </div>
      <div class="col-lg-2 d-none d-lg-block">
        <button id="simula-busca" type="submit" class="btn-lands btn-lg btn-block btn-primary btn-block pl-25 pr-25">
          <?php echo trans('buscar_botao');?>

        </button>
      </div>
    </div>
  </div>

</section>
<?php }} ?>