<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:59:44
         compiled from "core\templates\producao\hubvet\site\contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:29447601b632075e3a0-47409993%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d4219a2ba9f14f7a466c486b0d8cdb36c613874' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\contato.tpl',
      1 => 1612077006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29447601b632075e3a0-47409993',
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
  'unifunc' => 'content_601b632077d043_03808078',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b632077d043_03808078')) {function content_601b632077d043_03808078($_smarty_tpl) {?><main id="contato">  <div id="wrap">    <section class="contato-topo bg-dark-grey text-center text-white pt-40 pb-50 pb-md-90">      <div class="container">        <div class="row justify-content-center">          <div class="col-md-6">            <div class="title-group">              <h1 class="title fz-36 fw-400 text-primary">                <?php echo titulo('interna_contato_form','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </h1>              <?php if (titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>              <div class="texto fz-16 mt-15">                <?php echo titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </div>              <?php }?>            </div>          </div>        </div>        <div class="row justify-content-center">          <div class="col-md-4">            <div class="mt-30">              <?php $_smarty_tpl->tpl_vars['tipo'] = new Smarty_variable(1, null, 0);?>              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </section>  </div>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/materiais-horizontal-secao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</main><?php }} ?>