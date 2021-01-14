<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 04:27:12
         compiled from "core\templates\producao\zehimoveis\site\ajax\busca.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104615fa63e40857ac5-87570579%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c57b3c924dc2af13d5e5815aa9dd0c88d5fb7a71' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\ajax\\busca.tpl',
      1 => 1604630766,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104615fa63e40857ac5-87570579',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'resultado' => 0,
    'app' => 0,
    'imovel' => 0,
    'painel' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5fa63e408dbad2_51901234',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa63e408dbad2_51901234')) {function content_5fa63e408dbad2_51901234($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['post']->value['Tpl_txf']=='mini'){?><ul class="busca-resultado-mini">  <?php  $_smarty_tpl->tpl_vars['imovel'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['imovel']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['resultado']->value['imoveis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['imovel']->key => $_smarty_tpl->tpl_vars['imovel']->value){
$_smarty_tpl->tpl_vars['imovel']->_loop = true;
?>  <li>    <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
imoveis/<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_url;?>
" class="d-flex pl-20 pr-20 pt-10 pb-10 bg-white-hover text-body-primary fz-14">      <div style="width: 24px">        <div class="aspect aspect-1-1 br-100 overflow-hidden bg-body">          <figure class="aspect-item">            <img              class="img-fit" itemprop="image"              src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Imagens[0]->Caminho_txf;?>
"              alt="<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Imagens[0]->Descricao_txf;?>
" title="<?php echo $_smarty_tpl->tpl_vars['imovel']->value->Imagens[0]->Descricao_txf;?>
"            />          </figure>        </div>      </div>      <div class="pl-15" style="width: 100%">        <div class="align-center">          <?php echo $_smarty_tpl->tpl_vars['imovel']->value->Nome_tit;?>
        </div>      </div>    </a>  </li>  <?php }
if (!$_smarty_tpl->tpl_vars['imovel']->_loop) {
?>  <div class="text-center pa-10">Nenhum resultado encontrado...</div>  <?php } ?></ul><?php }else{ ?><div id="busca-resultado">  <div class="row">    <?php if ($_smarty_tpl->tpl_vars['resultado']->value['produtos']){?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('ajax/busca-produtos.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <?php }else{ ?>    <li class="nenhum">Nenhum resultado encontrado.</li>    <?php }?>  </div></div><?php }?><?php }} ?>