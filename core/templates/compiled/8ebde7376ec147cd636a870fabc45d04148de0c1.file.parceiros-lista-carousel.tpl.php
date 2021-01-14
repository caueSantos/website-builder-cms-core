<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:49
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\parceiros\parceiros-lista-carousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:220105f90ff7d695d93-39935816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ebde7376ec147cd636a870fabc45d04148de0c1' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\parceiros\\parceiros-lista-carousel.tpl',
      1 => 1603325649,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '220105f90ff7d695d93-39935816',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'parceiros' => 0,
    'parceiro' => 0,
    'icone' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff7d6c8547_70408635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7d6c8547_70408635')) {function content_5f90ff7d6c8547_70408635($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['parceiros']->value[0]){?>
<article class="parceiros-links-lista setas-centro">

  <div class="owl-carousel"
       data-owl-carousel
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="false"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="true"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".parceiros-links-lista .owl-dots"
       data-owl-nav-text="@icon:fas fa-chevron-left@--@icon:fas fa-chevron-right@"
  >
    <?php  $_smarty_tpl->tpl_vars['parceiro'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['parceiro']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['parceiros']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['parceiro']->key => $_smarty_tpl->tpl_vars['parceiro']->value){
$_smarty_tpl->tpl_vars['parceiro']->_loop = true;
?>
    <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable($_smarty_tpl->tpl_vars['parceiro']->value->Imagens[0], null, 0);?>
    <div class="col-link mb-0 item pb-10 fill-height">
      <div
        class="link-item d-block text-center pl-30 pr-30 br-1 pt-30 pb-30 fill-height bg-body-light-hover tn-ease"
        style="box-shadow: 0px 0px 1px rgba(40, 41, 61, 0.04), 0px 2px 4px rgba(96, 97, 112, 0.16);"
      >

        <div class="mb-20 mx-auto" style="height: 60px">
          <figure class="imagem" style="height: 60px">
            <?php if ($_smarty_tpl->tpl_vars['icone']->value){?>
            <img style="height: auto; max-height: 60px; width: auto; max-width: 100%;"
                 alt="<?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value->Caminho_txf;?>
"
                 class="align-center"/>
            <?php }else{ ?>
            <img style="height: auto; max-height: 60px; width: auto; max-width: 100%;"
                 class="align-center"
                 alt="<?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"/>
            <?php }?>
          </figure>
        </div>

        <div class="fz-20 fw-700 lh-12" data-clamp="2">
          <?php echo corta_texto($_smarty_tpl->tpl_vars['parceiro']->value->Nome_txf,80);?>

        </div>

        <?php if ($_smarty_tpl->tpl_vars['parceiro']->value->Endereco_txa){?>
        <div class="texto fz-14 mt-10 text-body-primary lh-15">
          <?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Endereco_txa;?>

        </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['parceiro']->value->Telefones_txa){?>
        <div class="texto fz-16 mt-10 text-body-primary lh-15">
          <?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Telefones_txa;?>

        </div>
        <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['parceiro']->value->Link_site_txf&&is_url($_smarty_tpl->tpl_vars['parceiro']->value->Link_site_txf)){?>
        <div class="botao fz-16 mt-20 pl-20 pr-20">
          <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['parceiro']->value->Link_site_txf;?>
"
             class="d-block ff-secondary fz-16 fw-600 text-body-primary text-primary-hover">
            Visitar o site >>
          </a>
        </div>
        <?php }?>

      </div>
    </div>
    <?php } ?>
  </div>

  <div class="rounded-dots d-block text-center mt-50">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
<?php }?>
<?php }} ?>