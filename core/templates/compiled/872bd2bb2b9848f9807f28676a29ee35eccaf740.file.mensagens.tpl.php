<?php /* Smarty version Smarty-3.1.12, created on 2021-02-03 02:30:13
         compiled from "core\templates\producao\hubvet\site\ajax\mensagens.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17716601a26d54b1e38-34751178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '872bd2bb2b9848f9807f28676a29ee35eccaf740' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\ajax\\mensagens.tpl',
      1 => 1612324597,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17716601a26d54b1e38-34751178',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'mensagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601a26d54c12b7_97564610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601a26d54c12b7_97564610')) {function content_601a26d54c12b7_97564610($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['post']->value['Meio_envio_txf']=='AJAX'){?><?php echo json_encode(array('request'=>$_smarty_tpl->tpl_vars['post']->value,'message'=>$_smarty_tpl->tpl_vars['mensagem']->value));?>
<?php }else{ ?><div class="resposta" style="margin-top:10px;">  <script type="text/javascript" charset="utf-8">    processaMensagemAlert('<?php echo $_smarty_tpl->tpl_vars['mensagem']->value;?>
');  </script></div><?php }?><?php }} ?>