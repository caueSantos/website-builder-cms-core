<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:21
         compiled from "core\templates\producao\abseg\site\blocos\sobre\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149975f50e99930f749-88811902%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f447102439d72ffd732e111dcfea169c3e89975b' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\sobre\\sobre.tpl',
      1 => 1599135124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149975f50e99930f749-88811902',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'sobre' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e999324411_38064398',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e999324411_38064398')) {function content_5f50e999324411_38064398($_smarty_tpl) {?><section id="sobre-sobre" class="pt-50">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-6">        <div class="text-center text-md-left">          <h1 class="title fz-28 fz-md-32 fw-700 text-primary lh-12">            <?php echo titulo('sobre_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <div class="texto fz-16 lh-18 mt-30">            <?php echo $_smarty_tpl->tpl_vars['sobre']->value[0]->Sobre_txa;?>
          </div>          <div>            <div class="fz-16 text-primary fw-700 mt-40">              Diferenciais            </div>            <div class="texto fz-14 lh-18 mt-10">              <?php echo $_smarty_tpl->tpl_vars['sobre']->value[0]->Diferenciais_txa;?>
            </div>          </div>        </div>      </div>      <div class="col-12 col-md-6 pt-40 pt-md-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['figure_height'] = new Smarty_variable('400px', null, 0);?>        <?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable(true, null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }} ?>