<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/inventory.php');

	// @TODO: confirmar permissões para editar inventário (após podermos adicionar Inventory Managers)

	if(!isset($_POST['name']) || !isset($_POST['category']) || !isset($_POST['subcategory']) || !isset($_POST['description'])) {
		$_SESSION['error_messages'][] = 'Invalid Input';
		$_SESSION['form_values'] = $_POST;
		var_dump($_POST);
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$item = $_POST['name'];
	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$description = $_POST['description'];

	if(!isset($_POST['picture'])) {
		$picture = $BASE_DIR . "images/assets/item_default.png";
	}
	else {
		$picture = $_POST['picture'];
	}

	try {
		addItem($category, $subcategory, $item, $description, $picture);
	} catch(PDOException $e){
		die($e->getMessage());
	}

	header('Content-Type: application/json');
	echo json_encode($_POST);

?>