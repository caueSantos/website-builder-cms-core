<!DOCTYPE html>
<html>
      <head>
            <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
            <meta charset="utf-8">
            <title>{$titulo}</title>
            <link rel="shortcut icon" href="//assets.lands.srv.br/temporario/favicon.ico" type="image/x-icon" />
            <link href="//assets.lands.srv.br/temporario/tools/style.css" rel="stylesheet" type="text/css" />
            <link href="//assets.lands.srv.br/temporario/tools/960.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script> 
            <script type="text/javascript" src="//assets.lands.srv.br/temporario/js/cufon-yui.js"></script>
            <script type="text/javascript" src="//assets.lands.srv.br/temporario/js/Adobe_Caslon_Pro_600.font.js"></script>
            <script type="text/javascript">
                  Cufon.replace('h1', { fontFamily: 'Adobe Caslon Pro', hover:true })
            </script>
      </head>
      <body>
            <div class="container_12" id="content">


<!--                  <h1>{$app->Nome_app_txf}</h1>-->
                  <img src="//assets.lands.srv.br/logos/{$Logo_txa}" style="width:280px; heigth:135px; margin:10px"/>
                  <br>
                        <h1>Site em desenvolvimento!</h1>
                        <div class="main">
                              <div class="mcontent">
                                    <div class="box mr20">
                                          <h2>Contato</h2>
                                          <p>Fone: {$cliente->Telefone_txf}<br/>
                                                Email : <a href="#">{$cliente->Email_txf}</a></p>
                                    </div>
                                    <div class="box mr20">
                                          <h2>Visite-nos</h2>
                                          <p>{$cliente->Endereco_txf},{$cliente->Numero_txf}
                                                / Bairro {$cliente->Bairro_txf} / 
                                                {$cliente->Cidade_txf},{$cliente->Estado_sel}</p>

                                    </div>
                                    <div class="box2">
                                          <h2>Siga-nos</h2>
                                          <!--                                    <a href="#"><img src="//assets.lands.srv.br/temporario/images/t.png" alt=""/></a>-->
                                          <a target="_blank" href="https://facebook.com/{$cliente->Fanpage_txf}"><img src="//assets.lands.srv.br/temporario/images/f.png" alt=""/></a>				
                                    </div>			
                              </div>
                        </div>
            </div>
      </body>
</html>

