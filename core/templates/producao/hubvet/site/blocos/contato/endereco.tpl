{$paginas=['contato', 'ouvidoria']}{if in_array($pagina_atual, $paginas) == true}<section class="contato-endereco bg-secondary text-white text-center">  <div class="container">    <div class="row justify-content-center">      <div class="col-12 col-lg-12">        <div class="tits mt-50">          <h1 class="title fz-32 fw-700">{titulo('secao_endereco', 'tit', $titulos)}</h1>          {if titulo('secao_endereco', 'sub', $titulos)}          <div class="texto fz-14">            {titulo('secao_endereco', 'sub', $titulos)}          </div>          {/if}        </div>        <div class="mapas mt-40">          {foreach from=$enderecos item=endereco}          <article class="mapa bs-2 bg-body">            {if $enderecos[0]->Mapa_txf}            <iframe              src="{$enderecos[0]->Mapa_txf}" width="100%" height="480px" frameborder="0"              style="border:0"              allowfullscreen></iframe>            {else}            <iframe              src="https://www.google.com/maps?q={$enderecos[0]->Endereco_txf}, {$enderecos[0]->Bairro_txf}, {$enderecos[0]->Cidade_txf} - {$enderecos[0]->Estado_sel}&output=embed"              style="border:0" width="100%" height="480px" frameborder="0"              allowfullscreen></iframe>            {/if}          </article>          {/foreach}        </div>      </div>    </div>  </div></section>{/if}