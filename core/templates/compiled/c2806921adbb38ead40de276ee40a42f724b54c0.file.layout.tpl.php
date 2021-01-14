<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 02:51:00
         compiled from "core\templates\padrao\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:241275fd2fab42c47a5-23079252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c2806921adbb38ead40de276ee40a42f724b54c0' => 
    array (
      0 => 'core\\templates\\padrao\\layout.tpl',
      1 => 1599973357,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '241275fd2fab42c47a5-23079252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets_url' => 0,
    'mensagem' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2fab42d9e55_39225931',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2fab42d9e55_39225931')) {function content_5fd2fab42d9e55_39225931($_smarty_tpl) {?><!DOCTYPE html>
<?php $_smarty_tpl->tpl_vars['assets_url'] = new Smarty_variable(($_smarty_tpl->tpl_vars['app']->value->Url_cliente).('core/assets/'), null, 0);?>
<html lang="pt">
<head>

  <meta charset="utf-8">
  <meta content="width=300, initial-scale=1" name="viewport">
  <meta name="description" content="Core Landshosting">
  <title>:: CORE :: Lands Framework</title>
  <link href="<?php echo $_smarty_tpl->tpl_vars['assets_url']->value;?>
bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $_smarty_tpl->tpl_vars['assets_url']->value;?>
padrao/css/login.css" rel="stylesheet">
  <script src="<?php echo $_smarty_tpl->tpl_vars['assets_url']->value;?>
jquery/jquery-2.1.1.min.js"></script>
  <script src="<?php echo $_smarty_tpl->tpl_vars['assets_url']->value;?>
bootstrap/js/bootstrap.min.js"></script>

  <?php echo $_smarty_tpl->tpl_vars['app']->value->Scripts_txa;?>


</head>

<body>

<div class="container">

  <div class="topo text-center">
    <h3> <?php echo $_smarty_tpl->tpl_vars['app']->value->Titulo_txf;?>
</h3>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">

      <div class="panel-heading text-center">
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['mensagem']->value)===null||$tmp==='' ? 'Área restrita, login necessário.' : $tmp);?>

      </div>

      <div class="panel-body">
        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

      </div>

      <div class="panel-footer text-center">
        <small>Caso não possua login, entre em contato conosco.</small>
      </div>

    </div>
  </div>
</div>
</body>
</html>
<?php }} ?>