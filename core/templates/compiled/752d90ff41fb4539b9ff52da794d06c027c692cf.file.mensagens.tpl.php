<?php /* Smarty version Smarty-3.1.12, created on 2020-11-02 23:17:01
         compiled from "core\templates\producao\zehimoveis\site\ajax\mensagens.tpl" */ ?>
<?php /*%%SmartyHeaderCode:313265fa0af8d3c3197-43535536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '752d90ff41fb4539b9ff52da794d06c027c692cf' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\ajax\\mensagens.tpl',
      1 => 1595623808,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313265fa0af8d3c3197-43535536',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mensagem' => 0,
    'post' => 0,
    'lead_inserido' => 0,
    'registros' => 0,
    'requisicao' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa0af8d42da87_63863030',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa0af8d42da87_63863030')) {function content_5fa0af8d42da87_63863030($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['mensagem']->value=='lead_inserido'&&$_smarty_tpl->tpl_vars['post']->value['Tipo_lead_txf']=='simulacao'){?>

<?php echo $_smarty_tpl->tpl_vars['requisicao']->value->Email_txf;?>
.</p>
";