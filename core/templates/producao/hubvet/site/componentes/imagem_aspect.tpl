{assign var='aspect' value=$aspect|default:'4-3'}{assign var='imagem' value=$imagem|default:false}{assign var='radius' value=$radius|default:false}{assign var='fluid' value=$fluid|default:false}{assign var='height' value=$height|default:false}{assign var='hide_bg' value=$hide_bg|default:false}{if $height}{if $height == 'fill'}{$inner_height = 'auto'}{$fill_height = true}{else}{$inner_height = $height}{$fill_height = false}{/if}{/if}<div class="aspect aspect-{$aspect} {if $radius}br-{$radius}{/if} overflow-hidden {if !$hide_bg}bg-light-body{/if} {if $fill_height}fill-height{/if}" style="height: {$inner_height}">  <figure class="imagem aspect-item">    {if $imagem}    <img itemprop="image"         src="{$painel}{$imagem->Caminho_txf}"         alt="{$imagem->Descricao_txf}" title="{$imagem->Descricao_txf}"         class="mx-auto {if $fluid}img-fluid{else}img-fit{/if} d-block"    />    {else}    <img itemprop="image"         src="{$assets}imagens/indisponivel.png"         alt="Imagem indisponível" title="Imagem indisponível"         class="mx-auto {if $fluid}img-fluid{else}img-fit{/if} d-block"    />    {/if}  </figure></div>