<?php /* Smarty version Smarty-3.1.12, created on 2020-10-18 19:20:56
         compiled from "core\templates\producao\vet_life\site\componentes\galeria_videos_carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50115f8cb1b8e6c1c8-66226951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '145233a745f80fc5c93c33d2b1b057c7fd2a7dab' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\componentes\\galeria_videos_carousel.tpl',
      1 => 1599991199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50115f8cb1b8e6c1c8-66226951',
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
  'unifunc' => 'content_5f8cb1b8ec0637_87060629',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8cb1b8ec0637_87060629')) {function content_5f8cb1b8ec0637_87060629($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['itens']->value)===null||$tmp==='' ? '4-2-1' : $tmp), null, 0);?>
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