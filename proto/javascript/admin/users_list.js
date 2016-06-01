$(document).ready(function(){
	$('.modal').on('shown.bs.modal', function () {
	  $(this).find('input')[0].focus();
	});

	$('.modal').on('hidden.bs.modal', function () {
	  $(this).find('form')[0].reset();
	});



	var form = $('.modal form');
	form.submit(sendPreRegisterForm());

	$('#submit_form_button').click(function(){
		form.submit();
	});

});

function sendPreRegisterForm(dom) {
	var action = dom.attr("action");
	var data = $dom.serialize();
	$.ajax({url: action, dataType: "json", data: data, 
		success: function(response){
			var result = response['result'];
			var messaeg = responde['message'];
			alertify.logPosition("bottom right");
	    	alertify.log(message);
	    },
	    error: function(response){
			alertify.logPosition("bottom right");
	    	alertify.log("Request failed");	    
	    }
	});
	$('#add-user-modal').hide();
};
