<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\lista-acoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:214395fd2df4a58cdc9-37317641%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd37eb0d9529475b93e3cd616c9ffc359e35cf70f' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\lista-acoes.tpl',
      1 => 1604744352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '214395fd2df4a58cdc9-37317641',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a598f31_44577332',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a598f31_44577332')) {function content_5fd2df4a598f31_44577332($_smarty_tpl) {?><div class="lista-acoes pt-50 pb-50 pt-lg-120 pb-lg-120">

  <div class="bg-fake">
    <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/fundo-acoes-imoveis.png" class="img-fit pe-none"/>
  </div>

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-11">

        <div class="row">

          <div class="col-lg-4 pb-30 pb-lg-0">

            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cadastre-seu-imovel" class="item-acao d-block hover hover-shadow hover-scale-up br-1 bs-1 bg-white
            fz-16 text-center pl-20 pl-lg-40 pr-20 pr-lg-40 pt-30 pt-lg-60 pb-30 pb-lg-60
            text-body-tertiary">

              <figure class="mx-auto" style="background: #F4F4F6; width: 80px; height: 80px; box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.05)">
                <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/acao-buzina.png" style="max-width: 36px" class="pe-none align-center"/>
              </figure>

              <div class="title text-primary fz-24 fz-lg-32 fw-700 lh-12 mt-35">
                Quero vender um imóvel!
              </div>

              <div class="texto fz-16 fw-400 mt-20">
                Anúncie conosco e deixe que
                faremos a parte mais difícil!
              </div>

              <div class="text-primary fz-16 fw-700 mt-25">
                Cadastrar imóvel
              </div>

            </a>

          </div>


          <div class="col-lg-4 pb-30 pb-lg-0">

            <a href="javascript:void(0);" data-target="#modal-encomende" data-toggle="modal" class="item-acao d-block hover hover-shadow hover-scale-up br-1 bs-1 bg-white
            fz-16 text-center pl-20 pl-lg-40 pr-20 pr-lg-40 pt-30 pt-lg-60 pb-30 pb-lg-60
            text-body-tertiary">

              <figure class="mx-auto" style="background: #F4F4F6; width: 80px; height: 80px; box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.05)">
                <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/acao-ajuda.png" style="max-width: 36px" class="pe-none align-center"/>
              </figure>

              <div class="title text-primary fz-24 fz-lg-32 fw-700 lh-12 mt-35">
                Não encontrou o que procurava?
              </div>

              <div class="texto fz-16 fw-400 mt-20">
                Encomende o que você quer e vamos encontrar um imóvel para você
              </div>

              <div class="text-primary fz-16 fw-700 mt-25">
                Encomendar imóvel
              </div>

            </a>

          </div>


          <div class="col-lg-4 pb-30 pb-lg-0">

            <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
avalie-seu-imovel" class="item-acao d-block hover hover-shadow hover-scale-up br-1 bs-1 bg-white
            fz-16 text-center pl-20 pl-lg-40 pr-20 pr-lg-40 pt-30 pt-lg-60 pb-30 pb-lg-60
            text-body-tertiary">

              <figure class="mx-auto" style="background: #F4F4F6; width: 80px; height: 80px; box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.05)">
                <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/acao-dinheiro.png" style="max-width: 36px" class="pe-none align-center"/>
              </figure>

              <div class="title text-primary fz-24 fz-lg-32 fw-700 lh-12 mt-35">
                Avalie seu Imóvel!
              </div>

              <div class="texto fz-16 fw-400 mt-20">
                Se você precisa avaliar o seu imóvel
                nós podemos te ajudar
              </div>

              <div class="text-primary fz-16 fw-700 mt-25">
                Avalie seu imóvel
              </div>

            </a>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>
<?php }} ?>