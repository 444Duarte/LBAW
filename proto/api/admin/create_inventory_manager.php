<?php
	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$_SESSION['error_messages'][] = 'Invalid request';
		header('Location: '. $_SERVER['HTTP_REFERER']);
		exit();
	}

	if($_SESSION['USER_TYPE'] != 'SystemManager'){
		$response = array("result" => false, "message" => "Invalid request");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}

	include_once '../../config/init.php';
 	include_once('../../database/users.php'); 
 	include_once('../../database/util.php'); 


 	if(!$_POST['email']) {
 		$response = array("result" => false, "message" => "Invalid request");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}

	$email = test_input($_POST['email']);

	try {
		validateEmail($email);
	} catch (Exception $e) {
		$response = array("result" => false, "message" => e->getMessage());
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}

	$hashCode = inventoryManagerRequest($email);
	// $hashCode = 'ABCDEFGHIJKLMN';

	email($email, "Inventory Manager Request", 'Please follow the following link to create an Inventory Manager account: '.$hashCode);

	$response = array("result" => true, "message" => "Email sent");
	header('Content-Type: application/json');
    echo json_encode($response);
	exit();
?>