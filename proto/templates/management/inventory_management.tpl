{extends file="common/main.tpl"}

{block name="title"} Inventory Management {/block}

{block name="css" append}
<link rel="stylesheet" type="text/css" href="css/management/inventory_management.css">
{/block}

{block name="content"}
	{include file='common/topbar.tpl'}

	<div class="container-fluid">
    <div class="row">
      {include file='common/sidebar.tpl' }
      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
      	<div class="generic-element">
          <div class="table-top-header">
            <h2 class="sub-header">Items List</h2>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg add-button" data-toggle="modal" data-target="#add-item-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Item
            </button>
            <button id="add-subcategory-button" type="button" class="btn btn-default btn-lg add-button" data-toggle="modal" data-target="#add-subcategory-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Subcategory
            </button>
            <button id="add-category-button" type="button" class="btn btn-default btn-lg add-button" data-toggle="modal" data-target="#add-category-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Category
            </button>
          </div>
          <div class="table-responsive">
            {include file='management/item_table.tpl'}
          </div>
        </div>
      </div>

			<div id="add-item-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              	<span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Add Item</h4>
            </div> 
            <div class="modal-body">
              <form id="add-item-form" action="api/management/create_item.php" method="post" enctype="multipart/form-data">
                Name:<br>
                <input type="text" name="name" required>
                <br>Category<br>
                <select name="category" required>
                {foreach $categories as $category}
								  <option value="{$category.id}"> {$category.name} </option>
                {/foreach}                
								</select>
               	<br>Sub-Category<br>
                <select name="subcategory" required>
                  <option value="">Choose</option>
								</select>
                <br>Description:<br>
                <input type="text" name="description" required>
								<br>Image<br>
								<input type="file" name="picture" accept="image/*">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_item_form_button" class="btn btn-primary submit_form_button">Add Item</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div id="add-category-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Add Category</h4>
            </div> 
            <div class="modal-body">
              <form id="add-category-form" action="api/management/create_category.php" method="get" enctype="multipart/form-data">
                Name:<br>
                <input type="text" name="name" required>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_category_button" class="btn btn-primary submit_form_button">Add Category</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <div id="add-subcategory-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">Add Subcategory</h4>
            </div> 
            <div class="modal-body">
              <form id="add-subcategory-form" action="api/management/create_subcategory.php" method="get" enctype="multipart/form-data">
                Category<br>
                <select name="category" required>
                {foreach $categories as $category}
                  <option value="{$category.id}"> {$category.name} </option>
                {/foreach}
                </select>
                <br>Name:<br>
                <input type="text" name="name" required>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_subcategory_button" class="btn btn-primary submit_form_button">Add Subcategory</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div>
  </div>
{/block}

{block name="js-code" append}
<script type="text/javascript"> var subCategories = {$subCategories|@json_encode}; var items = {$items|@json_encode}; var max = {$max|@json_encode};
  //console.log("items:");
  //console.log(items);
  //console.log("max -> " + max);
</script>
{/block}
{block name="js" append} 
<script src="javascript/management/inventory_management.js"></script>
{/block}
  