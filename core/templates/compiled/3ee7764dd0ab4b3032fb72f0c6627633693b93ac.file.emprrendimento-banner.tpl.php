<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 23:29:59
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\emprrendimento-banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208775ff11e1780e3f6-85153054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ee7764dd0ab4b3032fb72f0c6627633693b93ac' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\emprrendimento-banner.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208775ff11e1780e3f6-85153054',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'empreendimentos' => 0,
    'empreendimento' => 0,
    'app' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff11e17841b06_85500735',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff11e17841b06_85500735')) {function content_5ff11e17841b06_85500735($_smarty_tpl) {?><section id="banner-empreendimentos" class="pt-40 pb-40 pt-lg-80 pb-lg-80">  <div class="container text-center text-lg-left">    <div class="bg-fake d-none d-lg-block" style="width: 90px; height: 120px; left: auto; right: -40px; top: -10px">      <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/fundo-empreendimentos-inicio.png"/>    </div>    <div class="bg-fake">      <div class="container-fluid pl-0 pr-0 fill-height">        <div class="row fill-height mx-0">          <div class="col-lg-10 fill-height" style="box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.05);"></div>        </div>      </div>    </div>    <div class="owl-carousel carousel-banners pb-60 pt-60 overflow-hidden"         data-owl-carousel         data-owl-items="1"         data-rwd="1-1-1"         data-owl-loop="true"         data-owl-autoplay="true"         data-owl-autoplay-timeout="8000"         data-owl-margin="1"         data-owl-dots="false"         data-owl-nav="false"    >      <?php  $_smarty_tpl->tpl_vars['empreendimento'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['empreendimento']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['empreendimentos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['empreendimento']->key => $_smarty_tpl->tpl_vars['empreendimento']->value){
$_smarty_tpl->tpl_vars['empreendimento']->_loop = true;
?>      <div class="item">        <div class="container-fluid pr-0 pl-0">          <div class="row">            <div class="col-txt col-lg-5 offset-lg-1 order-2 order-lg-0 pt-30 pt-lg-0">              <div class="text-layer align-center">                <div class="text-body-tertiary fz-18 title fw-700">                  Empreendimentos                </div>                <div class="title fz-32 fw-700 lh-12 text-primary mt-10">                  <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Nome_tit;?>
                </div>                <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_curta_txa){?>                <div class="texto fz-16 fw-400 lh-15 mt-30 text-body-primary">                  <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_curta_txa;?>
                </div>                <?php }?>                <div class="botao mt-35">                  <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
empreendimentos/<?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Nome_url;?>
"                     class="btn-lands btn-outline pr-lg-60 pl-lg-60">                    Saiba mais                  </a>                </div>              </div>            </div>            <div class="col-img col-lg-6 order-1 order-lg-0">              <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable(($_smarty_tpl->tpl_vars['assets']->value).('imagens/indisponivel-quadrada.png'), null, 0);?>              <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Imagens[0]){?>              <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable(($_smarty_tpl->tpl_vars['painel']->value).($_smarty_tpl->tpl_vars['empreendimento']->value->Imagens[0]->Caminho_txf), null, 0);?>              <?php }?>              <div class="aspect aspect-4-3 br-2 overflow-hidden bg-body-light">                <figure class="aspect-item image-layer">                  <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['empreendimento']->value->Titulo_txf);?>
"                       class="img-fit"                       title="<?php echo strip_tags($_smarty_tpl->tpl_vars['empreendimento']->value->Titulo_txf);?>
"                       src="<?php echo $_smarty_tpl->tpl_vars['imagem']->value;?>
"/>                </figure>              </div>            </div>          </div>        </div>      </div>      <?php } ?>    </div>  </div></section><?php }} ?>