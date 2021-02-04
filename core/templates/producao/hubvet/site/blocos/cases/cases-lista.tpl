{if $cases[0]}
<section class="cases-lista pt-40 pt-md-70 pb-40 pb-md-100">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-12">

        <div class="row">

          <div class="col-md">
            <div class="align-center fz-22 title fw-700">
              {trans('cases_encontre_historias')}
            </div>
          </div>

          <div class="col-md-3">
            <div class="align-center">

              <select class="d-block custom-select cursor-pointer text-center">
                <option value="todos">
                  {trans('todos')}
                </option>
                {foreach from=$labels item=label}
                <option value="{$label->Nome_url}">
                  {$label->Nome_tit}
                </option>
                {/foreach}
              </select>

            </div>
          </div>

        </div>

        <div class="row mt-50">

          {foreach from=$cases item=case}

          <a
            href="{gera_link('cases/'|cat:$case->Nome_url, true)}"
            class="col-12 col-md-3 text-body-secondary hover hover-scale-down hover-opacity"
          >

            <figure class="imagem">
              {if $case->Imagens[0]}
              <img
                src="{$painel}{$case->Imagens[0]->Caminho_txf}"
                alt="{strip_tags($case->Nome_tit)}"
                title="{strip_tags($case->Nome_tit)}"
                class="img-fit pe-none"
              />
              {else}
              <img
                src="{$assets}imagens/indisponivel-quadrada.png"
                alt="{strip_tags($case->Nome_tit)}"
                title="{strip_tags($case->Nome_tit)}"
                class="img-fit pe-none"
              />
              {/if}
            </figure>

            <div class="mt-20">

              <div class="title fz-16 text-primary lh-12 fw-700">
                {$case->Nome_tit}
              </div>

              {if $case->Texto_secundario_txa}
              <div class="texto fz-14 lh-15 mt-10" data-clamp="3">
                {corta_texto($case->Texto_secundario_txa, 100, '...')}
              </div>
              {/if}

            </div>

            <div class="botao mt-10">
              <div
                class="fz-14 fw-700 text-primary"
              >
                {trans('leia_mais')}...
              </div>
            </div>

          </a>

          {/foreach}

        </div>

        <div class="text-center mt-40">
          <a
            target="_blank" href="{gera_link(config('cases_ver_mais_link'), true)}"
            class="btn-lands btn-lg btn-primary pl-md-50 pr-md-50"
          >
            {trans('ver_mais')}
          </a>
        </div>

      </div>
    </div>
  </div>

</section>
{/if}
