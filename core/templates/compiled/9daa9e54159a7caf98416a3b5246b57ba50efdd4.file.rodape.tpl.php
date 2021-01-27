<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 17:49:42
         compiled from "core\templates\producao\hubvet\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83396010725686c2b6-04526536%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9daa9e54159a7caf98416a3b5246b57ba50efdd4' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\rodape.tpl',
      1 => 1610991941,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83396010725686c2b6-04526536',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'pagina_atual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601072568da551_98203082',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601072568da551_98203082')) {function content_601072568da551_98203082($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable(2, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/experimente-secao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<footer id="rodape" class="fz-12 lh-15 text-white bg-dark-grey">  <div class="top pt-60 pb-80">    <div class="container">      <div class="row">        <div class="col-lg-3 col-logo">          <div class="logo" style="width: 176px">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
" title="Acesse a página inicial">              <img width="100%" itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-rodape.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg-2 col-menu">          <h3 class="title fz-14 text-primary fw-700 mb-25">            Zeh Imóveis          </h3>          <ul class="menu fz-14 lh-2">            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                 title="<?php echo trans('menu_topo_inicio_title');?>
"                 href="<?php echo gera_link('inicio',true);?>
"              >                <?php echo trans('menu_topo_inicio');?>
              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='solucoes'){?>active<?php }?>"                 title="<?php echo trans('menu_topo_solucoes_title');?>
"                 href="<?php echo gera_link('solucoes',true);?>
"              >                <?php echo trans('menu_topo_solucoes');?>
              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='planos'){?>active<?php }?>"                 title="<?php echo trans('menu_topo_planos_title');?>
"                 href="<?php echo gera_link('planos',true);?>
"              >                <?php echo trans('menu_topo_planos');?>
              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cases'){?>active<?php }?>"                 title="<?php echo trans('menu_topo_cases_title');?>
"                 href="<?php echo gera_link('cases',true);?>
"              >                <?php echo trans('menu_topo_cases');?>
              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='conteudo'){?>active<?php }?>"                 title="<?php echo trans('menu_topo_conteudo_title');?>
"                 href="<?php echo gera_link('conteudo',true);?>
"              >                <?php echo trans('menu_topo_conteudo');?>
              </a>            </li>          </ul>        </div>        <div class="col-lg-2 offset-lg-1 col-servicos">          <h3 class="title fz-14 text-primary fw-700 mb-25">            Serviços          </h3>          <ul class="menu servicos fz-14 lh-2">            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cadastre-seu-imovel'){?>active<?php }?>"                 title="Cadastre seu imóvel na nossa base"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
cadastre-seu-imovel"              >                Cadastre seu imóvel              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cadastre-seu-imovel'){?>active<?php }?>"                 title="Cadastre seu imóvel na nossa base"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
cadastre-seu-imovel"              >                Alugue seu imóvel              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='avalie-seu-imovel'){?>active<?php }?>"                 title="Avalie seu imóvel conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
avalie-seu-imovel"              >                Avalie seu imóvel              </a>            </li>          </ul>        </div>        <div class="col-lg-2 col-redes offset-lg-1">          <h3 class="title fz-14 text-primary fw-700 mb-25">            Redes sociais          </h3>          <div class="fz-22">            <?php $_smarty_tpl->tpl_vars['vertical'] = new Smarty_variable(true, null, 0);?>            <?php $_smarty_tpl->tpl_vars['mostra_label'] = new Smarty_variable(true, null, 0);?>            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </div>  <div class="bottom bg-dark-grey">    <div class="container">      <div class="row">        <div class="col-lg-8">          <div class="direitos ff-secondary align-center">            Copyright © <?php echo date("Y");?>
 <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
. Todos os direitos reservados          </div>        </div>        <div class="col-lg-4">          <div class="assinatura text-center text-lg-right">            <div class="d-inline-block va-middle ff-secondary fz-12 fw-700 pr-15">              Feito por:            </div>            <a              title="Acesse o site da Lands - Agência Web"              href="https://landsagenciaweb.com.br" target="_blank"            ></a>          </div>        </div>      </div>    </div>  </div></footer><div id="retorno"></div><?php }} ?>