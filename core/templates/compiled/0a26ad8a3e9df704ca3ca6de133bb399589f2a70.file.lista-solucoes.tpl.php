<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\inicio\lista-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74485f84b9482118b0-92790508%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a26ad8a3e9df704ca3ca6de133bb399589f2a70' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\inicio\\lista-solucoes.tpl',
      1 => 1600360730,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74485f84b9482118b0-92790508',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servicos' => 0,
    'assets' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b948227b24_58233522',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b948227b24_58233522')) {function content_5f84b948227b24_58233522($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?><section class="links-lista pt-60 pb-60 pb-md-0 text-white">  <div class="bg-fake bg-secondary">    <div class="borda-servicos bg-fake d-none d-md-block"></div>  </div>  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8 text-center">        <div class="title-group">          <div class="title-image mb-25">            <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-title.png" class="pe-none"/>          </div>          <h1 class="title fz-32 fw-700">            <?php echo titulo('inicio_servicos','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('inicio_servicos','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-18">            <?php echo titulo('inicio_servicos','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>      </div>    </div>    <div class="mt-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div></section><?php }?><?php }} ?>