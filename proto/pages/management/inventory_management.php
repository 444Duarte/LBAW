<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR . 'database/users.php');
  include_once($BASE_DIR . 'database/inventory.php');
  
  $items = getItemList(0, 20);  

  $smarty->assign('items', $items);
  $smarty->display('management/inventory_management.tpl');
?>