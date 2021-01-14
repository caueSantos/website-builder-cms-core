<!DOCTYPE html>
{$assets_url=$app->Url_cliente|cat:'core/assets/'}
<html lang="pt">
<head>

  <meta charset="utf-8">
  <meta content="width=300, initial-scale=1" name="viewport">
  <meta name="description" content="Core Landshosting">
  <title>:: CORE :: Lands Framework</title>
  <link href="{$assets_url}bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{$assets_url}padrao/css/login.css" rel="stylesheet">
  <script src="{$assets_url}jquery/jquery-2.1.1.min.js"></script>
  <script src="{$assets_url}bootstrap/js/bootstrap.min.js"></script>

  {$app->Scripts_txa}

</head>

<body>

<div class="container">

  <div class="topo text-center">
    <h3> {$app->Titulo_txf}</h3>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">

      <div class="panel-heading text-center">
        {$mensagem|default:'Área restrita, login necessário.'}
      </div>

      <div class="panel-body">
        {$content}
      </div>

      <div class="panel-footer text-center">
        <small>Caso não possua login, entre em contato conosco.</small>
      </div>

    </div>
  </div>
</div>
</body>
</html>
