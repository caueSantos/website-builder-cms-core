<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\blocos\inicio\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104915f84b94815ef96-04297588%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c30a64c1deb9084266de728619f52a13e86b43c2' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\inicio\\sobre.tpl',
      1 => 1599792954,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104915f84b94815ef96-04297588',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre' => 0,
    'assets' => 0,
    'titulos' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b94817a595_93976112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b94817a595_93976112')) {function content_5f84b94817a595_93976112($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre']->value[0]){?><section class="sobre-inicio text-center pt-50 pb-50 pt-md-60 pb-md-80">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-8">        <div class="title-group">          <div class="title-image mb-25">            <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/logo-title.png" class="pe-none"/>          </div>          <h1 class="title fz-32 fw-700 text-secondary">            <?php echo titulo('inicio_sobre','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>        </div>        <div class="texto fz-18 lh-18 mt-15">          <?php echo $_smarty_tpl->tpl_vars['sobre']->value[0]->Sobre_inicio_txa;?>
        </div>        <div class="botao mt-30">          <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
sobre" class="btn-lands">            Saiba mais sobre nós          </a>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>