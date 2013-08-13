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

function onChangePrinter() {
	var printer = $("#printer_id").val();
	$.ajax({
            url: "/printers/get_printer_price/"+printer,
            type: "post",
			success: function (data) {
					if(data!=0)	$('#order_price').val(data);
				}
	});
}

function onChangePayment() {
	var payment = $("#payment_id").val();
	$('#payment_logo').hide();
	$.ajax({
            url: "/payments/get_payment_logo/"+payment,
            type: "post",
			success: function (data) {
					if(data!=0)	{
					var src="/files/images/payments/image/thumb/"+data;
					$('#payment_logo').attr('src', src);
					$('#payment_logo').fadeIn('300');
					}
				}
	});
}

