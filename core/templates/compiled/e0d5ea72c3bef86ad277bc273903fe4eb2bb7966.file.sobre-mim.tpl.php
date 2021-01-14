<?php /* Smarty version Smarty-3.1.12, created on 2021-01-10 20:11:25
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-mim.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262385ffb7b8d4cdb48-98754974%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0d5ea72c3bef86ad277bc273903fe4eb2bb7966' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-mim.tpl',
      1 => 1604744351,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262385ffb7b8d4cdb48-98754974',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_mim' => 0,
    'key' => 0,
    'painel' => 0,
    'imagem' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffb7b8d527d25_74136478',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffb7b8d527d25_74136478')) {function content_5ffb7b8d527d25_74136478($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_mim']->value[0]){?><section id="sobre-sobre-mim" class="gradient-1 text-white">  <?php if ($_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Imagens){?>  <div class="bg-fake pe-none d-none d-lg-block">    <?php  $_smarty_tpl->tpl_vars['imagem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['imagem']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Imagens; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imagem']->key => $_smarty_tpl->tpl_vars['imagem']->value){
$_smarty_tpl->tpl_vars['imagem']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['imagem']->key;
?>    <div class="image-layer-<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
 bg-fake">      <img src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['imagem']->value->Caminho_txf;?>
" class="d-block ml-auto" style="max-height: 100%; height: 100%;"/>    </div>    <?php } ?>  </div>  <?php }?>  <div class="container">    <div class="row">      <div class="col-lg-6">        <div class="pt-50 pb-50 pt-lg-150 pb-lg-150">          <h1 class="title fz-48 fw-700 lh-12">            <?php echo $_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Titulo_txf;?>
          </h1>          <div class="title fw-700 fz-18 lh-12 mt-20">            <?php echo $_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Especializacao_txf;?>
          </div>          <div class="texto fw-400 fz-16 lh-15 mt-25">            <?php echo $_smarty_tpl->tpl_vars['sobre_mim']->value[0]->Sobre_txa;?>
          </div>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>