

<style>
      .relatorio {
            display: block;
            margin: 10px 15%;
      }
</style>
<div class="container">
      <div class="row">
            <div class="col-md-12 ">
                  <h2>Relatórios</h2>
                  <div class="caixa row">

                        {if isset($app->Url_cliente_real)}
                        {if isset($relatorios_disponiveis->contatos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente_real}relatorios/contatos">Relatório de Contatos</a> {/if}
                  {if isset($relatorios_disponiveis->informativos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente_real}relatorios/informativos">Relatório de Informativo</a> {/if}
            {if isset($relatorios_disponiveis->curriculos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente_real}relatorios/curriculos">Relatório de Currículos</a> {/if}
      {if isset($relatorios_disponiveis->cadastros)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente_real}relatorios/cadastros">Relatório de Cadastros</a> {/if}
{if isset($relatorios_disponiveis->emails)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente_real}relatorios/emails">Emails Cadastrados </a> {/if}
<a class="btn btn-danger btn-lg relatorio"  href="{$app->Url_cliente_real}logout?redirect_link=/{$app->Pagina_inicial_txf}">Sair</a>

{else}

      {if ($app->Segmento_padrao_txf==1)} 

      {if isset($relatorios_disponiveis->contatos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente}relatorios/contatos">Relatório de Contatos</a> {/if}
{if isset($relatorios_disponiveis->informativos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente}relatorios/informativos">Relatório de Informativo</a> {/if}
{if isset($relatorios_disponiveis->curriculos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente}relatorios/curriculos">Relatório de Currículos</a> {/if}
{if isset($relatorios_disponiveis->cadastros)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente}relatorios/cadastros">Relatório de Cadastros</a> {/if}
{if isset($relatorios_disponiveis->emails)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_cliente}relatorios/emails">Emails Cadastrados </a> {/if}
<a class="btn btn-danger btn-lg relatorio"  href="{$app->Url_cliente}logout?redirect_link=/{$app->Pagina_inicial_txf}">Sair</a>
{else}

{if isset($relatorios_disponiveis->contatos)} <a class="btn btn-primary btn-lg relatorio" target="_blank"  href="{$app->Url_atual}relatorios/contatos">Relatório de Contatos</a> {/if}
{if isset($relatorios_disponiveis->informativos)} <a class="btn btn-primary btn-lg relatorio" target="_blank"  href="{$app->Url_atual}relatorios/informativos">Relatório de Informativo</a> {/if}
{if isset($relatorios_disponiveis->curriculos)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_atual}relatorios/curriculos">Relatório de Currículos</a> {/if}
{if isset($relatorios_disponiveis->cadastros)} <a class="btn btn-primary btn-lg relatorio" target="_blank" href="{$app->Url_atual}relatorios/cadastros">Relatório de Cadastros</a> {/if}
{if isset($relatorios_disponiveis->emails)} <a class="btn btn-primary btn-lg relatorio" target="_blank"  href="{$app->Url_atual}relatorios/emails">Emails Cadastrados</a> {/if}
<a class="btn btn-danger btn-lg relatorio"  href="{$app->Url_atual}logout?redirect_link=/{$app->Pagina_inicial_txf}">Sair</a>
{/if}
{/if}

</div>
</div>
</div>
</div>







