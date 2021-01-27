<?php /* Smarty version Smarty-3.1.12, created on 2021-01-24 13:56:02
         compiled from "core\templates\producao\hubvet\site\blocos\global\noticias.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9585600d9892f14366-96016153%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3438cc6e578890a9ca5d5a63b5cb43de75ee8849' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\noticias.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9585600d9892f14366-96016153',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'noticias' => 0,
    'noticia' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600d98930079b3_97747209',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600d98930079b3_97747209')) {function content_600d98930079b3_97747209($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['noticias'] = new Smarty_variable(wp_posts(2,9,false), null, 0);?><section id="noticias" class="bg-body-light text-center text-lg-left pt-50 pb-50 pt-lg-70 pb-lg-120">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-lg-12">        <div class="text-center">          <div class="title-group">            <div class="title-image mb-25">              <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-title.png" class="pe-none"/>            </div>            <h1 class="title fz-32 fw-700 text-secondary">              <?php echo titulo('secao_noticias','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('secao_noticias','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-18">              <?php echo titulo('secao_noticias','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>        </div>        <?php if ($_smarty_tpl->tpl_vars['noticias']->value){?>        <div class="owl-carousel mt-40"             data-owl-carousel             data-rwd="1-2-3"             data-owl-loop="true"             data-owl-autoplay="true"             data-owl-autoplay-timeout="10000"             data-owl-margin="30"             data-owl-dots="true"             data-owl-nav="false"             data-owl-slide-by="1"             data-owl-dots-each="1"             data-owl-dots-container="#noticias .owl-dots"        >          <?php  $_smarty_tpl->tpl_vars['noticia'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['noticia']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['noticias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['noticia']->key => $_smarty_tpl->tpl_vars['noticia']->value){
$_smarty_tpl->tpl_vars['noticia']->_loop = true;
?>          <div class="item">            <a              href="<?php echo $_smarty_tpl->tpl_vars['noticia']->value->guid;?>
"              class="link-item d-block fill-height hover-scale-down"            >              <div style="border-bottom: 12px solid var(--tertiary);" class="br-1 mb-30 bg-tertiary">                <figure class="imagem bg-secondary br-1 overflow-hidden" style="height: 240px;">                  <?php if ($_smarty_tpl->tpl_vars['noticia']->value->image){?>                  <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['noticia']->value->post_title);?>
" src="<?php echo $_smarty_tpl->tpl_vars['noticia']->value->image;?>
" class="img-fit"/>                  <?php }else{ ?>                  <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['noticia']->value->post_title);?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"                       class="img-fit"/>                  <?php }?>                </figure>              </div>              <div class="title fz-22 fw-600 text-body-primary lh-12" data-clamp="2">                <?php echo $_smarty_tpl->tpl_vars['noticia']->value->post_title;?>
              </div>              <?php if ($_smarty_tpl->tpl_vars['noticia']->value->post_content){?>              <div class="texto fz-18 mt-10 text-body-primary lh-15" data-clamp="3">                <?php echo corta_texto($_smarty_tpl->tpl_vars['noticia']->value->post_content,200);?>
              </div>              <?php }?>              <div class="botao mt-20">                <div target="_blank" class="title fz-18 fw-700 text-primary d-block">                  Continuar lendo                </div>              </div>            </a>          </div>          <?php } ?>        </div>        <div class="rounded-dots d-block d-lg-none text-center mt-30">          <div class="owl-dots fz-18"></div>        </div>        <div class="botao mt-50 text-center mx-auto" style="width: 240px">          <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
blog" class="btn-lands btn-block">            Ver tudo          </a>        </div>        <?php }else{ ?>        <div class="text-center text-primary fz-24 mt-40 fw-700">          Não temos nada para mostrar por enquanto. <br>          Fique ligado que em breve traremos novidades!        </div>        <?php }?>      </div>    </div>  </div></section><?php }} ?>