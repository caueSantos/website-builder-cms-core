<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        <title>NOVO CURRÍCULO - {$app->Nome_app_txf} </title>
        <style type='text/css'>
            body {
                color: #1B5281;
            }
            .fonte_tp_table {
                font-size: 18px;
                font-family: Arial, Helvetica, sans-serif;
                color: #FFFFFF; 
            }
            .fonte_campos {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
            }
            .conteudo {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }

        </style>
    </head>

    <body>

        <table width='100%' border='0' align='left' cellpadding='7' cellspacing='0'>
            <tbody>
                <tr> 
                    <td colspan='2' bgcolor='#1B5281' style="color: #FFFFFF" ><strong class='fonte_tp_table'>NOVO CURRÍCULO - {$app->Nome_app_txf}   -  {date("d/m/Y")}  </strong></td>
                </tr>
                {if $dados_email->Nome_txf} 
                    <tr>
                        <td  bgcolor='#FFFFFF' class='fonte_campos'>Nome:</td>
                        <td  bgcolor='#FFFFFF' class='conteudo' style='font-size: 14px'>{$dados_email->Nome_txf}</td>
                    </tr>
                {/if}

                {if $dados_email->Email_txf} 
                    <tr>
                        <td  bgcolor='#EDF5FC' class='fonte_campos'>Email:</td>
                        <td  bgcolor='#EDF5FC' class='conteudo' style='font-size: 14px'>{$dados_email->Email_txf}</td>
                    </tr>
                {/if}  

                {if $dados_email->Telefone_txf}
                    <tr>
                        <td  bgcolor='#FFFFFF' class='fonte_campos'>Telefone:</td>
                        <td  bgcolor='#FFFFFF' class='conteudo' style='font-size: 14px'>{$dados_email->Telefone_txf}</td>
                    </tr>
                {/if}


                {if $dados_email->Vaga_txf}    
                    <tr>
                        <td  bgcolor='#EDF5FC' class='fonte_campos'>Vaga:</td>
                        <td  bgcolor='#EDF5FC' class='conteudo' style='font-size: 14px'>{$dados_email->Vaga_txf}</td>
                    </tr>
                {/if}

                {if ($dados_email->Arquivo_txf)} 
                    <tr>
                        <td  bgcolor='#FFFFFF' class='fonte_campos'>Arquivo:</td>
                        <td  bgcolor='#FFFFFF' class='conteudo' style='font-size: 14px'><a target="_blank" href="{$app->Url_cliente}{$app->Pasta_painel}/{$dados_email->Arquivo_txf}">{$dados_email->Arquivo_nome_txf}</a></td>
                    </tr>
                {/if}  
                <tr> 
                    <td colspan='2' bgcolor='#1B5281' style="color: #FFFFFF"><strong class='fonte_tp_table'></strong></td>
                </tr>
            </tbody>
        </table>
        <br>
            <br>

                <h4>Você pode visualizá-lo a qualquer hora acessando o painel de controle! <a target="_blank" href="http://painel.landsdigital.com.br" >http://painel.landsdigital.com.br</a></h4>
                </body>
</html>       

