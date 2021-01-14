<div style="margin-left:-15px" class="">
                  <ol class="breadcrumb" id="navegador" >
                        {if ($pagina_atual!='inicio')} 
                              <li   class="active">
                                    <a href="{$app->Url_cliente}inicio" >Inicio</a>
                              </li>
                        {else}
                              <li   class="active">
                                    Inicio
                              </li>
                        {/if}

                        {if ($pagina_atual=='empresa')}

                              <li class="active">Empresa</li>

                        {/if}
                        {if ($pagina_atual=='servico')}

                              <li class="active">  <a href="{$app->Url_cliente}portifolio" >Portifólio</a></li>
                              <li class="active">  {$servicos[0]->Titulo_txf}</li>

                        {/if}
                        {if ($pagina_atual=='contato')}

                              <li class="active">Contato</li>

                        {/if}
                        {if ($pagina_atual=='busca')}

                              <li class="active">Busca</li>

                        {/if}
                        {if ($pagina_atual=='portifolio')}

                              <li class="active">Portifólio</li>

                        {/if}
                        {if ($pagina_atual=='clientes')}

                              <li class="active">Clientes</li>

                        {/if}
                        {if ($pagina_atual=='cliente')}

                              <li class="active"><a href="{$app->Url_cliente}clientes" >Clientes</a></li>
                              <li class="active">{$cliente[0]->Nome_txf}</li>


                        {/if}
                        {if ($pagina_atual=='produtos')}

                              <li class="active">Produtos</li>

                        {/if}
                        {if ($pagina_atual=='produto')}
                              <li class="active"><a href="{$app->Url_cliente}produtos" >Produtos</a></li>
                              <li class="active">{$produto[0]->Titulo_txf}</li>

                        {/if}
                        {if ($pagina_atual=='trabalho')}

                              <li class="active"><a href="{$app->Url_cliente}portifolio" >Portifólio</a></li>
                              <li class="active">{$trabalho[0]->Titulo_txf}</li>
                        {/if}


                  </ol>
                        </div>