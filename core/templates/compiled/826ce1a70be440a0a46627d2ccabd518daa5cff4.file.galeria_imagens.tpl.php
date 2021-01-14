<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 03:49:10
         compiled from "core\templates\producao\vet_life\site\blocos\solucoes\galeria_imagens.tpl" */ ?>
<?php /*%%SmartyHeaderCode:187705f8fcbd609f1d0-34814690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '826ce1a70be440a0a46627d2ccabd518daa5cff4' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\solucoes\\galeria_imagens.tpl',
      1 => 1600446514,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187705f8fcbd609f1d0-34814690',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servico' => 0,
    'assets' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f8fcbd60c71d6_55817500',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8fcbd60c71d6_55817500')) {function content_5f8fcbd60c71d6_55817500($_smarty_tpl) {?><section class="galeria-imagens-sobre pt-50 pb-50 pb-md-80 <?php if ($_smarty_tpl->tpl_vars['servico']->value->Videos[0]){?>bg-body-light<?php }?>">

  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="title-group text-center">
          <div class="title-image mb-25">
            <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-title.png" class="pe-none"/>
          </div>
          <h1 class="title fz-32 fw-700 text-secondary">
            <?php echo titulo('servicos_interna_galeria','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
        </div>

        <div class="mt-50">
          <?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable('1-2-3', null, 0);?>
          <?php $_smarty_tpl->tpl_vars['pagination'] = new Smarty_variable(true, null, 0);?>
          <?php $_smarty_tpl->tpl_vars['item_class'] = new Smarty_variable('br-1 overflow-hidden', null, 0);?>
          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/galeria_imagens_carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </div>

      </div>
    </div>
  </div>

</section>
<?php }} ?>