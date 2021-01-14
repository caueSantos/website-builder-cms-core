<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:54:32
         compiled from "core\templates\producao\abseg\site\blocos\solucoes\solucoes-lista-carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:282385f53dee8e04985-70987679%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c97f7ef351e6aafbbf82632d3fb25785f11afd9' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\solucoes\\solucoes-lista-carousel.tpl',
      1 => 1599134818,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '282385f53dee8e04985-70987679',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes' => 0,
    'solucao' => 0,
    'app' => 0,
    'icone' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53dee8f317a3_45825520',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53dee8f317a3_45825520')) {function content_5f53dee8f317a3_45825520($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['solucoes']->value[0]){?>
<article class="links-lista">

  <div class="row owl-carousel owl-responsive justify-content-md-center"
       data-owl-items="4"
       data-rwd="1-2-4"
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
    <?php  $_smarty_tpl->tpl_vars['solucao'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['solucao']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['solucao']->key => $_smarty_tpl->tpl_vars['solucao']->value){
$_smarty_tpl->tpl_vars['solucao']->_loop = true;
?>
    <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['solucao']->value->Imagens,'Campo_sel','==','Icone_inicio_ico'), null, 0);?>
    <div class="col-link col-6 col-md-3 mb-0 mb-md-40 item">
      <a
        href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
solucoes/<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_url;?>
"
        class="link-item d-block text-center pl-30 pr-30 br-1 pt-50 fill-height"
      >
        <figure class="imagem mb-30">
          <?php if ($_smarty_tpl->tpl_vars['icone']->value[0]){?>
          <img alt="<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value[0]->Caminho_txf;?>
"/>
          <?php }else{ ?>
          <img alt="<?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"/>
          <?php }?>
        </figure>
        <div class="title fz-18 fw-700 lh-12"><?php echo $_smarty_tpl->tpl_vars['solucao']->value->Nome_tit;?>
</div>
        <?php if ($_smarty_tpl->tpl_vars['solucao']->value->Texto_txa){?>
        <div class="texto fz-14 mt-10 text-body-primary lh-15" data-clamp="3">
          <?php echo corta_texto($_smarty_tpl->tpl_vars['solucao']->value->Texto_txa,200);?>

        </div>
        <?php }?>
        <div class="botao mt-20 pl-20 pr-20 pl-md-70 pr-md-70">
          <div target="_blank" class="br-1 btn-lands btn-sm d-block">Acessar</div>
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