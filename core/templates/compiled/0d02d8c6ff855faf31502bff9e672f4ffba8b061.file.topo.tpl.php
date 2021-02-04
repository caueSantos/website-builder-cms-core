<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "core\templates\producao\hubvet\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27120601b7f04cbca22-49249239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d02d8c6ff855faf31502bff9e672f4ffba8b061' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\topo.tpl',
      1 => 1612414653,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27120601b7f04cbca22-49249239',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu_topo' => 0,
    'menu_topo_itens' => 0,
    'pagina_atual' => 0,
    'assets' => 0,
    'cliente' => 0,
    'menu' => 0,
    'app' => 0,
    'linguagens' => 0,
    'linguagem' => 0,
    'item' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7f04d409b4_35102038',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04d409b4_35102038')) {function content_601b7f04d409b4_35102038($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['menu_topo'] = new Smarty_variable(junta_registros($_smarty_tpl->tpl_vars['menu_topo']->value,'Nome_url',$_smarty_tpl->tpl_vars['menu_topo_itens']->value,'Menu_sel','Itens'), null, 0);?><?php $_smarty_tpl->tpl_vars['menu_topo'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['menu_topo']->value,'Mostra_topo_sel','=','SIM'), null, 0);?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">  <div class="bottom pt-lg-20 pb-lg-20">    <div class="container-fluid">      <div class="row">        <div class="col-lg-auto col-logo pl-md-30">          <div class="logo align-center">            <a href="<?php echo gera_link('inicio',true);?>
" class="d-block" title="<?php echo trans('menu_topo_logo_title');?>
">              <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">              <img itemprop="image" class="img-fluid img-alt" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo-escuro.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg col-menu">          <div id="menu-topo" class="align-center">            <nav class="navbar navbar-expand-lg">              <button                class="navbar-toggler"                type="button"                data-toggle="collapse"                data-target="#navbar-topo"                aria-controls="navbar-topo"                aria-expanded="false"                aria-label="Toggle navigation"              >                <span class="navbar-toggler-icon fa fa-bars pr-5"></span>                <span class="texto-menu"></span>              </button>              <div class="collapse navbar-collapse" id="navbar-topo">                <ul class="navbar-nav mx-auto">                  <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_topo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>                  <li class="nav-item <?php if ($_smarty_tpl->tpl_vars['menu']->value->Itens[0]){?>dropdown<?php }?>">                    <a                      class="nav-link <?php if ($_smarty_tpl->tpl_vars['menu']->value->Itens[0]){?>dropdown-toggle<?php }?> <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value==$_smarty_tpl->tpl_vars['menu']->value->Link_txf){?>active<?php }?>"                      title="<?php echo $_smarty_tpl->tpl_vars['menu']->value->Title_txf;?>
"                      href="<?php if ($_smarty_tpl->tpl_vars['menu']->value->Possui_link_sel=='SIM'){?><?php echo gera_link($_smarty_tpl->tpl_vars['menu']->value->Link_txf,true);?>
<?php }else{ ?>javascript:void(0)<?php }?>"                      data-menu-id="<?php echo $_smarty_tpl->tpl_vars['menu']->value->Nome_url;?>
"                    >                      <?php echo $_smarty_tpl->tpl_vars['menu']->value->Nome_tit;?>
                    </a>                  </li>                  <?php } ?>                </ul>              </div>            </nav>          </div>        </div>        <div class="col-lg-auto">          <ul class="navbar px-0 py-0 align-center">            <?php if (config('login_topo')){?>            <li class="nav-item">              <a                class="nav-link"                title="<?php echo trans('login_topo');?>
"                href="<?php echo gera_link(config('login_topo'),true);?>
"                data-menu-id="<?php echo $_smarty_tpl->tpl_vars['menu']->value->Nome_url;?>
"              >                <?php echo trans('login_topo');?>
              </a>            </li>            <?php }?>            <?php if (config('experimente_link')){?>            <li class="nav-item">              <a                class="nav-link fw-700 text-secondary"                title="<?php echo trans('experimente_topo');?>
"                href="<?php echo gera_link(config('experimente_link'),true);?>
"                data-menu-id="<?php echo $_smarty_tpl->tpl_vars['menu']->value->Nome_url;?>
"              >                <?php echo trans('experimente_topo');?>
              </a>            </li>            <?php }?>          </ul>        </div>        <div class="col-lg-auto">          <div class="align-center">            <?php $_smarty_tpl->tpl_vars['linguagens'] = new Smarty_variable(opcoes_linguagens(linguagens_disponiveis(null,true)), null, 0);?>            <form action="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
" method="post">              <div                class="dropdown no-animate dropdown-select cursor-pointer dropdown-linguagem"                id="filtro-ordenacao"              >                <div                  class="title fz-14 fw-800 dropdown-toggle simple-arrow arrow-left"                  data-toggle="dropdown"                >                  <div class="dropdown-selected d-inline-block va-middle"></div>                </div>                <div class="dropdown-menu dropdown-menu-right cursor-pointer bg-white">                  <?php  $_smarty_tpl->tpl_vars['linguagem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['linguagem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['linguagens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['linguagem']->key => $_smarty_tpl->tpl_vars['linguagem']->value){
$_smarty_tpl->tpl_vars['linguagem']->_loop = true;
?>                  <a                    class="cursor-pointer dropdown-item bg-body-light-hover text-left <?php if ($_smarty_tpl->tpl_vars['app']->value->Linguagem_banco_sel==$_smarty_tpl->tpl_vars['linguagem']->value->locale){?>active<?php }?>"                    data-value="<?php echo $_smarty_tpl->tpl_vars['linguagem']->value->locale;?>
"                  >                    <div class="flag">                      <div class="d-inline-block va-middle">                        <img class="d-block" src="<?php echo $_smarty_tpl->tpl_vars['linguagem']->value->flag;?>
" width="24px" height="17px"/>                      </div>                      <div class="text d-inline-block va-middle pl-5">                        <?php echo $_smarty_tpl->tpl_vars['linguagem']->value->display_language_compose;?>
                      </div>                    </div>                  </a>                  <?php } ?>                </div>                <input class="dropdown-value" type="hidden"/>              </div>            </form>          </div>        </div>      </div>    </div>  </div>  <div id="topo-full-menu" class="window-width">    <div class="menu-height full-menu-inner bg-body-light bs-1">      <div class="container pl-md-30 pr-md-30">        <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_topo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>        <div class="menu-group" data-menu="<?php echo $_smarty_tpl->tpl_vars['menu']->value->Nome_url;?>
">          <div class="row">            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value->Itens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>            <div class="col-md-3 px-0 py-0">              <a                class="d-block fill-height menu-group-item pr-md-40 pl-md-40 pt-md-30 pb-md-40 bg-body-lighter-hover"                href="<?php echo gera_link($_smarty_tpl->tpl_vars['item']->value->Botao_link_txf,true);?>
"              >                <div class="align-centera">                  <?php if ($_smarty_tpl->tpl_vars['item']->value->Imagens[0]){?>                  <figure class="mb-20">                    <img                      style="height: 32px; width: auto"                      src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value->Imagens[0]->Caminho_txf;?>
"                      alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->Nome_tit;?>
"                    />                  </figure>                  <?php }?>                  <div class="title fw-700 fz-14 text-body-primary">                    <?php echo $_smarty_tpl->tpl_vars['item']->value->Nome_txf;?>
                  </div>                  <div class="desc ff-secondary fz-12 text-body-secondary mt-10">                    <?php echo $_smarty_tpl->tpl_vars['item']->value->Descricao_txa;?>
                  </div>                  <div class="botao ff-secondary text-secondary fw-700 fz-12 mt-15">                    <?php echo $_smarty_tpl->tpl_vars['item']->value->Botao_texto_txf;?>
                  </div>                </div>              </a>            </div>            <?php } ?>          </div>        </div>        <?php } ?>      </div>    </div>  </div></header><?php }} ?>