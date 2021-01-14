<div id = "atencao">

    {if ($mensagem['resposta'] == 'duplicado')}
        <script type="text/javascript" charset="utf-8">

            setTimeout(function () {
            swal({ title: "", text: "Email já cadastrado", type: "error" });
    }, 10);
        </script>
    {/if}
    {if ($mensagem['resposta'] == 'ok')}
        <script type="text/javascript" charset="utf-8">

            setTimeout(function () {
            swal({ title: "", text: "Email cadastrado com sucesso!", type: "success" });
    }, 10);
        </script>
    {/if}
    {if (!$mensagem)}
        <script type="text/javascript" charset="utf-8">

            setTimeout(function () {
            swal({ title: "", text: "Envie um email válido!", type: "error" });
    }, 10);
        </script>
    {/if}
    

</div>