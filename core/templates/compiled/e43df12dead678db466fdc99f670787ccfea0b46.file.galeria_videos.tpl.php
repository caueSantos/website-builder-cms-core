<?php /* Smarty version Smarty-3.1.12, created on 2020-10-18 19:20:56
         compiled from "core\templates\producao\vet_life\site\blocos\sobre\galeria_videos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206105f8cb1b8ccecc0-63997304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e43df12dead678db466fdc99f670787ccfea0b46' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\sobre\\galeria_videos.tpl',
      1 => 1599990608,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206105f8cb1b8ccecc0-63997304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'sobre' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f8cb1b8da9520_48373136',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8cb1b8da9520_48373136')) {function content_5f8cb1b8da9520_48373136($_smarty_tpl) {?><section class="galeria-imagens-sobre pt-50 pb-50 pb-md-80">

  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="title-group text-center">
          <div class="title-image mb-25">
            <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-title.png" class="pe-none"/>
          </div>
          <h1 class="title fz-32 fw-700 text-secondary">
            <?php echo titulo('sobre_interna_videos','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
        </div>

        <div class="mt-50">
          <?php $_smarty_tpl->tpl_vars['videos'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre']->value[0]->Videos, null, 0);?>
          <?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable('1-2-3', null, 0);?>
          <?php $_smarty_tpl->tpl_vars['pagination'] = new Smarty_variable(true, null, 0);?>
          <?php $_smarty_tpl->tpl_vars['item_class'] = new Smarty_variable('br-1 overflow-hidden', null, 0);?>
          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/galeria_videos_carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>

      </div>
    </div>
  </div>

</section>
<?php }} ?>