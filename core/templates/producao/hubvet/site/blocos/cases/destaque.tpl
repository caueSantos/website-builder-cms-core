{if $case_destaque[0]}
<section class="cases-destaque pt-40 pt-md-70 pb-40">

  <div class="container">

    <a
      href="{gera_link('cases/'|cat:$case_destaque[0]->Nome_url, true)}"
      class="d-block text-body-primary hover hover-opacity"
    >
      <div class="row">

        <div class="col-md-7">

          <figure class="imagem">
            {if $case_destaque[0]->Imagens[0]}
            <img
              src="{$painel}{$case_destaque[0]->Imagens[0]->Caminho_txf}"
              alt="{strip_tags($case_destaque[0]->Nome_tit)}"
              title="{strip_tags($case_destaque[0]->Nome_tit)}"
              class="img-fit pe-none"
            />
            {else}
            <img
              src="{$assets}imagens/indisponivel-quadrada.png"
              alt="{strip_tags($case_destaque[0]->Nome_tit)}"
              title="{strip_tags($case_destaque[0]->Nome_tit)}"
              class="img-fit pe-none"
            />
            {/if}
          </figure>

        </div>

        <div class="col-md-5">

          <div class="align-center">

            <h1 class="title fz-26 lh-12 fw-700">
              {$case_destaque[0]->Texto_principal_txa}
            </h1>

            {if $case_destaque[0]->Texto_secundario_txa}
            <div class="texto fz-16 lh-15 mt-25">
              {corta_texto($case_destaque[0]->Texto_secundario_txa, 200, '...')}
            </div>
            {/if}

            <div class="botao mt-25">
              <div
                class="fz-16 fw-700 text-primary"
              >
                {trans('leia_mais')}...
              </div>
            </div>

          </div>

        </div>

      </div>
    </a>

  </div>

</section>
{/if}
