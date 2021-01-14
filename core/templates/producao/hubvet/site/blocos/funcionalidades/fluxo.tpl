{if $funcionalidades_fluxo[0]}
{$banner=$funcionalidades_fluxo[0]}
<section class="solucoes_visao bg-primary text-white pt-40 pb-40 pt-md-80 pb-md-50">

  <div class="bg-fake">
    <div class="bg-parallax" style="background-image: url('{$assets}imagens/bg-funcionalidades-fluxo.png"')">
    </div>
  </div>

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-8">

        <div class="{if !$banner->Imagens[0]}text-center{/if} align-center">

          <h1 class="title fw-700 fz-34">
            {$banner->Titulo_txf}
          </h1>

          <div class="texto lh-18 fz-16 mt-15">
            {$banner->Texto_txa}
          </div>

          {if is_url($banner->Botao_link_txf) && $banner->Botao_texto_txf}
          <div class="botao mt-40">
            <a target="_blank" class="btn-lands btn-accent" href="{$banner->Botao_link_txf}">
              {$banner->Botao_texto_txf}
            </a>
          </div>
          {/if}

        </div>

      </div>

    </div>

  </div>

</section>
{/if}
