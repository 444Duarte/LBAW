<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li><a href="pages/inventory/about_us.php">About Us</a></li>
    <li><a href="pages/inventory/item_list.php">Item List</a></li>
  </ul>
  {if $USER_TYPE == 'InventoryManager'}
    <ul class="nav nav-sidebar">
    	<li><a href="pages/management/inventory_management.php">Inventory Management</a> </li>
    </ul>
  {/if}
  {if $USER_TYPE == 'SystemManager'}
    <ul class="nav nav-sidebar">
    	<li><a href="{$BASE_URL}pages/admin/users_list.php">Users Lists</a> </li>
    </ul>
  {/if}
</div>