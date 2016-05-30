<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validateSimpleTextOnly($name){
	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
  		throw new Exception("Only letters and white space allowed",1); 
	}
	return true;
}


function validateEmail($email){
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		throw new Exception("Invalid email", 1);
	}
	return true;
}	

function validatePhoneNumber($phoneNumber){
	if (!preg_match("/^[0-9]{9}$/",$phoneNumber)) {
  		throw new Exception("Invalid phone number",1); 
	}
	return true;
}

?>