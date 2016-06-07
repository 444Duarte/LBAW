<?php
	header('Content-Type: application/json');

	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$response = array("result" => false, "message" => "Invalid request");
      	echo json_encode($response);
		exit();
	}

	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/records.php');
	include_once($BASE_DIR . 'database/users.php');
	include_once($BASE_DIR . 'database/util.php');


	if($userType != 'InventoryManager'){
		$response = array("result" => false, "message" => "Invalid permissions");
      	echo json_encode($response);
		exit();
	}

	if(!isset($_POST['reservation'])) {
		$response = array("result" => false, "message" => "Invalid request");
      	echo json_encode($response);
		exit();	
	}

	$idReservation = test_input($_POST['reservation']);

	try {
		$deletedReservation =deleteReservation($idReservation); 
		if($deletedReservation == false) {
			$response = array("result" => false, "message" => "Request failed");
	      	echo json_encode($response);
			exit();
		}
		sendDeletedReservationNotice($deletedReservation);
	} catch (PDOException $e) {
		$response = array("result" => false, "message" => $e->getMessage() );
      	echo json_encode($response);
		exit();
	}


	$response = array("result" => true, "message" => "Reservation deleted");
  	echo json_encode($response);
	exit();	

	function sendDeletedReservationNotice($reservation){
		$templateSubject = 'Deleted reservation no: ';
		$templateMessage = ["Dear Mr/Mrs ","\nWe would like to inform you that you reservation on the item: ", " that was scheduled from ", " to "," had to be canceled.\nRegards,\nToolBox Team." ];

		$idUser = $reservation['id_client'];
		$user =  getUser($idUser);
		$item = getItemByItemInstanceId($reservation['id_item_instance']);

		$subject = $templateSubject . $reservation['id'];
		$message = $templateMessage[0] . $user['name'] . $templateMessage[1] . $item['name'] . $templateMessage[2] . $item['start_time'] . $templateMessage[3] . $item['end_time'] . $templateMessage[4];
		mail($user['email'],$subject,$message);

		
	}