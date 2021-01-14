<link href="css/slider.css" rel="stylesheet" type="text/css"/>
<script language="javascript" src="http://scripts.landsdigital.com.br/landscar2.js"></script>

<div id="inicio_clientes"> 
      <div id="inicio_clientes_setae"></div>
      <div id="inicio_clientes_con">
            <div id="inicio_clientes_con_logos" style="width: 5610px;">


                  {foreach from=$trabalhos_inicio item=trabalho}

                        <!--                              <div onclick="location.href='http://agencia.landsdigital.com.br/?pg=clientes&amp;id=32'" id="inicio_clientes_item">-->
                        <div id="inicio_clientes_item">
                              {assign var=nome_cliente value="/"|explode:"{$trabalho->Cliente_sel}"}
                              {$id_cliente=$nome_cliente[0]}{$nome_cliente=$nome_cliente[1]}
                              <p>{$nome_cliente}</p>
                              <a href="{$app->Url_cliente}trabalho/{$trabalho->Id_int}">
                                    <img height="450" style=" max-width: 400px;" src="{$app->Url_cliente}{$app->Pasta_painel}/{$trabalho->Caminho_txf}">
                              </a>
                        </div>

                  {/foreach}





            </div>
      </div>
      <div id="inicio_clientes_setad"></div>
</div>
<script type="text/javascript">

      $(document).ready(function() {

      $('#anima_dinamica').landscar({
      div: '#anima_dinamica',
      botao1: '#bt_e',
      botao2: '#bt_d',
      porvez: '1',
      timer: true,
      marcadores: true,
      tipo: 'slide'



});





$('#inicio_clientes_con_logos').landscar({
div: '#inicio_clientes_con_logos',
botao1: '#inicio_clientes_setae',
botao2: '#inicio_clientes_setad',
porvez: '1',
marcadores: false,
timer: 'true'



});

})

</script>