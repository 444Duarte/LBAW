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
	$reservations = getReservations($item['id']);
	
	// need not found page
	if (!$item) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}
	
	$smarty->assign('item', $item);
	$smarty->assign('itemInstances', $itemInstances);
	$smarty->assign('reservations', $reservations);

	
	if ($userType != "InventoryManager") {
		$smarty->display('inventory/item_no_admin.tpl');
	}
	else {
		$records = getItemRecords($item['id'], 0, 5);
		$instances = getInstancesInfo($category, $subcategory, $name);
		for($i = 0; $i < count($instances); $i++){
			$state = getInstanceState($instances[$i]['id']);
			if($state['type'] == 'Add' or $state['type'] == 'Return' or $state['type'] == 'Repaired')
				$instances[$i]['state'] = 'Available';
			else
				$instances[$i]['state'] = $state['type'];

		}
		$smarty->assign('records', $records);
		$smarty->assign('instances', $instances);
		$smarty->display('inventory/item_admin.tpl');
	}