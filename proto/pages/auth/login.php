<?php
 	include_once('../../config/init.php');
	if ($username != NULL){
		header('Location:' . $BASE_URL . 'pages/inventory/item_list.php');
	}
  	$smarty->display('auth/login.tpl');