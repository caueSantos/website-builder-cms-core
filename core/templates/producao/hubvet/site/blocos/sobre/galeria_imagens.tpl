<section class="galeria-imagens-sobre pt-50 pb-50 pb-lg-80 bg-body-light">

  <div class="container">
    <div class="row">
      <div class="col-12">

        <div class="title-group text-center">
          <div class="title-image mb-25">
            <img src="{$assets}imagens/logo-title.png" class="pe-none"/>
          </div>
          <h1 class="title fz-32 fw-700 text-secondary">
            {titulo('sobre_interna_galeria', 'tit', $titulos)}
          </h1>
        </div>

        <div class="mt-50">
          {$imagens=$sobre[0]->Imagens}
          {$itens='1-2-3'}
          {$pagination=true}
          {$item_class='br-1 overflow-hidden'}
          {include file=$CAMINHO_TPL|cat:'componentes/galeria_imagens_carousel.tpl'}
        </div>

      </div>
    </div>
  </div>

</section>
