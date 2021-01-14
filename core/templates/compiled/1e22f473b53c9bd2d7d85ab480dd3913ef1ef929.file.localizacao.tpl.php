<?php /* Smarty version Smarty-3.1.12, created on 2020-10-21 22:59:34
         compiled from "core\templates\producao\vet_life\site\blocos\global\localizacao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:266235f90d976926674-44228040%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e22f473b53c9bd2d7d85ab480dd3913ef1ef929' => 
    array (
      0 => 'core\\templates\\producao\\vet_life\\site\\blocos\\global\\localizacao.tpl',
      1 => 1603327580,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '266235f90d976926674-44228040',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'enderecos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90d97696a1b6_77162709',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90d97696a1b6_77162709')) {function content_5f90d97696a1b6_77162709($_smarty_tpl) {?><section id="localizacao">  <div class="row no-gutters">    <div class="col-md-6 col-xl-5 bg bg-secondary"></div>    <div class="col-md-6 col-xl-7 bg-body" style="z-index: 1">      <article class="mapa">        <?php  $_smarty_tpl->tpl_vars['endereco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['endereco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>        <?php if ($_smarty_tpl->tpl_vars['enderecos']->value[0]->Mapa_txf){?>        <iframe src="<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Mapa_txf;?>
" width="100%" frameborder="0"                style="border:0; height: 29rem"                allowfullscreen></iframe>        <?php }else{ ?>        <iframe          src="https://www.google.com/maps?q=<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_sel;?>
&output=embed"          style="border:0; height: 29rem" width="100%" frameborder="0"          allowfullscreen></iframe>        <?php }?>        <?php } ?>      </article>    </div>  </div>  <div class="dados bg-fake text-white">    <div class="container align-center pt-60 pb-60 text-center text-md-left">      <div class="row">        <div class="col-md-4 pr-30 fill-height">          <div>            <h1 class="fz-40 fw-700 ff-secondary">Localização</h1>            <div class="texto fz-16 mt-20">              <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
 -              <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
,              <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 -              <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_txf;?>
<?php if ($_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf){?>,<?php }?>              <?php if ($_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf){?><?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf;?>
<?php }?>            </div>            <div class="botao mt-25">              <a target="_blank"                 href="https://www.google.com/maps/dir//<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Numero_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_txf;?>
,<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cep_txf;?>
"                 class="text-white text-primary-hover fz-16 fw-700"              >                Abrir mapa              </a>            </div>          </div>        </div>      </div>    </div>  </div></section><?php }} ?>