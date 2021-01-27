<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:02:15
         compiled from "core\templates\producao\hubvet\site\blocos\global\head_interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7340600fa257e8a931-08310913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21521b9021564f91f431fe54913bc9838a193650' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\head_interna.tpl',
      1 => 1604744351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7340600fa257e8a931-08310913',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo_header' => 0,
    'titulo' => 0,
    'subtitulo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa257e98bd2_02059258',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa257e98bd2_02059258')) {function content_600fa257e98bd2_02059258($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['tipo_header']->value){?><?php $_smarty_tpl->tpl_vars['tipo_header'] = new Smarty_variable(1, null, 0);?><?php }?><header class="headinterna bg-primary">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-7">        <div class="pt-20 pb-20 pt-lg-80 pb-lg-100 text-center">          <h1 class="title fz-48 fw-700 text-white lh-12">            <?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
          </h1>          <?php if ($_smarty_tpl->tpl_vars['tipo_header']->value==1&&$_smarty_tpl->tpl_vars['subtitulo']->value){?>          <div class="texto d-block text-white fz-18 mt-25 lh-1 ff-secondary">            <?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
          </div>          <?php }?>        </div>      </div>    </div>  </div></header><?php }} ?>