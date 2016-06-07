<?php
	include_once('../../config/init.php');
	include_once($BASE_DIR . 'database/users.php');

	if($username == NULL){
		header('Location: ' . $BASE_URL);
	}

	if(isset($_GET['user'])){
		if($userType != 'SystemManager') {
			header('HTTP/1.0 403 Forbidden');
			die();
		}
		else {
			displayUserInfo($_GET['user']);
		}
	}

	if($userType == 'Client')
		displayUserInfo($username);


function displayUserInfo($username){
	global $smarty;
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

	$smarty->assign('USER', $username);
	$smarty->assign('ADDRESS', $address);
	$smarty->assign('PHONE', $phone);
	$smarty->assign('EMAIL', $email);
	$smarty->assign('IDCARD', $idCard);
	$smarty->assign('PICTURE', $picture);


	$smarty->display('user/user_profile.tpl');
}