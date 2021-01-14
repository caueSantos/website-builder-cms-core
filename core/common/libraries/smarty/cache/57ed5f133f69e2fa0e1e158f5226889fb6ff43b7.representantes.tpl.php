<?php /*%%SmartyHeaderCode:20998121075132644829dd89-09152761%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57ed5f133f69e2fa0e1e158f5226889fb6ff43b7' => 
    array (
      0 => 'application/views/templates/padrao/representantes.tpl',
      1 => 1361273838,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20998121075132644829dd89-09152761',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513264482a47d8_00564405',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513264482a47d8_00564405')) {function content_513264482a47d8_00564405($_smarty_tpl) {?><h1>Representantes</h1>

<p style="padding-left:20px; padding-bottom:20px;">Encontre no mapa abaixo um de nossos representantes. Se deseja ser um representante <a href="trabalhe.php">clique aqui</a>.</p>

<div id='mapa_repre'></div>

<div id='reprecont'> 

    <hr/>

</div>


<script type="text/javascript">
    var so2 = new SWFObject("flash/mapa3.swf", "mapa", "360", "360", "1");
    so2.addParam("scale", "noscale");
    so2.addParam("wmode", "transparent");
    so2.addParam("allowScriptAccess", "always");
    so2.addParam("swliveconnect", "true");
    so2.write("mapa_repre");
</script>   

<div style="clear:both;height:20px;"></div><?php }} ?>