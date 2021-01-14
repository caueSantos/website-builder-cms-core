<style>.ok_info{
            margin-left:-5px;
            color: #FFFFFF;


            border-style:hidden;
            border-radius: 0px;
            height: 42px;
padding-left:20px;
padding-right:20px;
          font-size:20px;
          margin-top:2px;
      }

      .info_input{
            height: 43px;
          
            min-width: 230px;
  
      }

</style>
<h2 class="cor_branco" style="filter:alpha(opacity=100); opacity:1;">Informativo</h2>
<div class='cor_branco'>Receba novidades do Park Girassol em seu e-mail.</div>

      <div class='campo-busca'>
            <div class="tam8">
            <input type="text" id='info' class='info_input' value="E-mail" name='Email_txf'>
            <input type="hidden" id='Lands_id'  value="{$app->Lands_id}" name='Lands_id'>
            </div>
            <div class="tam4">
            <input type='button'  id='bt_info' class="ok_info grad_vermelho" value="Enviar" >
            </div>
      </div>
            


<div id="retorno_info" style="margin-top:50px; color:white"></div>

<script>
      $(document).ready(function() {
      $("#info").keypress(function(e) {
      if (e.which == 13) {
      $('#bt_info').click();
}
});
$('#bt_info').click(function() {

Email_txf = $('#info').val();
Lands_id = $('#Lands_id').val();

jQuery.post('{$app->Url_cliente}post/informativo', {
Email_txf: Email_txf, Lands_id: Lands_id

},
function(data) {
$('#retorno_info').fadeIn(1000).html(data);
}, 'html');
});
})
</script>

