<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/inventory.php');

	if(!isset($_SESSION['username'])){
		header('Location: ' . $BASE_URL);
	}

	if(!isset($_GET['category'])){
		echo 'Missing Category';
		exit();
		//header('Location: ' . $BASE_URL);
	}

	if(!isset($_GET['subcategory'])){
		echo 'Missing Subcategory';
		exit();
		//header('Location: ' . $BASE_URL);
	}

	if(!isset($_GET['item'])){
		echo 'Missing Item';
		exit();
		//header('Location: ' . $BASE_URL);
	}

	$category = $_GET['category'];
	$subcategory = $_GET['subcategory'];
	$item = $_GET['item'];

	$item = getItem($category, $subcategory, $item);

	var_dum!p($item);
//	$smarty->display('inventory/item.tpl');