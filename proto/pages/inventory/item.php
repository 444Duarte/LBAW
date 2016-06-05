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
	$itemInstances = getItemInstances($item['id']);
	
	// need not found page
	if (!$item) {
		header('HTTP/1.0 404 Not Found');
		echo "need not found page";
		exit();
	}
	
	$smarty->assign('item', $item);
	$smarty->assign('itemInstances', $itemInstances);
	
	if ($userType != "InventoryManager") {
		$smarty->display('inventory/item_no_admin.tpl');
	}
	else {
		$records = getItemRecords($item['id'], 0, 5);
		$smarty->assign('records', $records);
		$smarty->display('inventory/item_admin.tpl');
	}