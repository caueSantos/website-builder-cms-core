<div class="resposta" style="text-align:center; margin-top:10px; margin-bottom:10px;">

       {if ($mensagem=='login_ok')}
        <script type="text/javascript" charset="utf-8">
            setTimeout(function () {
            swal({ title: "", text: "Login aceito.", type: "success" });
    }, 10);
        </script>
    {/if}
    {if ($mensagem=='login_erro')}
        <script type="text/javascript" charset="utf-8">
    setTimeout(function () {
    swal({ title: "", text: "Erro ao logar. {$texto}", type: "error" });
}, 10);
        </script>
    {/if}



</div>