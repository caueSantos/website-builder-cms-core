<?php /* Smarty version Smarty-3.1.12, created on 2021-01-26 03:26:17
         compiled from "core\templates\producao\hubvet\site\blocos\global\secao-corretor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15047600fa7f926d867-06005731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7be2662ba745a37149fd1d1c5e34f182439a7efc' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\secao-corretor.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15047600fa7f926d867-06005731',
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
  'unifunc' => 'content_600fa7f9280511_26607714',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_600fa7f9280511_26607714')) {function content_600fa7f9280511_26607714($_smarty_tpl) {?><section id="secao-corretor" class="text-white text-center pt-50 pb-50 pt-lg-100 pb-lg-120 bg-primary">    <div class="bg-fake pe-none">        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/corretor.png" class="img-fit"/>    </div>    <div class="container">        <div class="row justify-content-center">            <div class="col-lg-8">                <?php if (titulo('secao_corretor','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>                <div class="fz-18">                    <?php echo titulo('secao_corretor','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
                </div>                <?php }?>                <h1 class="title fw-700 text-white fz-40 lh-1">                    <?php echo titulo('secao_corretor','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
                </h1>                <div class="botao mt-15">                    <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente_linguagem;?>
contato"                       class="pl-80 pr-80 btn-lands btn-white btn-sm br-1 tt-upper fz-12">                        Atendimento online                    </a>                </div>            </div>        </div>    </div></section><?php }} ?>