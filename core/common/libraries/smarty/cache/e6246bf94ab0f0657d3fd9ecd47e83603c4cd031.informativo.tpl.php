<?php /*%%SmartyHeaderCode:29297518cd8b6416028-92694757%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6246bf94ab0f0657d3fd9ecd47e83603c4cd031' => 
    array (
      0 => 'application\\views\\templates\\blocos\\informativo.tpl',
      1 => 1367956526,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29297518cd8b6416028-92694757',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_518cd8b6459822_07746077',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518cd8b6459822_07746077')) {function content_518cd8b6459822_07746077($_smarty_tpl) {?><div class='info_inicio'> 
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