<?php /* Smarty version Smarty-3.1.12, created on 2021-02-03 23:58:05
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\formulario.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13537601b54ad6a8bc8-36452090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c55d6798b121703f49a597495411e76b59e11adb' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\formulario.tpl',
      1 => 1612323732,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13537601b54ad6a8bc8-36452090',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b54ad6b9cf3_43511997',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b54ad6b9cf3_43511997')) {function content_601b54ad6b9cf3_43511997($_smarty_tpl) {?><div class="formulario">    <div class="title-group">        <h1 class="title fw-300 text-primary fz-32 lh-12">            <?php echo titulo('envie_seu_curriculo_form','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </h1>        <?php if (titulo('envie_seu_curriculo_form','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>        <div class="texto fz-16 mt-20 lh-15 text-white">            <?php echo titulo('envie_seu_curriculo_form','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </div>        <?php }?>    </div>    <div class="mt-30">        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/form_trabalhe_conosco.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    </div></div><?php }} ?>