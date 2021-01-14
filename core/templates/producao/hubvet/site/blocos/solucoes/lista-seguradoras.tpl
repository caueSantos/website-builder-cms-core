{if $seguradoras[0]}
<article class="seguradoras-carousel">

  <div class="row owl-carousel owl-responsive justify-content-lg-center"
       data-owl-items="4"
       data-rwd="1-2-4"
       data-owl-loop="true"
       data-owl-autoplay="true"
       data-owl-autoplay-timeout="4000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".seguradoras-carousel .owl-dots"
  >
    {foreach from=$seguradoras item=seguradora}

    {$icone=get_object($seguradora->Imagens, 'Campo_sel', '==', 'Imagens_ico')}
    {if $icone[0]}
    <div class="col-seg col-6 col-lg-3 mb-0 mb-lg-40 item">

      <a
        href="{if is_url($seguradora->Link_txf)}{$seguradora->Link_txf}{else}javascript:void(0);{/if}"
        class="d-block text-center"
        title="{$seguradora->Titulo_txf}"
      >
        <figure class="imagem" style="height: 80px">
          <img class="align-center" style="max-height: 100%; width: auto; max-width: 100%" alt="{$seguradora->Nome_txf}" src="{$painel}{$icone[0]->Caminho_txf}"/>
        </figure>
      </a>

    </div>
    {/if}
    {/foreach}
  </div>

  <div class="rounded-dots d-block d-lg-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
{/if}
