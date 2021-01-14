<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:00:14
         compiled from "core\templates\producao\zehimoveis\site\blocos\sobre\sobre-carreira.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171775fa645fe6f2bf2-06304706%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bb4fdf391787631478989b9a615fc3382b5c2ff' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\sobre\\sobre-carreira.tpl',
      1 => 1604732196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171775fa645fe6f2bf2-06304706',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_carreira' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa645fe70cac8_53302894',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa645fe70cac8_53302894')) {function content_5fa645fe70cac8_53302894($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_carreira']->value[0]){?><section id="sobre-sobre-carreira" class="pt-50 pt-md-100">  <div class="container">    <div class="row">      <div class="col-md-5 order-2 order-md-0 pt-30 pt-md-0">        <div class="align-center">          <h1 class="title text-body-quaternary fw-700 fz-24">            <?php echo $_smarty_tpl->tpl_vars['sobre_carreira']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-16 lh-15 mt-20">            <?php echo $_smarty_tpl->tpl_vars['sobre_carreira']->value[0]->Texto_txa;?>
          </div>        </div>      </div>      <div class="col-md-6 offset-md-1 order-1 order-md-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre_carreira']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable('1', null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('16-9', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }?><?php }} ?>