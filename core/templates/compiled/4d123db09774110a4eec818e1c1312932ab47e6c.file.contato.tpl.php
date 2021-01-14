<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:04:01
         compiled from "core\templates\producao\zehimoveis\site\contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:99785fa646e17d6818-76199491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d123db09774110a4eec818e1c1312932ab47e6c' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\contato.tpl',
      1 => 1604732640,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99785fa646e17d6818-76199491',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa646e180b6f1_46986446',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa646e180b6f1_46986446')) {function content_5fa646e180b6f1_46986446($_smarty_tpl) {?><main id="contato">  <div class="pe-none" style="height: 500px">    <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/contato.png" class="img-fit"/>  </div>  <div id="wrap" class="pb-60 pb-md-110">    <div class="container">      <div class="row">        <div class="col-md-6">          <div class="box-1 br-2 bs-1 pt-40 pt-md-60 pb-40 pb-md-100 pl-25 pl-md-50 pr-25 pr-md-50 text-center"               style="margin-top: -370px">            <div class="pe-none">              <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/message.png"/>            </div>            <h1 class="title fw-700 text-body-quaternary fz-32 mt-25" style="letter-spacing: -0.04rem">              <?php echo titulo('interna_contato_form','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 lh-15 mt-5">              <?php echo titulo('interna_contato_form','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <div class="mt-30">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>        <div class="col-md-5 offset-md-1 text-center text-md-left">          <div class="pt-50">            <h1 class="title fw-700 text-body-quaternary fz-24">              <?php echo titulo('interna_contato_dados','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>            <?php if (titulo('interna_contato_dados','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="texto fz-16 lh-15">              <?php echo titulo('interna_contato_dados','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <div class="mt-20">              <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/contato/dados_contato.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
            </div>          </div>        </div>      </div>    </div>  </div></main><?php }} ?>