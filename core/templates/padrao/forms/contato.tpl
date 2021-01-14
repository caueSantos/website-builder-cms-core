<div>
    <table>
        <tbody>
            <tr>
                <td>Contato do Site - {date('d/m/Y')}</td>
                <td><br />
                </td>
            </tr>
            {if (isset($post['Nome_txf']))} 
                <tr>
                    <td>Nome:</td>
                    <td>{$post['Nome_txf']}</td>
                </tr>
            {/if}
             {if (isset($post['Sobrenome_txf']))} 
                <tr>
                    <td>Sobrenome:</td>
                    <td>{$post['Sobrenome_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Telefone_txf']))}
                <tr>
                    <td>Telefone:</td>
                    <td>{$post['Telefone_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Email_txf']))} 
                <tr>
                    <td>Email:</td>
                    <td>{$post['Email_txf']}</td>
                </tr>
            {/if}

            {if (isset($post['Cidade_txf']))}    
                <tr>
                    <td>Cidade:</td>
                    <td>{$post['Cidade_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Estado_est']))}     
                <tr>
                    <td>Estado:</td>
                    <td>{$post['Estado_est']}</td>
                </tr>
            {/if}
            {if (isset($post['Estado_sel']))}     
                <tr>
                    <td>Estado:</td>
                    <td>{$post['Estado_sel']}</td>
                </tr>
            {/if}
            {if (isset($post['Estado_txf']))}     
                <tr>
                    <td>Estado:</td>
                    <td>{$post['Estado_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Produto_txf']))} 
                <tr>
                    <td>Produto:</td>
                    <td>{$post['Produto_txf']}</td>
                </tr>
            {/if}


            {if $contato_inserido->Arquivos[0]}

                <tr>
                    <td>Arquivo(s):</td>
                    <td>{foreach from=$contato_inserido->Arquivos item=arquivito}
                        <a href="{$app->Url_cliente}{$app->Pasta_painel}/{$arquivito->Caminho_txf}"> {$arquivito->Nome_txf} </a> 
                        <br>

                        {/foreach}
                        </td>
                    </tr> 
                    {/if}


                    </tbody>
                </table>
                <table style="border-collapse:collapse;width:100%;">
                    <tbody>
                        {if (isset($post['Mensagem_txa']))}<tr>


                                <td>Mensagem:</td>
                                <td>{$post['Mensagem_txa']}<br />
                                </td>
                            </tr>
                        {/if}
                    </tbody>
                </table><br />
            </div>
            <div>Agradecemos o seu contato, retornaremos o mais breve possível!</div>
            <div>{$app->Titulo_txf}</div>