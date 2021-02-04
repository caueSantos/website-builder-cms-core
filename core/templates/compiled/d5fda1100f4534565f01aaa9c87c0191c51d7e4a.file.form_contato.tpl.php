<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:59:44
         compiled from "core\templates\producao\hubvet\site\blocos\contato\form_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31325601b63207b2ea8-08809078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5fda1100f4534565f01aaa9c87c0191c51d7e4a' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\contato\\form_contato.tpl',
      1 => 1612076864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31325601b63207b2ea8-08809078',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo' => 0,
    'outline' => 0,
    'labels' => 0,
    'label' => 0,
    'tipo_contato' => 0,
    'emails' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b63207e45d8_94679506',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b63207e45d8_94679506')) {function content_601b63207e45d8_94679506($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tipo']->value)===null||$tmp==='' ? 0 : $tmp), null, 0);?><?php if ($_smarty_tpl->tpl_vars['tipo']->value==1){?><?php $_smarty_tpl->tpl_vars['outline'] = new Smarty_variable('form-outline form-dark', null, 0);?><?php }?><form class="form-contato" onsubmit="return false">  <div class="form-lands-group">    <input placeholder="<?php echo trans('form_nome');?>
*" class="form-lands <?php echo $_smarty_tpl->tpl_vars['outline']->value;?>
" name="Nome_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="<?php echo trans('form_email');?>
*" class="form-lands <?php echo $_smarty_tpl->tpl_vars['outline']->value;?>
" name="Email_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="<?php echo trans('form_telefone');?>
*" class="form-lands phone-mask <?php echo $_smarty_tpl->tpl_vars['outline']->value;?>
" name="Telefone_txf" type="text" required/>  </div>  <div class="form-lands-group">    <select name="Persona_sel" class="d-block custom-select cursor-pointer form-lands">      <option disabled selected>        <?php echo trans('form_contato_selecione');?>
      </option>      <?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['labels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value){
$_smarty_tpl->tpl_vars['label']->_loop = true;
?>      <option value="<?php echo $_smarty_tpl->tpl_vars['label']->value->Nome_url;?>
">        <?php echo $_smarty_tpl->tpl_vars['label']->value->Nome_tit;?>
      </option>      <?php } ?>    </select>  </div>  <div class="form-lands-group">    <textarea style="min-height: 140px;" placeholder="<?php echo trans('form_mensagem');?>
" name="Mensagem_txa"              class="form-lands <?php echo $_smarty_tpl->tpl_vars['outline']->value;?>
"></textarea>  </div>  <input name="Tipo_contato_txf" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tipo_contato']->value)===null||$tmp==='' ? 'CONTATO' : $tmp);?>
"/>  <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <input id='lands_id' value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <button class="btn-lands btn-primary btn-lg btn-block" type="submit">    <?php echo trans('form_enviar');?>
  </button></form><?php }} ?>