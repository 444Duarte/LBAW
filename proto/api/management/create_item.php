<?php
	
	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$response = array("result" => false, "message" => "Invalid request");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}

	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/inventory.php');
	include_once($BASE_DIR . 'database/util.php');



	/*if($_SESSION['USER_TYPE'] != 'InventoryManager'){
		$response = array("result" => false, "message" => "Invalid permissions");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();
	}*/

	if(!isset($_POST['name']) || !isset($_POST['category']) || !isset($_POST['subcategory']) || !isset($_POST['description'])) {
		$response = array("result" => false, "message" => "Invalid request");
      	header('Content-Type: application/json');
      	echo json_encode($response);
		exit();	}



	$item = test_input($_POST['name']);
	$category = test_input($_POST['category']);
	$subcategory = test_input($_POST['subcategory']);
	$description = test_input($_POST['description']);

	if(!isset($_POST['picture'])) {
		$picture = $BASE_DIR . "images/assets/item_default.png";
	}
	else {
		$picture = $_POST['picture'];
	}

	
	try {
		addItem($category, $subcategory, $name, $description, $picture);
	} catch(PDOException $e){
		die($e->getMessage());
	}
	

	$response = array("result" => true, "message" => "Item created");
	header('Content-Type: application/json');
    echo json_encode($response);
	exit();

?>