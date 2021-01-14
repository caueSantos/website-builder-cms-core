



<h1>Relatorio de Contato - {$app->Nome_app_txf}   {$hora=date('H')}</h1>
           
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
                        <th>Data</th>
                        <th>Nome</th>
                        
                        <th>Telefone</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Email</th>
                        <th>Mensagem</th>




                  </tr>
            </thead>
            <tbody>
                  {foreach from=$contatos item=contato}
                        <tr>
                              <td>{$contato->Id_int}</td>
                              <td>{arruma_data($contato->Data_dat)}</td>
                              <td>{$contato->Nome_txf}</td>
                              <td>{$contato->Telefone_txf}</td>
                              <td>{$contato->Cidade_txf}</td>
                              <td>{$contato->Estado_sel}</td>
                              <td>{$contato->Email_txf}</td>
                              <td>{$contato->Mensagem_txa}</td>
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