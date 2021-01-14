<?php /* Smarty version Smarty-3.1.12, created on 2020-12-12 13:52:43
         compiled from "core\templates\producao\hubvet\site\blocos\imoveis\form-interessado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165205fd4e74b4d4ce8-86643647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d3935075d65fc16c3148e4ac39dbd8a79f03616' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\imoveis\\form-interessado.tpl',
      1 => 1604744353,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165205fd4e74b4d4ce8-86643647',
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
  'unifunc' => 'content_5fd4e74b4e6063_08332016',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd4e74b4e6063_08332016')) {function content_5fd4e74b4e6063_08332016($_smarty_tpl) {?><section class="pt-50 pt-lg-90">  <div class="container text-center">    <div class="row justify-content-center">      <div class="col-lg-5">        <div class="title-group">          <h1 class="title text-body-quaternary fz-32 lh-12 fw-700">            <?php echo titulo('entre_contato_simples','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-10 lh-15">            <?php echo titulo('entre_contato_simples','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>        <div class="mt-40">          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/form-interessado.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        </div>      </div>    </div>  </div></section><?php }} ?>