<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');


	if(!isset($_GET['start']) || !isset($_GET['end']) || !isset($_GET['id'])){
		$response = "fill all inputs";
	}
	else{
		$start = $_GET['start'];
		$end = $_GET['end'];
		$id = $_GET['id'];
		try {
			$response = editBooking($id, $start, $end);
			if($response){
				$_SESSION['success_messages'][] = 'Booking edited';
			}
			else{
				$_SESSION['error_messages'][] = 'Booking edit failed';  
			}
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	header('Content-Type: application/json');
 	echo json_encode($response);