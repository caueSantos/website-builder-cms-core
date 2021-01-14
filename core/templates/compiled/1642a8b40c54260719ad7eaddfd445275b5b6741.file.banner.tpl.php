<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:32
         compiled from "core\templates\producao\abseg\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51225f53dee869a116-33301947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1642a8b40c54260719ad7eaddfd445275b5b6741' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\inicio\\banner.tpl',
      1 => 1599134336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51225f53dee869a116-33301947',
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
  'unifunc' => 'content_5f53dee87cc777_08135472',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53dee87cc777_08135472')) {function content_5f53dee87cc777_08135472($_smarty_tpl) {?><section id="banners">  <div class="owl-carousel carousel-banners"       data-owl-carousel       data-owl-items="1"       data-rwd="1-1-1"       data-owl-loop="true"       data-owl-autoplay="false"       data-owl-autoplay-timeout="6000"       data-owl-margin="0"       data-owl-dots="false"       data-owl-nav="false"  >    <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>    <?php if ($_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>    <div class="item">      <div class="image-layer">        <figure>          <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"               class="img-fit"               title="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"               src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"/>        </figure>      </div>      <div class="text-layer bg-fake">        <div          class="bg-fake"          style="background: linear-gradient(90deg, rgba(255, 27, 69, .9) 25%, rgba(255, 27, 69, 0) 80%);"        ></div>        <div          class="bg-fake"          style="background: linear-gradient(330deg, rgba(255, 27, 69, .5) 00%, rgba(255, 27, 69, 0) 40%);"        ></div>        <div class="container align-center text-white">          <div class="row">            <div class="col-12 col-md-6">              <div class="title fz-26 fz-md-50 fz-xl-64 fw-400">                <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_txf;?>
              </div>              <?php if (is_url($_smarty_tpl->tpl_vars['banner']->value->Link_txf)&&$_smarty_tpl->tpl_vars['banner']->value->Link_txf){?>              <div class="botao mt-30">                <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Link_txf;?>
" target="_blank" class="text-white fz-18">                  <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_link_txf;?>
                </a>              </div>              <?php }?>            </div>          </div>        </div>      </div>    </div>    <?php }?>    <?php } ?>  </div></section><?php }} ?>