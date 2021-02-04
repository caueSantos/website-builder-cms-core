<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:50:20
         compiled from "core\templates\producao\hubvet\site\blocos\global\materiais-horizontal-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13507601b6efc0cccb8-65231570%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e64c29e92ccf52049061b3e9e886bfa93da2ac5' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\materiais-horizontal-secao.tpl',
      1 => 1612069548,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13507601b6efc0cccb8-65231570',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6efc0de874_82161154',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6efc0de874_82161154')) {function content_601b6efc0de874_82161154($_smarty_tpl) {?><section id="contato" class="text-center bg-primary text-white pt-50 pb-50 pt-md-70 pb-md-80">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12 col-md-6">

                <div class="title-group">
                    <h1 class="title fz-36 fw-400">
                        <?php echo titulo('materiais-horizontal-secao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>

                    </h1>
                    <?php if (titulo('materiais-horizontal-secao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>
                        <div class="texto fz-16 mt-15">
                            <?php echo titulo('materiais-horizontal-secao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>

                        </div>
                    <?php }?>
                </div>

            </div>

        </div>

        <div class="row justify-content-center mt-30">

            <div class="col-12 col-lg-4 pl-md-50 pr-md-50">
                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/forms/materiais-horizontal-secao-form.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            </div>

        </div>

    </div>

</section>



<?php }} ?>