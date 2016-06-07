<?php
	include_once('../../config/init.php');

	$category = $_GET['category'];

	$smarty->assign('category', $category);
	$smarty->display('inventory/category.tpl');