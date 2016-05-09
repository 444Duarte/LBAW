$("document").ready(function(){
	$('#username').focusout(validUsername);
	$('#signup_form input[type="submit"]').click(checkPasswords);

});

function checkPasswords(e){
	var pass = $('#signup_form input[name="password"]').val();  
	var confirmPassword = $('#signup_form input[name="confirm_password"]').val();
	if(pass != confirmPassword){
		$('#signup_form input[name="confirm_password"]').css('border', 'solid 2px red');
		alert("Passwords don't match");
		e.preventDefault();
	}else{
		return true;
	}
};

function validUsername(e) {
	var input = $('#username').val();
	$.post(
		"../../api/auth/validate_username.php",
		{
			username: input
		},
		function(response){
			console.log(response);
			if (response['valid'] == true){
				$('#username').css('border', 'solid 2px red');
			}
	 	},
	 	'json'
	).fail(function(error){
	 	console.log(error);
	 	console.log(error['responseText']);
	});
};