<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:21
         compiled from "core\templates\producao\abseg\site\blocos\sobre\mvv.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162835f50e99950c9e6-76079646%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e2b18c1601775374c00525dd18a38f58cf26b22' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\sobre\\mvv.tpl',
      1 => 1599135186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162835f50e99950c9e6-76079646',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mvv' => 0,
    'titulos' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e999534a87_28225364',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e999534a87_28225364')) {function content_5f50e999534a87_28225364($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]){?><section class="sobre-mvv pt-60 pb-70 bg-secondary text-white mt-40 mt-md-70">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-12 text-center">        <div class="row justify-content-center">          <div class="col-lg-8 text-center">            <?php if (titulo('sobre_mvv','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-18 lh-1">              <?php echo titulo('sobre_mvv','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <h1 class="title fw-700 text-white fz-32">              <?php echo titulo('sobre_mvv','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>          </div>        </div>        <div class="mt-40">          <div class="row">            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Missao_txa){?>            <div class="col-12 col-md-4 pl-md-70 pr-md-70">              <figure style="height: 80px">                <img alt="Missão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/missao.png">              </figure>              <div class="title fz-22 fw-700 mt-15">Missão</div>              <div class="texto fz-14 mt-15"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Missao_txa;?>
</div>            </div>            <?php }?>            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Visao_txa){?>            <div class="col-12 col-md-4 pl-md-70 pr-md-70 pt-40 pt-md-0">              <figure style="height: 80px">                <img alt="Visão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/visao.png">              </figure>              <div class="title fz-22 fw-700 mt-15">Visão</div>              <div class="texto fz-14 mt-15"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Visao_txa;?>
</div>            </div>            <?php }?>            <?php if ($_smarty_tpl->tpl_vars['mvv']->value[0]->Valores_txa){?>            <div class="col-12 col-md-4 pl-md-70 pr-md-70 pt-40 pt-md-0">              <figure style="height: 80px">                <img alt="Visão" class="align-center" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/valores.png">              </figure>              <div class="title fz-22 fw-700 mt-15">Valores</div>              <div class="texto fz-14 mt-15"><?php echo $_smarty_tpl->tpl_vars['mvv']->value[0]->Valores_txa;?>
</div>            </div>            <?php }?>          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>