<?php /* Smarty version Smarty-3.1.12, created on 2021-02-02 00:29:38
         compiled from "core\templates\producao\hubvet\site\blocos\trabalhe-conosco\form_trabalhe_conosco.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204596018b9120c6476-80732386%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3ddea108f52b62aac80ad539e86df38508f39f6' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\trabalhe-conosco\\form_trabalhe_conosco.tpl',
      1 => 1584564590,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204596018b9120c6476-80732386',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'emails' => 0,
    'email' => 0,
    'vaga' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_6018b9120f7517_53664305',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6018b9120f7517_53664305')) {function content_6018b9120f7517_53664305($_smarty_tpl) {?><form id="form-curriculo" class="dropzone" action="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
post/curriculo" method="post" enctype="multipart/form-data">    <?php if ((isset($_smarty_tpl->tpl_vars['emails']->value))){?>    <?php if ((count($_smarty_tpl->tpl_vars['emails']->value)>1)){?>    <div class="form-group">        <select   class="form-2" tabindex="0" name="Departamento_sel"  size="1">            <?php  $_smarty_tpl->tpl_vars['email'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['email']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
?>            <option value="<?php echo $_smarty_tpl->tpl_vars['email']->value->Departamento_sel;?>
" <?php if ((strtolower($_smarty_tpl->tpl_vars['email']->value->Departamento_sel)=='contato')){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['email']->value->Descricao_txf;?>
 (<?php echo $_smarty_tpl->tpl_vars['email']->value->Email_txf;?>
)</option>            <?php } ?>        </select>    </div>    <?php }else{ ?>    <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
" />    <?php }?>    <?php }else{ ?>    <input name="Destinatario_txf" type="hidden" value="bruna.branco@landsdigital.com.br" />    <?php }?>    <div class="form-group">        <input name="Nome_txf" type="text" placeholder="Nome" class="form-2" id="nome" required >    </div>    <div class="form-group">        <input name="Email_txf" type="email" class="form-2" placeholder="Email" id="email" required >    </div>    <div class="form-group">        <input name="Vaga_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_tit;?>
">    </div>    <div class="form-group">        <input name="Telefone_txf" type="text" class="form-2 tel" placeholder="Telefone" required >    </div>    <input id="lands_id" value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden" />     <input id="pasta" value="painel" name="pasta" type="hidden" />    <div class="dropzone-previews" id="dz-clickable">        <div class="dz-message needsclick">Arraste o arquivo aqui ou clique para enviar.</div>    </div>    <div class="fallback">        <input type="file" multiple />    </div>    <div class="text-center">        <button type="submit" class="btn btn-x btn-block">Candidatar-se à vaga</button>    </div></form><link rel="stylesheet" type="text/css" href="plugins/dropzone/dropzone.css"> <script src="plugins/dropzone/dropzone.js"></script><script>        Dropzone.autoDiscover = false;    $(document).ready(function() {                var formDropzone;        $("#form-curriculo").dropzone({            autoProcessQueue: false,            uploadMultiple: false,            addRemoveLinks: true,            acceptedFiles: "application/msword, application/pdf",            paramName: "userfile",            clickable: "#dz-clickable",            previewsContainer: "#dz-clickable",            dictRemoveFile: "Remover",            dictCancelUpload: "Cancelar",            init: function() {                formDropzone = this;                formDropzone.on('addedfile', function() {                    if (formDropzone.files.length > 0) {                        $("#form").addClass('dz-started');                    }                });                formDropzone.on('removedfile', function() {                    if (formDropzone.files.length === 0) {                        $("#form").removeClass('dz-started');                    }                });                formDropzone.on("complete", function(file) {                    formDropzone.removeAllFiles(true);                });            },            success: function(data) {                var data = data.xhr.response;                var message = $('<div>').html(data).find("#message").text();                $('#form-curriculo')[0].reset();                $("#btn-enviar").text("Enviar").removeAttr("disabled");                swal("", message, "success");            },            error: function(data) {                $('#form-curriculo')[0].reset();                $("#btn-enviar").text("Enviar").removeAttr("disabled");                swal("Falha ao enviar!", "", "error");            }        });        $("#form-curriculo").submit(function(event) {            event.preventDefault();            event.stopPropagation();            if(!formDropzone.files[0]){                swal("Atenção", "Você deve enviar um arquivo!", "error");                return false;            }            $("#btn-enviar").text('Enviando...').attr("disabled", true);            formDropzone.processQueue();        });    });</script><?php }} ?>