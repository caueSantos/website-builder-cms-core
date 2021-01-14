<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:05
         compiled from "core\templates\producao\diagnostico\site\blocos\global\scripts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:221085f84b9494eb248-56167947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '684238cdccc00135714399e10d01b1df82d52788' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\scripts.tpl',
      1 => 1599139732,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '221085f84b9494eb248-56167947',
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
  'unifunc' => 'content_5f84b94950c538_89524784',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b94950c538_89524784')) {function content_5f84b94950c538_89524784($_smarty_tpl) {?><script>  function containerHelper() {    var $container = document.querySelector('.container'),      $styleTag = document.getElementById('container-js-style');    window.containerOutterWidth = Math.ceil((window.innerWidth - $container.clientWidth + 30) / 2);    if (!$styleTag) {      var style = document.createElement('style');      style.setAttribute('id', 'container-js-style');      document.getElementsByTagName('head')[0].appendChild(style);      $styleTag = document.getElementById('container-js-style');    }    $styleTag.innerHTML = `:root { --container-outter-gutter: ${window.containerOutterWidth}px; }`;  }  window.addEventListener('resize', function () {    containerHelper();  });  window.dispatchEvent(new Event('resize'));</script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/lodash.core.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/jquery/jquery.ui.widget.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/jquery.mask.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/bootstrap/popper.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/bootstrap/bootstrap.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/fancybox/jquery.fancybox.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/owl-carousel/owl.carousel.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/readmore.min.js"></script><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script><script src="https://cdn.jsdelivr.net/npm/nanogram.js@2.0.0/dist/nanogram.iife.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/instagram.portfolio.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
js/default.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
js/lands.js"></script><?php echo $_smarty_tpl->tpl_vars['app']->value->Scripts_txa;?>
<script>  $(function(){    setTimeout(function(){      $('#full-loader').fadeOut(200);    }, 250);  })</script><?php }} ?>