<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/users.php');


	if(!isset($_GET['limit']) || !isset($_GET['offset']) || $_GET['limit'] == "" || $_GET['offset'] == ""){
		$response = "fill all variables";
	}
	else{
		$limit = $_GET['limit'];
		$offset = $_GET['offset'];
		try {
			$id = getUserByUsername($username)['id'];
			$max = getUserHistoryCount($id);
			$items = getUserHistory($username, $limit, $offset);
			
			
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	

	$response = array('items' => $items, 'max' => $max);
	header('Content-Type: application/json');
	echo json_encode($response);
