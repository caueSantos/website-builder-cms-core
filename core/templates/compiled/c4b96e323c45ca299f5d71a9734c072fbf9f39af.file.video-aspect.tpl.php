<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\componentes\video-aspect.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28341601b635fdf0664-61862920%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c4b96e323c45ca299f5d71a9734c072fbf9f39af' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\componentes\\video-aspect.tpl',
      1 => 1612116514,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28341601b635fdf0664-61862920',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'aspect' => 0,
    'video' => 0,
    'radius' => 0,
    'fluid' => 0,
    'height' => 0,
    'hide_bg' => 0,
    'fill_height' => 0,
    'disponivel' => 0,
    'id' => 0,
    'inner_height' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fe41928_68093684',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fe41928_68093684')) {function content_601b635fe41928_68093684($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['aspect']->value)===null||$tmp==='' ? '4-3' : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['video'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['video']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['radius']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['fluid'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['fluid']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['height'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['height']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php $_smarty_tpl->tpl_vars['hide_bg'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['hide_bg']->value)===null||$tmp==='' ? false : $tmp), null, 0);?><?php if ($_smarty_tpl->tpl_vars['height']->value){?><?php if ($_smarty_tpl->tpl_vars['height']->value=='fill'){?><?php $_smarty_tpl->tpl_vars['inner_height'] = new Smarty_variable('auto', null, 0);?><?php $_smarty_tpl->tpl_vars['fill_height'] = new Smarty_variable(true, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['inner_height'] = new Smarty_variable($_smarty_tpl->tpl_vars['height']->value, null, 0);?><?php $_smarty_tpl->tpl_vars['fill_height'] = new Smarty_variable(false, null, 0);?><?php }?><?php }?><?php $_smarty_tpl->tpl_vars['disponivel'] = new Smarty_variable(false, null, 0);?><?php if ($_smarty_tpl->tpl_vars['video']->value->Endereco_txf){?><?php $_smarty_tpl->tpl_vars['disponivel'] = new Smarty_variable(true, null, 0);?><?php }?><a  class="aspect aspect-<?php echo $_smarty_tpl->tpl_vars['aspect']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['radius']->value){?>br-<?php echo $_smarty_tpl->tpl_vars['radius']->value;?>
<?php }?> overflow-hidden <?php if (!$_smarty_tpl->tpl_vars['hide_bg']->value){?>bg-light-body<?php }?> <?php if ($_smarty_tpl->tpl_vars['fill_height']->value){?>fill-height<?php }?> d-block <?php if ($_smarty_tpl->tpl_vars['disponivel']->value){?>fancybox hover hover-opacity<?php }else{ ?>pe-none<?php }?>"  href="<?php if ($_smarty_tpl->tpl_vars['disponivel']->value){?>https://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['video']->value->Endereco_txf;?>
<?php }else{ ?>javascript:void(0);<?php }?>"  data-fancybox="galeria-<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"  style="height: <?php echo $_smarty_tpl->tpl_vars['inner_height']->value;?>
">  <figure class="imagem aspect-item">    <?php if ($_smarty_tpl->tpl_vars['video']->value->Endereco_txf){?>    <img      itemprop="image"      src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['video']->value->Endereco_txf;?>
/mqdefault.jpg"      alt="<?php echo $_smarty_tpl->tpl_vars['video']->value->Descricao_txf;?>
" title="<?php echo $_smarty_tpl->tpl_vars['video']->value->Descricao_txf;?>
"      class="img-fit"    />    <div class="bg-fake" style="background: rgba(0,0,0,.65)"></div>    <div class="bg-fake text-center">      <div class="d-block align-center" style="opacity: 0.9">        <div          class="bg-fake"          style="background: #fff;                      width: 40px;                      height: 40px;                      left: 50%;                      top: 50%;                      margin-left: -20px;                      margin-top: -20px;"        ></div>        <i class="fas fa-play-circle fz-70 lh-1 text-primary"></i>      </div>    </div>    <?php }else{ ?>    <img itemprop="image"         src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel.png"         alt="Vídeo indisponível" title="Vídeo indisponível"         class="mx-auto <?php if ($_smarty_tpl->tpl_vars['fluid']->value){?>img-fluid<?php }else{ ?>img-fit<?php }?> d-block"    />    <?php }?>  </figure></a><?php }} ?>