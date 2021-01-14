

<div id="app-list"> 
    <div class="row">
        <div class="busca">

            <div class="col-md-10">
                <input class="search form-control" placeholder="Buscar" />
            </div>
            <div class="col-md-2">
                <div class="contagem">
                    Aplicativos ( {count($lista_aplicativos)} )
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        


        <div class="lista-app">
            <ul class="list">
                {foreach from=$lista_aplicativos item=aplicativo}
         
                        <li class="list-group-item col-md-3">
                            <div class="col-xs-6 col-md-4 wrapper_logo">
                                <a target="_blank"  href="{$aplicativo->Url_cliente}" >
                                    <img src="//assets.lands.srv.br/logos/{$aplicativo->Logo_txa}" class="img-responsive logo" alt="" />
                                </a>
                            </div>
                            <div class="col-xs-6 col-md-8">
                                <div>
                                    <a target="_blank"  href="{$aplicativo->Url_cliente}" class="nome" >{$aplicativo->Nome_app_txf} </a>
                                </div>
                                <div class="comment-text">

                                </div>
                                <div class="action">
                                    <a href='http://core.lands.srv.br/tabela/apps/index/edit/{$aplicativo->Id_app}' class="btn btn-danger btn-xs" title="Edit">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a target="_blank" href="http://core.lands.srv.br/adminer/adminer?Nome_bd_txf={base64_encode($aplicativo->Conexao[0]->Database_txf)}&db='{base64_encode($aplicativo->Conexao[0]->Database_txf)}&Usuario_bd_txf={base64_encode($aplicativo->Conexao[0]->Usuario_txf)}&Servidor_txf={base64_encode($aplicativo->Conexao[0]->Servidor_txf)}&Senha_bd_txf={base64_encode($aplicativo->Conexao[0]->Senha_txp)}"  class="btn btn-primary btn-xs" title="Adminer">
                                        <i class="fa fa-database"></i>
                                    </a>
                                    {if $aplicativo->Painel}
                                        <a target="_blank" href="http://painel.landsdigital.com.br/index.php?&Senha_master={base64_encode('digital')}&Usuario_master={base64_encode('lands')}&Cpf_cnpj_txf={base64_encode($aplicativo->Painel->Cpf_cnpj_txf)}"  class="btn btn-success btn-xs" title="Painel">
                                            <i class="fa fa fa-gears"></i>
                                        </a>           
                                    {/if}
                                </div>
                            </div>
                        </li>
             

                {/foreach}
               
                
            </ul>
        </div>
    </div>
</div>

<script>
    var options = {
    valueNames: [ 'nome' ]
};

var hackerList = new List('app-list', options);
</script>



<style>
    .contagem {
        padding-top: 4px;
    }
    .lista-app {
        margin-left: -30px;
        margin-right: 15px;
    }
    .busca {
        background: #f5f5f5 none repeat scroll 0 0;
        display: block;
        height: 50px;
        padding: 10px 0 0;
        margin-bottom:20px;
    }
    #app-list img {
        -webkit-filter: grayscale(100%);
        -moz-filter: grayscale(100%);
        -o-filter: grayscale(100%);
        -ms-filter: grayscale(100%);
        filter: grayscale(100%); 
    }</style>
