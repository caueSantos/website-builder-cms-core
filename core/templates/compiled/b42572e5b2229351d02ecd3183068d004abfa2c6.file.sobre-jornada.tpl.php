<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:39
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-jornada.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6173601b6357dadf67-00201984%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b42572e5b2229351d02ecd3183068d004abfa2c6' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-jornada.tpl',
      1 => 1612117156,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6173601b6357dadf67-00201984',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_jornada' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6357dca117_84675902',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6357dca117_84675902')) {function content_601b6357dca117_84675902($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_jornada']->value[0]){?><section id="sobre-jornada" class="pt-50 pb-50 pt-md-130 pb-md-130 bg-primary text-white">  <div class="container">    <div class="row justify-content-center">      <?php if ($_smarty_tpl->tpl_vars['sobre_jornada']->value[0]->Videos[0]){?>      <div class="col-md-6 pr-md-60">        <?php $_smarty_tpl->tpl_vars['video'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre_jornada']->value[0]->Videos[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['aspect'] = new Smarty_variable('3-2', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/video-aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>      <?php }?>      <div class="col-lg-6 pl-md-80 pt-30 pt-lg-0 <?php if (!$_smarty_tpl->tpl_vars['sobre_jornada']->value[0]->Videos[0]){?>text-center<?php }?>">        <div class="align-center">          <h1 class="title fw-700 fz-34 lh-12">            <?php echo $_smarty_tpl->tpl_vars['sobre_jornada']->value[0]->Titulo_txf;?>
          </h1>          <div class="texto fz-14 lh-15 mt-lg-20">            <?php echo $_smarty_tpl->tpl_vars['sobre_jornada']->value[0]->Texto_txa;?>
          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>