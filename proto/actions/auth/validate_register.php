<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');

	if(!$_POST['email'] ||!$_POST['username'] || !$_POST['password']) {
		$_SESSION['error_messages'][] = 'Invalid registration';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (createClient($email, $username, $password)) {
		$_SESSION['success_messages'][] = 'Registration successful';  
	} else {
		$_SESSION['error_messages'][] = 'Registration failed';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	header('Location: ' . $_SERVER['BASE_URL']);
?>