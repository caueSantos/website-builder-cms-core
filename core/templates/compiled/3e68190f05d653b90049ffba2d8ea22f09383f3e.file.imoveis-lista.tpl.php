<?php /* Smarty version Smarty-3.1.12, created on 2021-01-02 23:29:59
         compiled from "core\templates\producao\hubvet\site\blocos\imoveis\imoveis-lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:290095ff11e17782e13-94087540%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e68190f05d653b90049ffba2d8ea22f09383f3e' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\imoveis\\imoveis-lista.tpl',
      1 => 1604744354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '290095ff11e17782e13-94087540',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cols' => 0,
    'imoveis_registros' => 0,
    'id' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff11e177a5573_05365282',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff11e177a5573_05365282')) {function content_5ff11e177a5573_05365282($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['cols']->value)===null||$tmp==='' ? 'col-lg-4' : $tmp), null, 0);?>

<?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable((('lista-').(rand())).(rand()), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['imoveis_registros']->value){?>
<div class="lista-imoveis" id="lista-imoveis-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">

  <div class="row owl-carousel owl-responsive justify-content-lg-center"
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="true"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container="#lista-imoveis-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-dots"
  >

    <?php  $_smarty_tpl->tpl_vars['imovel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['imovel']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['imoveis_registros']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imovel']->key => $_smarty_tpl->tpl_vars['imovel']->value){
$_smarty_tpl->tpl_vars['imovel']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['imovel']->key;
?>

    <div class="col-link col <?php echo $_smarty_tpl->tpl_vars['cols']->value;?>
 mb-0 mb-lg-40 item">
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/imovel-item.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>

    <?php } ?>

  </div>

  <div class="rounded-dots d-block d-lg-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</div>
<?php }?>
<?php }} ?>