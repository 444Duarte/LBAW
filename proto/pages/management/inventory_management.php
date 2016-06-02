<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR . 'database/users.php');
  include_once($BASE_DIR . 'database/inventory.php');
  
  $items = getItemList(0, 20);  
  $categories = getCategories();
  $subCategories = getSubCategories();

  $smarty->assign('items', $items);
  $smarty->assign('categories', $categories);
  $smarty->assign('subCategories', $subCategories);

  $smarty->display('management/inventory_management.tpl');
?>