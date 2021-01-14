
<style>.construcao{
      border-color: #C83642 !important;
      
}</style>



<div id="caixa-apps" style="overflow: auto; clear:both; " >



      {if isset($lista_aplicativos[0])}
            {foreach from=$lista_aplicativos item=aplicativos}

                  {$conexao = ($aplicativos->Nome_conexao_txf|base64_encode)}

                  {$servidor = ($aplicativos->Servidor_txf|base64_encode)}
                  {$usuario = ($aplicativos->Usuario_txf|base64_encode)}
                  {$senha = ($aplicativos->Senha_txp|base64_encode)}
                  {$banco = ($aplicativos->Database_txf|base64_encode)}

                  {$link_adminer = "http://painel.landsdigital.com.br/adminer/adminer/adminer?"}

                  <div id='app' {if ($aplicativos->Estado_sel==CONSTRUCAO)} class="construcao" {/if}><p><div id="logo_caixa"><img  src='//assets.lands.srv.br/logos/{$aplicativos->Logo_txa}'/></div></p>

                  <div id="titulo">{$aplicativos->Nome_app_txf}</div>


                  <div id="ferramentas">
                        <a href='{$aplicativos->Url_cliente}' target='_blank'><img  title="Abrir Site" style="width:24px; height:24px;" src='//assets.lands.srv.br/logos/{$aplicativos->Logo_txa}'/></a> 
                        |   <a href='http://core.landshosting.com.br/tabela/apps/index/edit/{$aplicativos->Id_app}'><img style="width:24px; height:24px;"  title="Editar" src='//assets.lands.srv.br/{$app->Pasta_assets}/img/config.png'/></a>
                        |   <a target='_blank' href='{$link_adminer}Nome_bd_txf={$banco}&db={$banco}&Usuario_bd_txf={$usuario}&Servidor_txf={$servidor}&Senha_bd_txf={$senha}"'><img style="width:24px; height:24px;"   title="Adminer" src='//assets.lands.srv.br/{$app->Pasta_assets}/img/adminer.png'/></a>

                        {foreach from=$clientes_painel item=cliente_painel} 
                              {if ($cliente_painel->Nome_bd_txf==$aplicativos->Database_txf)}
                                    {$link_painel = "http://painel.landsdigital.com.br/index.php?"}
                                    {$link_whmcs="https://www.landshosting.com.br/admin/clientssummary.php?&userid="}
                                    {$Cpf_cnpj_txf = ($cliente_painel->Cpf_cnpj_txf|base64_encode)}
                                    {$Senha_master = ('digital'|base64_encode)}
                                    {$Usuario_master = ('lands'|base64_encode)}

                                    | <a target='_blank' href='{$link_painel}&Senha_master={$Senha_master}&Usuario_master={$Usuario_master}&Cpf_cnpj_txf={$Cpf_cnpj_txf}"'> <img style="width:24px; height:24px;"  title="Painel" src='//assets.lands.srv.br/{$app->Pasta_assets}/img/painel.png'/></a>
                              {if ($cliente_painel->Id_whmcs_txf!='')} | <a target='_blank' href='{$link_whmcs}{$cliente_painel->Id_whmcs_txf}'> <img style="width:24px; height:24px;"  title="WHMCS" src='//assets.lands.srv.br/{$app->Pasta_assets}/img/whmcs.png'/></a> {/if}

                        {/if} 
                  {/foreach}


                  {if ($aplicativos->Asana_id_txf!='')}
                        | <a target='_blank' href='https://app.asana.com/0/{$aplicativos->Asana_id_txf}/{$aplicativos->Asana_id_txf}'> <img style="width:24px; height:24px;" title="Asana" src='//assets.lands.srv.br/{$app->Pasta_assets}/img/asana.png'/></a>
                        {/if}





            </div>
      </div>




      {/foreach}
{/if}




</div>



