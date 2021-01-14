{if $cases_banner[0]}
<section class="cases-banner bg-dark-grey text-white pt-50 pb-50 pb-md-80">

  <div class="container">

    <div class="row justify-content-center {if !$cases_banner[0]->Imagens[0]}text-center{/if}">

      <div class="col-12 col-md-6">

        <div class="align-center">

          <div class="pr-md-100">
            <h1 class="title fz-34 lh-12">
              {$cases_banner[0]->Titulo_txa}
            </h1>

            {if $cases_banner[0]->Texto_txa}
            <div class="texto fz-16 lh-15 mt-20">
              {$cases_banner[0]->Texto_txa}
            </div>
            {/if}
          </div>

          <div class="mt-30">

            <form class="experimente-form" onsubmit="return false">
              <div class="row justify-content-center">

                <div class="col-12 col-md-7">
                  <input
                    type="email" class="form-lands form-outline form-dark" name="Email_txf"
                    placeholder="{trans('form_email')}*"
                    required
                  />
                </div>

                <div class="col-12 col-md-5 pl-md-0">
                  <button type="submit"
                          class="btn-lands btn-lg btn-block {if $tipo == 1}btn-secondary{else}btn-primary{/if} btn-block pl-25 pr-25">
                    {trans('experimente_secao_botao')}
                  </button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

      {if $cases_banner[0]->Imagens[0]}
      <div class="col-12 col-md-6">
        <img
          src="{$painel}{$cases_banner[0]->Imagens[0]->Caminho_txf}"
          alt="{strip_tags($cases_banner[0]->Titulo_txa)}"
          title="{strip_tags($cases_banner[0]->Titulo_txa)}"
          class="img-fluid pe-none d-block mx-auto"
        />
      </div>
      {/if}

    </div>

  </div>

</section>
{/if}
