<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');
	include_once($BASE_DIR .'database/users.php');

	if(!$_POST['client'] or !$_POST['end_date'] or !$_POST['id'] or !$_POST['today']) {
		$_SESSION['error_messages'][] = 'Not all parameters filled';
		$_SESSION['form_values'] = $_POST;
		var_dump($_POST);
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}


	$clientName = $_POST['client'];
	$endDate = $_POST['end_date'];
	$id = $_POST['id'];
	$today = $_POST['today'];
	//var_dump($today);

	

	if(deleteReservation($clientName, $endDate, $today, $id)){
		$idClient = getUserByUsername($clientName);
		$idClient = $idClient['id'];
		$idManager = getUserByUsername($_SESSION['username']);
		$idManager = $idManager['id'];
		//var_dump($idClient);
		//echo "cenas2";
		lendItem($id, $idManager, $idClient, $endDate);
	}

	header('Location: ' . $BASE_URL);