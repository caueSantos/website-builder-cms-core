<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:35
         compiled from "core\templates\producao\vet_life\site\blocos\global\scripts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262125f90d9776b0a67-13368113%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '570221025f5411b2db575db8576e0c8b451909ba' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\global\\scripts.tpl',
      1 => 1603260094,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262125f90d9776b0a67-13368113',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d9776c9a32_59680443',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d9776c9a32_59680443')) {function content_5f90d9776c9a32_59680443($_smarty_tpl) {?><script>  function containerHelper() {    var $container = document.querySelector('.container'),      $styleTag = document.getElementById('container-js-style');    window.containerOutterWidth = Math.ceil((window.innerWidth - $container.clientWidth + 30) / 2);    if (!$styleTag) {      var style = document.createElement('style');      style.setAttribute('id', 'container-js-style');      document.getElementsByTagName('head')[0].appendChild(style);      $styleTag = document.getElementById('container-js-style');    }    $styleTag.innerHTML = `:root { --container-outter-gutter: ${window.containerOutterWidth}px; }`;  }  window.addEventListener('resize', function () {    containerHelper();  });  window.dispatchEvent(new Event('resize'));</script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/lodash.core.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/jquery/jquery.ui.widget.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/jquery.mask.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/bootstrap/popper.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/bootstrap/bootstrap.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/fancybox/jquery.fancybox.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/owl-carousel/owl.carousel.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/readmore.min.js"></script><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script><script src="https://cdn.jsdelivr.net/npm/nanogram.js@2.0.0/dist/nanogram.iife.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/instagram.portfolio.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/4.0.1/mustache.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
js/default.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
js/lands.js"></script><?php echo $_smarty_tpl->tpl_vars['app']->value->Scripts_txa;?>
<script>  $(function(){    setTimeout(function(){      $('#full-loader').fadeOut(200);    }, 250);  })</script><?php }} ?>