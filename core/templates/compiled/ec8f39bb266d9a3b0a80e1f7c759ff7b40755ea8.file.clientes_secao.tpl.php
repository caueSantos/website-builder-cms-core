<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:34
         compiled from "core\templates\producao\vet_life\site\blocos\global\clientes_secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16295f90d9764d7060-00778406%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec8f39bb266d9a3b0a80e1f7c759ff7b40755ea8' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\global\\clientes_secao.tpl',
      1 => 1603328319,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16295f90d9764d7060-00778406',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'labcloud_config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d9764f5468_69763643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d9764f5468_69763643')) {function content_5f90d9764f5468_69763643($_smarty_tpl) {?><section id="noticias" class="text-white text-center pt-50 pb-50 pt-md-115 pb-md-95 bg-secondary">  <figure class="bg-fake pe-none">    <div class="bg-parallax bg-fake" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/bg-clientes.png')"         alt="Médico e cachorro"/>    <div class="bg-fake bg-secondary" style="opacity: 0.85;"></div>  </figure>  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8">        <div class="title-group">          <h1 class="title fz-40 fw-700 text-tertiary">            <?php echo titulo('secao_restrita','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>        </div>        <?php if (titulo('secao_restrita','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>        <div class="texto fz-16 lh-15 mt-15">          <?php echo titulo('secao_restrita','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </div>        <?php }?>        <div class="botao mt-30">          <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf){?>          <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf;?>
"             class="pl-80 pr-80 btn-lands btn-tertiary btn-outline bw-2">            Àrea do Cliente          </a>          <?php }?>          <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf){?>          <div class="criar-conta mt-20">            <div class="fz-12">Ainda não tem conta? Faça seu cadastro!</div>            <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf;?>
" class="fw-600 lh-2 text-white text-tertiary-hover">              Criar conta            </a>          </div>          <?php }?>        </div>      </div>    </div>  </div></section><?php }} ?>