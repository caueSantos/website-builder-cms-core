<?php /* Smarty version Smarty-3.1.12, created on 2021-01-24 13:56:02
         compiled from "core\templates\producao\hubvet\site\blocos\global\noticias.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9585600d9892f14366-96016153%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3438cc6e578890a9ca5d5a63b5cb43de75ee8849' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\noticias.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9585600d9892f14366-96016153',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'noticias' => 0,
    'noticia' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600d98930079b3_97747209',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600d98930079b3_97747209')) {function content_600d98930079b3_97747209($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['noticias'] = new Smarty_variable(wp_posts(2,9,false), null, 0);?>
imagens/logo-title.png" class="pe-none"/>


 $_from = $_smarty_tpl->tpl_vars['noticias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['noticia']->key => $_smarty_tpl->tpl_vars['noticia']->value){
$_smarty_tpl->tpl_vars['noticia']->_loop = true;
?>
"
" src="<?php echo $_smarty_tpl->tpl_vars['noticia']->value->image;?>
" class="img-fit"/>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"


blog" class="btn-lands btn-block">