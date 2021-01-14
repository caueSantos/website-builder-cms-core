<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 10:02:43
         compiled from "core\templates\producao\labcearensediagn\site\blocos\global\scripts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150865f92c663a9a4e5-49178566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b75e665cffc3a2182977ec63ec6a849d5a02f04b' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\global\\scripts.tpl',
      1 => 1603425611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150865f92c663a9a4e5-49178566',
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
  'unifunc' => 'content_5f92c663ab80b9_56441058',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c663ab80b9_56441058')) {function content_5f92c663ab80b9_56441058($_smarty_tpl) {?><script>  function styleFromJs(styleId, cssCode) {    $styleTag = document.getElementById(styleId);    if (!$styleTag) {      var style = document.createElement('style');      style.setAttribute('id', styleId);      document.getElementsByTagName('head')[0].appendChild(style);      $styleTag = document.getElementById(styleId);    }    $styleTag.innerHTML = cssCode;  }  function containerHelper() {    var $container = document.querySelector('.container');    window.containerOutterWidth = Math.ceil((window.innerWidth - $container.clientWidth + 30) / 2);    var styleCode = `:root { --container-outter-gutter: ${window.containerOutterWidth}px; }`;    styleFromJs('container-js-style', styleCode);  }  window.addEventListener('resize', function () {    containerHelper();  });  window.dispatchEvent(new Event('resize'));</script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
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
<script>  $(function () {    setTimeout(function () {      $('#full-loader').fadeOut(200);    }, 250);  })</script><?php }} ?>