<?php /* Smarty version Smarty-3.1.12, created on 2021-02-03 23:58:05
         compiled from "core\templates\producao\hubvet\site\blocos\carreira\form_trabalhe_conosco.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16902601b54ad6d2e66-54640636%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d84072692de6ec675063ed0bee154f7a07742ca' => 
    array (
      0 => 'core\\templates\\producao\\hubvet\\site\\blocos\\carreira\\form_trabalhe_conosco.tpl',
      1 => 1612324291,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16902601b54ad6d2e66-54640636',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'app' => 0,
    'emails' => 0,
    'email' => 0,
    'vaga' => 0,
    'assets' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_601b54ad708441_02506099',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_601b54ad708441_02506099')) {function content_601b54ad708441_02506099($_smarty_tpl) {?><form id="form-curriculo" class="dropzone" action="<?php echo $_smarty_tpl->tpl_vars['app']->value->Url_cliente;?>
post/curriculo" method="post"      enctype="multipart/form-data">  <?php if ((isset($_smarty_tpl->tpl_vars['emails']->value))){?>  <?php if ((count($_smarty_tpl->tpl_vars['emails']->value)>1)){?>  <div class="form-lands-group">    <select class="form-lands" tabindex="0" name="Departamento_sel" size="1">      <?php  $_smarty_tpl->tpl_vars['email'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['email']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['emails']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['email']->key => $_smarty_tpl->tpl_vars['email']->value){
$_smarty_tpl->tpl_vars['email']->_loop = true;
?>      <option value="<?php echo $_smarty_tpl->tpl_vars['email']->value->Departamento_sel;?>
" <?php if ((strtolower($_smarty_tpl->tpl_vars['email']->value->Departamento_sel)=='contato')){?>        selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['email']->value->Descricao_txf;?>
 (<?php echo $_smarty_tpl->tpl_vars['email']->value->Email_txf;?>
)      </option>      <?php } ?>    </select>  </div>  <?php }else{ ?>  <input name="Destinatario_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['emails']->value[0]->Email_txf;?>
"/>  <?php }?>  <?php }else{ ?>  <input name="Destinatario_txf" type="hidden" value="bruna.branco@landsdigital.com.br"/>  <?php }?>  <div class="form-lands-group">    <input name="Nome_txf" type="text" placeholder="Nome" class="form-lands" id="nome" required>  </div>  <div class="form-lands-group">    <input name="Email_txf" type="email" class="form-lands" placeholder="Email" id="email" required>  </div>  <div class="form-lands-group">    <input name="Telefone_txf" type="text" class="form-lands phone-mask" placeholder="Telefone" required>  </div>  <div class="dropzone-previews" id="dz-clickable">    <div class="dz-message needsclick">Arraste o arquivo aqui ou clique para enviar.</div>  </div>  <div class="fallback">    <input type="file" multiple/>  </div>  <input id="lands_id" value="<?php echo $_smarty_tpl->tpl_vars['app']->value->Lands_id;?>
" name="Lands_id" type="hidden"/>  <input name="Vaga_txf" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['vaga']->value->Nome_tit;?>
">  <input id="pasta" value="painel" name="pasta" type="hidden"/>  <div class="text-center">    <button type="submit" class="btn-lands btn-primary btn-block btn-lg">     <?php echo trans('candidatar_vaga');?>
    </button>  </div></form><link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/dropzone/dropzone.css"><script src="<?php echo $_smarty_tpl->tpl_vars['assets']->value;?>
plugins/dropzone/dropzone.js"></script><script>  Dropzone.autoDiscover = false;  $(document).ready(function () {    var formDropzone;    $("#form-curriculo").dropzone({      autoProcessQueue: false,      uploadMultiple: false,      addRemoveLinks: true,      acceptedFiles: "application/msword, application/pdf",      paramName: "userfile",      clickable: "#dz-clickable",      previewsContainer: "#dz-clickable",      dictRemoveFile: "Remover",      dictCancelUpload: "Cancelar",      init: function () {        formDropzone = this;        formDropzone.on('addedfile', function () {          if (formDropzone.files.length > 0) {            $("#form").addClass('dz-started');          }        });        formDropzone.on('removedfile', function () {          if (formDropzone.files.length === 0) {            $("#form").removeClass('dz-started');          }        });        formDropzone.on("complete", function (file) {          formDropzone.removeAllFiles(true);        });      },      success: function (data) {        var data = data.xhr.response;        var message = $('<div>').html(data).find("#message").text();        $('#form-curriculo')[0].reset();        $("#btn-enviar").text("Enviar").removeAttr("disabled");        swal("", message, "success");      },      error: function (data) {        $('#form-curriculo')[0].reset();        $("#btn-enviar").text("Enviar").removeAttr("disabled");        swal("Falha ao enviar!", "", "error");      }    });    $("#form-curriculo").submit(function (event) {      event.preventDefault();      event.stopPropagation();      if (!formDropzone.files[0]) {        swal("Atenção", "Você deve enviar um arquivo!", "error");        return false;      }      $("#btn-enviar").text('Enviando...').attr("disabled", true);      formDropzone.processQueue();    });  });</script><?php }} ?>