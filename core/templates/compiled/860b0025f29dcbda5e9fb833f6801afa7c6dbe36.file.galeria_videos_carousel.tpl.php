<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 14:23:40
         compiled from "core\templates\producao\diagnostico\site\componentes\galeria_videos_carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245415f64ed1c658c01-77795270%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '860b0025f29dcbda5e9fb833f6801afa7c6dbe36' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\componentes\\galeria_videos_carousel.tpl',
      1 => 1599991199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245415f64ed1c658c01-77795270',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'itens' => 0,
    'nav' => 0,
    'dots' => 0,
    'videos' => 0,
    'id' => 0,
    'pagination' => 0,
    'item_class' => 0,
    'video' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64ed1c68fbf5_68416093',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64ed1c68fbf5_68416093')) {function content_5f64ed1c68fbf5_68416093($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['itens']->value)===null||$tmp==='' ? '4-2-1' : $tmp), null, 0);?>
">
"
<?php }?>"
"
 .owl-dots"
 .owl-nav"
 $_from = $_smarty_tpl->tpl_vars['videos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['video']->key => $_smarty_tpl->tpl_vars['video']->value){
$_smarty_tpl->tpl_vars['video']->_loop = true;
?>
"
"
"
/mqdefault.jpg"
" title="<?php echo $_smarty_tpl->tpl_vars['video']->value->Descricao_txf;?>
"