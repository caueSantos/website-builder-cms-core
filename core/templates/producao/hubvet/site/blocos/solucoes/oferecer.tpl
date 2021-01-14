{if $solucoes_oferecer[0]}
{$solucoes_oferecer = junta_registros($solucoes_oferecer, 'Nome_url', $solucoes_oferecer_itens, 'Solucao_oferecer_sel', 'Oferecer_itens')}
<section class="solucoes-oferecer pt-40 pt-md-70 pb-md-90 pb-40 bg-body-lighter">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="title-group text-center">
          <h1 class="title fz-36 text-primary lh-12 fw-400">
            {titulo('solucoes_oferecer_interna', 'tit', $titulos)}
          </h1>
          {if titulo('solucoes_oferecer_interna', 'sub', $titulos)}
          <div class="texto text-body-primary fz-16 mt-10 lh-15">
            {titulo('solucoes_oferecer_interna', 'sub', $titulos)}
          </div>
          {/if}
        </div>
      </div>
    </div>

    <div class="row justify-content-center mt-30">

      <div class="col-12 col-md text-center">

        <div class="lands-tabs lands-tabs-2">

          <ul class="nav" role="tablist">
            {$key=0}
            {foreach from=$solucoes_oferecer item=oferecer}
            {if $oferecer->Oferecer_itens[0]}
            <li class="nav-item">
              <a class="{if $key == 0}active{/if}"
                 id="solucoes-oferecer-tab-{$oferecer->Id_int}"
                 data-toggle="tab"
                 href="#oferecer-{$oferecer->Id_int}"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                {$oferecer->Nome_tit}
              </a>
            </li>
            {$key=$key+1}
            {/if}
            {/foreach}
          </ul>

        </div>

      </div>
    </div>

    <div class="row mt-60">

      <div class="col-12">

        <div class="tab-content">
          {$key=0}
          {foreach from=$solucoes_oferecer item=oferecer}
          {if $oferecer}
          <div
            class="tab-pane fade show {if $key == 0}active{/if}"
            id="oferecer-{$oferecer->Id_int}"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <div class="row {if !$oferecer->Imagens[0]}justify-content-center text-center{/if}">

              <div class="col-12 col-md-5">

                <div class="align-center">
                  <div class="setas-centro marcador-bolinhas">
                    <div class="owl-carousel carousel-sobre-inicio"
                         data-owl-carousel
                         data-owl-items="1"
                         data-rwd="1-1-1"
                         data-owl-loop="true"
                         data-owl-autoplay="true"
                         data-owl-autoplay-timeout="8000"
                         data-owl-margin="0"
                         data-owl-dots="true"
                         data-owl-nav="false"
                    >
                      {foreach from=$oferecer->Oferecer_itens item=item}
                      <div class="item">
                        <div class="title text-primary fz-24 fw-700 lh-12">
                          {$item->Titulo_txf}
                        </div>
                        <div class="texto fz-14 mt-20">
                          {$item->Texto_txa}
                        </div>
                      </div>
                      {/foreach}
                    </div>
                  </div>
                </div>

              </div>

              {if $oferecer->Imagens[0]}
              <div class="col-12 col-md-7">
                <div class="align-center">
                  <img
                    class="img-fluid mx-auto d-block"
                    src="{$painel}{$oferecer->Imagens[0]->Caminho_txf}"
                    alt="{strip_tags($oferecer->Nome_tit)}"
                    title="{strip_tags($oferecer->Nome_tit)}"
                  />
                </div>
              </div>
              {/if}

            </div>

          </div>
          {$key=$key+1}
          {/if}
          {/foreach}
        </div>

      </div>

    </div>

  </div>

</section>
{/if}
