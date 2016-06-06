<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');

	if(!$_POST['category'] or !$_POST['subcategory'] or !$_POST['item']) {
		$_SESSION['error_messages'][] = 'Invalid login';
		$_SESSION['form_values'] = $_POST;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$item = $_POST['item'];

	updateItemState(TRUE, $category, $subcategory, $item);
	header('Location: ' . $BASE_URL);