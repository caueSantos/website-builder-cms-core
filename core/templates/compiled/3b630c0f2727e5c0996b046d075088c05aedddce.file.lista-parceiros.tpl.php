<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 09:53:15
         compiled from "core\templates\producao\labcearensediagn\site\blocos\inicio\lista-parceiros.tpl" */ ?>
<?php /*%%SmartyHeaderCode:292205f92c42b82f042-10605833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3b630c0f2727e5c0996b046d075088c05aedddce' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\inicio\\lista-parceiros.tpl',
      1 => 1603328346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '292205f92c42b82f042-10605833',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'parceiros' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f92c42b8dfd77_75000418',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c42b8dfd77_75000418')) {function content_5f92c42b8dfd77_75000418($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['parceiros']->value[0]){?><section id="parceiros" class="parceiros-lista pt-50 pb-50 pb-md-70 pt-md-80">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8 text-center">        <div class="align-center">          <div class="title-group text-primary lh-12">            <?php if (titulo('secao_parceiros','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="fz-14 tt-upper subtitle">              <?php echo titulo('secao_parceiros','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <h1 class="title fz-40 fw-700">              <?php echo titulo('secao_parceiros','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>          </div>        </div>      </div>    </div>    <div class="mt-50">      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/parceiros/parceiros-lista-carousel.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div>  </div></section><?php }?><?php }} ?>