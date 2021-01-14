<div class="pagina">

    <h2>Backup Geral</h2>
    Lista de Todos os backups do sistema ordenado por aplicativo. <br>
    Para fazer o backup de todos os aplicativos, clique <a target="_blank" href="http://core.landshosting.com.br/backup">AQUI</a> ou acesse http://core.landshosting.com.br/backup<br>
    Para fazer backup de um app específico basta acessar http://core.landshosting.com.br/backup/$LANDS_ID
    <br>
    <h2>Lista de Backups</h2>

    {foreach from=$apps item=app}

        <div class="panel panel-default">
            <div class="panel-heading">
                <a role="button" data-toggle="collapse" href="#{$app->Lands_id}" aria-expanded="false" aria-controls="collapseExample">
                    {$app->Nome_app_txf} ( {$app->Total} ) 
                </a>
            </div>


            <div class="collapse" id="{$app->Lands_id}">
                <div class="panel-body">
                    {if $app->Backups[0]}
                        <table style="border: 1px black">
                            <thead>
                                <tr style="text-align: left">
                                    <th style="width: 200px;">Aplicativo</th>
                                    <th style="width: 350px;">Arquivo</th>
                                    <th style="width: 200px;">Data</th>
                                    <th style="width: 300px;">Ações</th>
                                </tr>
                            </thead>


                            <tbody>

                                {foreach $app->Backups item=backup}

                                    {if ($backup->Caminho_txf!='')}
                                        <tr>
                                            <td>{$app->Nome_app_txf}</td>
                                            <td>{$backup->Caminho_txf}</td>
                                            <td>{$backup->Data_dat}</td>
                                            <td><a  target="_blank" href="http://landshosting.com.br/subdominios/core_landshosting/backups/{$backup->Caminho_txf}">VER ARQUIVO</a> | <a target="_blank" href="http://core.landshosting.com.br/backup/{$backup->Lands_id}"> NOVO BACKUP</a>  </td>
                                        </tr>
                                    {/if}
                                {/foreach}

                            </tbody>
                        </table>
                {else}<h4>Nenhum Backup até o momento</h4>{/if}

            </div>
        </div>
    </div>

{/foreach}



</div>