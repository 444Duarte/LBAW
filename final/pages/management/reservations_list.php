<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR . 'database/users.php');
  include_once($BASE_DIR . 'database/inventory.php');
  
	/*if($userType != 'InventoryManager'){
    $_SESSION['error_messages'][] = 'Invalid permissions';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }*/

  $reservations = getAllReservations();
  // var_dump($reservations);
 	$smarty->assign('reservations',$reservations);

 	$smarty->display('management/reservations.tpl');