<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/users.php');

	if($username == NULL){
		header('Location: ' . $BASE_URL);
	}

	$userInfo = getUserByUsername($username);

	// @TODO: error handling
	if ($userInfo == "user does not exist") {
		var_dump($userInfo);
		die();
	}

	$clientInfo = getClientByUsername($username);

	// @TODO: error handling
	if ($clientInfo == "client does not exist") {
		var_dump($clientInfo);
		die();
	}

	$address = $clientInfo['address'];
	$phone = $clientInfo['phone_number'];
	$email = $userInfo['email'];
	$idCard = $clientInfo['id_card'];
	$picture = $clientInfo['picture'];

	$smarty->assign('ADDRESS', $address);
	$smarty->assign('PHONE', $phone);
	$smarty->assign('EMAIL', $email);
	$smarty->assign('IDCARD', $idCard);
	$smarty->assign('PICTURE', $picture);


	$smarty->display('user/user_profile.tpl');
