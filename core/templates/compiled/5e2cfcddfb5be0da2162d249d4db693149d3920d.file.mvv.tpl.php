<?php /* Smarty version Smarty-3.1.12, created on 2020-10-18 19:20:56
         compiled from "core\templates\producao\vet_life\site\blocos\sobre\mvv.tpl" */ ?>
<?php /*%%SmartyHeaderCode:325035f8cb1b849d026-21200937%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e2cfcddfb5be0da2162d249d4db693149d3920d' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\sobre\\mvv.tpl',
      1 => 1600348023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '325035f8cb1b849d026-21200937',
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
  'unifunc' => 'content_5f8cb1b854ed87_74860486',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f8cb1b854ed87_74860486')) {function content_5f8cb1b854ed87_74860486($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]){?><section class="sobre-mvv pt-50 pb-50 pt-md-100 pb-md-100 bg-primary text-white">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-12 text-center">        <div class="mt-40">          <div class="row">            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Missao_txa){?>            <div class="col-12 col-md-4">              <figure style="height: 80px">                <img alt="Missão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/missao.png">              </figure>              <div class="title fz-22 fw-700 mt-30">Missão</div>              <div class="texto fz-18 mt-15 lh-18"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Missao_txa;?>
</div>            </div>            <?php }?>            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Visao_txa){?>            <div class="col-12 col-md-4 mt-40 mt-md-0">              <figure style="height: 80px">                <img alt="Visão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/visao.png">              </figure>              <div class="title fz-22 fw-700 mt-15 mt-30">Visão</div>              <div class="texto fz-18 mt-15 lh-18"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Visao_txa;?>
</div>            </div>            <?php }?>            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Valores_txa){?>            <div class="col-12 col-md-4 mt-40 mt-md-0">              <figure style="height: 80px">                <img alt="Visão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/valores.png">              </figure>              <div class="title fz-22 fw-700 mt-15 mt-30">Valores</div>              <div class="texto fz-18 mt-15 lh-18"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Valores_txa;?>
</div>            </div>            <?php }?>          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>