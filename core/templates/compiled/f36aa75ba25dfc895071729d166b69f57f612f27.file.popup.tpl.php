<?php /* Smarty version Smarty-3.1.12, created on 2020-10-12 17:15:04
         compiled from "core\templates\producao\diagnostico\site\componentes\popup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178375f84b94896ac68-67321937%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f36aa75ba25dfc895071729d166b69f57f612f27' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\componentes\\popup.tpl',
      1 => 1584563994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178375f84b94896ac68-67321937',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'popup' => 0,
    'alerta' => 0,
    'app' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f84b9489cb551_04794037',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f84b9489cb551_04794037')) {function content_5f84b9489cb551_04794037($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['alerta'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['alerta']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['popup']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['alerta']->key => $_smarty_tpl->tpl_vars['alerta']->value){
$_smarty_tpl->tpl_vars['alerta']->_loop = true;
?>
    <?php if ($_smarty_tpl->tpl_vars['alerta']->value->Tipo_sel=='IMAGEM'){?>
        <div class="modal fade" id="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
" tabindex="-1" role="dialog" aria-labelledby="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="popup-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body <?php if ($_smarty_tpl->tpl_vars['alerta']->value->Tipo_sel=='IMAGEM'){?>p-0<?php }?>">
                        <img class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Imagens[0]->Caminho_txf;?>
" />
                    </div>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <div class="modal fade" id="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
" tabindex="-1" role="dialog" aria-labelledby="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <?php if (strlen($_smarty_tpl->tpl_vars['alerta']->value->Titulo_txf)>0){?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
-label"><?php echo $_smarty_tpl->tpl_vars['alerta']->value->Titulo_txf;?>
</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php }?>
                    <div class="modal-body <?php if ($_smarty_tpl->tpl_vars['alerta']->value->Tipo_sel=='IMAGEM'){?>p-0<?php }?>">
                        <?php if ($_smarty_tpl->tpl_vars['alerta']->value->Tipo_sel!='IMAGEM'){?>
                            <?php $_smarty_tpl->createLocalArrayVariable('config', null, 0);
$_smarty_tpl->tpl_vars['config']->value['img_classe'] = '';?> 
                            <?php $_smarty_tpl->createLocalArrayVariable('config', null, 0);
$_smarty_tpl->tpl_vars['config']->value['img_fora'] = 'text-center';?>
                            <?php $_smarty_tpl->createLocalArrayVariable('config', null, 0);
$_smarty_tpl->tpl_vars['config']->value['img_style'] = 'width: auto;';?>
                            <?php $_smarty_tpl->createLocalArrayVariable('config', null, 0);
$_smarty_tpl->tpl_vars['config']->value['vid_fora'] = 'text-center';?>
                            <?php $_smarty_tpl->createLocalArrayVariable('config', null, 0);
$_smarty_tpl->tpl_vars['config']->value['vid_style'] = 'width:100%;height:400px;';?>
                            <?php $_smarty_tpl->createLocalArrayVariable('config', null, 0);
$_smarty_tpl->tpl_vars['config']->value['tipo_nota'] = 'popover';?>
                            <div class="texto"><?php echo cria_tags($_smarty_tpl->tpl_vars['alerta']->value->Texto_txa,$_smarty_tpl->tpl_vars['config']->value,$_smarty_tpl->tpl_vars['alerta']->value->Imagens);?>
</div>
                        <?php }else{ ?>
                            <img class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Imagens[0]->Caminho_txf;?>
" />
                        <?php }?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>  
                </div>
            </div>
        </div>
    <?php }?>
    <script>
        <?php if ($_smarty_tpl->tpl_vars['alerta']->value->Exibir_ao_sair_sel=='SIM'){?>
            $(document).on("mouseout", function(e) {
                e = e ? e : window.event;
                var from = e.relatedTarget || e.toElement;
                if (!from || from.nodeName == "HTML") {
                    $popup = $('#popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
');
                    if (e.clientY < 0 && !$popup.data('showed')) {
                        $('#popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
').modal('show');
                        $popup.data('showed', true);
                    }
                }
            });
        <?php }else{ ?>
            $(document).ready(function () {
                setTimeout(function () {
                    $('#popup-<?php echo $_smarty_tpl->tpl_vars['alerta']->value->Id_int;?>
').modal('show');
                }, <?php echo intval($_smarty_tpl->tpl_vars['alerta']->value->Delay_txf)*1000;?>
);
            });
        <?php }?>
    </script>
<?php } ?><?php }} ?>