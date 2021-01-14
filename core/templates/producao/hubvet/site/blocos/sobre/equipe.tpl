{if $equipe[0]}
<section id="equipe" class="pt-50 pt-lg-120">

  <div class="container">

    <div class="title-group">
      <h1 class="title text-body-quaternary fz-48 fw-700 lh-12">
        {titulo('sobre_interna_equipe', 'tit', $titulos)}
      </h1>
      {if titulo('sobre_interna_equipe', 'sub', $titulos)}
      <div class="texto lh-2 fz-16 fw-400">
        {titulo('sobre_interna_equipe', 'sub', $titulos)}
      </div>
      {/if}
    </div>

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
        <div class="col-equipe col-6 col-lg-3 mb-0 mb-lg-40 item">

          <article class="colaborador hover hover-opacity">

            <div class="imagem">
              {$imagem=$pessoa->Imagens[0]}
              {$aspect='1-1'}
              {include file=$CAMINHO_TPL|cat:'componentes/imagem_aspect.tpl'}
              <div class="equipe-redes">

                {if $pessoa->Facebook_txf}
                <a href="{$pessoa->Facebook_txf}" target="_blank"
                   class="d-inline-block va-middle fz-16 lh-0 text-primary-hover"
                   style="color: #1877F2"
                >
                  <i class="fab fa-facebook-square"></i>
                </a>
                {/if}

                {if $pessoa->Linkedin_txf}
                <a href="{$pessoa->Linkedin_txf}" target="_blank"
                   class="d-inline-block va-middle fz-16 lh-0 text-primary-hover pl-10"
                   style="color: #2977C9"
                >
                  <i class="fab fa-linkedin-in"></i>
                </a>
                {/if}

                {if $pessoa->Whatsapp_txf}
                <a href="https://api.whatsapp.com/send?phone={$pessoa->Whatsapp_txf}" target="_blank"
                   class="d-inline-block va-middle fz-16 lh-0 text-primary-hover pl-10"
                   style="color: #4CED69"
                >
                  <i class="fab fa-whatsapp"></i>
                </a>
                {/if}

              </div>
            </div>

            <div class="txt">

              <div class="title lh-12 nome fz-18 fw-700 text-body-quaternary mt-25">
                {$pessoa->Nome_txf}
              </div>

              <div class="cargo mt-5">{$pessoa->Cargo_txf}</div>

              <div class="contatos mt-15">
                {if $pessoa->Email_txf}
                <a href="mailto:{$pessoa->Email_txf}"
                   class="d-inline-block va-middle email fz-24 lh-0 text-primary-hover"
                   style="color: #C4C4D7"
                >
                  <i class="far fa-envelope"></i>
                </a>
                {/if}
                {if $pessoa->Telefone_txf}
                <a href="tel:{$pessoa->Telefone_txf}"
                   class="d-inline-block va-middle email fz-20 pl-10 lh-0 text-primary-hover"
                   style="color: #C4C4D7"
                >
                  <i class="far fa-phone-alt"></i>
                </a>
                {/if}
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

</section>
{/if}
