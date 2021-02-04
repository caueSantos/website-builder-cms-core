{if $equipe[0]}
<section id="equipe" class="pt-50">

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="title-group text-center">
          <h1 class="title fz-36 text-primary fw-400 lh-12">
            {titulo('sobre_interna_equipe', 'tit', $titulos)}
          </h1>
          {if titulo('sobre_interna_equipe', 'sub', $titulos)}
          <div class="texto lh-2 fz-16 fw-400">
            {titulo('sobre_interna_equipe', 'sub', $titulos)}
          </div>
          {/if}
        </div>

      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="mt-45">

          <div class="row owl-carousel owl-responsive"
               data-owl-items="4"
               data-rwd="1-2-4"
               data-owl-loop="true"
               data-owl-autoplay="true"
               data-owl-autoplay-timeout="8000"
               data-owl-margin="30"
               data-owl-dots="true"
               data-owl-nav="false"
               data-owl-slide-by="1"
               data-owl-dots-each="1"
               data-owl-dots-container="#equipe .owl-dots"
          >

            {foreach from=$equipe item=pessoa}
            <div class="col-equipe col-6 col-lg-4 mb-0 mb-lg-40 item">

              <article class="colaborador hover hover-opacity">

                <div class="imagem">
                  {$imagem=$pessoa->Imagens[0]}
                  {$aspect='1-1'}
                  {include file=$CAMINHO_TPL|cat:'componentes/imagem_aspect.tpl'}
                  <div
                    class="bg-fake img-drop"
                    style="background-image: url('{$painel}{$imagem->Caminho_txf}');"
                  ></div>
                </div>

                <div class="txt">

                  <div class="title lh-12 nome fz-22 fw-700 text-body-quaternary mt-25">
                    {$pessoa->Nome_txf}
                  </div>

                  <div class="cargo mt-5 fz-14">
                    {$pessoa->Cargo_txf}
                  </div>

                </div>

              </article>

            </div>
            {/foreach}

          </div>

          <div class="rounded-dots d-block d-lg-none text-center mt-30">
            <div class="owl-dots fz-18"></div>
          </div>

        </div>
      </div>
    </div>

  </div>

</section>
{/if}
