<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');
	include_once($BASE_DIR .'database/util.php');
	include_once($BASE_DIR . 'utils/loggin_validation.php');

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

	if(!isset($_POST['id-item'],$_POST['condition']) ) {
		$_SESSION['error_messages'][] = 'Missing parameters';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$idItem = test_input($_POST['id-item']);
	$condition = test_input($_POST['condition']);

	try {
		createInstance($idItem,$condition);
	} catch (PDOException $e) {
		echo $e->getMessage();
		$_SESSION['error_messages'][] = 'Invalid request';
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$_SESSION['success_messages'][] = 'Instance created';
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;