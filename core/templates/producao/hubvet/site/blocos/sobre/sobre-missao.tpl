{if $sobre_missao[0]}<section id="sobre-sobre-carreira" class="pt-50 pb-50 pt-md-80 pb-md-80">  <div class="container">    <div class="row">      <div class="col-md-5 order-2 order-md-0 pt-30 pt-md-0">        <div class="align-center">          <h1 class="title text-primary fw-700 fz-34">            {$sobre_missao[0]->Titulo_txf}          </h1>          <div class="texto fz-14 lh-15 mt-20">            {$sobre_missao[0]->Texto_txa}          </div>        </div>      </div>      <div class="col-lg-6 offset-lg-1 order-1 order-lg-0">        {$imagem=$sobre_missao[0]->Imagens[0]}        {$aspect='16-9'}        {include file=$CAMINHO_TPL|cat:'componentes/imagem_aspect.tpl'}      </div>    </div>  </div></section>{/if}