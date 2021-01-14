<?php /* Smarty version Smarty-3.1.12, created on 2020-09-03 09:57:34
         compiled from "core\templates\producao\abseg\site\blocos\servicos\modal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162045f50e83e606792-03561904%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b111569be78d230d316f4b24db88fc04daa045ea' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\blocos\\servicos\\modal.tpl',
      1 => 1592237732,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162045f50e83e606792-03561904',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'CAMINHO_TPL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f50e83e60c966_42743855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f50e83e60c966_42743855')) {function content_5f50e83e60c966_42743855($_smarty_tpl) {?><!-- Modal --><div id="modal-global" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">    <div class="modal-dialog container" role="document">        <div class="row justify-content-center">            <div class="col-lg-8">                <div class="modal-content">                    <div class="modal-header">                        <h5 class="modal-title pl-30 pr-30">                            <div id="titulo" class="fw-600 tit text-primary"></div>                        </h5>                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">                            <span aria-hidden="true">&times;</span>                        </button>                    </div>                    <div class="modal-body">                        <div id="texto" class="text-body-secondary pt-30 pb-30 pl-30 pr-30"></div>                    </div>                    <div class="modal-footer">                        <button type="button" class="btn-lands btn-outline" data-dismiss="modal">                            Fechar                        </button>                    </div>                </div>            </div>        </div>    </div></div><!-- Modal Orçamentos --><div id="modal-orcamento" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">    <div class="modal-dialog container" role="document">        <div class="row justify-content-center">            <div class="col-lg-6 col-md-12">                <div class="modal-content">                    <div class="modal-header">                        <h5 class="modal-title pl-30 pr-30">                            <div class="titulo fw-600 tit text-primary"></div>                        </h5>                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">                            <span aria-hidden="true">&times;</span>                        </button>                    </div>                    <div class="modal-body pl-60 pr-60 pt-40 pb-50">                        <?php echo $_smarty_tpl->getSubTemplate (($_smarty_tpl->tpl_vars['CAMINHO_TPL']->value).('blocos/servicos/form_orcamento.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
                    </div>                </div>            </div>        </div>    </div></div><?php }} ?>