<?php /* Smarty version Smarty-3.1.12, created on 2020-11-03 16:37:42
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\navegacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24855fa1a37683bbd6-06071959%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e34e64128c6fe098e2d0ab7e4e820681f2c80a3c' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\navegacao.tpl',
      1 => 1600349905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24855fa1a37683bbd6-06071959',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'pagina_atual' => 0,
    'segment2' => 0,
    'servicos' => 0,
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa1a3768732b8_86905196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa1a3768732b8_86905196')) {function content_5fa1a3768732b8_86905196($_smarty_tpl) {?><section class="navegacao fz-12">  <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" itemtype="http://schema.org/Thing" itemprop="item">        <span itemprop="name">Início</span>        <meta itemprop="position" content="1"/>      </a>    </li>    <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Quem somos</span>      <meta itemprop="position" content="2"/>    </li>    <?php }elseif($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Contato</span>      <meta itemprop="position" content="2"/>    </li>    <?php }elseif($_smarty_tpl->tpl_vars['pagina_atual']->value=='exames'){?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Exames</span>      <meta itemprop="position" content="2"/>    </li>    <?php }elseif($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'){?>    <?php if (!$_smarty_tpl->tpl_vars['segment2']->value){?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Serviços</span>      <meta itemprop="position" content="2"/>    </li>    <?php }else{ ?>    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
servicos" itemtype="http://schema.org/Thing" itemprop="item">        <span itemprop="name">Serviços</span>        <meta itemprop="position" content="2"/>      </a>    </li>    <?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name"><?php echo $_smarty_tpl->tpl_vars['servicos']->value[0]->Nome_tit;?>
</span>      <meta itemprop="position" content="4"/>    </li>    <?php }else{ ?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Página não encontrada</span>      <meta itemprop="position" content="4"/>    </li>    <?php }?>    <?php }?>    <?php }elseif($_smarty_tpl->tpl_vars['requisicao']->value['origem']=='blog'){?>    <?php if ($_smarty_tpl->tpl_vars['requisicao']->value['titulo_post']){?>    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
blog" itemtype="http://schema.org/Thing" itemprop="item">        <span itemprop="name">Blog</span>        <meta itemprop="position" content="2"/>      </a>    </li>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name"><?php echo $_smarty_tpl->tpl_vars['requisicao']->value['titulo_post'];?>
</span>      <meta itemprop="position" content="4"/>    </li>    <?php }else{ ?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Blog</span>      <meta itemprop="position" content="4"/>    </li>    <?php }?>    <?php }else{ ?>    <li class="breadcrumb-item active" itemprop="itemListElement" itemscope        itemtype="http://schema.org/ListItem">      <span itemprop="name">Página não encontrada</span>      <meta itemprop="position" content="2"/>    </li>    <?php }?>  </ol></section><?php }} ?>