<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\carreira-titulo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3065601b635fd15601-26349733%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b20f3f7bc0caebea831e779382c2fdf75a4ed8d9' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\carreira-titulo.tpl',
      1 => 1612238333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3065601b635fd15601-26349733',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fd28309_94188941',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fd28309_94188941')) {function content_601b635fd28309_94188941($_smarty_tpl) {?><section id="carreira-titulo" class="bg-primary text-white">  <div class="bg-fake">    <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/bg-carreira.png" class="pe-none img-fit"/>  </div>  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-7">        <div class="pt-50 pb-50 pt-md-60 pb-md-80">          <div class="title-group text-center">            <h1 class="title text-white fz-36 fw-400 lh-12">              <?php echo titulo('carreira_interna_titulo','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('carreira_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 mt-20 lh-15 text-white">              <?php echo titulo('carreira_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>          <div class="botao text-center mt-30">            <a class="btn-lands btn-lg btn-accent pl-60 pr-60 text-white" onclick="rolagem('lista-vagas')">              <?php echo trans('faca_parte_equipe');?>
            </a>          </div>        </div>      </div>    </div>  </div></section><?php }} ?>