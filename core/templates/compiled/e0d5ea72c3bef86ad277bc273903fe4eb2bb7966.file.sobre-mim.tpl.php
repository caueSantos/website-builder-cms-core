<?php /* Smarty version Smarty-3.1.12, created on 2021-01-31 15:34:18
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-mim.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320236016ea1aac6f01-23340794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0d5ea72c3bef86ad277bc273903fe4eb2bb7966' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-mim.tpl',
      1 => 1612114384,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320236016ea1aac6f01-23340794',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_mim' => 0,
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6016ea1aad7bd4_72546076',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6016ea1aad7bd4_72546076')) {function content_6016ea1aad7bd4_72546076($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_mim']->value[0]){?><section id="sobre-sobre-mim" class="bg-dark-grey text-white">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-7">        <div class="pt-50 pb-50 pt-md-60 pb-md-80">          <div class="title-group text-center">            <h1 class="title text-white fz-36 fw-400 lh-12">              <?php echo titulo('sobre_interna_titulo','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('sobre_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 mt-20 lh-15 text-white">              <?php echo titulo('sobre_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>