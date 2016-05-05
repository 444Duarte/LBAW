<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');

	if(!isset($_GET['start'])){
		$start = 0;
	}
	else{
		$start = $_GET['start'];
	}

	if(!isset($_GET['nItems'])){
		$nItems = PHP_INT_MAX;
	}
	else {
		$nItems = $_GET['nItems'];
	}

	try {
		$items = getItemList($start, $nItems);
		$max = getItemCount();
	} catch(PDOException $e){
		die($e->getMessage());
	}

	$response = array('items' => $items, 'max' => $max);
	echo json_encode($response);
