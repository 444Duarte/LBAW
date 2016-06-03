<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');
	include_once($BASE_DIR .'database/util.php');
	
	if(!$_POST['email'] ||!$_POST['username'] || !$_POST['password'] || !$_POST['confirm_password'] || !$_POST['id_card'] || !$_POST['address'] || !$_POST['phone']) {
		$_SESSION['error_messages'][] = 'Invalid registration';
		$_SESSION['form_values'] = $_POST;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	$email = test_input($_POST['email']);
	$username = test_input($_POST['username']);
	$password = $_POST['password'];
	$confirm_pass = $_POST['confirm_password'];
	$id_card = test_input($_POST['id_card']);
	$address = test_input($_POST['address']);
	$phone = test_input($_POST['phone']);


	try {
		//validateSimpleTextOnly($username);
		validateEmail($email);
		//validateSimpleTextOnly($address);
		validatePhoneNumber($phone);
	} catch (Exception $e) {
		$_SESSION['error_messages'][] = $e->getMessage(); 
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}


	if($confirm_pass != $password){
		$_SESSION['error_messages'][] = 'Registration failed';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

	
	if(createClient($email,$username,$password,$id_card,$address,$phone)){
		$_SESSION['success_messages'][] = 'Registration successful';
	}else{
		$_SESSION['error_messages'][] = 'Registration failed';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
		  
	
	header('Location: ' . $BASE_URL);