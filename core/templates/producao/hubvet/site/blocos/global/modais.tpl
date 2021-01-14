<div id="modal-encomende" class="modal fade">
  <div class="modal-dialog" style="max-width: var(--container-width); width: 100%;">

    <div class="container fill-height">

      <div class="row justify-content-center fill-height">

        <div class="col-12 col-lg-10">

          <div class="modal-content">

            <div class="pt-0 pb-0 pr-0 pl-0">
              <div class="row no-gutters">

                <div class="col-12 col-lg-5 col-img pr-0 d-none d-lg-block">
                  <figure class="fill-height bg-fake">
                    <img class="img-fit" src="{$assets}imagens/fundo-modal-encomende.png" alt="Encomende seu imóvel"/>
                  </figure>
                </div>

                <div class="col-12 col-lg-7 col-txt text-center text-lg-left">

                  <div class="pt-80 pt-lg-110 pb-50 pb-lg-110 pl-20 pl-lg-60 pr-20 pr-lg-60">

                    <div class="title-group">
                      <h1 class="title text-body-quaternary fz-32 lh-12 fw-700">
                        {titulo('encomende_modal', 'tit', $titulos)}
                      </h1>
                      {if titulo('encomende_modal', 'sub', $titulos)}
                      <div class="texto fz-14 mt-10 lh-15">
                        {titulo('encomende_modal', 'sub', $titulos)}
                      </div>
                      {/if}
                    </div>

                    <div class="mt-30">
                      {include file=$CAMINHO_TPL|cat:'blocos/global/form-interessado.tpl'}
                    </div>

                  </div>

                </div>

              </div>
            </div>

            <div style="position: absolute; right: 30px; top: 30px">
              <button type="button" class="close fz-30" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
                <span class="fz-30 text-accent" aria-hidden="true">&times;</span>
              </button>
            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
</div>
