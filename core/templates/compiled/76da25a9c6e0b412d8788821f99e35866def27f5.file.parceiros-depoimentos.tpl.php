<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 09:40:04
         compiled from "core\templates\producao\hubvet\site\blocos\parceiros\parceiros-depoimentos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177445ffd8a9474d947-10263304%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76da25a9c6e0b412d8788821f99e35866def27f5' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\parceiros\\parceiros-depoimentos.tpl',
      1 => 1610299849,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177445ffd8a9474d947-10263304',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'parceiros_depoimentos' => 0,
    'titulos' => 0,
    'depoimento' => 0,
    'icone' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd8a9478dd14_93300456',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd8a9478dd14_93300456')) {function content_5ffd8a9478dd14_93300456($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['parceiros_depoimentos']->value[0]){?>
<section class="parceiros-lista pt-40 pb-20 pt-md-80 pb-md-80 bg-body-light">

  <div class="container setas-centro">

    <div class="title-group text-center">
      <h1 class="title fz-40 lh-12 fw-400 text-primary">
        <?php echo titulo('parceiros_depoimentos_secao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </h1>
      <?php if (titulo('parceiros_depoimentos_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
      <div class="texto fz-18 mt-15 lh-15">
        <?php echo titulo('parceiros_depoimentos_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </div>
      <?php }?>
    </div>

    <div class="mt-60 owl-carousel has-shadow"
         data-owl-carousel="true"
         data-owl-items="3"
         data-rwd="1-2-3-3"
         data-owl-loop="true"
         data-owl-autoplay="true"
         data-owl-autoplay-timeout="10000"
         data-owl-margin="30"
         data-owl-dots="false"
         data-owl-nav="true"
         data-owl-slide-by="1"
         data-owl-dots-each="1"
    >

      <?php  $_smarty_tpl->tpl_vars['depoimento'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['depoimento']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['parceiros_depoimentos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['depoimento']->key => $_smarty_tpl->tpl_vars['depoimento']->value){
$_smarty_tpl->tpl_vars['depoimento']->_loop = true;
?>
      <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable($_smarty_tpl->tpl_vars['depoimento']->value->Imagens[0], null, 0);?>
      <div class="item fill-height bg-white bs-2 hover hover-opacity br-1 pt-60 pb-40 pl-50 pr-50">
        <div
          class="link-item align-center d-block text-center tn-ease"
        >
          <?php if ($_smarty_tpl->tpl_vars['depoimento']->value->Texto_txa){?>
          <div class="texto fz-14 lh-12 mb-20">
            <?php echo $_smarty_tpl->tpl_vars['depoimento']->value->Texto_txa;?>

          </div>
          <?php }?>
          <div class="mx-auto aspect aspect-1-1 br-100 overflow-hidden" style="width: 74px">
            <figure class="imagem aspect-item">
              <?php if ($_smarty_tpl->tpl_vars['icone']->value){?>
              <img alt="<?php echo $_smarty_tpl->tpl_vars['depoimento']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value->Caminho_txf;?>
"
                   class="img-fit"/>
              <?php }else{ ?>
              <img class="img-fit"
                   alt="<?php echo $_smarty_tpl->tpl_vars['depoimento']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"/>
              <?php }?>
            </figure>
          </div>

          <?php if ($_smarty_tpl->tpl_vars['depoimento']->value->Nome_txf){?>
          <div class="title fz-16 fw-700 mt-15">
            <?php echo $_smarty_tpl->tpl_vars['depoimento']->value->Nome_txf;?>

          </div>
          <?php }?>

          <?php if ($_smarty_tpl->tpl_vars['depoimento']->value->Informacao_txf){?>
          <div class="fz-16 mt-5 lh-12">
            <?php echo $_smarty_tpl->tpl_vars['depoimento']->value->Informacao_txf;?>

          </div>
          <?php }?>

        </div>
      </div>
      <?php } ?>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>