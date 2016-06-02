<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/inventory.php');

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
	$name = $_GET['item'];

	$item = getItem($category, $subcategory, $name);
	
	$smarty->assign('category', $category);
	$smarty->assign('subcategory', $subcategory);
	$smarty->assign('name', $name);
	$smarty->assign('description', $item['description']);
	$smarty->assign('picture', $item['picture']);
	$smarty->display('inventory/item.tpl');