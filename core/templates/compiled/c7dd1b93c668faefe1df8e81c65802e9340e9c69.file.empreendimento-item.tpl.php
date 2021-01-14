<?php /* Smarty version Smarty-3.1.12, created on 2021-01-07 20:04:12
         compiled from "core\templates\producao\hubvet\site\blocos\empreendimentos\empreendimento-item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:62275ff7855c597fc9-21425356%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7dd1b93c668faefe1df8e81c65802e9340e9c69' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\empreendimentos\\empreendimento-item.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '62275ff7855c597fc9-21425356',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'empreendimento' => 0,
    'app' => 0,
    'assets' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff7855c5f98d0_98431501',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff7855c5f98d0_98431501')) {function content_5ff7855c5f98d0_98431501($_smarty_tpl) {?><article class="item-empreendimentos text-center text-lg-left">  <div class="bg-fake">    <div class="container fill-height">      <div class="row fill-height mx-0">        <div class="col-lg-10 fill-height" style="box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.05);"></div>      </div>    </div>  </div>  <div class="container pb-60 pt-60">    <div class="row">      <div class="col-txt col-lg-5 offset-lg-1 order-2 order-lg-0 pt-30 pt-lg-0">        <div class="text-layer align-center">          <div class="text-body-tertiary fz-18 title fw-700">            Empreendimentos          </div>          <div class="title fz-32 fw-700 lh-12 text-primary mt-10">            <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Nome_tit;?>
          </div>          <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_curta_txa){?>          <div class="texto fz-16 fw-400 lh-15 mt-30 text-body-primary">            <?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Descricao_curta_txa;?>
          </div>          <?php }?>          <div class="botao mt-35">            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
empreendimentos/<?php echo $_smarty_tpl->tpl_vars['empreendimento']->value->Nome_url;?>
"               class="btn-lands btn-outline pr-lg-60 pl-lg-60">              Saiba mais            </a>          </div>        </div>      </div>      <div class="col-img col-lg-6 order-1 order-lg-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable(($_smarty_tpl->tpl_vars['assets']->value).('imagens/indisponivel-quadrada.png'), null, 0);?>        <?php if ($_smarty_tpl->tpl_vars['empreendimento']->value->Imagens[0]){?>        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable(($_smarty_tpl->tpl_vars['painel']->value).($_smarty_tpl->tpl_vars['empreendimento']->value->Imagens[0]->Caminho_txf), null, 0);?>        <?php }?>        <div class="aspect aspect-4-3 br-2 overflow-hidden bg-body-light">          <figure class="aspect-item image-layer">            <img alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['empreendimento']->value->Titulo_txf);?>
"                 class="img-fit"                 title="<?php echo strip_tags($_smarty_tpl->tpl_vars['empreendimento']->value->Titulo_txf);?>
"                 src="<?php echo $_smarty_tpl->tpl_vars['imagem']->value;?>
"/>          </figure>        </div>      </div>    </div>  </div></article><?php }} ?>