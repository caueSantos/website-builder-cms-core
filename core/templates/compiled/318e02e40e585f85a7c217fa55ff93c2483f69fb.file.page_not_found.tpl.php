<?php /* Smarty version Smarty-3.1.12, created on 2020-10-22 01:41:51
         compiled from "core\templates\producao\vet_diagnosticos\site\page_not_found.tpl" */ ?>
<?php /*%%SmartyHeaderCode:305445f90ff7fa49819-39058807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '318e02e40e585f85a7c217fa55ff93c2483f69fb' => 
    array (
      0 => 'core\\templates\\producao\\vet_diagnosticos\\site\\page_not_found.tpl',
      1 => 1591645236,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '305445f90ff7fa49819-39058807',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
    'pagina_atual' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f90ff7fa61e41_92978414',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f90ff7fa61e41_92978414')) {function content_5f90ff7fa61e41_92978414($_smarty_tpl) {?><main id="not-found">    <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable('Oops...', null, 0);?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <div id="wrap" class="pt-60 pb-50">        <div class="container text-center">            <h2>Página "<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
" não encontrada</h2>            <section class="not-found">                <div class="row">                    <div class="col-md-6 offset-md-3">                        <div class="text-center">                            <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/404.png">                        </div>                    </div>                </div>            </section>        </div>    </div></main><?php }} ?>