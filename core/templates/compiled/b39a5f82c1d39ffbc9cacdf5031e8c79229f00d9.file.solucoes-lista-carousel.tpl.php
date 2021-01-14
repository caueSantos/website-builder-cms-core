<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\solucoes\solucoes-lista-carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:254575f84b9484545e3-19877196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b39a5f82c1d39ffbc9cacdf5031e8c79229f00d9' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\solucoes\\solucoes-lista-carousel.tpl',
      1 => 1600361422,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '254575f84b9484545e3-19877196',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'servicos' => 0,
    'servico' => 0,
    'icone' => 0,
    'app' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b94848d622_25081915',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b94848d622_25081915')) {function content_5f84b94848d622_25081915($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['servicos']->value[0]){?>
<article class="links-lista">

  <div class="row owl-carousel owl-responsive justify-content-md-center"
       data-owl-items="1"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="false"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".links-lista .owl-dots"
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
    <div class="col-link col-6 col-md-3 mb-0 mb-md-40 item">
      <a
        href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
servicos/<?php echo $_smarty_tpl->tpl_vars['servico']->value->Nome_url;?>
"
        class="link-item d-block text-center pl-30 pr-30 br-1 pt-40 fill-height"
      >
        <div class="aspect aspect-1-1 mb-30 br-100 overflow-hidden mx-auto" style="width: 124px">
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
        <div class="title fz-16 fw-700 lh-12"><?php echo $_smarty_tpl->tpl_vars['servico']->value->Nome_tit;?>
</div>
        <?php if ($_smarty_tpl->tpl_vars['servico']->value->Texto_txa){?>
        <div class="texto fz-12 mt-10 text-body-primary lh-15" data-clamp="3">
          <?php echo corta_texto($_smarty_tpl->tpl_vars['servico']->value->Texto_txa,200);?>

        </div>
        <?php }?>
        <div class="botao mt-20 pl-20 pr-20 pl-md-70 pr-md-70">
          <div class="d-block ff-secondary fz-12 fw-600">
            Ver mais
          </div>
        </div>
      </a>
    </div>
    <?php } ?>
  </div>

  <div class="rounded-dots d-block d-md-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
<?php }?>
<?php }} ?>