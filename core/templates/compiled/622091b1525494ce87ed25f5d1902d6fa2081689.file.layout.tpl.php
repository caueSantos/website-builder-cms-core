<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 10:02:42
         compiled from "core\templates\producao\labcearensediagn\site\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:247275f92c66294e300-32022338%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '622091b1525494ce87ed25f5d1902d6fa2081689' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\layout.tpl',
      1 => 1603257891,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247275f92c66294e300-32022338',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'CAMINHO_TPL' => 0,
    'whats' => 0,
    'pagina_atual' => 0,
    'painel' => 0,
    'segment2' => 0,
    'segment3' => 0,
    'segment4' => 0,
    'Scripts_header_txa' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f92c66299c2b8_54123792',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c66299c2b8_54123792')) {function content_5f92c66299c2b8_54123792($_smarty_tpl) {?><!doctype html><html lang="pt-br"><head>  <base href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
">  <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/favicon.ico" type="image/x-icon"/>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/meta_tags.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/styles.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <script>    window.app = <?php echo json_encode($_smarty_tpl->tpl_vars['app']->value);?>
;    window.appUrl = '<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
';    window.whatsappPlugin = <?php echo json_encode($_smarty_tpl->tpl_vars['whats']->value[0]);?>
;    window.utils = {      paginaAtual: '<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
',      painel: '<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
',      assets: '<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
',      segmentos: ['<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['segment2']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['segment3']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['segment4']->value;?>
']    };  </script>  <?php echo $_smarty_tpl->tpl_vars['Scripts_header_txa']->value;?>
</head><body  class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>inicio<?php }else{ ?>internas interna-<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['segment2']->value){?>subinterna<?php }?><?php }?>"><style>  #full-loader{    position: fixed;    top: 0;    left: 0;    width: 100%;    height: 100%;    z-index: 99999;    background-color: #fff;  }  #full-loader .inner{    position: absolute;    left: 50%;    top: 50%;    transform: translate(-50% -50%);  }</style><div id="full-loader">  <div class="inner">    <div class="dot-elastic"></div>  </div></div><div id="fb-root"></div><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/topo.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? 'content vazio' : $tmp);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/rodape.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/js_templates.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/scripts.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</body></html><?php }} ?>