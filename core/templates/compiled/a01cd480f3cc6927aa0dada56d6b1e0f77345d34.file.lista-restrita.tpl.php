<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\inicio\lista-restrita.tpl" */ ?>
<?php /*%%SmartyHeaderCode:300385f84b948581846-60361423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a01cd480f3cc6927aa0dada56d6b1e0f77345d34' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\inicio\\lista-restrita.tpl',
      1 => 1599989721,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300385f84b948581846-60361423',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'area_restrita_items' => 0,
    'assets' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b948596a42_58534706',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b948596a42_58534706')) {function content_5f84b948596a42_58534706($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['area_restrita_items']->value[0]){?><section class="lista-restrita-wrap pt-60 pb-60">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8 text-center">        <div class="title-group">          <div class="title-image mb-25">            <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-title.png" class="pe-none"/>          </div>          <h1 class="title fz-32 fw-700 text-secondary">            <?php echo titulo('inicio_restrita','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('inicio_restrita','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-18">            <?php echo titulo('inicio_restrita','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>      </div>    </div>    <div class="row justify-content-center">      <div class="mt-50 col-md-10 col-12">        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/lista-area-restrita.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }?><?php }} ?>