{if !$tipo_header}{$tipo_header=1}{/if}<header class="headinterna bg-primary">  <div class="container">    <div class="row justify-content-center">      <div class="col-lg-7">        <div class="pt-20 pb-20 pt-lg-80 pb-lg-100 text-center">          <h1 class="title fz-48 fw-700 text-white lh-12">            {$titulo}          </h1>          {if $tipo_header == 1 && $subtitulo}          <div class="texto d-block text-white fz-18 mt-25 lh-1 ff-secondary">            {$subtitulo}          </div>          {/if}        </div>      </div>    </div>  </div></header>