<?php /* Smarty version Smarty-3.1.12, created on 2021-01-10 20:11:25
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-referencia.tpl" */ ?>
<?php /*%%SmartyHeaderCode:276925ffb7b8d5a6715-38668795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7820464c19b73ce35f827f8d678ed0ebf4a7e0be' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-referencia.tpl',
      1 => 1604744352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '276925ffb7b8d5a6715-38668795',
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
  'unifunc' => 'content_5ffb7b8d5be218_42878346',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffb7b8d5be218_42878346')) {function content_5ffb7b8d5be218_42878346($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_referencia']->value[0]){?><section id="sobre-sobre-carreira" class="pt-50 pt-lg-110">  <div class="container">    <div class="row">      <div class="col-lg-7 pr-lg-50">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre_referencia']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable('0', null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('6-7', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>      <div class="col-lg-5 pt-30 pt-lg-0">        <div class="align-center">          <h1 class="title text-body-quaternary fw-700 fz-48 lh-12">            <?php echo $_smarty_tpl->tpl_vars['sobre_referencia']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-16 lh-15 mt-20 mt-lg-40">            <?php echo $_smarty_tpl->tpl_vars['sobre_referencia']->value[0]->Texto_txa;?>
          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>