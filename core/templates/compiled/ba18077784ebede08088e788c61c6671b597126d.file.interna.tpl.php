<?php /* Smarty version Smarty-3.1.12, created on 2021-02-03 23:58:05
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\interna\interna.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3656601b54ad6708c3-59431034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba18077784ebede08088e788c61c6671b597126d' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\interna\\interna.tpl',
      1 => 1612324070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3656601b54ad6708c3-59431034',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'vaga_interna' => 0,
    'vaga' => 0,
    'app' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b54ad699d62_20030705',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b54ad699d62_20030705')) {function content_601b54ad699d62_20030705($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['vaga'] = new Smarty_variable($_smarty_tpl->tpl_vars['vaga_interna']->value[0], null, 0);?><div style="background-color: #F3F3F3">  <div>    <?php if ($_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]){?>    <figure class="bg-fake">      <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]->Caminho_txf;?>
">    </figure>    <?php }?>    <div      class="bg-fake"      style="background-color: #45A2B0; opacity: .8"    ></div>    <div class="container pt-120 pb-120 text-white">      <div class="row">        <div class="col-md-8">          <div>            <h1 class="title fz-36 fw-700"><?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_tit;?>
</h1>            <div class="fz-16 mt-10">              <?php echo $_smarty_tpl->tpl_vars['vaga']->value->Descricao_txa;?>
            </div>          </div>        </div>      </div>    </div>  </div>  <div class="container pt-60 pb-60 pb-md-120">    <div class="row">      <div class="col-md-5 pt-50">        <div class="title fw-700 text-primary fz-32">          <?php echo trans('detalhes_vaga');?>
        </div>        <div class="desc mt-25">          <?php if ($_smarty_tpl->tpl_vars['vaga']->value->Descricao_interna_txa){?>          <?php echo $_smarty_tpl->tpl_vars['vaga']->value->Descricao_interna_txa;?>
          <?php }else{ ?>          <?php echo $_smarty_tpl->tpl_vars['vaga']->value->Descricao_txa;?>
          <?php }?>        </div>      </div>      <div class="col-md-6 offset-md-1">        <div class="pt-50 pb-50 pl-50 pr-50 pl-md-70 pr-md-70 pb-md-90 bg-white">          <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/carreira/formulario.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
        </div>      </div>    </div>  </div></div><?php }} ?>