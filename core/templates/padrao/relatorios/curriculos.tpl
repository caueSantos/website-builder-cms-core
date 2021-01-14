


<h1>Relatorio de Currículos - {$app->Nome_app_txf}   {$hora=date('H')}</h1>

<small> {$hora=$hora+4}
      {$hora=$hora|cat:':'}
      {$minuto=date('i')}

      {$hour=$hora|cat:$minuto}
      {date("d/m/Y")} {$hour}</small>
<div id="relatorio">
      <table  class="table table-bordered">
            <thead>
                  <tr>
                        <th>#</th>
                  {if isset($tem_data)}<th>Data</th>{/if}
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Email</th>
                  <th>Vaga</th>
                  <th>Arquivo</th>




            </tr>
      </thead>
      <tbody>
            {foreach from=$curriculos item=curriculo}
                  <tr>
                        <td>{$curriculo->Id_int}</td>
                  {if isset($tem_data)}  <td>{arruma_data($curriculo->Data_dat)}</td>{/if}

                  <td>{$curriculo->Nome_txf}</td>
                  <td>{$curriculo->Telefone_txf}</td>
                  <td>{$curriculo->Email_txf}</td>
                  <td>{$curriculo->Vaga_txf}</td>
                  <td><a target="_blank" href="{$app->Url_cliente}{$app->Pasta_painel}/{$curriculo->Arquivos[0]->Caminho_txf}">DOWNLOAD</a></td>

            </tr>
      {/foreach}

</tbody>
</table>
</div>
<script>     $(document).ready(function() {
      alert('Para imprimir, pressione o botão imprimir no topo da página');
      $('#relatorio').prepend('<a class="btn btn-lg btn-success" style="margin:20px" id="botao_imprimir">Imprimir</a>');
      $('#botao_imprimir').click(function() {
      $('#botao_imprimir').hide();
      window.print();
      return false;
});
}); </script> 