<?php /*%%SmartyHeaderCode:2573451895be657ed32-91003034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a163e964dcaa92d94397b66d1a40146297eaf25' => 
    array (
      0 => 'application\\views\\templates\\padrao\\blocos\\informativo.tpl',
      1 => 1366137148,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2573451895be657ed32-91003034',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51895be65a2608_77605996',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51895be65a2608_77605996')) {function content_51895be65a2608_77605996($_smarty_tpl) {?><div class='info_inicio'> 
      <h1>Informativo!</h1>
        
      <div class='resposta'>
            <p>Receba nossas novidades em seu email!!</p>
      </div> 
      <!-- <form action="post/informativo" enctype="multipart/form-data" method="post"> -->
      <input class='campo_info' onfocus="this.value = ''" onblur="if(this.value == ''){ this.value = 'E-mail'; }" value="E-mail" name="Email_txf" type="text" />
      <input class="bt_info" type="button"  value='Enviar' onclick=""/>



      <!-- </form> -->
</div>



<script>
      $(document).ready(function(){

      $(".campo_info").keypress(function(e) {
      if (e.which == 13) {
      $('.bt_info').click();
}
}  );               
$('.bt_info').click(function(){
         
Email_txf = $('.campo_info').val();
            
jQuery.post('post/informativo', {
Email_txf:Email_txf
            
},
function(data) {
$('.resposta').fadeIn(1000).html(data);
},'html');
});
})    </script><?php }} ?>