<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "core\templates\producao\hubvet\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27497601b7f04d57d02-30594542%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9daa9e54159a7caf98416a3b5246b57ba50efdd4' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\rodape.tpl',
      1 => 1612414256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27497601b7f04d57d02-30594542',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'menu_topo' => 0,
    'menu_topo_itens' => 0,
    'menu' => 0,
    'pagina_atual' => 0,
    'menu_item' => 0,
    'emails' => 0,
    'telefones' => 0,
    'enderecos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7f04dcbc98_71750536',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04dcbc98_71750536')) {function content_601b7f04dcbc98_71750536($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable(2, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/experimente-secao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<footer id="rodape" class="fz-12 lh-15 text-white bg-dark-grey">  <div class="top">    <div class="container">      <div class="pt-50 pt-md-90 pb-50 pb-md-70">        <div class="row">          <div class="col-lg-3 col-logo">            <div class="logo" style="width: 176px">              <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
" title="Acesse a página inicial">                <img width="100%" itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-rodape.png"                     alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">              </a>            </div>          </div>          <div class="col-md d-none d-md-block"></div>          <div class="col-md-auto">            <div class="align-center fz-16 fz-400">              <?php echo trans('nos_acompanhe_redes');?>
:            </div>          </div>          <div class="col-md-auto">            <div class="fz-24 align-center">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>      <hr class="mt-0 mb-0"/>    </div>  </div>  <div class="middle pt-50 pt-md-70 pb-50 pb-md-60">    <div class="container">      <div class="row">        <div class="col-md-8">          <div class="row">            <?php $_smarty_tpl->tpl_vars['menu_topo'] = new Smarty_variable(junta_registros($_smarty_tpl->tpl_vars['menu_topo']->value,'Nome_url',$_smarty_tpl->tpl_vars['menu_topo_itens']->value,'Menu_sel','Itens'), null, 0);?>            <?php $_smarty_tpl->tpl_vars['menu_topo'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['menu_topo']->value,'Mostra_rodape_sel','=','SIM'), null, 0);?>            <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu_topo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
$_smarty_tpl->tpl_vars['menu']->_loop = true;
?>            <?php if ($_smarty_tpl->tpl_vars['menu']->value->Itens[0]){?>            <div class="col-md">              <h3 class="fz-14 fw-700">                <?php echo $_smarty_tpl->tpl_vars['menu']->value->Nome_tit;?>
              </h3>              <ul class="menu fz-14">                <?php  $_smarty_tpl->tpl_vars['menu_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menu_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value->Itens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menu_item']->key => $_smarty_tpl->tpl_vars['menu_item']->value){
$_smarty_tpl->tpl_vars['menu_item']->_loop = true;
?>                <li class="nav-item mt-30">                  <a                    class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value==$_smarty_tpl->tpl_vars['menu_item']->value->Nome_url){?>active<?php }?>"                    title="<?php echo $_smarty_tpl->tpl_vars['menu_item']->value->Nome_txf;?>
"                    href="<?php echo gera_link($_smarty_tpl->tpl_vars['menu_item']->value->Botao_link_txf,true);?>
"                    target="<?php if ($_smarty_tpl->tpl_vars['menu_item']->value->Target_sel){?><?php echo $_smarty_tpl->tpl_vars['menu_item']->value->Target_sel;?>
<?php }else{ ?>_self<?php }?>"                  >                    <?php echo $_smarty_tpl->tpl_vars['menu_item']->value->Nome_txf;?>
                  </a>                </li>                <?php } ?>              </ul>            </div>            <?php }?>            <?php } ?>          </div>        </div>        <div class="col-md-4">          <!--ATENDIMENTO-->          <div class="bg-dark-grey-2 text-white pt-20 pb-20 pl-30 pr-30 br-1">            <div class="row">              <div class="col-auto">                <div                  class="aspect-item bg-dark-grey fz-24 text-center align-center"                  style="height: 50px; width: 50px"                >                  <div class="align-center lh-1">                    <i class="far fa-comment-alt-lines"></i>                  </div>                </div>              </div>              <div class="col-sm">                <div class="align-center fz-14">                  <div class="title fw-700">                    <?php echo trans('email');?>
                  </div>                  <div class="texto mt-5">                    <?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
                  </div>                </div>              </div>            </div>          </div>          <!--TELEFONE-->          <div class="bg-dark-grey-2 text-white pt-20 pb-20 pl-30 pr-30 br-1 mt-15">            <div class="row">              <div class="col-auto">                <div                  class="aspect-item bg-dark-grey fz-24 text-center align-center"                  style="height: 50px; width: 50px"                >                  <div class="align-center lh-1">                    <i class="fal fa-phone-alt"></i>                  </div>                </div>              </div>              <div class="col-sm">                <div class="align-center fz-14">                  <div class="title fw-700">                    <?php echo trans('telefone');?>
                  </div>                  <div class="texto mt-5">                    (<?php echo $_smarty_tpl->tpl_vars['telefones']->value[0]->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefones']->value[0]->Numero_txf;?>
                  </div>                </div>              </div>            </div>          </div>          <!--ENDEREÇO-->          <div class="bg-dark-grey-2 text-white pt-20 pb-20 pl-30 pr-30 br-1 mt-15">            <div class="row">              <div class="col-auto">                <div                  class="aspect-item bg-dark-grey fz-24 text-center align-center"                  style="height: 50px; width: 50px"                >                  <div class="align-center lh-1">                    <i class="fal fa-map-marker-alt"></i>                  </div>                </div>              </div>              <div class="col-sm">                <div class="align-center fz-14">                  <div class="title fw-700">                    <?php echo trans('endereco');?>
                  </div>                  <div class="texto mt-5">                    <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
,                    <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_txf;?>
,                    <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf;?>
                  </div>                </div>              </div>            </div>          </div>        </div>      </div>    </div>  </div>  <div class="bottom bg-dark-grey pt-50 pt-md-60 pb-15">    <div class="container">      <div class="row">        <div class="col-lg-8 text-body-secondary">          <div class="direitos align-center">            <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
,            <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_txf;?>
,            <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf;?>
          </div>        </div>        <div class="col-lg-4">          <div class="text-center text-lg-right fz-12">            <div class="font-rodape ml-auto">              <?php echo trans('site_criado_com');?>
              <i class="fas fa-heart mx-1" style="color: red;"></i>              <?php echo trans('pela');?>
              <a                href="<?php echo gera_link(config('site_lands_link'));?>
"                target="_blank"                class="fw-700 text-white"              >                <?php echo trans('lands_agencia_nome');?>
              </a>            </div>          </div>        </div>      </div>    </div>  </div>  <div class="links-rodape pt-20 pb-30 text-body-secondary">    <div class="container">      <div class="row justify-content-center">        <div class="col-12 col-md-auto text-center">          <ul class="fw-700 fz-12">            <li class="d-block d-md-inline-block pl-md-30 pr-md-30">              ©<?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
            </li>            <li class="d-block d-md-inline-block pl-md-30 pr-md-30">              <a class="d-block text-body-secondary text-primary-hover" href="<?php echo gera_link(config('politicas_link'));?>
" target="_blank">                <?php echo trans('politicas');?>
              </a>            </li>            <li class="d-block d-md-inline-block pl-md-30 pr-md-30">              <a class="d-block text-body-secondary text-primary-hover" href="<?php echo gera_link(config('termos_link'));?>
" target="_blank">                <?php echo trans('termos');?>
              </a>            </li>          </ul>        </div>      </div>    </div>  </div></footer><div id="retorno"></div><?php }} ?>