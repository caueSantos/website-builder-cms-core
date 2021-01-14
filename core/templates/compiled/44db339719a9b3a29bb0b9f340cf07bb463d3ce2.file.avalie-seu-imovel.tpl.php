<?php /* Smarty version Smarty-3.1.12, created on 2021-01-07 20:04:24
         compiled from "core\templates\producao\hubvet\site\avalie-seu-imovel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:327475ff78568cfcb09-56877196%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44db339719a9b3a29bb0b9f340cf07bb463d3ce2' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\avalie-seu-imovel.tpl',
      1 => 1604788602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '327475ff78568cfcb09-56877196',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'assets' => 0,
    'titulos' => 0,
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5ff78568d59780_14341451',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ff78568d59780_14341451')) {function content_5ff78568d59780_14341451($_smarty_tpl) {?><main id="avalie-imovel" itemprop="mainContentOfPage">  <div id="wrap">    <div class="bg-secondary head pt-50 pb-50 pt-lg-150 pb-lg-150">      <div class="pe-none bg-fake">        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/avaliar.png" class="img-fit"/>      </div>      <div class="container">        <div class="row justify-content-center">          <div class="col-lg-10">            <div class="title-group">              <h1 class="title text-white fz-48 fw-700 lh-12">                <?php echo titulo('avalie_imovel_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </h1>              <?php if (titulo('avalie_imovel_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>              <div class="texto fz-16 mt-20 lh-15 text-white">                <?php echo titulo('avalie_imovel_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </div>              <?php }?>            </div>          </div>        </div>      </div>    </div>    <div class="cotacao pt-50 pt-lg-60 pb-50 pb-lg-100">      <div class="container">        <div class="row justify-content-center">          <div class="col-lg-10">            <?php $_smarty_tpl->tpl_vars['tabela'] = new Smarty_variable('_avalie_imovel', null, 0);?>            <?php $_smarty_tpl->tpl_vars['tpl'] = new Smarty_variable('avalie-imovel', null, 0);?>            <?php $_smarty_tpl->tpl_vars['envia_email'] = new Smarty_variable('SIM', null, 0);?>            <?php $_smarty_tpl->tpl_vars['assunto'] = new Smarty_variable('Zeh Imóveis - Sua solicitação de avaliação foi enviada!', null, 0);?>            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cotacao/form_cotacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </div></main><?php }} ?>