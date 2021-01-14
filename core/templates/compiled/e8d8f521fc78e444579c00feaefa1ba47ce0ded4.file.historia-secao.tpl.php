<?php /* Smarty version Smarty-3.1.12, created on 2021-01-11 21:24:19
         compiled from "core\templates\producao\hubvet\site\blocos\global\historia-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24845ffcde23ef41a9-70159266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8d8f521fc78e444579c00feaefa1ba47ce0ded4' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\historia-secao.tpl',
      1 => 1610319394,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24845ffcde23ef41a9-70159266',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'historias_secao' => 0,
    'assets' => 0,
    'historia' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffcde23f0c728_00059765',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffcde23f0c728_00059765')) {function content_5ffcde23f0c728_00059765($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['historias_secao']->value[0]){?><?php $_smarty_tpl->tpl_vars['historia'] = new Smarty_variable($_smarty_tpl->tpl_vars['historias_secao']->value[0], null, 0);?><section class="historia-secao pt-40 pb-40 pt-md-70 pb-md-80">  <div class="bg-fake">    <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/bg-historias-secao.png" alt="fundo historias" class="img-fit pe-none"/>  </div>  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-8">        <div class="text-center">          <h1 class="title fw-700 fz-34 text-primary">            <?php echo $_smarty_tpl->tpl_vars['historia']->value->Texto_principal_txa;?>
          </h1>          <div class="texto lh-18 fz-16 mt-15">            <?php echo $_smarty_tpl->tpl_vars['historia']->value->Texto_secundario_txa;?>
          </div>          <?php if (is_url(config('historias_secao_botao_link'))){?>          <div class="botao mt-40">            <a target="_blank" class="btn-lands btn-primary" href="<?php echo gera_link(config('historias_secao_botao_link'),true);?>
">              <?php echo trans('historias_secao_botao_texto');?>
            </a>          </div>          <?php }?>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>