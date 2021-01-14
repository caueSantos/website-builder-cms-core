<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63515fd2df4a298e01-12647127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'daf0beeeb50e510164a209f2fb0067c48b6a800d' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\inicio\\banner.tpl',
      1 => 1604789894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63515fd2df4a298e01-12647127',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'imoveis_banner' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a2cc336_05913869',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a2cc336_05913869')) {function content_5fd2df4a2cc336_05913869($_smarty_tpl) {?><section id="banners" class="pt-45 pb-60">  <div class="container">    <div class="row">      <div class="col-12 col-lg-6 col-txt pt-50 pt-lg-0 pb-0 pb-lg-80 pesquisa-responsivo" style="z-index: 9">        <div class="align-center align-remove">          <div class="title-group">            <h1 class="title text-body-quaternary fz-40 fw-700 lh-12">              <?php echo titulo('banner_inicio','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('banner_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto mt-15 lh-15">              <?php echo titulo('banner_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>          <div class="mt-30">            <div class="row no-gutters">              <div class="col-md pr-lg-15">                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/busca/form_busca_topo.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
              </div>              <div class="col-lg-auto d-none d-lg-block">                <button id="simula-busca" type="submit" class="btn-lands btn-secondary pl-50 pr-50">                  Pesquisar                </button>              </div>            </div>            <div class="mt-20">              <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis" class="text-primary text-secondary-hover fw-700">                <span class="va-middle">Ver todos os imóveis </span>                <i style="top: 1px; left: 2px" class="fas fa-chevron-circle-right va-middle"></i>              </a>            </div>          </div>        </div>        <button type="button" id="fechar-pesquisa" class="d-lg-none"> <i class="fas fa-times"></i> </button>      </div>      <div class="col-12 col-lg-5 offset-lg-1 col-img mt-40 mt-lg-0">        <div class="bg-fake">          <img            style="height: 518px; width: auto; right: -35px; position: absolute; top: 140px;"            src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/fundo-banner.png" class="pe-none"          />        </div>        <div class="owl-carousel carousel-banners"             data-owl-carousel             data-owl-items="1"             data-rwd="1-1-1"             data-owl-loop="true"             data-owl-autoplay="true"             data-owl-autoplay-timeout="6000"             data-owl-margin="15"             data-owl-dots="false"             data-owl-nav="true"             data-owl-autoplay-hover-pause="true"             data-owl-nav-container="#banners .col-img .owl-nav"             data-owl-nav-text="@icon:fas fa-chevron-left@--@icon:fas fa-chevron-right@"        >          <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['imoveis_banner']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>          <?php if ($_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>          <div class="item overflow-hidden br-2">            <div class="aspect aspect-1-1 br-2 overflow-hidden bg-body-light">              <figure class="aspect-item image-layer">                <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"                     class="img-fit"                     title="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"                     src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>              </figure>            </div>            <div class="text-layer pr-lg-120 text-lg-right mt-30">              <div class="title fz-14 fw-700 lh-12">                <?php echo $_smarty_tpl->tpl_vars['banner']->value->Nome_tit;?>
              </div>              <div class="botao">                <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Nome_url;?>
" target="_blank"                   class="fz-16 ff-secondary fw-700 text-accent text-accent-hover">                  Saiba mais                </a>              </div>            </div>          </div>          <?php }?>          <?php } ?>        </div>        <div class="nav setas-caixa d-block text-center setas-caixa d-block d-lg-inline-block">          <div class="owl-nav fz-18"></div>        </div>      </div>    </div>  </div></section><?php }} ?>