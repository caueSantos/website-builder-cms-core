<?php /* Smarty version Smarty-3.1.12, created on 2021-01-11 20:45:44
         compiled from "core\templates\producao\hubvet\site\blocos\solucoes\visao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12935ffcd518e8fef8-94034657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '75c78da42b57df0720231e748218101643ebbe2a' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\solucoes\\visao.tpl',
      1 => 1610265405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12935ffcd518e8fef8-94034657',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'solucoes_visao' => 0,
    'banner' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffcd518ebde46_93309930',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffcd518ebde46_93309930')) {function content_5ffcd518ebde46_93309930($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['solucoes_visao']->value[0]){?><?php $_smarty_tpl->tpl_vars['banner'] = new Smarty_variable($_smarty_tpl->tpl_vars['solucoes_visao']->value[0], null, 0);?><section class="solucoes_visao bg-primary text-white pt-40 pb-40 pt-md-90 pb-md-110">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-6">        <div class="<?php if (!$_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>text-center<?php }?> align-center">          <h1 class="title fw-700 fz-34">            <?php echo $_smarty_tpl->tpl_vars['banner']->value->Titulo_txf;?>
          </h1>          <div class="texto lh-18 fz-16 mt-15">            <?php echo $_smarty_tpl->tpl_vars['banner']->value->Texto_txa;?>
          </div>          <?php if (is_url($_smarty_tpl->tpl_vars['banner']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf){?>          <div class="botao mt-40">            <a target="_blank" class="btn-lands btn-accent" href="<?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_link_txf;?>
">              <?php echo $_smarty_tpl->tpl_vars['banner']->value->Botao_texto_txf;?>
            </a>          </div>          <?php }?>        </div>      </div>      <?php if ($_smarty_tpl->tpl_vars['banner']->value->Imagens[0]){?>      <div class="col-12 col-md-6">        <div class="align-center">          <img            class="img-fluid mx-auto d-block"            src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['banner']->value->Imagens[0]->Caminho_txf;?>
"            alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Nome_tit);?>
"            title="<?php echo strip_tags($_smarty_tpl->tpl_vars['banner']->value->Nome_tit);?>
"          />        </div>      </div>      <?php }?>    </div>  </div></section><?php }?><?php }} ?>