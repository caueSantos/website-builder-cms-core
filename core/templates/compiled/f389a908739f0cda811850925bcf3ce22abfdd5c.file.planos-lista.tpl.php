<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 02:06:53
         compiled from "core\templates\producao\hubvet\site\blocos\planos\planos-lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22351600f955dba13d2-18985319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f389a908739f0cda811850925bcf3ce22abfdd5c' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\planos\\planos-lista.tpl',
      1 => 1610328155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22351600f955dba13d2-18985319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'planos' => 0,
    'plano' => 0,
    'app' => 0,
    'plano_itens' => 0,
    'item' => 0,
    'existe_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600f955dc21be4_25979873',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600f955dc21be4_25979873')) {function content_600f955dc21be4_25979873($_smarty_tpl) {?><section class="planos-lista pt-40 pb-40 pt-md-70 pb-md-70">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-10">

        <div class="row">

          <?php  $_smarty_tpl->tpl_vars['plano'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['plano']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['planos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['plano']->key => $_smarty_tpl->tpl_vars['plano']->value){
$_smarty_tpl->tpl_vars['plano']->_loop = true;
?>

          <div class="col-md-4 col-plano">

            <div class="plano pl-15 pr-15 text-body-secondary">

              <div class="plano-header text-body-tertiary">

                <div class="d-block text-secondary fz-14">
                  <?php if ($_smarty_tpl->tpl_vars['plano']->value->Recomendado_sel=='SIM'){?>
                  <?php echo trans('mais_recomendado');?>

                  <?php }else{ ?>
                  <span style="color: transparent">.</span>
                  <?php }?>
                </div>

                <div class="fz-22 fw-700 <?php if ($_smarty_tpl->tpl_vars['plano']->value->Recomendado_sel=='SIM'){?>text-secondary<?php }?>">
                  <?php echo $_smarty_tpl->tpl_vars['plano']->value->Titulo_txf;?>

                </div>

                <?php if ($_smarty_tpl->tpl_vars['plano']->value->Valor_txf){?>
                <div class="valor mt-10">
                  <span class="fz-48"><?php echo $_smarty_tpl->tpl_vars['app']->value->Intl->currency->currency;?>
</span>
                  <span class="fz-48"><?php echo formata_preco($_smarty_tpl->tpl_vars['plano']->value->Valor_txf);?>
</span>
                  <?php if ($_smarty_tpl->tpl_vars['plano']->value->Frequencia_cobranca_sel){?>
                  <span class="fz-18">
                  / <?php echo $_smarty_tpl->tpl_vars['plano']->value->Frequencia_cobranca_sel;?>

                </span>
                  <?php }?>
                </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['plano']->value->Descricao_txa){?>
                <div class="texto fz-14 mt-15">
                  <?php echo $_smarty_tpl->tpl_vars['plano']->value->Descricao_txa;?>

                </div>
                <?php }?>

                <?php if (!$_smarty_tpl->tpl_vars['plano']->value->Valor_txf){?>
                <?php if (is_url($_smarty_tpl->tpl_vars['plano']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['plano']->value->Botao_texto_txf){?>
                <div class="botao mt-15">
                  <a target="_blank"
                     class="text-secondary fw-700"
                     href="<?php echo gera_link($_smarty_tpl->tpl_vars['plano']->value->Botao_link_txf,true);?>
"
                  >
                    <?php echo $_smarty_tpl->tpl_vars['plano']->value->Botao_texto_txf;?>

                  </a>
                </div>
                <?php }?>
                <?php }?>

              </div>

              <div class="plano-funcionalidades mt-30">

                <div class="fz-12 fw-700 text-body-primary">
                  <?php echo trans('funcionalidades_incluidas');?>

                </div>

                <ul class="mt-30">
                  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['plano_itens']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                  <?php $_smarty_tpl->tpl_vars['existe_item'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['plano']->value->plano_itens,'Id_int','=',$_smarty_tpl->tpl_vars['item']->value->Id_int), null, 0);?>
                  <li class="mb-15">
                    <i class="fas fa-check-circle fz-14 <?php if ($_smarty_tpl->tpl_vars['existe_item']->value){?>text-success<?php }?>"></i>
                    <span class="pl-15 fz-14">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value->Nome_txf;?>

                    </span>
                  </li>
                  <?php } ?>
                </ul>

              </div>

              <?php if (is_url($_smarty_tpl->tpl_vars['plano']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['plano']->value->Botao_texto_txf){?>
              <div class="botao mt-40">
                <a target="_blank"
                   class="btn-lands btn-primary pl-15 pr-15 <?php if ($_smarty_tpl->tpl_vars['plano']->value->Recomendado_sel!='SIM'){?>btn-outline<?php }?> d-block"
                   href="<?php echo gera_link($_smarty_tpl->tpl_vars['plano']->value->Botao_link_txf,true);?>
"
                >
                  <?php echo $_smarty_tpl->tpl_vars['plano']->value->Botao_texto_txf;?>

                </a>

                <div class="d-block text-primary text-center fz-14 mt-10">
                  <?php if ($_smarty_tpl->tpl_vars['plano']->value->Recomendado_sel=='SIM'){?>
                  <?php echo trans('mais_recomendado');?>

                  <?php }else{ ?>
                  <span style="color: transparent">.</span>
                  <?php }?>
                </div>

              </div>
              <?php }?>

            </div>

          </div>

          <?php } ?>

        </div>

      </div>

    </div>

  </div>

</section>
<?php }} ?>