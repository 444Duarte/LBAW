<?php 
	include_once('../../config/init.php');
	include_once($BASE_DIR .'database/inventory.php');

	if(!$_GET['word']) {
		$_SESSION['error_messages'][] = 'Invalid search';
		$_SESSION['form_values'] = $_GET;
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$word = $_GET['word'];

	$result = fullTextSearch($word, 0, 8);

	if (!$result) {
		header('HTTP/1.0 404 Not Found');
		exit();
	}

	$smarty->assign('search_result', $result);

	$smarty->display('inventory/search.tpl');