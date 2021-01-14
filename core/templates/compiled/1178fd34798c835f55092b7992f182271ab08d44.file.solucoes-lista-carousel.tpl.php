<?php /* Smarty version Smarty-3.1.12, created on 2020-11-01 20:54:29
         compiled from "core\templates\producao\zehimoveis\site\blocos\solucoes\solucoes-lista-carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160025f9f3ca525c586-29668966%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1178fd34798c835f55092b7992f182271ab08d44' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\solucoes\\solucoes-lista-carousel.tpl',
      1 => 1603426724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160025f9f3ca525c586-29668966',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servicos' => 0,
    'servico' => 0,
    'icone' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f9f3ca52abf86_03820797',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9f3ca52abf86_03820797')) {function content_5f9f3ca52abf86_03820797($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?>
<article class="links-lista setas-centro">

  <div class="owl-carousel"
       data-owl-carousel
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="true"
       data-owl-autoplay-timeout="6000"
       data-owl-autoplay-hover-pause="true"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="true"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".links-lista .owl-dots"
       data-owl-nav-text="@icon:fas fa-chevron-left@--@icon:fas fa-chevron-right@"
  >
    <?php  $_smarty_tpl->tpl_vars['servico'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['servico']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['servicos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['servico']->key => $_smarty_tpl->tpl_vars['servico']->value){
$_smarty_tpl->tpl_vars['servico']->_loop = true;
?>
    <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['servico']->value->Imagens,'Campo_sel','==','Icone_inicio_ico'), null, 0);?>
    <?php if (!$_smarty_tpl->tpl_vars['icone']->value){?>
    <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['servico']->value->Imagens,'Campo_sel','==','Imagens_ico'), null, 0);?>
    <?php }?>
    <div class="col-link mb-0 mb-md-40 item">
      <a
        href="javascript:void(0)"
        data-toggle="modal" data-target="#servico-modal"
        class="link-item d-block text-center pl-30 pr-30 br-1 pt-30 fill-height"
        data-id="<?php echo $_smarty_tpl->tpl_vars['servico']->value->Id_int;?>
"
      >
        <div class="column fill-height">

          <div class="col-lg-auto">
            <div class="aspect aspect-1-1 mb-20 br-100 overflow-hidden mx-auto" style="width: 124px">
              <figure class="imagem aspect-item bg-body-light">
                <?php if ($_smarty_tpl->tpl_vars['icone']->value[0]){?>
                <img class="img-fit" alt="<?php echo $_smarty_tpl->tpl_vars['servico']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value[0]->Caminho_txf;?>
"/>
                <?php }else{ ?>
                <img class="img-fit" alt="<?php echo $_smarty_tpl->tpl_vars['servico']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"/>
                <?php }?>
              </figure>
            </div>
          </div>

          <div class="col-lg-auto">
            <div class="fz-20 fw-700 lh-12 text-primary" data-clamp="2">
              <?php echo corta_texto($_smarty_tpl->tpl_vars['servico']->value->Nome_tit,80);?>

            </div>
          </div>

          <div class="col-lg">
            <?php if ($_smarty_tpl->tpl_vars['servico']->value->Texto_txa){?>
            <div class="texto fz-16 mt-10 text-body-primary lh-15 align-center" data-clamp="3">
              <?php echo corta_texto($_smarty_tpl->tpl_vars['servico']->value->Texto_txa,200);?>

            </div>
            <?php }?>
          </div>

          <div class="col-lg-auto">
            <div class="botao mt-20 pl-20 pr-20 pl-md-70 pr-md-70">
              <div class="d-block text-body-primary text-primary-hover ff-secondary fz-16 fw-600">
                Ver mais
              </div>
            </div>
          </div>

        </div>

      </a>
    </div>
    <?php } ?>
  </div>

  <div class="rounded-dots d-block text-center mt-50">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
<?php }?>
<script>window.servicos = <?php echo json_encode($_smarty_tpl->tpl_vars['servicos']->value);?>
;</script>
<?php }} ?>