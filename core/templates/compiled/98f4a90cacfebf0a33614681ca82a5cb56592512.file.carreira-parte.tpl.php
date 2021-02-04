<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\carreira-parte.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10046601b635fd46458-39725170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98f4a90cacfebf0a33614681ca82a5cb56592512' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\carreira-parte.tpl',
      1 => 1612237762,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10046601b635fd46458-39725170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'carreira_parte' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fd5db23_12707025',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fd5db23_12707025')) {function content_601b635fd5db23_12707025($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['carreira_parte']->value[0]){?><section id="sobre-sobre-carreira" class="pt-50 pb-50 pt-md-90 pb-md-80">  <div class="container">    <div class="row">      <div class="col-md-5 order-2 order-md-0 pt-30 pt-md-0">        <div class="align-center">          <h1 class="title text-primary fw-700 fz-34">            <?php echo $_smarty_tpl->tpl_vars['carreira_parte']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-14 lh-15 mt-20">            <?php echo $_smarty_tpl->tpl_vars['carreira_parte']->value[0]->Texto_txa;?>
          </div>        </div>      </div>      <div class="col-lg-6 offset-lg-1 order-1 order-lg-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['carreira_parte']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('16-9', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }?><?php }} ?>