<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 14:23:40
         compiled from "core\templates\producao\diagnostico\site\blocos\sobre\mvv.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150095f64ed1c22efe4-81814487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8c1fbf50585ef3cd3b01d3935fbcc94bf0b55d8' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\sobre\\mvv.tpl',
      1 => 1600348023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150095f64ed1c22efe4-81814487',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mvv' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64ed1c24b912_90960623',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64ed1c24b912_90960623')) {function content_5f64ed1c24b912_90960623($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]){?><section class="sobre-mvv pt-50 pb-50 pt-md-100 pb-md-100 bg-primary text-white">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-12 text-center">        <div class="mt-40">          <div class="row">            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Missao_txa){?>            <div class="col-12 col-md-4">              <figure style="height: 80px">                <img alt="Missão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/missao.png">              </figure>              <div class="title fz-22 fw-700 mt-30">Missão</div>              <div class="texto fz-18 mt-15 lh-18"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Missao_txa;?>
</div>            </div>            <?php }?>            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Visao_txa){?>            <div class="col-12 col-md-4 mt-40 mt-md-0">              <figure style="height: 80px">                <img alt="Visão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/visao.png">              </figure>              <div class="title fz-22 fw-700 mt-15 mt-30">Visão</div>              <div class="texto fz-18 mt-15 lh-18"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Visao_txa;?>
</div>            </div>            <?php }?>            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Valores_txa){?>            <div class="col-12 col-md-4 mt-40 mt-md-0">              <figure style="height: 80px">                <img alt="Visão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/valores.png">              </figure>              <div class="title fz-22 fw-700 mt-15 mt-30">Valores</div>              <div class="texto fz-18 mt-15 lh-18"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Valores_txa;?>
</div>            </div>            <?php }?>          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>