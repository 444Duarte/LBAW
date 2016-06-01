$(document).ready(function(){
	$('.modal').on('shown.bs.modal', function () {
	  $(this).find('input')[0].focus();
	});

	$('.modal').on('hidden.bs.modal', function () {
	  $(this).find('form')[0].reset();
	});



	var form = $('.modal form');
	form.submit(sendPreRegisterForm);

	$('#submit_form_button').click(function(){
		form.submit();
	});

});

function sendPreRegisterForm(e) {
	var dom = $(this);
	var action = dom.attr("action");
	var data = dom.serialize();
	console.log(dom);
	console.log(action);
	console.log(data);
	$.ajax({url: action, 
		data: data, 
		success: function(response){
			var result = response['result'];
			var message = response['message'];
			alertify.logPosition("bottom center");
	    	alertify.log(message);
	    },
	    error: function(response){
			alertify.logPosition("bottom center");
	    	alertify.log("Request failed");
	    	console.log(response);
	    	//$('body').append(response['responseText']);	    
	    }
	});
	e.preventDefault();
	$('#add-user-modal').modal('toggle');
};
