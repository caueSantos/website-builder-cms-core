<div id="perguntas-ajax">  <div id="accordion-perguntas">    {foreach from=$perguntas->registros item=pergunta key=key}    <div class="head text-center {if $key > 0}mt-25{/if}">      <div        data-toggle="collapse"        data-target="#pergunta-{$pergunta->Id_int}"        aria-expanded="true"        aria-controls="collapseOne"        class="d-inline-block title fw-700 fz-18 text-secondary cursor-pointer {if $key > 0}collapsed{/if}"      >        <span class="simple-arrow va-middle"></span>        <span class="va-middle pl-5">{$pergunta->Pergunta_txa}</span>      </div>    </div>    <div id="pergunta-{$pergunta->Id_int}"         class="collapse {if $key==0}show{/if}"         data-parent="#accordion-perguntas"    >      <div class="texto text-center pt-10">        {$pergunta->Resposta_txa}      </div>    </div>    {/foreach}  </div>  {$paginacao=$perguntas->paginacao}  {include file=$CAMINHO_TPL|cat:'blocos/global/paginacao.tpl'}</div>