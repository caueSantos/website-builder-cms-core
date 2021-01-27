{$categoria = $requisicao['categoria']}

{$existe_item=false}

{foreach from=$materiais item=material}

{$filtro=true}
{if $categoria}
{$filtro=get_object($material->categorias, 'Nome_url', '=', $categoria)}
{/if}

{if $filtro && is_url($material->Link_txf)}
{$existe_item=true}
<div class="col-md-6 pl-md-25 pr-md-25 mb-50">

  <a class="material hover hover-scale-down d-block" href="{$material->Link_txf}" target="_blank">

    <div class="aspect aspect-16-9 br-2 overflow-hidden">
      <figure class="imagem aspect-item">
        {if $material->Imagens[0]}
        <img src="{$painel}{$material->Imagens[0]->Caminho_txf}" class="img-fit"/>
        {else}
        <img src="{$assets}imagens/indisponivel.png" class="img-fit"/>
        {/if}
      </figure>
    </div>

    <div class="title fw-700 text-primary fz-18 mt-20">
      {$material->Titulo_txf}
    </div>

    <div class="texto lh-15 fz-14 mt-10 text-body-secondary" data-clamp="2">
      {$material->Descricao_txa}
    </div>

    <div class="botao">
      <div class="fz-16 fw-700 text-primary mt-10">
        {trans('baixar_agora')}
      </div>
    </div>

  </a>

</div>

{/if}

{/foreach}
{if !$existe_item}

<div class="col-12 text-center pt-50 pb-50">

  <div class="fz-18 fw-700">{trans('nenhum_item_encontrado')}</div>

</div>

{/if}
