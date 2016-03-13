<html>
<?php include_once 'header.html';?>
<link rel="stylesheet" type="text/css" href="css/item.css">


<body>
	<?php include_once 'topbar.html';?>
	
	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once 'sidebar.html';?>
	    	
	    	<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
	    		<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Users</a></li>
					<li><a href="#">Marcelo Rebelo de Sousa</a></li>
					<li class="active">Bookings</li>
				</ol>
				<div>
					<!-- Nav tabs -->
					<div class="row">
						<ul class="nav nav-tabs nav-justified" role="tablist">
							<li role="presentation"><a href="user_profile.php" aria-controls="info" role="tab" data-toggle="tab">Info</a></li>
							<li role="presentation"  class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Bookings</a></li>
							<li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Settings</a></li>
						</ul>
					</div>

					<div class="table-responsive">
			            <table class="table table-striped">
			              <thead>
			                  <tr>
			                    <th>Name</th>
			                    <th>Category</th>
			                    <th>Sub-Category</th>
			                    <th>Booking From</th>
			                    <th>Delivering</th>
			                    <th>Action</th>
			                  </tr>
			              </thead>
			              <tbody>
			                <tr>
			                  <td><a href="item.php">Hammer</a></td>
			                  <td><a href="#">Tools</a></td>
			                  <td><a href="#">Hand Tools</a></td>
			                  <td>12/03/2016</td>
			                  <td>14/03/2016</td>
			                  <td>Edit</td>
			                  <td><a href="" title="Remove Booking"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
			                </tr>
			                <tr>
			                  <td><a href="#">Item 2</a></td>
			                  <td><a href="#">Tools</a></td>
			                  <td><a href="#">Power Tools</a></td>
			                  <td>14/03/2016</td>
			                  <td>14/03/2016</td>
			                  <td>Edit</td>
								<td><a href="" title="Remove Booking"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
			                </tr>
			                <tr>
			                  <td><a href="#">Item 3</a></td>
			                  <td><a href="#">Tools</a></td>
			                  <td><a href="#">Hand Tools</a></td>
			                  <td>15/03/2016</td>
			                  <td>16/03/2016</td>
			                  <td>Edit</td>
								<td><a href="" title="Remove Booking"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
			                </tr>               
			              </tbody>
			            </table>
			          </div>
				</div>
			</div>
		</div>
	</div>
	<script src="../lib/jquery-1.12.1.min.js"></script>
	<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
	<script src="../lib/moment.min.js"></script>
	<script type="text/javascript">
	  $(document).ready( function() {
		  $(".username").hide();
		  $("#loginButton");
		   $(function () {
				$('#datetimepicker12').datetimepicker({
					inline: true,
					sideBySide: true
				});
			});
	  });
	</script>
</body>
</html>