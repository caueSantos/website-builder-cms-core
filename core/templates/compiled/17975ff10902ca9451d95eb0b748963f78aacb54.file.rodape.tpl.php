<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:52
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:246805f90ff80b75f01-24606072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17975ff10902ca9451d95eb0b748963f78aacb54' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\global\\rodape.tpl',
      1 => 1603330563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '246805f90ff80b75f01-24606072',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'sobre' => 0,
    'selos' => 0,
    'selo' => 0,
    'painel' => 0,
    'pagina_atual' => 0,
    'labcloud_config' => 0,
    'enderecos' => 0,
    'endereco' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff80bf5657_68846090',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff80bf5657_68846090')) {function content_5f90ff80bf5657_68846090($_smarty_tpl) {?><footer id="rodape" class="fz-12 lh-15 text-body-quaternary">
" title="Acesse a página inicial">
imagens/logo-rodape.png"
">

 $_from = $_smarty_tpl->tpl_vars['selos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['selo']->key => $_smarty_tpl->tpl_vars['selo']->value){
$_smarty_tpl->tpl_vars['selo']->_loop = true;
?>
" class="col-6 col-md-auto mb-5 pr-md-10">
" target="_blank">
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['selo']->value->Imagens[0]->Caminho_txf;?>
"/>
#inicio"
#sobre"
#servicos"
#parceiros"
#contato"
#localizacao"
"
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Bairro_txf;?>
<br>
 <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>

 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>

 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
 - Todos os direitos reservados</div>