<!DOCTYPE html>
<html ng-app="myApp">
      <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>{$titulo}</title>
            <base href="//assets.lands.srv.br/grocery_crud" > 
            <script src="//assets.lands.srv.br/angular/1.2/angular.js"></script>
            <link href="//assets.lands.srv.br/config/css/bootstrap.min.css" rel="stylesheet">
            <link href="//assets.lands.srv.br/config/css/admin.css" rel="stylesheet">
            <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,700,300' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="//assets.lands.srv.br/codemirror/lib/codemirror.css"/>
            <script src="//assets.lands.srv.br/codemirror/lib/codemirror.js"></script>
            <script src="//assets.lands.srv.br/codemirror/mode/xml/xml.js"></script>
            <script src="//assets.lands.srv.br/codemirror/mode/javascript/javascript.js"></script>
            <script src="//assets.lands.srv.br/codemirror/mode/css/css.js"></script>
            <script src="//assets.lands.srv.br/codemirror/mode/php/php.js"></script>
            <script src="//assets.lands.srv.br/codemirror/mode/htmlmixed/htmlmixed.js"></script>
            <script src="http://scripts.landsdigital.com.br/jquery.js"></script>

            {* Icones *}
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
            <script src="//assets.lands.srv.br/config/js/jquery-1.10.2.js"></script>
            <script src="//assets.lands.srv.br/config/js/bootstrap.min.js"></script>
            <script src="//assets.lands.srv.br/config/js/base64.js"></script>

            {literal}<script>
                var editor = CodeMirror.fromTextArea(document.getElementById("field-Conteudo_txa"), {mode: "text/html", tabMode: "indent"});
                  </script>
            {/literal}
            <script type="text/javascript">
                  var myApp = angular.module('myApp', [], function ($interpolateProvider) {
                  $interpolateProvider.startSymbol('[[');
                  $interpolateProvider.endSymbol(']]');
            });

            function controller_lista_app($scope) {
            $scope.lista_aplicativos ={json_encode($lista_aplicativos)};
            $scope.clientes_painel ={json_encode($clientes_painel)};

            angular.forEach($scope.lista_aplicativos, function (aplicativo) {
            aplicativo.link_adminer = 'http://core.lands.srv.br/adminer/adminer?';
            aplicativo.conexao = Base64.encode(aplicativo.Nome_conexao_txf);
            aplicativo.servidor = Base64.encode(aplicativo.Servidor_txf);
            aplicativo.usuario = Base64.encode(aplicativo.Usuario_txf);
            aplicativo.senha = Base64.encode(aplicativo.Senha_txp);
            aplicativo.banco = Base64.encode(aplicativo.Database_txf);
            aplicativo.link_final = aplicativo.link_adminer + 'Nome_bd_txf=' + aplicativo.banco + '&db=' + aplicativo.banco + '&Usuario_bd_txf=' + aplicativo.usuario + '&Servidor_txf=' + aplicativo.servidor + '&Senha_bd_txf=' + aplicativo.senha;
            angular.forEach($scope.clientes_painel, function (cliente_painel) {
            if (cliente_painel.Nome_bd_txf == aplicativo.Database_txf) {
            cliente_painel.link_painel = 'http://painel.landsdigital.com.br/index.php?';
            cliente_painel.Cpf_cnpj_txf = Base64.encode(cliente_painel.Cpf_cnpj_txf);
            cliente_painel.Senha_master = Base64.encode('digital');
            cliente_painel.Usuario_master = Base64.encode('lands');
            cliente_painel.link_final_painel = cliente_painel.link_painel + '&Senha_master=' + cliente_painel.Senha_master + '&Usuario_master=' + cliente_painel.Usuario_master + '&Cpf_cnpj_txf=' + cliente_painel.Cpf_cnpj_txf
      }


});
});
}
            </script>
      </head>
      <body> {$app->Scripts_txa}  
            <div id="wrapper" class="active">
                  <div id="sidebar-wrapper">
                        <div id="sidebar_menu" class="sidebar-nav">
                              <div class="sidebar-brand">
                                    <a id="menu-toggle" href="{$app->Url_cliente}">
                                          <img class="img-responsive logo" src="//assets.lands.srv.br/logos/lands-core.png">
                                    </a>
                              </div>
                        </div>
                        <ul class="sidebar-nav" id="sidebar">     
                              {if ($usuario_logado->Nivel_sel>3)}
                                    <li><a href="http://core.lands.srv.br/preguica" >PREGUICA</a> </li>
                                    <li><a href="http://core.lands.srv.br/inicio">Início</a></li>
                                    <li><a href="http://core.lands.srv.br/lista_backups">Lista Backups</a></li>
                                    <li class="dropdown">
                                          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> Tabelas <b class="caret"></b></a>
                                          <ul class="dropdown-menu">
                                                {foreach from=$tabelas item=tabela}
                                                      <li><a href="http://core.lands.srv.br/tabela/{$tabela->Tables_in_lands_core}">{$tabela->Tables_in_lands_core}</a></li> 
                                                {/foreach}  
                                          </ul> 
                                    </li>
                              {else}
                                    <li><a href="http://core.lands.srv.br/inicio">Início</a></li>
                                    <li><a href="http://core.lands.srv.br/tabela/marketing">Marketing</a></li>
                              {/if}
                              <li><a href="http://core.lands.srv.br/wizard">Wizard</a></li>
                              <li><a href="{$app->Url_cliente}logout">Sair</a></li>
                        </ul>
                  </div> 
                  <div id="page-wrapper">
                        <div class="barra_horizontal hidden-xs hidden-sm">
                              <h1> Core Landshosting - Lands Framework  <span style="color:#222">{$senha_mor}</span></h1>
                        </div>
                        {$content|default:'content vazio'}
                  </div>
            </div>
      </body>
      <script>
$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("active");
});
$(document).ready(function () {
var menu = $('#busca_apps'),
pos = menu.offset();
var largura;
$(window).scroll(function () {
if ($(this).scrollTop() > pos.top + menu.height() && menu.hasClass('relativo')) {
menu.fadeOut('fast', function () {
$(this).removeClass('relativo').addClass('fixo').fadeIn('fast');
largura = $('#page-wrapper').width();
$(this).css('width', largura + 'px');
});
} else if ($(this).scrollTop() <= pos.top && menu.hasClass('fixo')) {
menu.fadeOut('fast', function () {
$(this).removeClass('fixo').addClass('relativo').fadeIn('fast');
largura = $('#page-wrapper').width();
$(this).css('width', largura + 'px');
});
}
});
});
      </script>
</html>





