<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 09:57:33
         compiled from "core\templates\producao\abseg\site\blocos\extracurricular\paginas_var.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125765f50e83de514a8-39855674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bc9d70110fec46c565edf173d492e193bc421c7' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\extracurricular\\paginas_var.tpl',
      1 => 1595867777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125765f50e83de514a8-39855674',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'extracurriculares_pgs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e83de6cfb9_25311443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e83de6cfb9_25311443')) {function content_5f50e83de6cfb9_25311443($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['extracurriculares_pgs'] = new Smarty_variable(array(array("nome"=>"Esportes","link"=>"esportes","imagem"=>"esportes-ico.png"),array("nome"=>"Espanhol","link"=>"espanhol","imagem"=>"espanhol-ico.png"),array("nome"=>"Intercâmbio","link"=>"intercambio","imagem"=>"intercambio-ico.png"),array("nome"=>"Eventos","link"=>"eventos","imagem"=>"eventos-ico.png")), null, 0);?><?php $_smarty_tpl->tpl_vars['extracurriculares_pgs'] = new Smarty_variable($_smarty_tpl->tpl_vars['extracurriculares_pgs']->value, null, 3);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars['extracurriculares_pgs'] = clone $_smarty_tpl->tpl_vars['extracurriculares_pgs']; $_ptr = $_ptr->parent; }
Smarty::$global_tpl_vars['extracurriculares_pgs'] = clone $_smarty_tpl->tpl_vars['extracurriculares_pgs'];?><?php }} ?>