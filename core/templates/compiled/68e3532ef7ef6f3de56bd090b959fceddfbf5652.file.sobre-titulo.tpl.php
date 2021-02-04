<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:39
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-titulo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29702601b6357d025d0-15601410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68e3532ef7ef6f3de56bd090b959fceddfbf5652' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-titulo.tpl',
      1 => 1612114582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29702601b6357d025d0-15601410',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6357d0f7a1_33470845',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6357d0f7a1_33470845')) {function content_601b6357d0f7a1_33470845($_smarty_tpl) {?><section id="sobre-titulo" class="bg-dark-grey text-white">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-7">        <div class="pt-50 pb-50 pt-md-60 pb-md-80">          <div class="title-group text-center">            <h1 class="title text-white fz-36 fw-400 lh-12">              <?php echo titulo('sobre_interna_titulo','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('sobre_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 mt-20 lh-15 text-white">              <?php echo titulo('sobre_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>        </div>      </div>    </div>  </div></section><?php }} ?>