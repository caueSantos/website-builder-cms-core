<section class="planos-lista pt-40 pb-40 pt-md-70 pb-md-70">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-12 col-md-10">

        <div class="row">

          {foreach from=$planos item=plano}

          <div class="col-md-4 col-plano">

            <div class="plano pl-15 pr-15 text-body-secondary">

              <div class="plano-header text-body-tertiary">

                <div class="d-block text-secondary fz-14">
                  {if $plano->Recomendado_sel == 'SIM'}
                  {trans('mais_recomendado')}
                  {else}
                  <span style="color: transparent">.</span>
                  {/if}
                </div>

                <div class="fz-22 fw-700 {if $plano->Recomendado_sel == 'SIM'}text-secondary{/if}">
                  {$plano->Titulo_txf}
                </div>

                {if $plano->Valor_txf}
                <div class="valor mt-10">
                  <span class="fz-48">{$app->Intl->currency->currency}</span>
                  <span class="fz-48">{formata_preco($plano->Valor_txf)}</span>
                  {if $plano->Frequencia_cobranca_sel}
                  <span class="fz-18">
                  / {$plano->Frequencia_cobranca_sel}
                </span>
                  {/if}
                </div>
                {/if}

                {if $plano->Descricao_txa}
                <div class="texto fz-14 mt-15">
                  {$plano->Descricao_txa}
                </div>
                {/if}

                {if !$plano->Valor_txf}
                {if is_url($plano->Botao_link_txf) && $plano->Botao_texto_txf}
                <div class="botao mt-15">
                  <a target="_blank"
                     class="text-secondary fw-700"
                     href="{gera_link($plano->Botao_link_txf, true)}"
                  >
                    {$plano->Botao_texto_txf}
                  </a>
                </div>
                {/if}
                {/if}

              </div>

              <div class="plano-funcionalidades mt-30">

                <div class="fz-12 fw-700 text-body-primary">
                  {trans('funcionalidades_incluidas')}
                </div>

                <ul class="mt-30">
                  {foreach from=$plano_itens item=item}
                  {$existe_item=get_object($plano->plano_itens, 'Id_int', '=', $item->Id_int)}
                  <li class="mb-15">
                    <i class="fas fa-check-circle fz-14 {if $existe_item}text-success{/if}"></i>
                    <span class="pl-15 fz-14">
                    {$item->Nome_txf}
                    </span>
                  </li>
                  {/foreach}
                </ul>

              </div>

              {if is_url($plano->Botao_link_txf) && $plano->Botao_texto_txf}
              <div class="botao mt-40">
                <a target="_blank"
                   class="btn-lands btn-primary pl-15 pr-15 {if $plano->Recomendado_sel != 'SIM'}btn-outline{/if} d-block"
                   href="{gera_link($plano->Botao_link_txf, true)}"
                >
                  {$plano->Botao_texto_txf}
                </a>

                <div class="d-block text-primary text-center fz-14 mt-10">
                  {if $plano->Recomendado_sel == 'SIM'}
                  {trans('mais_recomendado')}
                  {else}
                  <span style="color: transparent">.</span>
                  {/if}
                </div>

              </div>
              {/if}

            </div>

          </div>

          {/foreach}

        </div>

      </div>

    </div>

  </div>

</section>
