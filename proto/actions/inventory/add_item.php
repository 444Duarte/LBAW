<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');

	if(!$_POST['category'] or !$_POST['subcategory'] or !$_POST['item']) {
		$_SESSION['error_messages'][] = 'Invalid item';
		$_SESSION['form_values'] = $_GET;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$item = $_POST['item'];

	updateItemState(FALSE, $category, $subcategory, $item);
	header('Location: ' . $BASE_URL . 'pages/management/inventory_management.php');