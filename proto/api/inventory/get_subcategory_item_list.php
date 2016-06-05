<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');

	if(!isset($_GET['category'])){
		echo 'No category was supplied';
		exit();
	}

	if(!isset($_GET['subcategory'])){
		echo 'No subcategory was supplied';
		exit();
	}

	$category = $_GET['category'];
	$subcategory = $_GET['subcategory'];

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
		$items = getSubcategoryItemList($category, $subcategory, $start, $nItems);
		$max = getSubcategoryItemCount($category, $subcategory);
	} catch(PDOException $e){
		die($e->getMessage());
	}

	$response = array('items' => $items, 'max' => $max);
	header('Content-Type: application/json');
	echo json_encode($response);
