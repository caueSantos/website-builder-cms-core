<?php /* Smarty version Smarty-3.1.12, created on 2020-11-07 05:01:32
         compiled from "core\templates\producao\zehimoveis\site\cadastre-seu-imovel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172365fa6464c5e8a66-39689699%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5615f0b42b6fe4531b3ccac8dcedec0936f3d032' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\cadastre-seu-imovel.tpl',
      1 => 1604375743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172365fa6464c5e8a66-39689699',
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
  'unifunc' => 'content_5fa6464c60a607_89551015',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fa6464c60a607_89551015')) {function content_5fa6464c60a607_89551015($_smarty_tpl) {?><main id="avalie-imovel" itemprop="mainContentOfPage">  <div id="wrap">    <div class="head pt-50 pb-50 pt-md-150 pb-md-150">      <div class="pe-none bg-fake">        <img src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/anunciar.png" class="img-fit"/>      </div>      <div class="container">        <div class="row justify-content-center">          <div class="col-lg-10">            <div class="title-group">              <h1 class="title text-white fz-48 fw-700 lh-12">                <?php echo titulo('cadastre_imovel_interna','tit',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </h1>              <?php if (titulo('cadastre_imovel_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value)){?>              <div class="texto fz-16 mt-20 lh-15 text-white">                <?php echo titulo('cadastre_imovel_interna','sub',$_smarty_tpl->tpl_vars['titulos']->value);?>
              </div>              <?php }?>            </div>          </div>        </div>      </div>    </div>    <div class="cotacao pt-50 pt-md-60 pb-50 pb-md-100">      <div class="container">        <div class="row justify-content-center">          <div class="col-md-10">            <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/cotacao/form_cotacao.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
          </div>        </div>      </div>    </div>  </div></main><?php }} ?>