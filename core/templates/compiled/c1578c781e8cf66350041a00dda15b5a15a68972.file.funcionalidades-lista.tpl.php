<?php /* Smarty version Smarty-3.1.12, created on 2021-01-10 23:30:22
         compiled from "core\templates\producao\hubvet\site\blocos\funcionalidades\funcionalidades-lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10795ffbaa2e6ea694-56579575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1578c781e8cf66350041a00dda15b5a15a68972' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\funcionalidades\\funcionalidades-lista.tpl',
      1 => 1610305432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10795ffbaa2e6ea694-56579575',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'funcionalidades' => 0,
    'func' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffbaa2e70f137_40838235',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffbaa2e70f137_40838235')) {function content_5ffbaa2e70f137_40838235($_smarty_tpl) {?><div class="carousel-wrap">
  <div class="row owl-carousel owl-responsive"
       data-owl-items="4"
       data-rwd="2-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="false"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="0"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".area-restrita-lista .owl-dots"
  >

    <?php  $_smarty_tpl->tpl_vars['func'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['func']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['funcionalidades']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['func']->key => $_smarty_tpl->tpl_vars['func']->value){
$_smarty_tpl->tpl_vars['func']->_loop = true;
?>

    <div class="col-md-4 mb-30 fill-height-sm">
      <div class="funcionalidade fill-height hover hover-shadow">
        <div class="align-center text-center pl-20 pl-md-50 pr-20 pr-md-50 pb-20 pt-20 pb-md-50 pt-md-50">
          <?php if ($_smarty_tpl->tpl_vars['func']->value->Imagens[0]){?>
          <figure class="imagem">
            <img src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['func']->value->Imagens[0]->Caminho_txf;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['func']->value->Titulo_txf;?>
"/>
          </figure>
          <?php }?>
          <div class="title fz-16 fw-700 mt-15">
            <?php echo $_smarty_tpl->tpl_vars['func']->value->Titulo_txf;?>

          </div>
          <div class="title fz-48 fw-700 text-primary">
            <?php echo $_smarty_tpl->tpl_vars['func']->value->Numero_txf;?>

          </div>
          <?php if ($_smarty_tpl->tpl_vars['func']->value->Observacao_txf){?>
          <div class="fz-12 fw-400">
            <?php echo $_smarty_tpl->tpl_vars['func']->value->Observacao_txf;?>

          </div>
          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['func']->value->Descricao_txa){?>
          <div class="texto lh-15 mt-20">
            <?php echo $_smarty_tpl->tpl_vars['func']->value->Descricao_txa;?>

          </div>
          <?php }?>
        </div>
      </div>
    </div>

    <?php } ?>

  </div>
</div>
<?php }} ?>