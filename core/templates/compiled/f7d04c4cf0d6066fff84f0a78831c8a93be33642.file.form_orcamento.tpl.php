<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 09:57:34
         compiled from "core\templates\producao\abseg\site\blocos\servicos\form_orcamento.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193495f50e83e66a189-77969891%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7d04c4cf0d6066fff84f0a78831c8a93be33642' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\servicos\\form_orcamento.tpl',
      1 => 1595620724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193495f50e83e66a189-77969891',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'emails' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e83e66f5c9_03362179',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e83e66f5c9_03362179')) {function content_5f50e83e66f5c9_03362179($_smarty_tpl) {?><form class="form-orcamento" onsubmit="return false">    <div class="form-lands-group">        <label for="Nome_txf">Nome completo*</label>        <input class="form-lands" name="Nome_completo_txf" type="text" required/>    </div>    <div class="form-lands-group">        <label for="Email_txf">Digite seu email*</label>        <input class="form-lands" name="Email_txf" type="text" required/>    </div>    <div class="form-lands-group">        <label for="Telefone_txf">Digite seu telefone*</label>        <input class="form-lands" name="Telefone_txf" type="text" required/>    </div>    <input id="servico-escolhido" name="Servico_txf" type="hidden" value=""/>    <input type="hidden" value="_orcamentos" name="Tabela_txf"/>    <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>    <input type="hidden" value="SIM" name="Envia_email_txf"/>    <input type="hidden" value="Consumo Light" name="Nome_txf"/>    <input type="hidden" name="Assunto_txf" value="Novo orçamento solicitado!"/>    <input type="hidden" name="Titulo_txf" value="Novo orçamento solicitado!"/>    <input type="hidden" value="orcamento" name="Tpl_txf"/>    <input name="Tipo_lead_txf" type="hidden" value="orcamento"/>    <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>    <button class="btn-lands btn-block" type="submit">Enviar mensagem</button>    <button class="btn-lands btn-block" type="submit">Enviar mensagem</button></form><?php }} ?>