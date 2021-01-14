<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:44
         compiled from "core\templates\producao\abseg\site\blocos\contato\form_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:263705f50e9b0d33b47-88497718%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c177afa0f82e9359b7dd9da4f1fa540d4341f532' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\contato\\form_contato.tpl',
      1 => 1599130580,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '263705f50e9b0d33b47-88497718',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo_contato' => 0,
    'emails' => 0,
    'app' => 0,
    'pagina_atual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9b0d43002_15672783',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9b0d43002_15672783')) {function content_5f50e9b0d43002_15672783($_smarty_tpl) {?><form class="form-contato" onsubmit="return false">  <div class="form-lands-group">    <input placeholder="Digite seu nome" class="form-lands" name="Nome_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu email*" class="form-lands" name="Email_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu telefone*" class="form-lands phone-mask" name="Telefone_txf" type="text" required/>  </div>  <div class="form-lands-group">    <textarea style="min-height: 140px;" placeholder="Escreva sua mensagem" name="Mensagem_txa"              class="form-lands"></textarea>  </div>  <input name="Tipo_contato_txf" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tipo_contato']->value)===null||$tmp==='' ? 'CONTATO' : $tmp);?>
"/>  <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <input id='lands_id' value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='central-de-ajuda'){?>  <button class="btn-lands btn-block btn-accent tt-upper" type="submit">    Enviar  </button>  <?php }else{ ?>  <button class="btn-lands btn-block btn-secondary br-1 tt-upper" type="submit">    Enviar  </button>  <?php }?></form><?php }} ?>