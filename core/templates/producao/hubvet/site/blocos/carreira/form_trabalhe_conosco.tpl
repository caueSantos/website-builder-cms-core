<form id="form-curriculo" class="dropzone" action="{$app->Url_cliente}post/curriculo" method="post"      enctype="multipart/form-data">  {if (isset($emails))}  {if (count($emails)>1)}  <div class="form-lands-group">    <select class="form-lands" tabindex="0" name="Departamento_sel" size="1">      {foreach from=$emails item=email}      <option value="{$email->Departamento_sel}" {if (strtolower($email->Departamento_sel) == 'contato')}        selected="selected" {/if}>{$email->Descricao_txf} ({$email->Email_txf})      </option>      {/foreach}    </select>  </div>  {else}  <input name="Destinatario_txf" type="hidden" value="{$emails[0]->Email_txf}"/>  {/if}  {else}  <input name="Destinatario_txf" type="hidden" value="bruna.branco@landsdigital.com.br"/>  {/if}  <div class="form-lands-group">    <input name="Nome_txf" type="text" placeholder="Nome" class="form-lands" id="nome" required>  </div>  <div class="form-lands-group">    <input name="Email_txf" type="email" class="form-lands" placeholder="Email" id="email" required>  </div>  <div class="form-lands-group">    <input name="Telefone_txf" type="text" class="form-lands phone-mask" placeholder="Telefone" required>  </div>  <div class="dropzone-previews" id="dz-clickable">    <div class="dz-message needsclick">Arraste o arquivo aqui ou clique para enviar.</div>  </div>  <div class="fallback">    <input type="file" multiple/>  </div>  <input id="lands_id" value="{$app->Lands_id}" name="Lands_id" type="hidden"/>  <input name="Vaga_txf" type="hidden" value="{$vaga->Nome_tit}">  <input id="pasta" value="painel" name="pasta" type="hidden"/>  <div class="text-center">    <button type="submit" class="btn-lands btn-primary btn-block btn-lg">     {trans('candidatar_vaga')}    </button>  </div></form><link rel="stylesheet" type="text/css" href="{$assets}plugins/dropzone/dropzone.css"><script src="{$assets}plugins/dropzone/dropzone.js"></script><script>  Dropzone.autoDiscover = false;  $(document).ready(function () {    var formDropzone;    $("#form-curriculo").dropzone({      autoProcessQueue: false,      uploadMultiple: false,      addRemoveLinks: true,      acceptedFiles: "application/msword, application/pdf",      paramName: "userfile",      clickable: "#dz-clickable",      previewsContainer: "#dz-clickable",      dictRemoveFile: "Remover",      dictCancelUpload: "Cancelar",      init: function () {        formDropzone = this;        formDropzone.on('addedfile', function () {          if (formDropzone.files.length > 0) {            $("#form").addClass('dz-started');          }        });        formDropzone.on('removedfile', function () {          if (formDropzone.files.length === 0) {            $("#form").removeClass('dz-started');          }        });        formDropzone.on("complete", function (file) {          formDropzone.removeAllFiles(true);        });      },      success: function (data) {        var data = data.xhr.response;        var message = $('<div>').html(data).find("#message").text();        $('#form-curriculo')[0].reset();        $("#btn-enviar").text("Enviar").removeAttr("disabled");        swal("", message, "success");      },      error: function (data) {        $('#form-curriculo')[0].reset();        $("#btn-enviar").text("Enviar").removeAttr("disabled");        swal("Falha ao enviar!", "", "error");      }    });    $("#form-curriculo").submit(function (event) {      event.preventDefault();      event.stopPropagation();      if (!formDropzone.files[0]) {        swal("Atenção", "Você deve enviar um arquivo!", "error");        return false;      }      $("#btn-enviar").text('Enviando...').attr("disabled", true);      formDropzone.processQueue();    });  });</script>