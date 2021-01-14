{if $funcionalidades[0]}
<section class="planos-funcionalidades">

  <div class="fiuncionalidades pt-50 pb-70">

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="title-group text-center">
            <h1 class="title fz-40 text-primary lh-12 fw-400">
              {titulo('funcionalidades_interna', 'tit', $titulos)}
            </h1>
            {if titulo('funcionalidades_interna', 'sub', $titulos)}
            <div class="texto text-body-secondary fz-18 mt-5 lh-15">
              {titulo('funcionalidades_interna', 'sub', $titulos)}
            </div>
            {/if}
          </div>
        </div>
      </div>

      <div class="row mt-50">

        <div class="col-12">
          {include file=$CAMINHO_TPL|cat:'blocos/funcionalidades/funcionalidades-lista.tpl'}
        </div>

        <div class="col-12">

          {if is_url(config('funcionalidades_interna_botao_link'))}
          <div class="botao mt-20 text-center">
            <a target="_blank" class="btn-lands btn-primary" href="{gera_link(config('funcionalidades_interna_botao_link'), true)}">
              {trans('funcionalidades_interna_botao')}
            </a>
          </div>
          {/if}

        </div>

      </div>
    </div>

  </div>

</section>
{/if}
