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

function validateDatePicker($date){
	//06/31/2016
	if(strlen($date)!=10){
		throw new Exception("Invalid date", 1);
	}
	$mes = substr($date, 0, 2);
	$dia = substr($date, 3, 2);
	$ano = substr($date, 6, 4);
	$result = $ano.'-'.$mes.'-'.$dia;
	return $result;
}