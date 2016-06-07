<?php
  include_once('../../config/init.php');
  
  if($userType != 'SystemManager'){
		$_SESSION['error_messages'][] = 'Invalid permissions';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}
   
  $smarty->display('admin/users_list.tpl');