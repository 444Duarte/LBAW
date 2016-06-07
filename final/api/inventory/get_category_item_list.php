<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');

	if(!isset($_GET['category'])){
		echo 'No category was supplied';
		exit();
	}

	$category = $_GET['category'];

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
		$subcategories = getCategorySubcategoryList($category, $start, $nItems);
		$max = getCategorySubcategoryCount($category);
	} catch(PDOException $e){
		die($e->getMessage());
	}

	$response = array('subcategories' => $subcategories, 'max' => $max);
	header('Content-Type: application/json');
	echo json_encode($response);
