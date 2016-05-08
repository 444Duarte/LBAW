$("document").ready(function(){
	$('#username').focusout(validUsername);
	$('#signup_form input[type="submit"]').click(checkPasswords);

};

function checkPasswords(e){
	var pass = $('#signup_form input[name="password"]').val();  
	var confirmPassword = $('#signup_form input[name="confirm_password"]').val();
	if(pass != confirmPassword){
		$('#username').css('border-color', 'solid 1px red');
		alert("Passowords don't match");
		e.preventDefault();
	}else{
		return true;
	}
};

function validUsername(e) {
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
};