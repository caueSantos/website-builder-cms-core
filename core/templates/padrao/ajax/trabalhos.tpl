
<div id='conteudo'>

      <h2>Trabalhos</h2>



      <p>Confira abaixo nossos trabalhos mais recentes.</p>

      <div style="clear: both"></div>
      <div id="trabalho_tipo" >Web site Institucional</div>
      {foreach from=$trabalhos item=trabalho}      



      {if ($trabalho->Tipo_sel=='')}{/if}

      <span id='trabalho_caixa'>
            <a href='{$app->Url_cliente}trabalho/{$trabalho->Id_int}'>
                  <span id='trabalho_caixa_img'><img src="{$app->Url_cliente}painel/{$trabalho->Caminho_txf}" width="190" height="120" /></span>
                        {foreach from=$clientes item=cliente}
                              {if ($cliente->Id_int==$trabalho->Id_objeto_con)} 

                              {$cliente->Nome_cliente_txf|default:'Projeto Avulso'}
                        {/if}
                  {/foreach}                      </a> 
      </span>


{/foreach}
<div style="clear:both"></div>
</div>







</div>


