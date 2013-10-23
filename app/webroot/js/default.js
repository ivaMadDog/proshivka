$(document).ready(function(){

//скрипт для окна контактов в верхнем меню
    $('#top_contacts').mouseenter(function() {
        $('#top_all_contacts').show(100);
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

    $.localScroll({
        onAfter: function(target){
            location = '#' + ( target.id || target.name );
        }
    });
    
    $().UItoTop({ easingType: 'easeOutQuart' });

});
