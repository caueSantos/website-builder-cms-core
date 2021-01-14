{assign var='tpl' value=$tpl|default:false}
{assign var='assunto' value=$assunto|default:false}
{assign var='envia_email' value=$envia_email|default:false}
{assign var='tipo_lead' value=$tipo_lead|default:false}
{assign var='tabela' value=$tabela|default:false}

<form class="form-generico" onsubmit="return false" novalidate>

  <div class="row">

    <div class="col-12 col-lg-6">

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Informações Pessoais
        </h3>

        <div class="form-lands-group">
          <input name="Nome_txf"
                 placeholder="Digite seu nome*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um nome válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Telefone_txf"
                 placeholder="Digite seu telefone*"
                 type="text"
                 class="form-control form-lands phone-mask"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um telefone válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Email_txf"
                 placeholder="Digite seu e-mail*"
                 type="email"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um email válido.
          </div>
        </div>

      </div>

      <hr class="mb-30 mt-20"/>

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Endereço
        </h3>

        <div class="form-lands-group">
          <input name="Cep_txf"
                 placeholder="CEP*"
                 type="text"
                 id="busca-cep-avalie"
                 class="form-control form-lands cep-mask"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um CEP válido.
          </div>
        </div>

        <div class="form-lands-group">
          <select name="Estado_txf"
                  data-placeholder="Estado*"
                  type="text"
                  id="estados-avalie"
                  class="custom-select form-lands"
                  required="required"
          ></select>
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um estado válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Cidade_txf"
                 placeholder="Cidade*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha uma cidade válida.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Bairro_txf"
                 placeholder="Bairro*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um bairro válido.
          </div>
        </div>

        <div class="form-lands-group">
          <input name="Endereco_txf"
                 placeholder="Endereço*"
                 type="text"
                 class="form-control form-lands"
                 required="required"
          />
          <div class="form-lands-feedback invalid-feedback fz-12">
            Por favor, escolha um endereço válido.
          </div>
        </div>

        <div class="row">

          <div class="col-lg-6">

            <div class="form-lands-group">
              <input name="Numero_txf"
                     placeholder="Número*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha um número válido.
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="form-lands-group">
              <input name="Complemento_txf"
                     placeholder="Complemento"
                     type="text"
                     class="form-control form-lands"
              />
            </div>
          </div>

        </div>

      </div>

    </div>

    <div class="col-12 col-lg-6">

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Número de Ambientes
        </h3>

        <div class="row">
          <div class="col-6">

            <div class="form-lands-group">
              <input name="Quartos_txf"
                     placeholder="Quartos*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha uma quantidade de quartos válida.
              </div>
            </div>

          </div>

          <div class="col-6">

            <div class="form-lands-group">
              <input name="Banheiros_txf"
                     placeholder="Banheiros*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha uma quantidade de banheiros válida.
              </div>
            </div>

          </div>

          <div class="col-6">

            <div class="form-lands-group">
              <input name="Garagem_txf"
                     placeholder="Vagas de garagem*"
                     type="text"
                     class="form-control form-lands"
                     required="required"
              />
              <div class="form-lands-feedback invalid-feedback fz-12">
                Por favor, escolha uma quantidade de vagas válida.
              </div>
            </div>

          </div>

          <div class="col-6">

            <div class="form-lands-group">
              <select name="Mobiliado_txf"
                      data-placeholder="Está mobiliado"
                      type="text"
                      class="custom-select form-lands"
                      required="required"
              >
                <option value="Não mobiliado">Não mobiliado</option>
                <option value="Mobiliado">Mobiliado</option>
              </select>
            </div>

          </div>
        </div>

      </div>

      <hr class="mb-30 mt-20"/>

      <div class="form-secao">

        <h3 class="title fz-24 fw-700 text-body-quaternary mb-30">
          Descrição do Imóvel
        </h3>

        <div class="form-lands-group">
          <textarea
            style="min-height: 140px;"
            placeholder="Digite sua mensagem"
            name="Mensagem_txa"
            class="form-lands"
          ></textarea>
        </div>
      </div>

      <button class="btn-lands btn-block btn-secondary mt-10" type="submit">
        Enviar
      </button>

      <div class="fz-14 text-right mt-15">(*) Campos obrigatórios</div>

    </div>

  </div>

  <input value="{$app->Lands_id}" name="Lands_id" type="hidden"/>

  {if $tpl}
  <input value="{$tpl}" name="Tpl_txf" type="hidden"/>
  {/if}

  {if $envia_email}

  <input type="hidden" value="{$envia_email}" name="Envia_email_txf"/>

  {if $assunto}
  <input type="hidden" name="Titulo_txf" value="{$assunto}"/>
  <input value="{$assunto}" name="Assunto_txf" type="hidden"/>
  {/if}

  <input type="hidden" name="Destinatario_txf" value="{$emails[0]->Email_txf}"/>

  {if $tipo_lead}
  <input type="hidden" value="{$tipo_lead}" name="Tipo_lead_txf"/>
  {/if}

  {/if}

  {if $tabela}
  <input type="hidden" value="{$tabela}" name="Tabela_txf"/>
  {/if}

  <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>

</form>
