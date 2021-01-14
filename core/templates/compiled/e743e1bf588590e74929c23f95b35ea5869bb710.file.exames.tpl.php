<?php /* Smarty version Smarty-3.1.12, created on 2020-09-17 10:48:45
         compiled from "core\templates\producao\diagnostico\site\exames.tpl" */ ?>
<?php /*%%SmartyHeaderCode:219245f63693d512b44-94110755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e743e1bf588590e74929c23f95b35ea5869bb710' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\exames.tpl',
      1 => 1600349719,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219245f63693d512b44-94110755',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'labcloud_config' => 0,
    'x_api_key' => 0,
    'x_lab_id' => 0,
    'headers' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'segment2' => 0,
    'todas_categorias' => 0,
    'categoria' => 0,
    'i' => 0,
    'exames_categorias' => 0,
    'exames' => 0,
    'exame' => 0,
    'segment3' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f63693d5a1a84_07111034',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f63693d5a1a84_07111034')) {function content_5f63693d5a1a84_07111034($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['x_api_key'] = new Smarty_variable($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Chave_api_txf, null, 0);?><?php $_smarty_tpl->tpl_vars['x_lab_id'] = new Smarty_variable($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Id_laboratorio_txf, null, 0);?><?php $_smarty_tpl->tpl_vars['headers'] = new Smarty_variable(array("x-api-key: ".((string)$_smarty_tpl->tpl_vars['x_api_key']->value),"x-lab-id: ".((string)$_smarty_tpl->tpl_vars['x_lab_id']->value)), null, 0);?><?php $_smarty_tpl->tpl_vars['todas_categorias'] = new Smarty_variable(super_request("exames_categorias",'GET',false,$_smarty_tpl->tpl_vars['headers']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['exames_categorias'] = new Smarty_variable(super_request("exames_categorias",'GET',false,$_smarty_tpl->tpl_vars['headers']->value), null, 0);?><?php $_smarty_tpl->tpl_vars['exames'] = new Smarty_variable(super_request("exames",'GET',false,$_smarty_tpl->tpl_vars['headers']->value), null, 0);?><main id="exames" itemprop="mainContentOfPage">  <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable((('<strong>').(titulo('interna_exames','tit',$_smarty_tpl->tpl_vars['titulos']->value))).('</strong>'), null, 0);?>  <?php $_smarty_tpl->tpl_vars['subtitulo'] = new Smarty_variable(titulo('interna_exames','sub',$_smarty_tpl->tpl_vars['titulos']->value), null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  <div id="wrap" class="pt-40 pb-50 pb-md-140">    <div class="container">      <div class="row">        <div class="col-lg-3 menu-esq">          <div class="menu-tit mb-20 text-primary fz-16 fw-600 d-none d-md-block" style="height: 51px">            <div class="align-center">              Tipos de Exame            </div>          </div>          <div id="menu-exames">            <nav class="navbar navbar-expand-lg px-0 py-0">              <button                class="navbar-toggler text-white bg-primary"                type="button"                data-toggle="collapse"                data-target="#navbar-exames"                aria-controls="navbar-exames"                aria-expanded="false"                aria-label="Toggle navigation"                style="width: 100%;"              >                <span class="navbar-toggler-icon fa fa-bars"></span>                <span class="texto-menu">Tipos de Exame</span>              </button>              <div class="collapse navbar-collapse" id="navbar-exames">                <ul class="navbar-nav lh-12 d-flex d-md-block mt-20 mt-md-0">                  <li class="mb-0 mb-md-20">                    <a                      data-categoria=""                      class="nav-link btn-categoria text-body-primary fz-18 px-md-0 py-md-0 pl-15 <?php if (!$_smarty_tpl->tpl_vars['segment2']->value){?>active<?php }?>"                      href="javascript:void(0);"                    >                      Todos                    </a>                  </li>                  <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, 0);?>                  <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['todas_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>                  <li class="nav-item mb-0 mb-md-20">                    <a                      href="javascript:void(0);"                      id="<?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_url;?>
"                      class="nav-link btn-categoria text-body-primary fz-18 px-md-0 py-md-0 pl-15"                      data-categoria="<?php echo $_smarty_tpl->tpl_vars['categoria']->value->Id_int;?>
"                    >                      <?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_tit;?>
                    </a>                  </li>                  <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>                  <?php } ?>                </ul>              </div>            </nav>          </div>        </div>        <div class="col-lg-8 mt-50 mt-md-0">          <header class="pb-30 text-center text-md-left">            <div class="row">              <div class="col-12 col-md-5">                <h3 id="tit" class="menu-tit fz-16 text-primary align-center fw-600">                  Listando Todos Os Exames                </h3>              </div>              <div class="col-12 col-md-7 mt-20 mt-md-0">                <div class="busca align-center">                  <div class="input-group">                    <input class="form-lands t" placeholder="Digite o nome do exame desejado" type="text" name="q"/>                    <div class="input-group-btn">                      <button class="fill-height btn" type="submit">                        <i class="fa fa-search text-body-primary"></i>                      </button>                    </div>                  </div>                </div>              </div>            </div>          </header>          <hr class="mt-0 mb-30"/>          <div id="lista-exames">            <div class="nenhum" style="display: none;">              <ul>                <li class="exame">                  <h3 class="tit-2">Nenhum exame encontrado...</h3>                </li>              </ul>            </div>            <ul class="list itens-exame">              <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['exames_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>              <?php  $_smarty_tpl->tpl_vars['exame'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exame']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['exames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exame']->key => $_smarty_tpl->tpl_vars['exame']->value){
$_smarty_tpl->tpl_vars['exame']->_loop = true;
?>              <?php if ($_smarty_tpl->tpl_vars['categoria']->value->Id_int==$_smarty_tpl->tpl_vars['exame']->value->Exames_categorias_for){?>              <?php if ($_smarty_tpl->tpl_vars['segment3']->value&&$_smarty_tpl->tpl_vars['exame']->value->Id_int!=$_smarty_tpl->tpl_vars['segment3']->value){?>              <?php continue 1?>              <?php }?>              <li class="item exame bs-1 br-1 pl-20 pr-20 pt-20 pb-20 pl-md-60 pr-md-60 pt-md-40 pb-md-40 mt-15 bg-white" id="exame<?php echo $_smarty_tpl->tpl_vars['exame']->value->Id_int;?>
">                <div class="categoria-id" style="display:none;"><?php echo $_smarty_tpl->tpl_vars['categoria']->value->Id_int;?>
</div>                <div class="exame-id" style="display:none;">exame<?php echo $_smarty_tpl->tpl_vars['exame']->value->Id_int;?>
</div>                <div class="info">                  <h3 class="exame-nome title text-body-primary fz-18 fw-600 mb-10">                    <?php echo $_smarty_tpl->tpl_vars['exame']->value->Nome_tit;?>
                  </h3>                  <?php if ($_smarty_tpl->tpl_vars['exame']->value->Amostra_txf){?>                  <div class="amostra">                    <strong>Amostra: </strong>                    <?php echo $_smarty_tpl->tpl_vars['exame']->value->Amostra_txf;?>
                  </div>                  <?php }?>                  <?php if ($_smarty_tpl->tpl_vars['categoria']->value->Nome_tit){?>                  <div class="categoria">                    <strong>Categoria: </strong>                    <?php echo $_smarty_tpl->tpl_vars['exame']->value->Nome_tit;?>
                  </div>                  <?php }?>                  <?php if ($_smarty_tpl->tpl_vars['exame']->value->Prazo_txf){?>                  <div>                    <strong>Prazo: </strong>                    <?php echo $_smarty_tpl->tpl_vars['exame']->value->Prazo_txf;?>
 dia(s)                  </div>                  <?php }?>                </div>                <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf){?>                <div class="botao mt-15">                  <a href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf;?>
"                     target="_blank">                    Faça seu cadastro/login para consultar os valores                  </a>                </div>                <?php }?>              </li>              <?php }?>              <?php } ?>              <?php } ?>            </ul>            <div class="text-center mt-40">              <ul class="pagination d-flex justify-content-center"></ul>            </div>          </div>        </div>      </div>    </div>  </div></main><script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script><script>  var monkeyList = new List('lista-exames', {    valueNames: ['exame-nome', 'categoria-id', 'exame-id'],    page: 5,    pagination: true  });  monkeyList.on('updated', function () {    rolagem('tit', 120);  });  $('.btn-categoria').click(function () {    $(".btn-categoria").removeClass("active");    $(this).addClass("active");    var categoria = $(this).attr('data-categoria');    if(categoria){      monkeyList.search(categoria);      $('#exames #tit').text($(this).text());    }else{      monkeyList.search();      $('#exames #tit').text('Listando Todos Os Exames');    }    rolagem('tit', 120);  });  $('#exames .busca input').keyup(function () {    var valor = $(this).val();    monkeyList.search(valor);    if (monkeyList.visibleItems['length'] == 0) {      $('#lista-exames .nenhum').show();    } else {      $('#lista-exames .nenhum').hide();    }  });</script><?php if ($_smarty_tpl->tpl_vars['segment2']->value){?><script>  $(document).ready(function () {    $("#<?php echo $_smarty_tpl->tpl_vars['segment2']->value;?>
").click();  });</script><?php }?><?php }} ?>