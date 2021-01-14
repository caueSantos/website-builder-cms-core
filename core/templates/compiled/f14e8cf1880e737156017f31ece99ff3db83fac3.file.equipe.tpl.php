<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:00:14
         compiled from "core\templates\producao\zehimoveis\site\blocos\sobre\equipe.tpl" */ ?>
<?php /*%%SmartyHeaderCode:298365fa645fe7ae250-51939260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f14e8cf1880e737156017f31ece99ff3db83fac3' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\sobre\\equipe.tpl',
      1 => 1604732412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '298365fa645fe7ae250-51939260',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'equipe' => 0,
    'titulos' => 0,
    'pessoa' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa645fe7ec9a4_84494001',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa645fe7ec9a4_84494001')) {function content_5fa645fe7ec9a4_84494001($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['equipe']->value[0]){?>
<section id="equipe" class="pt-50 pt-md-120">

  <div class="container">

    <div class="title-group">
      <h1 class="title text-body-quaternary fz-48 fw-700 lh-12">
        <?php echo titulo('sobre_interna_equipe','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </h1>
      <?php if (titulo('sobre_interna_equipe','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
      <div class="texto lh-2 fz-16 fw-400">
        <?php echo titulo('sobre_interna_equipe','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

      </div>
      <?php }?>
    </div>

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
        <div class="col-equipe col-6 col-md-3 mb-0 mb-md-40 item">

          <article class="colaborador hover hover-opacity">

            <div class="imagem">
              <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['pessoa']->value->Imagens[0], null, 0);?>
              <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('1-1', null, 0);?>
              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

              <div class="equipe-redes">

                <?php if ($_smarty_tpl->tpl_vars['pessoa']->value->Facebook_txf){?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Facebook_txf;?>
" target="_blank"
                   class="d-inline-block va-middle fz-16 lh-0 text-primary-hover"
                   style="color: #1877F2"
                >
                  <i class="fab fa-facebook-square"></i>
                </a>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['pessoa']->value->Linkedin_txf){?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Linkedin_txf;?>
" target="_blank"
                   class="d-inline-block va-middle fz-16 lh-0 text-primary-hover pl-10"
                   style="color: #2977C9"
                >
                  <i class="fab fa-linkedin-in"></i>
                </a>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['pessoa']->value->Whatsapp_txf){?>
                <a href="https://api.whatsapp.com/send?phone=<?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Whatsapp_txf;?>
" target="_blank"
                   class="d-inline-block va-middle fz-16 lh-0 text-primary-hover pl-10"
                   style="color: #4CED69"
                >
                  <i class="fab fa-whatsapp"></i>
                </a>
                <?php }?>

              </div>
            </div>

            <div class="txt">

              <div class="title lh-12 nome fz-18 fw-700 text-body-quaternary mt-25">
                <?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Nome_txf;?>

              </div>

              <div class="cargo mt-5"><?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Cargo_txf;?>
</div>

              <div class="contatos mt-15">
                <?php if ($_smarty_tpl->tpl_vars['pessoa']->value->Email_txf){?>
                <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Email_txf;?>
"
                   class="d-inline-block va-middle email fz-24 lh-0 text-primary-hover"
                   style="color: #C4C4D7"
                >
                  <i class="far fa-envelope"></i>
                </a>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['pessoa']->value->Telefone_txf){?>
                <a href="tel:<?php echo $_smarty_tpl->tpl_vars['pessoa']->value->Telefone_txf;?>
"
                   class="d-inline-block va-middle email fz-20 pl-10 lh-0 text-primary-hover"
                   style="color: #C4C4D7"
                >
                  <i class="far fa-phone-alt"></i>
                </a>
                <?php }?>
              </div>

            </div>

          </article>

        </div>
        <?php } ?>

      </div>

      <div class="rounded-dots d-block d-md-none text-center mt-30">
        <div class="owl-dots fz-18"></div>
      </div>
    </div>

  </div>

</section>
<?php }?>
<?php }} ?>