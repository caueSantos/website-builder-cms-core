{if $solucoes_controle[0]}
<section class="solucoes-controle pt-40 pt-md-90 pb-md-80 pb-40">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-12 col-md-auto">
        <div class="align-center">
          <h1 class="title text-primary fz-32">
            {trans('solucoes_controle_titulo')}
          </h1>
        </div>
      </div>

      <div class="col-12 col-md">

        <div class="lands-tabs">

          <ul class="nav nav-fill" role="tablist">
            {$key=0}
            {foreach from=$solucoes_controle item=controle}
            {if $controle}
            <li class="nav-item">
              <a class="{if $key == 0}active{/if}"
                 id="solucoes-tab-{$controle->Id_int}"
                 data-toggle="tab"
                 href="#controle-{$controle->Id_int}"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                {$controle->Nome_tit}
              </a>
            </li>
            {$key=$key+1}
            {/if}
            {/foreach}
          </ul>

        </div>

      </div>
    </div>

    <hr/>

    <div class="row mt-30">

      <div class="col-12">

        <div class="tab-content">
          {$key=0}
          {foreach from=$solucoes_controle item=controle}
          {if $controle}
          <div
            class="tab-pane fade show {if $key == 0}active{/if}"
            id="controle-{$controle->Id_int}"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <div class="row  {if !$controle->Imagens[0]}justify-content-center text-center{/if}">

              <div class="col-12 col-md-6">
                <div class="align-center">
                  <div class="text-primary fz-24 title">
                    {$controle->Texto_principal_txa}
                  </div>
                  <div class="texto lh-15 fz-16 mt-25">
                    {$controle->Texto_secundario_txa}
                  </div>
                </div>
              </div>

              {if $controle->Imagens[0]}
              <div class="col-12 col-md-6">
                <div class="align-center">
                  <img
                    class="img-fluid mx-auto d-block"
                    src="{$painel}{$controle->Imagens[0]->Caminho_txf}"
                    alt="{strip_tags($controle->Texto_principal_txa)}"
                    title="{strip_tags($controle->Texto_principal_txa)}"
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
