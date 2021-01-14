<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 10:03:38
         compiled from "core\templates\producao\abseg\site\ajax\orientacoes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:285785f50e9aad43d43-48198132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd94b4a649cf117d1d6f03eeb0cfa5e41033b8876' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\ajax\\orientacoes.tpl',
      1 => 1599130023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285785f50e9aad43d43-48198132',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'orientacoes' => 0,
    'item' => 0,
    'fundo' => 0,
    'painel' => 0,
    'assets' => 0,
    'icone' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e9aad830a3_87401786',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e9aad830a3_87401786')) {function content_5f50e9aad830a3_87401786($_smarty_tpl) {?><div id="orientacoes-ajax">  <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orientacoes']->value->registros; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>  <?php if ($_smarty_tpl->tpl_vars['item']->value->Texto_txa){?>  <div class="row">    <div class="col-12">      <div        class="orientacao d-block text-center bg-primary text-white br-1        overflow-hidden mb-30 pt-70 pb-60 pl-50        pr-50 pl-md-120 pr-md-120">        <?php $_smarty_tpl->tpl_vars['fundo'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['item']->value->Imagens,'Campo_sel','=','Imagem_fundo_ico'), null, 0);?>        <div class="bg-fake">          <?php if ($_smarty_tpl->tpl_vars['fundo']->value[0]){?>          <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['fundo']->value[0]->Caminho_txf;?>
"/>          <?php }else{ ?>          <img class="img-fit" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/caminhao.jpg"/>          <?php }?>        </div>        <div          class="bg-fake"          style="background: linear-gradient(110deg, rgba(255, 27, 69, .9) 50%, rgba(255, 27, 69, .2) 100%);"        ></div>        <div          class="bg-fake"          style="background: linear-gradient(330deg, rgba(255, 27, 69, .7) 00%, rgba(255, 27, 69, 0) 40%);"        ></div>        <div          class="bg-fake"          style="background: linear-gradient(360deg, rgba(255, 27, 69, 1) 0%, rgba(255, 27, 69, 0) 100%);"        ></div>        <?php $_smarty_tpl->tpl_vars['icone'] = new Smarty_variable(get_object($_smarty_tpl->tpl_vars['item']->value->Imagens,'Campo_sel','=','Icone_ico'), null, 0);?>        <?php if ($_smarty_tpl->tpl_vars['icone']->value[0]){?>        <figure class="imagem mb-30" style="height: 80px">          <img            style="width: auto; height: auto; max-width: 100%; max-height: 100%"            alt="<?php echo strip_tags($_smarty_tpl->tpl_vars['item']->value->Titulo_txa);?>
"            src="<?php echo $_smarty_tpl->tpl_vars['painel']->value;?>
<?php echo $_smarty_tpl->tpl_vars['icone']->value[0]->Caminho_txf;?>
"          />        </figure>        <?php }?>        <div class="title fz-22"><?php echo $_smarty_tpl->tpl_vars['item']->value->Titulo_txa;?>
</div>        <div class="desc fz-14"><?php echo $_smarty_tpl->tpl_vars['item']->value->Dica_txf;?>
</div>        <div          id="orientacao-<?php echo $_smarty_tpl->tpl_vars['item']->value->Id_int;?>
"          class="texto collapse"        >          <div class="pt-30">            <?php echo $_smarty_tpl->tpl_vars['item']->value->Texto_txa;?>
          </div>        </div>        <div class="botao mt-20">          <div            data-toggle="collapse"            data-target="#orientacao-<?php echo $_smarty_tpl->tpl_vars['item']->value->Id_int;?>
"            class="btn-lands btn-white btn-sm br-1 tt-upper">            Acessar orientações          </div>        </div>      </div>    </div>  </div>  <?php }?>  <?php } ?>  <?php $_smarty_tpl->tpl_vars['paginacao'] = new Smarty_variable($_smarty_tpl->tpl_vars['orientacoes']->value->paginacao, null, 0);?>  <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/paginacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>