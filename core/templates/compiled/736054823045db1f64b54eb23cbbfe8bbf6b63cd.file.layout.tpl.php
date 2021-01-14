<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92945ffd8a9485c165-52370953%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '736054823045db1f64b54eb23cbbfe8bbf6b63cd' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\layout.tpl',
      1 => 1610317921,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92945ffd8a9485c165-52370953',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
    'tags' => 0,
    'tag' => 0,
    'redirect' => 0,
    'app' => 0,
    'assets' => 0,
    'CAMINHO_TPL' => 0,
    'mensagens_retorno' => 0,
    'whats' => 0,
    'pagina_atual' => 0,
    'painel' => 0,
    'segment2' => 0,
    'segment3' => 0,
    'segment4' => 0,
    'msg_ret_json' => 0,
    'Scripts_header_txa' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9494a242_56719883',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9494a242_56719883')) {function content_5ffd8a9494a242_56719883($_smarty_tpl) {?><!doctype html><?php $_smarty_tpl->tpl_vars['tags'] = new Smarty_variable(executa_sql('select * from labels'), null, 0);?><?php if (isset($_smarty_tpl->tpl_vars['requisicao']->value['persona'])){?>  <?php $_smarty_tpl->tpl_vars['redirect'] = new Smarty_variable(true, null, 0);?>  <?php  $_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tag']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tags']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->key => $_smarty_tpl->tpl_vars['tag']->value){
$_smarty_tpl->tpl_vars['tag']->_loop = true;
?>    <?php if ($_smarty_tpl->tpl_vars['requisicao']->value['persona']==$_smarty_tpl->tpl_vars['tag']->value->Nome_url){?>      <?php $_smarty_tpl->tpl_vars['redirect'] = new Smarty_variable(false, null, 0);?>    <?php }?>  <?php } ?>  <?php if ($_smarty_tpl->tpl_vars['redirect']->value==true){?>    <?php echo redirect($_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem);?>
  <?php }?><?php }?><html lang="pt-br"><head>  <base href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
">  <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/favicon.ico" type="image/x-icon"/>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/meta_tags.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/styles.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <?php $_smarty_tpl->tpl_vars['msg_ret_json'] = new Smarty_variable(json_encode((($tmp = @$_smarty_tpl->tpl_vars['mensagens_retorno']->value)===null||$tmp==='' ? array() : $tmp)), null, 0);?>  <script>    window.app = <?php echo json_encode($_smarty_tpl->tpl_vars['app']->value);?>
;    window.appUrl = '<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
';    window.whatsappPlugin = <?php echo json_encode($_smarty_tpl->tpl_vars['whats']->value[0]);?>
;    window.estadosBrasil = <?php echo json_encode(lista_estados_brasil());?>
;    window.utils = {      paginaAtual: '<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
',      painel: '<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
',      assets: '<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
',      segmentos: ['<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['segment2']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['segment3']->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['segment4']->value;?>
'],      mensagensRetorno: <?php echo $_smarty_tpl->tpl_vars['msg_ret_json']->value;?>
    };  </script>  <?php echo $_smarty_tpl->tpl_vars['Scripts_header_txa']->value;?>
</head><body  class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>inicio<?php }else{ ?>internas interna-<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['segment2']->value){?>subinterna<?php }?><?php }?>"><style>  #full-loader {    position: fixed;    top: 0;    left: 0;    width: 100%;    height: 100%;    z-index: 99999;    background-color: #fff;  }  #full-loader .inner {    position: absolute;    left: 50%;    top: 50%;    transform: translate(-50% -50%);  }</style><div id="full-loader">  <div class="inner">    <div class="dot-elastic"></div>  </div></div><div id="fb-root"></div><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/topo.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? 'content vazio' : $tmp);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/rodape.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/modais.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/js_templates.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/scripts.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<script>  $(function () {    busca();    $('#fechar-pesquisa').on('click', function () {      $('#banners .pesquisa-responsivo').removeClass('open');    });  });  function busca() {    window.searchTimeout = null;    window.previousSearch = null;    $(document).click(function (e) {      $('.busca .busca-resultados').fadeOut(100);      $('.form-autocomplete').removeClass('autocomplete-open');    });    $('.busca').on('click', function (e) {      e.stopPropagation();    });    $('#simula-busca').on('click', function (e) {      e.stopPropagation();      $('#banners .busca-ajax').trigger('focus');    });    $('.busca input.busca-ajax').on('focus', function (e) {      e.stopPropagation();      e.preventDefault();      if ($(window).width() <= 992) {        $('#banners .pesquisa-responsivo').addClass('open');      }      if ($(this).val().length >= 3) {        $(this).parents('.form-autocomplete').addClass('autocomplete-open');        $(this).parents('.form-autocomplete').find('.form-lands-autocomplete').show(0);        $('.busca .busca-resultados').fadeIn(200);      }    });    $('.busca input.busca-ajax').on('keyup', function () {      var $this = $(this),        $parent = $this.parents('.busca'),        search = $this.val(),        searchLength = search.length,        tipoBusca = $parent.data('autocomplete'),        $autocompleteEl = $(tipoBusca);      if (!$autocompleteEl.length) {        $autocompleteEl = $parent.find('.retorno-busca');        if (!$autocompleteEl.length) {          $parent.append('<div class="retorno-busca"/>');          $autocompleteEl = $parent.find('.retorno-busca');        }      }      if (searchLength >= 3) {        $parent.find('.form-autocomplete').addClass('autocomplete-open');        if (window.previousSearch != search) {          window.previousSearch = search;          $('.busca .busca-resultados').fadeIn(200);          $parent.find('.form-lands-autocomplete').show(0);          $autocompleteEl.html('<div class="text-center pa-10">Buscando...</div>');          clearTimeout(window.searchTimeout);          window.searchTimeout = setTimeout(function () {            realizaBusca(search, {              autocompleteEl: $autocompleteEl,              Tpl_txf: $parent.data('tpl') || 'busca',              Campos_txf: $parent.find('[name=Campos_txf]').val(),              Tabelas_txf: $parent.find('[name=Tabelas_txf]').val()            });          }, 500);        }      } else {        $autocompleteEl.html('<div class="text-center pa-10">Nenhum resultado encontrado...</div>');      }    });  }  function realizaBusca(valor, options) {    var defaults = {      Tabelas_txf: 'imoveis',      Campos_txf: 'Nome_tit',      Tpl_txf: 'busca',      autocompleteEl: $('.retorno-busca')    };    var settings = $.extend({}, defaults, options);    settings.autocompleteEl.addClass('busca-resultados');    $.ajax({      url: "<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
post_ajax/busca",      type: "post",      data: {        valor: valor,        Tabelas_txf: settings.Tabelas_txf,        Campos_txf: settings.Campos_txf,        Tpl_txf: settings.Tpl_txf      },      success: function (data) {        var text = data;        if(data && data.trim().length === 0){          text = '<div class="text-center pa-10">Nenhum resultado encontrado...</div>';        }        settings.autocompleteEl.html(text).focus();      },      error: function () {        settings.autocompleteEl.html('<div class="text-center pa-10">Nenhum resultado encontrado...</div>');      }    });  }</script></body></html><?php }} ?>