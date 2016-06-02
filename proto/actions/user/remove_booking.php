<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');


	if($username == NULL){
		$response = "not logged";
	}
	else if(!isset($_GET['id'])){
		$response = "error passing id";
	}
	else{
		$id = intval($_GET['id']);
		try {
			$response = removeBooking($username, $id);			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}


	

	
	header('Content-Type: application/json');
	echo json_encode($response);
