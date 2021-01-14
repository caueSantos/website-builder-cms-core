<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:52
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:246805f90ff80b75f01-24606072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17975ff10902ca9451d95eb0b748963f78aacb54' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\global\\rodape.tpl',
      1 => 1603330563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '246805f90ff80b75f01-24606072',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'sobre' => 0,
    'selos' => 0,
    'selo' => 0,
    'painel' => 0,
    'pagina_atual' => 0,
    'labcloud_config' => 0,
    'enderecos' => 0,
    'endereco' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff80bf5657_68846090',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff80bf5657_68846090')) {function content_5f90ff80bf5657_68846090($_smarty_tpl) {?><footer id="rodape" class="fz-12 lh-15 text-body-quaternary">  <div class="top pt-80 pb-70">    <div class="container">      <div class="row">        <div class="col-md-4 col-logo">          <div class="logo" style="width: 153px">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" title="Acesse a página inicial">              <img width="100%" itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-rodape.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>          <?php if ($_smarty_tpl->tpl_vars['sobre']->value[0]->Sobre_rodape_txa){?>          <div class="mt-30 lh-18" data-read-more="3">            <?php echo strip_tags($_smarty_tpl->tpl_vars['sobre']->value[0]->Sobre_rodape_txa);?>
          </div>          <?php }?>          <?php if ($_smarty_tpl->tpl_vars['selos']->value){?>          <div class="selos mt-30">            <div class="fz-12 tt-upper mb-20" style="letter-spacing: 2px;">Laboratório credenciado pelo:</div>            <ul class="row no-gutters">              <?php  $_smarty_tpl->tpl_vars['selo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['selo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['selo']->key => $_smarty_tpl->tpl_vars['selo']->value){
$_smarty_tpl->tpl_vars['selo']->_loop = true;
?>              <?php if ($_smarty_tpl->tpl_vars['selo']->value->Imagens[0]->Caminho_txf){?>              <li title="<?php echo $_smarty_tpl->tpl_vars['selo']->value->Nome_txf;?>
" class="col-6 col-md-auto mb-5 pr-md-10">                <a href="<?php echo $_smarty_tpl->tpl_vars['selo']->value->Link_txf;?>
" target="_blank">                  <img alt="<?php echo $_smarty_tpl->tpl_vars['selo']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['selo']->value->Imagens[0]->Caminho_txf;?>
"/>                </a>              </li>              <?php }?>              <?php } ?>            </ul>          </div>          <?php }?>        </div>        <div class="col-md-2 col-menu offset-md-1 pt-30">          <h3 class="tt-upper fz-14 text-body-quaternary fw-500 mb-20">            Menu do site          </h3>          <ul class="menu fz-14 lh-2">            <li class="nav-item">              <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                 title="Acesse a página inicial"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#inicio"                 data-target="#inicio"                 data-rolagem-margin="0"              >                Início              </a>            </li>            <li class="nav-item">              <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                 title="Saiba mais sobre nós"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#sobre"                 data-target="#sobre"              >                O Laboratório              </a>            </li>            <li class="nav-item">              <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'){?>active<?php }?>"                 title="Conheça nossos serviços"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#servicos"                 data-target="#servicos"              >                Nossos Serviços              </a>            </li>            <li class="nav-item">              <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='exames'){?>active<?php }?>"                 title="Conheça mais sobre nossos parceiros"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#parceiros"                 data-target="#parceiros"              >                Parceiros              </a>            </li>            <li class="nav-item">              <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#contato"                 data-target="#contato"              >                Contato              </a>            </li>            <li class="nav-item">              <a class="nav-link rolagem <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
#localizacao"                 data-target="#localizacao"              >                Localização              </a>            </li>            <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf){?>            <li class="nav-item">              <a class="nav-link fw-700 <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf;?>
"                 target="_blank"              >                Fazer Cadastro              </a>            </li>            <?php }?>          </ul>        </div>        <div class="col-md-3 offset-md-1 col-contato pt-30">          <h3 class="tt-upper fz-14 text-body-quaternary fw-500 mb-20">            Contato          </h3>          <ul class="enderecos-lista lh-18 fz-12">            <?php  $_smarty_tpl->tpl_vars['endereco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['endereco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>            <li class="endereco">              <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Endereco_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Bairro_txf;?>
<br>              <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cep_txf;?>
 <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
            </li>            <?php } ?>          </ul>          <div class="telefones mt-20" style="flex-direction: row">            <ul class="telefones-lista lh-2 fz-12">              <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>              <li class="telefone">                <span class="numero">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>                <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel=='WHATSAPP'){?>                <i class="ml-5 fz-16 fab fa-whatsapp"></i>                <?php }?>              </li>              <?php } ?>            </ul>          </div>          <div class="redes mt-30">            <h3 class="tt-upper fz-14 text-body-quaternary fw-500 mb-20">              Redes sociais            </h3>            <div class="fz-22">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </div>  </div>  <div class="bottom bg-dark-grey">    <div class="container">      <div class="row">        <div class="col-md-8">          <div class="direitos"><?php echo date("Y");?>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
 - Todos os direitos reservados</div>        </div>        <div class="col-md-4">          <div class="assinatura">            <a              title="Acesse o site da Lands - Agência Web"              href="https://landsagenciaweb.com.br" target="_blank"            ></a>          </div>        </div>      </div>    </div>  </div></footer><div id="retorno"></div><?php }} ?>