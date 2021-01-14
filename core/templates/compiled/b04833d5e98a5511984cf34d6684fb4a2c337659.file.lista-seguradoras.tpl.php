<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 17:57:07
         compiled from "core\templates\producao\diagnostico\site\blocos\solucoes\lista-seguradoras.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56485f5e87a37e5361-79527269%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b04833d5e98a5511984cf34d6684fb4a2c337659' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\solucoes\\lista-seguradoras.tpl',
      1 => 1599136680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56485f5e87a37e5361-79527269',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'seguradoras' => 0,
    'seguradora' => 0,
    'icone' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5e87a3808d18_35630236',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5e87a3808d18_35630236')) {function content_5f5e87a3808d18_35630236($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['seguradoras']->value[0]){?>
<article class="seguradoras-carousel">

  <div class="row owl-carousel owl-responsive justify-content-md-center"
       data-owl-items="4"
       data-rwd="1-2-4"
       data-owl-loop="true"
       data-owl-autoplay="true"
       data-owl-autoplay-timeout="4000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".seguradoras-carousel .owl-dots"
  >
    <?php  $_smarty_tpl->tpl_vars['seguradora'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['seguradora']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['seguradoras']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['seguradora']->key => $_smarty_tpl->tpl_vars['seguradora']->value){
$_smarty_tpl->tpl_vars['seguradora']->_loop = true;
?>

    <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['seguradora']->value->Imagens,'Campo_sel','==','Imagens_ico'), null, 0);?>
    <?php if ($_smarty_tpl->tpl_vars['icone']->value[0]){?>
    <div class="col-seg col-6 col-md-3 mb-0 mb-md-40 item">

      <a
        href="<?php if (is_url($_smarty_tpl->tpl_vars['seguradora']->value->Link_txf)){?><?php echo $_smarty_tpl->tpl_vars['seguradora']->value->Link_txf;?>
<?php }else{ ?>javascript:void(0);<?php }?>"
        class="d-block text-center"
        title="<?php echo $_smarty_tpl->tpl_vars['seguradora']->value->Titulo_txf;?>
"
      >
        <figure class="imagem" style="height: 80px">
          <img class="align-center" style="max-height: 100%; width: auto; max-width: 100%" alt="<?php echo $_smarty_tpl->tpl_vars['seguradora']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value[0]->Caminho_txf;?>
"/>
        </figure>
      </a>

    </div>
    <?php }?>
    <?php } ?>
  </div>

  <div class="rounded-dots d-block d-md-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
<?php }?>
<?php }} ?>