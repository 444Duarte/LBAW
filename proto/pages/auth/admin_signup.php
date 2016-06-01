<?php
	if (!isset($_GET['h']) ) {
		header('Location: ' . $BASE_URL);
		exit();
	}

  include_once('../../config/init.php');
  include_once($BASE_DIR . 'database/users.php');

  $hash = $_GET['h'];
  $smarty->assign('HASH', $hash);
  $email = isValidHashPreRegister($hash);
  if($email === false){
  	header('Location: ' . $BASE_URL);
		exit();
  }
  $smarty->assign('EMAIL', $email);

  $smarty->display('auth/admin_signup.tpl');
?>
