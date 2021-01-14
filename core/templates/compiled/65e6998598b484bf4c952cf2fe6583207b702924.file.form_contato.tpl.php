<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:49
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\contato\form_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24655f90ff7d8e2683-16299659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '65e6998598b484bf4c952cf2fe6583207b702924' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\contato\\form_contato.tpl',
      1 => 1603248491,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24655f90ff7d8e2683-16299659',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo_contato' => 0,
    'emails' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff7d8ed562_30604764',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7d8ed562_30604764')) {function content_5f90ff7d8ed562_30604764($_smarty_tpl) {?><form class="form-contato" onsubmit="return false">  <div class="form-lands-group">    <input placeholder="Digite seu nome" class="form-lands" name="Nome_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu email*" class="form-lands" name="Email_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu telefone*" class="form-lands phone-mask" name="Telefone_txf" type="text" required/>  </div>  <div class="form-lands-group">    <textarea style="min-height: 140px;" placeholder="Digite sua mensagem" name="Mensagem_txa"              class="form-lands"></textarea>  </div>  <input name="Tipo_contato_txf" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tipo_contato']->value)===null||$tmp==='' ? 'CONTATO' : $tmp);?>
"/>  <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <input id='lands_id' value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <button class="btn-lands btn-block" type="submit">    Enviar mensagem  </button></form><?php }} ?>