<?php /* Smarty version Smarty-3.1.12, created on 2020-11-02 14:54:27
         compiled from "core\templates\producao\zehimoveis\site\componentes\galeria_videos_carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197305fa039c3c1b348-71821811%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a56e35e7d1fb5945a7cf198adffb3351ff928ba' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\componentes\\galeria_videos_carousel.tpl',
      1 => 1599991199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197305fa039c3c1b348-71821811',
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
  'unifunc' => 'content_5fa039c3c6a2c8_38041174',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa039c3c6a2c8_38041174')) {function content_5fa039c3c6a2c8_38041174($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['itens']->value)===null||$tmp==='' ? '4-2-1' : $tmp), null, 0);?>
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