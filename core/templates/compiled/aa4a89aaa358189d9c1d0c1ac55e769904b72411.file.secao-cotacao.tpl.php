<?php /* Smarty version Smarty-3.1.12, created on 2020-09-13 04:03:18
         compiled from "core\templates\producao\diagnostico\site\blocos\global\secao-cotacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:284305f5dc43631a017-55093910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa4a89aaa358189d9c1d0c1ac55e769904b72411' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\global\\secao-cotacao.tpl',
      1 => 1598980421,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '284305f5dc43631a017-55093910',
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
  'unifunc' => 'content_5f5dc43632cad9_07742583',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5dc43632cad9_07742583')) {function content_5f5dc43632cad9_07742583($_smarty_tpl) {?><section id="secao-cotacao" class="text-white text-center pt-50 pb-50 pt-md-120 pb-md-120 bg-primary">    <div class="bg-fake pe-none">        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/cotacao.png" class="img-fit"/>    </div>    <div class="container">        <div class="row justify-content-center">            <div class="col-lg-8">                <h1 class="title fw-400 text-white fz-40">                    <?php echo titulo('secao_cotacao','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
                </h1>                <?php if (titulo('secao_cotacao','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>                    <div class="texto fz-18">                        <?php echo titulo('secao_cotacao','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
                    </div>                <?php }?>                <div class="botao mt-20">                    <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
cotacao"                       class="pl-80 pr-80 btn-lands btn-white btn-sm br-1 tt-upper fz-12">                        Veja todas as opções                    </a>                </div>            </div>        </div>    </div></section><?php }} ?>