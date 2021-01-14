<?php /* Smarty version Smarty-3.1.12, created on 2020-11-01 19:54:47
         compiled from "core\templates\producao\zehimoveis\site\blocos\inicio\sobre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:169065f9f2ea7003137-05962107%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a17d69cf1c98d30fa59c52f2cde4e914412ef33' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\inicio\\sobre.tpl',
      1 => 1603328232,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '169065f9f2ea7003137-05962107',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f9f2ea701fd80_92233037',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9f2ea701fd80_92233037')) {function content_5f9f2ea701fd80_92233037($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre']->value[0]){?><section id="sobre" class="sobre-inicio pt-50 pb-50 pt-md-130 pb-md-75 text-center text-md-left">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-6">        <div class="align-center">          <div class="title-group">            <?php if (titulo('secao_sobre','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>            <div class="fz-14 tt-upper subtitle text-body-secondary">              <?php echo titulo('secao_sobre','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </div>            <?php }?>            <h1 class="title fz-40 fw-700 text-primary">              <?php echo titulo('secao_sobre','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
            </h1>          </div>          <div class="texto fz-16 lh-18 mt-20 text-body-secondary">            <?php echo $_smarty_tpl->tpl_vars['sobre']->value[0]->Sobre_txa;?>
          </div>        </div>      </div>      <div class="col-12 col-md-6 pl-md-50 pr-md-50 mt-40 mt-md-0">        <?php $_smarty_tpl->tpl_vars['imagem'] = new Smarty_variable($_smarty_tpl->tpl_vars['sobre']->value[0]->Imagens[0], null, 0);?>        <?php $_smarty_tpl->tpl_vars['radius'] = new Smarty_variable('3', null, 0);?>        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('componentes/imagem_aspect.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
      </div>    </div>  </div></section><?php }?><?php }} ?>