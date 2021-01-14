<style> .busca{
            text-align:center;
      }
      #buscar {
            background-color: #F9F9F9;
            border: 1px solid #CCCCCC;
            border-radius: 6px 6px 6px 6px;
            color: #666666;
            float: left;
            font-size: 23px;
            margin: 8px;
            margin-bottom:20px;
            padding: 10px;
            width: 80%;
            background-image: url(//assets.lands.srv.br/config_velho/img/lupa.png);
            background-position: right;
            background-repeat: no-repeat;
            background-position: 99%;
      }
      #app{
            border-radius: 8px 8px 8px 8px;
            border: 1px solid #D0D0D0;
            float:left;
            margin-left:10px;
            padding-left:5px;
            padding-right:5px;
            padding-bottom:10px;
            margin-right:10px;
            margin-bottom:20px;
            text-align: center;
            min-width:260px;
      }
      #app img{
            width:150px; 
            height: 80px;
            margin-bottom: -10px;
      }
      #ferramentas{
            margin-top:5px;

      }
      #ferramentas a{
            font-size: 12px;
      }
      #ferramentas a img {
            filter: url("data:image/svg+xml;utf8,<svg%20xmlns='http://www.w3.org/2000/svg'><filter%20id='grayscale'><feColorMatrix%20type='matrix'%20values='0.3333%200.3333%200.3333%200%200%200.3333%200.3333%200.3333%200%200%200.3333%200.3333%200.3333%200%200%200%200%200%201%200'/></filter></svg>#grayscale"); /* Firefox 3.5+ */
            filter: gray; /* IE6+ */
            filter: grayscale(100%); /* Current draft standard */
            -webkit-filter: grayscale(100%); /* New WebKit */
            -moz-filter: grayscale(100%);
            -ms-filter: grayscale(100%); 
            -o-filter: grayscale(100%);
      }
.construcao{
      border-color: #C83642 !important;
      
}

</style>



<div class='busca'>
      <input class='buscar'  size='50' onfocus="this.value = ''" onblur="if(this.value == ''){ this.value = 'Buscar'; }" id="buscar" name="buscar" value="Buscar" type="text" />
</div>



<div id="caixa-apps" style="overflow: auto; clear:both; " >





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
