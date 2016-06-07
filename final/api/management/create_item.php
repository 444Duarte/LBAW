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

	if(!isset($_POST['name']) || !isset($_POST['category']) || !isset($_POST['subcategory']) || !isset($_POST['description'])) {
		$response = array("result" => false, "message" => "Invalid request");
      	echo json_encode($response);
		exit();	
	}

	if(!isset($_FILES['picture'])) {
		$target_dir = "images/res/item_default.png";
	}
	else {
		$target_dir =  basename($_FILES["picture"]["name"]) ;
		$target_file = $BASE_DIR . "images/res/" .  $target_dir;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// Check if image file is a actual image or fake image
		
	    $check = getimagesize($_FILES["picture"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        //echo "File is not an image.";
	        $uploadOk = 0;
	    }
		
		// Check if file already exists
		if (file_exists($target_file)) {
		    //echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["picture"]["size"] > 500000) {
		    //echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    //echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
		        //echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded in $target_file";
		    } else {
		        //echo "Sorry, there was an error uploading your file.";
		    }
		}
	}

	$name = test_input($_POST['name']);
	$category = test_input($_POST['category']);
	$subcategory = test_input($_POST['subcategory']);
	$description = test_input($_POST['description']);
	
	try {
		if(!addItem($category, $subcategory, $name, $description, $target_dir)) {
			$response = array("result" => false, "message" => "Request failed");
	      	echo json_encode($response);
			exit();
		}else {
			$response = array("result" => true, "message" => "Item Added");
		  	echo json_encode($response);
			exit();
		}
	} catch (PDOException $e) {
		$response = array("result" => false, "message" => $e->getMessage() );
      	echo json_encode($response);
		exit();
	}


	$response = array("result" => true, "message" => "Item Added");
  	echo json_encode($response);
	exit();	