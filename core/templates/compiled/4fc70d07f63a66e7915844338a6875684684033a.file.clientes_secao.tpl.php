<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 09:53:15
         compiled from "core\templates\producao\labcearensediagn\site\blocos\global\clientes_secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150315f92c42b6cfcd0-54697890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fc70d07f63a66e7915844338a6875684684033a' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\global\\clientes_secao.tpl',
      1 => 1603426951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150315f92c42b6cfcd0-54697890',
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
  'unifunc' => 'content_5f92c42b752519_76331567',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c42b752519_76331567')) {function content_5f92c42b752519_76331567($_smarty_tpl) {?><section id="clientes" class="text-white text-center pt-50 pb-50 pt-md-115 pb-md-95">  <figure class="bg-fake pe-none">    <div class="bg-parallax bg-fake" style="background-image: url('<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/bg-clientes.png')"         alt="Médico e cachorro"/>    <div class="bg-fake" style="background: linear-gradient(258.29deg, rgba(43, 43, 43, 0.68) 0.38%, rgba(48, 48, 48, 0.88) 96.52%);"></div>  </figure>  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-8">        <div class="title-group">          <h1 class="title fz-40 fw-700" style="color: #0DCC81">            <?php echo titulo('secao_restrita','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>        </div>        <?php if (titulo('secao_restrita','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>        <div class="texto fz-16 lh-15 mt-15">          <?php echo titulo('secao_restrita','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </div>        <?php }?>        <div class="botao mt-30">          <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf){?>          <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_login_txf;?>
"             class="pl-80 pr-80 btn-lands btn-primary btn-outline bw-2 text-white">            Àrea do Cliente          </a>          <?php }?>          <?php if ($_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf){?>          <div class="criar-conta mt-20">            <div class="fz-12">Ainda não tem conta? Faça seu cadastro!</div>            <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['labcloud_config']->value[0]->Link_cadastro_txf;?>
" class="fw-600 lh-2 text-white text-primary-hover">              Criar conta            </a>          </div>          <?php }?>        </div>      </div>    </div>  </div></section><?php }} ?>