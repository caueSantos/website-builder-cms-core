<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:00:14
         compiled from "core\templates\producao\zehimoveis\site\blocos\sobre\sobre-referencia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96635fa645fe77ecc7-20715347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bdaad4c25fe244bc76aa1196c5ec8939830573f5' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\sobre\\sobre-referencia.tpl',
      1 => 1604732239,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96635fa645fe77ecc7-20715347',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_referencia' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa645fe798086_12114292',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa645fe798086_12114292')) {function content_5fa645fe798086_12114292($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_referencia']->value[0]){?><section id="sobre-sobre-carreira" class="pt-50 pt-md-110">  <div class="container">    <div class="row">      <div class="col-md-7 pr-md-50">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre_referencia']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable('0', null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('6-7', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>      <div class="col-md-5 pt-30 pt-md-0">        <div class="align-center">          <h1 class="title text-body-quaternary fw-700 fz-48 lh-12">            <?php echo $_smarty_tpl->tpl_vars['sobre_referencia']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-16 lh-15 mt-20 mt-md-40">            <?php echo $_smarty_tpl->tpl_vars['sobre_referencia']->value[0]->Texto_txa;?>
          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>