<?php
	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$response = array("result" => false, "message" => "Invalid request");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}

	/*if($_SESSION['USER_TYPE'] != 'SystemManager'){
		$response = array("result" => false, "message" => "Invalid request");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}*/

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
		$link = $BASE_LINK . $BASE_URL . 'pages/auth/signup_inventory_manager.php?h=';
		$hashCode = inventoryManagerPreRegister($email);
	} catch (Exception $e) {
		$response = array("result" => false, "message" => "Request failed");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}

	mail($email, "Inventory Manager Request", 'Please follow the following link to create an Inventory Manager account: ' . $link . $hashCode);

	$response = array("result" => true, "message" => "Email sent");
	header('Content-Type: application/json');
    echo json_encode($response);
	exit();
?>