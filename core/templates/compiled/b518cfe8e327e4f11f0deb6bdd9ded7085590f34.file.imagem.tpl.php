<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 05:08:02
         compiled from "core\templates\producao\diagnostico\site\componentes\imagem.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142525f5dd362b28610-41793960%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b518cfe8e327e4f11f0deb6bdd9ded7085590f34' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\componentes\\imagem.tpl',
      1 => 1595876123,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142525f5dd362b28610-41793960',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'height' => 0,
    'radius' => 0,
    'fill_height' => 0,
    'no_bg' => 0,
    'figure_height' => 0,
    'imagem' => 0,
    'painel' => 0,
    'fluid' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5dd362b52407_17789600',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5dd362b52407_17789600')) {function content_5f5dd362b52407_17789600($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['height']->value){?><?php $_smarty_tpl->tpl_vars['height'] = new Smarty_variable(300, null, 0);?><?php }?>
">
" itemprop="image"
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
"
" title="<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Descricao_txf;?>
"
" itemprop="image"
imagens/indisponivel.png"