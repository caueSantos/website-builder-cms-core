{if $area_restrita_items[0]}
<article class="area-restrita-lista">

  <div class="row owl-carousel owl-responsive justify-content-lg-center"
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="false"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".area-restrita-lista .owl-dots"
  >

    {foreach from=$area_restrita_items item=item}

    {$icone=get_object($item->Imagens, 'Campo_sel', '==', 'Icone_inicio_ico')}

    <div class="col-link col col-2-dot-4 mb-0 mb-lg-40 item">
      <div class="bg-primary hover hover-translate-up fill-height br-1 text-center">
        <a
          href="{$item->Link_txf}"
          target="_blank"
          class="item-restrita text-white d-block pl-15 pr-15 pt-30 pb-30 fill-height"
        >

          <figure class="imagem" style="height: 60px">
            {if $icone[0]}
            <img alt="{$item->Nome_txf}" src="{$painel}{$icone[0]->Caminho_txf}"/>
            {else}
            <img alt="{$item->Nome_txf}" src="{$assets}imagens/indisponivel-quadrada.png"/>
            {/if}
          </figure>

          <div class="title fz-18 fw-500 lh-12 mt-20">
            {$item->Nome_txf}
          </div>

          {if $item->Texto_txa}
          <div class="texto fz-14 mt-10 lh-15" data-clamp="3">
            {corta_texto($item->Texto_txa, 200)}
          </div>
          {/if}

        </a>
      </div>
    </div>

    {/foreach}

  </div>

  <div class="rounded-dots d-block d-lg-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
{/if}

