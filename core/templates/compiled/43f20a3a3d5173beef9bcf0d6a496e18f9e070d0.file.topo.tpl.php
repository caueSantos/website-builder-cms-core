<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40095f84b948de4630-44527579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43f20a3a3d5173beef9bcf0d6a496e18f9e070d0' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\topo.tpl',
      1 => 1600813856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40095f84b948de4630-44527579',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'segment2' => 0,
    'servicos_lista' => 0,
    'nivel' => 0,
    'requisicao' => 0,
    'labcloud_config' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b948e354b4_34556644',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b948e354b4_34556644')) {function content_5f84b948e354b4_34556644($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">  <div class="bottom pt-15 pb-15">    <div class="container-fluid pl-md-20 pr-md-20">      <div class="row">        <div class="col-lg col-logo">          <div class="logo">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" class="d-block" title="Acesse a página inicial">              <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg-auto col-menu">          <div id="menu-topo" class="align-center">            <nav class="navbar navbar-expand-lg">              <button                class="navbar-toggler"                type="button"                data-toggle="collapse"                data-target="#navbar-topo"                aria-controls="navbar-topo"                aria-expanded="false"                aria-label="Toggle navigation"              >                <span class="navbar-toggler-icon fa fa-bars pr-5"></span>                <span class="texto-menu">MENU</span>              </button>              <div class="collapse navbar-collapse" id="navbar-topo">                <ul class="navbar-nav mx-auto">                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                       title="Acesse a página inicial"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
inicio">                      Início                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                       title="Saiba mais sobre nós"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre">                      Sobre                    </a>                  </li>                  <li class="nav-item dropdown">                    <a                      class="nav-link dropdown-toggle <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'){?>active<?php }?>"                      title="Nossos serviços"                      href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
servicos"                      data-toggle="dropdown" aria-haspopup="true"                      aria-expanded="true">                      Serviços                    </a>                    <div class="dropdown-menu">                      <a                        class="d-md-none dropdown-item <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'&&!$_smarty_tpl->tpl_vars['segment2']->value){?>active<?php }?>"                        href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
servicos">                        Todos                      </a>                      <?php  $_smarty_tpl->tpl_vars['nivel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nivel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servicos_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nivel']->key => $_smarty_tpl->tpl_vars['nivel']->value){
$_smarty_tpl->tpl_vars['nivel']->_loop = true;
?>                      <a                        class="dropdown-item <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'&&$_smarty_tpl->tpl_vars['segment2']->value==$_smarty_tpl->tpl_vars['nivel']->value->Nome_url){?>active<?php }?>"                        href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
servicos/<?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_url;?>
">                        <?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_tit;?>
                      </a>                      <?php } ?>                    </div>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='exames'){?>active<?php }?>"                       title="Veja nossa lista de exames"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
exames">                      Exames                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['requisicao']->value['origem']=='blog'){?>active<?php }?>"                       title="Veja nossas últimas notícias"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
blog">                      Blog                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                       title="Entre em contato conosco"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato">                      Contato                    </a>                  </li>                </ul>              </div>            </nav>          </div>        </div>        <div class="col-lg-auto col-matricula">          <div class="align-center botao pl-40 pr-40 pl-md-0 pr-md-0">            <a style="padding: 9px 16px;" target="_blank" class="br-0 pl-16 pr-16 btn-lands d-block d-md-inline-block" href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf;?>
">              <span class="mr-10"><img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/icone-cadastre.png" class="pe-none"/></span>              Acesse a área restrita            </a>            <div class="d-block d-md-inline mt-15 mt-md-0 fz-18 fz-md-16">              <span class="pl-md-15">ou </span>              <a target="_blank" class="fw-600" href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf;?>
">                cadastre-se              </a>            </div>          </div>        </div>        <div class="col-12 col-lg-auto col-redes mt-15 mt-md-0">          <div class="fill-height pl-md-20">            <div class="bg-fake bg-body-light d-none d-md-block"></div>            <div class="align-center">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </div>  </div></header><?php }} ?>