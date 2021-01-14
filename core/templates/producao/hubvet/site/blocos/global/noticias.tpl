{$noticias=wp_posts(2, 9, false)}<section id="noticias" class="bg-body-light text-center text-lg-left pt-50 pb-50 pt-lg-70 pb-lg-120">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-lg-12">        <div class="text-center">          <div class="title-group">            <div class="title-image mb-25">              <img src="{$assets}imagens/logo-title.png" class="pe-none"/>            </div>            <h1 class="title fz-32 fw-700 text-secondary">              {titulo('secao_noticias', 'tit', $titulos)}            </h1>            {if titulo('secao_noticias', 'sub', $titulos)}            <div class="texto fz-18">              {titulo('secao_noticias', 'sub', $titulos)}            </div>            {/if}          </div>        </div>        {if $noticias}        <div class="owl-carousel mt-40"             data-owl-carousel             data-rwd="1-2-3"             data-owl-loop="true"             data-owl-autoplay="true"             data-owl-autoplay-timeout="10000"             data-owl-margin="30"             data-owl-dots="true"             data-owl-nav="false"             data-owl-slide-by="1"             data-owl-dots-each="1"             data-owl-dots-container="#noticias .owl-dots"        >          {foreach from=$noticias item=noticia}          <div class="item">            <a              href="{$noticia->guid}"              class="link-item d-block fill-height hover-scale-down"            >              <div style="border-bottom: 12px solid var(--tertiary);" class="br-1 mb-30 bg-tertiary">                <figure class="imagem bg-secondary br-1 overflow-hidden" style="height: 240px;">                  {if $noticia->image}                  <img alt="{strip_tags($noticia->post_title)}" src="{$noticia->image}" class="img-fit"/>                  {else}                  <img alt="{strip_tags($noticia->post_title)}" src="{$assets}imagens/indisponivel-quadrada.png"                       class="img-fit"/>                  {/if}                </figure>              </div>              <div class="title fz-22 fw-600 text-body-primary lh-12" data-clamp="2">                {$noticia->post_title}              </div>              {if $noticia->post_content}              <div class="texto fz-18 mt-10 text-body-primary lh-15" data-clamp="3">                {corta_texto($noticia->post_content, 200)}              </div>              {/if}              <div class="botao mt-20">                <div target="_blank" class="title fz-18 fw-700 text-primary d-block">                  Continuar lendo                </div>              </div>            </a>          </div>          {/foreach}        </div>        <div class="rounded-dots d-block d-lg-none text-center mt-30">          <div class="owl-dots fz-18"></div>        </div>        <div class="botao mt-50 text-center mx-auto" style="width: 240px">          <a target="_blank" href="{$app->Url_cliente_linguagem}blog" class="btn-lands btn-block">            Ver tudo          </a>        </div>        {else}        <div class="text-center text-primary fz-24 mt-40 fw-700">          Não temos nada para mostrar por enquanto. <br>          Fique ligado que em breve traremos novidades!        </div>        {/if}      </div>    </div>  </div></section>