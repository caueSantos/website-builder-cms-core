<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40095f84b948de4630-44527579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43f20a3a3d5173beef9bcf0d6a496e18f9e070d0' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\topo.tpl',
      1 => 1600813856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40095f84b948de4630-44527579',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'segment2' => 0,
    'servicos_lista' => 0,
    'nivel' => 0,
    'requisicao' => 0,
    'labcloud_config' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b948e354b4_34556644',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b948e354b4_34556644')) {function content_5f84b948e354b4_34556644($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">
" class="d-block" title="Acesse a página inicial">
imagens/logo-topo.png"
">
inicio">
sobre">
servicos"
servicos">
 $_from = $_smarty_tpl->tpl_vars['servicos_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nivel']->key => $_smarty_tpl->tpl_vars['nivel']->value){
$_smarty_tpl->tpl_vars['nivel']->_loop = true;
?>
servicos/<?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_url;?>
">

exames">
blog">
contato">
">
imagens/icone-cadastre.png" class="pe-none"/></span>
">
