<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:32
         compiled from "core\templates\producao\abseg\site\blocos\inicio\lista-solucoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177375f53dee8cda376-28871829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '25f855732aef4509e96f8026d0bbf096cdbb787f' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\inicio\\lista-solucoes.tpl',
      1 => 1598978854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177375f53dee8cda376-28871829',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53dee8d75729_82387410',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53dee8d75729_82387410')) {function content_5f53dee8d75729_82387410($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['solucoes']->value[0]){?><section class="links-lista pt-70 pb-50">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8 text-center">        <h1 class="title text-primary fz-32">          <?php echo titulo('inicio_solucoes','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </h1>        <?php if (titulo('inicio_solucoes','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>        <div class="texto fz-18">          <?php echo titulo('inicio_solucoes','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </div>        <?php }?>      </div>    </div>    <div class="mt-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/solucoes/solucoes-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div></section><?php }?><?php }} ?>