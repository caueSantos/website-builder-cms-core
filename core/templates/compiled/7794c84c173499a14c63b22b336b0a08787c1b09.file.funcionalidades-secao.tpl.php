<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:44
         compiled from "core\templates\producao\hubvet\site\blocos\inicio\funcionalidades-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1841601b7f04a65628-71769300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7794c84c173499a14c63b22b336b0a08787c1b09' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\inicio\\funcionalidades-secao.tpl',
      1 => 1609723107,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1841601b7f04a65628-71769300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'funcionalidades' => 0,
    'assets' => 0,
    'titulos' => 0,
    'func' => 0,
    'painel' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7f04a97cd2_10760111',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7f04a97cd2_10760111')) {function content_601b7f04a97cd2_10760111($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['funcionalidades']->value[0]){?>
<section class="funcionalidades pt-40 pt-md-70 pb-md-110 pb-80">

  <div class="container">

    <div class="title-group text-center">
      <div class="icone">
        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/icone-titulo.png" class="pe-none"/>
      </div>
      <h1 class="title fz-40 text-primary lh-12 fw-400">
        <?php echo titulo('funcionalidades_inicio','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </h1>
      <?php if (titulo('funcionalidades_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
      <div class="texto text-body-secondary fz-18 mt-5 lh-15">
        <?php echo titulo('funcionalidades_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </div>
      <?php }?>
    </div>

    <div class="row mt-50">

      <div class="carousel-wrap">
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

    </div>

    <div class="botao mt-20 text-center">
      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
funcionalidades" target="_blank" class="btn-lands btn-primary text-white">
        <?php echo trans('funcionalidades_inicio_botao');?>

      </a>
    </div>

  </div>

</section>
<?php }?>
<?php }} ?>