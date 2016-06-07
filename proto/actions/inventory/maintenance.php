<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');
	include_once($BASE_DIR .'database/users.php');
	include_once($BASE_DIR .'database/util.php');


	if(!$_POST['provider'] or !$_POST['end_date'] or !$_POST['id'] or !$_POST['today']) {
		$_SESSION['error_messages'][] = 'Not all parameters filled';
		$_SESSION['form_values'] = $_POST;
		var_dump($_POST);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$instance = $_POST['id'];
	$today = $_POST['today'];
	$end_date = $_POST['end_date'];
	$provider = test_input($_POST['provider']);

	$idManager = getUserByUsername($_SESSION['username']);
	$idManager = $idManager['id'];


	maintenance($instance, $idManager, $provider, $end_date);
	

	header('Location: ' . $BASE_URL);