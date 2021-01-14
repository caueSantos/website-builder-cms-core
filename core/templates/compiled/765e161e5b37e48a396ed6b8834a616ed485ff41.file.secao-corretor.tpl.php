<?php /* Smarty version Smarty-3.1.12, created on 2020-11-02 21:37:00
         compiled from "core\templates\producao\zehimoveis\site\blocos\global\secao-corretor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:309045fa0981cc84808-88315656%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '765e161e5b37e48a396ed6b8834a616ed485ff41' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\blocos\\global\\secao-corretor.tpl',
      1 => 1598981286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309045fa0981cc84808-88315656',
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
  'unifunc' => 'content_5fa0981cc99be8_98387937',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa0981cc99be8_98387937')) {function content_5fa0981cc99be8_98387937($_smarty_tpl) {?><section id="secao-corretor" class="text-white text-center pt-50 pb-50 pt-md-100 pb-md-120 bg-primary">    <div class="bg-fake pe-none">        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/corretor.png" class="img-fit"/>    </div>    <div class="container">        <div class="row justify-content-center">            <div class="col-lg-8">                <?php if (titulo('secao_corretor','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>                <div class="fz-18">                    <?php echo titulo('secao_corretor','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
                </div>                <?php }?>                <h1 class="title fw-700 text-white fz-40 lh-1">                    <?php echo titulo('secao_corretor','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
                </h1>                <div class="botao mt-15">                    <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
contato"                       class="pl-80 pr-80 btn-lands btn-white btn-sm br-1 tt-upper fz-12">                        Atendimento online                    </a>                </div>            </div>        </div>    </div></section><?php }} ?>