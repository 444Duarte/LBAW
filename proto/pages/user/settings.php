<?php
	include_once('../../config/init.php');

	if(!isset($_SESSION['username'])){
		header('Location: ' . $BASE_URL);
	}

	$smarty->display('user/settings.tpl');
