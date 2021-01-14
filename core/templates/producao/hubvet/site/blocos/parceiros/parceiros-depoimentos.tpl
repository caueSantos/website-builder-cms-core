{if $parceiros_depoimentos[0]}
<section class="parceiros-lista pt-40 pb-20 pt-md-80 pb-md-80 bg-body-light">

  <div class="container setas-centro">

    <div class="title-group text-center">
      <h1 class="title fz-40 lh-12 fw-400 text-primary">
        {titulo('parceiros_depoimentos_secao', 'tit', $titulos)}
      </h1>
      {if titulo('parceiros_depoimentos_secao', 'sub', $titulos)}
      <div class="texto fz-18 mt-15 lh-15">
        {titulo('parceiros_depoimentos_secao', 'sub', $titulos)}
      </div>
      {/if}
    </div>

    <div class="mt-60 owl-carousel has-shadow"
         data-owl-carousel="true"
         data-owl-items="3"
         data-rwd="1-2-3-3"
         data-owl-loop="true"
         data-owl-autoplay="true"
         data-owl-autoplay-timeout="10000"
         data-owl-margin="30"
         data-owl-dots="false"
         data-owl-nav="true"
         data-owl-slide-by="1"
         data-owl-dots-each="1"
    >

      {foreach from=$parceiros_depoimentos item=depoimento}
      {$icone=$depoimento->Imagens[0]}
      <div class="item fill-height bg-white bs-2 hover hover-opacity br-1 pt-60 pb-40 pl-50 pr-50">
        <div
          class="link-item align-center d-block text-center tn-ease"
        >
          {if $depoimento->Texto_txa}
          <div class="texto fz-14 lh-12 mb-20">
            {$depoimento->Texto_txa}
          </div>
          {/if}
          <div class="mx-auto aspect aspect-1-1 br-100 overflow-hidden" style="width: 74px">
            <figure class="imagem aspect-item">
              {if $icone}
              <img alt="{$depoimento->Nome_txf}" src="{$painel}{$icone->Caminho_txf}"
                   class="img-fit"/>
              {else}
              <img class="img-fit"
                   alt="{$depoimento->Nome_txf}" src="{$assets}imagens/indisponivel-quadrada.png"/>
              {/if}
            </figure>
          </div>

          {if $depoimento->Nome_txf}
          <div class="title fz-16 fw-700 mt-15">
            {$depoimento->Nome_txf}
          </div>
          {/if}

          {if $depoimento->Informacao_txf}
          <div class="fz-16 mt-5 lh-12">
            {$depoimento->Informacao_txf}
          </div>
          {/if}

        </div>
      </div>
      {/foreach}

    </div>

  </div>

</section>
{/if}
