<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:40
         compiled from "core\templates\producao\abseg\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169705f53def00c65b6-31144001%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c9cd960ab08b7d6d0fc7b1ecd0523b06ac59771' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\rodape.tpl',
      1 => 1599260075,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169705f53def00c65b6-31144001',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'sobre' => 0,
    'pagina_atual' => 0,
    'requisicao' => 0,
    'materiais_lista' => 0,
    'nivel' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'emails' => 0,
    'email' => 0,
    'enderecos' => 0,
    'endereco' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53def012f6a9_63105787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53def012f6a9_63105787')) {function content_5f53def012f6a9_63105787($_smarty_tpl) {?><footer id="rodape" class="text-body-primary">
" title="Acesse a página inicial">
imagens/logo-rodape.png"
">
</div>

imagens/afiliada.png" class="img-fluid"/>
inicio">
sobre">
contato">
central-de-ajuda">
blog">
contato">
cotacao">
 $_from = $_smarty_tpl->tpl_vars['materiais_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nivel']->key => $_smarty_tpl->tpl_vars['nivel']->value){
$_smarty_tpl->tpl_vars['nivel']->_loop = true;
?>
"

 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>
 $_from = $_smarty_tpl->tpl_vars['emails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
?>
</li>
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>
, <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
, Brasil</li>

 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
 - Todos os direitos reservados</div>