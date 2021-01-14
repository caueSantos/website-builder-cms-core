<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 00:54:02
         compiled from "core\templates\producao\zehimoveis\site\blocos\inicio\imoveis-lista-novos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211915fd2df4a3dff62-33539977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81e375740e4e70671e7a6d9d3a5eee0785982c19' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\inicio\\imoveis-lista-novos.tpl',
      1 => 1604744352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211915fd2df4a3dff62-33539977',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'imoveis_novos' => 0,
    'caracteristicas_tipos' => 0,
    'imoveis_registros' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2df4a3fba01_68483813',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2df4a3fba01_68483813')) {function content_5fd2df4a3fba01_68483813($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['imoveis_registros'] = new Smarty_variable(monta_imoveis_zeh($_smarty_tpl->tpl_vars['imoveis_novos']->value,$_smarty_tpl->tpl_vars['caracteristicas_tipos']->value), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['imoveis_registros']->value){?>
<div class="imoveis-lista-novos pt-60 pb-40 pb-lg-80">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="title-group text-center">
          <h1 class="title text-primary fz-32 fw-700 lh-12">
            <?php echo titulo('imoveis_novos_inicio','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </h1>
          <?php if (titulo('imoveis_novos_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
          <div class="texto mt-5 lh-2 fz-16 fw-400">
            <?php echo titulo('imoveis_novos_inicio','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

          </div>
          <?php }?>
        </div>

      </div>
    </div>

    <div class="mt-30 mt-lg-60">
      <?php $_smarty_tpl->tpl_vars['cols'] = new Smarty_variable('col-lg-3', null, 0);?>
      <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/imoveis/imoveis-lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    </div>

    <div class="botao text-center mt-30 mt-lg-0">
      <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis" class="pl-lg-100 pr-lg-100 btn-lands btn-outline d-block d-lg-inline-block">
        Ver mais
      </a>
    </div>

  </div>

</div>
<?php }?>

<?php }} ?>