{if $perguntas[0]}
<section class="container pt-50 pt-lg-60">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-6">

      <div class="title-group text-center">
        <h1 class="title fz-36 fw-400 text-primary">
          {titulo('ajuda_perguntas', 'tit', $titulos)}
        </h1>
        {if titulo('ajuda_perguntas', 'sub', $titulos)}
        <div class="texto fz-16 mt-15">
          {titulo('ajuda_perguntas', 'sub', $titulos)}
        </div>
        {/if}
      </div>

      <div id="perguntas-container" class="pt-30">
        {include file=$CAMINHO_TPL|cat:'ajax/perguntas.tpl'}
      </div>

    </div>
  </div>
</section>
{/if}
