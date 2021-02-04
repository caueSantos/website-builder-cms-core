<?php /* Smarty version Smarty-3.1.12, created on 2021-02-02 00:22:43
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\sobre-missao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26466018b773b53cf8-30640693%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0940b63b90f2b6219457e1626ef2b3c214c20050' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\sobre-missao.tpl',
      1 => 1612115018,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26466018b773b53cf8-30640693',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_missao' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6018b773b6f022_72238925',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6018b773b6f022_72238925')) {function content_6018b773b6f022_72238925($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_missao']->value[0]){?><section id="sobre-sobre-carreira" class="pt-50 pb-50 pt-md-80 pb-md-80">  <div class="container">    <div class="row">      <div class="col-md-5 order-2 order-md-0 pt-30 pt-md-0">        <div class="align-center">          <h1 class="title text-primary fw-700 fz-34">            <?php echo $_smarty_tpl->tpl_vars['sobre_missao']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-14 lh-15 mt-20">            <?php echo $_smarty_tpl->tpl_vars['sobre_missao']->value[0]->Texto_txa;?>
          </div>        </div>      </div>      <div class="col-lg-6 offset-lg-1 order-1 order-lg-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre_missao']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('16-9', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }?><?php }} ?>