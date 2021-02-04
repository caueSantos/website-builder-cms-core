<?php /* Smarty version Smarty-3.1.12, created on 2021-02-03 02:21:33
         compiled from "core\templates\padrao\forms\curriculo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21405601a24cdafcb38-61237390%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '923e14ce132115b08437f05b7f81151edf914101' => 
    array (
      0 => 'core\\templates\\padrao\\forms\\curriculo.tpl',
      1 => 1560985050,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21405601a24cdafcb38-61237390',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'dados_email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601a24cdb5a050_57690800',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601a24cdb5a050_57690800')) {function content_601a24cdb5a050_57690800($_smarty_tpl) {?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>NOVO CURRÍCULO - <?php echo $_smarty_tpl->tpl_vars['app']->value->Nome_app_txf;?>
 </title>
        <style type='text/css'>
            body {
                color: #1B5281;
            }
            .fonte_tp_table {
                font-size: 18px;
                font-family: Arial, Helvetica, sans-serif;
                color: #FFFFFF; 
            }
            .fonte_campos {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
            }
            .conteudo {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }

        </style>
    </head>

    <body>

        <table width='100%' border='0' align='left' cellpadding='7' cellspacing='0'>
            <tbody>
                <tr> 
                    <td colspan='2' bgcolor='#1B5281' style="color: #FFFFFF" ><strong class='fonte_tp_table'>NOVO CURRÍCULO - <?php echo $_smarty_tpl->tpl_vars['app']->value->Nome_app_txf;?>
   -  <?php echo date("d/m/Y");?>
  </strong></td>
                </tr>
                <?php if ($_smarty_tpl->tpl_vars['dados_email']->value->Nome_txf){?> 
                    <tr>
                        <td  bgcolor='#FFFFFF' class='fonte_campos'>Nome:</td>
                        <td  bgcolor='#FFFFFF' class='conteudo' style='font-size: 14px'><?php echo $_smarty_tpl->tpl_vars['dados_email']->value->Nome_txf;?>
</td>
                    </tr>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['dados_email']->value->Email_txf){?> 
                    <tr>
                        <td  bgcolor='#EDF5FC' class='fonte_campos'>Email:</td>
                        <td  bgcolor='#EDF5FC' class='conteudo' style='font-size: 14px'><?php echo $_smarty_tpl->tpl_vars['dados_email']->value->Email_txf;?>
</td>
                    </tr>
                <?php }?>  

                <?php if ($_smarty_tpl->tpl_vars['dados_email']->value->Telefone_txf){?>
                    <tr>
                        <td  bgcolor='#FFFFFF' class='fonte_campos'>Telefone:</td>
                        <td  bgcolor='#FFFFFF' class='conteudo' style='font-size: 14px'><?php echo $_smarty_tpl->tpl_vars['dados_email']->value->Telefone_txf;?>
</td>
                    </tr>
                <?php }?>


                <?php if ($_smarty_tpl->tpl_vars['dados_email']->value->Vaga_txf){?>    
                    <tr>
                        <td  bgcolor='#EDF5FC' class='fonte_campos'>Vaga:</td>
                        <td  bgcolor='#EDF5FC' class='conteudo' style='font-size: 14px'><?php echo $_smarty_tpl->tpl_vars['dados_email']->value->Vaga_txf;?>
</td>
                    </tr>
                <?php }?>

                <?php if (($_smarty_tpl->tpl_vars['dados_email']->value->Arquivo_txf)){?> 
                    <tr>
                        <td  bgcolor='#FFFFFF' class='fonte_campos'>Arquivo:</td>
                        <td  bgcolor='#FFFFFF' class='conteudo' style='font-size: 14px'><a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
<?php echo $_smarty_tpl->tpl_vars['app']->value->Pasta_painel;?>
/<?php echo $_smarty_tpl->tpl_vars['dados_email']->value->Arquivo_txf;?>
"><?php echo $_smarty_tpl->tpl_vars['dados_email']->value->Arquivo_nome_txf;?>
</a></td>
                    </tr>
                <?php }?>  
                <tr> 
                    <td colspan='2' bgcolor='#1B5281' style="color: #FFFFFF"><strong class='fonte_tp_table'></strong></td>
                </tr>
            </tbody>
        </table>
        <br>
            <br>

                <h4>Você pode visualizá-lo a qualquer hora acessando o painel de controle! <a target="_blank" href="http://painel.landsdigital.com.br" >http://painel.landsdigital.com.br</a></h4>
                </body>
</html>       

<?php }} ?>