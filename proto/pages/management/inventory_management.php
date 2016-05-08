<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR . 'database/users.php');
  include_once($BASE_DIR .'database/inventory.php');

  $username = $_GET['username'];
  
  $items = getItemList();  

  $smarty->assign('items', $items);
  $smarty->display('management/inventory_management.tpl');
?>