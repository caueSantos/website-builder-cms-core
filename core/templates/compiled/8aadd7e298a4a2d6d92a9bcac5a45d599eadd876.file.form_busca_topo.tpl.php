<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\busca\form_busca_topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210845fd2df4a2e52d9-18724002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8aadd7e298a4a2d6d92a9bcac5a45d599eadd876' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\busca\\form_busca_topo.tpl',
      1 => 1604788940,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210845fd2df4a2e52d9-18724002',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_principal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a2e8f54_38478994',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a2e8f54_38478994')) {function content_5fd2df4a2e8f54_38478994($_smarty_tpl) {?><form autocomplete="off" class="busca form-busca" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['url_principal']->value;?>
busca" data-tpl="mini"      data-autocomplete="#retorno-personalizado-topo">  <div class="form-lands-group form-autocomplete mb-0">    <div class="icone lh-0">      <i class="fz-20 fas fa-search text-secondary"></i>    </div>    <input      name="valor"      autocomplete="off"      class="form-lands busca-ajax mb-0"      type="text"      placeholder="Digite o n° de referência ou endereço"    />    <input type="hidden" name="Tabelas_txf" value="empreendimentos,imoveis">    <input type="hidden" name="Campos_txf" value="Referencia_txf,Nome_tit,Descricao_txa,Endereco_txf,Bairro_txf,Cidade_txf,Estado_est,Cep_txf">    <div id="retorno-personalizado-topo" class="form-lands-autocomplete br-1" style="display: none; max-height: 300px; overflow-y: auto"></div>  </div></form><?php }} ?>