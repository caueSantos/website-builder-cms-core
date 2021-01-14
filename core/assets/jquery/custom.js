$(document).ready(function(){
      $(".cnpj").mask("99.999.999/9999-99"); 
      $(".cpf").mask("999.999.999-99");
      $(".fone").mask("(99)9999-9999");     // Máscara para TELEFONE
      $(".cep").mask("99999-999");    // Máscara para CEP
      $(".data").mask("99/99/9999");    // Máscara para DATA
      $("#selecione_campo").fadeOut(100);

}); 

jQuery.fn.brTelMask = function() {
 
      return this.each(function(){
            var el = this;
            $(el).focus(function(){
                  $(el).mask("(99) 9999-9999?9");
            });
 
            $(el).focusout(function(){
                  var phone, element;
                  element = $(el);
                  element.unmask();
                  phone = element.val().replace(/\D/g, '');
                  if(phone.length > 10){
                        element.mask("(99) 99999-999?9");
                  }else{
                        element.mask("(99) 9999-9999?9");
                  }
            });
      });
}
 
$(document).ready(function() {
      $(".tel").brTelMask();
      $(".cel").brTelMask();
});
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function IsEmail(email){
      var exclude=/[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
      var check=/@[\w\-]+\./;
      var checkend=/\.[a-zA-Z]{2,3}$/;
      if(((email.search(exclude) != -1)||(email.search(check)) == -1)||(email.search(checkend) == -1)){
            return false;
      }
      else {
            return true;
      }
}

function enviar2(){
     
         
      enviar_form = true;
      $('form .obrigatorio').each(function(i){
        
            if($(this).val() == '') {
                  if($(this).parent().children('.preencha').size() == 0){
                        $(this).css({
                              border:'1px solid #ff3333',
                              background:'#ffe2e2'
                        });
                        enviar_form = false;
                  }
                  $(this).focus(function(){
                        $(this).val('').css({
                              border:'1px solid #ccc',
                              background: '#FFFFE8'
                        });
                  }).blur(function(){
                        if($(this).val() == '') {	 
                              $(this).val('').css({
                                    border:'1px solid #ccc',
                                    background: '#FFFFE8'
                              });
                        }
                  })
            }
      
            if($(this).hasClass('email')){
                  if (IsEmail($(this).val())){
                        $(this).css({
                              border:'1px solid #ccc',
                              background: '#FFFFE8'
                        });
                  } else {
                        enviar_form = false;
                        $(this).css({
                              border:'1px solid #ff3333',
                              background:'#ffe2e2'
                        });
                  }
            }
      })
      
//      var Senha  = $("#Senha_txf").val();
//      var Conf_senha  = $("#Confirmar_senha_txf").val();
//      if (Senha!=Conf_senha) {
//            alert('Senhas não conferem'); 
//            return false;
//      }
//      
//    
      if ($('#termos').is(':checked')){
            $("#selecione_campo").fadeOut(100);
      } else {
            $("#selecione_campo").fadeIn(100);
            return false;
      }
 
      /*console.log($('form div').children('#preencha:visible').size());*/

      if(enviar_form != false){
            return true;
      }else{
            //            $(document).ready(function(){
            //	
            //                $('html, body').animate({
            //                    scrollTop : 420
            //                },'slow');
            //	
            //            })
            return false; 
      }
}

function enviar3(){
     
         
      enviar_form = true;
      $('form .obrigatorio').each(function(i){
        
            if($(this).val() == '') {
                  if($(this).parent().children('.preencha').size() == 0){
                        $(this).css({
                              border:'1px solid #ff3333',
                              background:'#ffe2e2'
                        });
                        enviar_form = false;
                  }
                  $(this).focus(function(){
                        $(this).val('').css({
                              border:'1px solid #ccc',
                              background: '#FFFFE8'
                        });
                  }).blur(function(){
                        if($(this).val() == '') {	 
                              $(this).val('').css({
                                    border:'1px solid #ccc',
                                    background: '#FFFFE8'
                              });
                        }
                  })
            }
      
            if($(this).hasClass('email')){
                  if (IsEmail($(this).val())){
                        $(this).css({
                              border:'1px solid #ccc',
                              background: '#FFFFE8'
                        });
                  } else {
                        enviar_form = false;
                        $(this).css({
                              border:'1px solid #ff3333',
                              background:'#ffe2e2'
                        });
                  }
            }
      })
      
//      var Senha  = $("#Senha_txf").val();
//      var Conf_senha  = $("#Confirmar_senha_txf").val();
//      if (Senha!=Conf_senha) {
//            alert('Senhas não conferem'); 
//            return false;
//      }
//      
//    
   //   if ($('#termos').is(':checked')){
     //       $("#selecione_campo").fadeOut(100);
      //} else {
//            $("#selecione_campo").fadeIn(100);
//            return false;
      //}
 
      /*console.log($('form div').children('#preencha:visible').size());*/

      if(enviar_form != false){
            return true;
      }else{
            //            $(document).ready(function(){
            //	
            //                $('html, body').animate({
            //                    scrollTop : 420
            //                },'slow');
            //	
            //            })
            return false; 
      }
}



