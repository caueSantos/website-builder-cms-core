<div id="lista-vagas" class="lista-vagas pt-50 pt-md-70 pb-50 pb-md-80">  <div class="container-fluid pl-0 pr-0">    <div class="row justify-content-center">      <div class="col-md-6">        <div class="title-group text-center mb-30">          <h1 class="title text-primary fz-36 fw-400 lh-12">            {titulo('carreira_vagas', 'tit', $titulos)}          </h1>          {if titulo('carreira_vagas', 'sub', $titulos)}          <div class="texto fz-16 mt-20 lh-15">            {titulo('carreira_vagas', 'sub', $titulos)}          </div>          {/if}        </div>      </div>    </div>    <div class="row no-gutters bg-dark-grey">      {if $vagas[0]}      {foreach from=$vagas item=vaga}      <div class="col-12 col-md-4 col-carreira overflow-hidden">        <a          href="{$app->Url_cliente}carreira/{$vaga->Nome_url}"          class="d-block text-white bg-primary carreira-item hover hover-scale-up hover-opacity cursor-pointer"        >          {if $vaga->Imagens[0]}          <div class="bg-fake">            <img class="img-fit" src="{$painel}{$vaga->Imagens[0]->Caminho_txf}"/>          </div>          {/if}          <div class="overlay bg-fake"></div>          <div class="txt pl-40 pr-40 pb-30 pt-30 pb-md-70 pt-md-50">            <div class="vaga-prefixo fz-26 fw-300 title lh-1">              {trans('vaga_de')}            </div>            <div class="vaga-nome fz-26 fw-700 title">              {$vaga->Nome_tit}            </div>            <div class="inscrever fz-14 mt-10">              {trans('canditatar_vaga')}            </div>          </div>        </a>      </div>      {/foreach}      {else}      <div class="col-12 pl-15 pr-15 pt-50 pb-50 pt-md-100 pb-md-100 text-center">        <div class="fz-22 text-white fw-700 title">          {trans('sem_vagas')}        </div>        <div class="pl-30 pr-30 pt-30">          <a class="btn-lands btn-lg btn-primary pl-60 pr-60 text-white">            {trans('cadastre_curriculo')}          </a>        </div>      </div>      {/if}    </div>    {if $vagas[0]}    <div class="row justify-content-center mt-60">      <div class="col-12 col-md-auto">        <div>          <a class="btn-lands btn-lg btn-primary pl-60 pr-60 text-white" onclick="alert('modal curriculo')">            {trans('ou_cadastre_curriculo')}          </a>        </div>      </div>    </div>    {/if}  </div></div>