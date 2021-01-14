<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:44
         compiled from "core\templates\producao\abseg\site\blocos\global\navegacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50925f50e9b0c07bf7-57751865%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '143b696b1436565c6baa9f214d6d541cc44ef6c4' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\navegacao.tpl',
      1 => 1595874452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50925f50e9b0c07bf7-57751865',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'pagina_atual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9b0c1a703_80840933',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9b0c1a703_80840933')) {function content_5f50e9b0c1a703_80840933($_smarty_tpl) {?><section class="navegacao fz-12">    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">        <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" itemtype="http://schema.org/Thing" itemprop="item">                <span itemprop="name">Início</span>                <meta itemprop="position" content="1"/>            </a>        </li>        <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope                itemtype="http://schema.org/ListItem">                <span itemprop="name">Sobre</span>                <meta itemprop="position" content="2"/>            </li>        <?php }elseif($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope                itemtype="http://schema.org/ListItem">                <span itemprop="name">Contato</span>                <meta itemprop="position" content="2"/>            </li>        <?php }elseif($_smarty_tpl->tpl_vars['pagina_atual']->value=='estado-da-obra'){?>            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">                <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre" itemtype="http://schema.org/Thing" itemprop="item">                    <span itemprop="name">Sobre</span>                    <meta itemprop="position" content="2"/>                </a>            </li>            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope                itemtype="http://schema.org/ListItem">                <span itemprop="name">Estado da obra</span>                <meta itemprop="position" content="4"/>            </li>        <?php }elseif($_smarty_tpl->tpl_vars['pagina_atual']->value=='depoimentos'){?>            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">                <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre" itemtype="http://schema.org/Thing" itemprop="item">                    <span itemprop="name">Sobre</span>                    <meta itemprop="position" content="2"/>                </a>            </li>            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope                itemtype="http://schema.org/ListItem">                <span itemprop="name">Depoimentos</span>                <meta itemprop="position" content="4"/>            </li>        <?php }else{ ?>            <li class="breadcrumb-item active" itemprop="itemListElement" itemscope                itemtype="http://schema.org/ListItem">                <span itemprop="name">Página não encontrada</span>                <meta itemprop="position" content="2"/>            </li>        <?php }?>    </ol></section><?php }} ?>