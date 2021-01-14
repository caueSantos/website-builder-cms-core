<article class="imovel-item">

  <a href="{$app->Url_cliente_linguagem}imoveis/{$imovel->Nome_url}"
     class="text-body-primary hover hover-scale-up hover-shadow d-block br-1 overflow-hidden"
     style="border: 1px solid #F0F0F8;">

    <div class="aspect aspect-4-3 overflow-hidden bg-body-light">
      <figure class="aspect-item">
        <img
          class="img-fit"
          src="{$painel}{$imovel->Imagens[0]->Caminho_txf}"
          alt="{strip_tags($imovel->Nome_tit)}"
        />
      </figure>
    </div>

    <div class="pl-25 pr-25 pt-35 {if $imovel->Caracteristicas_vin}pb-20{else}pb-35{/if}">

      <div class="title fz-18 fw-700 text-body-secondary" data-clamp="1">
        {$imovel->Nome_tit}
      </div>

      {if $imovel->Nome_tit}
      <div class="desc mt-20" data-clamp="3">
        {corta_texto($imovel->Descricao_txa, 300, '...')}
      </div>
      {/if}

      {if $imovel->Caracteristicas_vin}
      <div class="caracteristicas mt-30">
        <div class="row">
          {foreach from=$imovel->Caracteristicas_vin item=caracteristica}
          <div class="col-12 col-lg-6 mb-15" title="{strip_tags($caracteristica->Nome_tit)}">

            <div class="d-flex fill-height">

              {if $caracteristica->Imagens[0]}
              <div class="align-self-center mr-10" style="width: 24px;">
                <img style="width: auto; height: auto" src="{$painel}{$caracteristica->Imagens[0]->Caminho_txf}"
                     class="mx-auto pe-none d-block"/>
              </div>
              {/if}
              <div class="align-self-center fw-700 fz-14 lh-12">
                {$caracteristica->Valor_min_txf}
                {if $caracteristica->Valor_max_txf}
                a {$caracteristica->Valor_max_txf}
                {/if}
                {if $caracteristica->Sufixo_txf}
                {$caracteristica->Sufixo_txf}
                {/if}
              </div>

            </div>

          </div>
          {/foreach}
        </div>
      </div>
      {/if}

    </div>

  </a>

</article>
