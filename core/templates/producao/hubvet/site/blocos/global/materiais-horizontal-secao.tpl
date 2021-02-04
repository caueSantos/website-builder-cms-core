<section id="contato" class="text-center bg-primary text-white pt-50 pb-50 pt-md-70 pb-md-80">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12 col-md-6">

                <div class="title-group">
                    <h1 class="title fz-36 fw-400">
                        {titulo('materiais-horizontal-secao', 'tit', $titulos)}
                    </h1>
                    {if titulo('materiais-horizontal-secao', 'sub', $titulos)}
                        <div class="texto fz-16 mt-15">
                            {titulo('materiais-horizontal-secao', 'sub', $titulos)}
                        </div>
                    {/if}
                </div>

            </div>

        </div>

        <div class="row justify-content-center mt-30">

            <div class="col-12 col-lg-4 pl-md-50 pr-md-50">
                {include file=$CAMINHO_TPL|cat:'blocos/global/forms/materiais-horizontal-secao-form.tpl'}
            </div>

        </div>

    </div>

</section>



