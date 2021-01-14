<script type="text/template" id="servico-modal-content">
  <div class="container fill-height">

    <div class="row justify-content-center fill-height">

      <div class="col-12 col-lg-11">

        <div class="modal-content">

          <div class="pt-60 pb-50 pr-20 pl-20 pt-lg-60 pb-lg-60 pr-lg-100 pl-lg-100">
            <div class="row">

              <div class="col-12 col-lg-5 col-img pr-lg-55">

                <div class="aspect aspect-1-1 br-100 overflow-hidden bg-body-light">
                  <figure class="imagem aspect-item">
                    <img class="img-fit" src="<%imagem%>" alt="<%titulo_alt%>"/>
                  </figure>
                </div>

                <div class="info text-center mt-30">
                  <div class="text-body-secondary">
                    <div><strong>Deseja mais informações?</strong></div>
                    Entre em contato conosco
                  </div>
                  <a href="javascript:void(0);"
                     class="pl-30 pr-30 btn-lands btn-outline bw-2 mt-20 btn-sm"
                     onclick="document.querySelector('.lands-whatsapp-fab').click()">
                    <i class="fz-18 fab fa-whatsapp fw-500 mr-5"></i>
                    WhatsApp
                  </a>
                </div>

              </div>

              <div class="col-12 col-lg-7 col-txt pt-50 text-center text-lg-left">
                <h3 class="title fz-26 fz-lg-40 fw-700 text-primary lh-12"><%&titulo%></h3>
                <div class="texto fz-16 text-body-secondary mt-30 lh-18"><%&descricao%></div>
              </div>

            </div>
          </div>

          <div style="position: absolute; right: 30px; top: 30px">
            <button type="button" class="close fz-30" data-dismiss="modal" aria-label="Close" style="opacity: 1;">
              <span class="fz-30 text-primary" aria-hidden="true">&times;</span>
            </button>
          </div>

        </div>

      </div>

    </div>

  </div>
</script>

<script type="text/template" id="imovel-item-content">
  <div class="col-12 col-md-6 col-lg-4 pb-30">
    <article class="imovel-item fill-height">

      <a href="{$app->Url_cliente_linguagem}imoveis/<%= it.Nome_url %>"
         class="fill-height text-body-primary hover hover-scale-up hover-shadow d-block br-1 overflow-hidden"
         style="border: 1px solid #F0F0F8;">

        <div class="aspect aspect-4-3 overflow-hidden bg-body-light">
          <figure class="aspect-item">
            <img
              class="img-fit"
              src="<%? it.Imagens[0] %><%= it._appUtils.painel %><%= it.Imagens[0].Caminho_txf %><%??%><%= it._appUtils.assets %>imagens/indisponivel-quadrada.png<%?%>"
              alt="<%= it.Nome_url %>"
            />
          </figure>
        </div>

        <div class="pl-25 pr-25 pt-35 <%? it.Caracteristicas_vin.length %>pb-20<%??%>pb-35<%?%>">

          <div class="title fz-18 fw-700 text-body-secondary" data-clamp="1">
            <%= it.Nome_tit %>
          </div>

          <%? it.Descricao_txa %>
          <div class="desc mt-20" data-clamp="3">
            <%= it.Descricao_txa %>
          </div>
          <%?%>

          <%? it.Caracteristicas_vin %>
          <div class="caracteristicas mt-30">
            <div class="row">
              <%~ it.Caracteristicas_vin :value%>
              <%? value.Valor_min_txf.length || value.Valor_max_txf.length %>
              <div class="col-12 col-md-6 col-lg-6 mb-15" title="<%= value.Nome_tit %>">

                <div class="d-flex fill-height">

                  <%? value.Imagens[0] %>
                  <div class="align-self-center mr-10" style="width: 24px;">
                    <img style="width: auto; height: auto" src="{$painel}<%= value.Imagens[0].Caminho_txf %>"
                         class="mx-auto pe-none d-block"/>
                  </div>
                  <%?%>

                  <div class="align-self-center fw-700 fz-14 lh-12">
                      <%? value.Valor_min_txf.length %>
                      <%= value.Valor_min_txf %>
                      <%?%>

                      <%? value.Valor_min_txf.length && value.Valor_max_txf.length %>
                      a
                      <%?%>

                      <%? value.Valor_max_txf.length %>
                      <%= value.Valor_max_txf %>
                      <%?%>

                      <%? value.Sufixo_txf %>
                      <%= value.Sufixo_txf %>
                      <%?%>
                  </div>

                </div>

              </div>
              <%?%>
              <%~%>
            </div>
          </div>
          <%?%>

        </div>

      </a>

    </article>
  </div>
</script>
