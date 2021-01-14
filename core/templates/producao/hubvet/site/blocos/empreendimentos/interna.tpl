{$empreendimento=$empreendimentos[0]}
{$videos=$empreendimento->Videos}
{$imagens=$empreendimento->Imagens}
<main id="empreendimento" class="text-body-tertiary" itemprop="mainContentOfPage">

  <div class="head pt-50 pb-50 pt-lg-120 pb-lg-120">

    <div class="pe-none bg-fake">
      {if $imagens[0]}
      {$img=array_rand($imagens)}
      <img src="{$painel}{$imagens[$img]->Caminho_txf}" class="img-fit"/>
      {/if}
    </div>

    <div class="bg-fake bg-primary" style="opacity: 0.8"></div>

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-lg-6 text-center text-white">

          <h1 class="title fw-700 fz-48 mt-10">
            {$empreendimento->Nome_tit}
          </h1>

          {if $empreendimento->Descricao_curta_txa}
          <div class="texto descricao-curta mt-15 fz-16">
            {$empreendimento->Descricao_curta_txa}
          </div>
          {/if}

          <div
            class="preco d-inline-block ff-secondary fz-18 text-secondary bg-white text-body-primary br-100 lh-1 pl-30 pr-30 pl-lg-70 pr-lg-70 pt-15 pb-15 mt-25"
            style="letter-spacing: -0.04em;">
            {if $empreendimento->Prefixo_valor_txf}
            <span>$empreendimento->Prefixo_valor_txf </span>
            {/if}
            <strong class="text-accent">R$ {formata_preco($empreendimento->Valor_txf)}</strong>
          </div>

        </div>
      </div>

    </div>

  </div>

  <div id="wrap" class="pt-50 pb-50 pb-lg-120">

    {include file=$CAMINHO_TPL|cat:'componentes/galeria-mista.tpl'}

    <div class="mt-50">
      <div class="container text-center text-lg-left">
        <div class="row">

          <div class="col-lg-7">
            {if $empreendimento->Descricao_txa}
            <div id="imoveis-tabs-descricao">
              <ul class="nav nav-pills pl-20" role="tablist">
                <li class="nav-item">
                  <a class=" active" data-toggle="tab" href="#descricao" role="tab" aria-controls="descricao"
                     aria-selected="true">Descrição</a>
                </li>
              </ul>
              <hr class="mt-0"/>
              <div class="tab-content pt-15">
                <div class="tab-pane fade show active" id="descricao" role="tabpanel" aria-labelledby="descricao-tab">
                  <div class="texto">
                    {$empreendimento->Descricao_txa}
                  </div>
                </div>
              </div>
            </div>
            {/if}
          </div>

          <div class="col-lg-4 offset-lg-1 text-center text-lg-left pt-60 pt-lg-0 d-none d-lg-block">

            {include file=$CAMINHO_TPL|cat:'blocos/global/entre-contato-simples.tpl'}

          </div>

        </div>
      </div>
    </div>

    {if $empreendimento->Mapa360_vin}
    <div class="mt-100">
      {$mapas=$empreendimento->Mapa360_vin}
      {include file=$CAMINHO_TPL|cat:'blocos/empreendimentos/galeria-360.tpl'}
    </div>
    {/if}

    {if $empreendimento->Mapa_txf}
    <section id="mapa" class="bg-body-light mt-70">
      <iframe
        src="https://www.google.com/maps/embed?pb={$empreendimento->Mapa_txf}" width="100%" frameborder="0"
        style="border:0; height: 37.5rem"
        allowfullscreen></iframe>
    </section>
    {/if}

    <div>
      {include file=$CAMINHO_TPL|cat:'blocos/imoveis/form-interessado.tpl'}
    </div>

  </div>

</main>
