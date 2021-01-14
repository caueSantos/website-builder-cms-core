<?php /* Smarty version Smarty-3.1.12, created on 2020-12-10 21:33:29
         compiled from "core\templates\producao\zehimoveis\site\blocos\imoveis\form-interessado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:152195fd2b04937efd7-61356442%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc5474509e12a82837e4eac796c235b375604e68' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\imoveis\\form-interessado.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152195fd2b04937efd7-61356442',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2b04938db29_78237484',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2b04938db29_78237484')) {function content_5fd2b04938db29_78237484($_smarty_tpl) {?><section class="pt-50 pt-lg-90">  <div class="container text-center">    <div class="row justify-content-center">      <div class="col-lg-5">        <div class="title-group">          <h1 class="title text-body-quaternary fz-32 lh-12 fw-700">            <?php echo titulo('entre_contato_simples','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-10 lh-15">            <?php echo titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>        <div class="mt-40">          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/form-interessado.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        </div>      </div>    </div>  </div></section><?php }} ?>