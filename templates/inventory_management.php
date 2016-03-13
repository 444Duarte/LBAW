<?php
	function print_stars($nStars){
		$i = 0;		
		for (; $i < $nStars; $i++){
			echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>' ;
		}
		for (; $i < 5; $i++){
			echo '<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>' ;
		}
	}
?>

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
            <h2 class="sub-header">Items List</h2>
            <button id="add-item-button" type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#add-item-modal" data-whatever="@getbootstrap">           
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Item
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
                <tr>
                  <td><a href="item.php">Hammer</a></td>
                  <td><a href="#">Tools</a></td>
                  <td><a href="#">Hand Tools</a></td>
                  <td>Available</td>
                  <td><?php print_stars(4) ?></td>
                  <td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 2</a></td>
                  <td><a href="#">Tools</a></td>
                  <td><a href="#">Power Tools</a></td>
                  <td>Removed from stock</td>
                  <td><?php print_stars(0) ?></td>
									<td><a href="" title="Revive item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 3</a></td>
                  <td><a href="#">Tools</a></td>
                  <td><a href="#">Hand Tools</a></td>
                  <td>Maintenance</td>
                  <td><?php print_stars(4) ?></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 4</a></td>
                  <td><a href="#">Informatics</a></td>
                  <td><a href="#">Peripheral</a></td>
                  <td>Removed from stock</td>
                  <td><?php print_stars(0) ?></td>
									<td><a href="" title="Revive item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 5</a></td>
                  <td><a href="#">Tools</a></td>
                  <td><a href="#">Hand Tools</a></td>
                  <td>Available</td>
				  <td><?php print_stars(3) ?></td>
				  <td><a href="#" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 6</a></td>
                  <td><a href="#">Tools</a></td>
                  <td><a href="#">Maintenance</a></td>
                  <td>Removed from stock</td>
                  <td><?php print_stars(0) ?></td>
									<td><a href="" title="Revive item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 7</a></td>
                  <td><a href="#">Tools</a></td>
                  <td><a href="#">Power Tools</a></td>
                  <td>Available</td>
                  <td><?php print_stars(3) ?></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 8</a></td>
                  <td><a href="#">Informatics</a></td>
                  <td><a href="#">Peripheral</a></td>
                  <td>Available</td>
                  <td><?php print_stars(5) ?></td>
									<td><a href="" title="Remove item"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                <tr>
                  <td><a href="#">Item 9</a></td>
                  <td><a href="#">Informatics</a></td>
                  <td><a href="#">Equipment</a></td>
                  <td>Available</td>
                  <td><?php print_stars(2) ?></td>
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
  