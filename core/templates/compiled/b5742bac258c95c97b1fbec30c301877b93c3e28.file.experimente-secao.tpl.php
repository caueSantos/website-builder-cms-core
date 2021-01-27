<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 17:49:42
         compiled from "core\templates\producao\hubvet\site\blocos\global\experimente-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22736601072568f1830-30738149%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5742bac258c95c97b1fbec30c301877b93c3e28' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\experimente-secao.tpl',
      1 => 1610992118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22736601072568f1830-30738149',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tipo' => 0,
    'pagina_atual' => 0,
    'paginas_dark' => 0,
    'is_dark' => 0,
    'titulos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6010725692e960_84858269',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6010725692e960_84858269')) {function content_6010725692e960_84858269($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['tipo']->value)===null||$tmp==='' ? 1 : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['paginas_dark'] = new Smarty_variable(array('cases','materiais'), null, 0);?>
<?php $_smarty_tpl->tpl_vars['is_dark'] = new Smarty_variable(in_array($_smarty_tpl->tpl_vars['pagina_atual']->value,$_smarty_tpl->tpl_vars['paginas_dark']->value), null, 0);?>
<section class="experimente <?php if ($_smarty_tpl->tpl_vars['is_dark']->value){?>bg-dark-grey-2<?php }?> <?php if ($_smarty_tpl->tpl_vars['tipo']->value==1||$_smarty_tpl->tpl_vars['is_dark']->value){?>text-white<?php }?> pt-70 pb-80 overflow-hidden">

  <?php if ($_smarty_tpl->tpl_vars['tipo']->value==1){?>
  <div class="bg-fake bg-primary" style="transform: skewY(-1.8deg); top: -24px;"></div>
  <?php }?>

  <div class="container">

    <div class="row">

      <div class="col-md-6">
        <div class="align-center">
          <div class="title-group">
            <h1 class="title fz-28 lh-12 fw-700">
              <?php echo titulo('experimente_secao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

            </h1>
            <?php if (titulo('experimente_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
            <div class="texto fz-14 mt-10 lh-15">
              <?php echo titulo('experimente_secao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

            </div>
            <?php }?>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="row justify-content-center align-center">

          <div class="col-12 col-md-7">
            <input
              type="email" class="form-lands mb-0 <?php if ($_smarty_tpl->tpl_vars['is_dark']->value){?>form-outline form-dark<?php }?>" name="Email_txf"
              placeholder="<?php echo trans('form_email');?>
*"
              required
            />
          </div>

          <div class="col-12 col-md-5 pl-md-0">
            <button type="submit" class="btn-lands btn-lg btn-block <?php if ($_smarty_tpl->tpl_vars['tipo']->value==1){?>btn-secondary<?php }else{ ?>btn-primary<?php }?> btn-block pl-25 pr-25">
              <?php echo trans('experimente_secao_botao');?>

            </button>
          </div>

        </div>
      </div>

    </div>

  </div>

</section>
<?php }} ?>