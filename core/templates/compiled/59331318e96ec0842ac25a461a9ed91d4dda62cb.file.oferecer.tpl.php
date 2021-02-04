<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:29
         compiled from "core\templates\producao\hubvet\site\blocos\solucoes\oferecer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30143601b7ef58e1d59-12644751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59331318e96ec0842ac25a461a9ed91d4dda62cb' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\solucoes\\oferecer.tpl',
      1 => 1610264862,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30143601b7ef58e1d59-12644751',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes_oferecer' => 0,
    'solucoes_oferecer_itens' => 0,
    'titulos' => 0,
    'oferecer' => 0,
    'key' => 0,
    'item' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7ef5942354_64933499',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7ef5942354_64933499')) {function content_601b7ef5942354_64933499($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['solucoes_oferecer']->value[0]){?>
<?php $_smarty_tpl->tpl_vars['solucoes_oferecer'] = new Smarty_variable(junta_registros($_smarty_tpl->tpl_vars['solucoes_oferecer']->value,'Nome_url',$_smarty_tpl->tpl_vars['solucoes_oferecer_itens']->value,'Solucao_oferecer_sel','Oferecer_itens'), null, 0);?>
<section class="solucoes-oferecer pt-40 pt-md-70 pb-md-90 pb-40 bg-body-lighter">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="title-group text-center">
          <h1 class="title fz-36 text-primary lh-12 fw-400">
            <?php echo titulo('solucoes_oferecer_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('solucoes_oferecer_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto text-body-primary fz-16 mt-10 lh-15">
            <?php echo titulo('solucoes_oferecer_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-30">

      <div class="col-12 col-md text-center">

        <div class="lands-tabs lands-tabs-2">

          <ul class="nav" role="tablist">
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['oferecer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['oferecer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes_oferecer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['oferecer']->key => $_smarty_tpl->tpl_vars['oferecer']->value){
$_smarty_tpl->tpl_vars['oferecer']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['oferecer']->value->Oferecer_itens[0]){?>
            <li class="nav-item">
              <a class="<?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
                 id="solucoes-oferecer-tab-<?php echo $_smarty_tpl->tpl_vars['oferecer']->value->Id_int;?>
"
                 data-toggle="tab"
                 href="#oferecer-<?php echo $_smarty_tpl->tpl_vars['oferecer']->value->Id_int;?>
"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                <?php echo $_smarty_tpl->tpl_vars['oferecer']->value->Nome_tit;?>

              </a>
            </li>
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
            <?php }?>
            <?php } ?>
          </ul>

        </div>

      </div>
    </div>

    <div class="row mt-60">

      <div class="col-12">

        <div class="tab-content">
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['oferecer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['oferecer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes_oferecer']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['oferecer']->key => $_smarty_tpl->tpl_vars['oferecer']->value){
$_smarty_tpl->tpl_vars['oferecer']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['oferecer']->value){?>
          <div
            class="tab-pane fade show <?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
            id="oferecer-<?php echo $_smarty_tpl->tpl_vars['oferecer']->value->Id_int;?>
"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <div class="row <?php if (!$_smarty_tpl->tpl_vars['oferecer']->value->Imagens[0]){?>justify-content-center text-center<?php }?>">

              <div class="col-12 col-md-5">

                <div class="align-center">
                  <div class="setas-centro marcador-bolinhas">
                    <div class="owl-carousel carousel-sobre-inicio"
                         data-owl-carousel
                         data-owl-items="1"
                         data-rwd="1-1-1"
                         data-owl-loop="true"
                         data-owl-autoplay="true"
                         data-owl-autoplay-timeout="8000"
                         data-owl-margin="0"
                         data-owl-dots="true"
                         data-owl-nav="false"
                    >
                      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['oferecer']->value->Oferecer_itens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                      <div class="item">
                        <div class="title text-primary fz-24 fw-700 lh-12">
                          <?php echo $_smarty_tpl->tpl_vars['item']->value->Titulo_txf;?>

                        </div>
                        <div class="texto fz-14 mt-20">
                          <?php echo $_smarty_tpl->tpl_vars['item']->value->Texto_txa;?>

                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>

              </div>

              <?php if ($_smarty_tpl->tpl_vars['oferecer']->value->Imagens[0]){?>
              <div class="col-12 col-md-7">
                <div class="align-center">
                  <img
                    class="img-fluid mx-auto d-block"
                    src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['oferecer']->value->Imagens[0]->Caminho_txf;?>
"
                    alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['oferecer']->value->Nome_tit);?>
"
                    title="<?php echo strip_tags($_smarty_tpl->tpl_vars['oferecer']->value->Nome_tit);?>
"
                  />
                </div>
              </div>
              <?php }?>

            </div>

          </div>
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
          <?php }?>
          <?php } ?>
        </div>

      </div>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>