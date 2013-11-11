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
    
    
/* Layout fancybox for preview Video */
	 $(".fancyVideo").fancybox({
		openEffect: 'none',
		closeEffect: 'none',
        beforeShow: function () {
            $('.fancybox-headerTitle').html(
                this.element.data('title')
            );
        },
        tpl: {
            wrap: '<div class="fancybox-wrap previewVideo" tabIndex="-1">' +
					'<div class="fancybox-header">' +
						'<div class="fancybox-headerTitle"></div>' +
					'</div>' +
					'<div class="fancybox-skin">' +
						'<div class="fancybox-outer">' +
						'<div class="fancybox-inner"></div>' +
					'</div>' +
					'</div>' +
                 '</div>'
        },
        helpers: {
            title: {
                type: 'inside'
            },
			overlay : {
				locked : false
			},
            media: {

			}
        }
    });  

});

function onChangePrinter() {
	var printer = $("#printer_id").val();
	if (!printer) {$("#price").val(); return 0;}
	$.ajax({
            url: "/printers/get_printer_price/"+printer,
            type: "post",
			success: function (data) {
					if(data!=0)	$('#price').val(data);
				}
	});
}

function onChangePayment() {
	var payment = $("#payment_id").val();
	if (!payment) {$('#payment_logo').hide(); return 0;}
	$('#payment_logo').hide();
	$.ajax({
            url: "/payments/get_payment_logo/"+payment,
            type: "post",
			success: function (data) {
					if(data!=0)	{
					var src="/files/images/payments/image/thumb/"+data;
					$('#payment_logo').attr('src', src);
					$('#payment_id+.error-message').hide();
					$('#payment_logo').fadeIn('300');

					}
				}
	});
}

$(function() {
    $('#search_input').fastLiveFilter('#search_list');
});