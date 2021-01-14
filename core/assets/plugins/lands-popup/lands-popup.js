$(function(){
    
    //tpl
    var $wrapTpl = $('<div class="assinatura-tooltip"><div class="inner"></div></div>'),
    $innerTpl = $('<div>Esse site foi feito<br> com <span class="assinatura-heart">❤️</span> por:</div>');  
    
    //append inner to wrap
    $wrapTpl.find('.inner').html($innerTpl);
    
    $('.assinatura a').append('<div class="assinatura-holder"/>').append($wrapTpl)
    .removeAttr('title');
        
    $('.assinatura a').on('mouseover', function(e){  
        e.stopPropagation();
        if(!$(this).hasClass('popup-active')){
            $(this).addClass('popup-active');
            $('.assinatura-tooltip').fadeIn(200);
        }            
    }).on('mouseleave', function(e){
        e.stopPropagation();
        if($(this).hasClass('popup-active')){
            $(this).removeClass('popup-active');
            $('.assinatura-tooltip').fadeOut(200);
        }            
    });
        
});