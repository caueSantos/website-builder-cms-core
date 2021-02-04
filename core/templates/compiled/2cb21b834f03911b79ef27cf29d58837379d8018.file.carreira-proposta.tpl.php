<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\carreira-proposta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31468601b635fdc2763-25799676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2cb21b834f03911b79ef27cf29d58837379d8018' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\carreira-proposta.tpl',
      1 => 1612237674,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31468601b635fdc2763-25799676',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'carreira_proposta' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fde0ed4_32210000',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fde0ed4_32210000')) {function content_601b635fde0ed4_32210000($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['carreira_proposta']->value[0]){?><section id="sobre-jornada" class="pt-50 pb-50 pt-md-60 pb-md-70 bg-body-light">  <div class="container">    <div class="row justify-content-center">      <?php if ($_smarty_tpl->tpl_vars['carreira_proposta']->value[0]->Videos[0]){?>      <div class="col-md-6">        <?php $_smarty_tpl->tpl_vars['video'] = new Smarty_variable($_smarty_tpl->tpl_vars['carreira_proposta']->value[0]->Videos[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('3-2', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/video-aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>      <?php }?>      <div class="col-md-5 pt-30 <?php if (!$_smarty_tpl->tpl_vars['carreira_proposta']->value[0]->Videos[0]){?>text-center<?php }?>">        <div class="align-center">          <h1 class="title fw-700 fz-34 lh-12 text-primary">            <?php echo $_smarty_tpl->tpl_vars['carreira_proposta']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-14 lh-15 mt-lg-20">            <?php echo $_smarty_tpl->tpl_vars['carreira_proposta']->value[0]->Texto_txa;?>
          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>