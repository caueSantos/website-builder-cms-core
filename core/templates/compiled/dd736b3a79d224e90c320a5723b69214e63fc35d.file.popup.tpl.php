<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\componentes\popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:49375ffd8a947bcde0-49761653%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd736b3a79d224e90c320a5723b69214e63fc35d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\componentes\\popup.tpl',
      1 => 1607656687,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '49375ffd8a947bcde0-49761653',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'popup' => 0,
    'alerta' => 0,
    'app' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9482e135_35854266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9482e135_35854266')) {function content_5ffd8a9482e135_35854266($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['alerta'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['alerta']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['popup']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['alerta']->key => $_smarty_tpl->tpl_vars['alerta']->value){
$_smarty_tpl->tpl_vars['alerta']->_loop = true;
?>
" tabindex="-1" role="dialog" aria-labelledby="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
-label" aria-hidden="true">
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Imagens[0]->Caminho_txf;?>
" />
" tabindex="-1" role="dialog" aria-labelledby="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
-label" aria-hidden="true">
-label"><?php echo $_smarty_tpl->tpl_vars['alerta']->value->Titulo_txf;?>
</h5>
$_smarty_tpl->tpl_vars['config']->value['img_classe'] = '';?>
$_smarty_tpl->tpl_vars['config']->value['img_fora'] = 'text-center';?>
$_smarty_tpl->tpl_vars['config']->value['img_style'] = 'width: auto;';?>
$_smarty_tpl->tpl_vars['config']->value['vid_fora'] = 'text-center';?>
$_smarty_tpl->tpl_vars['config']->value['vid_style'] = 'width:100%;height:400px;';?>
$_smarty_tpl->tpl_vars['config']->value['tipo_nota'] = 'popover';?>
</div>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Imagens[0]->Caminho_txf;?>
" />
');
').modal('show');
').modal('show');
);