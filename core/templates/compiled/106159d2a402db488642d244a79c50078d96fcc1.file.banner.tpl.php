<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:33
         compiled from "core\templates\producao\vet_life\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:315315f90d975d80cb1-11522113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '106159d2a402db488642d244a79c50078d96fcc1' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\inicio\\banner.tpl',
      1 => 1603253833,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '315315f90d975d80cb1-11522113',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banners' => 0,
    'banner' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d975dbb759_02039643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d975dbb759_02039643')) {function content_5f90d975dbb759_02039643($_smarty_tpl) {?><section id="banners">  <div class="owl-carousel carousel-banners"       data-owl-carousel       data-owl-items="1"       data-rwd="1-1-1"       data-owl-loop="true"       data-owl-autoplay="true"       data-owl-autoplay-timeout="10000"       data-owl-margin="0"       data-owl-dots="false"       data-owl-nav="false"  >    <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>    <?php if ($_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>    <div class="item">      <figure class="image-layer bg-fake">        <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"             class="img-fit"             title="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"             src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>        <div class="bg-fake"             style="background: #87BD42 !important; opacity: 0.84"></div>      </figure>      <div class="text-layer align-center pt-50 pb-50 pt-md-80 pb-md-80" style="text-shadow: -1px 1px 5px #709d40;">        <div class="container text-center text-white">          <div class="row justify-content-center">            <div class="col-12 col-md-8">              <?php if ($_smarty_tpl->tpl_vars['banner']->value->Titulo_menor_txa){?>              <div class="title fz-14 lh-15" style="letter-spacing: 2px;">                <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_menor_txa;?>
              </div>              <?php }?>              <div class="title fz-40 fw-700 lh-12">                <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_txa;?>
              </div>              <?php if ($_smarty_tpl->tpl_vars['banner']->value->Texto_txa){?>              <div class="texto fz-16 lh-18 mt-15 fw-300">                <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_txa;?>
              </div>              <?php }?>              <?php if (is_url($_smarty_tpl->tpl_vars['banner']->value->Link_txf)&&$_smarty_tpl->tpl_vars['banner']->value->Link_txf){?>              <div class="botao mt-30">                <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Link_txf;?>
" target="_blank" class="text-white fz-12 ff-secondary fw-500">                  <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_link_txf;?>
                </a>              </div>              <?php }?>            </div>          </div>        </div>      </div>    </div>    <?php }?>    <?php } ?>  </div>  <div class="banner-anchor bg-fake pb-40 animated bounce"       style="height: 20px; width: 40px; bottom: 0; top: auto; left: 50%; margin-left: -20px; z-index: 1; opacity: 0.5">    <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#secao-contato-whats"       data-target="#secao-contato-whats"       data-rolagem-margin="150"       class="rolagem text-white d-inline-block fz-50 fw-300 lh-0">      <i class="fas fa-chevron-down lh-0"></i>    </a>  </div></section><?php }} ?>