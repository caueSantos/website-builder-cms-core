<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203015ffd8a94612424-83760168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'deb72c14d81a2f5ff82d00537b536516fc48312e' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\sobre.tpl',
      1 => 1609723207,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203015ffd8a94612424-83760168',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_inicio' => 0,
    'key' => 0,
    'painel' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9463e960_90212925',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9463e960_90212925')) {function content_5ffd8a9463e960_90212925($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_inicio']->value[0]){?><section class="sobre-inicio bg-body-light mt-45 pt-40 pb-40 pt-md-70 pb-md-80">  <div class="bg-fake bg-body-light" style="transform: skewY(-1.8deg); top: -24px;">  </div>  <div class="container">    <div class="row">      <div class="col-12 col-md-5">        <div class="align-center">          <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_inicio']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>          <figure class="imagem" data-index="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" style="height: 300px; <?php if ($_smarty_tpl->tpl_vars['key']->value>0){?>display: none;<?php }?>">            <img              src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value->Imagens[0]->Caminho_txf;?>
"              alt="<?php echo $_smarty_tpl->tpl_vars['sobre_inicio']->value->Titulo_txf;?>
"              style="object-fit: contain; width: 100%; height: 100%"            />          </figure>          <?php } ?>        </div>      </div>      <div class="col-12 col-md-5 mt-40 mt-lg-0 setas-centro marcador-bolinhas">        <div class="align-center">          <div class="owl-carousel carousel-sobre-inicio"               data-owl-carousel               data-owl-items="1"               data-rwd="1-1-1"               data-owl-loop="true"               data-owl-autoplay="true"               data-owl-autoplay-timeout="10000"               data-owl-margin="0"               data-owl-dots="true"               data-owl-nav="true"          >            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sobre_inicio']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>            <div class="item">              <div class="title text-secondary fz-34 fw-700 lh-12">                <?php echo $_smarty_tpl->tpl_vars['item']->value->Titulo_txf;?>
              </div>              <?php if ($_smarty_tpl->tpl_vars['item']->value->Subtitulo_txf){?>              <div class="fz-16 mt-5">                <?php echo $_smarty_tpl->tpl_vars['item']->value->Subtitulo_txf;?>
              </div>              <?php }?>              <div class="texto fz-20 mt-20">                <?php echo $_smarty_tpl->tpl_vars['item']->value->Texto_txa;?>
              </div>            </div>            <?php } ?>          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>