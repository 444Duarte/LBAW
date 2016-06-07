var usernameIsValid;

$("document").ready(function(){
	$('#username').focusout(validUsername);
	$('#email').focusout(validEmail);
	$('#signup_form input[type="submit"]').click(validateRegister);
	$('[data-toggle="tooltip"]').tooltip(); 

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

function validEmail(e) {
	var input = $('#email').val();
    var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!re.test(input)){
    	$('#email').css('border', 'solid 2px red');
    }
    else {
    	$('#email').css('border', 'solid 1px grey');
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
	 	//console.log(error['responseText']);
	});
};