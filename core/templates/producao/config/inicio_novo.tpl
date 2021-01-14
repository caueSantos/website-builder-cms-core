<style>
      body { padding-top:0px; }
      h1{ margin-top:0px;}
.widget .panel-body { padding:0px; }
.widget .list-group { margin-bottom: 0; }
.widget .panel-title { display:inline }
.widget .label-info { float: right; }
.widget li.list-group-item { border-radius: 0;border: 0;border-top: 1px solid #ddd; }
.widget li.list-group-item:hover { background-color: rgba(86,61,124,.1); }
.widget .mic-info { color: #666666;font-size: 11px; }
.widget .action { margin-top:5px; }
.widget .comment-text { font-size: 12px; }
.widget .btn-block { border-top-left-radius:0px;border-top-right-radius:0px; }

</style>


<div class="container">
    <div class="row">
        <div class="panel panel-default widget">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-comment"></span>
                <h3 class="panel-title">
                    Recent Comments</h3>
                <span class="label label-info">
                    78</span>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">
                                        Google Style Login Page Design Using Bootstrap</a>
                                    <div class="mic-info">
                                        By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Awesome design
                                </div>
                                <div class="action">
                                    <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="button" class="btn btn-success btn-xs" title="Approved">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="http://bootsnipp.com/BhaumikPatel/snippets/Obgj">Admin Panel Quick Shortcuts</a>
                                    <div class="mic-info">
                                        By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                </div>
                                <div class="action">
                                    <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="button" class="btn btn-success btn-xs" title="Approved">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-2 col-md-1">
                                <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                            <div class="col-xs-10 col-md-11">
                                <div>
                                    <a href="http://bootsnipp.com/BhaumikPatel/snippets/4ldn">Cool Sign Up</a>
                                    <div class="mic-info">
                                        By: <a href="#">Bhaumik Patel</a> on 11 Nov 2013
                                    </div>
                                </div>
                                <div class="comment-text">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh
                                    euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim
                                </div>
                                <div class="action">
                                    <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="button" class="btn btn-success btn-xs" title="Approved">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <a href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
            </div>
        </div>
    </div>
</div>


<div ng-controller='controller_lista_app' >
      <input type="text" ng-model="search.Nome_app_txf">


      <div ng-repeat='applicativo in lista_aplicativos | filter:search' class="panel panel-default">
            <div class="panel-heading">
                  <h3 class="panel-title">[[applicativo.Nome_app_txf]]</h3>
            </div>
            <div class="panel-body">
                  <img src='//assets.lands.srv.br/logos/[[applicativo.Logo_txa]]'  /></div>
            </div>
      </div>

     
</div>
<div class='busca'>
      <input class='buscar'  size='50' onfocus="this.value = ''" onblur="if(this.value == ''){ this.value = 'Buscar'; }" id="buscar" name="buscar" value="Buscar" type="text" />
</div>



<div id="caixa-apps" style=" display:none; overflow: auto; clear:both; " >





      {foreach from=$lista_aplicativos item=aplicativos}

            {$conexao = ($aplicativos->Nome_conexao_txf|base64_encode)} 

            {$servidor = ($aplicativos->Servidor_txf|base64_encode)}
            {$usuario = ($aplicativos->Usuario_txf|base64_encode)}
            {$senha = ($aplicativos->Senha_txp|base64_encode)}
            {$banco = ($aplicativos->Database_txf|base64_encode)}

            {$link_adminer = "http://painel.landsdigital.com.br/adminer/adminer/adminer?"}

            <div id="app" {if ($aplicativos->Estado_sel==CONSTRUCAO)} class="construcao" {/if}><p><div id="logo_caixa"><img  src='//assets.lands.srv.br/logos/{$aplicativos->Logo_txa}'/></div></p>

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


</div>
<!--<div id="novdades">

      <table>
            <thead>
                  <tr>
                        <th>Ações</th>
                        <th>Lands_id</th>
                        <th>Tipo</th>

                        <th>Descricao</th>


                  </tr>
            </thead>
            <tbody>
{foreach from=$atualizacoes item=atualizacao}          
      <tr>
            <td><a href="{$app->Url_cliente}tabela/_atualizacoes/index/edit/{$atualizacao->Id_int}">ABRIR</a></td>
            <td>{$atualizacao->Lands_id}</td>
            <td>{$atualizacao->Tipo_sel}</td>

            <td>{$atualizacao->Descricao_txa}</td>


      </tr>
{/foreach}  
</tbody>
</table>      

<a href="{$app->Url_cliente}tabela/_atualizacoes">Ver todas</a>
</div>-->


<script>
      $(document).ready(function(){
      $('#buscar').focus();
      $('#buscar').keyup(function () {
      valor = $('#buscar').val();
      $.ajax({
      url : '{$app->Url_cliente}buscar',
      type : 'post',
      data : {
      busca : valor
},
success: function(e){
$('#caixa-apps').html(e);
}
});
});
});
</script>
