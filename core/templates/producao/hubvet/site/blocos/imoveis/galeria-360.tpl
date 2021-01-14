{$id='galeria-'|cat:rand()|cat:rand()}
<section class="galeria-360" id="galeria-360-{$id}">
  <div class="container">
    <div class="row no-gutters">

      <div class="col-lg-12">

        <div class="owl-carousel carousel-360"
             data-owl-carousel
             data-owl-items="1"
             data-rwd="1-1-1"
             data-owl-loop="true"
             data-owl-autoplay="false"
             data-owl-margin="15"
             data-owl-dots="true"
             data-owl-nav="false"
             data-owl-autoplay-hover-pause="true"
             data-owl-dots-container="#galeria-360-{$id} .owl-dots"
        >
          {foreach from=$mapas item=mapa}
          {if $mapa->Link_360_txf}
          <div class="item overflow-hidden br-2">
            <div class="aspect aspect-21-9 br-2 overflow-hidden bg-body-light">
              <figure class="aspect-item image-layer">
                <iframe
                  class="inner-item img-fit"
                  src="https://www.google.com/maps/embed?pb={$mapa->Link_360_txf}"
                  frameborder="0"
                  style="border:0;"
                  allowfullscreen=""
                  aria-hidden="false"
                  tabindex="0"
                ></iframe>
              </figure>
            </div>
          </div>
          {/if}
          {/foreach}
        </div>

        <div class="rounded-dots d-block text-center mt-30">
          <div class="owl-dots fz-18"></div>
        </div>

      </div>

    </div>

  </div>

</section>
