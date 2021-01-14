<div class="resposta" style="text-align:center; margin-top:50px; margin-bottom:50px;">
    
      {if ($mensagem=='tabela')}
            <div class="alert alert-danger">Tabela não passada no POST.</div>   
      {/if}
      {if ($mensagem=='email')}
            <div class="alert alert-danger">Email do usuário não passado no POST.</div>   
      {/if}
      {if ($mensagem=='destinatario')}
            <div class="alert alert-danger">Destinatario não passado no POST.</div>   
      {/if}

      {if ($mensagem=='tabela_nao_existe')}
            <div class="alert alert-danger">Tabela {$tabela} não encontrada.</div>   
      {/if}

      {if ($mensagem=='cadastro_inserido')}
            <div class="alert alert-success">Cadastro enviado com sucesso.</div>  
            <div class="alert alert-success">Em breve entraremos em contato informando o seu <strong>login e senha</strong> para acesso.</div> 
      {/if}

      {if ($mensagem=='cadastro_erro')}
            <div class="alert alert-danger">Erro ao cadastrar.</div>   
      {/if}
       {if ($mensagem=='login_erro')}
            <div class="alert alert-danger">Erro ao logar.</div>   
      {/if}
      
       {if ($mensagem=='cadastro_duplicado')}
            <div class="alert alert-danger">Cadastro duplicado.</div>   
      {/if}
         {if ($mensagem=='cadastro_encerrado')}
            <div class="alert alert-danger">Cadastro duplicado.</div>   
      {/if}

      {if ($mensagem=='exame_enviado')}
            <div class="alert alert-success">Solicitação enviada com sucesso.</div>   
      {/if}
      
        {if ($mensagem=='contato_ok')}
            <div class="alert alert-success">Contato enviado com sucesso. 
                {if isset($post['tabela'])}
                    
                    {if $post['tabela']=='depoimentos'}
                        <br>
                       Sua mensagem será exibida após ser aprovada pelos moderadores do site!
                    {/if}
            {/if}
            </div>   
      {/if}
      
        {if ($mensagem=='contato_erro')}
            <div class="alert alert-danger">Erro ao enviar contato.</div>   
      {/if}
      
           {if ($mensagem=='captcha_invalido')}
            <div class="alert alert-danger">Captcha inválido.</div>   
      {/if}

      {if ($mensagem=='exame_erro')}
            <div class="alert alert-danger">Erro ao enviar</div>   
      {/if}
      
        {if ($mensagem=='orcamento_enviado')}
            <div class="alert alert-success">Orçamento enviado com sucesso.</div>   
      {/if}

      {if ($mensagem=='orcamento_erro')}
            <div class="alert alert-danger">Erro ao enviar</div>   
      {/if}
      
      {if ($mensagem=='materiais_enviado')}
            <div class="alert alert-success">Solicitação enviada com sucesso.</div>   
      {/if}

      {if ($mensagem=='materiais_erro')}
            <div class="alert alert-danger">Erro ao enviar</div>   
      {/if}
      
      {if ($mensagem=='edicao_ok')}
            <div class="alert alert-success">Cadastro atualizado com sucesso.</div>   
      {/if}
      {if ($mensagem=='edicao_erro')}
            <div class="alert alert-danger">Erro ao editar cadastro.</div>   
      {/if}
      
        {if ($mensagem=='atualizacao_ok')}
            <div class="alert alert-success">Atualizado com sucesso.</div>   
      {/if}
      {if ($mensagem=='atualizacao_erro')}
            <div class="alert alert-danger">Erro ao atualizar.</div>   
      {/if}
      
      {if ($mensagem=='lead_inserido')}

            <script type="text/javascript" charset="utf-8">

        setTimeout(function () {
        swal({ title: "", text: "Enviado com sucesso.", type: "success" });
        }, 10);
        
        
//            setTimeout(function () {
//    location.href="{$app->Url_cliente}";
//}, 2000);
            </script>



      {/if}

      {if ($mensagem=='lead_erro')}

            <script type="text/javascript" charset="utf-8">

setTimeout(function () {
swal({ title: "", text: "Erro ao enviar", type: "error" });
}, 10);
            </script>
      {/if}
      {if ($mensagem=='imc_ok')}
            <div class="resposta_imc" >
                  Resultado
                  <div class="valor_imc">{$imc}</div>
                  {if $classificacao=='abaixo'}

                        <div class="alert alert-danger">Cuidado, peso abaixo do normal.</div>   
                  {/if}
                  {if $classificacao=='normal'}

                        <div class="alert alert-success">Parabéns, você está no peso ideal</div>   
                  {/if}
                  {if $classificacao=='acima'}

                        <div class="alert alert-warning">Atenção, peso acima do normal.</div>   
                  {/if}
                  {if $classificacao=='obeso'}

                        <div class="alert alert-danger">Cuidado, peso bastante acima do normal.</div>   
                  {/if}
                  {if $classificacao=='morbido'}

                        <div class="alert alert-danger">Cuidado, você está com obesidade mórbida!.</div>   
                  {/if}

                  <style>
                        .{$classificacao} {
                              background: none repeat scroll 0 0 rgba(255, 255, 255, 0.3);
                              color: #fff;
                        }
                  </style>

            </div>
      {/if}
</div>