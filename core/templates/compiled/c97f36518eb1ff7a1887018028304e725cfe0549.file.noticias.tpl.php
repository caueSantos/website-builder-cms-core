<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:39
         compiled from "core\templates\producao\abseg\site\blocos\global\noticias.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85155f53deef799244-65485421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c97f36518eb1ff7a1887018028304e725cfe0549' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\noticias.tpl',
      1 => 1599274803,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85155f53deef799244-65485421',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'noticias' => 0,
    'noticia' => 0,
    'assets' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53deef7cbc04_67839770',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53deef7cbc04_67839770')) {function content_5f53deef7cbc04_67839770($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['noticias'] = new Smarty_variable(wp_posts(2,9,false,'wp'), null, 0);?>


 $_from = $_smarty_tpl->tpl_vars['noticias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['noticia']->key => $_smarty_tpl->tpl_vars['noticia']->value){
$_smarty_tpl->tpl_vars['noticia']->_loop = true;
?>
"
" src="<?php echo $_smarty_tpl->tpl_vars['noticia']->value->image;?>
" class="img-fit"/>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"


blog" class="btn-lands  btn-outline">