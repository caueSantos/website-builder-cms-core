{if $problemas[0]}
<section class="problemas pt-40 pt-md-80 pb-md-110 pb-80">

  <div class="container">

    <div class="title-group text-primary text-center">
      <h1 class="title fz-40 lh-12 fw-400">
        {titulo('problemas_secao', 'tit', $titulos)}
      </h1>
      {if titulo('problemas_secao', 'sub', $titulos)}
      <div class="texto fz-18 mt-10 lh-15">
        {titulo('problemas_secao', 'sub', $titulos)}
      </div>
      {/if}
    </div>

    <div class="row justify-content-center mt-40">

      <div class="col-12">

        <div class="lands-tabs">

          <ul class="nav nav-fill" role="tablist">
            {$key=0}
            {foreach from=$problemas item=problema}
            {if $problema->Problemas_vin[0]}
            <li class="nav-item">
              <a class="{if $key == 0}active{/if}"
                 id="problema-tab-{$problema->Id_int}"
                 data-toggle="tab"
                 href="#problema-{$problema->Id_int}"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                {$problema->Titulo_txf}
              </a>
            </li>
            {$key=$key+1}
            {/if}
            {/foreach}
          </ul>

        </div>

      </div>

      <div class="col-12 col-md-10 mt-40 mt-md-80">
        <div class="tab-content" id="myTabContent">
          {$key=0}
          {foreach from=$problemas item=problema}
          {if $problema->Problemas_vin[0]}
          <div
            class="tab-pane fade show {if $key == 0}active{/if}"
            id="problema-{$problema->Id_int}"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            {$vin_count = ceil(count($problema->Problemas_vin) / 2)}
            {$problema_divide = array_chunk($problema->Problemas_vin, $vin_count)}

            <div class="row">

              <div class="col-md-4 pl-50">
                {foreach from=$problema_divide[0] item=item}
                <div class="d-flex mb-30">
                  <div class="flex-shrink-1 align-items-center d-flex text-success">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="flex-grow-1 pl-30 fz-14">
                    {$item->Texto_txf}
                  </div>
                </div>
                {/foreach}
              </div>

              <div class="col-md-4 d-none d-md-block">
                {if $problema->Imagens[0]}
                <div class="mt-10">
                  <figure class="imagem">
                    <img
                      src="{$painel}{$problema->Imagens[0]->Caminho_txf}"
                      title="{$problema->Texto_txf}"
                      alt="{$problema->Texto_txf}"
                      class="img-fluid"
                    />
                  </figure>
                </div>
                {/if}
              </div>

              <div class="col-md-4 pr-50">
                {foreach from=$problema_divide[1] item=item}
                <div class="d-flex mb-30">
                  <div class="flex-shrink-1 align-items-center d-flex text-success">
                    <i class="fas fa-check-circle"></i>
                  </div>
                  <div class="flex-grow-1 pl-30 fz-14">
                    {$item->Texto_txf}
                  </div>
                </div>
                {/foreach}
              </div>

            </div>

          </div>
          {$key=$key+1}
          {/if}
          {/foreach}
        </div>
      </div>

    </div>

    <div class="botao mt-30 text-center">
      <a href="{$banner->Botao_Link_txf}" target="_blank" class="btn-lands btn-primary text-white">
        {trans('problemas_secao_botao')}
      </a>
    </div>

  </div>

</section>
{/if}
