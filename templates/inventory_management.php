<html>
<?php include_once 'header.html';?>
<link rel="stylesheet" type="text/css" href="css/inventory_management.css">

<body>
	<?php include_once 'topbar.html';?>

	<div class="container-fluid">
    <div class="row">
      <?php include_once 'sidebar.html';?>
      <div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
      	<div class="generic-element">
          <div class="table-top-header">
            <h2 class="sub-header">Users List</h2>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-item-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Item
            </button>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>State</th>
                    <th>Condition</th>
                    <th></th>
                  </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="">000001</a></td>
                  <td>Item 1</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Available</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
                  <td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000002</a></td>
                  <td>Item 2</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Removed from stock</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Revive item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000003</a></td>
                  <td>Item 3</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Available</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000004</a></td>
                  <td>Item 4</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Removed from stock</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Revive item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000005</a></td>
                  <td>Item 5</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Available</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000006</a></td>
                  <td>Item 6</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Removed from stock</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Revive item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000007</a></td>
                  <td>Item 7</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Available</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000008</a></td>
                  <td>Item 8</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Available</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="">000009</a></td>
                  <td>Item 9</td>
                  <td><a href="">Tools</a></td>
                  <td><a href="">Maintenance</a></td>
                  <td>Available</td>
                  <td><select class="form-control btn-primary dropdown-toggle">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>                
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
              <form id="add-item-form" action="" method="post">
                Name:<br>
                <input type="text" name="name" required>
                <br>Category<br>
                <select name="category">
								  <option value="inf">Informatics</option>
								  <option value="video">Video</option>
								  <option value="audio">Audi</option>
								  <option value="room">Room</option>
								  <option value="cleaning">Cleaning</option>
								</select>
               	<br>Sub-Category<br>
                <select name="sub_category">
								  <option value="peripheral">Peripheral</option>
								  <option value="computers">Computers</option>
								  <option value="adapters">Adapters</option>
								  <option value="cables">Cables</option>
								  <option value="cd">CDs</option>
								</select>
								<br>Image<br>
								<input type="file" name="pic" accept="image/*">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="submit_form_button" class="btn btn-primary">Add Item</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div>
  </div>

<script src="../lib/jquery-1.12.1.min.js"></script>
<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script src="js/admin_user_list.js"></script>
<script type="text/javascript">
  $(".username").html('manager001<span class="caret"></span>');
  $("#loginButton").hide();
</script>
</body>
</html>
  