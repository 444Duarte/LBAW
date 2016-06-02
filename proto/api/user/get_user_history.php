<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');


	if(!isset($_GET['username'])){
		$response = "not logged";
	}
	else{
		$username = $_GET['username'];
		try {
			$response = getUserHistory($username);
			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	

	
	header('Content-Type: application/json');
	echo json_encode($response);
