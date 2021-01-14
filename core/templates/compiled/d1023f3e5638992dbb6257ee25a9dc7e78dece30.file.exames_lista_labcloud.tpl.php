<?php /* Smarty version Smarty-3.1.12, created on 2020-09-14 02:38:16
         compiled from "core\templates\producao\diagnostico\site\blocos\exames\exames_lista_labcloud.tpl" */ ?>
<?php /*%%SmartyHeaderCode:615f5f01c8707fc5-67750666%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1023f3e5638992dbb6257ee25a9dc7e78dece30' => 
    array (
      0 => 'core\\templates\\producao\\diagnostico\\site\\blocos\\exames\\exames_lista_labcloud.tpl',
      1 => 1584564049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '615f5f01c8707fc5-67750666',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'todas_categorias' => 0,
    'categoria' => 0,
    'segment2' => 0,
    'exames' => 0,
    'exame' => 0,
    'ci_session' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f5f01c874c4a9_88768646',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f5f01c874c4a9_88768646')) {function content_5f5f01c874c4a9_88768646($_smarty_tpl) {?><div class="tit-rep">Exames Oferecidos <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['todas_categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value){
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['categoria']->value->Nome_url==$_smarty_tpl->tpl_vars['segment2']->value){?>[<?php echo $_smarty_tpl->tpl_vars['categoria']->value->Nome_tit;?>
]<?php }?><?php } ?></div>

<div class="lista_exames">

    <input type="text" placeholder="Buscar exames.." class="form-control" id="contact-list-search">

    <div  id="lista-exames">



        <?php  $_smarty_tpl->tpl_vars['exame'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['exame']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['exames']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['exame']->key => $_smarty_tpl->tpl_vars['exame']->value){
$_smarty_tpl->tpl_vars['exame']->_loop = true;
?>
            <?php if (!$_smarty_tpl->tpl_vars['segment2']->value||$_smarty_tpl->tpl_vars['segment2']->value==$_smarty_tpl->tpl_vars['exame']->value->Categoria->Nome_url){?>

                <div class="list-group-item">

                    <div class="row">

                        <div class="col-md-10">

                            <li class="name"><b>Exame: </b><?php echo $_smarty_tpl->tpl_vars['exame']->value->Nome_tit;?>
</li>

                            <li class="name"><b>Amostra:</b> <?php echo $_smarty_tpl->tpl_vars['exame']->value->Amostra_txf;?>
 <?php if ($_smarty_tpl->tpl_vars['exame']->value->Qtde_txf){?>(<?php echo $_smarty_tpl->tpl_vars['exame']->value->Qtde_txf;?>
)<?php }?></li>
                            <li class="name"><b>Categoria:</b> <?php echo $_smarty_tpl->tpl_vars['exame']->value->Categoria->Nome_tit;?>
</li>

                            <li class=""><b>Prazo:</b> <?php echo $_smarty_tpl->tpl_vars['exame']->value->Prazo_txf;?>
</li>

                            <?php if ((isset($_smarty_tpl->tpl_vars['ci_session']->value['usuario']))){?>

                                <li class="">

                                    <b>Valor:</b><?php if (($_smarty_tpl->tpl_vars['exame']->value->Valor_txf!='')){?> R$<?php }?> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['exame']->value->Valor_txf)===null||$tmp==='' ? 'consultar' : $tmp);?>


                                </li>

                            <?php }else{ ?>

                                <li class="">
                                    <b>Valor:</b> 


<!--                                    <a class="restrito"  title="Faça login ou cadastre-se para ter ver os valores" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
restrita">Restrito</a>-->
                                    <span class="restrito">*Acesse a  <a target="_blank" href="https://plataforma.labcloud.com.br/login/login_lab/diagnostico">plataforma</a> para consultar os valores</span>

                                </li>

                            <?php }?>



                        </div>

                        <div class="col-md-2">
                            <?php if ($_smarty_tpl->tpl_vars['exame']->value->Arquivos[0]){?>
                                <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
<?php echo $_smarty_tpl->tpl_vars['exame']->value->Arquivos[0]->Caminho_txf;?>
" style="color:#222"><i style="color:#CC0033" class="fa fa-file-pdf-o  "> </i> Baixar</a>
                            <?php }?>
                        </div>

                    </div>

                </div>
            <?php }?>

        <?php } ?>

    </div>

</div><?php }} ?>