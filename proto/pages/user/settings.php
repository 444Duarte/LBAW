<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/users.php');

	if($username == NULL){
		header('Location: ' . $BASE_URL);
	}

	$userInfo = getUserByUsername($username);

	// @TODO: error handling
	if ($userInfo == false) {
		var_dump($userInfo);
		die();
	}
	
	$email = $userInfo['email'];

	$smarty->assign('EMAIL', $email);

	$smarty->display('user/settings.tpl');
