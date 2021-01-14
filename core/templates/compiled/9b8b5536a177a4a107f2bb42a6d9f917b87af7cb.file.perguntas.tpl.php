<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:39
         compiled from "core\templates\producao\abseg\site\ajax\perguntas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:255825f50e9ab0df950-17457317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b8b5536a177a4a107f2bb42a6d9f917b87af7cb' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\ajax\\perguntas.tpl',
      1 => 1599137578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '255825f50e9ab0df950-17457317',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'perguntas' => 0,
    'key' => 0,
    'pergunta' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9ab0fea42_85692505',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9ab0fea42_85692505')) {function content_5f50e9ab0fea42_85692505($_smarty_tpl) {?><div id="perguntas-ajax">  <div id="accordion-perguntas">    <?php  $_smarty_tpl->tpl_vars['pergunta'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pergunta']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['perguntas']->value->registros; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pergunta']->key => $_smarty_tpl->tpl_vars['pergunta']->value){
$_smarty_tpl->tpl_vars['pergunta']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['pergunta']->key;
?>    <div class="head text-center <?php if ($_smarty_tpl->tpl_vars['key']->value>0){?>mt-25<?php }?>">      <div        data-toggle="collapse"        data-target="#pergunta-<?php echo $_smarty_tpl->tpl_vars['pergunta']->value->Id_int;?>
"        aria-expanded="true"        aria-controls="collapseOne"        class="d-inline-block title fw-700 fz-18 text-secondary cursor-pointer <?php if ($_smarty_tpl->tpl_vars['key']->value>0){?>collapsed<?php }?>"      >        <span class="simple-arrow va-middle"></span>        <span class="va-middle pl-5"><?php echo $_smarty_tpl->tpl_vars['pergunta']->value->Pergunta_txa;?>
</span>      </div>    </div>    <div id="pergunta-<?php echo $_smarty_tpl->tpl_vars['pergunta']->value->Id_int;?>
"         class="collapse <?php if ($_smarty_tpl->tpl_vars['key']->value==0){?>show<?php }?>"         data-parent="#accordion-perguntas"    >      <div class="texto text-center pt-10">        <?php echo $_smarty_tpl->tpl_vars['pergunta']->value->Resposta_txa;?>
      </div>    </div>    <?php } ?>  </div>  <?php $_smarty_tpl->tpl_vars['paginacao'] = new Smarty_variable($_smarty_tpl->tpl_vars['perguntas']->value->paginacao, null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/paginacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>