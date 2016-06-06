<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');
	include_once($BASE_DIR .'database/users.php');


	if(!$_POST['id'] or !$_POST['today'] or !$_POST['state']) {
		$_SESSION['error_messages'][] = 'Not all parameters filled';
		$_SESSION['form_values'] = $_POST;
		var_dump($_POST);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$instance = $_POST['id'];
	$today = $_POST['today'];
	$state = $_POST['state'];

	var_dump($today);

	$idManager = getUserByUsername($_SESSION['username']);
	$idManager = $idManager['id'];

	var_dump($state);
	if($state=="Lend"){
		$idClient = getUserWhoLent($instance, "Lend");
		returnItem($instance, $idManager, $idClient);
	}
	else{
		repaired($instance, $idManager);
	}

	header('Location: ' . $BASE_URL);