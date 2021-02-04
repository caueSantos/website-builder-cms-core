<?php /* Smarty version Smarty-3.1.12, created on 2021-02-02 02:03:47
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:180116018cf23660fb0-66280908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79149b2791620f65774207c3f2ef1c467c471b61' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\interna.tpl',
      1 => 1584564590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '180116018cf23660fb0-66280908',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vagas' => 0,
    'app' => 0,
    'vaga' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6018cf23687213_81138785',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6018cf23687213_81138785')) {function content_6018cf23687213_81138785($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['vaga'] = new Smarty_variable($_smarty_tpl->tpl_vars['vagas']->value[0], null, 0);?>
<div class="head">
    <a href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
trabalhe-conosco">
        <i class="fas fa-arrow-left" style="font-size: 12px; margin-right: 4px;"></i> 
        voltar e ver todas as vagas
    </a>
    <h1><?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_tit;?>
</h1>
</div>
<div class="container">
    <div class="row">

        <div class="col-lg">

            <div class="desc">
                <?php if ($_smarty_tpl->tpl_vars['vaga']->value->Descricao_interna_txa){?>
                <?php echo $_smarty_tpl->tpl_vars['vaga']->value->Descricao_interna_txa;?>

                <?php }else{ ?>
                <?php echo $_smarty_tpl->tpl_vars['vaga']->value->Descricao_txa;?>

                <?php }?>
            </div>

        </div>

        <div class="col-lg-auto">
            <div class="faixa">
                <?php if ($_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]){?>
                <figure>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]->Caminho_txf;?>
">
                </figure>
                <?php }?>
                <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/trabalhe-conosco/formulario.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            </div>
        </div>

    </div>
</div><?php }} ?>