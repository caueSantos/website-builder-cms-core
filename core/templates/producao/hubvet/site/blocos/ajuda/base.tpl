{if $ajuda_itens[0] && $ajuda_categorias[0]}
{$ajuda_categorias = junta_registros($ajuda_categorias, 'Nome_url', $ajuda_itens, 'Categoria_ajuda_sel', 'Itens')}
<section class="pt-50 pt-md-70 pb-md-20">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-8">

        <div class="title-group text-center">
          <h1 class="title fz-36 fw-400 lh-12 text-primary">
            {titulo('ajuda_interna_itens', 'tit', $titulos)}
          </h1>
          {if titulo('ajuda_interna_itens', 'sub', $titulos)}
          <div class="texto fz-16 mt-20 lh-15">
            {titulo('ajuda_interna_itens', 'sub', $titulos)}
          </div>
          {/if}
        </div>

      </div>

      <div class="col-12 text-center mt-30">

        <div class="lands-tabs lands-tabs-2">

          <ul class="nav nav-fill" role="tablist">
            {$key=0}
            {foreach from=$ajuda_categorias item=ajuda}
            {if $ajuda->Itens[0]}
            <li class="nav-item">
              <a class="{if $key == 0}active{/if}"
                 id="ajuda-tab-{$ajuda->Id_int}"
                 data-toggle="tab"
                 href="#ajuda-{$ajuda->Nome_url}"
                 role="tab"
                 aria-controls="home"
                 aria-selected="true"
              >
                {$ajuda->Nome_tit}
              </a>
            </li>
            {$key=$key+1}
            {/if}
            {/foreach}
          </ul>

        </div>

      </div>

      <div class="col-12 col-md-10 mt-40 mt-md-70">
        <div class="tab-content" id="myTabContent">
          {$key=0}
          {foreach from=$ajuda_categorias item=categoria}
          {if $categoria->Itens[0]}
          <div
            class="tab-pane fade show {if $key == 0}active{/if}"
            id="ajuda-{$categoria->Nome_url}"
            role="tabpanel"
            aria-labelledby="home-tab"
          >

            <div class="row justify-content-center">

              {foreach from=$categoria->Itens item=ajuda}

              <div class="col-md-4 pb-50">

                <a
                  href="{gera_link($ajuda->Link_txf, true)}"
                  target="_blank"
                  class="ajuda-item d-block text-center fill-height hover hover-scale-down text-body-primary text-primary-hover"
                >

                  <figure class="imagem">
                    {if $ajuda->Imagens[0]}
                    <img
                      src="{$painel}{$ajuda->Imagens[0]->Caminho_txf}"
                      title="{$ajuda->Texto_txf}"
                      alt="{$ajuda->Texto_txf}"
                      style="height: 32px; width: auto"
                    />
                    {else}
                    <img
                      src="{$assets}imagens/ajuda-icone.png"
                      title="{$ajuda->Texto_txf}"
                      alt="{$ajuda->Texto_txf}"
                      style="height: 32px; width: auto"
                    />
                    {/if}
                  </figure>

                  <div class="title fw-700 mt-15">
                    {$ajuda->Nome_txf}
                  </div>

                  {if $ajuda->Descricao_txa}
                  <div class="title fz-14 mt-10">
                    {$ajuda->Descricao_txa}
                  </div>
                  {/if}

                </a>

              </div>

              {/foreach}

            </div>

          </div>
          {$key=$key+1}
          {/if}
          {/foreach}
        </div>
      </div>

    </div>

  </div>

</section>
{/if}
