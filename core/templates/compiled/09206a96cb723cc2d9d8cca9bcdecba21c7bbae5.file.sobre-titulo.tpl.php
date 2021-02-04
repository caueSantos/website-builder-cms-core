<?php /* Smarty version Smarty-3.1.12, created on 2021-02-02 00:22:43
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\sobre-titulo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:113776018b773b313e9-71122756%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09206a96cb723cc2d9d8cca9bcdecba21c7bbae5' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\sobre-titulo.tpl',
      1 => 1612114582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113776018b773b313e9-71122756',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6018b773b3d882_91486689',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6018b773b3d882_91486689')) {function content_6018b773b3d882_91486689($_smarty_tpl) {?><section id="sobre-titulo" class="bg-dark-grey text-white">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-7">        <div class="pt-50 pb-50 pt-md-60 pb-md-80">          <div class="title-group text-center">            <h1 class="title text-white fz-36 fw-400 lh-12">              <?php echo titulo('sobre_interna_titulo','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('sobre_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 mt-20 lh-15 text-white">              <?php echo titulo('sobre_interna_titulo','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>        </div>      </div>    </div>  </div></section><?php }} ?>