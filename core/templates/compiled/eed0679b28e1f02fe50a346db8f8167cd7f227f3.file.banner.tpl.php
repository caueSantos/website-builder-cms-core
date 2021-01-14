<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:318625ffd8a94414606-88585153%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eed0679b28e1f02fe50a346db8f8167cd7f227f3' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\banner.tpl',
      1 => 1610426739,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '318625ffd8a94414606-88585153',
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
  'unifunc' => 'content_5ffd8a9443fbc7_62785155',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9443fbc7_62785155')) {function content_5ffd8a9443fbc7_62785155($_smarty_tpl) {?><section id="banners" class="bg-dark-grey text-white">  <div class="owl-carousel carousel-banners"       data-owl-carousel       data-owl-items="1"       data-rwd="1-1-1"       data-owl-loop="true"       data-owl-autoplay="true"       data-owl-autoplay-timeout="10000"       data-owl-margin="0"       data-owl-dots="false"       data-owl-nav="false"  >    <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['banner']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['banners']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
$_smarty_tpl->tpl_vars['banner']->_loop = true;
?>    <?php if ($_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>    <div class="item">      <div class="bg-fake">        <div class="container-fluid px-0">          <div class="row no-gutters">            <div class="col-md-5"></div>            <div class="col-md-7 pl-md-20">              <figure class="image-layer align-center">                <img                  alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"                  class="img-fit"                  title="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Titulo_txf);?>
"                  src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"                />              </figure>            </div>          </div>        </div>      </div>      <div class="container fill-height">        <div class="row fill-height">          <div class="col-md-5 pr-md-50 pt-120 pb-120">            <div class="text-layer align-center">              <h1 class="title fz-32 lh-15" style="letter-spacing: 1px;">                <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_txa;?>
              </h1>              <div class="botao mt-30">                <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_Link_txf;?>
" target="_blank" class="btn-lands btn-primary text-white">                  <?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf;?>
                </a>              </div>            </div>          </div>          <div class="offset-md-1 col-md-6">          </div>        </div>      </div>    </div>    <?php }?>    <?php } ?>  </div></section><?php }} ?>