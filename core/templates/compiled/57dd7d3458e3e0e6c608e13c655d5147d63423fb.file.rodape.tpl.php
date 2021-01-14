<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:05
         compiled from "core\templates\producao\diagnostico\site\blocos\global\rodape.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114715f84b9491b1361-70306941%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57dd7d3458e3e0e6c608e13c655d5147d63423fb' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\rodape.tpl',
      1 => 1599983642,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114715f84b9491b1361-70306941',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'assets' => 0,
    'cliente' => 0,
    'enderecos' => 0,
    'endereco' => 0,
    'pagina_atual' => 0,
    'labcloud_config' => 0,
    'requisicao' => 0,
    'horarios' => 0,
    'horario' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'CAMINHO_TPL' => 0,
    'selos' => 0,
    'selo' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b94922e161_78648948',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b94922e161_78648948')) {function content_5f84b94922e161_78648948($_smarty_tpl) {?><footer id="rodape" class="text-white bg-secondary fz-16">  <div class="top pt-80 pb-80">    <div class="container">      <div class="row">        <div class="col-lg-3 col-logo">          <div class="logo">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
" title="Acesse a página inicial">              <img width="100%" itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-rodape.png"                   alt="Logo <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
">            </a>          </div>          <div class="fz-14 mt-40">            <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
          </div>          <ul class="enderecos-lista lh-15 fz-14">            <?php  $_smarty_tpl->tpl_vars['endereco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['endereco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>            <li class="endereco">              <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Endereco_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Bairro_txf;?>
<br/>              <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
,<br/>              <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cep_txf;?>
            </li>            <?php } ?>          </ul>          <div class="afiliada mt-30">            <div class="mt-5" title="Controllab">              <img alt="Controllab" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/afiliada.png" class="img-fluid"/>            </div>          </div>        </div>        <div class="col-lg-2 col-menu offset-md-1 pt-30">          <ul class="menu fz-14 lh-2">            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='inicio'){?>active<?php }?>"                 title="Acesse a página inicial"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
inicio">                Início              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='sobre'){?>active<?php }?>"                 title="Saiba mais sobre nós"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre">                Sobre              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='servicos'){?>active<?php }?>"                 title="Nossos serviços"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
servicos"              >                Serviços              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='exames'){?>active<?php }?>"                 title="Nossos exames"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
exames"              >                Exames              </a>            </li>            <li class="nav-item">              <a class="nav-link"                 title="Cadastre-se"                 href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf;?>
"                 target="_blank"              >                Cadastre-se              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['requisicao']->value['origem']=='blog'){?>active<?php }?>"                 title="Veja nossas últimas notícias"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
blog">                Blog              </a>            </li>            <li class="nav-item">              <a class="nav-link <?php if ($_smarty_tpl->tpl_vars['pagina_atual']->value=='contato'){?>active<?php }?>"                 title="Entre em contato conosco"                 href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato">                Contato              </a>            </li>          </ul>        </div>        <div class="col-md-3 col-contato pt-30">          <div class="horario-atendimento">            <h3 class="title fz-18 text-tertiary fw-500 mb-20">              Horário de atendimento            </h3>            <ul class="fz-14">              <?php  $_smarty_tpl->tpl_vars['horario'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['horario']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['horarios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['horario']->key => $_smarty_tpl->tpl_vars['horario']->value){
$_smarty_tpl->tpl_vars['horario']->_loop = true;
?>              <?php if ($_smarty_tpl->tpl_vars['horario']->value->Semana_txf){?>              <li><strong>Segunda-Sexta:</strong> <?php echo $_smarty_tpl->tpl_vars['horario']->value->Semana_txf;?>
</li>              <?php }?>              <?php if ($_smarty_tpl->tpl_vars['horario']->value->Sabado_txf){?>              <li><strong>Sábado:</strong> <?php echo $_smarty_tpl->tpl_vars['horario']->value->Sabado_txf;?>
</li>              <?php }?>              <?php if ($_smarty_tpl->tpl_vars['horario']->value->Domingo_txf){?>              <li><strong>Domingo:</strong> <?php echo $_smarty_tpl->tpl_vars['horario']->value->Domingo_txf;?>
</li>              <?php }?>              <?php } ?>            </ul>          </div>          <div class="telefones mt-40" style="flex-direction: row">            <h3 class="title fz-18 text-tertiary fw-500 mb-20">              Telefones de Contato            </h3>            <ul class="telefones-lista lh-15 fz-14">              <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>              <li class="telefone">                <span class="numero">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>                <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel=='WHATSAPP'){?>                <i class="ml-5 fz-16 fab fa-whatsapp"></i>                <?php }?>              </li>              <?php } ?>            </ul>          </div>        </div>        <div class="col-lg-3 col-redes">          <div class="redes mt-30">            <h3 class="title fz-18 text-tertiary fw-500 mb-20">              Siga-nos nas redes sociais            </h3>            <div class="fz-22">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>          <ul class="selos mt-md-90 mt-40">            <?php  $_smarty_tpl->tpl_vars['selo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['selo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['selos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['selo']->key => $_smarty_tpl->tpl_vars['selo']->value){
$_smarty_tpl->tpl_vars['selo']->_loop = true;
?>            <?php if ($_smarty_tpl->tpl_vars['selo']->value->Imagens[0]->Caminho_txf){?>            <li title="<?php echo $_smarty_tpl->tpl_vars['selo']->value->Nome_txf;?>
" class="mb-5">              <a href="<?php echo $_smarty_tpl->tpl_vars['selo']->value->Link_txf;?>
" target="_blank">                <img alt="<?php echo $_smarty_tpl->tpl_vars['selo']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['selo']->value->Imagens[0]->Caminho_txf;?>
"/>              </a>            </li>            <?php }?>            <?php } ?>          </ul>        </div>      </div>    </div>  </div>  <div class="bottom bg-dark-grey">    <div class="container">      <div class="row">        <div class="col-md-8">          <div class="direitos"><?php echo date("Y");?>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
 - Todos os direitos reservados</div>        </div>        <div class="col-md-4">          <div class="assinatura">            <a              title="Acesse o site da Lands - Agência Web"              href="https://landsagenciaweb.com.br" target="_blank"            ></a>          </div>        </div>      </div>    </div>  </div></footer><div id="retorno"></div><?php }} ?>