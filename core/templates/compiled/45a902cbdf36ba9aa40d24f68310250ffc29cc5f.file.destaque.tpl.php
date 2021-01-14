<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 02:23:12
         compiled from "core\templates\producao\hubvet\site\blocos\cases\destaque.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92305ffd2430d410f2-87064294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45a902cbdf36ba9aa40d24f68310250ffc29cc5f' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\destaque.tpl',
      1 => 1610422540,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92305ffd2430d410f2-87064294',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'case_destaque' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd2430d74773_92540637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd2430d74773_92540637')) {function content_5ffd2430d74773_92540637($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['case_destaque']->value[0]){?>
<section class="cases-destaque pt-40 pt-md-70 pb-40">

  <div class="container">

    <a
      href="<?php echo gera_link(('cases/').($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Nome_url),true);?>
"
      class="d-block text-body-primary hover hover-opacity"
    >
      <div class="row">

        <div class="col-md-7">

          <figure class="imagem">
            <?php if ($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Imagens[0]){?>
            <img
              src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['case_destaque']->value[0]->Imagens[0]->Caminho_txf;?>
"
              alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Nome_tit);?>
"
              title="<?php echo strip_tags($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Nome_tit);?>
"
              class="img-fit pe-none"
            />
            <?php }else{ ?>
            <img
              src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"
              alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Nome_tit);?>
"
              title="<?php echo strip_tags($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Nome_tit);?>
"
              class="img-fit pe-none"
            />
            <?php }?>
          </figure>

        </div>

        <div class="col-md-5">

          <div class="align-center">

            <h1 class="title fz-26 lh-12 fw-700">
              <?php echo $_smarty_tpl->tpl_vars['case_destaque']->value[0]->Texto_principal_txa;?>

            </h1>

            <?php if ($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Texto_secundario_txa){?>
            <div class="texto fz-16 lh-15 mt-25">
              <?php echo corta_texto($_smarty_tpl->tpl_vars['case_destaque']->value[0]->Texto_secundario_txa,200,'...');?>

            </div>
            <?php }?>

            <div class="botao mt-25">
              <div
                class="fz-16 fw-700 text-primary"
              >
                <?php echo trans('leia_mais');?>
...
              </div>
            </div>

          </div>

        </div>

      </div>
    </a>

  </div>

</section>
<?php }?>
<?php }} ?>