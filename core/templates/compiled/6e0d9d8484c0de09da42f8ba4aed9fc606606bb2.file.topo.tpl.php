<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:39
         compiled from "core\templates\producao\abseg\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:235325f53deefd4a534-68395307%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e0d9d8484c0de09da42f8ba4aed9fc606606bb2' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\topo.tpl',
      1 => 1599260048,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '235325f53deefd4a534-68395307',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'solucoes_lista' => 0,
    'segment2' => 0,
    'nivel' => 0,
    'requisicao' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53deefd97622_32596002',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53deefd97622_32596002')) {function content_5f53deefd97622_32596002($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">  <div class="top bg-secondary text-white">    <div class="container">      <div class="row">        <div class="col-12 col-lg col-contato fz-14">          <div class="align-center">            <div class="telefones d-inline-block va-middle">              <ul class="telefones-lista d-inline-block lh-1 va-middle">                <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>                <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel=='WHATSAPP'){?>                <li class="telefone d-inline-block mr-10">                  <a                    href="javascript:void(0);"                    onclick="document.querySelector('.lands-whatsapp-fab').click()"                    class="text-white"                  >                    <i class="text-white fab fa-whatsapp mr-5"></i>                    Entre em contato pelo whatsapp                  </a>                </li>                <?php }?>                <?php } ?>              </ul>            </div>          </div>        </div>        <div class="col-12 col-lg-auto col-redes">          <div class="align-center">            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </div>  <div class="bottom pt-15 pb-15">    <div class="container">      <div class="row">        <div class="col-lg-auto col-logo">          <div class="logo">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" class="d-block" title="Acesse a página inicial">              <img itemprop="image" class="fixa img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-colorido-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">              <img itemprop="image" class="solta img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-branca-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg col-menu">          <div id="menu-topo" class="">            <nav class="navbar navbar-expand-lg">              <button                class="navbar-toggler"                type="button"                data-toggle="collapse"                data-target="#navbar-topo"                aria-controls="navbar-topo"                aria-expanded="false"                aria-label="Toggle navigation"              >                <span class="navbar-toggler-icon fa fa-bars"></span>                <span class="texto-menu">MENU</span>              </button>              <div class="collapse navbar-collapse" id="navbar-topo">                <ul class="navbar-nav mx-auto">                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                       title="Acesse a página inicial"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
inicio">                      Início                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                       title="Saiba mais sobre nós"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre">                      Quem somos                    </a>                  </li>                  <li class="nav-item dropdown">                    <a                      class="nav-link dropdown-toggle <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='solucoes'){?>active<?php }?>"                       title="Nossos soluções"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
solucoes"                       data-toggle="dropdown" aria-haspopup="true"                       aria-expanded="true">                      Soluções                    </a>                    <div class="dropdown-menu">                      <?php  $_smarty_tpl->tpl_vars['nivel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nivel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nivel']->key => $_smarty_tpl->tpl_vars['nivel']->value){
$_smarty_tpl->tpl_vars['nivel']->_loop = true;
?>                      <a                        class="dropdown-item <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='solucoes'&&$_smarty_tpl->tpl_vars['segment2']->value==$_smarty_tpl->tpl_vars['nivel']->value->Nome_url){?>active<?php }?>"                        href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
solucoes/<?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_url;?>
">                        <?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_tit;?>
                      </a>                      <?php } ?>                    </div>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='central-de-ajuda'){?>active<?php }?>"                       title="Entre em contato conosco"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
central-de-ajuda">                      Central de Ajuda                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['requisicao']->value['origem']=='blog'){?>active<?php }?>"                       title="Veja nossas últimas notícias"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
blog">                      Blog                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                       title="Entre em contato conosco"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato">                      Contato                    </a>                  </li>                </ul>              </div>            </nav>          </div>        </div>        <div class="col-lg-auto col-matricula">          <div class="align-center botao">            <a class="btn-lands btn-outline btn-accent" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cotacao">              Realizar cotação            </a>          </div>        </div>      </div>    </div>  </div></header><?php }} ?>