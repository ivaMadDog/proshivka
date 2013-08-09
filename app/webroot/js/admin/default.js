$(document).ready(function(){

$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь', 'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
    monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн', 'Июл','Авг','Сен','Окт','Ноя','Дек'],
    dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
    dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
    dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
    dateFormat: 'yy-mm-dd',
    firstDay: 1,
    isRTL: false
};
$.datepicker.setDefaults($.datepicker.regional['ru']);
$('input.datepicker').datepicker({
    showOn: 'both',
    buttonImageOnly: true,
    buttonImage: '/img/ico_date.png'
});
$( ".datepicker" ).datepicker();



});
/* удаление записи в админпанели*/
function delete_entry(link, row_id, del_span, del_a){
	if(window.confirm("Вы действительно хотите удалить эту запись?")){
		$('#'+del_span).append($('.loader_span').show());
                $('#'+del_a).hide();
		$.ajax({
			url: link,
			success: function(data){
				if(data==1){
                                    $('#'+row_id).fadeOut();
                                }else{
                                    console.log('Не удалось удалить запись');
                                    $('#'+del_span+' .loader_span').remove();
                                    $('#'+del_a).show();
                                }

			}

		});
	}
}
//удаление изображения записи
function removeImg(id, controllerName, fieldImage, selector){
        console.log(selector);
    	$.ajax({
            url:"/admin/"+controllerName+"/delete_image/"+id+"/"+fieldImage,
            type: "post",
            beforeSend: function(){
              $(selector).append($('.loader_span').css({'position':'absolute', 'left':'50%','top':'50%'}).show());
            },
            success: function(data){
                if(data==1) {
                    $(selector).remove();
                    $(selector).html("Image Deleted Successfully").fadeIn(300).delay(2000).slideUp(400);
                }else{
                    $(selector).html(data).fadeIn(300).delay(20000).slideUp(400);
                }
                $('.loader_span').hide();
            }
        });
}
//активация или блокировка записи
function change_active (link, spanId, aId){
        var aClass=$('#'+aId).attr('class');
        $('#'+spanId).append($('.loader_span').show());
        $('#'+aId).hide();
        $.ajax({
                url: link,
                success: function(data){
                        if(data==1){
                            if(aClass=='controls control-locked') $('#'+aId).attr('class','controls control-unlocked');
                            else $('#'+aId).attr('class','controls control-locked');
                            $('#'+spanId+' .loader_span').remove();
                        }else{
                            $('#'+aId+' .loader_span').remove();
                        }
                        $('#'+aId).show();
                }

        });
}


