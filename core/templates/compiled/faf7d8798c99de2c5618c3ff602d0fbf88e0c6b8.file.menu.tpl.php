<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:55:52
         compiled from "core\templates\producao\hubvet\site\blocos\materiais\menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13288601b62383a4fd5-27409957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'faf7d8798c99de2c5618c3ff602d0fbf88e0c6b8' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\materiais\\menu.tpl',
      1 => 1610941449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13288601b62383a4fd5-27409957',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'labels' => 0,
    'label' => 0,
    'materiais_categorias' => 0,
    'cat' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b62383e3e44_52363913',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b62383e3e44_52363913')) {function content_601b62383e3e44_52363913($_smarty_tpl) {?><aside class="menu-lateral">

  <div class="pb-15">
    <div class="fz-14 text-body-secondary mb-5 pl-md-15">
      <?php echo trans('materiais_para');?>

    </div>
    <select class="d-block custom-select cursor-pointer text-center">
      <option value="todos">
        <?php echo trans('todos');?>

      </option>
      <?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['labels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value){
$_smarty_tpl->tpl_vars['label']->_loop = true;
?>
      <option value="<?php echo $_smarty_tpl->tpl_vars['label']->value->Nome_url;?>
">
        <?php echo $_smarty_tpl->tpl_vars['label']->value->Nome_tit;?>

      </option>
      <?php } ?>
    </select>
  </div>

  <hr/>

  <ul class="menu lh-2 pt-10">

    <li class="mb-10 pl-md-15">
      <a
        href="<?php echo gera_link('materiais',true);?>
"
        class="text-body-primary text-primary-hover menu-item"
      >
        <?php echo trans('todos');?>

      </a>
    </li>

    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['materiais_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>
    <li class="mb-10 pl-md-15">
      <a
        data-id="<?php echo $_smarty_tpl->tpl_vars['cat']->value->Nome_url;?>
"
        href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['cat']->value->Nome_url;?>
<?php $_tmp1=ob_get_clean();?><?php echo gera_link(('materiais/#/').($_tmp1),true);?>
"
        class="text-body-primary text-primary-hover menu-item"
      >
        <?php echo $_smarty_tpl->tpl_vars['cat']->value->Nome_tit;?>

      </a>
    </li>
    <?php } ?>

  </ul>

</aside>
<?php }} ?>