<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 16:14:19
         compiled from "core\templates\producao\diagnostico\site\blocos\solucoes\banner-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50495f5e6f8bebc523-40004090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa350de6e84aab71871932a433453602690bda81' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\solucoes\\banner-solucoes.tpl',
      1 => 1599323733,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50495f5e6f8bebc523-40004090',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banner_solucoes' => 0,
    'banner' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5e6f8beec234_41322682',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5e6f8beec234_41322682')) {function content_5f5e6f8beec234_41322682($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['banner_solucoes']->value[0]){?><div class="banner-solucoes">  <div class="container">    <div class="row">      <div class="col-12">        <div class="banner-box br-1 overflow-hidden bg-primary">          <div class="rounded-dots mt-30 mt-md-70 text-center text-md-left">            <div class="container align-center text-white">              <div class="row">                <div class="col-12 col-md-5 offset-md-1">                  <div class="owl-dots fz-18"></div>                </div>              </div>            </div>          </div>          <div class="owl-carousel carousel-banners"               data-owl-carousel               data-owl-items="1"               data-rwd="1-1-1"               data-owl-loop="true"               data-owl-autoplay="false"               data-owl-autoplay-timeout="6000"               data-owl-margin="0"               data-owl-dots="true"               data-owl-nav="false"               data-owl-dots-container=".banner-solucoes .owl-dots"          >            <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banner_solucoes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>            <?php if ($_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>            <div class="item pt-60 pt-md-100 pb-40 pb-md-60">              <div class="image-layer bg-fake">                <figure style="height: 100%">                  <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"                       class="img-fit"                       title="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"                       src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>                </figure>                <div                  class="bg-fake"                  style="background: linear-gradient(90deg, #FF1B45 20%, rgba(255, 27, 69, .1) 80%);"                ></div>                <div                  class="bg-fake"                  style="background: linear-gradient(-110deg, rgba(255, 27, 69, .4) 00%, rgba(255, 27, 69, 0) 20%);"                ></div>              </div>              <div class="text-layer text-center text-md-left">                <div class="container align-center text-white">                  <div class="row">                    <div class="col-12 col-md-5 offset-md-1">                      <div class="title fz-26 fz-md-32 fw-400">                        <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_txf;?>
                      </div>                      <?php if ($_smarty_tpl->tpl_vars['banner']->value->Texto_txa){?>                      <div class="texto mt-20" data-clamp="3">                        <?php echo corta_texto($_smarty_tpl->tpl_vars['banner']->value->Texto_txa,250);?>
                      </div>                      <?php }?>                      <?php if ($_smarty_tpl->tpl_vars['banner']->value->Link_solucao_txf){?>                      <div class="botao mt-30">                        <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
solucoes/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Link_solucao_txf;?>
" class="btn-lands btn-accent btn-outline">                          Saiba mais                        </a>                      </div>                      <?php }?>                    </div>                  </div>                </div>              </div>            </div>            <?php }?>            <?php } ?>          </div>        </div>      </div>    </div>  </div></div><?php }?><?php }} ?>