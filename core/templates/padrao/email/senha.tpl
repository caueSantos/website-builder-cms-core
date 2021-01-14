<!DOCTYPE html>
<html lang="pt-br">
      <body>
            <h2>Dados para acesso ao sistema - {$app->Nome_app_txf}</h2>
             
            <p> Olá {$cadastro->Nome_fantasia_txf}{$cadastro->Nome_txf}, para ter acesso às funcionalidades do sistema você deve entrar em nossa área restrita com seguintes login e senha:  </p>
            <br>
              
              
            <strong>Login:</strong> {$cadastro->Login_txf} <br>
            <strong>Senha:</strong> {$cadastro->Senha_txf}<br>
            <strong>Link:</strong><a href="{$app->Url_cliente}../restrita"> CLIQUE AQUI PARA ACESSAR</a>
            
      </body>
</html>
