<div class="banner_fundo">



      <div class='banner container'>

            {foreach from=$banners item=banner}
                  <div class='banner-item'> 
                        <a href="{$app->Url_cliente}{$banner->Link_txf}">
                              <img id="img1" src="{$app->Url_cliente}{$app->Pasta_painel}/{$banner->Caminho_txf}" />
                        </a>
                  </div>


            {/foreach}
            <div class='banner-setas banner-setae'></div>
            <div class='banner-setas banner-setad'></div>
            <div class='banner-barra centraliza'></div>
      </div>
</div>