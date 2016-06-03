<html>
{include file='common/header.tpl' }
<link rel="stylesheet" type="text/css" href="{$BASE_URL}css/management/inventory_management.css">

<body>
	{include file='common/topbar.tpl'}

	<div class="container-fluid">
    <div class="row">
      {include file='common/sidebar.tpl' }
      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
      	<div class="generic-element">
          <div class="table-top-header">
            <h2 class="sub-header">Items List</h2>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-item-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Item
            </button>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-subcategory-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Subcategory
            </button>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-category-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Category
            </button>
          </div>
          <div class="table-responsive">
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
              <tbody>
                {foreach $items as $item}
                  <tr>
                    <td><a href="{$BASE_URL}pages/inventory/item.php">{$item.name}</a></td>
                    <td><a href="#">{$item.category}</a></td>
                    <td><a href="#">{$item.subcategory}</a></td>
                    <td>Available</td>
                    <td> {* {print_stars nStars = 3} *} </td>
                    <td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                  </tr>
                {/foreach}                
              </tbody>
            </table>
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
								  <<!-- option value="peripheral">Peripheral</option>
								  <option value="computers">Computers</option>
								  <option value="adapters">Adapters</option>
								  <option value="cables">Cables</option>
								  <option value="cd">CDs</option> -->
								</select>
                <br>Description:<br>
                <input type="text" name="description" required>
								<br>Image<br>
								<input type="file" name="picture" accept="image/*">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Add Item</button>
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
              <form id="add-item-form" action="api/management/create_category.php" method="post" enctype="multipart/form-data">
                Name:<br>
                <input type="text" name="name" required>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Add Category</button>
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
              <form id="add-item-form" action="api/management/create_category.php" method="post" enctype="multipart/form-data">
                Name:<br>
                <input type="text" name="name" required>
                <br>Category<br>
                <select name="category" required>
                  <option value="inf">Informatics</option>
                  <option value="video">Video</option>
                  <option value="audio">Audi</option>
                  <option value="room">Room</option>
                  <option value="cleaning">Cleaning</option>
                </select>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Add Subcategory</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div>
  </div>

<script src="{$BASE_URL}lib/jquery-1.12.1.min.js"></script>
<script src="{$BASE_URL}lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
<script type="text/javascript"> var subCategories = {$subCategories|@json_encode}; console.log(subCategories);</script>
<script src="{$BASE_URL}javascript/management/inventory_management.js"></script>
</body>
</html>
  