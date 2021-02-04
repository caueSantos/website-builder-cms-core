<?php /* Smarty version Smarty-3.1.12, created on 2021-02-04 01:00:47
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31050601b635fe51b30-99867704%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18f309ebc789d28fa8579d41d0b66e6fd89f43a9' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\lista.tpl',
      1 => 1612238569,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31050601b635fe51b30-99867704',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'titulos' => 0,
    'vagas' => 0,
    'app' => 0,
    'vaga' => 0,
    'painel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b635fe839f1_45527418',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b635fe839f1_45527418')) {function content_601b635fe839f1_45527418($_smarty_tpl) {?><div id="lista-vagas" class="lista-vagas pt-50 pt-md-70 pb-50 pb-md-80">  <div class="container-fluid pl-0 pr-0">    <div class="row justify-content-center">      <div class="col-md-6">        <div class="title-group text-center mb-30">          <h1 class="title text-primary fz-36 fw-400 lh-12">            <?php echo titulo('carreira_vagas','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </h1>          <?php if (titulo('carreira_vagas','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>          <div class="texto fz-16 mt-20 lh-15">            <?php echo titulo('carreira_vagas','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
          </div>          <?php }?>        </div>      </div>    </div>    <div class="row no-gutters bg-dark-grey">      <?php if ($_smarty_tpl->tpl_vars['vagas']->value[0]){?>      <?php  $_smarty_tpl->tpl_vars['vaga'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vaga']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['vagas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vaga']->key => $_smarty_tpl->tpl_vars['vaga']->value){
$_smarty_tpl->tpl_vars['vaga']->_loop = true;
?>      <div class="col-12 col-md-4 col-carreira overflow-hidden">        <a          href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
carreira/<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_url;?>
"          class="d-block text-white bg-primary carreira-item hover hover-scale-up hover-opacity cursor-pointer"        >          <?php if ($_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]){?>          <div class="bg-fake">            <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Imagens[0]->Caminho_txf;?>
"/>          </div>          <?php }?>          <div class="overlay bg-fake"></div>          <div class="txt pl-40 pr-40 pb-30 pt-30 pb-md-70 pt-md-50">            <div class="vaga-prefixo fz-26 fw-300 title lh-1">              <?php echo trans('vaga_de');?>
            </div>            <div class="vaga-nome fz-26 fw-700 title">              <?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_tit;?>
            </div>            <div class="inscrever fz-14 mt-10">              <?php echo trans('canditatar_vaga');?>
            </div>          </div>        </a>      </div>      <?php } ?>      <?php }else{ ?>      <div class="col-12 pl-15 pr-15 pt-50 pb-50 pt-md-100 pb-md-100 text-center">        <div class="fz-22 text-white fw-700 title">          <?php echo trans('sem_vagas');?>
        </div>        <div class="pl-30 pr-30 pt-30">          <a class="btn-lands btn-lg btn-primary pl-60 pr-60 text-white">            <?php echo trans('cadastre_curriculo');?>
          </a>        </div>      </div>      <?php }?>    </div>    <?php if ($_smarty_tpl->tpl_vars['vagas']->value[0]){?>    <div class="row justify-content-center mt-60">      <div class="col-12 col-md-auto">        <div>          <a class="btn-lands btn-lg btn-primary pl-60 pr-60 text-white" onclick="alert('modal curriculo')">            <?php echo trans('ou_cadastre_curriculo');?>
          </a>        </div>      </div>    </div>    <?php }?>  </div></div><?php }} ?>