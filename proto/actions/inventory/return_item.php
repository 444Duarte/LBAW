<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');
	include_once($BASE_DIR .'database/users.php');


	echo 'cenas';

	if(!$_POST['id'] or !$_POST['today']) {
		$_SESSION['error_messages'][] = 'Not all parameters filled';
		$_SESSION['form_values'] = $_POST;
		var_dump($_POST);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$instance = $_POST['id'];
	$today = $_POST['today'];

	var_dump($today);

	$idManager = getUserByUsername($_SESSION['username']);
	$idManager = $idManager['id'];

	$idClient = getUserWhoLent($instance);
	var_dump($idClient);

	returnItem($today, $instance, $idManager, $idClient);

	header('Location: ' . $BASE_URL);