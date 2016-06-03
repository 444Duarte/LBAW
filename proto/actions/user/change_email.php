<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');


	if(!isset($_POST['email']) || !isset($_POST['confirm_email']) || !isset($_POST['password']) || $_POST['email'] == "" || $_POST['confirm_email'] == "" || $_POST['password'] == "") {
		$_SESSION['error_messages'][] = 'Invalid Input';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}


	if ($username == NULL){
		echo 'User not logged';
		exit;
	}

	$email = $_POST['email'];
	$email2 = $_POST['confirm_email'];
	$password = $_POST['password'];

	if (filter_var($email, FILTER_VALIDATE_EMAIL)  === FALSE) {
		$_SESSION['error_messages'][] = 'Invalid Email';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if ($email !== $email2){
		echo 'diferent emails';
		exit;
	}

	if (isLoginCorrect($username, $password)) {
		$_SESSION['success_messages'][] = 'Login successful';  
	} else {
		$_SESSION['error_messages'][] = 'Login failed';  
	}

	if (changeEmail($username, $email)){
		$_SESSION['success_messages'][] = 'email changed sucessfully';
	}
	else{
		$_SESSION['error_messages'][] = 'failed to change email';  
	}



	header('Location: ' . $_SERVER['HTTP_REFERER']);