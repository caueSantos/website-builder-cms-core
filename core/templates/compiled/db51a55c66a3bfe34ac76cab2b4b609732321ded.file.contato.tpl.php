<?php /* Smarty version Smarty-3.1.12, created on 2020-12-11 02:55:54
         compiled from "core\templates\producao\hubvet\site\forms\contato.tpl" */ ?>
<?php /*%%SmartyHeaderCode:78785fd2fbda6a7db6-38493146%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db51a55c66a3bfe34ac76cab2b4b609732321ded' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\forms\\contato.tpl',
      1 => 1607656688,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '78785fd2fbda6a7db6-38493146',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'post' => 0,
    'cliente' => 0,
    'contato_inserido' => 0,
    'app' => 0,
    'arquivito' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fd2fbda87a2f0_41094253',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2fbda87a2f0_41094253')) {function content_5fd2fbda87a2f0_41094253($_smarty_tpl) {?>
imagens/logo-cor.png" height="76" style="display: block;
</td>-->
, obrigado por entrar em contato com o Santa Rosa!</strong></td>
 recebemos sua mensagem, aguarde em breve um de nossos atendentes entrará em contato com você!</td>
</strong><br><br>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
 $_from = $_smarty_tpl->tpl_vars['contato_inserido']->value->Arquivos; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arquivito']->key => $_smarty_tpl->tpl_vars['arquivito']->value){
$_smarty_tpl->tpl_vars['arquivito']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['arquivito']->value->Caminho_txf;?>
"> <?php echo $_smarty_tpl->tpl_vars['arquivito']->value->Nome_txf;?>
 </a>
</td>

</td>
<br>
, <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Numero_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Estado_sel;?>
, <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Cep_txf;?>
<br>
 - <?php echo $_smarty_tpl->tpl_vars['cliente']->value->Telefone_txf;?>
<br>
<br>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
</td>
 $_from = $_smarty_tpl->tpl_vars['contato_inserido']->value->Arquivos; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['arquivito']->key => $_smarty_tpl->tpl_vars['arquivito']->value){
$_smarty_tpl->tpl_vars['arquivito']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['arquivito']->value->Caminho_txf;?>
"> <?php echo $_smarty_tpl->tpl_vars['arquivito']->value->Nome_txf;?>
 </a>
<br />
</div>-->