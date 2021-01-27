<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:05:46
         compiled from "core\templates\producao\hubvet\site\blocos\solucoes\controle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23385600fa32aeb7c26-24464168%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f46cd7c0561c0a68d5b92276025b2388f21c654d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\solucoes\\controle.tpl',
      1 => 1610261169,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23385600fa32aeb7c26-24464168',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes_controle' => 0,
    'controle' => 0,
    'key' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa32af04554_39425663',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa32af04554_39425663')) {function content_600fa32af04554_39425663($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['solucoes_controle']->value[0]){?>
<section class="solucoes-controle pt-40 pt-md-90 pb-md-80 pb-40">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-12 col-md-auto">
        <div class="align-center">
          <h1 class="title text-primary fz-32">
            <?php echo trans('solucoes_controle_titulo');?>

          </h1>
        </div>
      </div>

      <div class="col-12 col-md">

        <div class="lands-tabs">

          <ul class="nav nav-fill" role="tablist">
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
            <?php  $_smarty_tpl->tpl_vars['controle'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['controle']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes_controle']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['controle']->key => $_smarty_tpl->tpl_vars['controle']->value){
$_smarty_tpl->tpl_vars['controle']->_loop = true;
?>
            <?php if ($_smarty_tpl->tpl_vars['controle']->value){?>
            <li class="nav-item">
              <a class="<?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
                 id="solucoes-tab-<?php echo $_smarty_tpl->tpl_vars['controle']->value->Id_int;?>
"
                 data-toggle="tab"
                 href="#controle-<?php echo $_smarty_tpl->tpl_vars['controle']->value->Id_int;?>
"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                <?php echo $_smarty_tpl->tpl_vars['controle']->value->Nome_tit;?>

              </a>
            </li>
            <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable($_smarty_tpl->tpl_vars['key']->value+1, null, 0);?>
            <?php }?>
            <?php } ?>
          </ul>

        </div>

      </div>
    </div>

    <hr/>

    <div class="row mt-30">

      <div class="col-12">

        <div class="tab-content">
          <?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(0, null, 0);?>
          <?php  $_smarty_tpl->tpl_vars['controle'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['controle']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['solucoes_controle']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['controle']->key => $_smarty_tpl->tpl_vars['controle']->value){
$_smarty_tpl->tpl_vars['controle']->_loop = true;
?>
          <?php if ($_smarty_tpl->tpl_vars['controle']->value){?>
          <div
            class="tab-pane fade show <?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>active<?php }?>"
            id="controle-<?php echo $_smarty_tpl->tpl_vars['controle']->value->Id_int;?>
"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <div class="row  <?php if (!$_smarty_tpl->tpl_vars['controle']->value->Imagens[0]){?>justify-content-center text-center<?php }?>">

              <div class="col-12 col-md-6">
                <div class="align-center">
                  <div class="text-primary fz-24 title">
                    <?php echo $_smarty_tpl->tpl_vars['controle']->value->Texto_principal_txa;?>

                  </div>
                  <div class="texto lh-15 fz-16 mt-25">
                    <?php echo $_smarty_tpl->tpl_vars['controle']->value->Texto_secundario_txa;?>

                  </div>
                </div>
              </div>

              <?php if ($_smarty_tpl->tpl_vars['controle']->value->Imagens[0]){?>
              <div class="col-12 col-md-6">
                <div class="align-center">
                  <img
                    class="img-fluid mx-auto d-block"
                    src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['controle']->value->Imagens[0]->Caminho_txf;?>
"
                    alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['controle']->value->Texto_principal_txa);?>
"
                    title="<?php echo strip_tags($_smarty_tpl->tpl_vars['controle']->value->Texto_principal_txa);?>
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