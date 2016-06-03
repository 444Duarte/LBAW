<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');

	if(!isset($_GET['start'])){
		$start = 0;
	}
	else{
		$start = $_GET['start'];
	}

	if(!isset($_GET['nUsers'])){
		$nUsers = PHP_INT_MAX;
	}
	else {
		$nUsers = $_GET['nUsers'];
	}

	if(!isset($_GET['banned']) or ($_GET['banned'] == 'false')) {
		$banned = False;
	}
	else {
		$banned = True;
	}

	try {
		$users = getAllUsers($start, $nUsers, $banned);
		$max = getUserCount($banned);
	} catch(PDOException $e){
		die($e->getMessage());
	}

	$response = array('users' => $users, 'max' => $max);
	header('Content-Type: application/json');
	echo json_encode($response);
