<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');


	if(!isset($_GET['limit']) || !isset($_GET['offset']) || $_GET['limit'] == "" || $_GET['offset'] == ""){
		$response = "fill all variables";
	}
	else{
		$limit = $_GET['limit'];
		$offset = $_GET['offset'];
		try {
			$items = getItemListWithRemoved($offset, $limit); 
			$categories = getCategories();
			$subCategories = getSubCategories();
			$max = getItemCountWithRemoved();

			for($i = 0; $i < count($items); ++$i){
				$condition = getAverageCondition($items[$i]['category'], $items[$i]['subcategory'], $items[$i]['name']);
				$items[$i]['condition'] = intval(round($condition));
			}

		} catch(PDOException $e){
			die($e->getMessage());
		}
	}

	  $smarty->assign('items', $items);
	  $smarty->assign('categories', $categories);
	  $smarty->assign('subCategories', $subCategories);
	  $smarty->assign('max', $max);

	
	$response = array('items' => $items, 'max' => $max);
	header('Content-Type: application/json');
	echo json_encode($response);
