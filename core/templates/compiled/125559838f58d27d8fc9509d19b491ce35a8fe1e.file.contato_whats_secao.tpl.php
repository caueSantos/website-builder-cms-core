<?php /* Smarty version Smarty-3.1.12, created on 2020-10-23 09:53:14
         compiled from "core\templates\producao\labcearensediagn\site\blocos\global\contato_whats_secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:196905f92c42aae2681-27960930%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '125559838f58d27d8fc9509d19b491ce35a8fe1e' => 
    array (
      0 => 'core\\templates\\producao\\labcearensediagn\\site\\blocos\\global\\contato_whats_secao.tpl',
      1 => 1603426152,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196905f92c42aae2681-27960930',
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
  'unifunc' => 'content_5f92c42ab86a91_90441866',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f92c42ab86a91_90441866')) {function content_5f92c42ab86a91_90441866($_smarty_tpl) {?><section id="secao-contato-whats" class="text-center text-md-left secao-contato-whats text-white pt-20" style="background-color: #343434">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-5 offset-md-1 pt-30 pb-50 pt-md-70 pb-md-70">        <h1 class="title fw-600 text-white fz-40 lh-12">          <?php echo titulo('secao_contato_whats','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
        </h1>        <?php if ($_smarty_tpl->tpl_vars['telefones']->value){?>        <ul class="fz-20 mt-20">          <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>          <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel!='WHATSAPP'){?>          <li class="telefone fw-700">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</li>          <?php }?>          <?php } ?>        </ul>        <?php }?>        <div class="botao mt-25">          <a href="javascript:void(0);"             class="pl-80 pr-80 btn-lands text-white btn-outline bw-2"             onclick="document.querySelector('.lands-whatsapp-fab').click()"          >            <i class="fz-18 fab fa-whatsapp fw-500 mr-5"></i>            WhatsApp          </a>        </div>      </div>      <div class="col-12 col-md-5 offset-md-1">        <div class="imagem pe-none imagem-celular">          <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/contato_secao.png" alt="Aparelho Celular"/>        </div>      </div>    </div>  </div></section><?php }} ?>