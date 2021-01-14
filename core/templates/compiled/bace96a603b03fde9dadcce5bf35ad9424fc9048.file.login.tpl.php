<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 02:51:00
         compiled from "core\templates\padrao\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:108465fd2fab429b091-17000969%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bace96a603b03fde9dadcce5bf35ad9424fc9048' => 
    array (
      0 => 'core\\templates\\padrao\\login.tpl',
      1 => 1599972647,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108465fd2fab429b091-17000969',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'redirect_link' => 0,
    'Login_txf' => 0,
    'Senha_txp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2fab42b4f63_67250615',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2fab42b4f63_67250615')) {function content_5fd2fab42b4f63_67250615($_smarty_tpl) {?><form action="<?php echo base_url();?>
login/fazer_login" method="post">    <input type="hidden"  id="Lands_id" name="Lands_id" value='<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
'/>        <input type="hidden"  id="redirect_link" name="redirect_link" value='<?php if ((isset($_smarty_tpl->tpl_vars['redirect_link']->value))){?><?php echo $_smarty_tpl->tpl_vars['redirect_link']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php }?>'/>    <div class="form-group">        <label  for="Login_txf">Login</label>        <input  id="Login_txf" name="Login_txf" type="text" placeholder="login" class="form-control" value='<?php if (is_lands()){?>lands<?php }?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['Login_txf']->value)===null||$tmp==='' ? '' : $tmp);?>
'>    </div>    <div class="form-group">        <label  for="Senha_txp">Senha</label>        <input  id="Senha_txp" name="Senha_txp" type="password" placeholder="senha" class="form-control" value='<?php if (is_lands()){?>Ldlf8384@1<?php }?><?php echo (($tmp = @$_smarty_tpl->tpl_vars['Senha_txp']->value)===null||$tmp==='' ? '' : $tmp);?>
'>    </div>    <input id="signIn" name="signIn" class="btn btn-primary btn-block" type="submit" value="Fazer login"></form><?php }} ?>