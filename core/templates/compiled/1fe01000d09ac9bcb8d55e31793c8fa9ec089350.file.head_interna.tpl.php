<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 10:02:42
         compiled from "core\templates\producao\labcearensediagn\site\blocos\global\head_interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:236015f92c6626e1160-40165191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1fe01000d09ac9bcb8d55e31793c8fa9ec089350' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\global\\head_interna.tpl',
      1 => 1599984408,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236015f92c6626e1160-40165191',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo_header' => 0,
    'CAMINHO_TPL' => 0,
    'subtitulo' => 0,
    'titulo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f92c6626fccf0_99990286',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c6626fccf0_99990286')) {function content_5f92c6626fccf0_99990286($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['tipo_header']->value){?><?php $_smarty_tpl->tpl_vars['tipo_header'] = new Smarty_variable(1, null, 0);?><?php }?><header class="headinterna bg-primary">  <div class="container">    <div class="pt-20 pb-20 pt-md-70 pb-md-50 text-center">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/navegacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      <?php if ($_smarty_tpl->tpl_vars['tipo_header']->value==2){?>      <div class="texto d-block text-white fz-18 lh-1">        <?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
      </div>      <?php }?>      <h1 class="title fz-32 fw-400 text-white mt-10 lh-1">        <?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
      </h1>      <?php if ($_smarty_tpl->tpl_vars['tipo_header']->value==1){?>      <div class="texto d-block text-white fz-18 mt-10 lh-1">        <?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
      </div>      <?php }?>    </div>  </div></header><?php }} ?>