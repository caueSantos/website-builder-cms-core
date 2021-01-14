<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 09:53:15
         compiled from "core\templates\producao\labcearensediagn\site\blocos\contato\form_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32165f92c42bc3f054-68114649%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9526a93ae7f3d53af32725738ae73e8d2a35e6dd' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\contato\\form_contato.tpl',
      1 => 1603248491,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32165f92c42bc3f054-68114649',
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
  'unifunc' => 'content_5f92c42bc49f49_67143141',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c42bc49f49_67143141')) {function content_5f92c42bc49f49_67143141($_smarty_tpl) {?><form class="form-contato" onsubmit="return false">  <div class="form-lands-group">    <input placeholder="Digite seu nome" class="form-lands" name="Nome_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu email*" class="form-lands" name="Email_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu telefone*" class="form-lands phone-mask" name="Telefone_txf" type="text" required/>  </div>  <div class="form-lands-group">    <textarea style="min-height: 140px;" placeholder="Digite sua mensagem" name="Mensagem_txa"              class="form-lands"></textarea>  </div>  <input name="Tipo_contato_txf" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tipo_contato']->value)===null||$tmp==='' ? 'CONTATO' : $tmp);?>
"/>  <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <input id='lands_id' value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <button class="btn-lands btn-block" type="submit">    Enviar mensagem  </button></form><?php }} ?>