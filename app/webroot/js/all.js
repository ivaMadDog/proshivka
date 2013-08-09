$(document).ready(function(){

    $('#msg').delay(4000).hide('highlight', 1500);
    $('.msg_close').click(function(){
        $('#msg').hide();
        console.log('msg_close');
    })


//placeholder для кроссбраузерности
    jQuery('input[data-placeholder], textarea[data-placeholder]').placeholder();

//fancybox для увеличения картинки
    $(".fancybox").fancybox({
    helpers : {
        title : {
                type : 'float'
        }
    }
    });
});
