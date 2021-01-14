<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15025fd2df4a54e812-46760105%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f45b873b5ebc83a313fa943294f1bb00343a3058' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\topo.tpl',
      1 => 1607655230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15025fd2df4a54e812-46760105',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a57d751_00364978',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a57d751_00364978')) {function content_5fd2df4a57d751_00364978($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">  <div class="bottom pt-lg-15 pb-lg-15">    <div class="container">      <div class="row">        <div class="col-lg col-logo">          <div class="logo">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" class="d-block" title="Acesse a página inicial">              <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg-auto col-menu">          <div id="menu-topo" class="align-center">            <nav class="navbar navbar-expand-lg">              <button                class="navbar-toggler"                type="button"                data-toggle="collapse"                data-target="#navbar-topo"                aria-controls="navbar-topo"                aria-expanded="false"                aria-label="Toggle navigation"              >                <span class="navbar-toggler-icon fa fa-bars pr-5"></span>                <span class="texto-menu">MENU</span>              </button>              <div class="collapse navbar-collapse" id="navbar-topo">                <ul class="navbar-nav mx-auto">                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                       title="Acesse a página inicial"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
inicio"                    >                      Início                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='imoveis'){?>active<?php }?>"                       title="Conheça nossos imóveis"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis"                    >                      Imóveis                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='empreendimentos'){?>active<?php }?>"                       title="Conheça nossos empreendimentos"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
empreendimentos"                    >                      Empreendimentos                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                       title="Conheça mais sobre nós"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre"                    >                      Quem somos                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cadastre-seu-imovel'){?>active<?php }?>"                       title="Cadastre seu imóvel na nossa base"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cadastre-seu-imovel"                    >                      Cadastre seu imóvel                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='avalie-seu-imovel'){?>active<?php }?>"                       title="Avalie seu imóvel conosco"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
avalie-seu-imovel"                    >                      Avalie seu imóvel                    </a>                  </li>                  <li class="nav-item fw-700">                    <form action="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" method="post">                      <?php echo $_smarty_tpl->tpl_vars['app']->value->Linguagem_banco_sel;?>
                      <select name="Mudar_linguagem_sel">                        <option value="pt-br">PT</option>                        <option value="en">EN</option>                      </select>                      <button type="submit">Vai</button>                    </form>                  </li>                </ul>              </div>            </nav>          </div>        </div>      </div>    </div>  </div></header><?php }} ?>