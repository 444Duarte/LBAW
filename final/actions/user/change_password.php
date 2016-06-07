<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');


	if(!isset($_POST['password']) || !isset($_POST['new_password']) || !isset($_POST['confirm_password'])) {
		$_SESSION['error_messages'][] = 'Invalid Input';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if ($username == NULL){
		echo 'User not loged';
		exit;
	}

	$password = $_POST['password'];
	$new_pass = $_POST['new_password'];
	$confirm_pass = $_POST['confirm_password'];

	if ($new_pass !== $confirm_pass){
		echo 'diferent passwords';
		exit;
	}

	if (isLoginCorrect($username, $password)) {
		$_SESSION['success_messages'][] = 'Login successful';  
		

		if (changePassword($new_pass, $username)){
			$_SESSION['success_messages'][] = 'password changed sucessfully';
		}
		else{
			$_SESSION['error_messages'][] = 'failed to change password';  
		}

	} else {
		$_SESSION['error_messages'][] = 'Login failed';  
	}

	


	header('Location: ' . $_SERVER['HTTP_REFERER']);