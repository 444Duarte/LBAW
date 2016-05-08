$("document").ready(function(){
	$('#username').focusout(validUsername);


};

function validUsername() {
	var input = $('#username').val();
		
	$.post("api/auth/validate_username.php",
	{
		username: input
	},
	function(response){
		if (response['valid'] == false){
			$('#username').css('border-color', 'solid 1px red');
		}
 	},
 	'json');
}