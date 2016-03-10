$(document).ready(function(){
	$('#add-user-modal').on('shown.bs.modal', function () {
	  $(this).find('input[name="email"]').focus();
	});

	$('#add-user-modal').on('hidden.bs.modal', function () {
	  $(this).find('#add-user-form')[0].reset();
	});

	var form = $('#add-user-form');
	$('#submit_form_button').click(function(){
		form.submit();
	});
});