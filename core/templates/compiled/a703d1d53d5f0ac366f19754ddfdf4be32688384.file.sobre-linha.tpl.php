<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:39
         compiled from "core\templates\producao\hubvet\site\blocos\sobre\sobre-linha.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27747601b6357e39974-11834109%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a703d1d53d5f0ac366f19754ddfdf4be32688384' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\sobre\\sobre-linha.tpl',
      1 => 1612120894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27747601b6357e39974-11834109',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sobre_linha_tempo' => 0,
    'titulos' => 0,
    'linha' => 0,
    'key' => 0,
    'linha_count' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b6357e66969_16077780',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b6357e66969_16077780')) {function content_601b6357e66969_16077780($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['sobre_linha_tempo']->value[0]){?><section id="sobre-linha-tempo" class="sobre-linha-tempo pt-50 pb-50 pt-md-100 pb-md-40">  <div class="container">    <div class="row justify-content-center">      <div class="col-md-6">        <div class="title-group text-center">          <h1 class="title fz-36 fw-400 lh-12 text-primary">            <?php echo titulo('sobre_interna_linha','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('sobre_interna_linha','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-10 lh-15">            <?php echo titulo('sobre_interna_linha','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>      </div>    </div>    <div class="row mt-40">      <?php $_smarty_tpl->tpl_vars['linha_count'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['sobre_linha_tempo']->value), null, 0);?>      <?php  $_smarty_tpl->tpl_vars['linha'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['linha']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sobre_linha_tempo']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['linha']->key => $_smarty_tpl->tpl_vars['linha']->value){
$_smarty_tpl->tpl_vars['linha']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['linha']->key;
?>      <div class="col-12 linha">        <div class="row">          <div class="col-12 col-md-2 pb-40">            <div class="pr-md-20 align-center text-right ano">              <div class="d-inline-block va-middle fz-24 title text-dark fw-700 pr-10">                <?php echo $_smarty_tpl->tpl_vars['linha']->value->Ano_txf;?>
              </div>              <div class="d-inline-block va-middle dot-warp">                <div class="dot bg-accent"></div>              </div>            </div>            <?php if ($_smarty_tpl->tpl_vars['key']->value+1!=$_smarty_tpl->tpl_vars['linha_count']->value){?>            <div class="bg-fake pr-md-35 linha-h-wrap">              <div class="linha-h ml-auto"></div>            </div>            <?php }?>          </div>          <div class="col-12 col-md-7 pb-40">            <div class="linha-conteudo bg-dark-grey br-1 text-white pl-30 pr-30 pt-30 pb-30">              <div class="title fz-24 fw-700">                <?php echo $_smarty_tpl->tpl_vars['linha']->value->Titulo_txf;?>
              </div>              <div class="descricao fz-16 mt-20">                <?php echo $_smarty_tpl->tpl_vars['linha']->value->Texto_txa;?>
              </div>            </div>          </div>          <div class="col-12 col-md-3 pl-md-70 pb-40">            <div class="align-center">              <?php if ($_smarty_tpl->tpl_vars['linha']->value->Imagens[0]){?>              <img src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['linha']->value->Imagens[0]->Caminho_txf;?>
" style="max-height: 60px; max-width: 100%"/>              <?php }?>            </div>          </div>        </div>      </div>      <?php } ?>    </div>  </div></section><?php }?><?php }} ?>