{if $case->Depoimento_txa}
<section class="case-depoimento pt-md-90 pb-md-70 pt-50 pb-50 text-center bg-body-light">

  <div class="bg-fake text-left">
    <div class="align-center">
      <img style="left: -60px; top: -30px" src="{$assets}imagens/aspas.png" class="pe-none"/>
    </div>
  </div>

  <div class="container text-body-tertiary">

    <div class="row justify-content-center">

      <div class="col-md-8">

        <h1 class="title fw-700 fz-32 lh-12">
          {$case->Depoimento_txa}
        </h1>

        {if $case->Depoimento_autor_txf}
        <div class="fz-22 fw-700 title mt-60">
          {$case->Depoimento_autor_txf}
        </div>
        {if $case->Depoimento_autor_subtitulo_txf}
        <div class="fz-14">
          <i>{$case->Depoimento_autor_subtitulo_txf}</i>
        </div>
        {/if}
        {/if}

      </div>

    </div>

  </div>

</section>
{/if}
