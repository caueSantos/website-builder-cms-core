<?php /* Smarty version Smarty-3.1.12, created on 2020-11-02 21:37:00
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\noticias.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120595fa0981cb2a0a8-95428450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7eb41ff7d11b7dacfd426e31d810ff647a257dd5' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\noticias.tpl',
      1 => 1599990531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120595fa0981cb2a0a8-95428450',
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
  'unifunc' => 'content_5fa0981cb63c78_46974221',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa0981cb63c78_46974221')) {function content_5fa0981cb63c78_46974221($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['noticias'] = new Smarty_variable(wp_posts(2,9,false), null, 0);?>
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