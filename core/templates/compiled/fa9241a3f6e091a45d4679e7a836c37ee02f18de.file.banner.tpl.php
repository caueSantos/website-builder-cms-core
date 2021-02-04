<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 02:58:29
         compiled from "core\templates\producao\hubvet\site\blocos\solucoes\banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4889601b7ef585e080-70100938%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa9241a3f6e091a45d4679e7a836c37ee02f18de' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\solucoes\\banner.tpl',
      1 => 1610261370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4889601b7ef585e080-70100938',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes_banner' => 0,
    'banner' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b7ef5878810_75970923',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b7ef5878810_75970923')) {function content_601b7ef5878810_75970923($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['solucoes_banner']->value[0]){?><?php $_smarty_tpl->tpl_vars['banner'] = new Smarty_variable($_smarty_tpl->tpl_vars['solucoes_banner']->value[0], null, 0);?><section class="solucoes-banner bg-dark-grey text-white pt-40 pb-40 pt-md-90 pb-md-110">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-8">        <div class="text-center">          <h1 class="title fw-700 fz-34">            <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_txf;?>
          </h1>          <div class="texto lh-18 fz-18 mt-15">            <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_txa;?>
          </div>          <?php if (is_url($_smarty_tpl->tpl_vars['banner']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf){?>          <div class="botao mt-40">            <a target="_blank" class="btn-lands btn-primary" href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_link_txf;?>
">              <?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf;?>
            </a>          </div>          <?php }?>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>