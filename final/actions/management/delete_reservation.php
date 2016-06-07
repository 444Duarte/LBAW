<?php
	header('Content-Type: application/json');

	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/inventory.php');
	include_once($BASE_DIR . 'database/records.php');
	include_once($BASE_DIR . 'database/users.php');
	include_once($BASE_DIR . 'database/util.php');


	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$_SESSION['error_messages'][] = 'Invalid request not post';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if($userType != 'InventoryManager'){
		$_SESSION['error_messages'][] = 'Invalid permissions';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
	if(!isset($_POST['reservation'])) {
		$_SESSION['error_messages'][] = 'Invalid parameters';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
 
	$idReservation = test_input($_POST['reservation']);

	try {
		$deletedReservation =deleteReservationById($idReservation); 
		if($deletedReservation === false) {
			$_SESSION['error_messages'][] = 'Invalid request';
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			exit;
		}
		var_dump($deletedReservation);
		sendDeletedReservationNotice($deletedReservation);
	} catch (PDOException $e) {
		echo $e->getMessage();
		$_SESSION['error_messages'][] = 'Invalid request';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}


	$_SESSION['success_messages'][] = 'Reservation deleted';
	echo "Success"; 
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;	

	function sendDeletedReservationNotice($reservation){
		$templateSubject = 'Deleted reservation no: ';
		$templateMessage = ["Dear Mr/Mrs ","\nWe would like to inform you that you reservation on the item: ", " that was scheduled from ", " to "," had to be canceled.\nRegards,\nToolBox Team." ];

		$idUser = $reservation['id_client'];
		$user =  getUser($idUser);
		$item = getItemByItemInstanceId($reservation['id_item_instance']);
		var_dump($user);
		var_dump($item);
		$subject = $templateSubject . $reservation['id'];
		$message = $templateMessage[0] . $user['username'] . $templateMessage[1] . $item['name'] . $templateMessage[2] . $reservation['start_time'] . $templateMessage[3] . $reservation['end_time'] . $templateMessage[4];
		mail($user['email'],$subject,$message);
	}