$(document).ready(function(){
   
//скрипт для окна контактов в верхнем меню         
    $('#top_contacts').mouseenter(function() {
        $('#top_all_contacts').show(100);
        console.log('dfsdf');
    });
    $('#top_contacts').mouseleave(function () {
        $('#top_all_contacts').hide(50);
    });
//fancybox для увеличения картинки принтера
    $("#printer-photo-img").fancybox({
    helpers : {
        title : {
                type : 'float'
        }
    }
    });

//placeholder для кроссбраузерности
    jQuery('input[data-placeholder], textarea[data-placeholder]').placeholder();    
});
