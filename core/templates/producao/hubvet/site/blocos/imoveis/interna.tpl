{$imovel=monta_imoveis_zeh($imoveis, $caracteristicas_tipos)}
{$imovel=$imovel[0]}
{$videos=$imovel->Videos}
{$imagens=$imovel->Imagens}
<main id="imoveis" class="text-body-tertiary text-center text-lg-left imovel-interno" itemprop="mainContentOfPage">

  <div id="wrap" class="pt-50 pb-50 pb-120">

    <div class="container">

      <div class="row">

        <div class="col-lg-6">

          <div class="endereco fz-14">
            {if $imovel->Endereco_txf}{$imovel->Endereco_txf}{/if}

            {if $imovel->Bairro_txf}
            {if $imovel->Endereco_txf} - {/if}
            {$imovel->Bairro_txf}
            {/if}

            {if $imovel->Cidade_txf}
            {if $imovel->Bairro_txf} - {/if}
            {$imovel->Cidade_txf}
            {/if}

            {if $imovel->Estado_est}
            {if $imovel->Bairro_txf},&nbsp;{/if}
            {$imovel->Estado_est}
            {/if}

            {if $imovel->Cep_txf}
            {if $imovel->Estado_est}, {/if}
            {$imovel->Cep_txf}
            {/if}
          </div>

          <h1 class="title fw-700 text-body-quaternary fz-24 mt-15">
            {$imovel->Nome_tit}
          </h1>

          {if $imovel->Descricao_curta_txa}
          <div class="descricao-curta mt-15">
            {$imovel->Descricao_curta_txa}
          </div>
          {/if}

          {if $imovel->Caracteristicas_vin}
          <div class="caracteristicas mt-25 text-body-quaternary">
            <div class="row">
              {foreach from=$imovel->Caracteristicas_vin item=caracteristica}
              <div class="col-6 text-center text-lg-left col-lg-auto mb-15 pr-40" title="{strip_tags($caracteristica->Nome_tit)}">

                <div class="d-flex fill-height justify-content-center justify-content-lg-start">

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

        <div class="col-md"></div>

        <div class="col-lg-auto">
          <div class="align-center text-lg-right">
            <div class="preco ff-secondary fz-24 text-secondary fw-700">
              R$ {formata_preco($imovel->Valor_txf)}
            </div>
            <div class="tipo fz-14" style="letter-spacing: 0.34em;">
              {if $imovel->Tipo_imovel_sel == 'compra'}
              COMPRA
              {else}
              ALUGUEL
              {/if}
            </div>
            {if $imovel->Adicionais_vin}
            <div class="adicionais mt-10">
              {foreach from=$imovel->Adicionais_vin item=adicional}
              <div class="adicional">
                {$adicional->Tipo_sel}: {$adicional->Valor_txf}
              </div>
              {/foreach}
            </div>
            {/if}
          </div>
        </div>

      </div>

    </div>

    <div class="mt-40">
      {include file=$CAMINHO_TPL|cat:'componentes/galeria-mista.tpl'}
    </div>

    <div class="mt-50">
      <div class="container">
        <div class="row">

          <div class="col-lg-7">
            {if $imovel->Descricao_txa || $imovel->Planta_baixa}
            <div id="imoveis-tabs-descricao">
              <ul class="nav nav-pills pl-20" role="tablist">

                {if $imovel->Descricao_txa}
                <li class="nav-item">
                  <a class=" active" data-toggle="tab" href="#descricao" role="tab" aria-controls="descricao"
                     aria-selected="true">Descrição</a>
                </li>
                {/if}

                {if $imovel->Planta_baixa}
                <li class="nav-item">
                  <a data-toggle="tab" href="#planta" role="tab" aria-controls="planta"
                     aria-selected="false">Planta Baixa</a>
                </li>
                {/if}

              </ul>
              <hr class="mt-0"/>
              <div class="tab-content pt-15">

                {if $imovel->Descricao_txa}
                <div class="tab-pane fade show active" id="descricao" role="tabpanel" aria-labelledby="descricao-tab">
                  <div class="texto">
                    {$imovel->Descricao_txa}
                  </div>
                </div>
                {/if}

                {if $imovel->Planta_baixa}
                <div class="tab-pane fade" id="planta" role="tabpanel" aria-labelledby="planta-tab">
                  <a class="fancybox" data-fancybox="planta-baixa"
                     href="{$painel}{$imovel->Planta_baixa[0]->Caminho_txf}">
                    <figure>
                      <img class="img-fluid" src="{$painel}{$imovel->Planta_baixa[0]->Caminho_txf}" alt="Planta baixa"/>
                    </figure>
                  </a>
                </div>
                {/if}

              </div>
            </div>
            {/if}
          </div>

          <div class="col-lg-4 offset-lg-1 pt-60 pt-lg-0 d-none d-lg-block">

            {include file=$CAMINHO_TPL|cat:'blocos/global/entre-contato-simples.tpl'}

          </div>

        </div>
      </div>
    </div>

    {if $imovel->Mapa360_vin}
    <div class="mt-100">
      {$mapas=$imovel->Mapa360_vin}
      {include file=$CAMINHO_TPL|cat:'blocos/imoveis/galeria-360.tpl'}
    </div>
    {/if}

    {if $imovel->Mapa_txf}
    <section id="mapa" class="bg-body-light mt-70">
      <iframe
        src="https://www.google.com/maps/embed?pb={$imovel->Mapa_txf}" width="100%" frameborder="0"
        style="border:0; height: 37.5rem"
        allowfullscreen></iframe>
    </section>
    {/if}

    <div>
      {include file=$CAMINHO_TPL|cat:'blocos/imoveis/form-interessado.tpl'}
    </div>

  </div>

</main>
