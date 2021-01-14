{if $servicos[0]}
<article class="links-lista setas-centro">

  <div class="owl-carousel"
       data-owl-carousel
       data-owl-items="4"
       data-rwd="1-2-3-4"
       data-owl-loop="true"
       data-owl-autoplay="true"
       data-owl-autoplay-timeout="6000"
       data-owl-autoplay-hover-pause="true"
       data-owl-margin="30"
       data-owl-dots="true"
       data-owl-nav="true"
       data-owl-slide-by="1"
       data-owl-dots-each="1"
       data-owl-dots-container=".links-lista .owl-dots"
       data-owl-nav-text="@icon:fas fa-chevron-left@--@icon:fas fa-chevron-right@"
  >
    {foreach from=$servicos item=servico}
    {$icone=get_object($servico->Imagens, 'Campo_sel', '==', 'Icone_inicio_ico')}
    {if !$icone}
    {$icone=get_object($servico->Imagens, 'Campo_sel', '==', 'Imagens_ico')}
    {/if}
    <div class="col-link mb-0 mb-lg-40 item">
      <a
        href="javascript:void(0)"
        data-toggle="modal" data-target="#servico-modal"
        class="link-item d-block text-center pl-30 pr-30 br-1 pt-30 fill-height"
        data-id="{$servico->Id_int}"
      >
        <div class="column fill-height">

          <div class="col-lg-auto">
            <div class="aspect aspect-1-1 mb-20 br-100 overflow-hidden mx-auto" style="width: 124px">
              <figure class="imagem aspect-item bg-body-light">
                {if $icone[0]}
                <img class="img-fit" alt="{$servico->Nome_txf}" src="{$painel}{$icone[0]->Caminho_txf}"/>
                {else}
                <img class="img-fit" alt="{$servico->Nome_txf}" src="{$assets}imagens/indisponivel-quadrada.png"/>
                {/if}
              </figure>
            </div>
          </div>

          <div class="col-lg-auto">
            <div class="fz-20 fw-700 lh-12 text-primary" data-clamp="2">
              {corta_texto($servico->Nome_tit, 80)}
            </div>
          </div>

          <div class="col-lg">
            {if $servico->Texto_txa}
            <div class="texto fz-16 mt-10 text-body-primary lh-15 align-center" data-clamp="3">
              {corta_texto($servico->Texto_txa, 200)}
            </div>
            {/if}
          </div>

          <div class="col-lg-auto">
            <div class="botao mt-20 pl-20 pr-20 pl-lg-70 pr-lg-70">
              <div class="d-block text-body-primary text-primary-hover ff-secondary fz-16 fw-600">
                Ver mais
              </div>
            </div>
          </div>

        </div>

      </a>
    </div>
    {/foreach}
  </div>

  <div class="rounded-dots d-block text-center mt-50">
    <div class="owl-dots fz-18"></div>
  </div>

</article>
{/if}
<script>window.servicos = {json_encode($servicos)};</script>
