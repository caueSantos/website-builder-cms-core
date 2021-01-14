<!DOCTYPE html>
<html lang="pt">
      <head>
            <meta charset="utf-8">
            <meta content="width=300, initial-scale=1" name="viewport">
            <meta name="description" content="{$app->Nome_app_txf}">
            <title>{$app->Nome_app_txf}</title>

      </head> 
      <body> {$app->Scripts_txa} 
            <div class="wrapper" style="width:100%;"> 

                  <div class="main content clearfix" style="width: 50%; margin-left:25%; margin-right: 25%;">

                        <table>
                              <tr>
                                    <td>
                                          <img style="width: 100px;" src="//assets.lands.srv.br/logos/{$app->Logo_txa}" />
                                    </td>
                                    <td>
                                          <h2>{$app->Nome_app_txf} Informa</h2>
                                    </td>
                              </tr>
                        </table>
                        <div class="banner">
                              <h3>
                                    Navegador incompatível.
                              </h3>

                              <table border=true><thead><tr><th>Navegador</th><th style="width:500px;">Descrição</th><th style="width:200px;">Recomendação</th></tr></thead>
                                    <tr><td>Internet Explorer 6,7,8,9,10<img style="width: 128px; height: 128px" src="//assets.lands.srv.br/logos/ie_proibido.png"/> </td><td>
                                                <ul id="ch-info" class="infolist">
                                                      <li><span>Desatualizado</span></li>
                                                      <li><span>Não suporta os elementos gráficos modernos desta página.</span></li>
                                                      <li><span>Constante travamento.</span></li>
                                                </ul></td><td style="text-align:center; font-weight: bold; font-size: 18px; color: red">Incompatível</td>

                                    </tr>
<!--                                    <tr><td>Internet Explorer 10 <img style="width: 128px; height: 128px" src="//assets.lands.srv.br/logos/ie10.png" /> </td><td> 
                                                <ul id="ch-info" class="infolist">
                                                      <li><span>Interface fácil e limpa</span></li>

                                                      <li><span>Lento, consome memória</span></li>
                                                      <li><span>Disponível em português</span></li>							</ul></td>
                                          <td style="text-align:center; font-weight: bold; font-size: 18px; color: green">Baixar <a href="http://windows.microsoft.com/pt-br/internet-explorer/ie-10-worldwide-languages">AQUI</a></td>

                                    </tr>-->
                                    <tr><td>Google Chrome<img style="width: 128px; height: 128px" src="//assets.lands.srv.br/logos/chrome_ok.png" /> </td><td> 
                                                <ul id="ch-info" class="infolist">
                                                      <li><span>Interface fácil e limpa</span></li>
                                                      <li><span>Integrado com os serviços Google</span></li>
                                                      <li><span>Velocidade rápida, usa pouca memória</span></li>
                                                      <li><span>Disponível em português</span></li>							</ul></td>
                                          <td style="text-align:center; font-weight: bold; font-size: 18px; color: green">Baixar <a href="//www.google.com/chrome">AQUI</a></td>

                                    </tr>

                                    <tr><td>Firefox<img style="width: 128px; height: 128px" src="//assets.lands.srv.br/logos/firefox_ok.png" /> </td>
                                          <td> <ul id="ff-info" class="infolist">
                                                      <li><span>Navegação mais segura</span></li>
                                                      <li><span>Amplo diretório de temas e plugins</span></li>
                                                      <li><span>Velocidade na média, uso de memória na média</span></li>
                                                      <li><span>Disponível em português</span></li>							</ul></td>
                                          <td style="text-align:center; font-weight: bold; font-size: 18px; color: green">Baixar <a href="http://www.mozilla.org/pt-BR/firefox/new/">AQUI</a>
                                          </td>

                                    </tr>
                              </table>
                        </div> 




                  </div>


            </div>


      </body>
</html>