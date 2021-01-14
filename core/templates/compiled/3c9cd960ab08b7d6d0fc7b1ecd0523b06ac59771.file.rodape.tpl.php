<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:40
         compiled from "core\templates\producao\abseg\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169705f53def00c65b6-31144001%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c9cd960ab08b7d6d0fc7b1ecd0523b06ac59771' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\global\\rodape.tpl',
      1 => 1599260075,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169705f53def00c65b6-31144001',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'sobre' => 0,
    'pagina_atual' => 0,
    'requisicao' => 0,
    'materiais_lista' => 0,
    'nivel' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'emails' => 0,
    'email' => 0,
    'enderecos' => 0,
    'endereco' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53def012f6a9_63105787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53def012f6a9_63105787')) {function content_5f53def012f6a9_63105787($_smarty_tpl) {?><footer id="rodape" class="text-body-primary">  <div class="top pt-80 pb-80">    <div class="container">      <div class="row">        <div class="col-lg-3 col-logo">          <div class="logo">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" title="Acesse a página inicial">              <img width="172" itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-rodape.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>          <div class="title fw-700 fz-16 text-secondary mt-30"><?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
</div>          <div class="texto fz-12 mt-10 text-body-primary" data-read-more="2">            <?php echo corta_texto($_smarty_tpl->tpl_vars['sobre']->value[0]->Sobre_txa,999);?>
          </div>          <div class="afiliada mt-30">            <div class="title fw-500 fz-10">              Corretora afiliada da            </div>            <div class="mt-5">              <img alt="Rede lojacor" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/afiliada.png" class="img-fluid"/>            </div>          </div>        </div>        <div class="col-lg-2 col-menu offset-md-1 pt-30">          <h3 class="fz-16 text-primary fw-700 mb-20">            Mapa do site          </h3>          <ul class="menu fz-12">            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                 title="Acesse a página inicial"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
inicio">                Início              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                 title="Saiba mais sobre nós"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre">                Quem somos              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='solucoes'){?>active<?php }?>"                 title="Nossas soluções"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato">                Soluções              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='central-de-ajuda'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
central-de-ajuda">                Central de Ajuda              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['requisicao']->value['origem']=='blog'){?>active<?php }?>"                 title="Veja nossas últimas notícias"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
blog">                Blog              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato">                Contato              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='cotacao'){?>active<?php }?>"                 title="Faça a cotação de um seguro"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cotacao">                Cotação              </a>            </li>          </ul>        </div>        <div class="col-md-3 col-materiais pt-30 pl-md-60 pr-md-60">          <h3 class="fz-16 text-primary fw-700 mb-20">            Materiais          </h3>          <ul class="menu fz-12">            <?php  $_smarty_tpl->tpl_vars['nivel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['nivel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['materiais_lista']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['nivel']->key => $_smarty_tpl->tpl_vars['nivel']->value){
$_smarty_tpl->tpl_vars['nivel']->_loop = true;
?>            <?php if (is_url($_smarty_tpl->tpl_vars['nivel']->value->Link_txf)){?>            <li class="nav-item">              <a class="nav-link"                 href="<?php echo $_smarty_tpl->tpl_vars['nivel']->value->Link_txf;?>
"                 target="_blank">                <?php echo $_smarty_tpl->tpl_vars['nivel']->value->Nome_txf;?>
              </a>            </li>            <?php }?>            <?php } ?>          </ul>        </div>        <div class="col-lg-3 pt-30 col-contato fz-12">          <h3 class="fz-16 text-primary fw-400 mb-20">            Entre em <strong>contato</strong>          </h3>          <div class="telefones flex-pai" style="flex-direction: row">            <div class="icone flex-filho flex-grow-0 fz-14 pr-10 lh-15 pt-5">              <i style="width: 16px" class="fas fa-phone-alt"></i>            </div>            <div class="flex-filho flex-grow-1 justify-content-start">              <ul class="telefones-lista lh-15">                <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>                <li class="telefone">                  <span class="numero">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>                  <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel=='WHATSAPP'){?>                  <i class="ml-5 fz-16 fw-700 fab fa-whatsapp" style="color: #0DC143;"></i>                  <?php }?>                </li>                <?php } ?>              </ul>            </div>          </div>          <div class="emails flex-pai mt-15" style="flex-direction: row">            <div class="icone flex-filho flex-grow-0 fz-14 pr-10 lh-15 pt-5">              <i style="width: 16px" class="fas fa-envelope"></i>            </div>            <div class="flex-filho flex-grow-1 justify-content-start">              <ul class="emails-lista lh-15">                <?php  $_smarty_tpl->tpl_vars['email'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['email']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
?>                <li class="email"><?php echo $_smarty_tpl->tpl_vars['email']->value->Email_txf;?>
</li>                <?php } ?>              </ul>            </div>          </div>          <div class="enderecos flex-pai mt-15" style="flex-direction: row">            <div class="icone flex-filho flex-grow-0 fz-14 pr-10 lh-15" style="padding-top: 2px">              <i style="width: 16px" class="fas fa-map-marker-alt"></i>            </div>            <div class="flex-filho flex-grow-1 justify-content-start">              <ul class="enderecos-lista lh-15">                <?php  $_smarty_tpl->tpl_vars['endereco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['endereco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>                <li class="endereco"><?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cidade_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
, Brasil</li>                <?php } ?>              </ul>            </div>          </div>          <div class="redes mt-30">            <h3 class="fz-16 text-primary fw-400 mb-15">              Siga nos nas <strong>redes sociais</strong>            </h3>            <div class="fz-22">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </div>  </div>  <div class="bottom bg-dark-grey">    <div class="container">      <div class="row">        <div class="col-md-8">          <div class="direitos"><?php echo date("Y");?>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
 - Todos os direitos reservados</div>        </div>        <div class="col-md-4">          <div class="assinatura">            <a              title="Acesse o site da Lands - Agência Web"              href="https://landsagenciaweb.com.br" target="_blank"            ></a>          </div>        </div>      </div>    </div>  </div></footer><div id="retorno"></div><?php }} ?>