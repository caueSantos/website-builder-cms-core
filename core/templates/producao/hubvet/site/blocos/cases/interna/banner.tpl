<section class="case-banner pt-md-120 pb-md-100 pt-50 pb-50 text-center bg-primary text-white">

  {if $case->Imagens[0]->Caminho_txf}
  <div class="bg-fake">
    <img src="{$painel}{$case->Imagens[0]->Caminho_txf}" class="pe-none img-fit"/>
  </div>
  <div class="bg-fake bg-primary" style="opacity: .85"></div>
  {/if}

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-md-8">

        <h1 class="title fw-700 fz-36">
          {$case->Texto_principal_txa}
        </h1>

        {if $case->Texto_secundario_txa}
        <div class="texto mt-20 fz-14">
          {$case->Texto_secundario_txa}
        </div>
        {/if}

      </div>

    </div>

  </div>

</section>

{if $case->Texto_terciario_txa}
<section class="case-banner-2 pt-50 pb-50">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-md-8 text-center">
        <div class="texto fz-16">
          {$case->Texto_terciario_txa}
        </div>
      </div>

    </div>

  </div>

</section>
{/if}
