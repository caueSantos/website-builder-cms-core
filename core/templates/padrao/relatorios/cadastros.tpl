 
<h1>Relatorio de Cadastros - {$app->Nome_app_txf}   {$hora=date('H')}</h1>

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

                        <th>Tipo_pessoa_txf</th>
                        <th>Nome / Nome Fantasia</th>
                        <th>Razao Social</th>
                        <th>CPF / CNPJ</th>
                        <th>CEP</th>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Telefone</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Responsável</th>
                        <th>Registro Profissional</th>
                  </tr>
            </thead>
            <tbody>
                  {foreach from=$cadastros item=cadastro}
                        <tr>
                              <td>{$cadastro->Id_int}</td>
                              <td>{$cadastro->Tipo_pessoa_txf}</td>
                              <td>{$cadastro->Nome_txf}{$cadastro->Nome_fantasia_txf}</td>
                              <td>{$cadastro->Razao_social_txf}</td>
                              <td>{$cadastro->Cpf_txf}{$cadastro->Cnpj_txf}</td>
                              <td>{$cadastro->Cep_txf}</td>
                              <td>{$cadastro->Endereco_txf}</td>
                              <td>{$cadastro->Bairro_txf}</td>
                              <td>{$cadastro->Cidade_txf}</td>
                              <td>{$cadastro->Estado_txf}</td>
                              <td>{$cadastro->Telefone_txf}</td>
                              <td>{$cadastro->Celular_txf}</td>
                              <td>{$cadastro->Email_txf}</td>
                              <td>{$cadastro->Sexo_responsavel_txf} {$cadastro->Responsavel_txf}</td>
                              <td>{$cadastro->Crmv_txf}</td>
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