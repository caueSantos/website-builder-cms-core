<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "core\templates\producao\hubvet\site\blocos\global\meta_tags.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5538601b7f04c6d070-83002533%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd7d5710acaf71f840f58643e2a2813cca3be4c7' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\meta_tags.tpl',
      1 => 1605625173,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5538601b7f04c6d070-83002533',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seo' => 0,
    'app' => 0,
    'url_atual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7f04c8c199_19970267',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04c8c199_19970267')) {function content_601b7f04c8c199_19970267($_smarty_tpl) {?><title><?php echo $_smarty_tpl->tpl_vars['seo']->value->Titulo_sma;?>
</title>

<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="robots" content="index, follow" />

<meta name="format-detection" content="telephone=no" /> <!-- Remover estilos do iOS para numeros de telefone -->

<meta http-equiv="content-language" content="pt-br" />

<meta name="copyright" content="landsagenciaweb.com.br" />

<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Descricao_sma;?>
">

<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Keywords_sma;?>
">

<meta name="author" content="Lands Agência Web" />

<meta property="og:type" content="object" />

<!--<meta property="fb:app_id" content="161734484418635" />-->

<meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['app']->value->Nome_app_txf;?>
" />

<meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Titulo_sma;?>
" />

<meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['url_atual']->value;?>
" />

<meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Imagem_sma;?>
" />

<meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Descricao_sma;?>
" />

<!--<meta property="fb:admins" content="USER_ID,USER_ID2,USER_ID3"/>-->

<meta itemprop="name" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Titulo_sma;?>
">

<meta itemprop="description" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Descricao_sma;?>
">

<meta itemprop="image" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Imagem_sma;?>
">

<meta name="twitter:card" content="summary">

<meta name="twitter:title" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Titulo_sma;?>
">

<meta name="twitter:url" content="<?php echo $_smarty_tpl->tpl_vars['url_atual']->value;?>
">

<meta name="twitter:image" content="<?php echo $_smarty_tpl->tpl_vars['seo']->value->Imagem_sma;?>
">

<?php }} ?>