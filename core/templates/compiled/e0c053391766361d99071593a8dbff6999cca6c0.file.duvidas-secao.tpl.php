<?php /* Smarty version Smarty-3.1.12, created on 2021-01-11 21:24:20
         compiled from "core\templates\producao\hubvet\site\blocos\global\duvidas-secao.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133475ffcde240920f2-77434236%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0c053391766361d99071593a8dbff6999cca6c0' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\global\\duvidas-secao.tpl',
      1 => 1610319367,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '133475ffcde240920f2-77434236',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'duvidas_secao' => 0,
    'telefones' => 0,
    'duvida' => 0,
    'painel' => 0,
    'credito' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ffcde240d8be8_79767366',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ffcde240d8be8_79767366')) {function content_5ffcde240d8be8_79767366($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['duvidas_secao']->value[0]){?><?php $_smarty_tpl->tpl_vars['duvidas_secao'] = new Smarty_variable(junta_registros($_smarty_tpl->tpl_vars['duvidas_secao']->value,'Telefone_sel',$_smarty_tpl->tpl_vars['telefones']->value,'Numero_txf','Telefone'), null, 0);?><?php $_smarty_tpl->tpl_vars['duvida'] = new Smarty_variable($_smarty_tpl->tpl_vars['duvidas_secao']->value[0], null, 0);?><section class="duvidas-secao bg-dark-grey text-white pt-40 pb-40 pt-md-70 pb-md-70">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-md-8 text-center">        <h1 class="title fz-24">          <?php echo $_smarty_tpl->tpl_vars['duvida']->value->Titulo_txa;?>
        </h1>        <div class="row justify-content-center mt-30">          <?php if ($_smarty_tpl->tpl_vars['duvida']->value->Imagens[0]){?>          <div class="col-md-5">            <figure class="imagem">              <img class="pe-none img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['duvida']->value->Imagens[0]->Caminho_txf;?>
"                   alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['duvida']->value->Titulo_txa);?>
"/>            </figure>          </div>          <?php }?>          <div class="col-md-5 <?php if ($_smarty_tpl->tpl_vars['duvida']->value->Imagens[0]){?>text-md-left<?php }?>">            <div class="align-center">              <div class="ml-md-5 fz-22">                <?php echo trans('duvidas_secao_ligue');?>
              </div>              <div class="fz-42 fw-700 title">                <?php echo $_smarty_tpl->tpl_vars['duvida']->value->Telefone[0]->Ddd_txf;?>
 <?php echo $_smarty_tpl->tpl_vars['duvida']->value->Telefone[0]->Numero_txf;?>
              </div>            </div>          </div>        </div>        <div class="botao mt-25">          <?php if ($_smarty_tpl->tpl_vars['duvida']->value->Subtitulo_txa){?>          <div class="texto fz-24">            <?php echo $_smarty_tpl->tpl_vars['duvida']->value->Subtitulo_txa;?>
          </div>          <?php }?>          <?php if (is_url($_smarty_tpl->tpl_vars['duvida']->value->Botao_link_txf)&&$_smarty_tpl->tpl_vars['duvida']->value->Botao_texto_txf){?>          <div class="mt-15">            <a target="_blank" class="btn-lands btn-primary" href="<?php echo gera_link($_smarty_tpl->tpl_vars['credito']->value->Botao_link_txf,true);?>
">              <?php echo $_smarty_tpl->tpl_vars['duvida']->value->Botao_texto_txf;?>
            </a>          </div>          <?php }?>        </div>      </div>    </div>  </div></section><?php }?><?php }} ?>