<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:219735fd2df4a5ce5a5-97129017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '421e2feae6b9f2bd582065158f81b3188f0d01b6' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\rodape.tpl',
      1 => 1604744351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '219735fd2df4a5ce5a5-97129017',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'pagina_atual' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a60a078_89479659',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a60a078_89479659')) {function content_5fd2df4a60a078_89479659($_smarty_tpl) {?><footer id="rodape" class="fz-12 lh-15 text-body-quaternary bg-body-light">  <div class="top pt-60 pb-80">    <div class="container">      <div class="row">        <div class="col-lg-3 col-logo">          <div class="logo" style="width: 176px">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" title="Acesse a página inicial">              <img width="100%" itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-rodape.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg-2 col-menu">          <h3 class="title fz-14 text-primary fw-700 mb-25">            Zeh Imóveis          </h3>          <ul class="menu fz-14 lh-2">            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                 title="Acesse a página inicial"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
inicio"              >                Início              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='imoveis'){?>active<?php }?>"                 title="Conheça nossos imóveis"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis"              >                Imóveis              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='empreendimentos'){?>active<?php }?>"                 title="Conheça nossos empreendimentos"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
empreendimentos"              >                Empreendimentos              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                 title="Conheça mais sobre nós"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre"              >                Quem somos              </a>            </li>            <li class="nav-item fw-700">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato"              >                Fale conosco              </a>            </li>          </ul>        </div>        <div class="col-lg-2 offset-lg-1 col-servicos">          <h3 class="title fz-14 text-primary fw-700 mb-25">            Serviços          </h3>          <ul class="menu servicos fz-14 lh-2">            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cadastre-seu-imovel'){?>active<?php }?>"                 title="Cadastre seu imóvel na nossa base"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cadastre-seu-imovel"              >                Cadastre seu imóvel              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cadastre-seu-imovel'){?>active<?php }?>"                 title="Cadastre seu imóvel na nossa base"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cadastre-seu-imovel"              >                Alugue seu imóvel              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='avalie-seu-imovel'){?>active<?php }?>"                 title="Avalie seu imóvel conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
avalie-seu-imovel"              >                Avalie seu imóvel              </a>            </li>          </ul>        </div>        <div class="col-lg-2 col-redes offset-lg-1">          <h3 class="title fz-14 text-primary fw-700 mb-25">            Redes sociais          </h3>          <div class="fz-22">            <?php $_smarty_tpl->tpl_vars['vertical'] = new Smarty_variable(true, null, 0);?>            <?php $_smarty_tpl->tpl_vars['mostra_label'] = new Smarty_variable(true, null, 0);?>            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </div>  <div class="bottom bg-secondary">    <div class="container">      <div class="row">        <div class="col-lg-8">          <div class="direitos ff-secondary align-center">            Copyright © <?php echo date("Y");?>
 <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
. Todos os direitos reservados          </div>        </div>        <div class="col-lg-4">          <div class="assinatura text-center text-lg-right">            <div class="d-inline-block va-middle ff-secondary fz-12 fw-700 pr-15">              Feito por:            </div>            <a              title="Acesse o site da Lands - Agência Web"              href="https://landsagenciaweb.com.br" target="_blank"            ></a>          </div>        </div>      </div>    </div>  </div></footer><div id="retorno"></div><?php }} ?>