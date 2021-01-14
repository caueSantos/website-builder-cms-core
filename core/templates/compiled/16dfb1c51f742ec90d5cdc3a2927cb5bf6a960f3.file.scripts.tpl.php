<?php /* Smarty version Smarty-3.1.12, created on 2020-09-28 15:33:00
         compiled from "core\templates\producao\diagnostico\site\ajax\scripts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136125f722c5c297ba2-30904663%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16dfb1c51f742ec90d5cdc3a2927cb5bf6a960f3' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\ajax\\scripts.tpl',
      1 => 1599259863,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136125f722c5c297ba2-30904663',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'whats' => 0,
    'pagina_atual' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f722c5c2d7771_78730319',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f722c5c2d7771_78730319')) {function content_5f722c5c2d7771_78730319($_smarty_tpl) {?><script>  window.app = <?php echo json_encode($_smarty_tpl->tpl_vars['app']->value);?>
;  window.appUrl = '<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
';  window.whatsappPlugin = <?php echo json_encode($_smarty_tpl->tpl_vars['whats']->value[0]);?>
;  window.utils = {    paginaAtual: '<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
'  };</script><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/scripts.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Scripts_txa;?>
<?php }} ?>