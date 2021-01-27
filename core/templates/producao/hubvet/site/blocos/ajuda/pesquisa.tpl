<section class="ajuda-busca bg-dark-grey text-white pt-50 pb-50 pb-md-100">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="title-group text-center">
          <h1 class="title text-white fz-36 fw-400 lh-12">
            {titulo('ajuda_interna', 'tit', $titulos)}
          </h1>
          {if titulo('ajuda_interna', 'sub', $titulos)}
          <div class="texto fz-16 mt-20 lh-15 text-white">
            {titulo('ajuda_interna', 'sub', $titulos)}
          </div>
          {/if}
        </div>
      </div>
    </div>

    <div class="row no-gutters justify-content-center mt-25">
      <div class="col-md-6 pr-lg-15">
        {include file=$CAMINHO_TPL|cat:'blocos/ajuda/form_busca_ajuda.tpl'}
      </div>
      <div class="col-lg-2 d-none d-lg-block">
        <button id="simula-busca" type="submit" class="btn-lands btn-lg btn-block btn-primary btn-block pl-25 pr-25">
          {trans('buscar_botao')}
        </button>
      </div>
    </div>
  </div>

</section>
