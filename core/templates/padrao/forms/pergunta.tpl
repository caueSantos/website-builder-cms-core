<div>
    <table>
        <tbody>
            <tr>
                <td>Nova Pergunta - {date('d/m/Y')}</td>
                <td><br />
                </td>
            </tr>
            {if (isset($post['Nome_txf']))} 
                <tr>
                    <td>Nome:</td>
                    <td>{$post['Nome_txf']}</td>
                </tr>
            {/if}


            {if (isset($post['Email_txf']))} 
                <tr>
                    <td>Email:</td>
                    <td>{$post['Email_txf']}</td>
                </tr>
            {/if}

            {if (isset($post['Pergunta_txa']))}    
                <tr>
                    <td>Pergunta:</td>
                    <td>{$post['Pergunta_txa']}</td>
                </tr>
            {/if}
        </tbody>
    </table>
    <br />
</div>
<div>Agradecemos o seu contato, retornaremos o mais breve possível!</div>
<div>{$app->Titulo_txf}</div>