jQuery(document).ready(function($){
    // Sticky Navigation
      
    var aboveHeight = 0;
        $(window).scroll(function(){
            if ($(window).scrollTop() > aboveHeight){
            $('#sp-header-wrapper').addClass('fixed').css('top','0').next()
            .css('margin-top','50px');
            } else {
            $('#sp-header-wrapper').removeClass('fixed').next()
            .css('margin-top','0');
            }
        });  
});