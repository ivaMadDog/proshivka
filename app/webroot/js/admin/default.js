$(document).ready(function(){
   


//placeholder для кроссбраузерности
    jQuery('input[data-placeholder], textarea[data-placeholder]').placeholder();    
    
    
    $('#msg').delay(4000).hide('highlight', 1500);
    $('.msg_close').click(function(){
        $('#msg').hide();
        console.log('msg_close');
    }) 
    
    
});
