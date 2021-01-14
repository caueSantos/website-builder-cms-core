<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\newsletter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27005fd2df4a5a8699-98193723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b1c171ebac6c276aa12d14e796cd57220179f10' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\newsletter.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27005fd2df4a5a8699-98193723',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a5b5754_66213168',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a5b5754_66213168')) {function content_5fd2df4a5b5754_66213168($_smarty_tpl) {?><section class="newsletter pt-50 pb-50 pt-lg-120 pb-lg-120">  <form class="form-newsletter" onsubmit="return false;">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-lg-10 col-txt">          <div class="title-group text-center">            <h1 class="title text-primary fz-32 lh-12 fw-700">              <?php echo titulo('newsletter','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('newsletter','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 mt-10 lh-15">              <?php echo titulo('newsletter','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>          <div class="row justify-content-center mt-30">            <div class="col-12 col-lg-4 pb-20 pb-lg-0">              <input                type="text" class="form-lands" name="Nome_txf"                placeholder="Digite seu nome*"                required              />            </div>            <div class="col-12 col-lg-4 pb-20 pb-lg-0">              <input                type="email" class="form-lands" name="Email_txf"                placeholder="Digite seu e-mail*"                required              />            </div>            <div class="col-12 col-lg-3">              <button type="submit" class="btn-lands btn-secondary btn-block">Enviar</button>            </div>          </div>        </div>      </div>    </div>  </form></section><?php }} ?>