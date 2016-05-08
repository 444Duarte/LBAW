<?php
 	include_once('../../config/init.php');
	if (isset($_SESSION['username'])){
		header('Location:' . $BASE_URL . 'pages/inventory/item_list.php');
	}
  	$smarty->display('auth/login.tpl');
?>
