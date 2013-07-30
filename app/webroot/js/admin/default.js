$(document).ready(function(){
 
 


//placeholder для кроссбраузерности
    jQuery('input[data-placeholder], textarea[data-placeholder]').placeholder();    
    
    
    $('#msg').delay(4000).hide('highlight', 1500);
    $('.msg_close').click(function(){
        $('#msg').hide();
        console.log('msg_close');
    }) 
    
    
});
/* удаление записи */
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
                    $(selectorHide).remove();
                    $(selectorMsg).html("Image Deleted Successfully").fadeIn(300).delay(2000).slideUp(400);
                }else{
                    $(selectorMsg).html(data).fadeIn(300).delay(20000).slideUp(400);
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
