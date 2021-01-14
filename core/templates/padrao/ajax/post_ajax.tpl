<script>
      $.ajax({
type: 'POST',
url: "popup/produto_commend.php?action=process&id_produto=62",
data: $('form#frmCommend').serialize(),
dataType: 'json',
async: true,
cache: false,
timout: 9999,
beforeSend: function(){
$('#btn-submit').val('Enviando...');
$('form#frmQuestion input, input[type=button], input[type=submit], textarea').attr('disabled', true);
},
complete: function(data){
$('#btn-submit').val('Enviar indicação');
$('form#frmCommend input, input[type=button], input[type=submit], textarea').attr('disabled', false);
},
success: function (data){
if (data.erro){
$('.alert').remove();
$('.container').before(html_alerta.replace("%s",html_entity_decode(data.erro))).fadeIn(500);
$("#btn-commend").html(btn);
} else {
$.fancybox.close();
alert("Indicação realizada com sucesso!");
}
},
error: function(e){
alert("Atenção!\nOcorreu um problema executar sua requisição.\nTente novamente mais tarde.");
}
}); 
</script>