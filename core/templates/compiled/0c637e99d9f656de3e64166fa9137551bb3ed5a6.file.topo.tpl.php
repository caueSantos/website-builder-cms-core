<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:34
         compiled from "core\templates\producao\vet_life\site\blocos\global\topo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58165f90d976f39d47-24752719%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c637e99d9f656de3e64166fa9137551bb3ed5a6' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\global\\topo.tpl',
      1 => 1603324474,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58165f90d976f39d47-24752719',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'enderecos' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'labcloud_config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d977059ae5_00225485',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d977059ae5_00225485')) {function content_5f90d977059ae5_00225485($_smarty_tpl) {?><header id="topo" class="<?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value!='inicio'){?>fixo<?php }?>">  <div class="top text-white">    <div class="container">      <div class="row">        <div class="col-12 col-lg col-contato fz-14 fz-md-10">          <div class="align-center">            <div class="ml-15 pl-15 enderecos d-inline-block va-middle">              <div class="endereco d-block">                Endereço:                <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
 -                <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
 -                <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf;?>
                <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
,                <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_txf;?>
              </div>            </div>            <div class="ml-0 ml-md-15 pl-0 pl-md-15 mt-20 mt-md-0 telefones d-inline-block va-middle"                 style="border-left: 1px solid #fff">              <span class="va-middle pr-5">Telefone<?php if ($_smarty_tpl->tpl_vars['telefones']->value[1]){?>s<?php }?>: </span>              <ul class="telefones-lista d-inline-block lh-1 va-middle">                <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['telefone']->key;
?>                <li class="telefone d-inline-block mr-10 va-middle">                  <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel=='WHATSAPP'){?>                  <i class="text-white mr-5 fab fa-whatsapp fz-16 va-middle"></i>                  <?php }?>                  <span class="numero va-middle">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>                </li>                <?php } ?>              </ul>            </div>          </div>        </div>        <div class="col-12 col-lg-auto col-redes">          <div class="align-center">            <div class="d-block d-md-inline-block fz-14 fz-md-10 mt-20 mt-md-0 va-middle pr-md-15">              Siga-nos nas redes sociais            </div>            <div class="d-block d-md-inline-block va-middle">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </div>  </div>  <div class="bottom pt-md-35 pb-md-30">    <div class="container">      <div class="row">        <div class="col-lg col-logo">          <div class="logo">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" class="d-block" title="Acesse a página inicial">              <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-topo.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>        </div>        <div class="col-lg-auto col-menu">          <div id="menu-topo" class="align-center">            <nav class="navbar navbar-expand-lg">              <button                class="navbar-toggler"                type="button"                data-toggle="collapse"                data-target="#navbar-topo"                aria-controls="navbar-topo"                aria-expanded="false"                aria-label="Toggle navigation"              >                <span class="navbar-toggler-icon fa fa-bars pr-5"></span>                <span class="texto-menu">MENU</span>              </button>              <div class="collapse navbar-collapse" id="navbar-topo">                <ul class="navbar-nav mx-auto">                  <li class="nav-item">                    <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                       title="Acesse a página inicial"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#inicio"                       data-target="#inicio"                       data-rolagem-margin="0"                    >                      Início                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                       title="Saiba mais sobre nós"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#sobre"                       data-target="#sobre"                    >                      O Laboratório                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'){?>active<?php }?>"                       title="Conheça nossos serviços"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#servicos"                       data-target="#servicos"                    >                      Nossos Serviços                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='exames'){?>active<?php }?>"                       title="Conheça mais sobre nossos parceiros"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#parceiros"                       data-target="#parceiros"                    >                      Parceiros                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link rolagem"                       title="Entre em contato conosco"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#contato"                       data-target="#contato"                    >                      Contato                    </a>                  </li>                  <li class="nav-item">                    <a class="nav-link rolagem"                       title="Veja nossa localização"                       href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#localizacao"                       data-target="#localizacao"                    >                      Localização                    </a>                  </li>                  <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf){?>                  <li class="nav-item d-block d-md-none">                    <a class="nav-link fw-700"                       title="Àrea do Cliente"                       href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf;?>
"                       target="_blank"                    >                      <span>Àrea do Cliente</span>                    </a>                  </li>                  <?php }?>                  <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf){?>                  <li class="nav-item">                    <a class="nav-link fw-700"                       title="Faça seu cadastro"                       href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf;?>
"                       target="_blank"                    >                      Fazer Cadastro                    </a>                  </li>                  <?php }?>                </ul>              </div>            </nav>          </div>        </div>        <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf){?>        <div class="col-lg-auto col-matricula d-none d-md-block">          <div class="align-center botao pl-40 pr-40 pl-md-0 pr-md-0">            <a target="_blank" class="btn-lands btn-sm d-block d-md-inline-block btn-lands-img-ico"               href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf;?>
">              <span class="ico mr-10"><img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/icone-cadastre.png" class="pe-none"/></span>              <span>Àrea do Cliente</span>            </a>          </div>        </div>        <?php }?>      </div>    </div>  </div></header><?php }} ?>