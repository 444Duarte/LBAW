var usernameIsValid;

$("document").ready(function(){
	$('#username').focusout(validUsername);
	$('#signup_form input[type="submit"]').click(validateRegister);

});

function validateRegister(e){
	var pass = $('#signup_form input[name="password"]').val();  
	var confirmPassword = $('#signup_form input[name="confirm_password"]').val();
	validUsername($('#username'));
	if(pass != confirmPassword){
		$('#signup_form input[name="confirm_password"]').css('border', 'solid 2px red');
		alert("Passwords don't match");
		e.preventDefault();
	}else if (usernameIsValid===false) {
		alert("Username already exists");
		e.preventDefault();
	}else{
		return true;
	}
};

function validUsername(e) {
	var input = $('#username').val();
	$.post(
		"api/auth/validate_username.php",
		{
			username: input
		},
		function(response){
			console.log(response);
			if (response['valid'] == true){
				usernameIsValid = false;
				$('#username').css('border', 'solid 2px red');

			}else{
				usernameIsValid = true;
				$('#username').css('border', 'groove 1px grey');
			}
	 	},
	 	'json'
	).fail(function(error){
	 	console.log(error);
	 	console.log(error['responseText']);
	});
};