<?php /*%%SmartyHeaderCode:848614725519fff16118b25-92622537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6f2fc28f3ac9e242210d223ca9d5b488c36ecdd' => 
    array (
      0 => 'applications/frontend_1.1/views/templates/blocos/informativo.tpl',
      1 => 1368206572,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '848614725519fff16118b25-92622537',
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_519fff16182d28_24109084',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_519fff16182d28_24109084')) {function content_519fff16182d28_24109084($_smarty_tpl) {?><div class='info_inicio'> 
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