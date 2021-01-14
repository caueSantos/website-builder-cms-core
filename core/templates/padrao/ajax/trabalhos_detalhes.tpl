{foreach from=$tra item=trab_det}
      <h3>{$trab_det->Titulo_txf|default:$trab_det->Tipo_sel}</h3>
      <div id='trabalhos_detalhes'>

            <div id='trabalhos_detalhes_img'>
                  <a href='{$app->Url_cliente}painel/{$trab_det->Caminho_txf}' rel='prettyPhoto[]'>  <img src="{$app->Url_cliente}painel/{$trab_det->Caminho_txf}" /></a><br/><br/>
            </div>

            <div id='trabalhos_detalhes_texto'>{$trab_det->Descricao_txa}<br />
            </div>

      </div>
      <br clear="all" />


      <a href="{$trab_det->Link_txf}" target="_blank">Clique aqui para visitar o site</a>

      <div style="clear:both"></div>
{/foreach}



<script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
      $("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>