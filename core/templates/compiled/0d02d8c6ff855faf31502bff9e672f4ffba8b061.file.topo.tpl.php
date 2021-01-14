<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69175ffd8a949c81b9-58404268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d02d8c6ff855faf31502bff9e672f4ffba8b061' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\topo.tpl',
      1 => 1610319463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69175ffd8a949c81b9-58404268',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'assets' => 0,
    'cliente' => 0,
    'solucoes_controle_lista' => 0,
    'solucoes_oferecer_lista' => 0,
    'itens' => 0,
    'solucao' => 0,
    'app' => 0,
    'linguagens' => 0,
    'linguagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a94b71aa6_79492139',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a94b71aa6_79492139')) {function content_5ffd8a94b71aa6_79492139($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">  <div class="bottom pt-lg-20 pb-lg-20">    <div class="container">      <div class="row">        <div class="col-lg-auto col-logo">          <div class="logo align-center">            <a href="<?php echo gera_link('inicio',true);?>
" class="d-block" title="<?php echo trans('menu_topo_logo_title');?>
">              <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">              <img itemprop="image" class="img-fluid img-alt" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo-escuro.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg col-menu">          <div id="menu-topo" class="align-center">            <nav class="navbar navbar-expand-lg">              <button                class="navbar-toggler"                type="button"                data-toggle="collapse"                data-target="#navbar-topo"                aria-controls="navbar-topo"                aria-expanded="false"                aria-label="Toggle navigation"              >                <span class="navbar-toggler-icon fa fa-bars pr-5"></span>                <span class="texto-menu"></span>              </button>              <div class="collapse navbar-collapse" id="navbar-topo">                <ul class="navbar-nav mx-auto">                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                       title="<?php echo trans('menu_topo_inicio_title');?>
"                       href="<?php echo gera_link('inicio',true);?>
"                    >                      <?php echo trans('menu_topo_inicio');?>
                    </a>                  </li>                  <li class="nav-item dropdown">                    <a class="nav-link dropdown-toggle <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='solucoes'){?>active<?php }?>"                       title="<?php echo trans('menu_topo_solucoes_title');?>
"                       href="<?php echo gera_link('solucoes',true);?>
"                    >                      <?php echo trans('menu_topo_solucoes');?>
                    </a>                    <div class="dropdown-menu">                      <?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable(array_merge($_smarty_tpl->tpl_vars['solucoes_controle_lista']->value,$_smarty_tpl->tpl_vars['solucoes_oferecer_lista']->value), null, 0);?>                      <?php  $_smarty_tpl->tpl_vars['solucao'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['solucao']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>                      <a class="dropdown-item" href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_url;?>
<?php $_tmp1=ob_get_clean();?><?php echo gera_link(('solucoes#').($_tmp1),true);?>
">                        <?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
                      </a>                      <?php } ?>                    </div>                  </li>                  <li class="nav-item">                    <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='planos'){?>active<?php }?>"                       title="<?php echo trans('menu_topo_planos_title');?>
"                       href="<?php echo gera_link('planos',true);?>
"                    >                      <?php echo trans('menu_topo_planos');?>
                    </a>                  </li>                  <li class="nav-item dropdown">                    <a class="nav-link dropdown-toggle <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cases'){?>active<?php }?>"                       title="<?php echo trans('menu_topo_cases_title');?>
"                       href="<?php echo gera_link('cases',true);?>
"                    >                      <?php echo trans('menu_topo_cases');?>
                    </a>                    <div class="dropdown-menu">                      <?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable(array_merge($_smarty_tpl->tpl_vars['solucoes_controle_lista']->value,$_smarty_tpl->tpl_vars['solucoes_oferecer_lista']->value), null, 0);?>                      <?php  $_smarty_tpl->tpl_vars['solucao'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['solucao']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>                      <a class="dropdown-item" href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_url;?>
<?php $_tmp2=ob_get_clean();?><?php echo gera_link(('cases#').($_tmp2),true);?>
">                        <?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
                      </a>                      <?php } ?>                    </div>                  </li>                  <li class="nav-item dropdown">                    <a class="nav-link dropdown-toggle <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='conteudo'){?>active<?php }?>"                       title="<?php echo trans('menu_topo_conteudo_title');?>
"                       href="<?php echo gera_link('conteudo',true);?>
"                    >                      <?php echo trans('menu_topo_conteudo');?>
                    </a>                    <div class="dropdown-menu">                      <?php $_smarty_tpl->tpl_vars['itens'] = new Smarty_variable(array_merge($_smarty_tpl->tpl_vars['solucoes_controle_lista']->value,$_smarty_tpl->tpl_vars['solucoes_oferecer_lista']->value), null, 0);?>                      <?php  $_smarty_tpl->tpl_vars['solucao'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['solucao']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>                      <a class="dropdown-item" href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_url;?>
<?php $_tmp3=ob_get_clean();?><?php echo gera_link(('conteudo#').($_tmp3),true);?>
">                        <?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
                      </a>                      <?php } ?>                    </div>                  </li>                </ul>              </div>            </nav>          </div>        </div>        <div class="col-lg-auto">          <div class="align-center">            <?php $_smarty_tpl->tpl_vars['linguagens'] = new Smarty_variable(opcoes_linguagens(linguagens_disponiveis(null,true)), null, 0);?>            <form action="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
" method="post">              <div                class="dropdown no-animate dropdown-select cursor-pointer dropdown-linguagem"                id="filtro-ordenacao"              >                <div                  class="title fz-14 fw-800 dropdown-toggle simple-arrow arrow-left"                  data-toggle="dropdown"                >                  <div class="dropdown-selected d-inline-block va-middle"></div>                </div>                <div class="dropdown-menu dropdown-menu-right cursor-pointer bg-white">                  <?php  $_smarty_tpl->tpl_vars['linguagem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['linguagem']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['linguagens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['linguagem']->key => $_smarty_tpl->tpl_vars['linguagem']->value){
$_smarty_tpl->tpl_vars['linguagem']->_loop = true;
?>                  <a                    class="cursor-pointer dropdown-item bg-body-light-hover text-left <?php if ($_smarty_tpl->tpl_vars['app']->value->Linguagem_banco_sel==$_smarty_tpl->tpl_vars['linguagem']->value->locale){?>active<?php }?>"                    data-value="<?php echo $_smarty_tpl->tpl_vars['linguagem']->value->locale;?>
"                  >                    <div class="flag">                      <div class="d-inline-block va-middle">                        <img class="d-block" src="<?php echo $_smarty_tpl->tpl_vars['linguagem']->value->flag;?>
" width="24px" height="17px"/>                      </div>                      <div class="text d-inline-block va-middle pl-5">                        <?php echo $_smarty_tpl->tpl_vars['linguagem']->value->display_language_compose;?>
                      </div>                    </div>                  </a>                  <?php } ?>                </div>                <input class="dropdown-value" type="hidden"/>              </div>            </form>          </div>        </div>      </div>    </div>  </div></header><?php }} ?>