{if !$imovel}{$imovel=$empreendimento}{$tipo='EMPREENDIMENTO'}{/if}<aside class="interessado-imovel">  <form class="form-interessado-imovel" onsubmit="return false;">    <div class="row justify-content-center">      <div class="col-12 col-lg-10 col-txt">        <div class="title-group">          <h1 class="title text-body-quaternary fz-24 lh-12 fw-700">            {titulo('entre_contato_simples', 'tit', $titulos)}          </h1>          {if titulo('entre_contato_simples', 'sub', $titulos)}          <div class="texto fz-16 mt-10 lh-15">            {titulo('entre_contato_simples', 'sub', $titulos)}          </div>          {/if}        </div>        <div class="row justify-content-center mt-30">          <div class="col-12">            <input              type="text" class="form-lands" name="Nome_txf"              placeholder="Digite seu nome*"              required            />          </div>          <div class="col-12">            <input              type="email" class="form-lands" name="Email_txf"              placeholder="Digite seu e-mail*"              required            />          </div>          <div class="col-12">            <input value="{if $tipo}{$tipo}{else}IMOVEL{/if}" name="Tipo_txf" type="hidden"/>            <input value="{$imovel->Nome_tit}" name="Imovel_txf" type="hidden"/>            <input value="{$app->Lands_id}" name="Lands_id" type="hidden"/>            <input value="imovel-interesse" name="Tpl_txf" type="hidden"/>            <input type="hidden" value="SIM" name="Envia_email_txf"/>            <input type="hidden" name="Titulo_txf" value="Zeh Imóveis - Você está interessado no imóvel {$imovel->Nome_tit}!"/>            <input value="Zeh Imóveis - Você está interessado no imóvel {$imovel->Nome_tit}!" name="Assunto_txf" type="hidden"/>            <input type="hidden" name="Destinatario_txf" value="{$emails[0]->Email_txf}"/>            <input type="hidden" value="_imovel_interesse" name="Tabela_txf"/>            <input type="hidden" value="SIM" name="Permite_duplo_cadastro_txf"/>            <button type="submit" class="btn-lands btn-secondary btn-block">Enviar</button>          </div>          <div class="col-12 text-center">            <div class="pt-15 pb-15">Ou</div>            <button type="button" class="btn-lands btn-primary btn-outline bs-0 pl-10 pr-10 btn-block"                    onclick="document.querySelector('.lands-whatsapp-fab').click()">              <i class="fab fa-whatsapp va-middle fz-18"></i>              <span class="pl-10 va-middle">                Entre em contato pelo WhatsApp              </span>            </button>          </div>        </div>      </div>    </div>  </form></aside>