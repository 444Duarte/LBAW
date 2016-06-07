<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR . 'database/users.php');
  include_once($BASE_DIR . 'database/inventory.php');
  
  $items = getItemListWithRemoved(0, 10);  
  $categories = getCategories();
  $subCategories = getSubCategories();

  for($i = 0; $i < count($items); ++$i){
    $condition = getAverageCondition($items[$i]['category'], $items[$i]['subcategory'], $items[$i]['name']);
    $items[$i]['condition'] = intval(round($condition));
  }

  $max = getItemCountWithRemoved();

  $smarty->assign('items', $items);
  $smarty->assign('categories', $categories);
  $smarty->assign('subCategories', $subCategories);
  $smarty->assign('max', $max);

  $smarty->display('management/inventory_management.tpl');