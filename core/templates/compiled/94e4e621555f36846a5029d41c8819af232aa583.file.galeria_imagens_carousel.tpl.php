<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 03:49:10
         compiled from "core\templates\producao\vet_life\site\componentes\galeria_imagens_carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:256355f8fcbd616cac2-17021070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94e4e621555f36846a5029d41c8819af232aa583' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\componentes\\galeria_imagens_carousel.tpl',
      1 => 1599991170,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '256355f8fcbd616cac2-17021070',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'itens' => 0,
    'nav' => 0,
    'dots' => 0,
    'imagens' => 0,
    'id' => 0,
    'pagination' => 0,
    'item_class' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f8fcbd61c7eb1_63799051',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8fcbd61c7eb1_63799051')) {function content_5f8fcbd61c7eb1_63799051($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['itens']->value)===null||$tmp==='' ? '1-2-4' : $tmp), null, 0);?>
">
"
<?php }?>"
"
 .owl-dots"
 .owl-nav"
 $_from = $_smarty_tpl->tpl_vars['imagens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imagem']->key => $_smarty_tpl->tpl_vars['imagem']->value){
$_smarty_tpl->tpl_vars['imagem']->_loop = true;
?>
"
/<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"
"
/<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
" class="img-fit"/>