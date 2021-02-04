<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:55:52
         compiled from "core\templates\producao\hubvet\site\materiais.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6411601b62383623f9-36042678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf160cf203842d7e15d194c340aba2639c51b093' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\materiais.tpl',
      1 => 1612407350,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6411601b62383623f9-36042678',
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
  'unifunc' => 'content_601b623838c7e6_53909525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b623838c7e6_53909525')) {function content_601b623838c7e6_53909525($_smarty_tpl) {?><main id="materiais">  <section id="materiais-titulo" class="bg-dark-grey pt-40 pb-60">    <div class="container">      <div class="row justify-content-center">        <div class="col-md-7">          <div class="title-group text-center">            <h1 class="title text-white fz-36 fw-400 lh-12">              <?php echo titulo('materiais_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('materiais_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 mt-20 lh-15 text-white">              <?php echo titulo('materiais_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>          </div>        </div>      </div>    </div>  </section>  <div id="wrap" class="pt-60 pb-60">    <div class="container">      <div class="row">        <div class="col-md-3">          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/materiais/menu.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        </div>        <div class="col-md-9">          <div>            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/materiais/materiais-lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>          <?php if (config('materiais_ver_mais_link')){?>          <div class="row mt-30">            <div class="col-md-12 text-center">              <a target="_blank" href="<?php echo config('materiais_ver_mais_link');?>
" class="btn-lands">                <?php echo trans('ver_mais');?>
              </a>            </div>          </div>          <?php }?>        </div>      </div>    </div>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/materiais-horizontal-secao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>