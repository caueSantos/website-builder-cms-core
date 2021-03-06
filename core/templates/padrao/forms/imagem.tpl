<br />

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
            {if (isset($post['Representante_txf']))} 
                <tr>
                    <td>Nome do Representante:</td>
                    <td>{$post['Representante_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Imagem_txf']))} 
                <tr>
                    <td>Id da Imagem:</td>
                    <td>{$post['Imagem_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Marca_txf']))} 
                <tr>
                    <td>Marca:</td>
                    <td>{$post['Marca_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Colecao_txf']))} 
                <tr>
                    <td>Coleção:</td>
                    <td>{$post['Colecao_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Data_colecao_txf']))} 
                <tr>
                    <td>Coleção:</td>
                    <td>{arruma_data($post['Data_colecao_txf'])}</td>
                </tr>
            {/if}
            {if (isset($post['Descricao_txf']))} 
                <tr>
                    <td>Descrição da Imagem:</td>
                    <td>{$post['Descricao_txf']}</td>
                </tr>
            {/if}
            {if (isset($post['Mensagem_txa']))}
                <tr>
                    <td>Mensagem:</td>
                    <td><br />
                    </td>
                </tr>
            {/if}
        </tbody>
    </table>

    {if (isset($post['Caminho_txf']))} 
        <h3>Imagem Solicitada</h3>
        <a target="_blank" href="{$app->Url_cliente}{$app->Pasta_painel}{$post['Caminho_txf']}"><img src="{$app->Url_cliente}{$app->Pasta_painel}{$post['Caminho_txf']}"></a>

    {/if}

    <table style="border-collapse:collapse;width:100%;">
        <tbody>
            {if (isset($post['Mensagem_txa']))}<tr>
                    <td>{$post['Mensagem_txa']}<br />
                    </td>
                </tr>
            {/if}
        </tbody>
    </table><br />
</div>
<div>Agradecemos o seu contato, retornaremos o mais breve possível!</div>
<div>{$app->Titulo_txf}</div>  