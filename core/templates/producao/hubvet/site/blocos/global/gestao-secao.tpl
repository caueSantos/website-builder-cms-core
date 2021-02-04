<section
  class="gestao-secao text-white pt-70 pb-80 overflow-hidden bg-primary">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-md-6 text-center">
        <div class="align-center">
          <div class="title-group">
            <h1 class="title fz-32 lh-12 fw-700">
              {titulo('cadastrar_secao', 'tit', $titulos)}
            </h1>
            {if titulo('cadastrar_secao', 'sub', $titulos)}
            <div class="texto fz-14 mt-10 lh-15">
              {titulo('cadastrar_secao', 'sub', $titulos)}
            </div>
            {/if}
          </div>
        </div>
      </div>
      </div>

    <div class="row justify-content-center mt-30">

      <div class="col-md-6">
        <div class="row justify-content-center">

          <div class="col-12 col-md-7">
            <input
              type="email" class="form-lands mb-0 form-outline form-dark" name="Email_txf"
              placeholder="{trans('form_email')}*"
              required
            />
          </div>

          <div class="col-12 col-md-5 pl-md-0">
            <button type="submit"
                    class="btn-lands btn-lg btn-block btn-accent pl-25 pr-25">
              {trans('cadastrar_botao')}
            </button>
          </div>

        </div>
      </div>

    </div>

  </div>

</section>
