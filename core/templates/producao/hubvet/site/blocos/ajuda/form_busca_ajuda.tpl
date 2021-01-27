<form
  autocomplete="off"
  class="busca form-busca"
  method="POST"
  action="{$url_principal}busca"
  data-tpl="mini"
  data-autocomplete="#retorno-personalizado-topo"
>

  <div class="form-lands-group form-autocomplete mb-0">
    <input
      name="valor"
      autocomplete="off"
      class="form-lands form-outline form-dark mb-0"
      type="text"
      placeholder="{trans(ajuda_form_busca)}"
    />
    <input type="hidden" name="Tabelas_txf" value="ajuda">
    <input type="hidden" name="Campos_txf" value="Nome_txf,Link_txf,Descricao_txf">
    <div id="retorno-personalizado-topo" class="form-lands-autocomplete br-1"
         style="display: none; max-height: 300px; overflow-y: auto"></div>
  </div>

</form>

