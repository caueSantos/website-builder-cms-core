<?php /* Smarty version Smarty-3.1.12, created on 2021-01-07 20:04:12
         compiled from "core\templates\producao\hubvet\site\empreendimentos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16775ff7855c3744f4-83124078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e80986eb43183957feb9a3d91566436f693fb2a0' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\empreendimentos.tpl',
      1 => 1604744248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16775ff7855c3744f4-83124078',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'segment2' => 0,
    'CAMINHO_TPL' => 0,
    'titulos' => 0,
    'empreendimentos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff7855c3a3079_10533565',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff7855c3a3079_10533565')) {function content_5ff7855c3a3079_10533565($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['segment2']->value){?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/empreendimentos/interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }else{ ?>
<main id="empreendimentos">

  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable(titulo('interna_empreendimentos','tit',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>
  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


  <div id="wrap" class="pt-lg-90 pt-30 pb-20">
    <?php  $_smarty_tpl->tpl_vars['empreendimento'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['empreendimento']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['empreendimentos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['empreendimento']->key => $_smarty_tpl->tpl_vars['empreendimento']->value){
$_smarty_tpl->tpl_vars['empreendimento']->_loop = true;
?>
    <div class="mb-40">
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/empreendimentos/empreendimento-item.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>
    <?php } ?>
  </div>

</main>
<?php }?>

<?php }} ?>