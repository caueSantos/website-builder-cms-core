<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 10:02:42
         compiled from "core\templates\producao\labcearensediagn\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:221785f92c662d72c29-65290935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73fcb29f4df517f7769bc492e797844d90015e76' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\global\\topo.tpl',
      1 => 1603426055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '221785f92c662d72c29-65290935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'enderecos' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'labcloud_config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f92c662e51ed2_97289014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c662e51ed2_97289014')) {function content_5f92c662e51ed2_97289014($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">
 -
 -

,

 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['telefone']->key;
?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>

" class="d-block" title="Acesse a página inicial">
imagens/logo-topo.png"
">
#inicio"
#sobre"
#servicos"
#parceiros"
#contato"
#localizacao"
"
"
">
imagens/icone-cadastre.png" class="pe-none"/></span>