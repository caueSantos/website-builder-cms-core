{assign var='tipo' value=$tipo|default:1}
{$paginas_dark=['cases', 'materiais']}
{$is_dark=in_array($pagina_atual, $paginas_dark)}
<section class="experimente {if $is_dark}bg-dark-grey-2{/if} {if $tipo == 1 || $is_dark}text-white{/if} pt-70 pb-80 overflow-hidden">

  {if $tipo == 1}
  <div class="bg-fake bg-primary" style="transform: skewY(-1.8deg); top: -24px;"></div>
  {/if}

  <div class="container">

    <div class="row">

      <div class="col-md-6">
        <div class="align-center">
          <div class="title-group">
            <h1 class="title fz-28 lh-12 fw-700">
              {titulo('experimente_secao', 'tit', $titulos)}
            </h1>
            {if titulo('experimente_secao', 'sub', $titulos)}
            <div class="texto fz-14 mt-10 lh-15">
              {titulo('experimente_secao', 'sub', $titulos)}
            </div>
            {/if}
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="row justify-content-center align-center">

          <div class="col-12 col-md-7">
            <input
              type="email" class="form-lands mb-0 {if $is_dark}form-outline form-dark{/if}" name="Email_txf"
              placeholder="{trans('form_email')}*"
              required
            />
          </div>

          <div class="col-12 col-md-5 pl-md-0">
            <button type="submit" class="btn-lands btn-lg btn-block {if $tipo == 1}btn-secondary{else}btn-primary{/if} btn-block pl-25 pr-25">
              {trans('experimente_secao_botao')}
            </button>
          </div>

        </div>
      </div>

    </div>

  </div>

</section>
