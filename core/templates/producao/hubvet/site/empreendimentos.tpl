{if $segment2}
{include file=$CAMINHO_TPL|cat:'blocos/empreendimentos/interna.tpl'}
{else}
<main id="empreendimentos">

  {$titulo=titulo('interna_empreendimentos', 'tit', $titulos)}
  {include file=$CAMINHO_TPL|cat:'blocos/global/head_interna.tpl'}

  <div id="wrap" class="pt-lg-90 pt-30 pb-20">
    {foreach from=$empreendimentos item=empreendimento}
    <div class="mb-40">
      {include file=$CAMINHO_TPL|cat:'blocos/empreendimentos/empreendimento-item.tpl'}
    </div>
    {/foreach}
  </div>

</main>
{/if}

