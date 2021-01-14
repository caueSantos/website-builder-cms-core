



<h1>Relatorio de Emails - {$app->Nome_app_txf}   {$hora=date('H')}</h1>
           
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
                        <th>Tabela</th>
                        <th>Email</th>
                  </tr>
            </thead>
            <tbody>{$cont=0}
                  {foreach from=$lista_emails item=email}
                        <tr>
                              <td>{$cont}</td>
                              <td>{$email->tabela}</td>
                              <td>{$email->Email_txf}</td>
                              {$cont=$cont+1}
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