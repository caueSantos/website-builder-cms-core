
<style>.list-group img {
    -webkit-filter: grayscale(100%);
       -moz-filter: grayscale(100%);
         -o-filter: grayscale(100%);
        -ms-filter: grayscale(100%);
            filter: grayscale(100%); 
}</style>
<div class="row">
    <div class="panel panel-default widget" ng-controller='controller_lista_app'  >
        <div class="panel-heading relativo" id="busca_apps">
            <i class="fa fa-chevron-right hidden-xs hidden-sm"></i>
            <h3 class="panel-title hidden-xs hidden-sm" >
                Aplicativos ( {count($lista_aplicativos)} )</h3>
            <span class="pull-right" style="width:180px; padding-top:0px; margin-top:-3px">
                <input class="form-control" style="height: 25px; font-size:14px;" placeholder="Busque por um aplicativo" type="text" ng-model="search.Nome_app_txf"></span>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                <li ng-repeat='aplicativo in lista_aplicativos | filter:search'  class="list-group-item col-md-3">
                    <div class="row app">
                        <div class="col-xs-6 col-md-4 wrapper_logo">
                            <a target="_blank"  href="[[aplicativo.Url_cliente]]" >
                                <img src="//assets.lands.srv.br/logos/[[aplicativo.Logo_txa]]" class="img-responsive logo" alt="" />
                            </a>
                        </div>
                        <div class="col-xs-6 col-md-8">
                            <div>
                                <a target="_blank"  href="[[aplicativo.Url_cliente]]" >[[aplicativo.Nome_app_txf]] </a>
                            </div>
                            <div class="comment-text">

                            </div>
                            <div class="action">
                                <a href='http://core.lands.srv.br/tabela/apps/index/edit/[[aplicativo.Id_app]]' class="btn btn-danger btn-xs" title="Edit">
                                    <i class="fa fa-pencil-square-o"></i>
                                    {*<img style="width:24px; height:24px;"  title="Editar" src='//assets.lands.srv.br/config/img/config.png'/>*}
                                </a>
                                <a target="_blank" href="[[aplicativo.link_final]]"  class="btn btn-primary btn-xs" title="Adminer">
                                    <i class="fa fa-database"></i>
                                    {*<img style="width:24px; height:24px;"   title="Adminer" src='//assets.lands.srv.br/config/img/adminer.png'/>*}
                                </a>
                                <a ng-repeat='cliente_painel in clientes_painel' ng-if="cliente_painel.Nome_bd_txf==aplicativo.Database_txf" target="_blank" href="[[cliente_painel.link_final_painel]]"  class="btn btn-success btn-xs" title="Painel">
                                    <i class="fa fa fa-gears"></i>
                                    {*<img style="width:24px; height:24px;"  title="Painel" src='//assets.lands.srv.br/{$app->Pasta_assets}/img/painel.png'/>*}
                                </a>                                               
                            </div>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>



