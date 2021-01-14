<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\global\form-interessado.tpl" */ ?>
<?php /*%%SmartyHeaderCode:252175ffd8a94e34379-10125979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d243e8fa11e63014c0c34ba81dfe394f2c85db5' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\form-interessado.tpl',
      1 => 1605585896,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '252175ffd8a94e34379-10125979',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imovel' => 0,
    'empreendimento' => 0,
    'tipo' => 0,
    'app' => 0,
    'emails' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a94e51b90_20144911',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a94e51b90_20144911')) {function content_5ffd8a94e51b90_20144911($_smarty_tpl) {?><?php if (!$_smarty_tpl->tpl_vars['imovel']->value){?><?php $_smarty_tpl->tpl_vars['imovel'] = new Smarty_variable($_smarty_tpl->tpl_vars['empreendimento']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable('EMPREENDIMENTO', null, 0);?><?php }?><form class="form-interessado-imovel" onsubmit="return false">  <div class="form-lands-group">    <input placeholder="Digite seu nome" class="form-lands" name="Nome_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu email*" class="form-lands" name="Email_txf" type="text" required/>  </div>  <div class="form-lands-group">    <input placeholder="Digite seu telefone*" class="form-lands phone-mask" name="Telefone_txf" type="text" required/>  </div>  <div class="form-lands-group">    <textarea style="min-height: 140px;" placeholder="Digite sua mensagem" name="Mensagem_txa"              class="form-lands"></textarea>  </div>  <input value="<?php if ($_smarty_tpl->tpl_vars['tipo']->value){?><?php echo $_smarty_tpl->tpl_vars['tipo']->value;?>
<?php }else{ ?>IMOVEL<?php }?>" name="Tipo_txf" type="hidden"/>  <input value="<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
" name="Imovel_txf" type="hidden"/>  <input value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <input value="imovel-interesse" name="Tpl_txf" type="hidden"/>  <input type="hidden" value="SIM" name="Envia_email_txf"/>  <input type="hidden" name="Titulo_txf" value="Zeh Imóveis - Você está interessado no imóvel <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
!"/>  <input value="Zeh Imóveis - Você está interessado no imóvel <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
!" name="Assunto_txf" type="hidden"/>  <input type="hidden" name="Destinatario_txf" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <input type="hidden" value="_imovel_interesse" name="Tabela_txf"/>  <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>  <button class="btn-lands btn-secondary btn-block" type="submit">    Enviar mensagem  </button></form><?php }} ?>