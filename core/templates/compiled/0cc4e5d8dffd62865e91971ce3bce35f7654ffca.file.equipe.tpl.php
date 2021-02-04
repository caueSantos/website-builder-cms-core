<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:39
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\equipe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96601b6357e83e80-16303000%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cc4e5d8dffd62865e91971ce3bce35f7654ffca' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\equipe.tpl',
      1 => 1612156473,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96601b6357e83e80-16303000',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'equipe' => 0,
    'titulos' => 0,
    'pessoa' => 0,
    'CAMINHO_TPL' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6357ea8240_62693520',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6357ea8240_62693520')) {function content_601b6357ea8240_62693520($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['equipe']->value[0]){?>
<section id="equipe" class="pt-50">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="title-group text-center">
          <h1 class="title fz-36 text-primary fw-400 lh-12">
            <?php echo titulo('sobre_interna_equipe','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('sobre_interna_equipe','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto lh-2 fz-16 fw-400">
            <?php echo titulo('sobre_interna_equipe','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>

      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="mt-45">

          <div class="row owl-carousel owl-responsive"
               data-owl-items="4"
               data-rwd="1-2-4"
               data-owl-loop="true"
               data-owl-autoplay="true"
               data-owl-autoplay-timeout="8000"
               data-owl-margin="30"
               data-owl-dots="true"
               data-owl-nav="false"
               data-owl-slide-by="1"
               data-owl-dots-each="1"
               data-owl-dots-container="#equipe .owl-dots"
          >

            <?php  $_smarty_tpl->tpl_vars['pessoa'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pessoa']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['equipe']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pessoa']->key => $_smarty_tpl->tpl_vars['pessoa']->value){
$_smarty_tpl->tpl_vars['pessoa']->_loop = true;
?>
            <div class="col-equipe col-6 col-lg-4 mb-0 mb-lg-40 item">

              <article class="colaborador hover hover-opacity">

                <div class="imagem">
                  <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['pessoa']->value->Imagens[0], null, 0);?>
                  <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('1-1', null, 0);?>
                  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                  <div
                    class="bg-fake img-drop"
                    style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
');"
                  ></div>
                </div>

                <div class="txt">

                  <div class="title lh-12 nome fz-22 fw-700 text-body-quaternary mt-25">
                    <?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Nome_txf;?>

                  </div>

                  <div class="cargo mt-5 fz-14">
                    <?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Cargo_txf;?>

                  </div>

                </div>

              </article>

            </div>
            <?php } ?>

          </div>

          <div class="rounded-dots d-block d-lg-none text-center mt-30">
            <div class="owl-dots fz-18"></div>
          </div>

        </div>
      </div>
    </div>

  </div>

</section>
<?php }?>
<?php }} ?>