<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:50:20
         compiled from "core\templates\producao\hubvet\site\blocos\global\forms\materiais-horizontal-secao-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4416601b6efc100bb9-81163804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fbc0df7c21d83f22785f521e0e95752e4b13eb3' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\forms\\materiais-horizontal-secao-form.tpl',
      1 => 1612075800,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4416601b6efc100bb9-81163804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo_contato' => 0,
    'emails' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6efc110793_45096076',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6efc110793_45096076')) {function content_601b6efc110793_45096076($_smarty_tpl) {?><form class="form-contato" onsubmit="return false">  <div class="form-lands-group">    <input      placeholder="<?php echo trans('form_email');?>
*" class="form-lands form-outline form-dark" name="Email_txf"      type="text" required/>  </div>  <div class="form-lands-group">    <select      name="Possui_empresa_sel"      class="d-block custom-select cursor-pointer text-center form-lands"      required    >      <option disabled selected>        <?php echo trans('form_possui_empresa');?>
      </option>      <option value="SIM">        Sim      </option>      <option value="NAO">        Não      </option>    </select>  </div>  <input name="Tipo_contato_txf" type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['tipo_contato']->value)===null||$tmp==='' ? 'CONTATO' : $tmp);?>
"/>  <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <button class="btn-lands btn-accent btn-block btn-lg" type="submit">    <?php echo trans('cadastrar_botao');?>
  </button></form><?php }} ?>