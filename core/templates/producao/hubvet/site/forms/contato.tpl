    <div class="container">        <div class="row">            <div class="col-sm-12">                <div class="tabela" style="background-color: #f3f3f3; padding: 30px; margin-left: auto; margin-right: auto;">                    <table bgcolor="#ffffff" style="padding-top: 30px; width:100%">                        <tbody>                            <tr>                                <td class="linha">                                    <center>                                        <img class="teste" src="{$assets}imagens/logo-cor.png" height="76" style="display: block;                                             margin-top: 0px; margin-left: auto;margin-right: auto;">                                    </center>                                    <br><br>                                    <hr style="width: 89%;">                                </td>                             </tr>                        {if ($post['Responsavel_txf']!='')}                            <tr>                                <!--<td style="text-align: center"> {$post['Responsavel_txf']}</td>-->                                <td style="padding-left: 50px; padding-right: 50px; padding-top: 10px; padding-bottom: 10px; font-family: tahoma; font-size: 16px;"><strong>{$post['Responsavel_txf']}, obrigado por entrar em contato com o Santa Rosa!</strong></td>                            </tr>                        {/if}                        <tr>                            <td style="padding-bottom: 10px;padding-left: 50px; padding-right: 50px; padding-top: 10px;font-family: tahoma;font-size: 14px;">                                Nós da {$cliente->Fantasia_txf} recebemos sua mensagem, aguarde em breve um de nossos atendentes entrará em contato com você!</td>                        </tr>                        <tr>                            <td style="padding: 10px 50px 0px 50px; font-family: tahoma;font-size: 14px;">                                Atenciosamente,<br>                                <strong>{$cliente->Fantasia_txf}</strong><br><br>                            </td>                        </tr>                        <tr>                            <td style="padding: 10px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Dados enviados</strong></td>                        </tr>                        {if (isset($post['Nome_txf']))}                            <tr>                                <td style="padding: 10px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Nome:</strong> {$post['Nome_txf']}</td>                            </tr>                        {/if}                        {if (isset($post['Nome_responsavel_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Nome do responsável:</strong> {$post['Nome_responsavel_txf']}</td>                            </tr>                        {/if}                         {if (isset($post['Nome_aluno_txf']))}                            <tr>                                <td style="padding:0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Nome do aluno:</strong> {$post['Nome_aluno_txf']}</td>                            </tr>                        {/if}                        {if (isset($post['Sobrenome_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"> <strong>Sobrenome:</strong> {$post['Sobrenome_txf']}</td>                            </tr>                        {/if}                        {if (isset($post['Empresa_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Empresa:</strong> {$post['Empresa_txf']}</td>                            </tr>                        {/if}                        {if (isset($post['Atividade_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Atividade:</strong> {$post['Atividade_txf']}</td>                            </tr>                        {/if}                        {if (isset($post['Estado_est']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Estado: </strong>{$post['Estado_est']}</td>                            </tr>                        {/if}                        {if (isset($post['Responsavel_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Responsável:</strong> {$post['Responsavel_txf']}</td>                            </tr>                        {/if}                        {if (isset($post['Email_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Email:</strong> {$post['Email_txf']}</td>                            </tr>                        {/if}                        {if $contato_inserido->Arquivos[0]}                            <tr>                                <td>                                    <strong>Arquivo(s):</strong>                                    {foreach from=$contato_inserido->Arquivos item=arquivito}                                        <a href="{$app->Url_cliente_linguagem}{$app->Pasta_painel}/{$arquivito->Caminho_txf}"> {$arquivito->Nome_txf} </a>                                        <br>                                    {/foreach}                                </td>                            </tr>                        {/if}                        {if (isset($post['Telefone_txf']))}                            <tr>                                <td style="padding: 0px 50px 0px 50px; font-family: tahoma;font-size: 14px;"><strong>Telefone: </strong> {$post['Telefone_txf']}</td>                            </tr>                        {/if}                        {if ($post['Aluno_txf']!='')}                            <tr>                                <td style="padding: 0px 50px 25px 50px; font-family: tahoma;font-size: 14px;"><strong>Aluno: </strong>{$post['Aluno_txf']}                                    <br><br><br>                                </td>                            </tr>                        {/if}                        {if (isset($post['Mensagem_txa']))}                            <tr>                                <td style="padding: 0px 50px 25px 50px; font-family: tahoma;font-size: 14px;"><strong>Mensagem:</strong> {$post['Mensagem_txa']}</td>                            </tr>                        {/if}                        <tr>                            <td class="botom" style="font-family: tahoma;font-size: 10px; text-align: center; padding-bottom: 30px; padding-left: 50px; padding-right: 50px; color: #adadad">                                <!--                    <a href="https://br.linkedin.com/" target="_blank" style="padding-right: 6px;text-decoration: none;">                                                        <img src="https://assets.lands.net.br/coclages/site/imagens/linkedin.png" width="24" height="24">                                                   </a>-->                                <hr style="width: 98%;">                                {*if $redes_sociais->Facebook_txf}                                    <a href="$redes_sociais[0]->Facebook_txf" target="_blank" style="padding-right: 6px;text-decoration: none;">                                        <img src="https://assets.lands.net.br/coclages/site/imagens/facebook-e.png" width="24" height="24">                                    </a>                                {/if}                                {if $redes_sociais->Instagram_txf}                                    <a href="$redes_sociais[0]->Instagram_txf" target="_blank" style="text-decoration: none;">                                        <img src="https://assets.lands.net.br/coclages/site/imagens/intagran-e.png" width="24" height="24">                                    </a>                                {/if*}                                <br>                                <br>                                E-mail enviado por {$cliente->Fantasia_txf}<br>                                {$cliente->Endereco_txf}, {$cliente->Numero_txf} - {$cliente->Bairro_txf}, {$cliente->Cidade_txf} - {$cliente->Estado_sel}, {$cliente->Cep_txf}<br>                                {$cliente->Email_txf} - {$cliente->Telefone_txf}<br>                                <!--coclages@coclages.com.br - (49) 99825-6021<br>-->                                {$cliente->Dominio_txf}<br>                                <!--www.coclages.com.br <br>-->                            </td>                        </tr>                        </tbody>                    </table>                </div>            </div>        </div>    </div>    <style>        @media screen and (-webkit-min-device-pixel-ratio: 0) {            /* Insert styles here */        }        .tabela{            width: 75%;        }        @media screen and (max-width:600px) {            .tabela {                width: 88%;            }            .linha{                padding: 0px 50px 0px 50px            }            .botom{                padding-bottom: 60px;            }        }    </style><!--<div>    <table>        <tbody>            <tr>                <td>Contato do Site - {date('d/m/Y')}</td>                <td><br />                </td>            </tr>            {if (isset($post['Nome_txf']))}                <tr>                    <td>Nome:</td>                    <td>{$post['Nome_txf']}</td>                </tr>            {/if}            {if (isset($post['Sobrenome_txf']))}                <tr>                    <td>Sobrenome:</td>                    <td>{$post['Sobrenome_txf']}</td>                </tr>            {/if}            {if (isset($post['Empresa_txf']))}                <tr>                    <td>Empresa:</td>                    <td>{$post['Empresa_txf']}</td>                </tr>            {/if}            {if (isset($post['Telefone_txf']))}                <tr>                    <td>Telefone:</td>                    <td>{$post['Telefone_txf']}</td>                </tr>            {/if}            {if (isset($post['Email_txf']))}                <tr>                    <td>Email:</td>                    <td>{$post['Email_txf']}</td>                </tr>            {/if}            {if (isset($post['Cidade_txf']))}                <tr>                    <td>Cidade:</td>                    <td>{$post['Cidade_txf']}</td>                </tr>            {/if}            {if (isset($post['Estado_est']))}                <tr>                    <td>Estado:</td>                    <td>{$post['Estado_est']}</td>                </tr>            {/if}            {if (isset($post['Estado_sel']))}                <tr>                    <td>Estado:</td>                    <td>{$post['Estado_sel']}</td>                </tr>            {/if}            {if (isset($post['Estado_txf']))}                <tr>                    <td>Estado:</td>                    <td>{$post['Estado_txf']}</td>                </tr>            {/if}            {if (isset($post['Produto_txf']))}                <tr>                    <td>Produto:</td>                    <td>{$post['Produto_txf']}</td>                </tr>            {/if}            {if $contato_inserido->Arquivos[0]}                <tr>                    <td>Arquivo(s):</td>                    <td>{foreach from=$contato_inserido->Arquivos item=arquivito}                        <a href="{$app->Url_cliente_linguagem}{$app->Pasta_painel}/{$arquivito->Caminho_txf}"> {$arquivito->Nome_txf} </a>                        <br>                        {/foreach}                        </td>                    </tr>                    {/if}                    </tbody>                </table>                <table style="border-collapse:collapse;width:100%;">                    <tbody>                        {if (isset($post['Mensagem_txa']))}<tr>                                <td>Mensagem:</td>                                <td>{$post['Mensagem_txa']}<br />                                </td>                            </tr>                        {/if}                    </tbody>                </table><br />            </div>            <div>Agradecemos o seu contato, retornaremos o mais breve possível!</div>            <div>{$app->Titulo_txf}</div>-->