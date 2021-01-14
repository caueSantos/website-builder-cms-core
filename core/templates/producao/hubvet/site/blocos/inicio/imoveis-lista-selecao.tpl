{$imoveis_registros = monta_imoveis_zeh($imoveis_selecao, $caracteristicas_tipos)}
{if $imoveis_registros}
<div class="imoveis-lista-selcao pt-60 pb-40 pb-lg-80">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="title-group text-center">
          <h1 class="title text-primary fz-32 fw-700 lh-12">
            {titulo('imoveis_selecao_inicio', 'tit', $titulos)}
          </h1>
          {if titulo('imoveis_selecao_inicio', 'sub', $titulos)}
          <div class="texto mt-5 lh-2 fz-16 fw-400">
            {titulo('imoveis_selecao_inicio', 'sub', $titulos)}
          </div>
          {/if}
        </div>

      </div>
    </div>

    <div class="mt-30 mt-lg-60">
      {include file=$CAMINHO_TPL|cat:'blocos/imoveis/imoveis-lista.tpl'}
    </div>

    <div class="botao text-center mt-30 mt-lg-0">
      <a href="{$app->Url_cliente_linguagem}imoveis" class="pl-lg-100 pr-lg-100 btn-lands btn-outline d-block d-lg-inline-block">
        Ver mais
      </a>
    </div>

  </div>

</div>
{/if}

