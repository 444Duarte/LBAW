<?php
	include_once('../../config/init.php');

	$category = $_GET['category'];
	$subcategory = $_GET['subcategory'];

	$smarty->assign('category', $category);
	$smarty->assign('subcategory', $subcategory);
	$smarty->display('inventory/subcategory.tpl');