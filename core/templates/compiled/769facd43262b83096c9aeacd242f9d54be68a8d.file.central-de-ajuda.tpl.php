<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:28:46
         compiled from "core\templates\producao\hubvet\site\central-de-ajuda.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30396600fa88eee5fc9-86988160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '769facd43262b83096c9aeacd242f9d54be68a8d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\central-de-ajuda.tpl',
      1 => 1611638857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30396600fa88eee5fc9-86988160',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_600fa88eeffb22_40382149',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa88eeffb22_40382149')) {function content_600fa88eeffb22_40382149($_smarty_tpl) {?><main id="central">  <div id="wrap" class="pb-20">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/pesquisa.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/base.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <section class="bg-secondary text-white pt-50 pt-lg-80 pb-50 pb-lg-80">      <div class="container">        <div class="row justify-content-center">          <div class="col-12 col-lg-6">            <div class="text-center">              <div class="fz-18">                Em caso de dúvidas              </div>              <h3 class="title fz-24 fz-lg-48 fw-700 lh-1">                entre em contato              </h3>              <div class="texto fz-18 mt-10">                Vamos resolver seu problema o mais rápido possível!              </div>            </div>            <div class="mt-30">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/central/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </section>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/ajuda/perguntas.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></main><?php }} ?>