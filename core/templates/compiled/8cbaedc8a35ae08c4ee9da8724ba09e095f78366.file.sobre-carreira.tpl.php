<?php /* Smarty version Smarty-3.1.12, created on 2021-01-10 20:11:25
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-carreira.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143035ffb7b8d56a605-99860005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cbaedc8a35ae08c4ee9da8724ba09e095f78366' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-carreira.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143035ffb7b8d56a605-99860005',
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
  'unifunc' => 'content_5ffb7b8d5875c5_72052049',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffb7b8d5875c5_72052049')) {function content_5ffb7b8d5875c5_72052049($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_carreira']->value[0]){?><section id="sobre-sobre-carreira" class="pt-50 pt-lg-100">  <div class="container">    <div class="row">      <div class="col-lg-5 order-2 order-lg-0 pt-30 pt-lg-0">        <div class="align-center">          <h1 class="title text-body-quaternary fw-700 fz-24">            <?php echo $_smarty_tpl->tpl_vars['sobre_carreira']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-16 lh-15 mt-20">            <?php echo $_smarty_tpl->tpl_vars['sobre_carreira']->value[0]->Texto_txa;?>
          </div>        </div>      </div>      <div class="col-lg-6 offset-lg-1 order-1 order-lg-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre_carreira']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable('1', null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('16-9', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }?><?php }} ?>