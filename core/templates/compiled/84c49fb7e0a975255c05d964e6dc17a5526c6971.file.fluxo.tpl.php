<?php /* Smarty version Smarty-3.1.12, created on 2021-01-23 20:47:44
         compiled from "core\templates\producao\hubvet\site\blocos\funcionalidades\fluxo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4222600ca7901982b1-85840964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84c49fb7e0a975255c05d964e6dc17a5526c6971' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\funcionalidades\\fluxo.tpl',
      1 => 1610316592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4222600ca7901982b1-85840964',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'funcionalidades_fluxo' => 0,
    'assets' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600ca7901ddc96_30115316',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600ca7901ddc96_30115316')) {function content_600ca7901ddc96_30115316($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['funcionalidades_fluxo']->value[0]){?>
<?php $_smarty_tpl->tpl_vars['banner'] = new Smarty_variable($_smarty_tpl->tpl_vars['funcionalidades_fluxo']->value[0], null, 0);?>
<section class="solucoes_visao bg-primary text-white pt-40 pb-40 pt-md-80 pb-md-50">

  <div class="bg-fake">
    <div class="bg-parallax" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/bg-funcionalidades-fluxo.png"')">
    </div>
  </div>

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-8">

        <div class="<?php if (!$_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>text-center<?php }?> align-center">

          <h1 class="title fw-700 fz-34">
            <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_txf;?>

          </h1>

          <div class="texto lh-18 fz-16 mt-15">
            <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_txa;?>

          </div>

          <?php if (is_url($_smarty_tpl->tpl_vars['banner']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf){?>
          <div class="botao mt-40">
            <a target="_blank" class="btn-lands btn-accent" href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_link_txf;?>
">
              <?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf;?>

            </a>
          </div>
          <?php }?>

        </div>

      </div>

    </div>

  </div>

</section>
<?php }?>
<?php }} ?>