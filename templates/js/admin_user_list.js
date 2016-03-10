$(document).ready(function(){
	$('.modal').on('shown.bs.modal', function () {
	  $(this).find('input')[0].focus();
	});

	$('.modal').on('hidden.bs.modal', function () {
	  $(this).find('form')[0].reset();
	});

	var form = $('.modal form');
	$('#submit_form_button').click(function(){
		form.submit();
	});
});