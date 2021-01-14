<?php /* Smarty version Smarty-3.1.12, created on 2020-12-10 21:33:29
         compiled from "core\templates\producao\zehimoveis\site\componentes\galeria-mista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155835fd2b0492759a1-38191150%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a00cd5668c6fdfb3f12bce19c097d49c7620004f' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\componentes\\galeria-mista.tpl',
      1 => 1605238305,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155835fd2b0492759a1-38191150',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imagens' => 0,
    'principal' => 0,
    'videos' => 0,
    'destaque' => 0,
    'midia' => 0,
    'id' => 0,
    'imovel' => 0,
    'CAMINHO_TPL' => 0,
    'painel' => 0,
    'm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2b0493034a3_83335917',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2b0493034a3_83335917')) {function content_5fd2b0493034a3_83335917($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable((('galeria-mista-').(rand())).(rand()), null, 0);?>

<?php $_smarty_tpl->tpl_vars['principal'] = new Smarty_variable($_smarty_tpl->tpl_vars['imagens']->value[0], null, 0);?>
<?php $_smarty_tpl->createLocalArrayVariable('imagens', null, 0);
$_smarty_tpl->tpl_vars['imagens']->value[0] = null;?>
<?php $_smarty_tpl->tpl_vars['imagens'] = new Smarty_variable(array_filter($_smarty_tpl->tpl_vars['imagens']->value), null, 0);?>

<?php if (!$_smarty_tpl->tpl_vars['principal']->value){?>
<?php $_smarty_tpl->tpl_vars['principal'] = new Smarty_variable($_smarty_tpl->tpl_vars['videos']->value[0], null, 0);?>
<?php $_smarty_tpl->createLocalArrayVariable('videos', null, 0);
$_smarty_tpl->tpl_vars['videos']->value[0] = null;?>
<?php $_smarty_tpl->tpl_vars['videos'] = new Smarty_variable(array_filter($_smarty_tpl->tpl_vars['videos']->value), null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars['destaque'] = new Smarty_variable($_smarty_tpl->tpl_vars['videos']->value[0], null, 0);?>
<?php $_smarty_tpl->createLocalArrayVariable('videos', null, 0);
$_smarty_tpl->tpl_vars['videos']->value[0] = null;?>
<?php $_smarty_tpl->tpl_vars['videos'] = new Smarty_variable(array_filter($_smarty_tpl->tpl_vars['videos']->value), null, 0);?>

<?php if (!$_smarty_tpl->tpl_vars['destaque']->value){?>
<?php $_smarty_tpl->tpl_vars['destaque'] = new Smarty_variable($_smarty_tpl->tpl_vars['imagens']->value[1], null, 0);?>
<?php $_smarty_tpl->createLocalArrayVariable('imagens', null, 0);
$_smarty_tpl->tpl_vars['imagens']->value[1] = null;?>
<?php $_smarty_tpl->tpl_vars['imagens'] = new Smarty_variable(array_filter($_smarty_tpl->tpl_vars['imagens']->value), null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars['midia'] = new Smarty_variable(array_merge($_smarty_tpl->tpl_vars['imagens']->value,$_smarty_tpl->tpl_vars['videos']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars['a'] = new Smarty_variable(shuffle($_smarty_tpl->tpl_vars['midia']->value), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['midia']->value||$_smarty_tpl->tpl_vars['principal']->value){?>
<div class="container-fluid pr-0 pl-0 galeria-mista" id="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">

  <div class="row no-gutters">

    <div class="<?php if ($_smarty_tpl->tpl_vars['midia']->value){?>col-lg-8 col-xga-9 pr-lg-15<?php }else{ ?>col-12<?php }?>">

      <div class="define-tamanho bg-body-light fill-height <?php if ($_smarty_tpl->tpl_vars['midia']->value){?>br-2<?php }?> overflow-hidden pl-20"
           style="height: 648px; margin-left: -20px">

        <?php if ($_smarty_tpl->tpl_vars['principal']->value->Id_video_con){?>
        <a
          id="destaque-principal"
          class="d-block disable-fancybox-trigger abre-galeria _video hover hover-opacity fill-height"
          href="https://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['principal']->value->Endereco_txf;?>
"
          data-fancybox="galeria-imovel<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Id_int;?>
"
        >
          <figure class="video fill-height">
            <img class="img-fit" src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['principal']->value->Endereco_txf;?>
/hqdefault.jpg"/>
          </figure>
          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/video-overlay.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

        </a>
        <?php }elseif($_smarty_tpl->tpl_vars['principal']->value->Id_imagem_con){?>
        <a
          id="destaque-principal"
          class="d-block disable-fancybox-trigger _imagem abre-galeria hover hover-opacity fill-height"
          href="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['principal']->value->Caminho_txf;?>
"
          data-fancybox="galeria-imovel<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Id_int;?>
"
        >
          <figure class="imagem-principal fill-height">
            <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['principal']->value->Caminho_txf;?>
"/>
          </figure>
        </a>
        <?php }?>

        <div id="destaque-load-overlay" class="bg-fake bg-white text-center" style="opacity: 0.8; display: none;">
          <div class="inner align-center">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
          </div>
        </div>

      </div>

    </div>

    <?php if ($_smarty_tpl->tpl_vars['midia']->value){?>
    <div class="col-lg-4 col-xga-3 pr-lg-20">

      <div class="pr-lg-10 define-tamanho-2" style="height: 648px; overflow-y: auto">

        <div class="row owl-carousel owl-responsive justify-content-lg-center mx-lg-0"
             data-owl-items="4"
             data-rwd="1-2-4"
             data-owl-loop="true"
             data-owl-autoplay="true"
             data-owl-autoplay-timeout="6000"
             data-owl-margin="30"
             data-owl-dots="true"
             data-owl-nav="false"
             data-owl-slide-by="1"
             data-owl-dots-each="1"
             data-owl-dots-container="#<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
 .owl-dots"
        >

          <?php if ($_smarty_tpl->tpl_vars['destaque']->value){?>
          <div class="col-lg-12 item pl-10 pr-10 pt-20 pt-lg-0">
            <div class="bg-body-light br-2 overflow-hidden item-galeria" style="height: 260px">
              <?php if ($_smarty_tpl->tpl_vars['destaque']->value->Id_video_con){?>
              <a
                class="d-block disable-fancybox-trigger abre-galeria hover hover-opacity fill-height"
                href="https://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['destaque']->value->Endereco_txf;?>
"
                data-fancybox="galeria-imovel<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Id_int;?>
"
              >
                <figure class="video fill-height">
                  <img class="img-fit" src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['destaque']->value->Endereco_txf;?>
/mqdefault.jpg"/>
                </figure>
                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/video-overlay.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

              </a>
              <?php }elseif($_smarty_tpl->tpl_vars['destaque']->value->Id_imagem_con){?>
              <a
                class="d-block disable-fancybox-trigger troca-destaque hover hover-opacity fill-height"
                href="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['destaque']->value->Caminho_txf;?>
"
                data-fancybox="galeria-imovel<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Id_int;?>
"
              >
                <figure class="imagem fill-height">
                  <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['destaque']->value->Caminho_txf;?>
"/>
                </figure>
              </a>
              <?php }?>
            </div>
          </div>
          <?php }?>

          <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['midia']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value){
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
          <div class="col-lg-6 item pl-10 pr-10 pt-20">
            <div style="height: 174px" class="bg-body-light br-2 overflow-hidden item-galeria">
              <?php if ($_smarty_tpl->tpl_vars['m']->value->Id_video_con){?>
              <a
                class="d-block disable-fancybox-trigger abre-galeria hover hover-opacity fill-height"
                href="https://www.youtube.com/embed/<?php echo $_smarty_tpl->tpl_vars['m']->value->Endereco_txf;?>
"
                data-fancybox="galeria-imovel<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Id_int;?>
"
              >
                <figure class="video fill-height">
                  <img class="img-fit" src="http://img.youtube.com/vi/<?php echo $_smarty_tpl->tpl_vars['m']->value->Endereco_txf;?>
/mqdefault.jpg"/>
                </figure>
                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/video-overlay.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

              </a>
              <?php }elseif($_smarty_tpl->tpl_vars['m']->value->Id_imagem_con){?>
              <a
                class="d-block disable-fancybox-trigger troca-destaque hover hover-opacity fill-height"
                href="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['m']->value->Caminho_txf;?>
"
                data-fancybox="galeria-imovel<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Id_int;?>
"
              >
                <figure class="imagem fill-height">
                  <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['m']->value->Caminho_txf;?>
"/>
                </figure>
              </a>
              <?php }?>
            </div>
          </div>
          <?php } ?>

        </div>

      </div>

    </div>
    <?php }?>

  </div>

  <div class="rounded-dots d-block dmd-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</div>
<?php }?>
<?php }} ?>