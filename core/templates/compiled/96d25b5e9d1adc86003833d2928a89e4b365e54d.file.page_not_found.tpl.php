<?php /* Smarty version Smarty-3.1.12, created on 2020-12-10 21:32:35
         compiled from "core\templates\producao\zehimoveis\site\page_not_found.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216815fd2b013582e28-04431872%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '96d25b5e9d1adc86003833d2928a89e4b365e54d' => 
    array (
      0 => 'core\\templates\\producao\\zehimoveis\\site\\page_not_found.tpl',
      1 => 1604744248,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216815fd2b013582e28-04431872',
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
  'unifunc' => 'content_5fd2b013596400_83329981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fd2b013596400_83329981')) {function content_5fd2b013596400_83329981($_smarty_tpl) {?><main id="not-found">    <?php $_smarty_tpl->tpl_vars['titulo'] = new Smarty_variable('Oops...', null, 0);?>    <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/global/head_interna.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
    <div id="wrap" class="pt-60 pb-50">        <div class="container text-center">            <h2>Página "<?php echo $_smarty_tpl->tpl_vars['pagina_atual']->value;?>
" não encontrada</h2>            <section class="not-found">                <div class="row">                    <div class="col-lg-6 offset-lg-3">                        <div class="text-center">                            <img itemprop="image" class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
imagens/404.png">                        </div>                    </div>                </div>            </section>        </div>    </div></main><?php }} ?>