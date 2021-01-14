<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:44
         compiled from "core\templates\producao\abseg\site\blocos\contato\endereco.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102595f50e9b0dce3a8-45859282%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '193f5defc404bc61a2a7f7e5f48839ce8a64cb7a' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\contato\\endereco.tpl',
      1 => 1599114964,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102595f50e9b0dce3a8-45859282',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pagina_atual' => 0,
    'paginas' => 0,
    'titulos' => 0,
    'enderecos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9b0df8a90_40070734',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9b0df8a90_40070734')) {function content_5f50e9b0df8a90_40070734($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['paginas'] = new Smarty_variable(array('contato','ouvidoria'), null, 0);?><?php if (in_array($_smarty_tpl->tpl_vars['pagina_atual']->value,$_smarty_tpl->tpl_vars['paginas']->value)==true){?><section class="contato-endereco bg-secondary text-white text-center">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-12">        <div class="tits mt-50">          <h1 class="title fz-32 fw-700"><?php echo titulo('secao_endereco','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
</h1>          <?php if (titulo('secao_endereco','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-14">            <?php echo titulo('secao_endereco','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>        <div class="mapas mt-40">          <?php  $_smarty_tpl->tpl_vars['endereco'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['endereco']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['enderecos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['endereco']->key => $_smarty_tpl->tpl_vars['endereco']->value){
$_smarty_tpl->tpl_vars['endereco']->_loop = true;
?>          <article class="mapa bs-2 bg-body">            <?php if ($_smarty_tpl->tpl_vars['enderecos']->value[0]->Mapa_txf){?>            <iframe              src="<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Mapa_txf;?>
" width="100%" height="480px" frameborder="0"              style="border:0"              allowfullscreen></iframe>            <?php }else{ ?>            <iframe              src="https://www.google.com/maps?q=<?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Endereco_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Bairro_txf;?>
, <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Cidade_txf;?>
 - <?php echo $_smarty_tpl->tpl_vars['enderecos']->value[0]->Estado_sel;?>
&output=embed"              style="border:0" width="100%" height="480px" frameborder="0"              allowfullscreen></iframe>            <?php }?>          </article>          <?php } ?>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>