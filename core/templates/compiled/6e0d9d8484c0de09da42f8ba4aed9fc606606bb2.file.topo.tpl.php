<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:39
         compiled from "core\templates\producao\abseg\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235325f53deefd4a534-68395307%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e0d9d8484c0de09da42f8ba4aed9fc606606bb2' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\topo.tpl',
      1 => 1599260048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235325f53deefd4a534-68395307',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'solucoes_lista' => 0,
    'segment2' => 0,
    'nivel' => 0,
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53deefd97622_32596002',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53deefd97622_32596002')) {function content_5f53deefd97622_32596002($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>

" class="d-block" title="Acesse a página inicial">
imagens/logo-colorido-topo.png"
">
imagens/logo-branca-topo.png"
">
inicio">
sobre">
solucoes"
 $_from = $_smarty_tpl->tpl_vars['solucoes_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nivel']->key => $_smarty_tpl->tpl_vars['nivel']->value){
$_smarty_tpl->tpl_vars['nivel']->_loop = true;
?>
solucoes/<?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_url;?>
">

central-de-ajuda">
blog">
contato">
cotacao">