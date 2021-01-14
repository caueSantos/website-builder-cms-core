

<h1>Relatorio de Informativo - {$app->Nome_app_txf}   {$hora=date('H')}</h1>
           
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
                        <th>Email</th>
                        <th>Data</th>
                  </tr>
            </thead>
            <tbody>
                  {foreach from=$informativos item=informativo}
                        <tr>
                              <td>{$informativo->Id_int}</td>
                              <td>{$informativo->Email_txf}</td>
                              <td>{arruma_data($informativo->Data_dat)}</td>

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