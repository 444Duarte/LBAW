{function print_stars}
  {for $i = 1 to $nStars}
    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
  {/for}
  {for $i = $nStars + 1 to 5}
    <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
  {/for}
{/function}

<table class="table table-striped">
  <thead>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Sub-Category</th>
        <th>State</th>
        <th>Average Condition</th>
        <th>Action</th>
      </tr>
  </thead>
  <tbody id="item-list-table">
    {foreach $items as $item}  
      <tr>
        <td><a href="pages/inventory/item.php?category={$item.category|escape:'url'}&amp;subcategory={$item.subcategory|escape:'url'}&amp;item={$item.name|escape:'url'}">{$item.name}</a></td>
        <td><a href="pages/inventory/category.php?category={$item.category|escape:'url'}">{$item.category}</a></td>
        <td><a href="pages/inventory/subcategory.php?category={$item.category|escape:'url'}&amp;subcategory={$item.subcategory|escape:'url'}">{$item.subcategory}</a></td>
        {if $item.removed == FALSE}
          <td>Available</td>
        {else} 
          <td>Removed</td>
        {/if}
        <td> {print_stars nStars = $item.condition} </td>
        <td>
        {if $item.removed == FALSE}
        <a href="javascript:;"><span class="glyphicon glyphicon-remove"  aria-hidden="true" data-toggle="modal" data-target="#remove-item-modal" data-category="{$item.category}" data-subcategory="{$item.subcategory}" data-item="{$item.name}"></span>
        </a>
        {else}
        <a href="javascript:;"><span class="glyphicon glyphicon-ok" aria-hidden="true" data-toggle="modal" data-target="#add-item-modal" data-category="{$item.category}" data-subcategory="{$item.subcategory}" data-item="{$item.name}"></span></a>
        {/if}
        </td>
      </tr>
    {/foreach}                
  </tbody>
</table>

<nav>
  <ul id="pagination" class="pagination">
    <li class="disabled">
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="active"><a href="#">1</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

<div id="remove-item-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Remove Item</h4>
      </div> 
      <div class="modal-body">
        Are you sure you want to remove the item?
        <form id="remove-item-form" action="actions/inventory/remove_item.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="category">
        <input type="hidden" name="subcategory">
        <input type="hidden" name="item">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Remove Item" form="remove-item-form" class="btn btn-primary">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="add-confirmation-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Add Item</h4>
      </div> 
      <div class="modal-body">
        Are you sure you want to add the item?
        <form id="revive-item-form" action="actions/inventory/add_item.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="category">
          <input type="hidden" name="subcategory">
          <input type="hidden" name="item">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Add item" form="revive-item-form" class="btn btn-primary">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->