<?php /* Smarty version Smarty-3.1.12, created on 2020-09-05 15:55:06
         compiled from "core\templates\producao\abseg\site\ajax\mensagens.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216895f53df0a6c6e53-58498812%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d33c75df9f99a1e3426ee0aa91b4c216b3e553e' => 
    array (
      0 => 'core\\templates\\producao\\abseg\\site\\ajax\\mensagens.tpl',
      1 => 1595623808,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216895f53df0a6c6e53-58498812',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'mensagem' => 0,
    'post' => 0,
    'lead_inserido' => 0,
    'registros' => 0,
    'requisicao' => 0,
    'app' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5f53df0a8b0143_25403592',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f53df0a8b0143_25403592')) {function content_5f53df0a8b0143_25403592($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['mensagem']->value=='lead_inserido'&&$_smarty_tpl->tpl_vars['post']->value['Tipo_lead_txf']=='simulacao'){?>        <?php echo json_encode($_smarty_tpl->tpl_vars['lead_inserido']->value);?>
<?php }else{ ?><div class="resposta" style="margin-top:10px;">    <?php if (($_smarty_tpl->tpl_vars['mensagem']->value=='contato_ok')){?>        <script type="text/javascript" charset="utf-8">          setTimeout(function () {            swal( { title: "", text: "Contato enviado com sucesso.", type: "success" } );          }, 10);        </script>    <?php }?>    <?php if (($_smarty_tpl->tpl_vars['mensagem']->value=='contato_erro')){?>        <script type="text/javascript" charset="utf-8">          setTimeout(function () {            swal( { title: "", text: "Erro ao enviar contato.", type: "error" } );          }, 10);        </script>    <?php }?>        <?php if ($_smarty_tpl->tpl_vars['mensagem']->value=='lead_atualiza_inserido'&&$_smarty_tpl->tpl_vars['post']->value['Tipo_lead_txf']=='simulacao'){?>        <script type="text/javascript" charset="utf-8">                setTimeout(function () {                        swal( { title: "", text: "Simulação solicitada com sucesso!", type: "success" } );                }, 10);        </script>        <?php }elseif($_smarty_tpl->tpl_vars['mensagem']->value=='lead_inserido'&&$_smarty_tpl->tpl_vars['post']->value['Tipo_lead_txf']=='matricula'){?>            <script type="text/javascript" charset="utf-8">              setTimeout(function () {                swal({ title: "", text: "Matrícula enviada com sucesso!", type: "success" });              }, 10);            </script>    <?php }elseif(($_smarty_tpl->tpl_vars['mensagem']->value=='lead_inserido')){?>        <div class="text-center">            <?php if ($_smarty_tpl->tpl_vars['registros']->value){?>                <p>Para baixar o(s) arquivo(s) acesse o email <?php echo $_smarty_tpl->tpl_vars['requisicao']->value['Email_txf'];?>
<?php echo $_smarty_tpl->tpl_vars['requisicao']->value->Email_txf;?>
.</p>                <br>                <p>Obrigado</p>                                <!--                <p style="font-style: italic">* Todos os links foram enviados para seu email.</p>-->            <?php }else{ ?>                <p>Infelizmente, este arquivo não está disponível..</p>                <br>                <p> Assim que estiver pronto, entraremos em contato! </p>            <?php }?>            <br>        </div>        <script type="text/javascript" charset="utf-8">          setTimeout(function () {            swal( { title: "", text: "Arquivo enviado com sucesso para seu email!", type: "success" } );          }, 10);          //            setTimeout(function () {          //    location.href="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
";          //}, 2000);        </script>    <?php }?>    <?php if (($_smarty_tpl->tpl_vars['mensagem']->value=='lead_erro')){?>        <script type="text/javascript" charset="utf-8">          setTimeout(function () {            swal( { title: "", text: "Erro ao enviar, tente novamente", type: "error" } );          }, 10);        </script>    <?php }?></div><?php }?><?php }} ?>