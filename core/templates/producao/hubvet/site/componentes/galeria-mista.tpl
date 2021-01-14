{$id='galeria-mista-'|cat:rand()|cat:rand()}

{$principal=$imagens[0]}
{$imagens[0] = null}
{$imagens = $imagens|array_filter}

{if !$principal}
{$principal=$videos[0]}
{$videos[0] = null}
{$videos = $videos|array_filter}
{/if}

{$destaque=$videos[0]}
{$videos[0] = null}
{$videos = $videos|array_filter}

{if !$destaque}
{$destaque=$imagens[1]}
{$imagens[1] = null}
{$imagens = $imagens|array_filter}
{/if}

{$midia = array_merge($imagens, $videos)}
{$a=shuffle($midia)}

{if $midia || $principal}
<div class="container-fluid pr-0 pl-0 galeria-mista" id="{$id}">

  <div class="row no-gutters">

    <div class="{if $midia}col-lg-8 col-xga-9 pr-lg-15{else}col-12{/if}">

      <div class="define-tamanho bg-body-light fill-height {if $midia}br-2{/if} overflow-hidden pl-20"
           style="height: 648px; margin-left: -20px">

        {if $principal->Id_video_con}
        <a
          id="destaque-principal"
          class="d-block disable-fancybox-trigger abre-galeria _video hover hover-opacity fill-height"
          href="https://www.youtube.com/embed/{$principal->Endereco_txf}"
          data-fancybox="galeria-imovel{$imovel->Id_int}"
        >
          <figure class="video fill-height">
            <img class="img-fit" src="http://img.youtube.com/vi/{$principal->Endereco_txf}/hqdefault.jpg"/>
          </figure>
          {include file=$CAMINHO_TPL|cat:'componentes/video-overlay.tpl'}
        </a>
        {else if $principal->Id_imagem_con}
        <a
          id="destaque-principal"
          class="d-block disable-fancybox-trigger _imagem abre-galeria hover hover-opacity fill-height"
          href="{$painel}{$principal->Caminho_txf}"
          data-fancybox="galeria-imovel{$imovel->Id_int}"
        >
          <figure class="imagem-principal fill-height">
            <img class="img-fit" src="{$painel}{$principal->Caminho_txf}"/>
          </figure>
        </a>
        {/if}

        <div id="destaque-load-overlay" class="bg-fake bg-white text-center" style="opacity: 0.8; display: none;">
          <div class="inner align-center">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
          </div>
        </div>

      </div>

    </div>

    {if $midia}
    <div class="col-lg-4 col-xga-3 pr-lg-20">

      <div class="pr-lg-10 define-tamanho-2" style="height: 648px; overflow-y: auto">

        <div class="row owl-carousel owl-responsive justify-content-lg-center mx-lg-0"
             data-owl-items="4"
             data-rwd="1-2-4"
             data-owl-loop="true"
             data-owl-autoplay="true"
             data-owl-autoplay-timeout="6000"
             data-owl-margin="30"
             data-owl-dots="true"
             data-owl-nav="false"
             data-owl-slide-by="1"
             data-owl-dots-each="1"
             data-owl-dots-container="#{$id} .owl-dots"
        >

          {if $destaque}
          <div class="col-lg-12 item pl-10 pr-10 pt-20 pt-lg-0">
            <div class="bg-body-light br-2 overflow-hidden item-galeria" style="height: 260px">
              {if $destaque->Id_video_con}
              <a
                class="d-block disable-fancybox-trigger abre-galeria hover hover-opacity fill-height"
                href="https://www.youtube.com/embed/{$destaque->Endereco_txf}"
                data-fancybox="galeria-imovel{$imovel->Id_int}"
              >
                <figure class="video fill-height">
                  <img class="img-fit" src="http://img.youtube.com/vi/{$destaque->Endereco_txf}/mqdefault.jpg"/>
                </figure>
                {include file=$CAMINHO_TPL|cat:'componentes/video-overlay.tpl'}
              </a>
              {else if $destaque->Id_imagem_con}
              <a
                class="d-block disable-fancybox-trigger troca-destaque hover hover-opacity fill-height"
                href="{$painel}{$destaque->Caminho_txf}"
                data-fancybox="galeria-imovel{$imovel->Id_int}"
              >
                <figure class="imagem fill-height">
                  <img class="img-fit" src="{$painel}{$destaque->Caminho_txf}"/>
                </figure>
              </a>
              {/if}
            </div>
          </div>
          {/if}

          {foreach from=$midia item=m}
          <div class="col-lg-6 item pl-10 pr-10 pt-20">
            <div style="height: 174px" class="bg-body-light br-2 overflow-hidden item-galeria">
              {if $m->Id_video_con}
              <a
                class="d-block disable-fancybox-trigger abre-galeria hover hover-opacity fill-height"
                href="https://www.youtube.com/embed/{$m->Endereco_txf}"
                data-fancybox="galeria-imovel{$imovel->Id_int}"
              >
                <figure class="video fill-height">
                  <img class="img-fit" src="http://img.youtube.com/vi/{$m->Endereco_txf}/mqdefault.jpg"/>
                </figure>
                {include file=$CAMINHO_TPL|cat:'componentes/video-overlay.tpl'}
              </a>
              {else if $m->Id_imagem_con}
              <a
                class="d-block disable-fancybox-trigger troca-destaque hover hover-opacity fill-height"
                href="{$painel}{$m->Caminho_txf}"
                data-fancybox="galeria-imovel{$imovel->Id_int}"
              >
                <figure class="imagem fill-height">
                  <img class="img-fit" src="{$painel}{$m->Caminho_txf}"/>
                </figure>
              </a>
              {/if}
            </div>
          </div>
          {/foreach}

        </div>

      </div>

    </div>
    {/if}

  </div>

  <div class="rounded-dots d-block dmd-none text-center mt-30">
    <div class="owl-dots fz-18"></div>
  </div>

</div>
{/if}
