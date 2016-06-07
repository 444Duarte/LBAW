<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');
	include_once($BASE_DIR .'database/util.php');


	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$_SESSION['error_messages'][] = 'Invalid request not post';
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if(!isset($_POST['email'])) {
		$_SESSION['error_messages'][] = 'Invalid input';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$email = test_input($_POST['email']);

	$newPassword = generateRandomString();
	if(!changePasswordByMail($newPassword, $email)){
		$_SESSION['error_messages'][] = 'Invalid email';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	mail($email, "Password Reset","Your new password is: ".$newPassword . " .Please change it as soon as possible!\nRegards,\nToolBox Team");

	$_SESSION['success_messages'][] = 'Email Sent';
	$_SESSION['form_values'] = $_POST;
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;




	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}