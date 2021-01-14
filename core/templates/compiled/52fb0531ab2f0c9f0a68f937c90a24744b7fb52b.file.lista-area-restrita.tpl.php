<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\global\lista-area-restrita.tpl" */ ?>
<?php /*%%SmartyHeaderCode:229995f84b948636297-55931257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52fb0531ab2f0c9f0a68f937c90a24744b7fb52b' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\lista-area-restrita.tpl',
      1 => 1599980729,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '229995f84b948636297-55931257',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'area_restrita_items' => 0,
    'item' => 0,
    'icone' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b948661529_89006993',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b948661529_89006993')) {function content_5f84b948661529_89006993($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['area_restrita_items']->value[0]){?>
<article class="area-restrita-lista">

  <div class="row owl-carousel owl-responsive justify-content-md-center"
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="false"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".area-restrita-lista .owl-dots"
  >

    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['area_restrita_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>

    <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['item']->value->Imagens,'Campo_sel','==','Icone_inicio_ico'), null, 0);?>

    <div class="col-link col col-2-dot-4 mb-0 mb-md-40 item">
      <div class="bg-primary hover hover-translate-up fill-height br-1 text-center">
        <a
          href="<?php echo $_smarty_tpl->tpl_vars['item']->value->Link_txf;?>
"
          target="_blank"
          class="item-restrita text-white d-block pl-15 pr-15 pt-30 pb-30 fill-height"
        >

          <figure class="imagem" style="height: 60px">
            <?php if ($_smarty_tpl->tpl_vars['icone']->value[0]){?>
            <img alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value[0]->Caminho_txf;?>
"/>
            <?php }else{ ?>
            <img alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->Nome_txf;?>
" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"/>
            <?php }?>
          </figure>

          <div class="title fz-18 fw-500 lh-12 mt-20">
            <?php echo $_smarty_tpl->tpl_vars['item']->value->Nome_txf;?>

          </div>

          <?php if ($_smarty_tpl->tpl_vars['item']->value->Texto_txa){?>
          <div class="texto fz-14 mt-10 lh-15" data-clamp="3">
            <?php echo corta_texto($_smarty_tpl->tpl_vars['item']->value->Texto_txa,200);?>

          </div>
          <?php }?>

        </a>
      </div>
    </div>

    <?php } ?>

  </div>

  <div class="rounded-dots d-block d-md-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
<?php }?>

<?php }} ?>