<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:05
         compiled from "core\templates\producao\diagnostico\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114715f84b9491b1361-70306941%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57dd7d3458e3e0e6c608e13c655d5147d63423fb' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\rodape.tpl',
      1 => 1599983642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114715f84b9491b1361-70306941',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'enderecos' => 0,
    'endereco' => 0,
    'pagina_atual' => 0,
    'labcloud_config' => 0,
    'requisicao' => 0,
    'horarios' => 0,
    'horario' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
    'selos' => 0,
    'selo' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b94922e161_78648948',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b94922e161_78648948')) {function content_5f84b94922e161_78648948($_smarty_tpl) {?><footer id="rodape" class="text-white bg-secondary fz-16">
" title="Acesse a página inicial">
imagens/logo-rodape.png"
">

 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Bairro_txf;?>
<br/>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
,<br/>

imagens/afiliada.png" class="img-fluid"/>
inicio">
sobre">
servicos"
exames"
"
blog">
contato">
 $_from = $_smarty_tpl->tpl_vars['horarios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['horario']->key => $_smarty_tpl->tpl_vars['horario']->value){
$_smarty_tpl->tpl_vars['horario']->_loop = true;
?>
</li>
</li>
</li>
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>

 $_from = $_smarty_tpl->tpl_vars['selos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['selo']->key => $_smarty_tpl->tpl_vars['selo']->value){
$_smarty_tpl->tpl_vars['selo']->_loop = true;
?>
" class="mb-5">
" target="_blank">
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['selo']->value->Imagens[0]->Caminho_txf;?>
"/>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
 - Todos os direitos reservados</div>