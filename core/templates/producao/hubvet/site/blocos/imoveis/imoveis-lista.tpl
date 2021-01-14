{assign var='cols' value=$cols|default:'col-lg-4'}

{$id='lista-'|cat:rand()|cat:rand()}
{if $imoveis_registros}
<div class="lista-imoveis" id="lista-imoveis-{$id}">

  <div class="row owl-carousel owl-responsive justify-content-lg-center"
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="true"
       data-owl-autoplay-timeout="6000"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="false"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container="#lista-imoveis-{$id} .owl-dots"
  >

    {foreach from=$imoveis_registros item=imovel key=key}

    <div class="col-link col {$cols} mb-0 mb-lg-40 item">
      {include file=$CAMINHO_TPL|cat:'blocos/imoveis/imovel-item.tpl'}
    </div>

    {/foreach}

  </div>

  <div class="rounded-dots d-block d-lg-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</div>
{/if}
