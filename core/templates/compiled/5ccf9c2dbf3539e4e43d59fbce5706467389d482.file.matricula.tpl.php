<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:55:05
         compiled from "core\templates\producao\abseg\site\email\matricula.tpl" */ ?>
<?php /*%%SmartyHeaderCode:262405f53df098127a0-30819958%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ccf9c2dbf3539e4e43d59fbce5706467389d482' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\email\\matricula.tpl',
      1 => 1599120502,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262405f53df098127a0-30819958',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'cliente' => 0,
    'campos' => 0,
    'nome' => 0,
    'campo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53df098fc310_82634797',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53df098fc310_82634797')) {function content_5f53df098fc310_82634797($_smarty_tpl) {?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'  'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'><head>  <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>  <title><?php echo $_smarty_tpl->tpl_vars['post']->value['Titulo_txf'];?>
 </title>  <style type='text/css'>    body {      color: #222222;    }    .fonte_tp_table {      font-size: 16px;      font-family: Arial, Helvetica, sans-serif;      color: #FFFFFF;    }    .fonte_campos {      font-family: Arial, Helvetica, sans-serif;      font-size: 14px;    }    .conteudo {      font-family: Arial, Helvetica, sans-serif;      font-size: 16px;    }  </style></head><body><div class="conteudo">  <p>    <?php if (($_smarty_tpl->tpl_vars['post']->value['Nome_txf']!='')){?>    Caro(a) <?php echo $_smarty_tpl->tpl_vars['post']->value['Nome_txf'];?>
,    <?php }else{ ?>    Caro(a),    <?php }?>    recebemos sua solicitação de simulação e em breve entraremos em contato com você!  </p>  <br/>  <hr>  Atenciosamente..<br/>  <strong><?php echo $_smarty_tpl->tpl_vars['cliente']->value->Fantasia_txf;?>
</strong>  <br/>  <br/></div><table width='100%' border='0' align='left' cellpadding='7' cellspacing='0'>  <tbody>  <tr>    <td colspan='2' bgcolor='#000000' style="color: #FFFFFF"><strong class='fonte_tp_table'>Dados Enviados </strong>    </td>  </tr>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Nome_txf']!='')){?>  <tr>    <td bgcolor='#FFFFFF' class='fonte_campos'>Nome do responsável:</td>    <td bgcolor='#FFFFFF' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Nome_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Email_txf']!='')){?>  <tr>    <td bgcolor='#F5f5f5' class='fonte_campos'>Email:</td>    <td bgcolor='#F5f5f5' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Email_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Telefone_txf']!='')){?>  <tr>    <td bgcolor='#FFFFFF' class='fonte_campos'>Telefone:</td>    <td bgcolor='#FFFFFF' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Telefone_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Cep_txf']!='')){?>  <tr>    <td bgcolor='#FFFFFF' class='fonte_campos'>CEP:</td>    <td bgcolor='#FFFFFF' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Cep_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Cpf_txf']!='')){?>  <tr>    <td bgcolor='#FFFFFF' class='fonte_campos'>CPF:</td>    <td bgcolor='#FFFFFF' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Cpf_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Estado_civil_txf']!='')){?>  <tr>    <td bgcolor='#F5f5f5' class='fonte_campos'>Estado civil:</td>    <td bgcolor='#F5f5f5' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Estado_civil_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Tipo_seguro_txf']!='')){?>  <tr>    <td bgcolor='#F5f5f5' class='fonte_campos'>Tipo do seguro:</td>    <td bgcolor='#F5f5f5' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Tipo_seguro_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Seguro_escolhido_txf']!='')){?>  <tr>    <td bgcolor='#F5f5f5' class='fonte_campos'>Seguro escolhido:</td>    <td bgcolor='#F5f5f5' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['post']->value['Seguro_escolhido_txf'];?>
</td>  </tr>  <?php }?>  <?php if (($_smarty_tpl->tpl_vars['post']->value['Campos_extras_jso']!='')){?>  <?php $_smarty_tpl->tpl_vars['campos'] = new Smarty_variable(json_decode($_smarty_tpl->tpl_vars['post']->value['Campos_extras_jso']), null, 0);?>  <?php if ($_smarty_tpl->tpl_vars['campos']->value){?>  <?php  $_smarty_tpl->tpl_vars['campo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['campo']->_loop = false;
 $_smarty_tpl->tpl_vars['nome'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['campos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['campo']->key => $_smarty_tpl->tpl_vars['campo']->value){
$_smarty_tpl->tpl_vars['campo']->_loop = true;
 $_smarty_tpl->tpl_vars['nome']->value = $_smarty_tpl->tpl_vars['campo']->key;
?>  <tr>    <td bgcolor='#F5f5f5' class='fonte_campos'><?php echo $_smarty_tpl->tpl_vars['nome']->value;?>
:</td>    <td bgcolor='#F5f5f5' class='conteudo'><?php echo $_smarty_tpl->tpl_vars['campo']->value;?>
</td>  </tr>  <?php } ?>  <?php }?>  <?php }?>  </tbody></table></body></html><?php }} ?>