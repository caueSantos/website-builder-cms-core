<?php /* Smarty version Smarty-3.1.12, created on 2020-09-28 15:33:29
         compiled from "core\templates\producao\diagnostico\site\ajax\headinterna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48505f722c7988c973-04960536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78b2d257168d942826e852c36cf6a7afea2f3f19' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\ajax\\headinterna.tpl',
      1 => 1600189362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48505f722c7988c973-04960536',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f722c798a3875_18400551',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f722c798a3875_18400551')) {function content_5f722c798a3875_18400551($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable('<strong>Blog</strong>', null, 0);?><?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable('Conheça as últimas novidades do Diagnóstico Lab', null, 0);?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>