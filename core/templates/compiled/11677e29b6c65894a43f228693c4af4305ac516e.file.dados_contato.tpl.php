<?php /* Smarty version Smarty-3.1.12, created on 2020-09-18 13:29:16
         compiled from "core\templates\producao\diagnostico\site\blocos\contato\dados_contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90205f64e05c688833-62520594%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11677e29b6c65894a43f228693c4af4305ac516e' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\contato\\dados_contato.tpl',
      1 => 1600061478,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90205f64e05c688833-62520594',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'enderecos' => 0,
    'endereco' => 0,
    'telefones' => 0,
    'telefone' => 0,
    'emailsa' => 0,
    'email' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f64e05c708c23_04223651',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f64e05c708c23_04223651')) {function content_5f64e05c708c23_04223651($_smarty_tpl) {?><div class="dados">  <?php if ($_smarty_tpl->tpl_vars['enderecos']->value){?>  <div class="enderecos">    <h3 class="fz-16 fw-600 mb-5">      Endereços    </h3>    <ul class="enderecos-lista lh-15">      <?php  $_smarty_tpl->tpl_vars['endereco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['endereco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>      <li class="endereco">        <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Endereco_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Bairro_txf;?>
<br/>        <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Estado_txf;?>
,<br/>        <?php echo $_smarty_tpl->tpl_vars['endereco']->value->Cep_txf;?>
      </li>      <?php } ?>    </ul>  </div>  <?php }?>  <?php if ($_smarty_tpl->tpl_vars['telefones']->value){?>  <div class="telefones mt-30">    <h3 class="fz-16 fw-600 mb-5">      Telefones    </h3>    <ul class="telefones-lista lh-15">      <?php  $_smarty_tpl->tpl_vars['telefone'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['telefone']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['telefones']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['telefone']->key => $_smarty_tpl->tpl_vars['telefone']->value){
$_smarty_tpl->tpl_vars['telefone']->_loop = true;
?>      <li class="telefone">        <span class="numero">(<?php echo $_smarty_tpl->tpl_vars['telefone']->value->Ddd_txf;?>
) <?php echo $_smarty_tpl->tpl_vars['telefone']->value->Numero_txf;?>
</span>        <?php if ($_smarty_tpl->tpl_vars['telefone']->value->Tipo_sel=='WHATSAPP'){?>        <i class="ml-5 fz-16 fab fa-whatsapp"></i>        <?php }?>      </li>      <?php } ?>    </ul>  </div>  <?php }?>  <?php if ($_smarty_tpl->tpl_vars['emailsa']->value){?>  <div class="emails mt-30">    <h3 class="fz-16 fw-600 mb-5">      Emails    </h3>    <ul class="emails-lista lh-15">      <?php  $_smarty_tpl->tpl_vars['email'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['email']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emailsa']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
?>      <li class="email">        <div itemprop="email">          <?php if ($_smarty_tpl->tpl_vars['email']->value->Descricao_txf){?>          <?php echo $_smarty_tpl->tpl_vars['email']->value->Descricao_txf;?>
 -          <?php }?>          <?php echo $_smarty_tpl->tpl_vars['email']->value->Email_txf;?>
        </div>      </li>      <?php } ?>    </ul>  </div>  <?php }?>  <div class="redes mt-30">    <?php $_smarty_tpl->tpl_vars['mostra_contato'] = new Smarty_variable(true, null, 0);?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/redes_sociais_lista.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
  </div></div><?php }} ?>