<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');
	include_once($BASE_DIR .'database/util.php');
	
	if(!$_POST['email'] || !$_POST['username'] || !$_POST['password'] || !$_POST['confirm_password'] || !$_POST['hash'] ) {

		$_SESSION['error_messages'][] = 'Missing parameters';
		$_SESSION['form_values'] = $_POST;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	$email = $_POST['email'];
	$username = test_input($_POST['username']);
	$password = $_POST['password'];
	$confirm_pass = $_POST['confirm_password'];
	$hash = $_POST['hash'];

	if($email != isValidHashPreRegister($hash)){
		// $_SESSION['error_messages'][] = 'Registration failed'; 
		$_SESSION['error_messages'][] = 'invalid email'; 
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	$email != test_input($email);

	try {
		validateEmail($email);
	} catch (Exception $e) {
		$_SESSION['error_messages'][] = $e->getMessage(); 
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}


	if($confirm_pass != $password){
		$_SESSION['error_messages'][] = 'Passwords don\'t match';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	
	if(createInventoryManager($email,$username,$password)){
		$_SESSION['success_messages'][] = 'Registration successful';
	}else{
		$_SESSION['error_messages'][] = 'Registration failed';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
		  
	
	header('Location: ' . $BASE_URL);