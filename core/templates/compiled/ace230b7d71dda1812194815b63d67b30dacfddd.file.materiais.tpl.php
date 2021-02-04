<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 00:55:54
         compiled from "core\templates\producao\hubvet\site\ajax\materiais.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2275601b623a9fe957-11064300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ace230b7d71dda1812194815b63d67b30dacfddd' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\ajax\\materiais.tpl',
      1 => 1610943333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2275601b623a9fe957-11064300',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'requisicao' => 0,
    'materiais' => 0,
    'categoria' => 0,
    'material' => 0,
    'filtro' => 0,
    'painel' => 0,
    'assets' => 0,
    'existe_item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b623aa414a9_10538887',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b623aa414a9_10538887')) {function content_601b623aa414a9_10538887($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['categoria'] = new Smarty_variable($_smarty_tpl->tpl_vars['requisicao']->value['categoria'], null, 0);?>

<?php $_smarty_tpl->tpl_vars['existe_item'] = new Smarty_variable(false, null, 0);?>

<?php  $_smarty_tpl->tpl_vars['material'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['material']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['materiais']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['material']->key => $_smarty_tpl->tpl_vars['material']->value){
$_smarty_tpl->tpl_vars['material']->_loop = true;
?>

<?php $_smarty_tpl->tpl_vars['filtro'] = new Smarty_variable(true, null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['categoria']->value){?>
<?php $_smarty_tpl->tpl_vars['filtro'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['material']->value->categorias,'Nome_url','=',$_smarty_tpl->tpl_vars['categoria']->value), null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['filtro']->value&&is_url($_smarty_tpl->tpl_vars['material']->value->Link_txf)){?>
<?php $_smarty_tpl->tpl_vars['existe_item'] = new Smarty_variable(true, null, 0);?>
<div class="col-md-6 pl-md-25 pr-md-25 mb-50">

  <a class="material hover hover-scale-down d-block" href="<?php echo $_smarty_tpl->tpl_vars['material']->value->Link_txf;?>
" target="_blank">

    <div class="aspect aspect-16-9 br-2 overflow-hidden">
      <figure class="imagem aspect-item">
        <?php if ($_smarty_tpl->tpl_vars['material']->value->Imagens[0]){?>
        <img src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['material']->value->Imagens[0]->Caminho_txf;?>
" class="img-fit"/>
        <?php }else{ ?>
        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/indisponivel.png" class="img-fit"/>
        <?php }?>
      </figure>
    </div>

    <div class="title fw-700 text-primary fz-18 mt-20">
      <?php echo $_smarty_tpl->tpl_vars['material']->value->Titulo_txf;?>

    </div>

    <div class="texto lh-15 fz-14 mt-10 text-body-secondary" data-clamp="2">
      <?php echo $_smarty_tpl->tpl_vars['material']->value->Descricao_txa;?>

    </div>

    <div class="botao">
      <div class="fz-16 fw-700 text-primary mt-10">
        <?php echo trans('baixar_agora');?>

      </div>
    </div>

  </a>

</div>

<?php }?>

<?php } ?>
<?php if (!$_smarty_tpl->tpl_vars['existe_item']->value){?>

<div class="col-12 text-center pt-50 pb-50">

  <div class="fz-18 fw-700"><?php echo trans('nenhum_item_encontrado');?>
</div>

</div>

<?php }?>
<?php }} ?>