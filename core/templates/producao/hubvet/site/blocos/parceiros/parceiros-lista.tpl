{assign var='tipo' value=$tipo|default:1}
{if $parceiros[0]}
<section class="parceiros-lista {if $tipo == 1}bg-primary{else}bg-dark-grey{/if} pt-40 pb-20 pt-md-70 pb-md-50">

  <div class="container">

    <div class="title-group text-center text-white">
      <h1 class="title fz-40 lh-12 fw-400 {if $tipo == 2}text-primary{/if}">
        {titulo('parceiros_secao', 'tit', $titulos)}
      </h1>
      {if titulo('parceiros_secao', 'sub', $titulos)}
      <div class="texto fz-18 mt-15 lh-15">
        {titulo('parceiros_secao', 'sub', $titulos)}
      </div>
      {/if}
    </div>

    <div class="row justify-content-center mt-60">

      {foreach from=$parceiros item=parceiro}
      {$icone=$parceiro->Imagens[0]}
      <div class="col-6 col-md-2 pl-15 pr-15 pl-md-25 pr-md-25">
        <a
          href="{if $parceiro->Link_txf && is_url($parceiro->Link_txf)}{$parceiro->Link_txf}{else}javascript:void(0);{/if}"
          class="link-item d-block text-center tn-ease mb-50 hover hover-opacity-reverse"
          title="{$parceiro->Nome_txf}"
          target="_blank"
        >
          <div class="mx-auto" style="height: 60px">
            <figure class="imagem" style="height: 60px">
              {if $icone}
              <img style="height: auto; max-height: 60px; width: auto; max-width: 100%;"
                   alt="{$parceiro->Nome_txf}" src="{$painel}{$icone->Caminho_txf}"
                   class="align-center"/>
              {else}
              <img style="height: auto; max-height: 60px; width: auto; max-width: 100%;"
                   class="align-center"
                   alt="{$parceiro->Nome_txf}" src="{$assets}imagens/indisponivel-quadrada.png"/>
              {/if}
            </figure>
          </div>
        </a>
      </div>
      {/foreach}

    </div>

  </div>

</section>
{/if}
