<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');
	include_once($BASE_DIR .'database/util.php');
	include_once($BASE_DIR . 'utils/loggin_validation.php');

	if($_SERVER["REQUEST_METHOD"] != "POST"){
		$_SESSION['error_messages'][] = 'Invalid request not post';
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if($_SESSION['USER_TYPE'] != 'SystemManager'){
		$_SESSION['error_messages'][] = 'Invalid request';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	if(!$_POST['user']){
		$_SESSION['error_messages'][] = 'Invalid request no user';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}


	$idUser = $_POST['user'];
	$note = $_POST['note'];
	try {
		if(blockUser($idUser, $note)){
			$_SESSION['success_messages'][] = 'Request successful';
		}else{
			$_SESSION['error_messages'][] = 'Request failed';
		}
	} catch (PDOException $e) {
		$_SESSION['error_messages'][] = 'Request failed';
		echo $e->getMessage();
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}
	

	header('Location: ' . $_SERVER['HTTP_REFERER']);



