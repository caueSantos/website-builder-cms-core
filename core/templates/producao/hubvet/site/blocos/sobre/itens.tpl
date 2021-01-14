{if $sobre_itens[0]}
    {$height='100%'}
    {$fill_height=true}
    {$figure_height='100%'}
    {$radius=false}
    <section class="sobre-itens pt-40">

        {foreach from=$sobre_itens item=item key=key}
            <div class="galeria-item bg-body">
                {$order='order-2'}
                {if $key%2==0}{$order='order-1'}{/if}

                <div class="back container-fluid pl-0 pr-0 overflow-hidden">
                    <div class="row no-gutters fill-height" style="margin: 0 -1%">
                        <div class="col-lg-6 col-img  fill-height {$order}" style="max-width: 49.5%">
                            {$imagem=$item->Imagens[0]}
                            {include file=$CAMINHO_TPL|cat:'componentes/imagem.tpl'}
                        </div>
                        <div class="col-lg-6 col-txt order-1 fill-height" style="max-width: 49.5%"></div>
                    </div>
                </div>
                <div class="container">

                    <div class="row no-gutters">
                        <div class="col-lg-6 col-img {$order}" style="max-width: 49.5%"></div>
                        <div class="col-lg-6 col-txt order-1" style="max-width: 49.5%">
                            <div class="align-center pt-100 pb-100 {if $key==0}pl-50{else}pr-50{/if}">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-8">
                                        <div class="tit fw-700 text-primary fz-40 ff-montserrat lh-12">
                                            {$item->Titulo_txf}
                                        </div>
                                        <div class="texto mt-30">{$item->Texto_txa}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        {/foreach}


    </section>
{/if}
