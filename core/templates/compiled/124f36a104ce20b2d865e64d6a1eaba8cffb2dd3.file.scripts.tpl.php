<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "core\templates\producao\hubvet\site\blocos\global\scripts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14074601b7f04eea129-02775856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '124f36a104ce20b2d865e64d6a1eaba8cffb2dd3' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\scripts.tpl',
      1 => 1611371538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14074601b7f04eea129-02775856',
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
  'unifunc' => 'content_601b7f04f10dd7_77541948',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04f10dd7_77541948')) {function content_601b7f04f10dd7_77541948($_smarty_tpl) {?><script>  function styleFromJs(styleId, cssCode) {    $styleTag = document.getElementById(styleId);    if (!$styleTag) {      var style = document.createElement('style');      style.setAttribute('id', styleId);      document.getElementsByTagName('head')[0].appendChild(style);      $styleTag = document.getElementById(styleId);    }    $styleTag.innerHTML = cssCode;  }  function containerHelper() {    var $container = document.querySelector('.container');    window.containerOutterWidth = Math.ceil((window.innerWidth - $container.clientWidth + 30) / 2);    var styleCode = `:root { --container-width: ${$container.clientWidth}px; --container-outter-gutter: ${window.containerOutterWidth}px; }`;    styleFromJs('container-js-style', styleCode);  }  function screenSizeHelper() {    var $window = $(window);    var styleCode = `:root { --window-width: ${$window.width()}px; --window-height: ${$window.height()}px; }`;    styleFromJs('window-size-js-style', styleCode);  }  window.addEventListener('resize', function () {    containerHelper();    screenSizeHelper();  });  window.dispatchEvent(new Event('resize'));</script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/lodash.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/cep-promise.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/jquery/jquery.ui.widget.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/jquery.mask.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/bootstrap/popper.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/bootstrap/bootstrap.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/fancybox/jquery.fancybox.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/owl-carousel/owl.carousel.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/readmore.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/jquery.scrolling-tabs.min.js"></script><script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script><script src="https://cdn.jsdelivr.net/npm/nanogram.js@2.0.0/dist/nanogram.iife.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/utils/instagram.portfolio.js"></script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dot@1.1.3/doT.min.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
js/default.js"></script><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
js/lands.js"></script><?php echo carrega_script('imoveis.js','imoveis');?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Scripts_txa;?>
<script>  $(function () {    setTimeout(function () {      $('#full-loader').fadeOut(200);    }, 250);  })</script><?php }} ?>