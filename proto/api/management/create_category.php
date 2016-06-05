<?php
	header('Content-Type: application/json');

	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$response = array("result" => false, "message" => "Invalid request");
      	echo json_encode($response);
		exit();
	}

	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/inventory.php');
	include_once($BASE_DIR . 'database/util.php');


	if($userType != 'InventoryManager'){
		$response = array("result" => false, "message" => "Invalid permissions");
      	echo json_encode($response);
		exit();
	}

	if(!isset($_POST['name'])) {
		$response = array("result" => false, "message" => "Invalid request");
      	echo json_encode($response);
		exit();	
	}

	$name = test_input($_POST['name']);

	try {
		if(!createCategory($name)) {
			$response = array("result" => false, "message" => "Request failed");
	      	echo json_encode($response);
			exit();
		}else {
			$response = array("result" => true, "message" => "Category created");
		  	echo json_encode($response);
			exit();
		}
	} catch (PDOException $e) {
		$response = array("result" => false, "message" => $e->getMessage() );
      	echo json_encode($response);
		exit();
	}


	$response = array("result" => true, "message" => "Categorycreated");
  	echo json_encode($response);
	exit();	