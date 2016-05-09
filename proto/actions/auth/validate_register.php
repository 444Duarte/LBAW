<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');
	if(!$_POST['email'] ||!$_POST['username'] || !$_POST['password'] || !$_POST['confirm_password'] || !$_POST['id_card'] || !$_POST['address'] || !$_POST['phone']) {
		$_SESSION['error_messages'][] = 'Invalid registration';
		$_SESSION['form_values'] = $_POST;
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_pass = $_POST['confirm_password'];
	$id_card = $_POST['id_card'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];

	if($confirm_pass != $password){
		$_SESSION['error_messages'][] = 'Registration failed';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	if (createClientUser($email, $username, $password)) {
		if(createClient($username,$id_card,$address,$phone)){
			$_SESSION['success_messages'][] = 'Registration successful';
		}else{
			$_SESSION['error_messages'][] = 'Registration failed';  
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		  
	} else {
		$_SESSION['error_messages'][] = 'Registration failed';  
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	header('Location: ' . $BASE_URL);
		}
?>