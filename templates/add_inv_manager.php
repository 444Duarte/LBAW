<html>
<?php include_once 'header.html';?>
<link rel="stylesheet" type="text/css" href="css/item_list.css">

<body>
	<?php include_once 'topbar.html';?>

	<div class="container-fluid">
	    <div class="row">
	      	<?php include_once 'sidebar.html';?>

					<div class="col-sm-0 col-sm-offset-3 col-md-0 col-md-offset-2 main">
						<h1>Add Inventory Manager</h1>
						<form action="" method="post">
							<br>Email:<br>
							<input type="email" name="email" required>
							<br><br>
							<input type="submit" value="Send registration email">
						</form>
					</div>
	    </div>
	</div>
	
<script src="../lib/jquery-1.12.1.min.js"></script>
<script src="../lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $("#loginButton").hide();
  $(".username").html('admin<span class="caret"></span>');
</script>
</body>
</html>