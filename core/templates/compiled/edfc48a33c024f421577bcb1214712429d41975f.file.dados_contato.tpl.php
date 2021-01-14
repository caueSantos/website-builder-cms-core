<?php /* Smarty version Smarty-3.1.12, created on 2020-12-13 00:41:42
         compiled from "core\templates\producao\hubvet\site\blocos\contato\dados_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:275465fd57f66d3c677-39248177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edfc48a33c024f421577bcb1214712429d41975f' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\contato\\dados_contato.tpl',
      1 => 1604359743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '275465fd57f66d3c677-39248177',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'telefones' => 0,
    'telefone' => 0,
    'emails' => 0,
    'email' => 0,
    'whats' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd57f66d678f5_19730266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd57f66d678f5_19730266')) {function content_5fd57f66d678f5_19730266($_smarty_tpl) {?><div class="dados">  <?php if ($_smarty_tpl->tpl_vars['telefones']->value){?>  <div class="telefones">    <h3 class="fz-16 fw-400 d-inline">      Telefones:    </h3>    <ul class="d-inline telefones-lista">      <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['telefone']->key;
?>      <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel!='WHATSAPP'){?>      <li class="telefone d-inline">        <span class="numero">          <?php if ('key'>0){?>, <?php }?>(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
        </span>      </li>      <?php }?>      <?php } ?>    </ul>  </div>  <?php }?>  <?php if ($_smarty_tpl->tpl_vars['emails']->value){?>  <div class="emails">    <h3 class="fz-16 fw-400 d-inline">      Emails:    </h3>    <ul class="emails-lista d-inline">      <?php  $_smarty_tpl->tpl_vars['email'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['email']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['emails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['email']->key;
?>      <li class="email d-inline">        <span itemprop="email">          <?php if ('key'>0){?>, <?php }?><?php echo $_smarty_tpl->tpl_vars['email']->value->Email_txf;?>
        </span>      </li>      <?php } ?>    </ul>  </div>  <?php }?>  <?php if ($_smarty_tpl->tpl_vars['whats']->value[0]){?>  <div class="mt-30">    <strong>Se desejar entre em contato pelo WhatsApp</strong>    <button      class="btn-lands btn-secondary bs-0 mt-25"      onclick="document.querySelector('.lands-whatsapp-fab').click()"    >      <i class="fab fa-whatsapp va-middle fz-18"></i>      <span class="pl-10 va-middle">Entrar em contato pelo WhatsApp</span>    </button>  </div>  <?php }?>  <div class="redes mt-45">    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></div><?php }} ?>