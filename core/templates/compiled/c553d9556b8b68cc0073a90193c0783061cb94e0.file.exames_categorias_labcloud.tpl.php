<?php /* Smarty version Smarty-3.1.12, created on 2020-09-14 02:38:16
         compiled from "core\templates\producao\diagnostico\site\blocos\exames\exames_categorias_labcloud.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157645f5f01c86526e0-82452508%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c553d9556b8b68cc0073a90193c0783061cb94e0' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\exames\\exames_categorias_labcloud.tpl',
      1 => 1584564049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157645f5f01c86526e0-82452508',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'todas_categorias' => 0,
    'segment2' => 0,
    'categoria' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5f01c8670dc2_94073624',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5f01c8670dc2_94073624')) {function content_5f5f01c8670dc2_94073624($_smarty_tpl) {?>
<div class="categoriasgeral">
    <div class="tit-rep">Tipos de Exames</div>
    <ul>
        <li class="cat">
            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
exames">Todos</a>
        </li>
        <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['todas_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
        <li class="cat">
            <a <?php if (($_smarty_tpl->tpl_vars['segment2']->value==$_smarty_tpl->tpl_vars['categoria']->value->Nome_url)){?> class="ativo" <?php }?> href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
exames/<?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_url;?>
" title="<?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_tit;?>
">
                <?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_tit;?>

            </a>
        </li>
        <?php } ?>
    </ul>
</div>
 
<?php }} ?>