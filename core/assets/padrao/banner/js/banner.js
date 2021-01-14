$(document).ready(function() {

      var filhos = $('.banner').children('.banner-item').size();
      var i =1;


      $(".banner-item:nth-child("+i+")").animate({
            opacity:1.0
      },500).css('zIndex',2);
      $(".banner-item:nth-child("+i+")").siblings('.banner-item').stop().animate({
            opacity:0
      },500).css('zIndex',1);	
      $(".marcador:nth-child("+i+")").trigger( "click" );


      var contagem=1;
      var tempo;
      var play = 1;


      var timer = function(){
	
	 

            //console.log(contagem);
            if(contagem == 10){
	
                  if(i == filhos ){
				
                        i=1;

                  }else{
			
                        i++;
	
                  }
                  $(".marcador:nth-child("+i+")").trigger( "click" );
                  contagem = 0;
            }	


            if(play == 1) {
                  setTimeout(timer,1000);
            }	

            contagem=contagem+1;	  

      //console.log(contagem + "  " + play);	
      }
	
      tempo = setTimeout(timer,1000);




      var marcadores = function(){
    
            $('.banner-item').each(function(j){
                  j++;
		
                  if(j == 1){
		
                        $('.banner-barra').append("</div><div data-conta="+j+" class='marcador marcador-ativo'>");
		
		
                  } else{
                        $('.banner-barra').append("<div data-conta="+j+" class='marcador'></div>");
                  }    
            });
   
    
            $('div.marcador').wrapAll("<div class='marcadores'></div>");
	
	
            $('.banner-barra').children().wrapAll("<div class='controle'></div>");
	
            $('.controle').prepend("<div class='banner-barra-bt pause'></div>");
	
		

            var controleFilhos = $('.marcadores').children().size();
            var marcadoresLargura = $('.marcadores').children().outerWidth(true);

            var controle = controleFilhos *  marcadoresLargura +  $('.banner-barra-bt').outerWidth(true) + 12;

            $('.controle').width(controle + "px") ;

            var tmMarcador =    $('.controle').width() / 2;



            var tamanhoBarra = $('.controle').parent().width() /2;
            var centraliza = controle / 2;


//            $('.controle').css('left',tamanhoBarra - centraliza + "px");
//
//
//
//            $(window).resize(function(){
//	
//                  var tamanhoBarra = $('.controle').parent().width() /2;
//                  $('.controle').css('left',tamanhoBarra - centraliza + "px");
//	
//            });



            $('.banner-barra-bt').on('click',function(e){

	
                  if($(this).hasClass('pause')){
                        $(this).removeClass('pause').addClass('play');
                  }else{
	
                        $(this).removeClass('play').addClass('pause');
                  }

		
		
		
		
            })

            $('.banner-barra-bt').on('click',function(){

                  if(play == 0){	
                        play = 1;
                        setTimeout(timer,1000);
                  }else{		
                        play=0;
                  }




            })

      };

      marcadores();

      $('.marcador').on('click',function(){
   
            i = $(this).data('conta');
            $(this).addClass('marcador-ativo'); 
            $(this).siblings().removeClass('marcador-ativo');
            contagem=1;
            $(".banner-item:nth-child("+i+")").animate({
                  opacity:1.0
            },500).css('zIndex',2);
            $(".banner-item:nth-child("+i+")").siblings('.banner-item').stop().animate({
                  opacity:0
            },500).css('zIndex',1);

      });

      $('.banner-setad').on('click',function(){
            if(i == filhos ){
                  i=1;
            }else{
                  i++;
            }
	
            $(".marcador:nth-child("+i+")").trigger( "click" );
	
            contagem = 1;
		
      })

      $('.banner-setae').on('click',function(){
            if(i == 1 ){
                  i=1;
            }else{
                  i--;
            }

            $(".marcador:nth-child("+i+")").trigger( "click" );

            contagem= 1;
	
      })  
});





	





