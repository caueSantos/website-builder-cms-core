<div class="carousel-wrap">
  <div class="row owl-carousel owl-responsive"
       data-owl-items="4"
       data-rwd="2-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="false"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="0"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".area-restrita-lista .owl-dots"
  >

    {foreach from=$funcionalidades item=func}

    <div class="col-md-4 mb-30 fill-height-sm">
      <div class="funcionalidade fill-height hover hover-shadow">
        <div class="align-center text-center pl-20 pl-md-50 pr-20 pr-md-50 pb-20 pt-20 pb-md-50 pt-md-50">
          {if $func->Imagens[0]}
          <figure class="imagem">
            <img src="{$painel}{$func->Imagens[0]->Caminho_txf}" alt="{$func->Titulo_txf}"/>
          </figure>
          {/if}
          <div class="title fz-16 fw-700 mt-15">
            {$func->Titulo_txf}
          </div>
          <div class="title fz-48 fw-700 text-primary">
            {$func->Numero_txf}
          </div>
          {if $func->Observacao_txf}
          <div class="fz-12 fw-400">
            {$func->Observacao_txf}
          </div>
          {/if}
          {if $func->Descricao_txa}
          <div class="texto lh-15 mt-20">
            {$func->Descricao_txa}
          </div>
          {/if}
        </div>
      </div>
    </div>

    {/foreach}

  </div>
</div>
