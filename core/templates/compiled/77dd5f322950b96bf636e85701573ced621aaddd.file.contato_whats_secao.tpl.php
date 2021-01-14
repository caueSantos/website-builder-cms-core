<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:48
         compiled from "core\templates\producao\vet_diagnosticos\site\blocos\global\contato_whats_secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:54275f90ff7ce6cb61-26224010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77dd5f322950b96bf636e85701573ced621aaddd' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\blocos\\global\\contato_whats_secao.tpl',
      1 => 1603328060,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54275f90ff7ce6cb61-26224010',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff7ce82a29_75692802',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7ce82a29_75692802')) {function content_5f90ff7ce82a29_75692802($_smarty_tpl) {?><section id="secao-contato-whats" class="text-center text-md-left secao-contato-whats text-white bg-secondary pt-20">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-5 offset-md-1 pt-30 pb-50 pt-md-70 pb-md-70">        <h1 class="title fw-600 text-white fz-40 lh-12">          <?php echo titulo('secao_contato_whats','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </h1>        <?php if ($_smarty_tpl->tpl_vars['telefones']->value){?>        <ul class="fz-20 mt-20">          <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>          <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel!='WHATSAPP'){?>          <li class="telefone fw-700">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</li>          <?php }?>          <?php } ?>        </ul>        <?php }?>        <div class="botao mt-25">          <a href="javascript:void(0);"             class="pl-80 pr-80 btn-lands btn-tertiary btn-outline bw-2"             onclick="document.querySelector('.lands-whatsapp-fab').click()"          >            <i class="fz-18 fab fa-whatsapp fw-500 mr-5"></i>            WhatsApp          </a>        </div>      </div>      <div class="col-12 col-md-5 offset-md-1">        <div class="imagem pe-none imagem-celular">          <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/contato_secao.png" alt="Aparelho Celular"/>        </div>      </div>    </div>  </div></section><?php }} ?>