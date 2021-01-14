<?php /* Smarty version Smarty-3.1.12, created on 2021-01-12 02:23:12
         compiled from "core\templates\producao\hubvet\site\blocos\cases\cases-lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:200155ffd2430d84660-99554853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '509de116c7e49f1be63e90271ef4d2e253752d70' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\cases\\cases-lista.tpl',
      1 => 1610424259,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200155ffd2430d84660-99554853',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'cases' => 0,
    'labels' => 0,
    'label' => 0,
    'case' => 0,
    'painel' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffd2430dc3563_49835191',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffd2430dc3563_49835191')) {function content_5ffd2430dc3563_49835191($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['cases']->value[0]){?>
<section class="cases-lista pt-40 pt-md-70 pb-40 pb-md-100">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-12">

        <div class="row">

          <div class="col-md">
            <div class="align-center fz-22 title fw-700">
              <?php echo trans('cases_encontre_historias');?>

            </div>
          </div>

          <div class="col-md-3">
            <div class="align-center">

              <select class="d-block custom-select cursor-pointer text-center">
                <option value="todos">
                  <?php echo trans('todos');?>

                </option>
                <?php  $_smarty_tpl->tpl_vars['label'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['label']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['labels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['label']->key => $_smarty_tpl->tpl_vars['label']->value){
$_smarty_tpl->tpl_vars['label']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['label']->value->Nome_url;?>
">
                  <?php echo $_smarty_tpl->tpl_vars['label']->value->Nome_tit;?>

                </option>
                <?php } ?>
              </select>

            </div>
          </div>

        </div>

        <div class="row mt-40">

          <?php  $_smarty_tpl->tpl_vars['case'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['case']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cases']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['case']->key => $_smarty_tpl->tpl_vars['case']->value){
$_smarty_tpl->tpl_vars['case']->_loop = true;
?>

          <a
            href="<?php echo gera_link(('cases/').($_smarty_tpl->tpl_vars['case']->value->Nome_url),true);?>
"
            class="col-12 col-md-3 text-body-secondary hover hover-scale-down hover-opacity"
          >

            <figure class="imagem">
              <?php if ($_smarty_tpl->tpl_vars['case']->value->Imagens[0]){?>
              <img
                src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['case']->value->Imagens[0]->Caminho_txf;?>
"
                alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['case']->value->Nome_tit);?>
"
                title="<?php echo strip_tags($_smarty_tpl->tpl_vars['case']->value->Nome_tit);?>
"
                class="img-fit pe-none"
              />
              <?php }else{ ?>
              <img
                src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel-quadrada.png"
                alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['case']->value->Nome_tit);?>
"
                title="<?php echo strip_tags($_smarty_tpl->tpl_vars['case']->value->Nome_tit);?>
"
                class="img-fit pe-none"
              />
              <?php }?>
            </figure>

            <div class="mt-20">

              <div class="title fz-16 text-primary lh-12 fw-700">
                <?php echo $_smarty_tpl->tpl_vars['case']->value->Nome_tit;?>

              </div>

              <?php if ($_smarty_tpl->tpl_vars['case']->value->Texto_secundario_txa){?>
              <div class="texto fz-14 lh-15 mt-10" data-clamp="3">
                <?php echo corta_texto($_smarty_tpl->tpl_vars['case']->value->Texto_secundario_txa,100,'...');?>

              </div>
              <?php }?>

            </div>

            <div class="botao mt-10">
              <div
                class="fz-14 fw-700 text-primary"
              >
                <?php echo trans('leia_mais');?>
...
              </div>
            </div>

          </a>

          <?php } ?>

        </div>

      </div>
    </div>
  </div>

</section>
<?php }?>
<?php }} ?>