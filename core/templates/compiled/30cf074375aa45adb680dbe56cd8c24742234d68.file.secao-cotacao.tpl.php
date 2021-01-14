<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:32
         compiled from "core\templates\producao\abseg\site\blocos\solucoes\secao-cotacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:301855f50e9a4eb35a7-85983271%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30cf074375aa45adb680dbe56cd8c24742234d68' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\solucoes\\secao-cotacao.tpl',
      1 => 1599077832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '301855f50e9a4eb35a7-85983271',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9a4ec3e42_98123386',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9a4ec3e42_98123386')) {function content_5f50e9a4ec3e42_98123386($_smarty_tpl) {?><article class="text-white text-center pt-50 pb-50 pt-md-80 pb-md-70 bg-primary">    <div class="bg-fake pe-none">        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/cotacao.png" class="img-fit"/>    </div>    <div class="container">        <div class="row justify-content-center">            <div class="col-lg-8">                <h1 class="title fw-400 text-white fz-28">                    <?php echo titulo('solucao_secao_cotacao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
                </h1>                <?php if (titulo('solucao_secao_cotacao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>                    <div class="texto fz-14">                        <?php echo titulo('solucao_secao_cotacao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
                    </div>                <?php }?>                <div class="botao mt-20">                    <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cotacao"                       class="pl-80 pr-80 btn-lands btn-white btn-sm br-1 tt-upper fz-12">                        Realizar cotação                    </a>                </div>            </div>        </div>    </div></article><?php }} ?>