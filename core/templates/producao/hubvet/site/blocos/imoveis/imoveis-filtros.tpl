<div class="filtros-inner pr-65">
  <div class="filtros" style="direction: ltr">

    <form id="imoveis-filtros-form" onsubmit="return false">

      <!-- ORDENACAO -->
      <div id="filtro-ordem" class="d-block d-lg-none mb-40 mt-30">

        <div class="dropdown no-animate dropdown-select" id="filtro-ordenacao">
          <span class="fz-14 d-block">Filtrar por: </span>
          <div class="title fz-18 fw-800 d-inline dropdown-toggle simple-arrow" type="button" id="dropdownMenuButton"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
          </div>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="cursor-pointer dropdown-item bg-body-light-hover" data-value="Id_int:UNSIGNED:DESC">
              Recentes
            </a>
            <a class="cursor-pointer dropdown-item bg-body-light-hover" data-value="Valor_txf:DECIMAL(15,2):ASC">
              Menor preço
            </a>
          </div>
          <input class="dropdown-value" type="hidden"/>
        </div>

      </div>

      <!-- FILTRO DE TIPO -->
      <div id="filtro-tipo">

        <h3 class="filter-group-title title fz-16 text-body-quaternary fw-700">
          Tipo de Imóvel
        </h3>

        <div class="lista mt-25">

          <div class="form-lands-radio custom-control custom-radio">

            <input
              id="filtro-tipo-compra"
              value="compra"
              checked=""
              type="radio"
              name="filtro[Tipo_imovel_sel]"
              class="custom-control-input"
              required="">

            <label class="custom-control-label" for="filtro-tipo-compra">
              Compra
            </label>

          </div>

          <div class="form-lands-radio custom-control custom-radio mt-20">

            <input
              id="filtro-tipo-aluguel"
              value="aluguel"
              type="radio"
              name="filtro[Tipo_imovel_sel]"
              class="custom-control-input"
              required="">

            <label class="custom-control-label" for="filtro-tipo-aluguel">
              Aluguel
            </label>

          </div>

          <!--        <div class="form-lands-radio custom-control custom-radio mt-20">-->

          <!--          <input-->
          <!--            id="filtro-tipo-empreendimento"-->
          <!--            value="empreendimento"-->
          <!--            type="radio"-->
          <!--            name="filtro[Tipo_imovel_sel]"-->
          <!--            class="custom-control-input"-->
          <!--            required="">-->

          <!--          <label class="custom-control-label" for="filtro-tipo-empreendimento">-->
          <!--            Empreendimento-->
          <!--          </label>-->

          <!--        </div>-->

        </div>

      </div>

      <!-- FILTRO DE LOCALIZAÇÃO -->
      <div id="filtro-localizacao" class="mt-35">

        <h3
          class="filter-group-title title fz-16 text-body-quaternary fw-700 cursor-pointer"
          data-toggle="collapse" data-target="#filtro-localizacao-collapse"
          aria-expanded="false"
        >
          Localização <i class="fas fa-chevron-down"></i>
        </h3>

        <div class="collapse show" id="filtro-localizacao-collapse">
          <div class="pt-25">

            <select
              name="filtro[Estado_est]"
              data-placeholder="Estado"
              type="text"
              id="filtro-localizacao-estado"
              class="custom-select form-lands"
              data-autoload="estados"
            ></select>

            <select
              name="filtro[Cidade_txf]"
              data-placeholder="Cidade"
              type="text"
              class="custom-select form-lands"
              data-autoload="cidades"
              data-autoload-depends="#filtro-localizacao-estado"
              disabled
            ></select>

            <input
              name="filtro[Bairro_txf]"
              placeholder="Bairro"
              type="text"
              class="form-control form-lands"
            />

          </div>
        </div>

      </div>

      <!-- FILTRO DE CARACTERÍSTICAS -->
      <div id="filtro-caracteristicas" class="mt-25">

        <h3
          class="filter-group-title title fz-16 text-body-quaternary fw-700 cursor-pointer"
          data-toggle="collapse" data-target="#filtro-caracteristicas-collapse"
          aria-expanded="false"
        >
          Caracteristicas <i class="fas fa-chevron-down"></i>
        </h3>

        <div class="collapse show" id="filtro-caracteristicas-collapse">
          <div class="pt-25">

            {foreach from=$caracteristicas_tipos item=tipo key=key}
            {if $tipo->Exibe_filtro_sel != 'NAO'}
            <div class="{if $key > 0}mt-10{/if}">

              <div class="mb-15">
                <div class="d-inline-block va-middle" style="width: 22px">
                  <img style="width: auto; max-width: 100%; height: auto"
                       src="{$painel}{$tipo->Imagens[0]->Caminho_txf}"
                       class="mx-auto pe-none d-block"/>
                </div>

                <div class="pl-5 d-inline-block va-middle fz-16">
                  {$tipo->Nome_tit}
                </div>
              </div>

              <div class="d-block d-lg-inline-block">

                {if $tipo->Tipo_filtro_sel == 'RADIO'}

                <div class="btn-group btn-group-toggle" data-toggle="buttons">

                  {for $i=1 to 4}
                  <label class="btn btn-lands btn-primary btn-outline btn-sm title br-1 {if $i > 1}ml-5{/if}">
                    <input type="radio" name="filtro[caracteristicas][{$tipo->Nome_url}]" autocomplete="off"
                           value="eq:{$i}">
                    <span class="fw-700">{if $i == 4}+{/if}{$i}</span>
                  </label>
                  {/for}

                </div>
                <div class="text-right fz-12 mt-5">
                  <div
                    class="d-block d-lg-inline-block cursor-pointer"
                    onclick="limparFiltroRadio('filtro[caracteristicas][{$tipo->Nome_url}]')"
                  >
                    <i class="fas fa-times va-middle pr-5"></i>
                    Limpar
                  </div>
                </div>

                {else if $tipo->Tipo_filtro_sel == 'RANGE'}

                <div class="filtro-range">

                  <div class="form-lands-group">
                    <div class="form-lands-suffix fw-700 title lh-0 fz-14 text-body-quaternary">
                      {$tipo->Sufixo_txf}
                    </div>
                    <input
                      name="filtro[caracteristicas][{$tipo->Nome_url}][range][min]"
                      placeholder="Valor mínimo"
                      type="text"
                      class="form-control form-lands money-mask"
                    />
                  </div>

                  <div class="form-lands-group">
                    <div class="form-lands-suffix fw-700 title lh-0 fz-14 text-body-quaternary">
                      {$tipo->Sufixo_txf}
                    </div>
                    <input
                      name="filtro[caracteristicas][{$tipo->Nome_url}][range][max]"
                      placeholder="Valor máximo"
                      type="text"
                      class="form-control form-lands money-mask"
                    />
                  </div>

                </div>

                {/if}

              </div>

            </div>
            {/if}
            {/foreach}

          </div>
        </div>

      </div>

      <!-- FILTRO DE PREÇO -->
      <div id="filtro-preco" class="mt-25">

        <h3
          class="filter-group-title title fz-16 text-body-quaternary fw-700 cursor-pointer"
          data-toggle="collapse" data-target="#filtro-preco-collapse"
          aria-expanded="false"
        >
          Preço <i class="fas fa-chevron-down"></i>
        </h3>

        <div class="collapse show" id="filtro-preco-collapse">
          <div class="pt-25">

            <div class="form-lands-group">
              <div class="fw-700 title icone lh-0 fz-14 text-body-quaternary">R$</div>
              <input
                name="filtro[Valor_min_txf]"
                placeholder="Valor mínimo"
                type="text"
                class="form-control form-lands money-mask"
              />
            </div>

            <div class="form-lands-group mb-0">
              <div class="fw-700 title icone lh-0 fz-14 text-body-quaternary">R$</div>
              <input
                name="filtro[Valor_max_txf]"
                placeholder="Valor máximo"
                type="text"
                class="form-control form-lands money-mask"
              />
            </div>

          </div>
        </div>

      </div>

      <div id="limpar-filtros" class="fz-14 text-right mt-15">

        <div
          class="d-inline-block cursor-pointer"
          onclick="limparFiltrosImoveis()"
        >
          <i class="fas fa-times va-middle pr-5"></i>
          Limpar filtros
        </div>

      </div>

      <input type="hidden" name="filtro[Order_by]" value="Id_int:UNSIGNED:DESC"/>

      <div id="botao-aplicar-filtros" class="d-block d-lg-none">
        <button type="submit" class="btn-lands btn-secondary">
          Aplicar Filtros
        </button>
      </div>

      <button type="button" id="fechar-filtro" class="d-lg-none">
        <i class="fas fa-times"></i>
      </button>

    </form>

  </div>
</div>

<button type="button" id="acionador-filtro" class="d-lg-none">
  <i class="fas fa-filter"></i>
</button>
